<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            padding: 0;
        }

     
        nav {
            background-color: #007bff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1000;
        }

        nav h1 {
            color: white;
            font-size: 26px;
            font-weight: bold;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin-left: 20px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffcc00;
        }

       
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 80px; 
        }

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        
        #searchInput {
            flex: 1;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        
        .register-button, .home-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 10px;
        }

        .register-button:hover, .home-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #e60000;
        }

      
        .comment-box {
            width: 200px;
            height: auto;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 8px;
            border-radius: 5px;
        }

        .button-container {
            margin-top: 10px;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        
        .home-image {
            position: fixed;
            top: 100px; 
            left: 20px;
            width: 150px;
            height: 150px;
            cursor: pointer;
            z-index: 999;
        }

    </style>
</head>
<body>

<nav>
    <h1>Aquatrack - Distribuidora Klarina</h1>
</nav>


<a href="pag-inicial.php">
    <img src="logoSBG.png" alt="Página Inicial" class="home-image">
</a>

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

                /* Função de comentários */
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

                /* Função para deletar comentários */
                if(isset($_POST['delete_comment'])){
                    $cpf = $_POST['cpf'];
                    $sql_delete_comment = "UPDATE regclientes SET comentarios=NULL WHERE cpf='$cpf'";
                    if ($conn->query($sql_delete_comment) === TRUE) {
                        echo "<script>alert('Comentário excluído com sucesso!');</script>";
                    } else {
                        echo "Erro ao excluir comentário: " . $conn->error;
                    }
                }

                /* SQL query para selecionar clientes e os comentários */
                $sql = "SELECT nome, cpf, telefone, endereco, tipoPag, comentarios FROM regclientes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
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
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("clientTable");
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            if (td) {
                txtValue = "";
                for (var j = 0; j < td.length; j++) {
                    txtValue += td[j].textContent || td[j].innerText;
                }
               
