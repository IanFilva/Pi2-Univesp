<!DOCTYPE html>
<html lang="pt-br">
<head>
    <style>

          header {
            background-color: #007BFF; /* Azul */
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 24px;
            font-family: sans-serif;
            font-weight: bold;
        }
        /* Estilos para os botões */
        .container {
            text-align: center;
            margin: 100px auto 50px; 
            background-color: #f2f2f2;
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
            border: 2px solid transparent;
            max-width: 400px;
            font-family: sans-serif; 
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            font-weight: bold;
            font-size: large;
            background-color: #007BFF; /* Nova cor */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin: 10px 5px; 
        }

        .button:hover {
            background-color: #0056b3; /* Cor ao passar o mouse */
        }

        .desconnect-button {
            background-color: transparent; /* Fundo transparente */
            border: none; /* Remove a borda */
            color: #007BFF; /* Cor azul */
            text-decoration: underline; /* Texto sublinhado */
            font-size: large; /* Tamanho da fonte */
            cursor: pointer; /* Cursor em forma de ponteiro */
            text-align: center; /* Centraliza o texto */
            margin-top: 10px; /* Espaçamento superior */
        }
    </style>
</head>
<body>
<header>
        Urande Distribuidora
    </header>
    <div class="container">
        <a href="buscaClientes.php" class="button">Clientes</a>
        <a href="regVendas.php" class="button">Vendas</a>
        <a href="compraEstoque.html" class="button">Compras</a>
        <a href="buscaEstoque.php" class="button">Estoque</a>
        <a href="index.php">
            <button type="button" class="desconnect-button">Desconectar</button>
        </a>
    </div>
    
</body>
</html>