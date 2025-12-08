<!-- Modal para Editar Solicitud - Diseño Moderno -->
<div class="modal fade" id="editarSolicitudModal" tabindex="-1" aria-labelledby="editarSolicitudModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarSolicitudModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Solicitud
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarSolicitudModal').modal('hide')"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
                <!-- El contenido se cargará dinámicamente -->
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Cliente Natural (Edición) -->
<div class="modal fade" id="editarBuscarClienteNaturalModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>Buscar Cliente Natural
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarBuscarClienteNaturalModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="editarBuscarNaturalInput" placeholder="Buscar por nombre, apellido o documento...">
                        <button class="btn btn-primary" type="button" onclick="editarBuscarClientesNaturales($('#editarBuscarNaturalInput').val())">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="editarTablaClientesNaturales" class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#editarBuscarClienteNaturalModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Empresa (Edición) -->
<div class="modal fade" id="editarBuscarClienteEmpresaModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-building me-2"></i>Buscar Empresa
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarBuscarClienteEmpresaModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="editarBuscarEmpresaInput" placeholder="Buscar por razón social o RUC...">
                        <button class="btn btn-primary" type="button" onclick="editarBuscarClientesEmpresas($('#editarBuscarEmpresaInput').val())">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Razón Social</th>
                                <th>RUC</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="editarTablaClientesEmpresas" class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#editarBuscarClienteEmpresaModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Plantilla del formulario (hidden) -->
<div id="editarFormTemplate" style="display:none;">
    <form id="formEditarSolicitud">
        <input type="hidden" id="editar_idSolicitud" name="idSolicitud">
        <input type="hidden" id="editar_tipoSolicitud" name="tipoSolicitud">
        
        <div class="section-divider">
            <span>Información del Cliente</span>
        </div>
        
        <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" class="form-control" id="editar_infoClienteEmpresa" readonly>
                    <label for="editar_infoClienteEmpresa" id="editar_labelClienteEmpresa">Cliente</label>
                    <input type="hidden" id="editar_idClienteEmpresa" name="idClienteEmpresa">
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary w-100 h-100" id="editar_btnBuscarClienteEmpresa">
                    <i class="fas fa-search me-2"></i>Buscar
                </button>
            </div>
        </div>

        <div class="section-divider mt-4">
            <span>Detalles de la Carga</span>
        </div>

        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="editar_tipoCarga" name="tipoCarga" required>
                        <option value="">Seleccione...</option>
                        <option value="General">General</option>
                        <option value="Perecible">Perecible</option>
                        <option value="Peligrosa">Peligrosa</option>
                        <option value="Refrigerada">Refrigerada</option>
                        <option value="Voluminosa">Voluminosa</option>
                    </select>
                    <label for="editar_tipoCarga">Tipo de Carga <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="number" step="0.01" min="0" class="form-control" id="editar_peso" name="peso">
                    <label for="editar_peso">Peso (kg)</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="number" step="0.01" min="0" class="form-control" id="editar_volumen" name="volumen">
                    <label for="editar_volumen">Volumen (m³)</label>
                </div>
            </div>
        </div>

        <div class="section-divider mt-4">
            <span>Información de Envío</span>
        </div>

        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="editar_origen" name="origen" required>
                    <label for="editar_origen">Origen <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="editar_destino" name="destino" required>
                    <label for="editar_destino">Destino <span class="text-danger">*</span></label>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control" id="editar_fechaEnvio" name="fechaEnvio" required>
                    <label for="editar_fechaEnvio">Fecha de Envío <span class="text-danger">*</span></label>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-4s">
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" id="editar_descripcion" name="descripcion" style="height: 100px"></textarea>
                    <label for="editar_descripcion">Descripción</label>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" onclick="$('#editarSolicitudModal').modal('hide')">
                <i class="fas fa-times me-2"></i>Cancelar
            </button>
            <button type="button" class="btn btn-primary" id="btn-actualizar-solicitud">
                <i class="fas fa-save me-2"></i>Actualizar
            </button>
        </div>
    </form>
</div>

<style>
/* Estilos específicos para los modals de edición */
#editarSolicitudModal .modal-content,
#editarBuscarClienteNaturalModal .modal-content,
#editarBuscarClienteEmpresaModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarSolicitudModal .modal-header,
#editarBuscarClienteNaturalModal .modal-header,
#editarBuscarClienteEmpresaModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#editarSolicitudModal .modal-title,
#editarBuscarClienteNaturalModal .modal-title,
#editarBuscarClienteEmpresaModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#editarSolicitudModal .modal-body,
#editarBuscarClienteNaturalModal .modal-body,
#editarBuscarClienteEmpresaModal .modal-body {
    padding: 25px;
}

