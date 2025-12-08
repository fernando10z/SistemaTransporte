<!-- Modal para Eventos de Ruta -->
<div class="modal fade" id="modalEventoRuta" tabindex="-1" aria-labelledby="modalEventoRutaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEventoRutaLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-route me-2"></i>Registro de Evento en Ruta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEventoRuta">
                    <input type="hidden" id="idEvento" name="idEvento">
                    
                    <!-- Selector de Tipo de Cliente -->
                    <div class="section-divider">
                        <span>Tipo de Cliente</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <div class="tipo-cliente-selector">
                                <div class="tipo-cliente-options">
                                    <div class="tipo-cliente-option active" id="selectorNaturalEvento">
                                        <input class="form-check-input" type="radio" name="tipoClienteEvento" id="tipoNaturalEvento" value="Natural" checked>
                                        <label class="tipo-cliente-label" for="tipoNaturalEvento">
                                            <div class="icon-container">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <span>Persona Natural</span>
                                        </label>
                                    </div>
                                    <div class="tipo-cliente-option" id="selectorEmpresaEvento">
                                        <input class="form-check-input" type="radio" name="tipoClienteEvento" id="tipoEmpresaEvento" value="Empresa">
                                        <label class="tipo-cliente-label" for="tipoEmpresaEvento">
                                            <div class="icon-container">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <span>Empresa</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campos para Persona Natural -->
                    <div id="camposNaturalEvento" class="form-section active">
                        <div class="section-divider mt-4">
                            <span>Información de Planificación</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="clienteNaturalInfo" placeholder="Cliente" readonly>
                                    <label for="clienteNaturalInfo">Cliente <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarPlanificacionCliente()">
                                    <i class="fas fa-search me-2"></i> Buscar Planificación
                                </button>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="rutaCliente" placeholder="Ruta" readonly>
                                    <label for="rutaCliente">Ruta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="conductorCliente" placeholder="Conductor" readonly>
                                    <label for="conductorCliente">Conductor</label>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="idPlanificacionCliente" name="idPlanificacion">
                    </div>
                    
                    <!-- Campos para Empresa -->
                    <div id="camposEmpresaEvento" class="form-section">
                        <div class="section-divider mt-4">
                            <span>Información de Planificación</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="empresaInfo" placeholder="Empresa" readonly>
                                    <label for="empresaInfo">Empresa <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarPlanificacionEmpresa()">
                                    <i class="fas fa-search me-2"></i> Buscar Planificación
                                </button>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="rutaEmpresa" placeholder="Ruta" readonly>
                                    <label for="rutaEmpresa">Ruta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="conductorEmpresa" placeholder="Conductor" readonly>
                                    <label for="conductorEmpresa">Conductor</label>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="idPlanificacionEmpresa" name="idPlanificacionEmpresa">
                    </div>
                    
                    <!-- Campos comunes -->
                    <div class="section-divider mt-4">
                        <span>Detalles del Evento</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipoEvento" name="tipoEvento" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Desvío">Desvío</option>
                                    <option value="Retraso">Retraso</option>
                                    <option value="Incidente">Incidente</option>
                                    <option value="Iniciando">Iniciando</option>
                                    <option value="Completado">Completado</option>
                                </select>
                                <label for="tipoEvento">Tipo de Evento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="fechaEvento" name="fechaEvento" required>
                                <label for="fechaEvento">Fecha y Hora del Evento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud" required>
                                <label for="latitud">Latitud <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud" required>
                                <label for="longitud">Longitud <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-5s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarEvento">
                    <i class="fas fa-save me-2"></i> Guardar Evento
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar Planificación de Cliente -->
<div class="modal fade" id="modalBuscarPlanificacionCliente" tabindex="-1" aria-labelledby="modalBuscarPlanificacionClienteLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarPlanificacionClienteLabel" >
                    <i class="fas fa-search me-2"></i>Buscar Planificación - Clientes Naturales
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
                            <div class="input-group">
                                <input type="text" class="form-control" id="busquedaPlanificacionCliente" placeholder="Buscar por nombre, documento, ruta...">
                                <button class="btn btn-outline-primary" type="button" onclick="filtrarPlanificacionesCliente()">
                                    <i class="fas fa-search me-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Cliente</th>
                                <th>Documento</th>
                                <th>Ruta</th>
                                <th>Conductor</th>
                                <th>Fecha Planificación</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPlanificacionesCliente">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar Planificación de Empresa -->
