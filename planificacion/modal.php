<!-- Modal Principal de Planificación -->
<div class="modal fade" id="planificacionModal" tabindex="-1" aria-labelledby="planificacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planificacionModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-route me-2"></i>Planificar Ruta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPlanificacion">
                    <div class="section-divider">
                        <span>Tipo de Cliente</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <div class="form-floating">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipoCliente" id="clienteNatural" value="natural" checked>
                                    <label class="form-check-label" for="clienteNatural">Cliente Natural</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipoCliente" id="clienteEmpresa" value="empresa">
                                    <label class="form-check-label" for="clienteEmpresa">Cliente Empresa</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campos para Cliente Natural -->
                    <div id="camposNatural">
                        <div class="section-divider mt-4">
                            <span>Asignación Cliente Natural</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-md-8">
                     <label for="asignacionCliente">Asignación Cliente <span class="text-danger">*</span></label>

                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="asignacionCliente" placeholder="Asignación Cliente" readonly>
                                        <button class="btn btn-outline-primary" type="button" id="btnBuscarAsignacionCliente">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <input type="hidden" id="idAsignacionCliente" name="idAsignacion">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campos para Cliente Empresa -->
                    <div id="camposEmpresa" style="display: none;">
                        <div class="section-divider mt-4">
                            <span>Asignación Empresa</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-md-8">
                                 <label for="asignacionEmpresa">Asignación Empresa <span class="text-danger">*</span></label>
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="asignacionEmpresa" placeholder="Asignación Empresa" readonly>
                                        <button class="btn btn-outline-primary" type="button" id="btnBuscarAsignacionEmpresa">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <input type="hidden" id="idAsignacionEmpresa" name="idAsignacionEmpresa">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campos comunes -->
                    <div class="section-divider mt-4">
                        <span>Información de la Ruta</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="ruta" placeholder="Ruta" readonly>
                                    <button class="btn btn-outline-primary" type="button" id="btnBuscarRuta">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <input type="hidden" id="idRuta" name="idRuta">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="vehiculo" placeholder="Vehículo" readonly>
                                <input type="hidden" id="idVehiculo" name="idVehiculo">
                                <label for="vehiculo">Vehículo</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="conductor" placeholder="Conductor" readonly>
                                    <button class="btn btn-outline-primary" type="button" id="btnBuscarConductor">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <input type="hidden" id="idConductor" name="idConductor">
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mt-4">
                        <span>Detalles de Planificación</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaPlanificada" name="fechaPlanificada" placeholder="Fecha Planificada" required>
                                <label for="fechaPlanificada">Fecha Planificada <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="horaPlanificada" name="horaPlanificada" placeholder="Hora Planificada" required>
                                <label for="horaPlanificada">Hora Planificada <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="estadoPlanificacion" name="estado" required>
                                    <option value="Planificado" selected>Planificado</option>
                                    <option value="Reprogramado">Reprogramado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                                <label for="estadoPlanificacion">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones" style="height: 100px"></textarea>
                                <label for="observaciones">Observaciones</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarPlanificacion">
                    <i class="fas fa-save me-2"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Asignación Cliente -->
<div class="modal fade" id="modalBuscarAsignacionCliente" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>Buscar Asignación - Cliente Natural
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Filtros de Búsqueda</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarAsignacionClienteInput" placeholder="Buscar por cliente, código o destino...">
                            <label for="buscarAsignacionClienteInput">Buscar asignación</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaAsignacionesCliente">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Estado</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Asignación Empresa -->
<div class="modal fade" id="modalBuscarAsignacionEmpresa" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-building me-2"></i>Buscar Asignación - Empresa
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Filtros de Búsqueda</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarAsignacionEmpresaInput" placeholder="Buscar por empresa, RUC o destino...">
                            <label for="buscarAsignacionEmpresaInput">Buscar asignación</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaAsignacionesEmpresa">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Empresa</th>
                                <th>RUC</th>
                                <th>Destino</th>
                                <th>Estado</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Ruta -->
<div class="modal fade" id="modalBuscarRuta" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    <i class="fas fa-route me-2"></i>Buscar Ruta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Filtros de Búsqueda</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarRutaInput" placeholder="Buscar por origen, destino o descripción...">
                            <label for="buscarRutaInput">Buscar ruta</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaRutas">
                        <thead class="thead-light">
                            <tr>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Distancia (km)</th>
                                <th>Tiempo Estimado</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Conductor -->