#editarSolicitudModal .modal-footer,
#editarBuscarClienteNaturalModal .modal-footer,
#editarBuscarClienteEmpresaModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#editarSolicitudModal .section-divider,
#editarBuscarClienteNaturalModal .section-divider,
#editarBuscarClienteEmpresaModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#editarSolicitudModal .section-divider span,
#editarBuscarClienteNaturalModal .section-divider span,
#editarBuscarClienteEmpresaModal .section-divider span {
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

#editarSolicitudModal .section-divider:before,
#editarBuscarClienteNaturalModal .section-divider:before,
#editarBuscarClienteEmpresaModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#editarSolicitudModal .form-floating > .form-control,
#editarSolicitudModal .form-floating > .form-select,
#editarBuscarClienteNaturalModal .form-floating > .form-control,
#editarBuscarClienteEmpresaModal .form-floating > .form-control {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#editarSolicitudModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#editarSolicitudModal .form-floating > .form-control:focus,
#editarSolicitudModal .form-floating > .form-select:focus,
#editarBuscarClienteNaturalModal .form-floating > .form-control:focus,
#editarBuscarClienteEmpresaModal .form-floating > .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarSolicitudModal .form-floating > label,
#editarBuscarClienteNaturalModal .form-floating > label,
#editarBuscarClienteEmpresaModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#editarSolicitudModal .form-floating > .form-control:focus ~ label,
#editarSolicitudModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarSolicitudModal .form-floating > .form-select ~ label,
#editarBuscarClienteNaturalModal .form-floating > .form-control:focus ~ label,
#editarBuscarClienteEmpresaModal .form-floating > .form-control:focus ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarSolicitudModal .text-danger,
#editarBuscarClienteNaturalModal .text-danger,
#editarBuscarClienteEmpresaModal .text-danger {
    color: var(--danger-color) !important;
}

/* Estilos para tablas en los modals de búsqueda */
#editarBuscarClienteNaturalModal .table,
#editarBuscarClienteEmpresaModal .table {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
    --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
    margin-bottom: 0;
}

#editarBuscarClienteNaturalModal .table thead th,
#editarBuscarClienteEmpresaModal .table thead th {
    background-color: var(--light-gray);
    color: var(--dark-color);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

#editarBuscarClienteNaturalModal .table-hover tbody tr:hover,
#editarBuscarClienteEmpresaModal .table-hover tbody tr:hover {
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
#editarSolicitudModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarSolicitudModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
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

