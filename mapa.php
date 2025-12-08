<?php include('conexion/conexion.php')?>
<?php include('conexion/auth.php')?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Estilos generales */
    .badge.bg-success { background-color: #28a745 !important; }
    .badge.bg-danger { background-color: #dc3545 !important; }
    .badge.bg-warning { background-color: #ffc107 !important; color: #212529; }
    .page-header { margin-bottom: 1.5rem; }
    .breadcrumbs { list-style: none; padding: 0; display: flex; align-items: center; }
    .breadcrumbs li { display: inline-flex; align-items: center; }
    .breadcrumbs li.separator { margin: 0 0.5rem; }
    .card-header { padding: 1.25rem 1.5rem; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.875rem; }
    
    /* Estilos para la tabla */
    #clientes-table {
      border-collapse: separate;
      border-spacing: 0;
      border-radius: 8px;
      overflow: hidden;
    }
    
    #clientes-table thead th {
      background-color: #5d87ff;
      color: white;
      font-weight: 500;
      border: none;
    }
    
    #clientes-table tbody tr {
      transition: all 0.2s ease;
    }
    
    #clientes-table tbody tr:hover {
      background-color: rgba(93, 135, 255, 0.1);
    }
    
    #clientes-table tbody td {
      border-top: 1px solid #f0f0f0;
      vertical-align: middle;
    }
    
    /* Estilos para la paginación */
    .dataTables_wrapper .dataTables_paginate {
      margin-top: 1rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border: none;
      background: transparent;
      color: #5d87ff !important;
      padding: 0.5rem 0.75rem;
      margin: 0 2px;
      border-radius: 4px;
      transition: all 0.3s ease;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: rgba(93, 135, 255, 0.1);
      color: #5d87ff !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: #5d87ff !important;
      color: white !important;
      box-shadow: 0 2px 5px rgba(93, 135, 255, 0.3);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
      color: #ccc !important;
    }
    
    /* Estilos para el dropdown de cantidad de registros */
    .dataTables_length select {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 0.25rem 0.5rem;
      margin: 0 0.5rem;
    }
    
    /* Estilos para la barra de búsqueda */
    .dataTables_filter input {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 0.25rem 0.5rem;
      margin-left: 0.5rem;
    }
    
    /* Estilos para los botones de acción */
    .btn-action {
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin: 0 2px;
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
          <h3 class="fw-bold mb-3">Rutas</h3>
          <ul class="breadcrumbs mb-3">
            <li class="nav-home">
              <a href="#"><i class="fas fa-home"></i></a>
            </li>
            <li class="separator"><i class="fas fa-chevron-right"></i></li>
            <li class="nav-item"><a href="#">Control</a></li>
            <li class="separator"><i class="fas fa-chevron-right"></i></li>
            <li class="nav-item"><a href="#">Rutas</a></li>
          </ul>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Listado de Rutas</h4>
                <div>
                  <button class="btn btn-primary btn-sm" onclick="abrirModalMApa()">
                    <i class="fas fa-plus me-1"></i> Nuevo
                  </button>
                  <a href="reportes/generarpdfcita.php" class="btn btn-danger btn-sm ms-1">
                    <i class="fas fa-file-pdf"></i> PDF
                  </a>
                  <a href="reportes/exportarexcelcita.php" class="btn btn-success btn-sm ms-1">
                    <i class="fas fa-file-excel"></i> Excel
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="clientes-table" class="display table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre Zona</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Distancia</th>
                        <th>Tiempo</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th width="120px">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "
                    SELECT 
                        r.idRuta AS id,
                        z.nombreZona,
                        r.origen,
                        r.destino,
                        r.distancia_km,
                        r.tiempo_estimado,
                        r.descripcion,
                        r.estado
                    FROM rutas r
                    JOIN zonas_cobertura z ON r.idZona = z.idZona
                    ORDER BY r.idRuta DESC
                    ";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rutas as $row) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['nombreZona']}</td>";
                        echo "<td>{$row['origen']}</td>";
                        echo "<td>{$row['destino']}</td>";
                        echo "<td>{$row['distancia_km']} km</td>";
                        echo "<td>{$row['tiempo_estimado']}</td>";
                        echo "<td>{$row['descripcion']}</td>";

                        // Estado (badge)
                        if ($row['estado'] === 'Activado') {
                            echo '<td><span class="badge bg-success">Activado</span></td>';
                        } else {
                            echo '<td><span class="badge bg-danger">Desactivado</span></td>';
                        }

                        // Botones
                        echo "<td class='text-nowrap'>";
                        echo "<button class='btn btn-sm btn-primary editar-ruta me-1' data-id='{$row['id']}' title='Editar'>
                                <i class='fas fa-pen'></i>
                              </button>";

                        echo "<button class='btn btn-sm btn-danger eliminar-ruta me-1' data-id='{$row['id']}' title='Eliminar'>
                                <i class='fas fa-trash'></i>
                              </button>";

                        echo "<button class='btn btn-sm btn-warning cambiar-estado-ruta' data-id='{$row['id']}' title='Cambiar estado'>
                                <i class='fas fa-sync-alt'></i>
                              </button>";
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

  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="src/assets/js/sidebarmenu.js"></script>
  <script src="src/assets/js/app.min.js"></script>
  <script src="src/assets/libs/simplebar/dist/simplebar.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <?php include('rutas/modal.php')?>
  <?php include('rutas/modaleditar.php')?>
  
  <script>
    function abrirModalMApa() {
        if (typeof $('#registrarRutaModal').modal !== 'function') {
            console.error('Bootstrap Modal no está cargado correctamente');
            alert('Error al cargar el sistema. Recarga la página.');
            return;
        }
        
        $('#registrarRutaModal').modal('show');
        
        const formRegistrarRuta = document.getElementById('formRegistrarRuta');
        if (formRegistrarRuta) {
          formRegistrarRuta.reset();
        } else {
            console.warn('Formulario con ID "formRegistrarRuta" no encontrado');
        }
    }
  </script>
  
  <script>
    $(document).ready(function() {
      $('#clientes-table').DataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
          paginate: {
            previous: '<i class="fas fa-chevron-left"></i>',
            next: '<i class="fas fa-chevron-right"></i>'
          }
        },
        pageLength: 5,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        dom: '<"top"<"d-flex justify-content-between align-items-center"lf>>rt<"bottom"<"d-flex justify-content-between align-items-center"ip>><"clear">',
        initComplete: function() {
          $('.dataTables_length select').addClass('form-select form-select-sm');
        }
      });
    });
  </script>
<script>
$(document).ready(function() {

    // Eliminar Ruta
    $('.eliminar-ruta').click(function() {
        const id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('rutas/eliminar.php', { id }, function(response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: 'La ruta fue eliminada correctamente',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', 'No se pudo eliminar la ruta.', 'error');
                    }
                });
            }
        });
    });

    // Cambiar Estado de Ruta
    $('.cambiar-estado-ruta').click(function() {
        const id = $(this).data('id');

        $.post('rutas/cambiarestado.php', { id }, function(response) {
            const res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Estado actualizado',
                    text: `La ruta ahora está ${res.estado}`,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            } else {
                Swal.fire('Error', 'No se pudo cambiar el estado.', 'error');
            }
        });
    });

});
</script>


</body>
</html>