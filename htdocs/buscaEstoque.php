<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos em Estoque</title>

    <style>
       
        header {
            background-color: #007BFF; 
            color: white;
            text-align: left; 
            padding: 20px 30px; 
            font-size: 24px; 
            font-family: sans-serif;
            font-weight: bold;
            width: 100%; 
            position: fixed; 
            top: 0; 
            left: 0; 
            z-index: 10; 
        }

        
        .container {
            max-width: 900px;
            margin: 80px auto 0;  
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: sans-serif;
        }

        
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

        
        .button-container {
            display: flex; 
            gap: 10px; 
        }

        
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px; 
        }

        #searchInput {
            flex: 1;
            margin-right: 10px; 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
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
    <header>
    Aquatrack - Distribuidora Klarina
    </header>

    <a href="pag-inicial.php">
    <img src="logoSBG.png" alt="Página Inicial" class="home-image">
</a>
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
                    $dbname = "disturande_bd"; 

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    
                    $sql = "SELECT produto, quantidade, preco, data_entrada, fornecedor, descricao FROM estoque"; // Altere para o nome da tabela correta
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        
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
                td = tr[i].getElementsByTagName("td")[0]; 
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
