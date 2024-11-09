<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disturande_bd"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, produto, preco, quantidade, dataVenda, cliente, tipoPag FROM vendas"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>

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

        
        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        
        .price {
            text-align: right;
        }

        
        .button-container {
            margin-top: 20px;
            text-align: right;
        }

        .register-button, .home-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 10px;
        }

        .register-button:hover, .home-button:hover {
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
        <h1 style="display: inline;">Lista de Vendas</h1>
        <div class="button-container">
            <a href="regVendas.php">
                <button class="register-button">Registrar Venda</button>
            </a>
            <a href="pag-inicial.php">
                <button class="home-button">Ir para Página Inicial</button>
            </a>
        </div>
        <table id="salesTable">
            <thead>
                <tr>
                    <th class="center">ID</th>
                    <th>Produto</th>
                    <th class="price">Preço</th>
                    <th class="center">Quantidade</th>
                    <th class="center">Data da Venda</th>
                    <th>Cliente</th>
                    <th>Tipo de Pagamento</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='center'>" . $row["id"] . "</td>";
                        echo "<td>" . $row["produto"] . "</td>";
                        echo "<td class='price'>R$ " . number_format($row["preco"], 2, ',', '.') . "</td>";
                        echo "<td class='center'>" . $row["quantidade"] . "</td>";
                        echo "<td class='center'>" . date('d/m/Y H:i:s', strtotime($row["dataVenda"])) . "</td>";
                        echo "<td>" . $row["cliente"] . "</td>";
                        echo "<td>" . $row["tipoPag"] . "</td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='center'>Nenhuma venda encontrada</td></tr>"; 
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>
