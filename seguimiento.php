<?php include('conexion/conexion.php')?>
<?php include('conexion/auth.php')?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Seguimiento</title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Estilos para el modal de escaneo QR */
    .tracking-card {
      max-height: 70vh;
      overflow-y: auto;
      padding-right: 10px;
    }

    /* Estilo para el botón de escaneo */
    .scan-btn-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 70vh;
    }
    
    .scan-btn {
      background: linear-gradient(135deg, #5d87ff 0%, #253b80 100%);
      border: none;
      border-radius: 50px;
      padding: 20px 40px;
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
      box-shadow: 0 10px 20px rgba(93, 135, 255, 0.3);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }
    
    .scan-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(93, 135, 255, 0.4);
    }
    
    .scan-btn i {
      font-size: 2rem;
      margin-right: 15px;
    }
    
    /* Estilo para el dashboard */
    .dashboard-title {
      text-align: center;
      margin: 30px 0;
      color: #2c3e50;
    }
    
    .dashboard-subtitle {
      text-align: center;
      color: #7f8c8d;
      margin-bottom: 50px;
    }
  </style>
</head>

<body>
  <?php include('layout/sidebar.php')?>
  
  <!-- Main wrapper -->
  <div class="body-wrapper">
    <?php include('layout/header.php')?>
    
    <div class="container-fluid">
      <h1 class="dashboard-title">Sistema de Seguimiento</h1>
      <p class="dashboard-subtitle">Escanea códigos QR para rastrear tus envíos</p>
      
      <div class="scan-btn-container">
        <div class="scan-btn" onclick="abrirModalSeguimiento()">
          <i class="fas fa-qrcode"></i>
          ESCANEAR QR
        </div>
      </div>
    </div>
  </div>

  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="src/assets/js/sidebarmenu.js"></script>
  <script src="src/assets/js/app.min.js"></script>
  <script src="src/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>

  <!-- Modal para escanear QR -->
  <div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="scannerModalLabel">Sistema de Seguimiento</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <ul class="nav nav-tabs mb-3" id="scannerTabs" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="scan-tab" data-bs-toggle="tab" data-bs-target="#scan-tab-pane" type="button" role="tab">Escanear QR</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manual-tab-pane" type="button" role="tab">Ingresar Manualmente</button>
                      </li>
                  </ul>
                  
                  <div class="tab-content" id="scannerTabsContent">
                      <!-- Pestaña de Escaneo -->
                      <div class="tab-pane fade show active" id="scan-tab-pane" role="tabpanel">
                          <div class="alert alert-info">
                              <i class="fas fa-info-circle"></i> Enfoca el código QR con la cámara. Asegúrate que esté bien iluminado.
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div id="reader" style="width: 100%; min-height: 300px; border: 2px dashed #ccc;"></div>
                                  <div class="mt-2 text-center">
                                      <button id="switchCamera" class="btn btn-sm btn-outline-primary">
                                          <i class="fas fa-camera-retro"></i> Cambiar Cámara
                                      </button>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div id="scannerResult">
                                      <div class="text-center text-muted">
                                          <i class="fas fa-qrcode fa-4x mb-2"></i>
                                          <p>Escanea un código QR para ver los detalles del envío</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Pestaña Manual -->
                      <div class="tab-pane fade" id="manual-tab-pane" role="tabpanel">
                          <div class="alert alert-warning">
                              <i class="fas fa-exclamation-triangle"></i> Ingresa el código de seguimiento manualmente si el escaneo no funciona.
                          </div>
                          <div class="mb-3">
                              <label for="manualCodeInput" class="form-label">Código de Seguimiento</label>
                              <input type="text" class="form-control form-control-lg" id="manualCodeInput" placeholder="Ej: TRACK123456">
                          </div>
                          <button id="processManualCode" class="btn btn-primary w-100">
                              <i class="fas fa-search"></i> Buscar Seguimiento
                          </button>
                          <div id="manualResult" class="mt-3"></div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      <i class="fas fa-times"></i> Cerrar
                  </button>
              </div>
          </div>
      </div>
  </div>

  <script>
  // Variables globales para el escáner QR
  let html5QrCode;
  let currentCameraId = null;
  let cameras = [];

  // Función para abrir el modal
  function abrirModalSeguimiento() {
      $('#scannerModal').modal('show');
      $('#scannerResult').html(`
          <div class="text-center text-muted">
              <i class="fas fa-qrcode fa-4x mb-2"></i>
              <p>Escanea un código QR para ver los detalles del envío</p>
          </div>
      `);
      $('#manualResult').empty();
      $('#manualCodeInput').val('');
  }

  $(document).ready(function() {
      // Inicializar el escáner cuando se muestre el modal
      $('#scannerModal').on('shown.bs.modal', function () {
          if ($('#scan-tab').hasClass('active')) {
              initScanner();
          }
      });
      
      // Manejar cambio de pestañas
      $('#scannerTabs button').on('click', function () {
          const target = $(this).data('bs-target');
          
          if (target === '#scan-tab-pane') {
              setTimeout(initScanner, 300);
          } else {
              if (html5QrCode && html5QrCode.isScanning) {
                  stopScanner();
              }
          }
      });
  });

  // Función para inicializar el escáner
  function initScanner() {
      $('#reader').empty();
      
      html5QrCode = new Html5Qrcode("reader");
      
      const config = { 
          fps: 15,
          qrbox: { width: 250, height: 250 },
          rememberLastUsedCamera: true,
          supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
          formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE]
      };

      Html5Qrcode.getCameras().then(availableCameras => {
          if (availableCameras && availableCameras.length) {
              cameras = availableCameras;
              
              const backCamera = cameras.find(cam => cam.label.toLowerCase().includes('back'));
              currentCameraId = backCamera ? backCamera.id : cameras[0].id;
              
              html5QrCode.start(
                  currentCameraId, 
                  config, 
                  qrCodeSuccessCallback, 
                  qrCodeErrorCallback
              ).catch(err => {
                  console.error("Error al iniciar escáner:", err);
                  showScannerError(err);
              });
          } else {
              showScannerError("No se encontraron cámaras disponibles");
          }
      }).catch(err => {
          console.error("Error al obtener cámaras:", err);
          showScannerError(err);
      });
  }

  // Función para detener el escáner
  function stopScanner() {
      if (html5QrCode && html5QrCode.isScanning) {
          html5QrCode.stop().then(() => {
              console.log("Escáner detenido");
          }).catch(err => {
              console.error("Error al detener escáner:", err);
          });
      }
  }

  // Callback para éxito en escaneo
  function qrCodeSuccessCallback(decodedText, decodedResult) {
      stopScanner();
      
      $('#reader').html(`
          <div class="text-center text-success py-5">
              <i class="fas fa-check-circle fa-5x mb-3"></i>
              <h4>¡QR detectado!</h4>
              <p>Procesando información...</p>
          </div>
      `);
      
      procesarDatosQR(decodedText);
  }

  // Callback para errores de escaneo
  function qrCodeErrorCallback(error) {
      console.log("Error durante escaneo:", error);
  }

  // Función para mostrar errores del escáner
  function showScannerError(error) {
      $('#reader').html(`
          <div class="alert alert-danger">
              <h5><i class="fas fa-exclamation-triangle"></i> Error al iniciar cámara</h5>
              <p>${error.message || error}</p>
              <p>Por favor usa la opción manual o verifica los permisos de la cámara.</p>
              <button class="btn btn-sm btn-warning" onclick="initScanner()">
                  <i class="fas fa-sync-alt"></i> Reintentar
              </button>
          </div>
      `);
  }

  // Función para cambiar de cámara
  $('#switchCamera').click(function() {
      if (cameras.length < 2) {
          alert("Solo se encontró 1 cámara disponible");
          return;
      }
      
      stopScanner();
      
      const currentIndex = cameras.findIndex(cam => cam.id === currentCameraId);
      const nextIndex = (currentIndex + 1) % cameras.length;
      currentCameraId = cameras[nextIndex].id;
      
      initScanner();
      
      const toast = `<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
          <div class="toast show" role="alert">
              <div class="toast-body">
                  <i class="fas fa-camera me-2"></i> Usando cámara: ${cameras[nextIndex].label || 'Cámara ' + (nextIndex + 1)}
              </div>
          </div>
      </div>`;
      
      $('body').append(toast);
      setTimeout(() => $('.toast').remove(), 2000);
  });

  // Procesar datos del QR (tanto escaneado como manual)
  function procesarDatosQR(qrData) {
      try {
          let data;
          try {
              data = JSON.parse(qrData);
          } catch (e) {
              data = { codigoSeguimiento: qrData };
          }
          
          $('#scannerResult, #manualResult').html(`
              <div class="text-center">
                  <div class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Cargando...</span>
                  </div>
                  <p>Buscando información del envío...</p>
              </div>
          `);
          
          $.ajax({
              url: '../seguimiento/obtenerseguimiento.php',
              method: 'POST',
              data: {
                  idAsignacion: data.idAsignacion,
                  tipoAsignacion: data.tipoAsignacion,
                  codigoSeguimiento: data.codigoSeguimiento
              },
              success: function(response) {
                  if (response.success) {
                      mostrarResultadosSeguimiento(response.data);
                  } else {
                      $('#scannerResult, #manualResult').html(`
                          <div class="alert alert-danger">
                              <i class="fas fa-exclamation-triangle"></i> ${response.error || 'No se encontró información de seguimiento'}
                              <button class="btn btn-primary mt-2" onclick="reiniciarEscanner()">
                                  <i class="fas fa-redo"></i> Intentar nuevamente
                              </button>
                          </div>
                      `);
                  }
              },
              error: function(xhr, status, error) {
                  $('#scannerResult, #manualResult').html(`
                      <div class="alert alert-danger">
                          <i class="fas fa-exclamation-triangle"></i> Error en la consulta: ${error}
                      </div>
                  `);
              }
          });
      } catch (e) {
          $('#scannerResult, #manualResult').html(`
              <div class="alert alert-danger">
                  <i class="fas fa-exclamation-triangle"></i> Error al procesar: ${e.message}
              </div>
          `);
      }
  }

  // Función para reiniciar el escáner
  function reiniciarEscanner() {
      if (html5QrCode && html5QrCode.isScanning) {
          html5QrCode.stop().then(() => {
              initScanner();
          });
      } else {
          initScanner();
      }
      $('#scannerResult').html(`
          <div class="text-center text-muted">
              <i class="fas fa-qrcode fa-4x mb-2"></i>
              <p>Escanea un código QR para ver los detalles del envío</p>
          </div>
      `);
  }

  // Función para mostrar resultados
