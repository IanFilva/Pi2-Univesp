<?php
// Endereçamento do XAMPP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DistUrande_bd";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Checa se o form foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario = $_POST["usuario"];
  $senha = $_POST["senha"];
  
  // Query para checar se o usuario e senha estão corretos
  $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND senha='$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Sucesso no login
    header ("Location:pag-inicial.php");
    exit();
} else {
    // Falha no login
    echo "<div style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);'>";
    echo "<div style='font-size: 20px; font-family: sans-serif;'>";
    echo "<span style='font-weight: bold;'>Usuário ou senha inválidos!</span> " . $conn->error . " <a href='index.php' style='text-decoration: none; color: blue;'>Clique aqui para retornar à página e tentar novamente.</a>";
    echo "</div></div>";

}




}

$conn->close();
?>
