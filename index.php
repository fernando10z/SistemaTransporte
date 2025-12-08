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
  <title>Dashboard - Sistema de Transporte</title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .dashboard-card {
        transition: transform 0.2s ease-in-out;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .metric-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .metric-card.success {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .metric-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .metric-card.info {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    .filter-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
    }
    .small-chart {
        height: 300px;
    }
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
                        <h5 class="mb-3"><i class="fas fa-filter me-2"></i>Filtros de Dashboard</h5>
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
                                        <i class="fas fa-search me-1"></i>Aplicar Filtros
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
                    <div class="metric-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0" id="conductoresActivos"><?php echo $conductores_activos; ?></h3>
                                <p class="mb-0">Conductores Activos</p>
                            </div>
                            <div class="text-end">
                                <i class="fas fa-users fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0" id="vehiculosDisponibles"><?php echo $vehiculos_disponibles; ?></h3>
                                <p class="mb-0">Vehículos Disponibles</p>
                            </div>
                            <div class="text-end">
                                <i class="fas fa-truck fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0" id="solicitudesPendientes"><?php echo $solicitudes_pendientes; ?></h3>
                                <p class="mb-0">Solicitudes Pendientes</p>
                            </div>
                            <div class="text-end">
                                <i class="fas fa-clock fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card info">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0" id="gananciaAnual">S/. <?php echo number_format($ingresos_anuales - $egresos_anuales, 2); ?></h3>
                                <p class="mb-0">Ganancia Anual</p>
                            </div>
                            <div class="text-end">
                                <i class="fas fa-chart-line fa-2x opacity-75"></i>
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
                                <h5 class="card-title fw-semibold mb-0">
                                    <i class="fas fa-chart-bar me-2 text-primary"></i>Ingresos vs Egresos
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
                            <h5 class="card-title fw-semibold mb-4">
                                <i class="fas fa-pie-chart me-2 text-success"></i>Estados de Solicitudes
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
                            <h5 class="card-title fw-semibold mb-4">
                                <i class="fas fa-calendar-check me-2 text-warning"></i>Asistencia de Conductores
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
                            <h5 class="card-title fw-semibold mb-4">
                                <i class="fas fa-truck me-2 text-info"></i>Estados de Vehículos
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
                            <h5 class="card-title fw-semibold mb-4">
                                <i class="fas fa-history me-2 text-secondary"></i>Transacciones Recientes
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="tablaTransacciones">
                                    <thead class="table-light">
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

            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Dashboard Administrativo - Sistema de Transporte</p>
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
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1,
                    fill: true
                }, {
                    label: 'Egresos',
                    data: data.egresos || [],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'S/. ' + value.toLocaleString('es-PE');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': S/. ' + context.parsed.y.toLocaleString('es-PE', {minimumFractionDigits: 2});
                            }
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
                        '#FF6384',
                        '#36A2EB', 
                        '#FFCE56',
                        '#4BC0C0'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
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
                        '#4CAF50',
                        '#FFC107',
                        '#F44336'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
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
                        '#4CAF50',
                        '#FF9800'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
    </script>
</body>
</html>