function mostrarResultadosSeguimiento(datos) {
    const dato = Array.isArray(datos) ? datos[0] : datos;
    
    if (!dato) {
        $('#scannerResult, #manualResult').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> No se encontraron datos
            </div>
        `);
        return;
    }

    const fechaActualizacion = dato.ultimaActualizacion || 'No disponible';
    
    // Usar estadoEnvio en lugar de un valor por defecto
    const estado = dato.estadoEnvio || 'Pendiente';
    
    let html = `
        <div class="tracking-card">
            <h4 class="mb-3"><i class="fas fa-truck me-2"></i>Información de Envío</h4>
            
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle me-2"></i>Detalles
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Código:</strong> ${dato.codigoSeguimiento || 'N/A'}</p>
                            <p><strong>Cliente:</strong> ${dato.cliente || 'N/A'}</p>
                            <p><strong>Vehículo:</strong> ${dato.placa || 'N/A'} ${dato.modelo ? ' - ' + dato.modelo : ''}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Origen:</strong> ${dato.origen || 'N/A'}</p>
                            <p><strong>Destino:</strong> ${dato.destino || 'N/A'}</p>
                            <p><strong>Estado:</strong> ${estado}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-header bg-${getStatusColor(estado)} text-white">
                    <i class="fas fa-map-marker-alt me-2"></i>Estado Actual
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>${estado}</h5>
                            <p class="mb-0">Última actualización: ${fechaActualizacion}</p>
                        </div>
                        <span class="badge bg-${getStatusColor(estado)} fs-5">
                            <i class="fas ${getStatusIcon(estado)}"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button class="btn btn-primary" onclick="reiniciarEscanner()">
                    <i class="fas fa-redo"></i> Nuevo Escaneo
                </button>
            </div>
        </div>
    `;
    
    $('#scannerResult, #manualResult').html(html);
}
  // Funciones auxiliares
  function getStatusColor(status) {
      switch(status.toLowerCase()) {
          case 'pendiente': return 'warning';
          case 'en tránsito': return 'info';
          case 'Entregado': return 'success';
          case 'cancelado': return 'danger';
          default: return 'secondary';
      }
  }

  function getStatusIcon(status) {
      switch(status.toLowerCase()) {
          case 'pendiente': return 'fa-clock';
          case 'en tránsito': return 'fa-truck-moving';
          case 'Entregado': return 'fa-check-circle';
          case 'cancelado': return 'fa-times-circle';
          default: return 'fa-question-circle';
      }
  }

  // Manejar entrada manual de código
  $('#processManualCode').click(function() {
      const manualCode = $('#manualCodeInput').val().trim();
      if (!manualCode) {
          $('#manualResult').html(`
              <div class="alert alert-warning">
                  <i class="fas fa-exclamation-triangle"></i> Por favor ingresa un código de seguimiento
              </div>
          `);
          return;
      }
      
      $('#manualResult').html(`
          <div class="text-center">
              <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Cargando...</span>
              </div>
              <p>Buscando información del envío...</p>
          </div>
      `);
      
      procesarDatosQR(manualCode);
  });

  // Permitir presionar Enter en el input manual
  $('#manualCodeInput').keypress(function(e) {
      if (e.which === 13) {
          $('#processManualCode').click();
      }
  });
  </script>

</body>
</html>