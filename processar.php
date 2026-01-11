<?php
require_once 'config.php';

$recurso_id   = $_POST['recurso_id'];
$nome_cliente = $_POST['nome_cliente'];
$email_cliente = $_POST['email_cliente'];
$data_reserva = $_POST['data_reserva'];
$hora_inicio  = $_POST['hora_inicio'];
$num_pessoas  = $_POST['num_pessoas']; // Novo campo

// 1. Calcular hora de fim (2 horas depois)
$hora_fim = date('H:i:s', strtotime($hora_inicio . ' +2 hours'));

// 2. VERIFICAÇÃO DE LOTAÇÃO (O que faltava)
// Contamos quantas reservas já existem para este restaurante na mesma data e hora
$check_sql = "SELECT COUNT(*) as total FROM reservas 
              WHERE recurso_id = '$recurso_id' 
              AND data_reserva = '$data_reserva' 
              AND (
                ('$hora_inicio' >= hora_inicio AND '$hora_inicio' < hora_fim) OR 
                ('$hora_fim' > hora_inicio AND '$hora_fim' <= hora_fim)
              )";

$resultado = $conn->query($check_sql);
$contagem = $resultado->fetch_assoc();

// 3. Obter o limite do restaurante
$limite_sql = "SELECT lotacao_maxima FROM recursos WHERE id = '$recurso_id'";
$limite_res = $conn->query($limite_sql)->fetch_assoc();

if ($contagem['total'] >= $limite_res['lotacao_maxima']) {
    // Se atingiu o limite, volta com erro
    header("Location: index.php?erro=lotacao_cheia");
    exit();
}

// 4. Se houver vaga, criar ou identificar o cliente
$conn->query("INSERT IGNORE INTO clientes (nome, email) VALUES ('$nome_cliente', '$email_cliente')");
$cliente_id = $conn->insert_id ?: $conn->query("SELECT id FROM clientes WHERE email='$email_cliente'")->fetch_assoc()['id'];

// 5. Inserir a reserva
$sql = "INSERT INTO reservas (recurso_id, cliente_id, data_reserva, hora_inicio, hora_fim, num_pessoas) 
        VALUES ('$recurso_id', '$cliente_id', '$data_reserva', '$hora_inicio', '$hora_fim', '$num_pessoas')";

if ($conn->query($sql)) {
    header("Location: index.php?sucesso=1");
} else {
    echo "Erro: " . $conn->error;
}
?>