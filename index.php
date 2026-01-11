<?php 
require_once 'config.php'; 
session_start();

// Lógica de Admin e Proteção de Dados
$isAdmin = (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin');

// Filtro de data (Público e Admin podem ver outros dias)
$data_filtro = isset($_GET['data_ver']) ? $_GET['data_ver'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Gourmet | SGFP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --gold: #d4af37; --dark: #1a1a1a; --light-bg: #fdfaf6; }
        body { font-family: 'Poppins', sans-serif; background: var(--light-bg); color: #333; }
        h1, h2, h3, .sidebar h4 { font-family: 'Playfair Display', serif; }
        
        /* Layout Admin */
        .sidebar { height: 100vh; background: var(--dark); color: white; position: fixed; width: 260px; padding-top: 20px; transition: 0.3s; z-index: 1000; }
        .sidebar a { color: var(--gold); text-decoration: none; padding: 15px 25px; display: block; border-left: 3px solid transparent; }
        .sidebar a:hover { background: #222; border-left: 3px solid var(--gold); }
        .main-content { margin-left: <?= $isAdmin ? '260px' : '0' ?>; transition: 0.3s; }

        /* Estilo Restaurante */
        .hero { 
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover; background-position: center; padding: 80px 0; color: white; text-align: center; margin-bottom: -40px;
        }
        .card-booking { border: none; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-top: 5px solid var(--gold); }
        .btn-reserve { background: var(--gold); color: white; border-radius: 50px; padding: 12px; font-weight: 600; border: none; transition: 0.4s; }
        .btn-reserve:hover { background: #b8962d; transform: scale(1.02); color: white; }
        
        /* Estilo para Impressão */
        @media print {
            .sidebar, .hero, .card-booking, .btn, form { display: none !important; }
            .main-content { margin-left: 0 !important; }
        }

        @media (max-width: 768px) { .sidebar { width: 100%; height: auto; position: relative; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>

    <?php if ($isAdmin): ?>
    <div class="sidebar shadow">
        <div class="px-4 mb-4 text-center"><h4 class="text-white">SGFP Admin</h4></div>
        <a href="index.php">🏠 Dashboard</a>
        <a href="estatisticas.php">📊 Estatísticas de Pico</a> 
        <a href="logout.php">🚪 Terminar Sessão</a>
    </div>
    <?php endif; ?>

    <div class="main-content">
        <div class="container pt-4">
            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success border-0 shadow-sm">
                    <strong>Sucesso:</strong> A sua reserva foi confirmada.
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['erro']) && $_GET['erro'] == 'lotacao_cheia'): ?>
                <div class="alert alert-danger border-0 shadow-sm">
                    <strong>Indisponível:</strong> Lotação máxima atingida para este horário.
                </div>
            <?php endif; ?>
        </div>

        <section class="hero">
            <div class="container">
                <h1 class="display-3">Experiência Gastronómica</h1>
                <p class="lead">Reserve a sua mesa nos locais mais exclusivos de Lisboa e Porto</p>
            </div>
        </section>

        <div class="container mt-5 py-5">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="card card-booking p-4">
                        <h3 class="mb-4 text-center">Fazer Reserva</h3>
                        <form action="processar.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Restaurante</label>
                                <select name="recurso_id" class="form-select bg-light border-0 p-3" required>
                                    <?php
                                    $recursos = $conn->query("SELECT * FROM recursos ORDER BY nome ASC");
                                    while($r = $recursos->fetch_assoc()) echo "<option value='{$r['id']}'>{$r['nome']}</option>";
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Nº de Pessoas</label>
                                <input type="number" name="num_pessoas" class="form-control bg-light border-0 p-3" min="1" max="20" value="2" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Nome do Cliente</label>
                                <input type="text" name="nome_cliente" class="form-control bg-light border-0 p-3" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">E-mail</label>
                                <input type="email" name="email_cliente" class="form-control bg-light border-0 p-3" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold small">Data</label>
                                    <input type="date" name="data_reserva" id="data_reserva" class="form-control bg-light border-0 p-3" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold small">Hora</label>
                                    <input type="time" name="hora_inicio" id="hora_inicio" class="form-control bg-light border-0 p-3" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-reserve w-100 shadow mt-3">CONFIRMAR MARCAÇÃO</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card p-4 shadow-sm border-0 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="m-0">Disponibilidade</h4>
                            <form method="GET" class="d-flex gap-2">
                                <input type="date" name="data_ver" class="form-control form-control-sm" value="<?= $data_filtro ?>" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Restaurante</th>
                                        <th>Janela</th>
                                        <?php if ($isAdmin): ?> <th>Gestão</th> <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT r.*, rec.nome as sala, c.nome as cliente 
                                            FROM reservas r 
                                            JOIN recursos rec ON r.recurso_id = rec.id 
                                            JOIN clientes c ON r.cliente_id = c.id
                                            WHERE r.data_reserva = '$data_filtro' ORDER BY r.hora_inicio ASC";
                                    $res = $conn->query($sql);
                                    if ($res && $res->num_rows > 0) {
                                        while($row = $res->fetch_assoc()) {
                                            $concluido = ($row['status_presenca'] == 'Concluído');
                                            echo "<tr class='".($concluido ? 'text-muted table-light' : '')."'>
                                                <td class='fw-bold'>{$row['sala']}</td>
                                                <td>{$row['hora_inicio']} - {$row['hora_fim']}</td>";
                                            if ($isAdmin) {
                                                echo "<td>
                                                        <div class='btn-group'>
                                                            <a href='checkin.php?id={$row['id']}&data_ver=$data_filtro' class='btn btn-sm btn-outline-success'>Check-in</a>
                                                            <a href='cancelar.php?id={$row['id']}' class='btn btn-sm btn-outline-danger'>Remover</a>
                                                        </div>
                                                      </td>";
                                            }
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center py-4 text-muted'>Livre para marcações.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dataInp = document.getElementById('data_reserva');
        const horaInp = document.getElementById('hora_inicio');
        function limitarHora() {
            const hoje = new Date().toISOString().split('T')[0];
            if (dataInp.value === hoje) {
                const agora = new Date();
                horaInp.min = agora.getHours().toString().padStart(2,'0') + ":" + agora.getMinutes().toString().padStart(2,'0');
            } else { horaInp.removeAttribute('min'); }
        }
        dataInp.addEventListener('change', limitarHora);
        window.onload = limitarHora;
    </script>
</body>
</html>