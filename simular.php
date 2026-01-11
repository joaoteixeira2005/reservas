<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';

echo "<h2>🚀 Restaurando Sistema e Gerando Dados...</h2>";

// 1. Limpeza Profunda
$conn->query("SET FOREIGN_KEY_CHECKS = 0;");
$conn->query("DROP TABLE IF EXISTS reservas, recursos, clientes;");

// 2. Criação das Tabelas
$conn->query("CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE
);");

$conn->query("CREATE TABLE recursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    lotacao_maxima INT DEFAULT 5
);");

$conn->query("CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recurso_id INT,
    cliente_id INT,
    data_reserva DATE,
    hora_inicio TIME,
    hora_fim TIME,
    num_pessoas INT,
    FOREIGN KEY (recurso_id) REFERENCES recursos(id),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);");

// 3. Inserir Restaurantes
$conn->query("INSERT INTO recursos (id, nome, lotacao_maxima) VALUES 
(1, 'Porto: Douro Sky Lounge', 5),
(2, 'Porto: Ribeira Vintage', 4),
(3, 'Lisboa: Chiado Elegance', 8),
(4, 'Lisboa: Alfama Terrace', 6);");

// 4. Gerar Dados Aleatórios
$nomes = ['Ricardo', 'Ana', 'Pedro', 'Sofia', 'Miguel', 'Beatriz', 'Joao', 'Maria'];
$horas = ['12:30', '13:00', '19:00', '20:30', '21:00'];

for ($i = 0; $i < 20; $i++) {
    $nome = $nomes[array_rand($nomes)];
    $email = "cliente".rand(1,500)."@gmail.com";
    $data = date('Y-m-d', strtotime('+' . rand(-2, 5) . ' days'));
    $hora = $horas[array_rand($horas)];
    $hora_fim = date('H:i:s', strtotime($hora . ' +2 hours'));
    $rec_id = rand(1, 4);

    // Inserir Cliente
    $conn->query("INSERT IGNORE INTO clientes (nome, email) VALUES ('$nome', '$email')");
    $c_id = $conn->insert_id ?: $i + 1;

    // Inserir Reserva
    $res = $conn->query("INSERT INTO reservas (recurso_id, cliente_id, data_reserva, hora_inicio, hora_fim, num_pessoas) 
                         VALUES ($rec_id, $c_id, '$data', '$hora', '$hora_fim', ".rand(2,6).")");
    
    if($res) echo "✅ Criada reserva para $nome em $data <br>";
    else echo "❌ Erro: " . $conn->error . "<br>";
}

$conn->query("SET FOREIGN_KEY_CHECKS = 1;");
echo "<br><b>Tudo pronto!</b> Já podes ir ao <a href='estatisticas.php'>Gráfico de Estatísticas</a>.";
?>