<?php
require_once 'config.php';
session_start();

// Segurança: Só apaga se for admin
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM reservas WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=removido");
    }
} else {
    die("Erro: Não tens permissão.");
}
?>