<div class="modal fade" id="modalBuscarPlanificacionEmpresa" tabindex="-1" aria-labelledby="modalBuscarPlanificacionEmpresaLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarPlanificacionEmpresaLabel" >
                    <i class="fas fa-search me-2"></i>Buscar Planificación - Empresas
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
                            <div class="input-group">
                                <input type="text" class="form-control" id="busquedaPlanificacionEmpresa" placeholder="Buscar por razón social, RUC, ruta...">
                                <button class="btn btn-outline-primary" type="button" onclick="filtrarPlanificacionesEmpresa()">
                                    <i class="fas fa-search me-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Empresa</th>
                                <th>RUC</th>
                                <th>Ruta</th>
                                <th>Conductor</th>
                                <th>Fecha Planificación</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPlanificacionesEmpresa">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modales de eventos de ruta */
#modalEventoRuta .modal-content,
#modalBuscarPlanificacionCliente .modal-content,
#modalBuscarPlanificacionEmpresa .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#modalEventoRuta .modal-header,
#modalBuscarPlanificacionCliente .modal-header,
#modalBuscarPlanificacionEmpresa .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#modalEventoRuta .modal-title,
#modalBuscarPlanificacionCliente .modal-title,
#modalBuscarPlanificacionEmpresa .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#modalEventoRuta .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#modalBuscarPlanificacionCliente .modal-title::after,
#modalBuscarPlanificacionEmpresa .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#modalEventoRuta .modal-body,
#modalBuscarPlanificacionCliente .modal-body,
#modalBuscarPlanificacionEmpresa .modal-body {
    padding: 25px;
}

#modalEventoRuta .modal-footer,
#modalBuscarPlanificacionCliente .modal-footer,
#modalBuscarPlanificacionEmpresa .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para el selector de tipo de cliente */
.tipo-cliente-selector {
    margin-bottom: 1.5rem;
}

.tipo-cliente-options {
    display: flex;
    gap: 1rem;
}

.tipo-cliente-option {
    flex: 1;
    position: relative;
}

.tipo-cliente-option input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.tipo-cliente-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    border: 2px solid var(--light-gray);
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    height: 100%;
    text-align: center;
}

.tipo-cliente-option input[type="radio"]:checked + .tipo-cliente-label {
    border-color: var(--primary-color);
    background-color: var(--primary-light);
}

.icon-container {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.5rem;
    background-color: var(--light-gray);
    color: var(--gray-color);
    transition: var(--transition);
}

.tipo-cliente-option input[type="radio"]:checked + .tipo-cliente-label .icon-container {
    background-color: var(--primary-color);
    color: white;
}

.tipo-cliente-option span {
    font-weight: 500;
    color: var(--gray-color);
    transition: var(--transition);
}

