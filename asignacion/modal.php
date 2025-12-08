<!-- Modal principal de asignación -->
<div class="modal fade" id="asignacionModal" tabindex="-1" aria-labelledby="asignacionModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignacionModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-truck-loading me-2"></i>Asignación de Carga
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#asignacionModal').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form id="asignacionForm">
                    <!-- Selector de Tipo de Cliente -->
                    <div class="tipo-cliente-selector mb-4">
                        <label class="form-label fw-medium mb-3">Tipo de Cliente</label>
                        <div class="d-flex gap-4">
                            <div class="tipo-cliente-option" id="selectorNatural">
                                <input class="form-check-input" type="radio" name="tipoCliente" id="clienteNatural" value="natural" checked>
                                <label class="tipo-cliente-label" for="clienteNatural">
                                    <div class="icon-container">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Cliente Natural</span>
                                </label>
                            </div>
                            <div class="tipo-cliente-option" id="selectorEmpresa">
                                <input class="form-check-input" type="radio" name="tipoCliente" id="clienteEmpresa" value="empresa">
                                <label class="tipo-cliente-label" for="clienteEmpresa">
                                    <div class="icon-container">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>Empresa</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Sección para Cliente Natural (visible por defecto) -->
                    <div id="seccionNatural" class="animate-fade-in">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-outline-primary" id="buscarCotizacionNatural" style="padding: 10px 20px; border-radius: 6px;">
                                <i class="fas fa-search me-2"></i> Buscar Cotización Cliente
                            </button>
                        </div>
                        
                        <!-- Información de la cotización (solo lectura) -->
                        <div id="infoCotizacionNatural" class="readonly-info mt-4" style="display: none;">
                            <div class="section-divider">
                                <span>Información de la Cotización</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="codigoCotizacionNatural" readonly>
                                        <label for="codigoCotizacionNatural">Código</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="clienteNaturalNombre" readonly>
                                        <label for="clienteNaturalNombre">Cliente</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="vehiculoNatural" readonly>
                                        <label for="vehiculoNatural">Vehículo</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="pesoNatural" readonly>
                                        <label for="pesoNatural">Peso</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="volumenNatural" readonly>
                                        <label for="volumenNatural">Volumen</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="idCotizacionNatural">
                        </div>
                    </div>

                    <!-- Sección para Empresa (oculta por defecto) -->
                    <div id="seccionEmpresa" style="display: none;" class="animate-fade-in">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-outline-primary" id="buscarCotizacionEmpresa" style="padding: 10px 20px; border-radius: 6px;">
                                <i class="fas fa-search me-2"></i> Buscar Cotización Empresa
                            </button>
                        </div>
                        
                        <!-- Información de la cotización (solo lectura) -->
                        <div id="infoCotizacionEmpresa" class="readonly-info mt-4" style="display: none;">
                            <div class="section-divider">
                                <span>Información de la Cotización</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="codigoCotizacionEmpresa" readonly>
                                        <label for="codigoCotizacionEmpresa">Código</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="empresaNombre" readonly>
                                        <label for="empresaNombre">Empresa</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="vehiculoEmpresa" readonly>
                                        <label for="vehiculoEmpresa">Vehículo</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="pesoEmpresa" readonly>
                                        <label for="pesoEmpresa">Peso</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="volumenEmpresa" readonly>
                                        <label for="volumenEmpresa">Volumen</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="idCotizacionEmpresa">
                        </div>
                    </div>

                    <!-- Campos editables para la asignación -->
                    <div class="section-divider mt-4">
                        <span>Detalles de la Asignación</span>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="form-floating">
                            <textarea class="form-control" id="observaciones" style="height: 100px;"></textarea>
                            <label for="observaciones">Observaciones</label>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-floating">
                            <select class="form-select" id="estadoAsignacion">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En tránsito">En tránsito</option>
                                <option value="Entregado">Entregado</option>
                            </select>
                            <label for="estadoAsignacion">Estado</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#asignacionModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="guardarAsignacion">
                    <i class="fas fa-save me-2"></i>Guardar Asignación
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cotizaciones Naturales -->
<div class="modal fade" id="modalCotizacionesNaturales" tabindex="-1" aria-labelledby="modalCotizacionesNaturalesLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCotizacionesNaturalesLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-invoice me-2"></i>Seleccionar Cotización - Clientes Naturales
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalCotizacionesNaturales').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <!-- Barra de búsqueda -->
                <div class="input-group mb-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="buscarNaturalInput" placeholder="Buscar...">
                        <label for="buscarNaturalInput">Buscar por código, cliente o vehículo...</label>
                    </div>
                    <button class="btn btn-primary" type="button" id="buscarNaturalBtn" style="border-radius: 0 6px 6px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaCotizacionesNaturales">
                        <thead class="table-light">
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Vehículo</th>
                                <th>Peso</th>
                                <th>Volumen</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalCotizacionesNaturales').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cotizaciones Empresas -->
