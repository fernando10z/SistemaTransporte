 
 <style>
        .qr-video-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        #qr-video {
            width: 100%;
            border: 2px solid #0d6efd;
            border-radius: 8px;
        }
        #qr-canvas {
            display: none;
        }
        .close-qr-scanner {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Estilos para modales anidados */
        .modal-backdrop.fade.show ~ .modal-backdrop.fade.show {
            z-index: 1060 !important;
        }
        .modal.fade.show ~ .modal.fade.show {
            z-index: 1070 !important;
        }
    </style>
   <!-- Modal Principal - Registro de Asistencia - Diseño Moderno -->
<div class="modal fade" id="registroAsistenciaModal" tabindex="-1" aria-labelledby="registroAsistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroAsistenciaModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-clipboard-check me-2"></i>Registro de Asistencia de Conductores
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#registroAsistenciaModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="asistenciaForm">
                    <input type="hidden" id="idAsistencia" name="idAsistencia">
                    <input type="hidden" id="idConductor" name="idConductor">
                    
                    <div class="section-divider">
                        <span>Información del Conductor</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreCompleto" readonly>
                                <label for="nombreCompleto">Conductor <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2 h-100">
                                <button type="button" class="btn btn-primary flex-grow-1" id="btnBuscarConductor">
                                    <i class="fas fa-search me-2"></i>Buscar
                                </button>
                                <button type="button" class="btn btn-success flex-grow-1" id="scanQRBtn">
                                    <i class="fas fa-qrcode me-2"></i>QR
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="documentoCompleto" readonly>
                                <label for="documentoCompleto">Documento</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Registro de Horarios</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="dia" name="dia" readonly>
                                <label for="dia">Día</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" readonly>
                                <label for="hora_entrada">Hora de Entrada</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="hora_salida" name="hora_salida" readonly>
                                <label for="hora_salida">Hora de Salida</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Detalles Adicionales</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="horas_conducidas" name="horas_conducidas" required readonly>
                                <label for="horas_conducidas">Horas Conducidas <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="observaciones" name="observaciones">
                                <label for="observaciones">Observaciones</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4 animate__animated animate__fadeInUp animate__delay-4s">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar Asistencia
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#registroAsistenciaModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Conductor - Diseño Moderno -->
<div class="modal fade" id="buscarConductorModal" tabindex="-1" aria-labelledby="buscarConductorModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarConductorModalLabel">
                    <i class="fas fa-search me-2"></i>Buscar Conductor
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarConductorModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchConductor" placeholder="Buscar por nombre, documento o licencia...">
                        <button class="btn btn-primary" type="button" id="btnSearchConductor">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Documento</th>
                                <th>Licencia</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="conductoresTableBody" class="table-group-divider">
                            <!-- Datos se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarConductorModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Escaner QR - Diseño Moderno -->
<div class="modal fade" id="qrScannerModal" tabindex="-1" aria-labelledby="qrScannerModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrScannerModalLabel">
                    <i class="fas fa-qrcode me-2"></i>Escanear QR
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#qrScannerModal').modal('hide')"></button>
            </div>
            <div class="modal-body text-center">
                <div class="qr-video-container">
                    <video id="qr-video" playsinline class="rounded"></video>
                    <canvas id="qr-canvas" class="d-none"></canvas>
                </div>
                <p class="mt-3 text-muted">Enfoca el código QR del conductor</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#qrScannerModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modals de asistencia */
#registroAsistenciaModal .modal-content,
#buscarConductorModal .modal-content,
#qrScannerModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#registroAsistenciaModal .modal-header,
#buscarConductorModal .modal-header,
#qrScannerModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#registroAsistenciaModal .modal-title,
#buscarConductorModal .modal-title,
#qrScannerModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#registroAsistenciaModal .modal-body,
#buscarConductorModal .modal-body,
#qrScannerModal .modal-body {
    padding: 25px;
}

