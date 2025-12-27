<?php include('conexion/conexion.php')?>
<?php include('conexion/auth.php')?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Planificacion</title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- DataTables y extensiones -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
  <style>
    :root {
      --primary-color: #5d87ff;
      --secondary-color: #4569cb;
      --success-color: #36b37e;
      --danger-color: #f55252;
      --warning-color: #ffab00;
      --info-color: #4fc3f7;
      --light-color: #f8f9fa;
      --dark-color: #333;
      --border-radius: 8px;
      --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }
    
    /* Estilos generales y reseteo */
    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
      color: #525f7f;
      background-color: #f8f9fe;
    }
    
    .card {
      border: none;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      margin-bottom: 30px;
      background-color: #fff;
    }
    
    .card-header {
      background-color: #fff;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      padding: 20px 25px;
    }
    
    .card-title {
      color: #334d6e;
      font-weight: 600;
      margin-bottom: 0;
      font-size: 1.25rem;
    }
    
    .card-body {
      padding: 25px;
    }
    
    /* Estilos para badges */
    .badge {
      padding: 6px 12px;
      font-size: 0.75rem;
      font-weight: 500;
      border-radius: 50px;
    }
    
    .badge-success {
      background-color: rgba(54, 179, 126, 0.15);
      color: var(--success-color);
      border: 1px solid rgba(54, 179, 126, 0.3);
    }
    
    .badge-danger {
      background-color: rgba(245, 82, 82, 0.15);
      color: var(--danger-color);
      border: 1px solid rgba(245, 82, 82, 0.3);
    }
    
    /* Estilos para botones */
    .btn {
      font-weight: 500;
      border-radius: 6px;
      transition: var(--transition);
      padding: 8px 16px;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
    
    .btn-danger {
      background-color: var(--danger-color);
      border-color: var(--danger-color);
    }
    
    .btn-warning {
      background-color: var(--warning-color);
      border-color: var(--warning-color);
      color: #fff;
    }
    
    .btn-sm {
      padding: 5px 10px;
      font-size: 0.75rem;
    }
    
    .btn-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      padding: 0;
      border-radius: 50%;
    }
    
    .btn-icon.btn-sm {
      width: 32px;
      height: 32px;
    }
    
    /* Estilos para tabla */
    .dataTables_wrapper {
      margin-top: 15px;
    }
    
    .dataTables_wrapper .row:first-child,
    .dataTables_wrapper .row:last-child {
      padding: 15px 0;
      align-items: center;
    }
    
    table.dataTable {
      border-collapse: separate;
      border-spacing: 0;
      width: 100% !important;
      margin-top: 15px !important;
      margin-bottom: 15px !important;
      border-radius: var(--border-radius);
      overflow: hidden;
    }
    
    table.dataTable thead th {
      background: #f6f9fc;
      color: #334d6e;
      font-weight: 600;
      padding: 15px;
      border-top: 0;
      border-bottom: 1px solid #edf2f9;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }
    
    table.dataTable tbody td {
      padding: 16px 15px;
      vertical-align: middle;
      border-top: 0;
      border-bottom: 1px solid #edf2f9;
      color: #525f7f;
      font-size: 0.875rem;
    }
    
    table.dataTable tbody tr:last-child td {
      border-bottom: none;
    }
    
    table.dataTable tbody tr:hover {
      background-color: rgba(93, 135, 255, 0.05);
    }
    
    /* Estilos para paginación */
    .dataTables_paginate {
      margin-top: 20px !important;
    }
    
    .dataTables_paginate .paginate_button {
      border: none !important;
      background: transparent !important;
      color: #525f7f !important;
      font-weight: 500;
      border-radius: 4px;
      padding: 8px 12px !important;
      margin: 0 2px;
    }
    
    .dataTables_paginate .paginate_button:hover {
      background: rgba(93, 135, 255, 0.1) !important;
      color: var(--primary-color) !important;
    }
    
    .dataTables_paginate .paginate_button.current {
      background: var(--primary-color) !important;
      color: white !important;
      box-shadow: 0 3px 8px rgba(93, 135, 255, 0.3);
    }
    
    .dataTables_paginate .paginate_button.disabled {
      color: #c8cfd6 !important;
      cursor: not-allowed;
    }
    
    /* Estilo para búsqueda y mostrar entradas */
    .dataTables_length label,
    .dataTables_filter label {
      color: #525f7f;
      font-weight: 500;
      font-size: 0.875rem;
    }
    
    .dataTables_length select,
    .dataTables_filter input {
      border: 1px solid #e9ecef;
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 0.875rem;
      margin: 0 6px;
      box-shadow: none;
      height: 40px;
      background-color: white;
      color: #525f7f;
    }
    
    .dataTables_filter input {
      min-width: 250px;
    }
    
    .dataTables_length select {
      width: 70px;
    }
    
    /* Filtros avanzados */
    .filtros-avanzados {
      margin-bottom: 20px;
      padding: 20px 25px;
      background-color: #f8f9fe;
      border-radius: var(--border-radius);
      border: 1px solid #edf2f9;
      display: none;
    }
    
    .filtros-avanzados.show {
      display: block;
    }
    
    .filtros-avanzados .form-group {
      margin-bottom: 15px;
    }
    
    .filtro-header {
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .filtro-input {
      position: relative;
    }
    
    .filtro-input .form-control {
      height: 40px;
      border-radius: 6px;
      border: 1px solid #e9ecef;
      padding: 8px 12px;
      padding-left: 35px;
      font-size: 0.875rem;
      color: #525f7f;
      width: 100%;
    }
    
    .filtro-input .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
    }
    
    .filtro-input i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #c8cfd6;
    }
    
    /* Personalización de selects */
    .select-container {
      position: relative;
    }
    
    .select-container select {
      appearance: none;
      padding-right: 30px !important;
      background-color: white;
    }
    
    .select-container:after {
      content: "\f107";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #525f7f;
      pointer-events: none;
    }
    
    /* Encabezado de página */
    .page-header {
      margin-bottom: 1.5rem;
    }
    
    .page-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #334d6e;
      margin-bottom: 1rem;
    }
    
    .breadcrumb {
      padding: 0;
      background: transparent;
      margin-bottom: 1rem;
    }
    
    .breadcrumb-item {
      font-size: 0.875rem;
      color: #8492a6;
    }
    
    .breadcrumb-item a {
      color: #525f7f;
      text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
      color: var(--primary-color);
    }
    
    .breadcrumb-item.active {
      color: var(--primary-color);
    }
    
    /* Animaciones y transiciones */
    .table-fade-in {
      animation: fadeIn 0.5s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Estilos para los filtros de columna */
    .column-filter {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #e9ecef;
      border-radius: 6px;
      font-size: 0.8125rem;
      margin-top: 10px;
      color: #525f7f;
      background-color: #f8f9fe;
      transition: all 0.2s ease;
    }
    
    .column-filter:focus {
      border-color: var(--primary-color);
      background-color: #fff;
      box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
    }
    
    .column-filter::placeholder {
      color: #b1b7c1;
    }
    
    .filter-header th {
      padding-top: 0 !important;
      padding-bottom: 15px !important;
    }
    
    /* Estilos para botones de acción en la tabla */
    .btn-action-wrapper {
      display: flex;
      gap: 8px;
      justify-content: center;
    }
    
    /* Estilos para tooltips personalizados */
    .tooltip-inner {
      background-color: #334d6e;
      border-radius: 4px;
      padding: 5px 10px;
      font-size: 0.75rem;
    }
    
    /* Estilos para números de ID */
    .id-cliente {
      font-family: 'Consolas', monospace;
      font-weight: 600;
      color: #5d87ff;
      background-color: rgba(93, 135, 255, 0.1);
      padding: 2px 8px;
      border-radius: 4px;
      font-size: 0.8125rem;
    }
    
    /* Estilos para botón toggle filtros */
    .btn-toggle-filtros {
      display: flex;
      align-items: center;
      font-weight: 500;
      color: #525f7f;
      background-color: #f8f9fe;
      border: 1px solid #e9ecef;
      border-radius: 6px;
      padding: 8px 16px;
      margin-left: 10px;
    }
    
    .btn-toggle-filtros:hover {
      background-color: #edf2f9;
      color: #334d6e;
    }
    
    .btn-toggle-filtros i {
      margin-right: 8px;
    }
  </style>
</head>

<body>
  <?php include('layout/sidebar.php')?>
  
  <!--  Main wrapper -->
  <div class="body-wrapper">
    <?php include('layout/header.php')?>
    
<div class="container-fluid">
  <div class="page-inner">
    <div class="page-header">
      <div>
        <h3 class="page-title">Gestión de Planificación</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Control</a></li>
            <li class="breadcrumb-item active" aria-current="page">Planificaciones</li>
          </ol>
        </nav>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Listado de Planificaciones</h4>
            <div class="d-flex">
              <button class="btn btn-toggle-filtros me-2" id="toggleFiltros">
                <i class="fas fa-filter"></i>
              </button>
              <div class="btn-group ml-2">
                <button class="btn btn-primary" onclick="abrirModalPlanificacion()">
                  <i class="fas fa-plus"></i>
                </button>
                <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <button class="dropdown-item" id="pdfBtn">
                    <i class="fas fa-file-pdf me-2 text-danger"></i> Exportar a PDF
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Filtros avanzados -->
          <div class="filtros-avanzados" id="filtrosAvanzados">
            <div class="filtro-header">
              <h5 class="mb-0">Filtrar resultados</h5>
              <button class="btn btn-sm btn-outline-secondary" id="limpiarFiltros">
                <i class="fas fa-broom me-1"></i>
              </button>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="filtroEstado">Estado</label>
                  <div class="select-container">
                    <select class="form-control" id="filtroEstado">
                      <option value="">Todos</option>
                      <option value="Planificado">Planificado</option>
                      <option value="Reprogramado">Reprogramado</option>
                      <option value="Cancelado">Cancelado</option>
                      <option value="Completado">Completado</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="filtroTipo">Tipo</label>
                  <div class="select-container">
                    <select class="form-control" id="filtroTipo">
                      <option value="">Todos</option>
                      <option value="cliente">Cliente</option>
                      <option value="empresa">Empresa</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="filtroBusquedaGlobal">Búsqueda global</label>
                  <div class="filtro-input">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" id="filtroBusquedaGlobal" placeholder="Buscar por conductor, origen, destino...">
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card-body">
            <div class="table-responsive table-fade-in">
              <table id="planificaciones-table" class="display table table-hover w-100">
                <thead>
                  <tr>
                    <th width="70px">ID</th>
                    <th>Tipo</th>
                     <th>Cliente</th>
                    <th>Conductor</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha y Hora</th>
                    <th width="100px">Estado</th>
                    <th width="180px" class="text-center">Acciones</th>
                  </tr>
                  <tr class="filter-header">
                    <th><input type="text" class="column-filter" placeholder="ID"></th>
                    <th><input type="text" class="column-filter" placeholder="Tipo"></th>
                   <th><input type="text" class="column-filter" placeholder="Cliente"></th>
                    <th><input type="text" class="column-filter" placeholder="Conductor"></th>
                    <th><input type="text" class="column-filter" placeholder="Origen"></th>
                    <th><input type="text" class="column-filter" placeholder="Destino"></th>
                    <th><input type="text" class="column-filter" placeholder="Fecha"></th>
                    <th><input type="text" class="column-filter" placeholder="Estado"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "
            SELECT 
    pr.idPlanificacion AS idPlanificacion,
    'cliente' AS tipoPlanificacion,
    CONCAT(c.nombre, ' ', c.Apepat, ' ', c.Apemat) AS conductor,
    r.origen,
    r.destino,
    pr.fechaPlanificada,
    pr.horaPlanificada,
    pr.estado,
    pr.fecharegistro,
    CASE 
        WHEN cn.idCliente IS NOT NULL THEN CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat)
        WHEN ce.idEmpresa IS NOT NULL THEN ce.razonSocial
        ELSE 'Desconocido'
    END AS nombre_cliente,
    CASE 
        WHEN cn.idCliente IS NOT NULL THEN 'Natural'
        WHEN ce.idEmpresa IS NOT NULL THEN 'Empresa'
        ELSE 'Desconocido'
    END AS tipo_cliente,
    acc.estado AS estado_carga
