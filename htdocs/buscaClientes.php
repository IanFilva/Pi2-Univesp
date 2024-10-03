<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>

    <style>
        /* Estilos para o header */
        header {

            background-color: #007BFF; /* Azul */
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 24px;
            font-family: sans-serif;
            font-weight: bold;
        }

        /* Estilos do container */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: sans-serif;
        }

        /* Estilos da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: sans-serif;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #2F4F4F;
            color: white;
        }

        /* Styles for the comment box */
        .comment-box {
            width: 200px;
            height: auto;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 8px;
            border-radius: 5px;
        }

        /* Styles for the delete button */
        .delete-button {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Styles for the register button */
        .register-button, .home-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 10px;
        }

        /* Styles for the button container */
        .button-container {
            margin-top: 10px;
        }

        /* Flex container for search and buttons */
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #searchInput {
            flex: 1;
            margin-right: 10px; /* Espaço entre o input e os botões */
        }
    </style>
</head>
<body>
    <header>
        Urande Distribuidora
    </header>
    <div class="container">
        <h1>Lista de clientes</h1>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchClients()" placeholder="Buscar por Nome ou CPF...">
            <div class="button-container">
                <a href="regCliente.html">
                    <button class="register-button">Registrar Cliente</button>
                </a>
                <a href="pag-inicial.php">
                    <button class="home-button">Página Inicial</button>
                </a>
            </div>
        </div>
        <table id="clientTable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Tipo de Pagamento</th>
                    <th>Comentários</th> 
                    <th>Inserir/Deletar Comentário</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "DistUrande_bd";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Função de comentários
                    if(isset($_POST['submit_comment'])){
                        $comment = $_POST['comment'];
                        $cpf = $_POST['cpf'];
                        $sql_insert_comment = "UPDATE regclientes SET comentarios='$comment' WHERE cpf='$cpf'";
                        if ($conn->query($sql_insert_comment) === TRUE) {
                            echo "<script>alert('Comentário inserido com sucesso!');</script>";
                        } else {
                            echo "Erro ao inserir comentário: " . $conn->error;
                        }
                    }

                    // Função para deletar comentários
                    if(isset($_POST['delete_comment'])){
                        $cpf = $_POST['cpf'];
                        $sql_delete_comment = "UPDATE regclientes SET comentarios=NULL WHERE cpf='$cpf'";
                        if ($conn->query($sql_delete_comment) === TRUE) {
                            echo "<script>alert('Comentário excluído com sucesso!');</script>";
                        } else {
                            echo "Erro ao excluir comentário: " . $conn->error;
                        }
                    }

                    // SQL query para selecionar clientes e os comentários
                    $sql = "SELECT nome, cpf, telefone, endereco, tipoPag, comentarios FROM regclientes";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output de dados de cada linha
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><strong>" . $row["nome"] . "</strong></td>";
                            echo "<td>" . $row["cpf"] . "</td>";
                            echo "<td>" . $row["telefone"] . "</td>";
                            echo "<td>" . $row["endereco"] . "</td>";
                            echo "<td>" . $row["tipoPag"] . "</td>";
                            echo "<td>";
                            if ($row["comentarios"]) {
                                echo "<div class='comment-box'>" . $row["comentarios"] . "</div>";
                            } else {
                                echo "Nenhum comentário";
                            }
                            echo "</td>";
                            echo "<td>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='cpf' value='" . $row["cpf"] . "'>";
                            if ($row["comentarios"]) {
                                echo "<button type='submit' name='delete_comment' class='delete-button'>Excluir</button>";
                            } else {
                                echo "<textarea name='comment' placeholder='Insira seu comentário'></textarea><br>";
                                echo "<input type='submit' name='submit_comment' value='Inserir'>";
                            }
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Nenhum cliente encontrado</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function searchClients() {
            var input, filter, table, tr, tdNome, tdCpf, i, txtValueNome, txtValueCpf;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("clientTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                tdNome = tr[i].getElementsByTagName("td")[0]; // Nome
                tdCpf = tr[i].getElementsByTagName("td")[1]; // CPF
                if (tdNome || tdCpf) {
                    txtValueNome = tdNome.textContent || tdNome.innerText;
                    txtValueCpf = tdCpf.textContent || tdCpf.innerText;
                    if (txtValueNome.toUpperCase().indexOf(filter) > -1 || txtValueCpf.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>