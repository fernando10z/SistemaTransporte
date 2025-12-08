<!-- Modal para Registrar Contrato - Diseño Moderno -->
<div class="modal fade" id="registrarContratoModal" tabindex="-1" role="dialog" aria-labelledby="registrarContratoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarContratoModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-contract me-2"></i>Nueva Factura
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#registrarContratoModal').modal('hide')"></button>
            </div>
            <form id="contratoForm">
                <div class="modal-body">
                    <!-- Selección de tipo de contrato -->
                    <div class="tipo-contrato-selector mb-4">
                        <label class="form-label fw-medium mb-3">Tipo de Contrato <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4">
                            <div class="tipo-contrato-option" id="selectorContratoNatural">
                                <input class="form-check-input" type="radio" name="tipoContrato" id="contratoNatural" value="natural" checked>
                                <label class="tipo-contrato-label" for="contratoNatural">
                                    <div class="icon-container">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Contrato Natural</span>
                                </label>
                            </div>
                            <div class="tipo-contrato-option" id="selectorContratoEmpresa">
                                <input class="form-check-input" type="radio" name="tipoContrato" id="contratoEmpresa" value="empresa">
                                <label class="tipo-contrato-label" for="contratoEmpresa">
                                    <div class="icon-container">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>Contrato Empresa</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Cliente/Empresa -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light-primary">
                            <h6 class="mb-0"><i class="fas fa-user-tie me-2"></i>Información del Cliente/Empresa</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="clienteInfo" placeholder="Cliente/Empresa" readonly>
                                        <label for="clienteInfo">Cliente/Empresa <span class="text-danger">*</span></label>
                                        <input type="hidden" id="idClienteEmpresa" name="idClienteEmpresa">
                                        <div id="infoAdicionalCliente" class="mt-2 small text-muted"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary h-100 w-100" id="btnBuscarCliente">
                                        <i class="fas fa-search me-2"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detalles del Contrato -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light-primary d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-tasks me-2"></i>Detalles del Servicio</h6>
                            <button type="button" class="btn btn-sm btn-primary" id="btnAgregarServicio">
                                <i class="fas fa-plus me-2"></i> Agregar Servicio
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tablaServiciosContrato">
                                    <thead>
                                        <tr class="table-light">
                                            <th>Servicio</th>
                                            <th>Zona</th>
                                            <th>Fecha</th>
                                            <th>Origen</th>
                                            <th>Destino</th>
                                            <th>Monto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Filas de servicios se agregarán dinámicamente -->
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light">
                                            <td colspan="5" class="text-end fw-bold">Total:</td>
                                            <td id="totalContrato" class="fw-bold">S/ 0.00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="section-divider">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="observacionesContrato" name="observaciones" placeholder="Observaciones Generales" style="height: 80px"></textarea>
                                <label for="observacionesContrato">Observaciones Generales</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estadoContrato" name="estado" required>
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Completado">Completado</option>
                                    <option value="Anulado">Anulado</option>
                                </select>
                                <label for="estadoContrato">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#registrarContratoModal').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Contrato
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Buscar Clientes Naturales -->
<div class="modal fade modal-search" id="buscarClientesModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-users me-2"></i>Seleccionar Cliente Natural</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarClientesModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarClienteNatural" placeholder="Buscar cliente...">
                            <label for="buscarClienteNatural">Buscar cliente...</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100 h-100" type="button" id="btnFiltrarClientesNaturales">
                            <i class="fas fa-search me-2"></i> Filtrar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaClientesNaturales">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarClientesModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Empresas -->
<div class="modal fade modal-search" id="buscarEmpresasModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-building me-2"></i>Seleccionar Empresa</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarEmpresasModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarEmpresa" placeholder="Buscar empresa...">
                            <label for="buscarEmpresa">Buscar empresa...</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100 h-100" type="button" id="btnFiltrarEmpresas">
                            <i class="fas fa-search me-2"></i> Filtrar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaEmpresas">
                        <thead class="table-light">
                            <tr>
                                <th>Razón Social</th>
                                <th>RUC</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarEmpresasModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Tarifas -->
