<?php include('conexion/conexion.php')?>
<?php include('conexion/auth.php')?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Movimientos</title>
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
        <h3 class="page-title">Gestión de Movimientos</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Control</a></li>
            <li class="breadcrumb-item active" aria-current="page">Movimientos</li>
          </ol>
        </nav>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Listado de Movimientos de Productos</h4>
            <div class="d-flex">
              <button class="btn btn-toggle-filtros me-2" id="toggleFiltros">
                <i class="fas fa-filter"></i>
              </button>
              <div class="btn-group ml-2">
                <button class="btn btn-primary" onclick="abrirModalMovimientos()">
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
                  <label for="filtroTipo">Tipo de Movimiento</label>
                  <div class="select-container">
                    <select class="form-control" id="filtroTipo">
                      <option value="">Todos</option>
                      <option value="Entrada">Entrada</option>
                      <option value="Salida">Salida</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="filtroMotivo">Motivo</label>
                  <div class="select-container">
                    <select class="form-control" id="filtroMotivo">
                      <option value="">Todos</option>
                      <option value="En tránsito">En tránsito</option>
                      <option value="Almacenado">Almacenado</option>
                      <option value="Pendiente revisión">Pendiente revisión</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Traslado">Traslado</option>
                      <option value="Devolución">Devolución</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="filtroBusquedaGlobal">Búsqueda global</label>
                  <div class="filtro-input">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" id="filtroBusquedaGlobal" placeholder="Buscar por producto, almacén, categoría...">
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card-body">
            <div class="table-responsive table-fade-in">
              <table id="movimientos-table" class="display table table-hover w-100">
                <thead>
                  <tr>
                    <th width="70px">ID</th>
                    <th>Almacén</th>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Stock Mínimo</th>
                    <th>Stock Inicial</th>
                    <th>Stock Final</th>
                    <th>Tipo Mov.</th>
                    <th>Motivo</th>
                    <th width="150px" class="text-center">Acciones</th>
                  </tr>
                  <tr class="filter-header">
                    <th><input type="text" class="column-filter" placeholder="ID"></th>
                    <th><input type="text" class="column-filter" placeholder="Almacén"></th>
                    <th><input type="text" class="column-filter" placeholder="Categoría"></th>
                    <th><input type="text" class="column-filter" placeholder="Subcategoría"></th>
                    <th><input type="text" class="column-filter" placeholder="Código"></th>
                    <th><input type="text" class="column-filter" placeholder="Producto"></th>
                    <th><input type="text" class="column-filter" placeholder="Mínimo"></th>
                    <th><input type="text" class="column-filter" placeholder="Inicial"></th>
                    <th><input type="text" class="column-filter" placeholder="Final"></th>
                    <th><input type="text" class="column-filter" placeholder="Tipo"></th>
                    <th><input type="text" class="column-filter" placeholder="Motivo"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "
                      SELECT 
                          mp.idMovimiento,
                          a.nombre AS nombreAlmacen,
                          c.nombreCategoria,
                          s.nomArea AS subcategoria,
                          p.codigoProducto,
                          p.nombreProducto,
                          p.stock_minimo,
                          p.stock,
                          mp.stock_final,
                          mp.motivo,
                          mp.tipo
                      FROM movimiento_producto mp
                      JOIN producto p ON mp.idProducto = p.idProducto
                      JOIN almacen a ON p.idAlmacen = a.idAlmacen
                      JOIN categoria_producto c ON p.idCategoria = c.idCategoria
                      JOIN subcategoria s ON p.idsubcategoria = s.idsubcategoria
                      ORDER BY mp.idMovimiento DESC
                  ";

                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($movimientos as $row) {
                      echo "<tr>";
                      echo "<td><span class='id-movimiento'>{$row['idMovimiento']}</span></td>";
                      echo "<td>{$row['nombreAlmacen']}</td>";
                      echo "<td>{$row['nombreCategoria']}</td>";
                      echo "<td>{$row['subcategoria']}</td>";
                      echo "<td>{$row['codigoProducto']}</td>";
                      echo "<td>{$row['nombreProducto']}</td>";
                      echo "<td>{$row['stock_minimo']}</td>";
                      echo "<td>{$row['stock']}</td>";
                      echo "<td>{$row['stock_final']}</td>";
                      echo "<td>{$row['tipo']}</td>";
                      
                      // Badge para el motivo
                      $badgeClass = '';
                      switch($row['motivo']) {
                          case 'En tránsito': $badgeClass = 'bg-primary'; break;
                          case 'Almacenado': $badgeClass = 'bg-success'; break;
                          case 'Pendiente revisión': $badgeClass = 'bg-info'; break;
                          case 'Entrega': $badgeClass = 'bg-warning'; break;
                          case 'Traslado': $badgeClass = 'bg-secondary'; break;
                          default: $badgeClass = 'bg-light text-dark'; break;
                      }
                      echo "<td><span class='badge {$badgeClass}'>{$row['motivo']}</span></td>";
                      
                      // Botones de acción
                      echo "<td class='text-center'>";
                      echo "<button class='btn btn-primary btn-icon btn-sm editar-movimiento' data-id='{$row['idMovimiento']}' title='Editar'><i class='fas fa-edit'></i></button>";
                     echo "<button class='btn btn-sm btn-warning cambiar-estado me-1' data-id='{$row['idMovimiento']}' data-tipo='{$row['tipo']}'><i class='fas fa-sync-alt'></i></button>";
                      echo "<button class='btn btn-danger btn-icon btn-sm eliminar-movimiento' data-id='{$row['idMovimiento']}' title='Eliminar'><i class='fas fa-trash'></i></button>";
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
<form id="pdfForm" action="reportes/generarpdfmovimiento.php" method="post" style="display: none;">
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

  <?php include('movimientos/modal.php')?>
  <?php include('movimientos/modaleditar.php')?>
  
  <script>
    function abrirModalMovimientos() {
        if (typeof $('#modalMovimientoProducto').modal !== 'function') {
            console.error('Bootstrap Modal no está cargado correctamente');
            alert('Error al cargar el sistema. Recarga la página.');
            return;
        }
        
        $('#modalMovimientoProducto').modal('show');
        
        const formMovimientoProducto = document.getElementById('formMovimientoProducto');
        if (formMovimientoProducto) {
          formMovimientoProducto.reset();
        } else {
            console.warn('Formulario con ID "formMovimientoProducto" no encontrado');
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
  var table = $('#movimientos-table').DataTable({
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
      paginate: {
        previous: '<i class="fas fa-chevron-left"></i>',
        next: '<i class="fas fa-chevron-right"></i>'
      },
      emptyTable: '<div class="text-center my-5"><i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i><p class="text-muted">No hay movimientos registrados</p></div>'
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
        if (colIdx === 11) return; // No aplicar filtro a la columna de acciones
        
        var column = this;
        $('input', $('.filter-header th').eq(column.index())).on('keyup change', function() {
          column
            .search(this.value)
            .draw();
        });
      });
      
      // Inicializar filtros avanzados
      // Filtro por tipo de movimiento
      $('#filtroTipo').on('change', function() {
        table.column(9).search(this.value).draw();
      });
      
      // Filtro por motivo
      $('#filtroMotivo').on('change', function() {
        table.column(10).search(this.value).draw();
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
        $('#filtroTipo').val('');
        $('#filtroMotivo').val('');
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
        targets: 11, // Acciones
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
      var data = this.data();
      filteredData.push(data);
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
});

function initTooltips() {
  $('[data-toggle="tooltip"]').tooltip({
    trigger: 'hover',
    placement: 'top'
  });
}
</script>
<script>
$(document).ready(function() {
    // Verificar movimientos pendientes al cargar la página
    verificarMovimientosPendientes();
    
    async function verificarMovimientosPendientes() {
        try {
            const response = await $.ajax({
                url: 'movimientos/verificar.php',
                method: 'GET',
                dataType: 'json'
            });

            // Si hay error en la respuesta
            if (response.error) {
                console.error('Error del servidor:', response);
                return;
            }

            // Mostrar alertas por cada tipo de motivo pendiente
            if (response.alertas.transito && response.alertas.transito.length > 0) {
                await mostrarAlertaMovimiento({
                    tipo: 'transito',
                    items: response.alertas.transito,
                    titulo: '¡PRODUCTOS EN TRÁNSITO!',
                    mensaje: 'Estos productos están en proceso de transporte y requieren confirmación'
                });
            }
            
            if (response.alertas.revision && response.alertas.revision.length > 0) {
                await mostrarAlertaMovimiento({
                    tipo: 'revision',
                    items: response.alertas.revision,
                    titulo: '¡PRODUCTOS PENDIENTES DE REVISIÓN!',
                    mensaje: 'Estos productos están pendientes de revisión y requieren confirmación'
                });
            }
            
            if (response.alertas.traslado && response.alertas.traslado.length > 0) {
                await mostrarAlertaMovimiento({
                    tipo: 'traslado',
                    items: response.alertas.traslado,
                    titulo: '¡PRODUCTOS EN TRASLADO!',
                    mensaje: 'Estos productos están siendo trasladados y requieren confirmación'
                });
            }
            
        } catch (error) {
            console.error('Error al verificar movimientos:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al verificar movimientos pendientes',
                confirmButtonText: 'Entendido'
            });
        }
    }
    
    function mostrarAlertaMovimiento(opciones) {
        return new Promise((resolve) => {
            // Definir icono y color según el tipo
            let icono, color;
            switch(opciones.tipo) {
                case 'transito':
                    icono = 'fas fa-truck';
                    color = '#17a2b8';
                    break;
                case 'revision':
                    icono = 'fas fa-search';
                    color = '#ffc107';
                    break;
                case 'traslado':
                    icono = 'fas fa-exchange-alt';
                    color = '#6c757d';
                    break;
                default:
                    icono = 'fas fa-info-circle';
                    color = '#007bff';
            }
            
            // Crear contenido HTML
            let html = `
                <div class="text-start">
                    <p><i class="${icono}" style="color: ${color}"></i> 
                    <strong>${opciones.titulo}</strong></p>
                    <p>${opciones.mensaje}</p>
                    <div class="alert-container" style="max-height: ${opciones.items.length > 6 ? '300px' : 'auto'}; overflow-y: auto;">
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Almacén</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
            `;
            
            opciones.items.forEach(item => {
                html += `
                    <tr>
                        <td>${item.codigoProducto}</td>
                        <td>${item.nombreProducto}</td>
                        <td>${item.almacen}</td>
                        <td>${item.tipo}</td>
                        <td>${new Date(item.fecha).toLocaleString()}</td>
                        <td>${item.stock_final}</td>
                    </tr>
                `;
            });
            
            html += `
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
            
            const alerta = Swal.fire({
                icon: 'info',
                title: opciones.titulo,
                html: html,
                confirmButtonText: 'Entendido',
                allowOutsideClick: false,
                width: '900px',
                customClass: {
                    popup: 'alerta-movimiento'
                },
                didDestroy: () => {
                    resolve();
                }
            });
        });
    }
});

// Estilos CSS para las alertas
const style = document.createElement('style');
style.textContent = `
.alerta-movimiento {
    border-left: 5px solid var(--color-borde) !important;
    background-color: #f8f9fa;
}

.alert-container {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
    margin: 0 -1rem;
    padding: 0 1rem;
}

.alert-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.alert-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.alert-container::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 4px;
}

.alerta-movimiento table {
    width: 100%;
    margin-top: 10px;
    font-size: 0.85rem;
}

.alerta-movimiento th {
    font-weight: 600;
    background-color: #f8f9fa;
    position: sticky;
    top: 0;
    white-space: nowrap;
}

.alerta-movimiento td, 
.alerta-movimiento th {
    padding: 6px 10px;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
}

.alerta-movimiento tr:last-child td {
    border-bottom: none;
}
`;
document.head.appendChild(style);
</script>
<script>
$(document).on('click', '.cambiar-estado', function () {
    var id = $(this).data('id');
    var tipo = $(this).data('tipo');

    let opciones = [];
    if (tipo === 'entrada') {
        opciones = ['En tránsito', 'Almacenado', 'Pendiente revisión'];
    } else if (tipo === 'salida') {
        opciones = ['Entrega', 'Traslado', 'Devolución'];
    }

    Swal.fire({
        title: 'Cambiar motivo',
        input: 'select',
        inputOptions: opciones.reduce((acc, val) => {
            acc[val] = val;
            return acc;
        }, {}),
        inputPlaceholder: 'Seleccione un motivo',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let nuevoMotivo = result.value;
            $.post('movimientos/cambiarestad.php', { idMovimiento: id, motivo: nuevoMotivo }, function (respuesta) {
                Swal.fire('Actualizado', respuesta, 'success').then(() => {
                    location.reload();
                });
            });
        }
    });
});

    // Eliminar
    $('.eliminar-movimiento').on('click', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: '¿Eliminar este movimiento?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('movimientos/eliminar.php', { id }, function(response) {
                    Swal.fire('Eliminado', response, 'success').then(() => location.reload());
                });
            }
        });
    });
</script>
</body>
</html>