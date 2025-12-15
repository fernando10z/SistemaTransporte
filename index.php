<?php 
// Esto debe ser lo PRIMERO en el archivo
require_once 'conexion/conexion.php';
session_start();

// Verificar si el usuario está logueado, si no, redirigir a login
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

include('layout/sidebar.php');

// Obtener datos para el dashboard
try {
    // 1. Estadísticas generales
    $stmt = $conn->query("SELECT COUNT(*) as total_conductores FROM conductores WHERE estado = 'Activo'");
    $conductores_activos = $stmt->fetch()['total_conductores'];
    
    $stmt = $conn->query("SELECT COUNT(*) as total_vehiculos FROM vehiculos WHERE estado = 'Disponible'");
    $vehiculos_disponibles = $stmt->fetch()['total_vehiculos'];
    
    $stmt = $conn->query("SELECT COUNT(*) as total_solicitudes FROM solicitudes_clientes WHERE estado = 'Pendiente'");
    $solicitudes_pendientes = $stmt->fetch()['total_solicitudes'];
    
    $stmt = $conn->query("SELECT SUM(CASE WHEN tipo = 'Ingreso' THEN monto ELSE 0 END) as ingresos,
                                 SUM(CASE WHEN tipo = 'Egreso' THEN monto ELSE 0 END) as egresos 
                          FROM transacciones_financieras 
                          WHERE estado = 'Activo' AND YEAR(fecha) = YEAR(CURDATE())");
    $finanzas = $stmt->fetch();
    $ingresos_anuales = $finanzas['ingresos'] ?? 0;
    $egresos_anuales = $finanzas['egresos'] ?? 0;
    
} catch(PDOException $e) {
    $conductores_activos = 0;
    $vehiculos_disponibles = 0;
    $solicitudes_pendientes = 0;
    $ingresos_anuales = 0;
    $egresos_anuales = 0;
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | <?php echo htmlspecialchars($nombre_empresa); ?></title>
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="configuracion/empresa/<?php echo $logo_path; ?>" />
  <style>
    :root {
      --text-primary: #1E293B;
      --text-secondary: #64748B;
      --text-tertiary: #94A3B8;
      --border-color: #E2E8F0;
      --bg-white: #FFFFFF;
      --bg-light: #F8FAFC;
      --bg-cream: #F9FAFB;
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
      --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
      --radius: 12px;
      --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .filter-section {
      background: var(--bg-white);
      padding: 24px;
      border-radius: var(--radius);
      border: 1px solid var(--border-color);
      margin-bottom: 32px;
      box-shadow: var(--shadow-sm);
    }

    .filter-section h5 {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-section .form-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 8px;
    }

    .filter-section .form-select,
    .filter-section .form-control {
      border: 1.5px solid var(--border-color);
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 14px;
      color: var(--text-primary);
      transition: var(--transition);
    }

    .filter-section .form-select:focus,
    .filter-section .form-control:focus {
      border-color: var(--text-secondary);
      box-shadow: 0 0 0 4px rgba(100, 116, 139, 0.1);
    }

    .filter-section .btn-primary {
      background: var(--text-primary);
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 600;
      transition: var(--transition);
    }

    .filter-section .btn-primary:hover {
      background: var(--text-secondary);
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    .metric-card {
      background: var(--bg-white);
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      padding: 24px;
      margin-bottom: 24px;
      transition: var(--transition);
      box-shadow: var(--shadow-sm);
      position: relative;
      overflow: hidden;
    }

    .metric-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      transition: var(--transition);
    }

    .metric-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-color: var(--text-tertiary);
    }

    .metric-card.primary::before {
      background: #5B5FC7;
    }

    .metric-card.success::before {
      background: #059669;
    }

    .metric-card.warning::before {
      background: #D97706;
    }

    .metric-card.info::before {
      background: #0891B2;
    }

    .metric-card h3 {
      font-size: 32px;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 4px;
      letter-spacing: -0.02em;
    }

    .metric-card p {
      font-size: 14px;
      color: var(--text-secondary);
      margin-bottom: 0;
      font-weight: 500;
    }

    .metric-card .icon-box {
      width: 48px;
      height: 48px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      opacity: 0.8;
    }

    .metric-card.primary .icon-box {
      background: #EEF2FF;
      color: #5B5FC7;
    }

    .metric-card.success .icon-box {
      background: #D1FAE5;
      color: #059669;
    }

    .metric-card.warning .icon-box {
      background: #FEF3C7;
      color: #D97706;
    }

    .metric-card.info .icon-box {
      background: #E0F2FE;
      color: #0891B2;
    }

    .dashboard-card {
      background: var(--bg-white);
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
      margin-bottom: 24px;
    }

    .dashboard-card:hover {
      box-shadow: var(--shadow-md);
    }

    .dashboard-card .card-body {
      padding: 24px;
    }

    .dashboard-card .card-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .badge {
      font-size: 12px;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 6px;
    }

    .badge.bg-primary {
      background: #ffffffff !important;
      color: #5B5FC7 !important;
    }

    .badge.bg-success {
      background: #D1FAE5 !important;
      color: #059669 !important;
    }

    .badge.bg-danger {
      background: #FEE2E2 !important;
      color: #DC2626 !important;
    }

    .badge.bg-secondary {
      background: #F1F5F9 !important;
      color: #64748B !important;
    }

    .chart-container {
      position: relative;
      height: 400px;
      width: 100%;
    }

    .small-chart {
      height: 300px;
    }

    .table {
      font-size: 14px;
      color: var(--text-primary);
    }

    .table thead {
      background: var(--bg-light);
      border: none;
    }

    .table thead th {
      border: none;
      padding: 14px 16px;
      font-weight: 600;
      color: var(--text-secondary);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table tbody td {
      border-bottom: 1px solid var(--border-color);
      padding: 16px;
      vertical-align: middle;
    }

    .table tbody tr:hover {
      background: var(--bg-light);
    }

    .table tbody tr:last-child td {
      border-bottom: none;
    }

    .py-6 {
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .fs-4 {
      font-size: 13px !important;
      color: var(--text-tertiary);
    }

    @media (max-width: 1199px) {
      .body-wrapper {
        margin-left: 0;
      }
    }

    @media (max-width: 768px) {
      .container-fluid {
        padding: 20px;
      }

      .metric-card {
        padding: 20px;
      }

      .metric-card h3 {
        font-size: 28px;
      }

      .chart-container,
      .small-chart {
        height: 300px;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .metric-card,
    .dashboard-card {
      animation: fadeIn 0.3s ease forwards;
    }

    .metric-card:nth-child(1) { animation-delay: 0.1s; opacity: 0; }
    .metric-card:nth-child(2) { animation-delay: 0.2s; opacity: 0; }
    .metric-card:nth-child(3) { animation-delay: 0.3s; opacity: 0; }
    .metric-card:nth-child(4) { animation-delay: 0.4s; opacity: 0; }
  </style>
</head>

<body>
    <div class="body-wrapper">
        <?php include('layout/header.php')?>
        <div class="container-fluid">
            
            <!-- Filtros -->
            <div class="filter-section">
                <div class="row">
                    <div class="col-md-12">
                        <h5>
                            <i class="ti ti-filter"></i>
                            Filtros de Dashboard
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Año</label>
                                <select class="form-select" id="filtroAnio">
                                    <option value="">Todos los años</option>
                                    <?php for($year = 2020; $year <= date('Y'); $year++): ?>
                                        <option value="<?php echo $year; ?>" <?php echo ($year == date('Y')) ? 'selected' : ''; ?>>
                                            <?php echo $year; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Mes</label>
                                <select class="form-select" id="filtroMes">
                                    <option value="">Todos los meses</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Día</label>
                                <input type="date" class="form-control" id="filtroDia">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-grid">
                                    <button class="btn btn-primary" onclick="aplicarFiltros()">
                                        <i class="ti ti-search me-1"></i>Aplicar Filtros
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métricas principales -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 id="conductoresActivos"><?php echo $conductores_activos; ?></h3>
                                <p>Conductores Activos</p>
                            </div>
                            <div class="icon-box">
                                <i class="ti ti-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 id="vehiculosDisponibles"><?php echo $vehiculos_disponibles; ?></h3>
                                <p>Vehículos Disponibles</p>
                            </div>
                            <div class="icon-box">
                                <i class="ti ti-truck"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 id="solicitudesPendientes"><?php echo $solicitudes_pendientes; ?></h3>
                                <p>Solicitudes Pendientes</p>
                            </div>
                            <div class="icon-box">
                                <i class="ti ti-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card info">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 id="gananciaAnual">S/. <?php echo number_format($ingresos_anuales - $egresos_anuales, 2); ?></h3>
                                <p>Ganancia Anual</p>
                            </div>
                            <div class="icon-box">
                                <i class="ti ti-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos principales -->
            <div class="row">
                <!-- Ingresos vs Egresos -->
                <div class="col-lg-8">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">
                                    <i class="ti ti-chart-bar"></i>
                                    Ingresos vs Egresos
                                </h5>
                                <span class="badge bg-primary" id="periodoFinanzas">Año <?php echo date('Y'); ?></span>
                            </div>
                            <div class="chart-container">
                                <canvas id="chartFinanzas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estados de Solicitudes -->
                <div class="col-lg-4">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ti ti-file-text"></i>
                                Estados de Solicitudes
                            </h5>
                            <div class="chart-container small-chart">
                                <canvas id="chartSolicitudes"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Asistencia de Conductores -->
                <div class="col-lg-6">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ti ti-user-check"></i>
                                Asistencia de Conductores
                            </h5>
                            <div class="chart-container small-chart">
                                <canvas id="chartAsistencia"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estados de Vehículos -->
                <div class="col-lg-6">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ti ti-car"></i>
                                Estados de Vehículos
                            </h5>
                            <div class="chart-container small-chart">
                                <canvas id="chartVehiculos"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de transacciones recientes -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ti ti-history"></i>
                                Transacciones Recientes
                            </h5>
                            <div class="table-responsive">
                                <table class="table" id="tablaTransacciones">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Concepto</th>
                                            <th>Monto</th>
                                            <th>Método</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpoTransacciones">
                                        <!-- Se carga via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-6 text-center">
                <p class="mb-0 fs-4">Dashboard Administrativo - Sistema de Transporte © <?php echo date('Y'); ?></p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="src/assets/js/sidebarmenu.js"></script>
    <script src="src/assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Variables globales para los gráficos
    let chartFinanzas, chartSolicitudes, chartAsistencia, chartVehiculos;

    $(document).ready(function() {
        // Inicializar dashboard
        inicializarDashboard();
        cargarTransaccionesRecientes();
    });

    function inicializarDashboard() {
        // Configurar filtros por defecto
        $('#filtroAnio').val(new Date().getFullYear());
        
        // Cargar todos los gráficos
        cargarDatosFinanzas();
        cargarDatosSolicitudes();
        cargarDatosAsistencia();
        cargarDatosVehiculos();
        cargarMetricasGenerales();
    }

    function aplicarFiltros() {
        const anio = $('#filtroAnio').val();
        const mes = $('#filtroMes').val();
        const dia = $('#filtroDia').val();
        
        // Actualizar todos los gráficos con los filtros
        cargarDatosFinanzas(anio, mes, dia);
        cargarDatosSolicitudes(anio, mes, dia);
        cargarDatosAsistencia(anio, mes, dia);
        cargarMetricasGenerales(anio, mes, dia);
        cargarTransaccionesRecientes(anio, mes, dia);
        
        // Actualizar etiqueta de período
        let periodo = '';
        if (dia) {
            periodo = `Día ${dia}`;
        } else if (mes && anio) {
            periodo = `${obtenerNombreMes(mes)} ${anio}`;
        } else if (anio) {
            periodo = `Año ${anio}`;
        } else {
            periodo = 'Todos los períodos';
        }
        $('#periodoFinanzas').text(periodo);
    }

    function obtenerNombreMes(mes) {
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        return meses[parseInt(mes) - 1];
    }

    function cargarDatosFinanzas(anio = '', mes = '', dia = '') {
        $.ajax({
            url: 'dashboard/obtener_finanzas.php',
            method: 'GET',
            data: { anio, mes, dia },
            dataType: 'json',
            success: function(data) {
                actualizarGraficoFinanzas(data);
            },
            error: function() {
                console.error('Error cargando datos financieros');
            }
        });
    }

    function cargarDatosSolicitudes(anio = '', mes = '', dia = '') {
        $.ajax({
            url: 'dashboard/obtener_solicitudes.php',
            method: 'GET',
            data: { anio, mes, dia },
            dataType: 'json',
            success: function(data) {
                actualizarGraficoSolicitudes(data);
            }
        });
    }

    function cargarDatosAsistencia(anio = '', mes = '', dia = '') {
        $.ajax({
            url: 'dashboard/obtener_asistencia.php',
            method: 'GET',
            data: { anio, mes, dia },
            dataType: 'json',
            success: function(data) {
                actualizarGraficoAsistencia(data);
            }
        });
    }

    function cargarDatosVehiculos() {
        $.ajax({
            url: 'dashboard/obtener_vehiculos.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                actualizarGraficoVehiculos(data);
            }
        });
    }

    function cargarMetricasGenerales(anio = '', mes = '', dia = '') {
        $.ajax({
            url: 'dashboard/obtener_metricas.php',
            method: 'GET',
            data: { anio, mes, dia },
            dataType: 'json',
            success: function(data) {
                $('#conductoresActivos').text(data.conductores_activos || 0);
                $('#vehiculosDisponibles').text(data.vehiculos_disponibles || 0);
                $('#solicitudesPendientes').text(data.solicitudes_pendientes || 0);
                $('#gananciaAnual').text('S/. ' + parseFloat(data.ganancia || 0).toLocaleString('es-PE', {minimumFractionDigits: 2}));
            }
        });
    }

    function cargarTransaccionesRecientes(anio = '', mes = '', dia = '') {
        $.ajax({
            url: 'dashboard/obtener_transacciones_recientes.php',
            method: 'GET',
            data: { anio, mes, dia },
            dataType: 'json',
            success: function(data) {
                let html = '';
                if (data.length > 0) {
                    data.forEach(function(transaccion) {
                        const badgeClass = transaccion.tipo === 'Ingreso' ? 'bg-success' : 'bg-danger';
                        const estadoBadge = transaccion.estado === 'Activo' ? 'bg-success' : 'bg-secondary';
                        
                        html += `
                            <tr>
                                <td>${transaccion.fecha}</td>
                                <td><span class="badge ${badgeClass}">${transaccion.tipo}</span></td>
                                <td>${transaccion.concepto}</td>
                                <td>S/. ${parseFloat(transaccion.monto).toLocaleString('es-PE', {minimumFractionDigits: 2})}</td>
                                <td>${transaccion.metodo_pago}</td>
                                <td><span class="badge ${estadoBadge}">${transaccion.estado}</span></td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="6" class="text-center text-muted">No hay transacciones en el período seleccionado</td></tr>';
                }
                $('#cuerpoTransacciones').html(html);
            }
        });
    }

    function actualizarGraficoFinanzas(data) {
        const ctx = document.getElementById('chartFinanzas').getContext('2d');
        
        if (chartFinanzas) {
            chartFinanzas.destroy();
        }

        chartFinanzas = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels || [],
                datasets: [{
                    label: 'Ingresos',
                    data: data.ingresos || [],
                    borderColor: '#059669',
                    backgroundColor: 'rgba(5, 150, 105, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }, {
                    label: 'Egresos',
                    data: data.egresos || [],
                    borderColor: '#DC2626',
                    backgroundColor: 'rgba(220, 38, 38, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 13,
                                family: 'Inter, sans-serif'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1E293B',
                        padding: 12,
                        borderRadius: 8,
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': S/. ' + context.parsed.y.toLocaleString('es-PE', {minimumFractionDigits: 2});
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F1F5F9',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#64748B',
                            callback: function(value) {
                                return 'S/. ' + value.toLocaleString('es-PE');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#64748B'
                        }
                    }
                }
            }
        });
    }

    function actualizarGraficoSolicitudes(data) {
        const ctx = document.getElementById('chartSolicitudes').getContext('2d');
        
        if (chartSolicitudes) {
            chartSolicitudes.destroy();
        }

        chartSolicitudes = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.labels || ['Sin datos'],
                datasets: [{
                    data: data.valores || [1],
                    backgroundColor: [
                        '#5B5FC7',
                        '#059669',
                        '#D97706',
                        '#0891B2'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12,
                                family: 'Inter, sans-serif'
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }

    function actualizarGraficoAsistencia(data) {
        const ctx = document.getElementById('chartAsistencia').getContext('2d');
        
        if (chartAsistencia) {
            chartAsistencia.destroy();
        }

        chartAsistencia = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels || ['Sin datos'],
                datasets: [{
                    label: 'Asistencias',
                    data: data.valores || [0],
                    backgroundColor: [
                        '#059669',
                        '#D97706',
                        '#DC2626'
                    ],
                    borderRadius: 8,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F1F5F9',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#64748B'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#64748B'
                        }
                    }
                }
            }
        });
    }

    function actualizarGraficoVehiculos(data) {
        const ctx = document.getElementById('chartVehiculos').getContext('2d');
        
        if (chartVehiculos) {
            chartVehiculos.destroy();
        }

        chartVehiculos = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels || ['Sin datos'],
                datasets: [{
                    data: data.valores || [1],
                    backgroundColor: [
                        '#059669',
                        '#D97706'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12,
                                family: 'Inter, sans-serif'
                            }
                        }
                    }
                }
            }
        });
    }
    </script>
</body>
</html>