<div class="modal fade modal-search" id="buscarTarifasModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-tags me-2"></i>Seleccionar Tarifa</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarTarifasModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="buscarTarifa" placeholder="Buscar tarifa...">
                            <label for="buscarTarifa">Buscar tarifa...</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100 h-100" type="button" id="btnFiltrarTarifas">
                            <i class="fas fa-search me-2"></i> Filtrar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaTarifas">
                        <thead class="table-light">
                            <tr>
                                <th>Servicio</th>
                                <th>Zona</th>
                                <th>Monto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarTarifasModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Agregar Servicio -->
<div class="modal fade" id="agregarServicioModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Agregar Servicio al Contrato</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#agregarServicioModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Información de Tarifa</span>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tarifaSeleccionada" placeholder="Tarifa" readonly>
                            <label for="tarifaSeleccionada">Tarifa <span class="text-danger">*</span></label>
                            <input type="hidden" id="idTarifaSeleccionada" name="idTarifa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100 h-100" type="button" id="btnBuscarTarifaServicio">
                            <i class="fas fa-search me-2"></i> Buscar
                        </button>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="servicioInfo" placeholder="Servicio" readonly>
                            <label for="servicioInfo">Servicio</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="zonaInfo" placeholder="Zona de Cobertura" readonly>
                            <label for="zonaInfo">Zona de Cobertura</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Detalles del Servicio</span>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="fechaServicio" placeholder="Fecha de Servicio" required>
                            <label for="fechaServicio">Fecha de Servicio <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="montoServicio" placeholder="Monto (S/)" step="0.01" min="0" required readonly>
                            <label for="montoServicio">Monto (S/) <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="origenServicio" placeholder="Origen" required>
                            <label for="origenServicio">Origen <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="destinoServicio" placeholder="Destino" required>
                            <label for="destinoServicio">Destino <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Información Adicional</span>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="pesoServicio" placeholder="Peso (kg)" step="0.01" min="0">
                            <label for="pesoServicio">Peso (kg)</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="volumenServicio" placeholder="Volumen (m³)" step="0.01" min="0">
                            <label for="volumenServicio">Volumen (m³)</label>
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="descripcionServicio" placeholder="Descripción" style="height: 80px"></textarea>
                            <label for="descripcionServicio">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#agregarServicioModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnAgregarServicioContrato">
                    <i class="fas fa-plus me-2"></i>Agregar Servicio
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modales de contrato */
:root {
    --primary-color: #5d87ff;
    --primary-light: rgba(93, 135, 255, 0.1);
    --primary-dark: #4569cb;
    --light-primary: rgba(93, 135, 255, 0.05);
    --success-color: #36b37e;
    --danger-color: #f55252;
    --warning-color: #ffab00;
    --dark-color: #334d6e;
    --light-color: #f8f9fe;
    --gray-color: #8492a6;
    --light-gray: #edf2f9;
    --text-color: #525f7f;
    --border-radius: 8px;
    --transition: all 0.3s ease;
}

/* Estilos para los modales */
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
    font-weight: 600;
    display: flex;
    align-items: center;
}

.modal-body {
    padding: 25px;
    max-height: 75vh;
    overflow-y: auto;
}

.modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Selector de tipo de contrato */
.tipo-contrato-selector {
    padding-bottom: 20px;
    border-bottom: 1px solid var(--light-gray);
}

.tipo-contrato-option {
    position: relative;
    width: 170px;
}

.tipo-contrato-option .form-check-input {
    position: absolute;
    opacity: 0;
}