FROM planificacion_ruta pr
JOIN conductores c ON pr.idConductor = c.idConductor
JOIN rutas r ON pr.idRuta = r.idRuta
JOIN asignacion_carga_cliente acc ON pr.idAsignacion = acc.idAsignacion
JOIN cotizaciones_clientes cc ON acc.idCotizacion = cc.idCotizacion
JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
LEFT JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
LEFT JOIN clientes_empresas ce ON sc.idCliente = ce.idEmpresa

UNION ALL

SELECT 
    pe.idPlanificacionempresa AS idPlanificacion,
    'empresa' AS tipoPlanificacion,
    CONCAT(c.nombre, ' ', c.Apepat, ' ', c.Apemat) AS conductor,
    r.origen,
    r.destino,
    pe.fechaPlanificada,
    pe.horaPlanificada,
    pe.estado,
    pe.fecharegistro,
    ce.razonSocial AS nombre_cliente,
    'Empresa' AS tipo_cliente,
    ace.estado AS estado_carga
FROM planificacion_ruta_empresa pe
JOIN conductores c ON pe.idConductor = c.idConductor
JOIN rutas r ON pe.idRuta = r.idRuta
JOIN asignacion_carga_empresa ace ON pe.idAsignacionEmpresa = ace.idAsignacionEmpresa
JOIN cotizaciones_empresas cce ON ace.idCotizacionEmpresa = cce.idCotizacionEmpresa
JOIN solicitud_empresa se ON cce.idSolicitudempresa = se.idSolicitudempresa
JOIN clientes_empresas ce ON se.idEmpresa = ce.idEmpresa