.mt-4 {
    margin-top: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
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
</style>

<script>
// Función para manejar el clic en editar
$(document).on('click', '.editar-solicitud', function() {
    const idSolicitud = $(this).data('id');
    const tipoSolicitud = $(this).data('tipo');
    
    // Mostrar spinner de carga
    $('#modal-body-content').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p>Cargando datos de la solicitud...</p>
        </div>
    `);
    
    // Mostrar el modal
    const editarModal = new bootstrap.Modal(document.getElementById('editarSolicitudModal'));
    editarModal.show();
    
    // Obtener datos de la solicitud
    $.ajax({
        url: '../solicitudes/obtener.php',
        type: 'GET',
        data: { 
            id: idSolicitud,
            tipo: tipoSolicitud
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            
            if(response.success) {
                // Clonar el formulario de la plantilla
                const formHtml = $('#editarFormTemplate').html();
                $('#modal-body-content').html(formHtml);
                
                // Llenar los datos
                $('#editar_idSolicitud').val(response.data.idSolicitud);
                $('#editar_tipoSolicitud').val(tipoSolicitud);
                
                if(tipoSolicitud === 'Natural') {
                    $('#editar_labelClienteEmpresa').text('Cliente:');
                    $('#editar_infoClienteEmpresa').val(response.data.nombreCliente || '');
                } else {
                    $('#editar_labelClienteEmpresa').text('Empresa:');
                    $('#editar_infoClienteEmpresa').val(response.data.razonSocial || '');
                }
                
                $('#editar_idClienteEmpresa').val(response.data.idEntidad);
                $('#editar_tipoCarga').val(response.data.tipoCarga || '');
                $('#editar_peso').val(response.data.peso || '0.00');
                $('#editar_volumen').val(response.data.volumen || '0.00');
                $('#editar_origen').val(response.data.origen || '');
                $('#editar_destino').val(response.data.destino || '');
                
                // Manejar la fecha
                const fechaEnvio = response.data.fechaEnvio ? response.data.fechaEnvio.split(' ')[0] : '';
                $('#editar_fechaEnvio').val(fechaEnvio);
                
                $('#editar_descripcion').val(response.data.descripcion || '');
                
                // Configurar fecha mínima
                if (fechaEnvio) {
                    $('#editar_fechaEnvio').attr('min', fechaEnvio);
                }
                
                // Reasignar eventos
                asignarEventosEdicion();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Error al cargar los datos',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    editarModal.hide();
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar los datos de la solicitud: ' + error,
                confirmButtonColor: '#3085d6'
            }).then(() => {
                editarModal.hide();
            });
        }
    });
});

// Función para asignar eventos de edición
function asignarEventosEdicion() {
    // Evento para el botón de actualizar
    $('#btn-actualizar-solicitud').off('click').on('click', function() {
        actualizarSolicitud();
    });
    
    // Evento para el botón de buscar cliente/empresa
    $('#editar_btnBuscarClienteEmpresa').off('click').on('click', function() {
        const tipoSolicitud = $('#editar_tipoSolicitud').val();
        const editarModal = bootstrap.Modal.getInstance(document.getElementById('editarSolicitudModal'));
        
        if (tipoSolicitud === 'Natural') {
            editarBuscarClientesNaturales('');
            const buscarModal = new bootstrap.Modal(document.getElementById('editarBuscarClienteNaturalModal'));
            editarModal.hide();
            buscarModal.show();
            
            $('#editarBuscarClienteNaturalModal').on('hidden.bs.modal', function () {
                editarModal.show();
            });
        } else {
            editarBuscarClientesEmpresas('');
            const buscarModal = new bootstrap.Modal(document.getElementById('editarBuscarClienteEmpresaModal'));
            editarModal.hide();
            buscarModal.show();
            
            $('#editarBuscarClienteEmpresaModal').on('hidden.bs.modal', function () {
                editarModal.show();
            });
        }
    });
}

// Función para buscar clientes naturales (edición)
function editarBuscarClientesNaturales(busqueda) {
    $('#editarTablaClientesNaturales').html('<tr><td colspan="8" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></td></tr>');
    
    $.ajax({
        url: '../solicitudes/editbuscarclientes.php',
        type: 'GET',
        data: { busqueda: busqueda },
        success: function(response) {
            $('#editarTablaClientesNaturales').html(response);
        },
        error: function(xhr, status, error) {
            $('#editarTablaClientesNaturales').html('<tr><td colspan="8" class="text-center text-danger">Error al cargar clientes: ' + error + '</td></tr>');
        }
    });
}

// Función para buscar empresas (edición)
function editarBuscarClientesEmpresas(busqueda) {
    $('#editarTablaClientesEmpresas').html('<tr><td colspan="7" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></td></tr>');
    
    $.ajax({
        url: '../solicitudes/edibuscarempresa.php',
        type: 'GET',
        data: { busqueda: busqueda },
        success: function(response) {
            $('#editarTablaClientesEmpresas').html(response);
        },
        error: function(xhr, status, error) {
            $('#editarTablaClientesEmpresas').html('<tr><td colspan="7" class="text-center text-danger">Error al cargar empresas: ' + error + '</td></tr>');
        }
    });
}

// Función para seleccionar cliente natural (edición)
function editarSeleccionarClienteNatural(id, nombre, apellidoPat, apellidoMat) {
    $('#editar_idClienteEmpresa').val(id);
    $('#editar_infoClienteEmpresa').val(nombre + ' ' + apellidoPat + ' ' + apellidoMat);
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('editarBuscarClienteNaturalModal'));
    modal.hide();
}

// Función para seleccionar empresa (edición)
function editarSeleccionarClienteEmpresa(id, razonSocial, ruc) {
    $('#editar_idClienteEmpresa').val(id);
    $('#editar_infoClienteEmpresa').val(razonSocial + ' (' + ruc + ')');
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('editarBuscarClienteEmpresaModal'));
    modal.hide();
}

// Función para actualizar la solicitud
function actualizarSolicitud() {
    const tipoSolicitud = $('#editar_tipoSolicitud').val();
    const formData = $('#formEditarSolicitud').serialize();
    const $btn = $('#btn-actualizar-solicitud');
    
    // Validación básica
    if (!$('#editar_tipoCarga').val()) {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Por favor seleccione el tipo de carga',
            confirmButtonColor: '#3085d6'
        });
        return;
    }
    
    // Mostrar spinner en el botón
    $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...');
    $btn.prop('disabled', true);
    
    $.ajax({
        url: '../solicitudes/actualizar.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Respuesta de actualización:', response);
            
            if(response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.message || 'Solicitud actualizada correctamente',
                    confirmButtonColor: '#3085d6',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        $('#editarSolicitudModal').modal('hide');
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Error al actualizar la solicitud',
                    confirmButtonColor: '#3085d6'
                });
                $btn.html('Actualizar');
                $btn.prop('disabled', false);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al actualizar:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar la solicitud: ' + error,
                confirmButtonColor: '#3085d6'
            });
            $btn.html('Actualizar');
            $btn.prop('disabled', false);
        }
    });
}
</script>