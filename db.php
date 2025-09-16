<?php
// Conexão MySQL básica
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soundhub";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
