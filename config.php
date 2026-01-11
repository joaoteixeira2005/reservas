<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sistema_reservas";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

// Definir charset para evitar problemas com acentos (PT-PT)
$conn->set_charset("utf8mb4");
?>