<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disturande_bd";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $_POST["produto"];
    $quantidadeComprada = $_POST["quantidade"];

    // Obtém a quantidade atual do produto
    $sql = "SELECT quantidade FROM itens WHERE produto='$produto'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantidadeAtual = $row["quantidade"];

        // Atualiza a quantidade do produto
        $novaQuantidade = $quantidadeAtual + $quantidadeComprada;
        $updateSql = "UPDATE itens SET quantidade=$novaQuantidade WHERE produto='$produto'";

        if ($conn->query($updateSql) === TRUE) {
            echo "<div>Compra registrada com sucesso! Nova quantidade de $produto: $novaQuantidade</div>";
        } else {
            echo "Erro ao atualizar quantidade: " . $conn->error;
        }
    } else {
        echo "<div>Produto não encontrado!</div>";
    }
}

// SQL query para selecionar produtos
$sql = "SELECT produto, quantidade FROM itens";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar Compras</h2>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade Disponível</th>
                    <th>Registrar Compra</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output de dados de cada linha
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["produto"] . "</td>";
                        echo "<td>" . $row["quantidade"] . "</td>";
                        echo '<td><button onclick="registerPurchase(\'' . $row["produto"] . '\', ' . $row["quantidade"] . ')">Comprar</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="purchaseModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background-color:white; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.5); z-index:1000;">
        <h3>Registrar Compra</h3>
        <form id="purchaseForm" method="POST" action="">
            <input type="hidden" name="produto" id="modalProduto" value="">
            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="modalQuantidade" min="1" required>
            <button type="submit">Registrar Compra</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </div>

    <script>
        function registerPurchase(produto, quantidade) {
            document.getElementById("modalProduto").value = produto;
            document.getElementById("modalQuantidade").setAttribute("max", 100); // Limite de quantidade para compra
            document.getElementById("purchaseModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("purchaseModal").style.display = "none";
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>