<div class="modal fade" id="modalBuscarConductor" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    <i class="fas fa-user-tie me-2"></i>Buscar Conductor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Filtros de Búsqueda</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarConductorInput" placeholder="Buscar por nombre, apellido o licencia...">
                            <label for="buscarConductorInput">Buscar conductor</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaConductores">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Licencia</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modales de planificación */
#planificacionModal .modal-content,
#modalBuscarAsignacionCliente .modal-content,
#modalBuscarAsignacionEmpresa .modal-content,
#modalBuscarRuta .modal-content,
#modalBuscarConductor .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#planificacionModal .modal-header,
#modalBuscarAsignacionCliente .modal-header,
#modalBuscarAsignacionEmpresa .modal-header,
#modalBuscarRuta .modal-header,
#modalBuscarConductor .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#planificacionModal .modal-title,
#modalBuscarAsignacionCliente .modal-title,
#modalBuscarAsignacionEmpresa .modal-title,
#modalBuscarRuta .modal-title,
#modalBuscarConductor .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#planificacionModal .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#planificacionModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#planificacionModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#modalBuscarAsignacionCliente .modal-title::after,
#modalBuscarAsignacionEmpresa .modal-title::after,
#modalBuscarRuta .modal-title::after,
#modalBuscarConductor .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#planificacionModal .modal-body,
#modalBuscarAsignacionCliente .modal-body,
#modalBuscarAsignacionEmpresa .modal-body,
#modalBuscarRuta .modal-body,
#modalBuscarConductor .modal-body {
    padding: 25px;
}

#planificacionModal .modal-footer,
#modalBuscarAsignacionCliente .modal-footer,
#modalBuscarAsignacionEmpresa .modal-footer,
#modalBuscarRuta .modal-footer,
#modalBuscarConductor .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para textarea en formulario flotante */
#observaciones,
#edit_descripcion {
    min-height: 100px;
    resize: vertical;
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

/* Estilos para los formularios flotantes */
.form-floating > .form-control,
.form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para secciones divididas */
.section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

