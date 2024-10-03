<?php
/* Configurações de conexão com o banco de dados */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disturande_bd"; // Nome do seu banco de dados

/* Criando a conexão */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Checa a conexão */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* SQL query para selecionar os dados da tabela vendas */
$sql = "SELECT id, produto, preco, quantidade, dataVenda FROM vendas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>

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

        /* Estilos pro container do botão */
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
    </style>
</head>
<body>
    <header>
        Urande Distribuidora
    </header>
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
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Data da Venda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["produto"] . "</td>";
                        echo "<td>R$ " . number_format($row["preco"], 2, ',', '.') . "</td>";
                        echo "<td>" . $row["quantidade"] . "</td>";
                        echo "<td>" . date('d/m/Y H:i:s', strtotime($row["dataVenda"])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma venda encontrada</td></tr>";
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
