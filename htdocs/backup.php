<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos em Estoque</title>

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
        <h1>Lista de Produtos em Estoque</h1>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchProducts()" placeholder="Buscar por Produto...">
            <div class="button-container">
                <a href="compraEstoque.html">
                    <button class="register-button">Ir para compras</button>
                </a>
                <a href="pag-inicial.php">
                    <button class="home-button">Página Inicial</button>
                </a>
            </div>
        </div>
        <table id="productTable">
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Última Entrada</th>
                    <th>Fornecedor</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "disturande_bd"; // Nome do banco de dados

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query para selecionar os produtos do estoque
                    $sql = "SELECT produto, quantidade, preco, data_entrada, fornecedor, descricao FROM estoque"; // Altere para o nome da tabela correta
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output de dados de cada linha
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["produto"] . "</td>";
                            echo "<td>" . $row["quantidade"] . "</td>";
                            echo "<td>R$ " . number_format($row["preco"], 2, ',', '.') . "</td>";
                            echo "<td>" . $row["data_entrada"] . "</td>";
                            echo "<td>" . $row["fornecedor"] . "</td>";
                            echo "<td>" . $row["descricao"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function searchProducts() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("productTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Nome do Produto
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
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