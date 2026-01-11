<?php 
require_once 'config.php'; 
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.php"); exit();
}

// 1. Query: Reservas por Restaurante
$res_recursos = $conn->query("SELECT rec.nome, COUNT(r.id) as total 
                             FROM recursos rec 
                             LEFT JOIN reservas r ON rec.id = r.recurso_id 
                             GROUP BY rec.id");
$labels = []; $data = [];
while($row = $res_recursos->fetch_assoc()){
    $labels[] = $row['nome'];
    $data[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Estatísticas | Admin Gourmet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #1a1a1a; color: white; font-family: 'Poppins', sans-serif; }
        .card-stat { background: #242424; border: 1px solid #333; border-radius: 15px; padding: 25px; }
        .btn-gold { background: #d4af37; color: black; font-weight: bold; border-radius: 50px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1>📊 Análise de Performance</h1>
            <a href="index.php" class="btn btn-gold px-4">Voltar ao Painel</a>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="card-stat">
                    <h5 class="mb-4">Popularidade por Localização</h5>
                    <canvas id="chartRestaurantes"></canvas>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card-stat mb-4">
                    <h6>Total de Reservas</h6>
                    <h2 class="text-warning">
                        <?= $conn->query("SELECT COUNT(*) FROM reservas")->fetch_row()[0]; ?>
                    </h2>
                </div>
                <div class="card-stat">
                    <h6>Clientes Únicos</h6>
                    <h2 class="text-info">
                        <?= $conn->query("SELECT COUNT(*) FROM clientes")->fetch_row()[0]; ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartRestaurantes').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Número de Reservas',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: '#d4af37',
                    borderRadius: 10
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, grid: { color: '#333' }, ticks: { color: '#fff' } },
                    x: { ticks: { color: '#fff' } }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>
</body>
</html>