.section-divider span {
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

.section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

/* Estilos para los botones de búsqueda */
.input-group .btn-outline-primary {
    height: 56px;
    border-radius: 0 8px 8px 0;
}

.input-group .form-control {
    border-radius: 8px 0 0 8px;
}

/* Estilos para tablas */
.table {
    margin-bottom: 0;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: var(--dark-color);
    background-color: var(--light-gray);
}

.table td {
    vertical-align: middle;
}

/* Estilos para scroll personalizado */
.modal-dialog-scrollable .modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

.table-responsive {
    max-height: 60vh;
    overflow-y: auto;
}
</style>
<script>
$(document).ready(function() {
    // Variables globales
    let currentTipoCliente = 'natural';
    
    // Cambiar entre cliente natural y empresa
    $('input[name="tipoCliente"]').change(function() {
        currentTipoCliente = $(this).val();
        if (currentTipoCliente === 'natural') {
            $('#camposNatural').show();
            $('#camposEmpresa').hide();
            // Limpiar campos de empresa
            $('#asignacionEmpresa').val('');
            $('#idAsignacionEmpresa').val('');
        } else {
            $('#camposNatural').hide();
            $('#camposEmpresa').show();
            // Limpiar campos de cliente natural
            $('#asignacionCliente').val('');
            $('#idAsignacionCliente').val('');
        }
        // Limpiar vehículo al cambiar tipo de cliente
        $('#vehiculo').val('');
        $('#idVehiculo').val('');
    });
    
    // Configurar modales para no cerrar el principal
    const modalesBusqueda = [
        '#modalBuscarAsignacionCliente',
        '#modalBuscarAsignacionEmpresa',
        '#modalBuscarRuta',
        '#modalBuscarConductor'
    ];
    
    modalesBusqueda.forEach(modal => {
        $(modal).on('show.bs.modal', function() {
            $('body').addClass('modal-open');
        });
        
        $(modal).on('hidden.bs.modal', function() {
            if ($('.modal.show').length) {
                $('body').addClass('modal-open');
            }
        });
    });
    
    // Abrir modal de búsqueda según tipo de cliente
    $('#btnBuscarAsignacionCliente').click(function() {
        cargarAsignacionesCliente();
        $('#modalBuscarAsignacionCliente').modal('show');
    });
    
    $('#btnBuscarAsignacionEmpresa').click(function() {
        cargarAsignacionesEmpresa();
        $('#modalBuscarAsignacionEmpresa').modal('show');
    });
    
    // Abrir otros modales de búsqueda
    $('#btnBuscarRuta').click(function() {
        cargarRutas();
        $('#modalBuscarRuta').modal('show');
    });
    
    $('#btnBuscarConductor').click(function() {
        cargarConductores();
        $('#modalBuscarConductor').modal('show');
    });
    
    // Funciones para cargar datos en los modales de búsqueda
    function cargarAsignacionesCliente(busqueda = '') {
        $.ajax({
            url: '../planificacion/asignacioncliente.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let html = '';
                    response.data.forEach(asignacion => {
                        html += `
                            <tr>
                                <td>${asignacion.codigo}</td>
                                <td>${asignacion.cliente}</td>
                                <td>${asignacion.origen}</td>
                                <td>${asignacion.destino}</td>
                                <td><span class="badge ${asignacion.estado === 'Pendiente' ? 'bg-warning' : 'bg-success'}">${asignacion.estado}</span></td>
                                <td><button class="btn btn-sm btn-primary btn-seleccionar-asignacion-cliente" data-id="${asignacion.id}" data-texto="${asignacion.cliente} - ${asignacion.destino}">Seleccionar</button></td>
                            </tr>
                        `;
                    });
                    $('#tablaAsignacionesCliente tbody').html(html);
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar asignaciones', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error en la conexión con el servidor', 'error');
            }
        });
    }
    
    function cargarAsignacionesEmpresa(busqueda = '') {
        $.ajax({
            url: '../planificacion/asignacionempresa.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let html = '';
                    response.data.forEach(asignacion => {
                        html += `
                            <tr>
                                <td>${asignacion.codigo}</td>
                                <td>${asignacion.empresa}</td>
                                <td>${asignacion.ruc}</td>
                                <td>${asignacion.destino}</td>
                                <td><span class="badge ${asignacion.estado === 'Pendiente' ? 'bg-warning' : 'bg-success'}">${asignacion.estado}</span></td>
                                <td><button class="btn btn-sm btn-primary btn-seleccionar-asignacion-empresa" data-id="${asignacion.id}" data-texto="${asignacion.empresa} - ${asignacion.destino}">Seleccionar</button></td>
                            </tr>
                        `;
                    });
                    $('#tablaAsignacionesEmpresa tbody').html(html);
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar asignaciones', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error en la conexión con el servidor', 'error');
            }
        });
    }
    
    function cargarRutas(busqueda = '') {
        $.ajax({
            url: '../planificacion/buscaruta.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let html = '';
                    response.data.forEach(ruta => {
                        html += `
                            <tr>
                                <td>${ruta.origen}</td>
                                <td>${ruta.destino}</td>
                                <td>${ruta.distancia}</td>
                                <td>${ruta.tiempo}</td>
                                <td><button class="btn btn-sm btn-primary btn-seleccionar-ruta" data-id="${ruta.id}" data-texto="${ruta.origen} → ${ruta.destino}">Seleccionar</button></td>
                            </tr>
                        `;
                    });
                    $('#tablaRutas tbody').html(html);
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar rutas', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error en la conexión con el servidor', 'error');
            }
        });
    }
    
    function cargarConductores(busqueda = '') {
        $.ajax({
            url: '../planificacion/buscarconductores.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let html = '';
                    response.data.forEach(conductor => {
                        html += `
                            <tr>
                                <td>${conductor.nombre}</td>
                                <td>${conductor.apellidos}</td>
                                <td>${conductor.licencia}</td>
                                <td>${conductor.telefono}</td>
                                <td><span class="badge ${conductor.estado === 'Activo' ? 'bg-success' : 'bg-secondary'}">${conductor.estado}</span></td>
                                <td><button class="btn btn-sm btn-primary btn-seleccionar-conductor" data-id="${conductor.id}" data-texto="${conductor.nombre} ${conductor.apellidos}">Seleccionar</button></td>
                            </tr>
                        `;
                    });
                    $('#tablaConductores tbody').html(html);
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar conductores', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error en la conexión con el servidor', 'error');
            }
        });
    }
    
    // Función para obtener el vehículo asociado a una asignación
    function obtenerVehiculoAsignacion(idAsignacion, tipoCliente) {
        $.ajax({
            url: '../planificacion/buscarvehiculos.php',
            method: 'POST',
            data: { 
                idAsignacion: idAsignacion,
                tipoCliente: tipoCliente
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#idVehiculo').val(response.data.idVehiculo);
                    $('#vehiculo').val(`${response.data.placa} - ${response.data.marca} ${response.data.modelo}`);
                } else {
                    Swal.fire('Advertencia', response.message || 'No se encontró vehículo asociado', 'warning');
                    $('#idVehiculo').val('');
                    $('#vehiculo').val('');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al obtener información del vehículo', 'error');
            }
        });
    }
    
    // Eventos de búsqueda en tiempo real
    $('#buscarAsignacionClienteInput').on('input', function() {
        cargarAsignacionesCliente($(this).val());
    });
    
    $('#buscarAsignacionEmpresaInput').on('input', function() {
        cargarAsignacionesEmpresa($(this).val());
    });
    
    $('#buscarRutaInput').on('input', function() {
        cargarRutas($(this).val());
    });
    
    $('#buscarConductorInput').on('input', function() {
        cargarConductores($(this).val());
    });
    
    // Eventos para seleccionar items
    $(document).on('click', '.btn-seleccionar-asignacion-cliente', function() {
        const idAsignacion = $(this).data('id');
        $('#idAsignacionCliente').val(idAsignacion);
        $('#asignacionCliente').val($(this).data('texto'));
        $('#modalBuscarAsignacionCliente').modal('hide');
        
        // Obtener el vehículo asociado a esta asignación
        obtenerVehiculoAsignacion(idAsignacion, 'natural');
    });
    
    $(document).on('click', '.btn-seleccionar-asignacion-empresa', function() {
        const idAsignacion = $(this).data('id');
        $('#idAsignacionEmpresa').val(idAsignacion);
        $('#asignacionEmpresa').val($(this).data('texto'));
        $('#modalBuscarAsignacionEmpresa').modal('hide');
        
        // Obtener el vehículo asociado a esta asignación
        obtenerVehiculoAsignacion(idAsignacion, 'empresa');
    });
    
    $(document).on('click', '.btn-seleccionar-ruta', function() {
        $('#idRuta').val($(this).data('id'));
        $('#ruta').val($(this).data('texto'));
        $('#modalBuscarRuta').modal('hide');
    });
    
    $(document).on('click', '.btn-seleccionar-conductor', function() {
        $('#idConductor').val($(this).data('id'));
        $('#conductor').val($(this).data('texto'));
        $('#modalBuscarConductor').modal('hide');
    });
    
    // Guardar planificación
    $('#btnGuardarPlanificacion').click(function() {
        const formData = $('#formPlanificacion').serializeArray();
        const data = {};
        
        // Convertir a objeto
        formData.forEach(item => {
            data[item.name] = item.value;
        });
        
        // Determinar si es cliente natural o empresa
        data.tipoCliente = currentTipoCliente;
        
        // Validar campos requeridos
        if (currentTipoCliente === 'natural' && !data.idAsignacion) {
            Swal.fire('Error', 'Debe seleccionar una asignación de cliente', 'error');
            return;
        }
        
        if (currentTipoCliente === 'empresa' && !data.idAsignacionEmpresa) {
            Swal.fire('Error', 'Debe seleccionar una asignación de empresa', 'error');
            return;
        }
        
        if (!data.idRuta) {
            Swal.fire('Error', 'Debe seleccionar una ruta', 'error');
            return;
        }
        
        if (!data.idVehiculo) {
            Swal.fire('Error', 'Debe tener un vehículo asignado', 'error');
            return;
        }
        
        if (!data.idConductor) {
            Swal.fire('Error', 'Debe seleccionar un conductor', 'error');
            return;
        }
        
        if (!data.fechaPlanificada) {
            Swal.fire('Error', 'Debe especificar una fecha planificada', 'error');
            return;
        }
        
        if (!data.horaPlanificada) {
            Swal.fire('Error', 'Debe especificar una hora planificada', 'error');
            return;
        }
        
        $.ajax({
            url: '../planificacion/guardar.php',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Planificación guardada correctamente',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#planificacionModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Error al guardar la planificación',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Error en la conexión con el servidor',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>