ORDER BY fecharegistro DESC;
                  ";

                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $planificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  
                  foreach ($planificaciones as $row) {
                      echo "<tr data-tipo='{$row['tipoPlanificacion']}'>";
                      echo "<td><span class='id-planificacion'>{$row['idPlanificacion']}</span></td>";
                      
                      // Tipo de planificación con icono
                      if ($row['tipoPlanificacion'] == 'cliente') {
                          echo "<td><i class='fas fa-user me-2 text-primary'></i>Cliente</td>";
                      } else {
                          echo "<td><i class='fas fa-building me-2 text-info'></i> Empresa</td>";
                      }
                      echo "<td>{$row['nombre_cliente']}</td>";

                      echo "<td>{$row['conductor']}</td>";
                      echo "<td>{$row['origen']}</td>";
                      echo "<td>{$row['destino']}</td>";
                      echo "<td>{$row['fechaPlanificada']} {$row['horaPlanificada']}</td>";

                      // Estado (badge)
                      $badgeClass = match($row['estado']) {
                          'Planificado' => 'primary',
                          'Reprogramado' => 'warning',
                          'Cancelado' => 'danger',
                          'Completado' => 'success',
                          default => 'secondary'
                      };
                      echo "<td><span class='badge bg-{$badgeClass}'><i class='fas fa-circle me-1'></i> {$row['estado']}</span></td>";
                                    
                      // Botones de acción
                      // Botones de acción
                      echo "<td class='text-center'>";
                      echo "<div class='btn-group'>";

                      // Botón Ver
                      echo "<button class='btn btn-sm btn-info me-1 ver' data-id='{$row['idPlanificacion']}' data-type='{$row['tipoPlanificacion']}' title='Ver'><i class='fas fa-eye'></i></button>";

                      $disabledreprogramar = $row['estado'] === 'Completado' ? 'disabled' : '';

                      echo "<button class='btn btn-sm btn-primary me-1 reprogramar' data-id='{$row['idPlanificacion']}' data-type='{$row['tipoPlanificacion']}' title='Reprogramar' $disabledreprogramar><i class='fas fa-calendar-alt'></i></button>";

                      // Botón Cambiar Estado (deshabilitar según estado)
                      $estadoActual = $row['estado'];
                      $estadosDeshabilitados = ['Reprogramado', 'Completado', 'Cancelado'];
                      $disabled = in_array($estadoActual, $estadosDeshabilitados) ? 'disabled' : '';
                      echo "<button class='btn btn-sm btn-warning cambiar-estado me-1' data-id='{$row['idPlanificacion']}' data-type='{$row['tipoPlanificacion']}' title='Cambiar Estado' $disabled><i class='fas fa-sync-alt'></i></button>";

                      // Botón Eliminar
                      echo "<button class='btn btn-sm btn-danger eliminar' data-id='{$row['idPlanificacion']}' data-type='{$row['tipoPlanificacion']}' title='Eliminar'><i class='fas fa-trash'></i></button>";

                      echo "</div>";
                      echo "</td>";

                      echo "</tr>";
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
</div>

<!-- Form para enviar datos filtrados al PDF -->
<form id="pdfForm" action="reportes/generarpdfplanificacion.php" method="post" style="display: none;">
  <input type="hidden" name="filteredData" id="filteredData">
</form>

  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="src/assets/js/sidebarmenu.js"></script>
  <script src="src/assets/js/app.min.js"></script>
  <script src="src/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- DataTables con extensiones -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
  
  <?php include('planificacion/modal.php')?>
  <?php include('planificacion/reprogramacion.php')?>
    <?php include('planificacion/modalhistorial.php')?>

  
 
  <script>
    function abrirModalPlanificacion() {
        if (typeof $('#planificacionModal').modal !== 'function') {
            console.error('Bootstrap Modal no está cargado correctamente');
            alert('Error al cargar el sistema. Recarga la página.');
            return;
        }
        
        $('#planificacionModal').modal('show');
        
        const formPlanificacion = document.getElementById('formPlanificacion');
        if (formPlanificacion) {
          formPlanificacion.reset();
        } else {
            console.warn('Formulario con ID "formPlanificacion" no encontrado');
        }
    }
    // Inicializar tooltips de Bootstrap
    function initTooltips() {
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
          placement: 'top',
          trigger: 'hover'
        });
      });
    }
  </script>

