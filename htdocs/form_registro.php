<?php
/* Endereçamento do XAMPP */
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

/* Formulário que recupera os dados do BD */
$name = $_POST["nome"];
$cpf = $_POST["cpf"];
$phone = $_POST["telefone"];
$endereco = $_POST["endereco"]; 
$tipoPag = $_POST["tipoPag"];

/* Insere dados no BD */
$sql = "INSERT INTO regclientes (nome, cpf, telefone, endereco, tipoPag) 
        VALUES ('$name', '$cpf', '$phone', '$endereco', '$tipoPag')"; 

if ($conn->query($sql) === TRUE) {
    /* Feedback de registro sucedido */
    echo "<div style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);'>";
    echo "<div style='font-size: 20px; font-family: sans-serif;'>";
    echo "<span style='font-weight: bold;'>Cliente registrado com sucesso!</span> <a href='regCliente.html' style='text-decoration: none; color: blue;'>Clique aqui para retornar à página de registros.</a>";
    echo "</div></div>";
} else {
    /* Feedback de erro ao registrar */
    echo "Erro ao registrar cliente: " . $conn->error . " <a href='pag-inicial.php'>Voltar para a página anterior</a>";
}

$conn->close();
?>