<div class="modal fade" id="modalCotizacionesEmpresas" tabindex="-1" aria-labelledby="modalCotizacionesEmpresasLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCotizacionesEmpresasLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-invoice me-2"></i>Seleccionar Cotización - Empresas
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalCotizacionesEmpresas').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <!-- Barra de búsqueda -->
                <div class="input-group mb-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="buscarEmpresaInput" placeholder="Buscar...">
                        <label for="buscarEmpresaInput">Buscar por código, empresa o vehículo...</label>
                    </div>
                    <button class="btn btn-primary" type="button" id="buscarEmpresaBtn" style="border-radius: 0 6px 6px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaCotizacionesEmpresas">
                        <thead class="table-light">
                            <tr>
                                <th>Código</th>
                                <th>Empresa</th>
                                <th>Vehículo</th>
                                <th>Peso</th>
                                <th>Volumen</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalCotizacionesEmpresas').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para el modal de asignación de carga */
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

/* Estilos para el modal */
.modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

.modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block;
    position: relative;
}

.modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 50px;
    height: 3px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Selector de tipo de cliente */
.tipo-cliente-selector {
    padding-bottom: 20px;
    border-bottom: 1px solid var(--light-gray);
}

.tipo-cliente-option {
    position: relative;
    width: 170px;
}

.tipo-cliente-option .form-check-input {
    position: absolute;
    opacity: 0;
}

.tipo-cliente-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
    border: 2px solid var(--light-gray);
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    text-align: center;
}

.tipo-cliente-label .icon-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background-color: var(--primary-light);
    border-radius: 50%;
    margin-bottom: 12px;
    color: var(--primary-color);
    font-size: 20px;
    transition: var(--transition);
}

.tipo-cliente-label span {
    font-weight: 500;
    color: var(--dark-color);
    transition: var(--transition);
}

.tipo-cliente-option .form-check-input:checked + .tipo-cliente-label {
    border-color: var(--primary-color);
    background-color: var(--primary-light);
}

.tipo-cliente-option .form-check-input:checked + .tipo-cliente-label .icon-container {
    background-color: var(--primary-color);
    color: white;
}

/* Estilos para el contenido del formulario */
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