.tipo-cliente-option input[type="radio"]:checked + .tipo-cliente-label span {
    color: var(--primary-color);
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

.animate__delay-5s {
    animation-delay: 1.0s;
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

/* Estilos para textarea */
textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

/* Estilos para scroll personalizado */
.modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

.table-responsive {
    max-height: 60vh;
    overflow-y: auto;
}

/* Estilos para formularios alternados */
.form-section {
    display: none;
}

.form-section.active {
    display: block;
}
#modalEventoRuta .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEventoRuta .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFechaHora = document.getElementById('fechaEvento');

        // Obtener fecha y hora actual en formato compatible con datetime-local
        const now = new Date();
        const pad = num => num.toString().padStart(2, '0');
        const fechaActual = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`;

        // Establecer el valor inicial y el mínimo
        inputFechaHora.value = fechaActual;
        inputFechaHora.min = fechaActual;

        // Validación al cambiar manualmente
        inputFechaHora.addEventListener('change', function () {
            if (this.value < this.min) {
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha y hora inválidas',
                    text: 'No puedes seleccionar una fecha y hora anterior a la actual.',
                    confirmButtonText: 'Entendido'
                });
                this.value = this.min;
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    // Cambiar entre cliente natural y empresa
    $('input[name="tipoClienteEvento"]').change(function() {
        if ($(this).val() === 'Natural') {
            $('#camposNaturalEvento').show();
            $('#camposEmpresaEvento').hide();
            $('#idPlanificacionEmpresa').val('');
            $('#empresaInfo').val('');
            $('#rutaEmpresa').val('');
            $('#conductorEmpresa').val('');
        } else {
            $('#camposNaturalEvento').hide();
            $('#camposEmpresaEvento').show();
            $('#idPlanificacionCliente').val('');
            $('#clienteNaturalInfo').val('');
            $('#rutaCliente').val('');
            $('#conductorCliente').val('');
        }
    });

    // Configurar fecha actual por defecto
    $('#fechaEvento').val(new Date().toISOString().slice(0, 16));

    // Botón guardar evento
    $('#btnGuardarEvento').click(function() {
        guardarEventoRuta();
    });
});

function buscarPlanificacionCliente() {
    $('#modalBuscarPlanificacionCliente').modal('show');
    cargarPlanificacionesCliente();
}

function buscarPlanificacionEmpresa() {
    $('#modalBuscarPlanificacionEmpresa').modal('show');
    cargarPlanificacionesEmpresa();
}
function cargarPlanificacionesCliente() {
    $.ajax({
        url: '../eventos/obtenerplanificacioncliente.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Datos recibidos:', data); // Para depuración
            if (data.error) {
                console.error('Error del servidor:', data.error);
                return;
            }
            
            let html = '';
            if (data.length === 0) {
                html = '<tr><td colspan="6" class="text-center">No se encontraron planificaciones</td></tr>';
            } else {
                data.forEach(planificacion => {
                    html += `
                        <tr>
                            <td>${planificacion.nombre_completo}</td>
                            <td>${planificacion.tipo_documento}: ${planificacion.numero_documento}</td>
                            <td>${planificacion.ruta}</td>
                            <td>${planificacion.conductor}</td>
                            <td>${planificacion.fecha_planificada} ${planificacion.hora_planificada}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="seleccionarPlanificacionCliente(
                                    '${planificacion.idPlanificacion}',
                                    '${planificacion.nombre_completo.replace(/'/g, "\\'")}',
                                    '${planificacion.ruta.replace(/'/g, "\\'")}',
                                    '${planificacion.conductor.replace(/'/g, "\\'")}'
                                )">
                                    <i class="fas fa-check"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `;
                });
            }
            $('#tablaPlanificacionesCliente').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error en AJAX:', status, error);
            console.log('Respuesta del servidor:', xhr.responseText);
            $('#tablaPlanificacionesCliente').html('<tr><td colspan="6" class="text-center">Error al cargar datos</td></tr>');
        }
    });
}
function cargarPlanificacionesEmpresa() {
    $.ajax({
        url: 'eventos/obtenerplanificacionempresa.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let html = '';
            data.forEach(planificacion => {
                html += `
                    <tr>
                        <td>${planificacion.razonSocial}</td>
                        <td>${planificacion.ruc}</td>
                        <td>${planificacion.ruta}</td>
                        <td>${planificacion.conductor}</td>
                        <td>${planificacion.fecha_planificada} ${planificacion.hora_planificada}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="seleccionarPlanificacionEmpresa(
                                ${planificacion.id_planificacion},
                                '${planificacion.razonSocial}',
                                '${planificacion.ruta}',
                                '${planificacion.conductor}'
                            )">
                                <i class="fas fa-check"></i> Seleccionar
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#tablaPlanificacionesEmpresa').html(html);
        },
        error: function(error) {
            console.error('Error al cargar planificaciones:', error);
        }
    });
}