#registroAsistenciaModal .modal-footer,
#buscarConductorModal .modal-footer,
#qrScannerModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#registroAsistenciaModal .section-divider,
#buscarConductorModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#registroAsistenciaModal .section-divider span,
#buscarConductorModal .section-divider span {
    position: relative;
    display: inline-block;
    padding: 0 15px;
    background-color: #fff;
    color: var(--primary-color);
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 1;
}
#registroAsistenciaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#registroAsistenciaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#registroAsistenciaModal .section-divider:before,
#buscarConductorModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#registroAsistenciaModal .form-floating > .form-control,
#registroAsistenciaModal .form-floating > .form-select,
#buscarConductorModal .form-floating > .form-control {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#registroAsistenciaModal .form-floating > label,
#buscarConductorModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#registroAsistenciaModal .form-floating > .form-control:focus ~ label,
#registroAsistenciaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#registroAsistenciaModal .form-floating > .form-select ~ label,
#buscarConductorModal .form-floating > .form-control:focus ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para el escáner QR */
.qr-video-container {
    position: relative;
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    overflow: hidden;
    border-radius: var(--border-radius);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#qr-video {
    width: 100%;
    height: auto;
    background-color: #000;
}

/* Estilos para tablas */
#buscarConductorModal .table {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
    --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
    margin-bottom: 0;
}

#buscarConductorModal .table thead th {
    background-color: var(--light-gray);
    color: var(--dark-color);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

#buscarConductorModal .table-hover tbody tr:hover {
    background-color: var(--light-gray);
}

/* Variables CSS */
:root {
    --primary-color: #5d87ff;
    --primary-light: rgba(93, 135, 255, 0.1);
    --primary-dark: #4569cb;
    --success-color: #36b37e;
    --success-light: rgba(54, 179, 126, 0.1);
    --danger-color: #f55252;
    --danger-light: rgba(245, 82, 82, 0.1);
    --warning-color: #ffab00;
    --warning-light: rgba(255, 171, 0, 0.1);
    --dark-color: #334d6e;
    --light-color: #f8f9fe;
    --gray-color: #8492a6;
    --light-gray: #edf2f9;
    --text-color: #525f7f;
    --border-radius: 8px;
    --transition: all 0.3s ease;
}

/* Animaciones */
.animate__animated {
    animation-duration: 0.5s;
}

.animate__fadeInUp {
    animation-name: fadeInUp;
}

.animate__fadeInLeft {
    animation-name: fadeInLeft;
}

.animate__fadeInRight {
    animation-name: fadeInRight;
}

.animate__delay-1s {
    animation-delay: 0.2s;
}

.animate__delay-2s {
    animation-delay: 0.4s;
}

.animate__delay-3s {
    animation-delay: 0.6s;
}

