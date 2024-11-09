<?php
/* Configurações de conexão com o banco de dados */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disturande_bd";

/* Criando a conexão */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Checa a conexão */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* Inicializa variáveis para mensagens de sucesso e erro */
$success = "";
$error = "";

/* Verifica se o formulário foi enviado */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $_POST["produto"];
    $quantidade = intval($_POST["quantidade"]);
    $preco = floatval($_POST["preco"]);
    $cliente = trim($_POST["cliente"]);
    $tipoPag = $_POST["tipoPag"];

    /* Validação dos dados */
    if (empty($produto) || $quantidade <= 0 || $preco < 0 || empty($cliente)) {
        $error = "Dados inválidos. Por favor, verifique as informações inseridas.";
    } else {
        /* Insere os dados na tabela vendas */
        $stmt = $conn->prepare("INSERT INTO vendas (produto, quantidade, preco, cliente, tipoPag) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sidss", $produto, $quantidade, $preco, $cliente, $tipoPag);

        if ($stmt->execute()) {
            $success = "Venda registrada com sucesso!";
            /* Limpar os campos após a inserção */
            $produto = $quantidade = $preco = $cliente = $tipoPag = '';
        } else {
            $error = "Erro ao registrar venda: " . $stmt->error;
        }

        $stmt->close();
    }
}

/* Consulta para obter produtos do estoque */
$produtos = [];
$result = $conn->query("SELECT produto FROM estoque");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row['produto'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vendas</title>
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


        
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        
        .container {
            max-width: 600px;
            margin: 80px auto 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
        h1 {
            text-align: center;
            font-family: sans-serif;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000000;
        }

        
        form {
            display: grid;
            gap: 10px;
        }

        label {
            font-family: sans-serif;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007BFF; 
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            font-size: large;
        }

        button:hover {
            background-color: #0056b3;
        }

        
        .message {
            color: red;
        }
        .success {
            color: green;
        }

        
        .button-container {
            margin-top: 20px;
        }
        .link-button {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #007BFF; 
            color: white;
            text-decoration: none;
            border-radius: 5px; 
            margin-bottom: 10px;
        }
        .link-button:hover {
            background-color: #0056b3;
        }
        .return-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: blue;
            text-decoration: underline; 
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
        <h1>Registrar Vendas</h1>

        <?php if ($error): ?>
            <div class="message"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="produto">Produto:</label>
            <select id="produto" name="produto" required>
                <option value="">Selecione um produto</option>
                <?php foreach ($produtos as $prod): ?>
                    <option value="<?= htmlspecialchars($prod) ?>"><?= htmlspecialchars($prod) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" min="1" required>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" min="0" step="0.01" required>

            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente" required>

            <label for="tipoPag">Tipo de Pagamento:</label>
            <select id="tipoPag" name="tipoPag" required>
                <option value="dinheiro">Dinheiro</option>
                <option value="cartão de crédito">Cartão de Crédito</option>
                <option value="cartão de débito">Cartão de Débito</option>
                <option value="transferência">Transferência</option>
                <option value="pix">Pix</option>
            </select>

            <button type="submit">Registrar Venda</button>
        </form>

        <div class="button-container">
            <a href="buscaVendas.php" class="link-button">Ver Registro de Vendas</a>
            <a href="pag-inicial.php" class="return-link">Retornar</a>
        </div>
    </div>
</body>
</html>