.tipo-contrato-label {
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

.tipo-contrato-label .icon-container {
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

.tipo-contrato-label span {
    font-weight: 500;
    color: var(--dark-color);
    transition: var(--transition);
}

.tipo-contrato-option .form-check-input:checked + .tipo-contrato-label {
    border-color: var(--primary-color);
    background-color: var(--primary-light);
}

.tipo-contrato-option .form-check-input:checked + .tipo-contrato-label .icon-container {
    background-color: var(--primary-color);
    color: white;
}
#registrarContratoModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#registrarContratoModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

/* Estilos para cards */
.card {
    border-radius: var(--border-radius);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.card-header {
    padding: 15px 20px;
    border-bottom: 1px solid var(--light-gray);
}

.bg-light-primary {
    background-color: var(--light-primary);
    color: var(--primary-color);
}

/* Estilos para tablas */
.table {
    color: var(--dark-color);
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    background-color: var(--light-gray);
    border-bottom-width: 1px;
}

.table-hover tbody tr:hover {
    background-color: rgba(93, 135, 255, 0.05);
}

.table-light {
    background-color: var(--light-gray);
}

/* Estilos para los campos flotantes */
.form-floating > .form-control,
.form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: var(--border-radius);
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > textarea.form-control {
    height: auto;
    min-height: 80px;
    padding-top: 1.5rem;
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

/* Divider de secciones */
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

.btn-outline-secondary {
    color: var(--gray-color);
    border-color: var(--light-gray);
}

.btn-outline-secondary:hover {
    background-color: var(--light-gray);
    color: var(--dark-color);
    border-color: var(--light-gray);
}

.btn-sm {
    padding: 8px 16px;
    font-size: 13px;
}

.btn-close {
    opacity: 0.5;
    transition: var(--transition);
}

.btn-close:hover {
    opacity: 1;
}

/* Textos */
.text-danger {
    color: var(--danger-color) !important;
}

.text-muted {
    color: var(--gray-color) !important;
}

.small {
    font-size: 12px;
}

.fw-bold {
    font-weight: 600;
}

.text-end {
    text-align: right;
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

.mt-1 {
    margin-top: 0.5rem !important;
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

.h-100 {
    height: 100% !important;
}

.w-100 {
    width: 100% !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fechaServicio');

    // Obtener la fecha actual en formato YYYY-MM-DD
    const today = new Date();
    const pad = num => num.toString().padStart(2, '0');
    const fechaHoy = `${today.getFullYear()}-${pad(today.getMonth() + 1)}-${pad(today.getDate())}`;

    // Establecer valor actual y mínimo permitido
    fechaInput.value = fechaHoy;
    fechaInput.min = fechaHoy;

    // Validar cambios
    fechaInput.addEventListener('change', function () {
        if (this.value < this.min) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha inválida',
                text: 'No puedes seleccionar una fecha anterior a hoy.',
                confirmButtonText: 'Entendido'
            });
            this.value = this.min;
        }
    });
});
     $('#montoServicio').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
    $('#pesoServicio').off('input change').on('input change', function() {
             const value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
        $(this).val('0.00');
         }
         });
             $('#volumenServicio').off('input change').on('input change', function() {
             const value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
        $(this).val('0.00');
         }
         });
</script>