function filtrarPlanificacionesCliente() {
    const busqueda = $('#busquedaPlanificacionCliente').val().toLowerCase();
    $('#tablaPlanificacionesCliente tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

function filtrarPlanificacionesEmpresa() {
    const busqueda = $('#busquedaPlanificacionEmpresa').val().toLowerCase();
    $('#tablaPlanificacionesEmpresa tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

function seleccionarPlanificacionCliente(idPlanificacion, nombreCompleto, ruta, conductor) {
    $('#idPlanificacionCliente').val(idPlanificacion);
    $('#clienteNaturalInfo').val(nombreCompleto);
    $('#rutaCliente').val(ruta);
    $('#conductorCliente').val(conductor);
    $('#modalBuscarPlanificacionCliente').modal('hide');
}

function seleccionarPlanificacionEmpresa(idPlanificacion, razonSocial, ruta, conductor) {
    $('#idPlanificacionEmpresa').val(idPlanificacion);
    $('#empresaInfo').val(razonSocial);
    $('#rutaEmpresa').val(ruta);
    $('#conductorEmpresa').val(conductor);
    $('#modalBuscarPlanificacionEmpresa').modal('hide');
}
function guardarEventoRuta() {
    const formData = $('#formEventoRuta').serialize();
    const tipoCliente = $('input[name="tipoClienteEvento"]:checked').val();
    
    let url = '';
    if (tipoCliente === 'Natural') {
        url = '../eventos/guardarcliente.php';
    } else {
        url = '../eventos/guardarempresa.php';
    }
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false,
                    willClose: () => {
                        // Esta función se ejecutará cuando se cierre el Swal
                        location.reload(); // Recarga la página
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al guardar el evento'
            });
        }
    });
}
// Obtener ubicación actual
function obtenerUbicacionActual() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                $('#latitud').val(position.coords.latitude);
                $('#longitud').val(position.coords.longitude);
            },
            function(error) {
                console.error('Error al obtener ubicación:', error);
                Swal.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: 'No se pudo obtener la ubicación automática. Por favor ingrésela manualmente.'
                });
            }
        );
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Geolocalización no soportada por tu navegador. Por favor ingresa la ubicación manualmente.'
        });
    }
}

// Llamar a obtenerUbicacionActual() cuando sea necesario, por ejemplo al abrir el modal
$('#modalEventoRuta').on('shown.bs.modal', function() {
    obtenerUbicacionActual();
});
</script>
<style>
    /* Estilos para el modal de eventos */
.tipo-cliente-selector {
    margin-bottom: 1.5rem;
}

.tipo-cliente-option {
    position: relative;
    flex: 1;
}

.tipo-cliente-option input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.tipo-cliente-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    border: 2px solid #dee2e6;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 100%;
}

.tipo-cliente-option input[type="radio"]:checked + .tipo-cliente-label {
    border-color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.05);
}

.icon-container {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: #6c757d;
}

.tipo-cliente-option input[type="radio"]:checked + .tipo-cliente-label .icon-container {
    color: #0d6efd;
}

.section-divider {
    position: relative;
    margin: 1.5rem 0;
    text-align: center;
}

.section-divider span {
    display: inline-block;
    padding: 0 1rem;
    background-color: #fff;
    position: relative;
    z-index: 1;
    color: #0d6efd;
    font-weight: 500;
}

.section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: #dee2e6;
    z-index: 0;
}

/* Estilos para los modales de búsqueda */
.modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

.file-upload-container {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.file-upload-preview {
    width: 100px;
    height: 100px;
    border: 1px dashed #dee2e6;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.file-upload-preview img {
    max-width: 100%;
    max-height: 100%;
    display: none;
}

.file-preview-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.2);
    opacity: 0;
    transition: opacity 0.3s;
}

.file-upload-preview:hover .file-preview-overlay {
    opacity: 1;
}

.file-upload-input {
    flex: 1;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
}

.file-upload-label:hover {
    border-color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.05);
}

.file-upload-hints {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #6c757d;
    display: flex;
    gap: 0.5rem;
}

.status-selector {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.form-switch-lg .form-check-input {
    width: 3rem;
    height: 1.5rem;
}

.status-text {
    font-weight: 500;
}

.status-text.inactive {
    display: none;
    color: #dc3545;
}

.form-check-input:not(:checked) ~ .status-text.active {
    display: none;
}

.form-check-input:not(:checked) ~ .status-text.inactive {
    display: inline;
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>