<script>
$(document).ready(function() {
  // Inicializar DataTable con configuración mejorada
  var table = $('#planificaciones-table').DataTable({
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
      paginate: {
        previous: '<i class="fas fa-chevron-left"></i>',
        next: '<i class="fas fa-chevron-right"></i>'
      },
      emptyTable: '<div class="text-center my-5"><i class="fas fa-route fa-3x text-muted mb-3"></i><p class="text-muted">No hay planificaciones registradas</p></div>'
    },
    pageLength: 10,
    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
    dom: '<"top"<"d-flex justify-content-between align-items-center"<"length-menu">f>>rt<"bottom"<"d-flex justify-content-between align-items-center"ip>><"clear">',
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function() {
      // Personalización del select de cantidad
      $('.dataTables_length select').addClass('form-select form-select-sm');
      
      // Mover el control de longitud a un contenedor personalizado
      $("div.length-menu").html($("div.dataTables_length"));
      
      // Inicializar tooltips
      initTooltips();
      
      // Aplicar filtros por columna
      this.api().columns().every(function(colIdx) {
        if (colIdx === 8) return; // No aplicar filtro a la columna de acciones
        
        var column = this;
        $('input', $('.filter-header th').eq(column.index())).on('keyup change', function() {
          column
            .search(this.value)
            .draw();
        });
      });
      
      // Inicializar filtros avanzados
      // Filtro por estado
      $('#filtroEstado').on('change', function() {
        table.column(7).search(this.value).draw(); // Columna 7 es estado
      });
      
      // Filtro por tipo de planificación
      $('#filtroTipo').on('change', function() {
        table.column(1).search(this.value === 'cliente' ? 'Cliente' : 'Empresa').draw(); // Columna 1 es tipo
      });
      
      // Búsqueda global
      $('#filtroBusquedaGlobal').on('keyup', function() {
        table.search(this.value).draw();
      });
      
      // Toggle de filtros avanzados
      $('#toggleFiltros').on('click', function() {
        $('#filtrosAvanzados').toggleClass('show');
      });
      
      // Limpiar filtros
      $('#limpiarFiltros').on('click', function() {
        // Limpiar filtros avanzados
        $('#filtroEstado').val('');
        $('#filtroTipo').val('');
        $('#filtroBusquedaGlobal').val('');
        
        // Limpiar filtros de columna
        $('.column-filter').val('');
        
        // Resetear la tabla
        table.search('').columns().search('').draw();
      });
    },
    // Personalizar el render de ciertas columnas
    columnDefs: [
      { 
        targets: 7, // Estado
        className: 'text-center'
      },
      {
        targets: 8, // Acciones
        className: 'text-center',
        orderable: false,
        searchable: false
      }
    ],
    drawCallback: function() {
      // Reinicializar tooltips después de cada redibujado
      initTooltips();
    }
  });
  
  // Animar la tabla al cargar
  $('.table-fade-in').hide().fadeIn(600);
  
  // Manejar el evento de clic en el botón PDF
  $('#pdfBtn').on('click', function() {
    // Obtener datos visibles (filtrados) de la tabla
    var filteredData = [];
    table.rows({search: 'applied'}).every(function(rowIdx) {
      var rowData = this.data();
      var $row = $(this.node());
      
      filteredData.push({
        idPlanificacion: $row.find('.id-planificacion').text(),
        tipoPlanificacion: $row.data('tipo'),
        nombre_cliente: rowData[2],
        conductor: rowData[3],
        origen: rowData[4],
        destino: rowData[5],
        fechaHora: rowData[6],
        estado: $(rowData[7]).text().trim()
      });
    });
    
    // Si no hay datos filtrados, mostrar mensaje
    if (filteredData.length === 0) {
      Swal.fire({
        title: 'Sin datos',
        text: 'No hay datos para generar el PDF. Ajuste los filtros.',
        icon: 'warning',
        confirmButtonColor: '#5d87ff'
      });
      return;
    }
    
    // Actualizar el campo oculto con los datos filtrados
    $('#filteredData').val(JSON.stringify(filteredData));
    
    // Mostrar mensaje de carga
    Swal.fire({
      title: 'Generando PDF',
      text: 'Por favor espere mientras se genera el documento...',
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });
    
    // Enviar el formulario para generar el PDF
    setTimeout(function() {
      $('#pdfForm').submit();
      Swal.close();
    }, 1000);
  });

  // Manejar eventos de los botones de acción
  $(document).on('click', '.ver', function() {
    var id = $(this).data('id');
    var type = $(this).data('type');
    // Lógica para ver detalles
  });

  $(document).on('click', '.reprogramar', function() {
    var id = $(this).data('id');
    var type = $(this).data('type');
    // Lógica para reprogramar
  });

  $(document).on('click', '.cambiar-estado', function() {
    var id = $(this).data('id');
    var type = $(this).data('type');
    // Lógica para cambiar estado
  });

  $(document).on('click', '.eliminar', function() {
    var id = $(this).data('id');
    var type = $(this).data('type');
    // Lógica para eliminar
  });
});

