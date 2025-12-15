<?php include('conexion/conexion.php')?>
<?php include('conexion/auth.php')?>
  <?php include('layout/sidebar.php')?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Clientes | <?php echo htmlspecialchars($nombre_empresa); ?></title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="configuracion/empresa/<?php echo htmlspecialchars($logo_path); ?>" />

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

    body {
      color: var(--text-secondary);
      background: var(--bg-white);
    }


    .container-fluid {
      padding: 32px;
      max-width: 1600px;
      margin: 0 auto;
    }

    .page-header {
      margin-bottom: 24px;
    }
    
    .page-title {
      font-size: 24px;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 8px;
      letter-spacing: -0.02em;
    }
    
    .breadcrumb {
      padding: 0;
      background: transparent;
      margin-bottom: 0;
      font-size: 14px;
    }
    
    .breadcrumb-item {
      color: var(--text-tertiary);
    }
    
    .breadcrumb-item a {
      color: var(--text-secondary);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .breadcrumb-item a:hover {
      color: var(--text-primary);
    }
    
    .breadcrumb-item.active {
      color: var(--text-secondary);
    }

    .breadcrumb-item + .breadcrumb-item::before {
      content: "›";
      color: var(--text-tertiary);
    }

    .card {
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      background: var(--bg-white);
      margin-bottom: 24px;
      overflow: visible;
    }
    
    .card-header {
      background: var(--bg-white);
      border-bottom: 1px solid var(--border-color);
      padding: 20px 24px;
    }
    
    .card-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-primary);
      margin: 0;
    }
    
    .card-body {
      padding: 24px;
    }

    .btn {
      font-weight: 500;
      border-radius: 10px;
      transition: var(--transition);
      padding: 10px 16px;
      font-size: 14px;
      border: none;
    }
    
    .btn-primary {
      background: var(--text-primary);
      color: white;
    }
    
    .btn-primary:hover {
      background: var(--text-secondary);
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }
    
    .btn-danger {
      background: #DC2626;
      color: white;
    }

    .btn-danger:hover {
      background: #B91C1C;
    }
    
    .btn-warning {
      background: #D97706;
      color: white;
    }

    .btn-warning:hover {
      background: #B45309;
    }
    
    .btn-sm {
      padding: 6px 10px;
      font-size: 13px;
    }
    
    .btn-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      padding: 0;
      border-radius: 8px;
    }

    .btn-toggle-filtros {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--bg-light);
      border: 1px solid var(--border-color);
      color: var(--text-secondary);
      padding: 10px 16px;
      border-radius: 10px;
    }

    .btn-toggle-filtros:hover {
      background: var(--bg-white);
      border-color: var(--text-tertiary);
      color: var(--text-primary);
    }

    .btn-outline-secondary {
      background: transparent;
      border: 1.5px solid var(--border-color);
      color: var(--text-secondary);
    }

    .btn-outline-secondary:hover {
      background: var(--bg-light);
      border-color: var(--text-secondary);
    }

    /* Dropdown menus */
    .dropdown-menu {
      border: 1px solid var(--border-color);
      border-radius: 10px;
      box-shadow: var(--shadow-lg);
      padding: 8px;
      margin-top: 8px;
    }

    .dropdown-item {
      padding: 10px 14px;
      border-radius: 6px;
      font-size: 14px;
      color: var(--text-secondary);
      transition: var(--transition);
    }

    .dropdown-item:hover {
      background: var(--bg-light);
      color: var(--text-primary);
    }

    .badge {
      padding: 6px 12px;
      font-size: 12px;
      font-weight: 600;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    
    .badge-success {
      background: #D1FAE5;
      color: #059669;
      border: 1px solid #A7F3D0;
    }
    
    .badge-danger {
      background: #FEE2E2;
      color: #DC2626;
      border: 1px solid #FECACA;
    }

    .filtros-avanzados {
      padding: 24px;
      background: var(--bg-light);
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      margin-bottom: 24px;
      display: none;
      animation: slideDown 0.3s ease;
    }
    
    .filtros-avanzados.show {
      display: block;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .filtro-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .filtro-header h5 {
      font-size: 15px;
      font-weight: 600;
      color: var(--text-primary);
      margin: 0;
    }
    
    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 8px;
    }
    
    .form-control,
    .form-select {
      width: 100%;
      padding: 10px 14px;
      border: 1.5px solid var(--border-color);
      border-radius: 10px;
      font-size: 14px;
      color: var(--text-primary);
      background: var(--bg-white);
      transition: var(--transition);
    }
    
    .form-control:focus,
    .form-select:focus {
      outline: none;
      border-color: var(--text-secondary);
      box-shadow: 0 0 0 4px rgba(100, 116, 139, 0.1);
    }

    .form-control::placeholder {
      color: var(--text-tertiary);
    }
    
    .filtro-input {
      position: relative;
    }
    
    .filtro-input .form-control {
      padding-left: 38px;
    }
    
    .filtro-input i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-tertiary);
      font-size: 14px;
    }

    .table-responsive {
      border-radius: var(--radius);
      overflow: hidden;
    }

    table.dataTable {
      width: 100% !important;
      border-collapse: separate;
      border-spacing: 0;
    }
    
    table.dataTable thead th {
      background: var(--bg-light);
      color: var(--text-secondary);
      font-weight: 600;
      padding: 14px 16px;
      border: none;
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 0.5px;
    }
    
    table.dataTable tbody td {
      padding: 14px 16px;
      vertical-align: middle;
      border-bottom: 1px solid var(--border-color);
      color: var(--text-secondary);
      font-size: 14px;
    }
    
    table.dataTable tbody tr:last-child td {
      border-bottom: none;
    }
    
    table.dataTable tbody tr:hover {
      background: var(--bg-light);
    }

    /* Filtros por columna */
    .column-filter {
      width: 100%;
      padding: 8px 12px;
      border: 1.5px solid var(--border-color);
      border-radius: 8px;
      font-size: 12px;
      margin-top: 8px;
      color: var(--text-primary);
      background: var(--bg-white);
      transition: var(--transition);
    }
    
    .column-filter:focus {
      border-color: var(--text-secondary);
      background: var(--bg-white);
      box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.1);
      outline: none;
    }
    
    .column-filter::placeholder {
      color: var(--text-tertiary);
    }
    
    .filter-header th {
      padding-top: 0 !important;
      padding-bottom: 14px !important;
    }
    
    /* Paginación */
    .dataTables_wrapper .dataTables_paginate {
      margin-top: 20px;
    }
    
    .dataTables_paginate .paginate_button {
      border: none !important;
      background: transparent !important;
      color: var(--text-secondary) !important;
      font-weight: 500;
      border-radius: 8px;
      padding: 8px 12px !important;
      margin: 0 2px;
      transition: var(--transition);
    }
    
    .dataTables_paginate .paginate_button:hover {
      background: var(--bg-light) !important;
      color: var(--text-primary) !important;
    }
    
    .dataTables_paginate .paginate_button.current {
      background: var(--text-primary) !important;
      color: white !important;
      box-shadow: var(--shadow-sm);
    }
    
    .dataTables_paginate .paginate_button.disabled {
      color: var(--text-tertiary) !important;
      cursor: not-allowed;
      opacity: 0.5;
    }
    
    /* Info y length */
    .dataTables_info {
      font-size: 14px;
      color: var(--text-secondary);
    }

    .dataTables_length label,
    .dataTables_filter label {
      font-size: 14px;
      color: var(--text-secondary);
      font-weight: 500;
    }
    
    .dataTables_length select,
    .dataTables_filter input {
      border: 1.5px solid var(--border-color);
      border-radius: 8px;
      padding: 8px 12px;
      font-size: 14px;
      margin: 0 6px;
      color: var(--text-primary);
      background: var(--bg-white);
    }

    .dataTables_length select:focus,
    .dataTables_filter input:focus {
      outline: none;
      border-color: var(--text-secondary);
      box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.1);
    }
    
    .dataTables_filter input {
      min-width: 250px;
    }

    .id-cliente {
      font-family: 'Consolas', monospace;
      font-weight: 600;
      color: #5B5FC7;
      background: #EEF2FF;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 13px;
    }
    
    .btn-action-wrapper {
      display: flex;
      gap: 6px;
      justify-content: center;
    }
    
    /* Enlaces */
    a {
      color: var(--text-secondary);
      text-decoration: none;
      transition: var(--transition);
    }

    a:hover {
      color: var(--text-primary);

    .table-fade-in {
      animation: fadeIn 0.5s ease;
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

    @media (max-width: 1199px) {
      .body-wrapper {
        margin-left: 0;
      }
    }

    @media (max-width: 768px) {
      .container-fluid {
        padding: 20px;
      }

      .card-header {
        flex-direction: column;
        gap: 12px;
      }

      .btn-action-wrapper {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  
  <div class="body-wrapper">
    <?php include('layout/header.php')?>
    
    <div class="container-fluid">
      <div class="page-inner">
        <div class="page-header">
          <div>
            <h3 class="page-title">Gestión de Clientes</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="ti ti-home"></i> Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
              </ol>
            </nav>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Listado de Clientes</h4>
                <div class="d-flex gap-2">
                  <div class="btn-group">
                    <button class="btn btn-primary" onclick="abrirModalClientes()">
                      <i class="ti ti-plus me-1"></i> Nuevo
                    </button>
                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <button class="dropdown-item" id="pdfBtn">
                        <i class="ti ti-download me-2"></i> Exportar a PDF
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Filtros avanzados -->
              <div class="filtros-avanzados" id="filtrosAvanzados">
                <div class="filtro-header">
                  <h5>Filtrar resultados</h5>
                  <button class="btn btn-sm btn-outline-secondary" id="limpiarFiltros">
                    <i class="ti ti-refresh me-1"></i> Limpiar
                  </button>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="filtroTipo">Tipo de Cliente</label>
                      <select class="form-select" id="filtroTipo">
                        <option value="">Todos</option>
                        <option value="Natural">Natural</option>
                        <option value="Empresa">Empresa</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="filtroEstado">Estado</label>
                      <select class="form-select" id="filtroEstado">
                        <option value="">Todos</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="filtroBusquedaGlobal">Búsqueda global</label>
                      <div class="filtro-input">
                        <i class="ti ti-search"></i>
                        <input type="text" class="form-control" id="filtroBusquedaGlobal" placeholder="Buscar en todos los campos...">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card-body">
                <div class="table-responsive table-fade-in">
                  <table id="clientes-table" class="display table w-100">
                    <thead>
                      <tr>
                        <th width="70px">ID</th>
                        <th>Tipo</th>
                        <th>Nombre / Razón Social</th>
                        <th>Tipo Doc</th>
                        <th>Número Doc</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th width="90px">Estado</th>
                        <th width="130px" class="text-center">Acciones</th>
                      </tr>
                      <tr class="filter-header">
                        <th><input type="text" class="column-filter" placeholder="ID"></th>
                        <th><input type="text" class="column-filter" placeholder="Tipo"></th>
                        <th><input type="text" class="column-filter" placeholder="Nombre"></th>
                        <th><input type="text" class="column-filter" placeholder="Tipo Doc"></th>
                        <th><input type="text" class="column-filter" placeholder="Número"></th>
                        <th><input type="text" class="column-filter" placeholder="Teléfono"></th>
                        <th><input type="text" class="column-filter" placeholder="Correo"></th>
                        <th><input type="text" class="column-filter" placeholder="Estado"></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "
                      SELECT 
                        cn.idCliente AS id,
                        'Natural' AS tipoCliente,
                        CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS nombreCompleto,
                        NULL AS razonSocial,
                        td.tipoDocumento AS tipoDocumento_o_Ruc,
                        cn.numerodocumento AS documento,
                        NULL AS tipoRucDescripcion,
                        cn.telefono,
                        cn.correo,
                        cn.status,
                        cn.fechaRegistro
                      FROM clientes_naturales cn
                      JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
                      
                      UNION ALL
                      
                      SELECT 
                        ce.idEmpresa AS id,
                        'Empresa' AS tipoCliente,
                        NULL AS nombreCompleto,
                        ce.razonSocial,
                        NULL AS tipoDocumento_o_Ruc,
                        ce.ruc AS documento,
                        tr.descripcion AS tipoRucDescripcion,
                        ce.telefono,
                        ce.correo,
                        ce.status,
                        ce.fechaRegistro
                      FROM clientes_empresas ce
                      JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
                      ORDER BY fechaRegistro DESC;
                      ";
                      
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      
                      foreach ($clientes as $row) {
                          echo "<tr>";
                          echo "<td><span class='id-cliente'>{$row['id']}</span></td>";
                          
                          if ($row['tipoCliente'] == 'Natural') {
                              echo "<td><i class='ti ti-user me-2'></i> Natural</td>";
                          } else {
                              echo "<td><i class='ti ti-building me-2'></i> Empresa</td>";
                          }
                      
                          if ($row['tipoCliente'] == 'Natural') {
                              echo "<td>{$row['nombreCompleto']}</td>";
                              echo "<td>{$row['tipoDocumento_o_Ruc']}</td>";
                          } else {
                              echo "<td>{$row['razonSocial']}</td>";
                              echo "<td>{$row['tipoRucDescripcion']}</td>";
                          }
                      
                          echo "<td>{$row['documento']}</td>";
                          echo "<td><a href='tel:{$row['telefono']}'><i class='ti ti-phone me-1'></i> {$row['telefono']}</a></td>";
                          echo "<td><a href='mailto:{$row['correo']}'><i class='ti ti-mail me-1'></i> {$row['correo']}</a></td>";
                      
                          if ($row['status'] === 'Activo') {
                              echo '<td><span class="badge badge-success"><i class="ti ti-check"></i> Activo</span></td>';
                          } else {
                              echo '<td><span class="badge badge-danger"><i class="ti ti-x"></i> Inactivo</span></td>';
                          }
                                        
                          echo "<td>";
                          echo "<div class='btn-action-wrapper'>";
                          echo "<button class='btn btn-primary btn-icon editar-cliente' 
                                  data-id='{$row['id']}' 
                                  data-tipo='{$row['tipoCliente']}'
                                  title='Editar'>
                                  <i class='ti ti-edit'></i>
                                </button>";
                      
                          echo "<button class='btn btn-danger btn-icon eliminar-cliente'
                                  data-id='{$row['id']}'
                                  data-tipo='{$row['tipoCliente']}'
                                  title='Eliminar'>
                                  <i class='ti ti-trash'></i>
                                </button>";
                      
                          echo "<button class='btn btn-warning btn-icon cambiar-estado-cliente'
                                  data-id='{$row['id']}'
                                  data-tipo='{$row['tipoCliente']}'
                                  data-estado='{$row['status']}'
                                  title='Cambiar estado'>
                                  <i class='ti ti-refresh'></i>
                                </button>";
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
  </div>

  <form id="pdfForm" action="reportes/generarpdfclientesgeneral.php" method="post" style="display: none;">
    <input type="hidden" name="filteredData" id="filteredData">
  </form>

  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="src/assets/js/app.min.js"></script>
  <script src="src/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

  <?php include('clientes/modal.php')?>
  <?php include('clientes/modaleditar.php')?>
  
  <script>
    function abrirModalClientes() {
        if (typeof $('#modalCliente').modal !== 'function') {
            console.error('Bootstrap Modal no está cargado correctamente');
            alert('Error al cargar el sistema. Recarga la página.');
            return;
        }
        
        $('#modalCliente').modal('show');
        
        const formCliente = document.getElementById('formCliente');
        if (formCliente) {
          formCliente.reset();
        } else {
            console.warn('Formulario con ID "formCliente" no encontrado');
        }
    }
    
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
      var table = $('#clientes-table').DataTable({
        scrollX: true,
        scrollCollapse: true,
        autoWidth: false,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
          paginate: {
            previous: '<i class="ti ti-chevron-left"></i>',
            next: '<i class="ti ti-chevron-right"></i>'
          },
          emptyTable: '<div class="text-center my-5"><i class="ti ti-users ti-3x text-muted mb-3"></i><p class="text-muted">No hay clientes para mostrar</p></div>'
        },
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        dom: '<"top"<"d-flex justify-content-between align-items-center"<"length-menu">f>>rt<"bottom"<"d-flex justify-content-between align-items-center"ip>><"clear">',
        orderCellsTop: true,
        fixedHeader: false,
        initComplete: function() {
          $('.dataTables_length select').addClass('form-select form-select-sm');
          $("div.length-menu").html($("div.dataTables_length"));
          initTooltips();
          
          this.api().columns().every(function(colIdx) {
            if (colIdx === 8) return;
            
            var column = this;
            $('input', $('.filter-header th').eq(column.index())).on('keyup change', function() {
              column.search(this.value).draw();
            });
          });
          
          $('#filtroTipo').on('change', function() {
            table.column(1).search(this.value).draw();
          });
          
          $('#filtroEstado').on('change', function() {
            table.column(7).search(this.value).draw();
          });
          
          $('#filtroBusquedaGlobal').on('keyup', function() {
            table.search(this.value).draw();
          });
          
          $('#toggleFiltros').on('click', function() {
            $('#filtrosAvanzados').toggleClass('show');
          });
          
          $('#limpiarFiltros').on('click', function() {
            $('#filtroTipo').val('');
            $('#filtroEstado').val('');
            $('#filtroBusquedaGlobal').val('');
            $('.column-filter').val('');
            table.search('').columns().search('').draw();
          });
        },
        columnDefs: [
          { 
            targets: 7,
            className: 'text-center'
          },
          {
            targets: 8,
            className: 'text-center'
          }
        ],
        drawCallback: function() {
          initTooltips();
        }
      });
      
      $('.table-fade-in').hide().fadeIn(600);
      
      $('#pdfBtn').on('click', function() {
        var filteredData = [];
        table.rows({search: 'applied'}).every(function(rowIdx) {
          var data = this.data();
          filteredData.push(data);
        });
        
        if (filteredData.length === 0) {
          Swal.fire({
            title: 'Sin datos',
            text: 'No hay datos para generar el PDF. Ajuste los filtros.',
            icon: 'warning',
            confirmButtonColor: '#1E293B'
          });
          return;
        }
        
        $('#filteredData').val(JSON.stringify(filteredData));
        
        Swal.fire({
          title: 'Generando PDF',
          text: 'Por favor espere...',
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
        
        setTimeout(function() {
          $('#pdfForm').submit();
          Swal.close();
        }, 1000);
      });
    });
  </script>

  <script>
    $(document).on("click", ".eliminar-cliente", function() {
        const id = $(this).data("id");
        const tipo = $(this).data("tipo");

        Swal.fire({
            title: '¿Eliminar cliente?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DC2626',
            cancelButtonColor: '#64748B',
            confirmButtonText: '<i class="ti ti-trash me-1"></i> Eliminar',
            cancelButtonText: '<i class="ti ti-x me-1"></i> Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminando...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                $.ajax({
                    url: "clientes/eliminar.php",
                    type: "POST",
                    dataType: "json",
                    data: { id: id, tipo: tipo },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonColor: '#1E293B'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error',
                                confirmButtonColor: '#1E293B'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al procesar la solicitud',
                            icon: 'error',
                            confirmButtonColor: '#1E293B'
                        });
                    }
                });
            }
        });
    });

    $(document).on("click", ".cambiar-estado-cliente", function () {
        const id = $(this).data("id");
        const tipo = $(this).data("tipo");
        const estadoActual = $(this).data("estado");
        const nuevoEstado = estadoActual === 'Activo' ? 'Inactivo' : 'Activo';

        Swal.fire({
            title: 'Cambiar estado',
            text: `¿Cambiar a ${nuevoEstado}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1E293B',
            cancelButtonColor: '#64748B',
            confirmButtonText: '<i class="ti ti-refresh me-1"></i> Cambiar',
            cancelButtonText: '<i class="ti ti-x me-1"></i> Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Actualizando...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                $.post("clientes/cambiarestado.php", { id, tipo }, function (res) {
                    const data = JSON.parse(res);
                    if (data.success) {
                        Swal.fire({
                            title: 'Estado actualizado',
                            text: `Cliente ahora está ${nuevoEstado}`,
                            icon: 'success',
                            confirmButtonColor: '#1E293B'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonColor: '#1E293B'
                        });
                    }
                });
            }
        });
    });
    
    $(document).on("click", ".editar-cliente", function() {
        const id = $(this).data("id");
        const tipo = $(this).data("tipo");
        
        Swal.fire({
            title: 'Cargando...',
            text: 'Obteniendo información',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
            timer: 800
        });
    });
  </script>
</body>
</html>