.animate__delay-4s {
    animation-delay: 0.8s;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Personalizaciones para bootstrap */
.row {
    --bs-gutter-x: 1.5rem;
}

.g-3 {
    --bs-gutter-y: 1rem;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-3 {
    margin-top: 1rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

/* Estilos para los botones */
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

.btn-outline-secondary {
    border-color: var(--light-gray);
    color: var(--gray-color);
}

.btn-outline-secondary:hover {
    background-color: var(--light-gray);
    color: var(--dark-color);
}

.btn-success {
    background-color: var(--success-color);
    border-color: var(--success-color);
}

.btn-success:hover {
    background-color: var(--success-color);
    border-color: var(--success-color);
    opacity: 0.9;
}

/* Estilos para elementos readonly */
input[readonly], select[readonly] {
    background-color: var(--light-gray);
    border-color: var(--light-gray);
    cursor: not-allowed;
}

/* Estilos para el input group */
.input-group-text {
    background-color: var(--light-gray);
    color: var(--gray-color);
    border-color: var(--light-gray);
}

/* Ajustes de altura para elementos */
.h-100 {
    height: 100% !important;
}

.w-100 {
    width: 100% !important;
}

/* Estilos para el grid de botones */
.d-grid {
    display: grid !important;
}

.gap-2 {
    gap: 0.5rem !important;
}
</style>

    <!-- Bootstrap JS Bundle with Popper -->
    <!-- SweetAlert2 -->
    <!-- Instascan para QR -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>    
 <script>
    // Variable global para el escáner QR
    let scanner = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializamos los modales
        const registroModal = new bootstrap.Modal(document.getElementById('registroAsistenciaModal'));
        const buscarModal = new bootstrap.Modal(document.getElementById('buscarConductorModal'));
        const qrModal = new bootstrap.Modal(document.getElementById('qrScannerModal'));

        // Botón para abrir el modal principal
        document.getElementById('btnAbrirRegistro')?.addEventListener('click', function() {
            cargarFechaHoraActual();
            registroModal.show();
        });

        // Botón para buscar conductor
        document.getElementById('btnBuscarConductor')?.addEventListener('click', function() {
            buscarModal.show();
            buscarConductores('');
        });

        // Buscar conductores al escribir
        document.getElementById('searchConductor')?.addEventListener('input', function() {
            buscarConductores(this.value);
        });

        // Manejar cambio en horas conducidas
        document.getElementById('horas_conducidas')?.addEventListener('change', calcularHoraSalida);

        // Configurar escáner QR
        document.getElementById('scanQRBtn')?.addEventListener('click', function() {
            iniciarEscaneoQR(qrModal);
        });

        // Enviar formulario
        document.getElementById('asistenciaForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            guardarAsistencia();
        });

        // Cargar fecha y hora cuando se abre el modal principal
        document.getElementById('registroAsistenciaModal')?.addEventListener('shown.bs.modal', cargarFechaHoraActual);
    });

    function cargarFechaHoraActual() {
    // Obtener día actual (no necesita ajuste de zona horaria)
    const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    const hoy = new Date();
    document.getElementById('dia').value = dias[hoy.getDay()];
    
    // Obtener hora actual en Perú/Lima (UTC-5)
    const ahora = new Date();
    const opciones = {
        timeZone: 'America/Lima',
        hour12: false,
        hour: '2-digit',
        minute: '2-digit'
    };
    const horaPeru = ahora.toLocaleTimeString('es-PE', opciones);
    document.getElementById('hora_entrada').value = horaPeru;
    
    // Calcular hora de salida si ya hay horas conducidas
    if (document.getElementById('horas_conducidas')?.value) {
        calcularHoraSalida();
    }
}
    function buscarConductores(searchTerm) {
        fetch('../asistencia/buscarconductor.php?search=' + encodeURIComponent(searchTerm))
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('conductoresTableBody');
                if (!tbody) return;
                
                tbody.innerHTML = '';
                
                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center">No se encontraron conductores</td></tr>';
                    return;
                }
                
                data.forEach(conductor => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${conductor.nombreCompleto}</td>
                        <td>${conductor.documentoCompleto}</td>
                        <td>${conductor.licenciaCompleta}</td>
                        <td>
                            <button class="btn btn-sm btn-primary seleccionar-conductor" 
                                    data-id="${conductor.idConductor}"
                                    data-nombre="${conductor.nombreCompleto}"
                                    data-documento="${conductor.documentoCompleto}"
                                    data-horastrabajo="${conductor.horastrabajo}">
                                Seleccionar
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
                
                // Agregar eventos a los botones de selección
                document.querySelectorAll('.seleccionar-conductor').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const idConductor = this.getAttribute('data-id');
                        const nombreCompleto = this.getAttribute('data-nombre');
                        const documentoCompleto = this.getAttribute('data-documento');
                        const horastrabajo = this.getAttribute('data-horastrabajo');
                        
                        document.getElementById('idConductor').value = idConductor;
                        document.getElementById('nombreCompleto').value = nombreCompleto;
                        document.getElementById('documentoCompleto').value = documentoCompleto;
                        document.getElementById('horas_conducidas').value = horastrabajo;
                        
                        calcularHoraSalida();
                        
                        // Cerrar el modal de búsqueda
                        const buscarModal = bootstrap.Modal.getInstance(document.getElementById('buscarConductorModal'));
                        buscarModal.hide();
                    });
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo cargar la lista de conductores'
                });
            });
    }


