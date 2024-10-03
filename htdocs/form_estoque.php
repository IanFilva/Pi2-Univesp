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

/* Recuperando dados do formulário */
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$preco = $_POST['preco'];
$data_entrada = $_POST['data_entrada'];
$fornecedor = $_POST['fornecedor'];
$descricao = $_POST['descricao'];

/* SQL para inserir os dados na tabela estoque */
$sql = "INSERT INTO estoque (produto, quantidade, preco, data_entrada, fornecedor, descricao) 
VALUES ('$produto', $quantidade, $preco, '$data_entrada', '$fornecedor', '$descricao')";

if ($conn->query($sql) === TRUE) {
    /* Feedback de registro sucedido */
    echo "<div style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);'>";
    echo "<div style='font-size: 20px; font-family: sans-serif;'>";
    echo "<span style='font-weight: bold;'>Produto adicionado com sucesso!</span> <a href='compraEstoque.html' style='text-decoration: none; color: blue;'>Clique aqui para adicionar outro produto.</a>";
    echo "</div></div>";
} else {
    /* Feedback de erro ao registrar */
    echo "<div style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);'>";
    echo "<div style='font-size: 20px; font-family: sans-serif;'>";
    echo "<span style='font-weight: bold;'>Erro ao adicionar produto:</span> " . $conn->error . " <a href='estoque.html' style='text-decoration: none; color: blue;'>Voltar para a página anterior</a>";
    echo "</div></div>";
}

$conn->close();
?>