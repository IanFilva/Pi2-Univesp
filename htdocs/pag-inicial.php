<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urande Distribuidora</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Importando Font Awesome -->
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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
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
            margin-top: 80px; 
            padding: 20px;
            text-align: center;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
            margin: 10px 0;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .button i {
            margin-right: 10px;
        }

        .desconnect-button {
            background-color: transparent;
            color: #007bff;
            font-size: 16px;
            font-weight: normal;
            text-decoration: underline;
            border: none;
            cursor: pointer;
        }

        .desconnect-button:hover {
            color: #0056b3;
        }

        
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: center;
            }

            nav a {
                margin: 10px 0;
            }

            .card {
                width: 90%;
            }
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
    <img src="logoSBG.png" alt="Página Inicial" class="home-image">
</nav>


<div class="container">
    <div class="card">
        <h2>Bem-vindo à Aquatrack - Distribuidora Klarina</h2>
        <p>Selecione uma das opções abaixo.</p>
        
        <a href="buscaClientes.php" class="button"><i class="fas fa-users"></i> Clientes</a>
        <a href="regVendas.php" class="button"><i class="fas fa-cash-register"></i> Vendas</a>
        <a href="compraEstoque.html" class="button"><i class="fas fa-truck"></i> Compras</a>
        <a href="buscaEstoque.php" class="button"><i class="fas fa-boxes"></i> Estoque</a>
        
        <button class="desconnect-button" onclick="window.location.href='index.php';">Desconectar</button>
    </div>
</div>

</body>
</html>