function iniciarEscaneoQR(qrModal) {
    qrModal.show();
    
    if (!scanner) {
        scanner = new Instascan.Scanner({
            video: document.getElementById('qr-video'),
            mirror: false,
            captureImage: false
        });
        
        scanner.addListener('scan', async function(content) {
            try {
                if (scanner) scanner.stop();
                
                // Intenta parsear el JSON directamente
                let qrData;
                try {
                    qrData = JSON.parse(content);
                } catch (e) {
                    // Si falla, intenta corregir el formato
                    const fixedContent = content
                        .replace(/'/g, '"')
                        .replace(/"(\w+)"\s*:/g, '$1:')
                        .replace(/:\s*"([^"]*)"\s*([,}])/g, ':"$1"$2');
                    
                    qrData = JSON.parse(fixedContent);
                }
                
                // Validar estructura mínima
                if (!qrData || !qrData.idConductor || !qrData.token) {
                    throw new Error('Formato de QR inválido');
                }
                
                // Verificar con el servidor
                const response = await fetch(`../asistencia/obtenerconductor.php?id=${qrData.idConductor}&token=${qrData.token}`);
                const data = await response.json();
                
                if (!data.exists) {
                    throw new Error('QR no válido o expirado');
                }
                
                // Llenar formulario
                document.getElementById('idConductor').value = qrData.idConductor;
                document.getElementById('nombreCompleto').value = `${qrData.nombres || ''} ${qrData.apellidos || ''}`.trim();
                document.getElementById('documentoCompleto').value = qrData.documentos || '';
                document.getElementById('horas_conducidas').value = qrData.horas_trabajo || qrData.horastrabajos || 8;
                
                calcularHoraSalida();
                qrModal.hide();
                
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al leer QR: ' + error.message,
                    footer: 'El código debe ser generado por este sistema'
                });
                
                if (scanner) {
                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) scanner.start(cameras[0]);
                    });
                }
            }
        });
    }
    
    // Iniciar cámara
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            qrModal.hide();
            Swal.fire('Error', 'No se encontraron cámaras disponibles', 'error');
        }
    }).catch(function(e) {
        qrModal.hide();
        Swal.fire('Error', 'Error al acceder a la cámara: ' + e.message, 'error');
    });
}
    function calcularHoraSalida() {
        const horaEntrada = document.getElementById('hora_entrada')?.value;
        const horasConducidas = parseInt(document.getElementById('horas_conducidas')?.value);
        
        if (!horaEntrada || isNaN(horasConducidas)) return;
        
        const [horas, minutos] = horaEntrada.split(':').map(Number);
        const fechaEntrada = new Date();
        fechaEntrada.setHours(horas, minutos, 0, 0);
        
        const fechaSalida = new Date(fechaEntrada.getTime() + horasConducidas * 60 * 60 * 1000);
        
        const horasSalida = fechaSalida.getHours().toString().padStart(2, '0');
        const minutosSalida = fechaSalida.getMinutes().toString().padStart(2, '0');
        
        document.getElementById('hora_salida').value = `${horasSalida}:${minutosSalida}`;
    }

    function guardarAsistencia() {
        const formData = new FormData(document.getElementById('asistenciaForm'));
        
        fetch('../asistencia/guardar.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Asistencia registrada correctamente',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'No se pudo guardar la asistencia'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo guardar la asistencia'
            });
        });
    }
</script>
</body>
</html>