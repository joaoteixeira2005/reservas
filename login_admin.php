<?php
session_start();
// Ativamos as variáveis de sessão que o teu index.php está à espera
$_SESSION['user_role'] = 'admin';
$_SESSION['user_nome'] = 'Admin Principal';

echo "Modo Admin Ativado! A redirecionar...";
header("Refresh: 2; url=index.php");
?>