<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Estilos para o fundo da página */
        body {
            background-color: #FFFFFF; 
        }

        /* Estilos para o cabeçalho */
        header {
            background-color: #007BFF; /* Azul */
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 24px;
            font-family: sans-serif;
            font-weight: bold;
        }

        /* Estilos para o formulário */
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
            background-color: #b34800e5;
        }
    </style>
</head>
<body>

    <header>
        Urande Distribuidora
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