<script>
$(document).ready(function() {
    // Variables globales
    var serviciosContrato = [];
    var tipoContratoActual = 'natural';
    var clienteData = null;

    // Configuración de modales para evitar problemas con el scroll
    $(document).on('show.bs.modal', '.modal', function() {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    $(document).on('hidden.bs.modal', '.modal', function() {
        $('.modal:visible').length && $('body').addClass('modal-open');
    });

    // Cambiar entre tipos de contrato
    $('input[name="tipoContrato"]').change(function() {
        tipoContratoActual = $(this).val();
        $('#clienteInfo').val('');
        $('#idClienteEmpresa').val('');
        $('#infoAdicionalCliente').html('');
        clienteData = null;
    });

    // Buscar cliente/empresa
    $('#btnBuscarCliente').click(function() {
        if (tipoContratoActual === 'natural') {
            cargarClientesNaturales();
            $('#buscarClientesModal').modal('show');
        } else {
            cargarEmpresas();
            $('#buscarEmpresasModal').modal('show');
        }
    });

    // Cargar clientes naturales
    function cargarClientesNaturales(filtro = '') {
        $.ajax({
            url: '../contratos/obtenernaturales.php',
            type: 'GET',
            data: { filtro: filtro },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    var tbody = $('#tablaClientesNaturales tbody');
                    tbody.empty();
                    
                    if(response.data.length === 0) {
                        tbody.append('<tr><td colspan="5" class="text-center">No se encontraron resultados</td></tr>');
                    } else {
                        $.each(response.data, function(index, cliente) {
                            tbody.append(`
                                <tr>
                                    <td>${cliente.nombre} ${cliente.apellidopat} ${cliente.apellidoMat}</td>
                                    <td>${cliente.numerodocumento}</td>
                                    <td>${cliente.telefono}</td>
                                    <td>${cliente.correo}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-cliente" 
                                                data-id="${cliente.idCliente}"
                                                data-nombre="${cliente.nombre} ${cliente.apellidopat} ${cliente.apellidoMat}"
                                                data-documento="${cliente.numerodocumento}"
                                                data-telefono="${cliente.telefono}"
                                                data-correo="${cliente.correo}"
                                                data-direccion="${cliente.direccion}">
                                            <i class="fas fa-check"></i> Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar los clientes', 'error');
            }
        });
    }

    // Cargar empresas
    function cargarEmpresas(filtro = '') {
        $.ajax({
            url: '../contratos/obtenerempresas.php',
            type: 'GET',
            data: { filtro: filtro },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    var tbody = $('#tablaEmpresas tbody');
                    tbody.empty();
                    
                    if(response.data.length === 0) {
                        tbody.append('<tr><td colspan="5" class="text-center">No se encontraron resultados</td></tr>');
                    } else {
                        $.each(response.data, function(index, empresa) {
                            tbody.append(`
                                <tr>
                                    <td>${empresa.razonSocial}</td>
                                    <td>${empresa.ruc}</td>
                                    <td>${empresa.telefono}</td>
                                    <td>${empresa.correo}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-empresa" 
                                                data-id="${empresa.idEmpresa}"
                                                data-nombre="${empresa.razonSocial}"
                                                data-documento="${empresa.ruc}"
                                                data-telefono="${empresa.telefono}"
                                                data-correo="${empresa.correo}"
                                                data-direccion="${empresa.direccion}">
                                            <i class="fas fa-check"></i> Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar las empresas', 'error');
            }
        });
    }

    // Seleccionar cliente natural
    $(document).on('click', '.seleccionar-cliente', function() {
        clienteData = {
            id: $(this).data('id'),
            nombre: $(this).data('nombre'),
            documento: $(this).data('documento'),
            telefono: $(this).data('telefono'),
            correo: $(this).data('correo'),
            direccion: $(this).data('direccion')
        };
        
        $('#clienteInfo').val(clienteData.nombre);
        $('#idClienteEmpresa').val(clienteData.id);
        
        var infoAdicional = `
            <strong>Documento:</strong> ${clienteData.documento}<br>
            <strong>Teléfono:</strong> ${clienteData.telefono}<br>
            <strong>Correo:</strong> ${clienteData.correo}<br>
            <strong>Dirección:</strong> ${clienteData.direccion}
        `;
        $('#infoAdicionalCliente').html(infoAdicional);
        
        $('#buscarClientesModal').modal('hide');
    });

    // Seleccionar empresa
    $(document).on('click', '.seleccionar-empresa', function() {
        clienteData = {
            id: $(this).data('id'),
            nombre: $(this).data('nombre'),
            documento: $(this).data('documento'),
            telefono: $(this).data('telefono'),
            correo: $(this).data('correo'),
            direccion: $(this).data('direccion')
        };
        
        $('#clienteInfo').val(clienteData.nombre);
        $('#idClienteEmpresa').val(clienteData.id);
        
        var infoAdicional = `
            <strong>RUC:</strong> ${clienteData.documento}<br>
            <strong>Teléfono:</strong> ${clienteData.telefono}<br>
            <strong>Correo:</strong> ${clienteData.correo}<br>
            <strong>Dirección:</strong> ${clienteData.direccion}
        `;
        $('#infoAdicionalCliente').html(infoAdicional);
        
        $('#buscarEmpresasModal').modal('hide');
    });

    // Filtrar clientes naturales
    $('#btnFiltrarClientesNaturales').click(function() {
        cargarClientesNaturales($('#buscarClienteNatural').val());
    });

    $('#buscarClienteNatural').keyup(function() {
        cargarClientesNaturales($(this).val());
    });

    // Filtrar empresas
    $('#btnFiltrarEmpresas').click(function() {
        cargarEmpresas($('#buscarEmpresa').val());
    });

    $('#buscarEmpresa').keyup(function() {
        cargarEmpresas($(this).val());
    });

    // Agregar servicio al contrato
    $('#btnAgregarServicio').click(function() {
        if (!clienteData) {
            Swal.fire('Error', 'Debe seleccionar un cliente/empresa primero', 'error');
            return;
        }
        
        $('#agregarServicioModal').modal('show');
    });

    // Buscar tarifa para servicio
    $('#btnBuscarTarifaServicio').click(function() {
        cargarTarifas();
        $('#buscarTarifasModal').modal('show');
    });

    // Cargar tarifas
    // Función corregida para cargar tarifas
function cargarTarifas(filtro = '') {
    $.ajax({
        url: '../contratos/obtenertarifas.php',
        type: 'GET',
        data: { filtro: filtro },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                var tbody = $('#tablaTarifas tbody');
                tbody.empty();
                
                if(response.data.length === 0) {
                    tbody.append('<tr><td colspan="4" class="text-center">No se encontraron resultados</td></tr>');
                } else {
                    $.each(response.data, function(index, tarifa) {
                        // Asegurarnos que monto es un número
                        var monto = parseFloat(tarifa.monto) || 0;
                        
                        tbody.append(`
                            <tr>
                                <td>${tarifa.nombreServicio}</td>
                                <td>${tarifa.nombreZona} (${tarifa.departamento})</td>
                                <td>S/${monto.toFixed(2)}</td>
                                <td>
                                    <button class="btn btn-sm btn-success seleccionar-tarifa" 
                                            data-id="${tarifa.idTarifa}"
                                            data-servicio="${tarifa.nombreServicio}"
                                            data-zona="${tarifa.nombreZona}"
                                            data-monto="${monto}">
                                        <i class="fas fa-check"></i> Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                }
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Error al cargar las tarifas', 'error');
        }
    });
}

// Corrección en el evento de selección de tarifa
$(document).on('click', '.seleccionar-tarifa', function() {
    $('#idTarifaSeleccionada').val($(this).data('id')); // Usar el ID correcto
    $('#tarifaSeleccionada').val($(this).data('servicio') + ' - ' + $(this).data('zona'));
    $('#servicioInfo').val($(this).data('servicio'));
    $('#zonaInfo').val($(this).data('zona'));
    $('#montoServicio').val($(this).data('monto'));
    
    $('#buscarTarifasModal').modal('hide');
});
    // Seleccionar tarifa
    $(document).on('click', '.seleccionar-tarifa', function() {
        $('#idTarifaSeleccionada').val($(this).data('id'));
        $('#tarifaSeleccionada').val($(this).data('servicio') + ' - ' + $(this).data('zona'));
        $('#servicioInfo').val($(this).data('servicio'));
        $('#zonaInfo').val($(this).data('zona'));
        $('#montoServicio').val($(this).data('monto'));
        
        $('#buscarTarifasModal').modal('hide');
    });

    // Filtrar tarifas
    $('#btnFiltrarTarifas').click(function() {
        cargarTarifas($('#buscarTarifa').val());
    });

    $('#buscarTarifa').keyup(function() {
        cargarTarifas($(this).val());
    });

    // Agregar servicio al contrato
    $('#btnAgregarServicioContrato').click(function() {
        if (!$('#idTarifaSeleccionada').val()) {
            Swal.fire('Error', 'Debe seleccionar una tarifa', 'error');
            return;
        }
        
        var servicio = {
            idTarifa: $('#idTarifaSeleccionada').val(),
            servicio: $('#servicioInfo').val(),
            zona: $('#zonaInfo').val(),
            fechaServicio: $('#fechaServicio').val(),
            origen: $('#origenServicio').val(),
            destino: $('#destinoServicio').val(),
            peso: $('#pesoServicio').val(),
            volumen: $('#volumenServicio').val(),
            monto: $('#montoServicio').val(),
            descripcion: $('#descripcionServicio').val()
        };
        
        // Validar campos obligatorios
        if (!servicio.fechaServicio || !servicio.origen || !servicio.destino || !servicio.monto) {
            Swal.fire('Error', 'Debe completar todos los campos obligatorios', 'error');
            return;
        }
        
        // Agregar servicio a la lista
        serviciosContrato.push(servicio);
        
        // Actualizar tabla
        actualizarTablaServicios();
        
        // Limpiar formulario
        $('#agregarServicioModal').modal('hide');
        $('#agregarServicioModal form')[0].reset();
        $('#idTarifaSeleccionada').val('');
        $('#tarifaSeleccionada').val('');
        $('#servicioInfo').val('');
        $('#zonaInfo').val('');
    });

    // Actualizar tabla de servicios
    function actualizarTablaServicios() {
        var tbody = $('#tablaServiciosContrato tbody');
        tbody.empty();
        
        var total = 0;
        
        $.each(serviciosContrato, function(index, servicio) {
            total += parseFloat(servicio.monto);
            
            tbody.append(`
                <tr data-index="${index}">
                    <td>${servicio.servicio}</td>
                    <td>${servicio.zona}</td>
                    <td>${servicio.fechaServicio}</td>
                    <td>${servicio.origen}</td>
                    <td>${servicio.destino}</td>
                    <td>S/${parseFloat(servicio.monto).toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-danger eliminar-servicio" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
        
        $('#totalContrato').text('S/' + total.toFixed(2));
    }

    // Eliminar servicio
    $(document).on('click', '.eliminar-servicio', function() {
        var index = $(this).closest('tr').data('index');
        serviciosContrato.splice(index, 1);
        actualizarTablaServicios();
    });

    // Enviar formulario de contrato
    $('#contratoForm').submit(function(e) {
        e.preventDefault();
        
        if (!clienteData) {
            Swal.fire('Error', 'Debe seleccionar un cliente/empresa', 'error');
            return;
        }
        
        if (serviciosContrato.length === 0) {
            Swal.fire('Error', 'Debe agregar al menos un servicio', 'error');
            return;
        }
        
        var formData = {
            tipoContrato: tipoContratoActual,
            idClienteEmpresa: $('#idClienteEmpresa').val(),
            estado: $('#estadoContrato').val(),
            observaciones: $('#observacionesContrato').val(),
            servicios: serviciosContrato
        };
        
        // Determinar a qué endpoint enviar
        var url = (tipoContratoActual === 'natural') ? '../contratos/guardarnaturar.php' : '../contratos/guardarempresa.php';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            dataType: 'json',
            beforeSend: function() {
                $('.btn-primary').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            complete: function() {
                $('.btn-primary').prop('disabled', false).html('Guardar Contrato');
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });
});
</script>