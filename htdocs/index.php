<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
       
        body {
            background-color: #FFFFFF; 
        }

      
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
            max-width: 400px;
            margin: 100px auto 0;
            padding: 20px;
            background-color: #f9f9f9; 
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-family: sans-serif;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: sans-serif;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            font-size: large;
            font-weight: bold;
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
    <img src="logoSBG.png" alt="Página Inicial" class="home-image">
    </header>

    <div class="container">
        <h2>Formulário de Login</h2>
        <form class="login-form" action="testLogphp.php" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" name="usuario" placeholder="Usuário" required>
            <label for="password">Senha:</label>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>