function initTooltips() {
  $('[data-toggle="tooltip"]').tooltip({
    trigger: 'hover',
    placement: 'top'
  });
}
</script>
<script>
$(document).ready(function () {
  // Cambiar estado
  $('.cambiar-estado').click(function () {
    const id = $(this).data('id');
    const tipo = $(this).data('type');

    Swal.fire({
      title: '¿Cambiar estado?',
      text: "¿Estás seguro de cambiar el estado de esta planificación?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, cambiar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('planificacion/cambiarestado.php', { id, tipo }, function (respuesta) {
          Swal.fire({
            title: 'Hecho',
            text: respuesta,
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            location.reload();
          });
        });
      }
    });
  });

  // Eliminar
  $('.eliminar').click(function () {
    const id = $(this).data('id');
    const tipo = $(this).data('type');

    Swal.fire({
      title: '¿Eliminar planificación?',
      text: "Esta acción no se puede deshacer.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('planificacion/eliminar.php', { id, tipo }, function (respuesta) {
          Swal.fire({
            title: 'Eliminado',
            text: respuesta,
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            location.reload();
          });
        });
      }
    });
  });

  // Ver planificación
  $('.ver').click(function () {
    const id = $(this).data('id');
    const tipo = $(this).data('type');
    const archivo = (tipo === 'cliente') ? 'ver_cliente.php' : 'ver_empresa.php';

    $('#modalVer .modal-body').load(`${archivo}?id=${id}`, function () {
      $('#modalVer').modal('show');
    });
  });

  // Reprogramar
  $('.reprogramar').click(function () {
    const id = $(this).data('id');
    const tipo = $(this).data('type');
    const archivo = (tipo === 'cliente') ? 'reprogramar_cliente.php' : 'reprogramar_empresa.php';

    $('#modalReprogramar .modal-body').load(`${archivo}?id=${id}`, function () {
      $('#modalReprogramar').modal('show');
    });
  });
});


</script>
</body>
</html>