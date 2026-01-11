<?php
require_once 'config.php';
session_start();

// Proteção: apenas admin pode fazer check-in
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $data_ver = $_GET['data_ver'];

    // Atualiza o estado para Concluído
    $sql = "UPDATE reservas SET status_presenca = 'Concluído' WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: index.php?data_ver=$data_ver&msg=checkin_ok");
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>