/* Estilos para los campos flotantes */
.form-floating > .form-control,
.form-floating > .form-select,
.form-floating > .form-control-plaintext {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: var(--border-radius);
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > .form-control-plaintext ~ label {
    color: var(--gray-color);
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
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

.form-floating > .form-control-plaintext ~ label,
.form-floating > .form-control:disabled ~ label {
    color: var(--gray-color);
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para textarea */
.form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

/* Estilos para etiquetas y texto */
.form-label {
    color: var(--dark-color);
    margin-bottom: 8px;
}

.fw-medium {
    font-weight: 500;
}

/* Estilos para botones */
.btn {
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 6px;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white;
}

.btn-outline-secondary {
    color: var(--gray-color);
    border-color: var(--light-gray);
}

.btn-outline-secondary:hover {
    background-color: var(--light-gray);
    color: var(--dark-color);
    border-color: var(--light-gray);
}

.btn-close {
    opacity: 0.5;
    transition: var(--transition);
}

.btn-close:hover {
    opacity: 1;
}

/* Animaciones */
.animate-fade-in {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Estilos para tablas */
.table {
    color: var(--dark-color);
    margin-bottom: 0;
}

.table thead th {
    border-bottom: 1px solid var(--light-gray);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: var(--gray-color);
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: var(--light-color);
}

.table-hover tbody tr:hover {
    background-color: var(--primary-light);
    color: var(--primary-dark);
}

/* Barra de búsqueda */
.input-group {
    border-radius: var(--border-radius);
    overflow: hidden;
}

.input-group .form-control {
    border-right: none;
}

.input-group .btn {
    border-left: none;
}

/* Personalizaciones para bootstrap */
.row {
    --bs-gutter-x: 1.5rem;
}

.g-3 {
    --bs-gutter-y: 1rem;
}

.mt-1 {
    margin-top: 0.5rem !important;
}

.mt-3 {
    margin-top: 1rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

.gap-4 {
    gap: 1.5rem !important;
}

/* Estilos para campos readonly */
.readonly-info .form-control[readonly] {
    background-color: var(--light-color);
    border-color: var(--light-gray);
    color: var(--dark-color);
}
</style>

<script>
$(document).ready(function() {
    // Variables para almacenar los datos originales
    var cotizacionesNaturalesOriginales = [];
    var cotizacionesEmpresasOriginales = [];
    
    // Mostrar/ocultar secciones según el tipo de cliente seleccionado
    $('input[name="tipoCliente"]').change(function() {
        if ($(this).val() === 'natural') {
            $('#seccionNatural').show();
            $('#seccionEmpresa').hide();
            $('#infoCotizacionEmpresa').hide();
        } else {
            $('#seccionNatural').hide();
            $('#seccionEmpresa').show();
            $('#infoCotizacionNatural').hide();
        }
    });

    // Abrir modal de búsqueda para clientes naturales
    $('#buscarCotizacionNatural').click(function() {
        var modalNatural = new bootstrap.Modal(document.getElementById('modalCotizacionesNaturales'));
        modalNatural.show();
        cargarCotizacionesNaturales();
    });

    // Abrir modal de búsqueda para empresas
    $('#buscarCotizacionEmpresa').click(function() {
        var modalEmpresa = new bootstrap.Modal(document.getElementById('modalCotizacionesEmpresas'));
        modalEmpresa.show();
        cargarCotizacionesEmpresas();
    });

    // Función para filtrar cotizaciones naturales
    function filtrarCotizacionesNaturales(termino) {
        var tabla = $('#tablaCotizacionesNaturales tbody');
        tabla.empty();
        
        if (termino === '') {
            // Mostrar todos los resultados si no hay término de búsqueda
            mostrarCotizacionesNaturales(cotizacionesNaturalesOriginales);
            return;
        }
        
        termino = termino.toLowerCase();
        var resultados = cotizacionesNaturalesOriginales.filter(function(cotizacion) {
            return (
                cotizacion.idCotizacion.toString().includes(termino) ||
                cotizacion.nombreCliente.toLowerCase().includes(termino) ||
                cotizacion.placa.toLowerCase().includes(termino) ||
                cotizacion.modelo.toLowerCase().includes(termino)
            );
        });
        
        mostrarCotizacionesNaturales(resultados);
    }
    
    // Función para mostrar cotizaciones naturales en la tabla
    function mostrarCotizacionesNaturales(data) {
        var tabla = $('#tablaCotizacionesNaturales tbody');
        tabla.empty();
        
        if(data.length === 0) {
            tabla.append('<tr><td colspan="8" class="text-center">No se encontraron resultados</td></tr>');
            return;
        }
        
        $.each(data, function(index, cotizacion) {
            var fila = '<tr>' +
                '<td>' + cotizacion.idCotizacion + '</td>' +
                '<td>' + cotizacion.nombreCliente + '</td>' +
                '<td>' + cotizacion.placa + ' - ' + cotizacion.modelo + '</td>' +
                '<td>' + cotizacion.peso + ' kg</td>' +
                '<td>' + cotizacion.volumen + ' m³</td>' +
                '<td>S/ ' + cotizacion.montoFinal + '</td>' +
                '<td>' + cotizacion.estado + '</td>' +
                '<td><button class="btn btn-sm btn-primary seleccionar-natural" data-id="' + cotizacion.idCotizacion + 
                '" data-codigo="' + cotizacion.idCotizacion + 
                '" data-cliente="' + cotizacion.nombreCliente + 
                '" data-vehiculo="' + cotizacion.placa + ' - ' + cotizacion.modelo + 
                '" data-peso="' + cotizacion.peso + 
                '" data-volumen="' + cotizacion.volumen + '">Seleccionar</button></td>' +
                '</tr>';
            tabla.append(fila);
        });
        
        // Asignar evento a los botones de selección
        $('.seleccionar-natural').click(function() {
            var id = $(this).data('id');
            var codigo = $(this).data('codigo');
            var cliente = $(this).data('cliente');
            var vehiculo = $(this).data('vehiculo');
            var peso = $(this).data('peso');
            var volumen = $(this).data('volumen');
            
            $('#idCotizacionNatural').val(id);
            $('#codigoCotizacionNatural').val(codigo);
            $('#clienteNaturalNombre').val(cliente);
            $('#vehiculoNatural').val(vehiculo);
            $('#pesoNatural').val(peso + ' kg');
            $('#volumenNatural').val(volumen + ' m³');
            
            $('#infoCotizacionNatural').show();
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalCotizacionesNaturales'));
            modal.hide();
        });
    }

    // Función para filtrar cotizaciones de empresas
    function filtrarCotizacionesEmpresas(termino) {
        var tabla = $('#tablaCotizacionesEmpresas tbody');
        tabla.empty();
        
        if (termino === '') {
            // Mostrar todos los resultados si no hay término de búsqueda
            mostrarCotizacionesEmpresas(cotizacionesEmpresasOriginales);
            return;
        }
        
        termino = termino.toLowerCase();
        var resultados = cotizacionesEmpresasOriginales.filter(function(cotizacion) {
            return (
                cotizacion.idCotizacionEmpresa.toString().includes(termino) ||
                cotizacion.razonSocial.toLowerCase().includes(termino) ||
                cotizacion.placa.toLowerCase().includes(termino) ||
                cotizacion.modelo.toLowerCase().includes(termino)
            );
        });
        
        mostrarCotizacionesEmpresas(resultados);
    }
    
    // Función para mostrar cotizaciones de empresas en la tabla
    function mostrarCotizacionesEmpresas(data) {
        var tabla = $('#tablaCotizacionesEmpresas tbody');
        tabla.empty();
        
        if(data.length === 0) {
            tabla.append('<tr><td colspan="8" class="text-center">No se encontraron resultados</td></tr>');
            return;
        }
        
        $.each(data, function(index, cotizacion) {
            var fila = '<tr>' +
                '<td>' + cotizacion.idCotizacionEmpresa + '</td>' +
                '<td>' + cotizacion.razonSocial + '</td>' +
                '<td>' + cotizacion.placa + ' - ' + cotizacion.modelo + '</td>' +
                '<td>' + cotizacion.peso + ' kg</td>' +
                '<td>' + cotizacion.volumen + ' m³</td>' +
                '<td>S/ ' + cotizacion.montoFinal + '</td>' +
                '<td>' + cotizacion.estado + '</td>' +
                '<td><button class="btn btn-sm btn-primary seleccionar-empresa" data-id="' + cotizacion.idCotizacionEmpresa + 
                '" data-codigo="' + cotizacion.idCotizacionEmpresa + 
                '" data-empresa="' + cotizacion.razonSocial + 
                '" data-vehiculo="' + cotizacion.placa + ' - ' + cotizacion.modelo + 
                '" data-peso="' + cotizacion.peso + 
                '" data-volumen="' + cotizacion.volumen + '">Seleccionar</button></td>' +
                '</tr>';
            tabla.append(fila);
        });
        
        // Asignar evento a los botones de selección
        $('.seleccionar-empresa').click(function() {
            var id = $(this).data('id');
            var codigo = $(this).data('codigo');
            var empresa = $(this).data('empresa');
            var vehiculo = $(this).data('vehiculo');
            var peso = $(this).data('peso');
            var volumen = $(this).data('volumen');
            
            $('#idCotizacionEmpresa').val(id);
            $('#codigoCotizacionEmpresa').val(codigo);
            $('#empresaNombre').val(empresa);
            $('#vehiculoEmpresa').val(vehiculo);
            $('#pesoEmpresa').val(peso + ' kg');
            $('#volumenEmpresa').val(volumen + ' m³');
            
            $('#infoCotizacionEmpresa').show();
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalCotizacionesEmpresas'));
            modal.hide();
        });
    }

    // Función para cargar cotizaciones de clientes naturales
    function cargarCotizacionesNaturales() {
        $.ajax({
            url: '../asignacion/buscarcliente.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                cotizacionesNaturalesOriginales = data;
                mostrarCotizacionesNaturales(data);
                
                // Configurar evento de búsqueda
                $('#buscarNaturalInput').on('keyup', function() {
                    filtrarCotizacionesNaturales($(this).val());
                });
                
                $('#buscarNaturalBtn').click(function() {
                    filtrarCotizacionesNaturales($('#buscarNaturalInput').val());
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar las cotizaciones: ' + error
                });
            }
        });
    }

    // Función para cargar cotizaciones de empresas
    function cargarCotizacionesEmpresas() {
        $.ajax({
            url: '../asignacion/buscarempresa.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                cotizacionesEmpresasOriginales = data;
                mostrarCotizacionesEmpresas(data);
                
                // Configurar evento de búsqueda
                $('#buscarEmpresaInput').on('keyup', function() {
                    filtrarCotizacionesEmpresas($(this).val());
                });
                
                $('#buscarEmpresaBtn').click(function() {
                    filtrarCotizacionesEmpresas($('#buscarEmpresaInput').val());
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar las cotizaciones: ' + error
                });
            }
        });
    }


    // Guardar la asignación
    $('#guardarAsignacion').click(function() {
        var tipoCliente = $('input[name="tipoCliente"]:checked').val();
        var idCotizacion, tablaAsignacion;
        
        if (tipoCliente === 'natural') {
            idCotizacion = $('#idCotizacionNatural').val();
            tablaAsignacion = 'asignacion_carga_cliente';
            if (!idCotizacion) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: 'Por favor seleccione una cotización de cliente natural'
                });
                return;
            }
        } else {
            idCotizacion = $('#idCotizacionEmpresa').val();
            tablaAsignacion = 'asignacion_carga_empresa';
            if (!idCotizacion) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: 'Por favor seleccione una cotización de empresa'
                });
                return;
            }
        }
        
        var observaciones = $('#observaciones').val();
        var estado = $('#estadoAsignacion').val();
        
        // Mostrar confirmación antes de guardar
        Swal.fire({
            title: '¿Confirmar asignación?',
            text: "¿Está seguro de guardar esta asignación?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar datos al servidor
                $.ajax({
                    url: '../asignacion/guardar.php',
                    type: 'POST',
                    data: {
                        tipoCliente: tipoCliente,
                        idCotizacion: idCotizacion,
                        tablaAsignacion: tablaAsignacion,
                        observaciones: observaciones,
                        estado: estado
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Asignación guardada correctamente',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            // Cerrar modal y recargar página
                            bootstrap.Modal.getInstance(document.getElementById('asignacionModal')).hide();
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al guardar la asignación: ' + error
                        });
                    }
                });
            }
        });
    });

    // Manejar el cierre del modal principal para limpiar el formulario
    $('#asignacionModal').on('hidden.bs.modal', function () {
        $('#asignacionForm')[0].reset();
        $('#infoCotizacionNatural, #infoCotizacionEmpresa').hide();
    });
});
</script>