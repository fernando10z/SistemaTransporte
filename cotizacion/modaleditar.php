<!-- Modal Editar Cotización -->
<div class="modal fade" id="editarCotizacionModal" tabindex="-1" aria-labelledby="editarCotizacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCotizacionModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Cotización
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload()"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_idCotizacion">
                <input type="hidden" id="edit_tipoCotizacion">
                
                <!-- Formulario para Cliente Natural -->
                <div id="editClienteForm" class="form-section">
                    <form id="formEditCotizacionCliente">
                        <div class="section-divider">
                            <span>Información del Cliente</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp">
                            <div class="col-12">
                                <label for="edit_nombreCliente">Solicitud Cliente <span class="text-danger">*</span></label>
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="edit_nombreCliente" placeholder="Solicitud Cliente" readonly required>
                                        <input type="hidden" id="edit_idSolicitudCliente" name="idSolicitud">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#editBuscarSolicitudClienteModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="edit_solicitudInfoCliente" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Detalles del Vehículo</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="edit_vehiculoInfoCliente" placeholder="Vehículo" readonly required>
                                        <input type="hidden" id="edit_idVehiculoHiddenCliente" name="idVehiculo">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#editBuscarVehiculoModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="edit_vehiculoDetalleCliente" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Medidas de Carga</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_pesoCliente" name="peso" placeholder="Peso (kg)" required readonly>
                                    <label for="edit_pesoCliente">Peso (kg) <span class="text-danger">*</span></label>
                                    <div id="edit_alertaPesoCliente" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de peso</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_volumenCliente" name="volumen" placeholder="Volumen (m³)" required readonly>
                                    <label for="edit_volumenCliente">Volumen (m³) <span class="text-danger">*</span></label>
                                    <div id="edit_alertaVolumenCliente" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de volumen</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_pesoExcedidoCliente" name="pesoExcedido" placeholder="Peso Excedido (kg)" readonly>
                                    <label for="edit_pesoExcedidoCliente">Peso Excedido (kg)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_volumenExcedidoCliente" name="volumenExcedido" placeholder="Volumen Excedido (m³)" readonly>
                                    <label for="edit_volumenExcedidoCliente">Volumen Excedido (m³)</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Montos</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-4s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_cargoAdicionalCliente" name="cargoAdicional" placeholder="Cargo Adicional ($)" value="0.00">
                                    <label for="edit_cargoAdicionalCliente">Cargo Adicional ($)</label>
                                    <div id="edit_alertaAdicionalCliente" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder los límites de peso y volumen</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_montoBaseCliente" name="montoBase" placeholder="Monto Base ($)" readonly>
                                    <label for="edit_montoBaseCliente">Monto Base ($)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_montoFinalCliente" name="montoFinal" placeholder="Monto Final ($)" readonly>
                                    <label for="edit_montoFinalCliente">Monto Final ($)</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Formulario para Empresa -->
                <div id="editEmpresaForm" class="form-section">
                    <form id="formEditCotizacionEmpresa">
                        <div class="section-divider">
                            <span>Información de la Empresa</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp">
                            <div class="col-12">
                                <label for="edit_nombreEmpresa">Solicitud Empresa <span class="text-danger">*</span></label>
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="edit_nombreEmpresa" placeholder="Solicitud Empresa" readonly required>
                                        <input type="hidden" id="edit_idSolicitudEmpresa" name="idSolicitud">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#editBuscarSolicitudEmpresaModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="edit_solicitudInfoEmpresa" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Detalles del Vehículo</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="edit_vehiculoInfoEmpresa" placeholder="Vehículo" readonly required>
                                        <input type="hidden" id="edit_idVehiculoHiddenEmpresa" name="idVehiculo">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#editBuscarVehiculoModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="edit_vehiculoDetalleEmpresa" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Medidas de Carga</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_pesoEmpresa" name="peso" placeholder="Peso (kg)" required readonly>
                                    <label for="edit_pesoEmpresa">Peso (kg) <span class="text-danger">*</span></label>
                                    <div id="edit_alertaPesoEmpresa" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de peso</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_volumenEmpresa" name="volumen" placeholder="Volumen (m³)" required readonly>
                                    <label for="edit_volumenEmpresa">Volumen (m³) <span class="text-danger">*</span></label>
                                    <div id="edit_alertaVolumenEmpresa" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de volumen</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_pesoExcedidoEmpresa" name="pesoExcedido" placeholder="Peso Excedido (kg)" readonly>
                                    <label for="edit_pesoExcedidoEmpresa">Peso Excedido (kg)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_volumenExcedidoEmpresa" name="volumenExcedido" placeholder="Volumen Excedido (m³)" readonly>
                                    <label for="edit_volumenExcedidoEmpresa">Volumen Excedido (m³)</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Montos</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-4s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_cargoAdicionalEmpresa" name="cargoAdicional" placeholder="Cargo Adicional ($)" value="0.00">
                                    <label for="edit_cargoAdicionalEmpresa">Cargo Adicional ($)</label>
                                    <div id="edit_alertaAdicionalEmpresa" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder los límites de peso y volumen</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_montoBaseEmpresa" name="montoBase" placeholder="Monto Base ($)" readonly>
                                    <label for="edit_montoBaseEmpresa">Monto Base ($)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="edit_montoFinalEmpresa" name="montoFinal" placeholder="Monto Final ($)" readonly>
                                    <label for="edit_montoFinalEmpresa">Monto Final ($)</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.reload()" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="actualizarCotizacion">
                    <i class="fas fa-save me-2"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Solicitud de Cliente Natural (Edición) -->
<div class="modal fade" id="editBuscarSolicitudClienteModal" tabindex="-1" aria-labelledby="editBuscarSolicitudClienteModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBuscarSolicitudClienteModalLabel">
                    <i class="fas fa-search me-2"></i>Buscar Solicitud de Cliente (Edición)
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
                            <input type="text" class="form-control" id="editBusquedaSolicitudCliente" placeholder="Buscar por nombre, origen o destino...">
                            <label for="editBusquedaSolicitudCliente">Buscar solicitudes</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="editTablaSolicitudesCliente">
                        <thead class="thead-light">
                            <tr>
                                <th>Cliente</th>
                                <th>Tipo Carga</th>
                                <th>Peso (kg)</th>
                                <th>Volumen (m³)</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="editCuerpoTablaSolicitudesCliente">
                            <!-- Las solicitudes se cargarán aquí -->
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

<!-- Modal para Buscar Solicitud de Empresa (Edición) -->
<div class="modal fade" id="editBuscarSolicitudEmpresaModal" tabindex="-1" aria-labelledby="editBuscarSolicitudEmpresaModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBuscarSolicitudEmpresaModalLabel">
                    <i class="fas fa-search me-2"></i>Buscar Solicitud de Empresa (Edición)
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
                            <input type="text" class="form-control" id="editBusquedaSolicitudEmpresa" placeholder="Buscar por empresa, origen o destino...">
                            <label for="editBusquedaSolicitudEmpresa">Buscar solicitudes</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="editTablaSolicitudesEmpresa">
                        <thead class="thead-light">
                            <tr>
                                <th>Empresa</th>
                                <th>Tipo Carga</th>
                                <th>Peso (kg)</th>
                                <th>Volumen (m³)</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="editCuerpoTablaSolicitudesEmpresa">
                            <!-- Las solicitudes se cargarán aquí -->
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

<!-- Modal para Buscar Vehículo (Edición) -->
<div class="modal fade" id="editBuscarVehiculoModal" tabindex="-1" aria-labelledby="editBuscarVehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBuscarVehiculoModalLabel">
                    <i class="fas fa-truck me-2"></i>Buscar Vehículo (Edición)
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
                            <input type="text" class="form-control" id="editBusquedaVehiculo" placeholder="Buscar por placa, marca o modelo...">
                            <label for="editBusquedaVehiculo">Buscar vehículos</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="editTablaVehiculos">
                        <thead class="thead-light">
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Capacidad Peso (kg)</th>
                                <th>Capacidad Volumen (m³)</th>
                                <th>Monto Base</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="editCuerpoTablaVehiculos">
                            <!-- Los vehículos se cargarán aquí -->
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
/* Estilos específicos para el modal de edición */
#editarCotizacionModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarCotizacionModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}
#editarCotizacionModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarCotizacionModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#editarCotizacionModal .modal-body {
    padding: 25px;
}

#editarCotizacionModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Variables CSS (deben estar definidas en tu CSS global) */
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

/* Estilos para los formularios alternados */
.form-section {
    display: none;
}

.form-section.active {
    display: block;
}

.info-display {
    padding: 8px;
    background-color: var(--light-gray);
    border-radius: 4px;
    margin-top: 5px;
}

/* Estilos para los botones de búsqueda */
.input-group .btn-outline-primary {
    height: 56px;
    border-radius: 0 8px 8px 0;
}

.input-group .form-control {
    border-radius: 8px 0 0 8px;
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

/* Estilos para formularios */
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

/* Estilos para alertas */
.alert-excedente {
    display: none;
    font-size: 12px;
    padding: 8px;
    margin-top: 5px;
}
</style>

<!-- Modales secundarios para edición (similares a los de creación) -->
<!-- ... (incluir los mismos modales de búsqueda pero con prefijo edit_) -->
<script>
    // Variables globales para control de modales
    let modalPrincipalAbierto = false;

    // Configurar modales al cargar la página
    $(document).ready(function() {
        // Configurar el modal de edición
        $('#editarCotizacionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });

        // Configurar el modal de registro
        $('#cotizacionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });

        // Configurar modales secundarios
        configurarModalesSecundarios();

        // Controlar eventos de cierre
        $('#editarCotizacionModal').on('hidden.bs.modal', function() {
            if (modalPrincipalAbierto) {
                $('#cotizacionModal').modal('show');
            }
        });

        $('#cotizacionModal').on('show.bs.modal', function() {
            modalPrincipalAbierto = true;
        });

        $('#cotizacionModal').on('hidden.bs.modal', function() {
            modalPrincipalAbierto = false;
        });

        // Inicializar búsquedas para edición
        inicializarBusquedasEdicion();
    });

    // Configurar modales secundarios
    function configurarModalesSecundarios() {
        // Detectar cuál es el modal principal activo antes de abrir un modal secundario
        $('#cotizacionModal, #editarCotizacionModal').on('show.bs.modal', function () {
            modalPadreActual = $(this).attr('id');
        });

        // Configurar modales de búsqueda
        $('#editBuscarSolicitudClienteModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        }).on('show.bs.modal', function () {
            $('#editBusquedaSolicitudCliente').val('').focus();
            cargarSolicitudesClientesEdicion();
        });

        $('#editBuscarSolicitudEmpresaModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        }).on('show.bs.modal', function () {
            $('#editBusquedaSolicitudEmpresa').val('').focus();
            cargarSolicitudesEmpresasEdicion();
        });

        $('#editBuscarVehiculoModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        }).on('show.bs.modal', function () {
            $('#editBusquedaVehiculo').val('').focus();
            cargarVehiculosEdicion();
        });

        // Cuando se cierra un modal secundario, volver a mostrar el modal principal que estaba activo
        $('.modal').on('hidden.bs.modal', function () {
            const id = $(this).attr('id');
            const secundarios = ['editBuscarSolicitudClienteModal', 'editBuscarSolicitudEmpresaModal', 'editBuscarVehiculoModal'];

            if (secundarios.includes(id) && modalPadreActual) {
                $('#' + modalPadreActual).modal('show');
            }
        });
    }

    // Inicializar eventos de búsqueda para edición
    function inicializarBusquedasEdicion() {
        // Búsqueda de solicitudes cliente (edición)
        $('#editBusquedaSolicitudCliente').on('input', function() {
            cargarSolicitudesClientesEdicion($(this).val());
        });

        // Búsqueda de solicitudes empresa (edición)
        $('#editBusquedaSolicitudEmpresa').on('input', function() {
            cargarSolicitudesEmpresasEdicion($(this).val());
        });

        // Búsqueda de vehículos (edición)
        $('#editBusquedaVehiculo').on('input', function() {
            cargarVehiculosEdicion($(this).val());
        });
    }

    // Cargar solicitudes de clientes naturales (para edición)
    function cargarSolicitudesClientesEdicion(busqueda = '') {
        $.ajax({
            url: '../cotizacion/obtenersolicitudes.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.error) {
                    html = `<tr><td colspan="7" class="text-center">${response.error}</td></tr>`;
                } else {
                    response.forEach(solicitud => {
                        html += `
                            <tr>
                                <td>${solicitud.nombre} ${solicitud.apellidopat} ${solicitud.apellidoMat}</td>
                                <td>${solicitud.tipoCarga}</td>
                                <td>${solicitud.peso}</td>
                                <td>${solicitud.volumen}</td>
                                <td>${solicitud.origen}</td>
                                <td>${solicitud.destino}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary seleccionar-solicitud-edicion" 
                                        data-id="${solicitud.idSolicitud}"
                                        data-nombre="${solicitud.nombre} ${solicitud.apellidopat} ${solicitud.apellidoMat}"
                                        data-peso="${solicitud.peso}"
                                        data-volumen="${solicitud.volumen}"
                                        data-origen="${solicitud.origen}"
                                        data-destino="${solicitud.destino}">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                }
                $('#editCuerpoTablaSolicitudesCliente').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar solicitudes:', error);
                $('#editCuerpoTablaSolicitudesCliente').html(`<tr><td colspan="7" class="text-center">Error al cargar las solicitudes</td></tr>`);
            }
        });
    }

    // Cargar solicitudes de empresas (para edición)
    function cargarSolicitudesEmpresasEdicion(busqueda = '') {
        $.ajax({
            url: '../cotizacion/obtenersolitucempresa.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.error) {
                    html = `<tr><td colspan="7" class="text-center">${response.error}</td></tr>`;
                } else {
                    response.forEach(solicitud => {
                        html += `
                            <tr>
                                <td>${solicitud.razonSocial}</td>
                                <td>${solicitud.tipo_carga}</td>
                                <td>${solicitud.peso}</td>
                                <td>${solicitud.volumen}</td>
                                <td>${solicitud.origen}</td>
                                <td>${solicitud.destino}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary seleccionar-solicitud-edicion" 
                                        data-id="${solicitud.idSolicitudempresa}"
                                        data-nombre="${solicitud.razonSocial}"
                                        data-peso="${solicitud.peso}"
                                        data-volumen="${solicitud.volumen}"
                                        data-origen="${solicitud.origen}"
                                        data-destino="${solicitud.destino}">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                }
                $('#editCuerpoTablaSolicitudesEmpresa').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar solicitudes:', error);
                $('#editCuerpoTablaSolicitudesEmpresa').html(`<tr><td colspan="7" class="text-center">Error al cargar las solicitudes</td></tr>`);
            }
        });
    }

    // Cargar vehículos (para edición)
    function cargarVehiculosEdicion(busqueda = '') {
        $.ajax({
            url: '../cotizacion/obtenervehiculo.php',
            method: 'POST',
            data: { busqueda: busqueda },
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.error) {
                    html = `<tr><td colspan="7" class="text-center">${response.error}</td></tr>`;
                } else {
                    response.forEach(vehiculo => {
                        html += `
                            <tr>
                                <td>${vehiculo.placa}</td>
                                <td>${vehiculo.marca}</td>
                                <td>${vehiculo.modelo}</td>
                                <td>${vehiculo.capacidadPeso}</td>
                                <td>${vehiculo.capacidadVolumen}</td>
                                <td>$${vehiculo.monto}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary seleccionar-vehiculo-edicion" 
                                        data-id="${vehiculo.idVehiculo}"
                                        data-placa="${vehiculo.placa}"
                                        data-marca="${vehiculo.marca}"
                                        data-modelo="${vehiculo.modelo}"
                                        data-capacidadpeso="${vehiculo.capacidadPeso}"
                                        data-capacidadvolumen="${vehiculo.capacidadVolumen}"
                                        data-monto="${vehiculo.monto}">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                }
                $('#editCuerpoTablaVehiculos').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar vehículos:', error);
                $('#editCuerpoTablaVehiculos').html(`<tr><td colspan="7" class="text-center">Error al cargar los vehículos</td></tr>`);
            }
        });
    }

    // Manejar selección de solicitud cliente (edición)
    $(document).on('click', '.seleccionar-solicitud-edicion', function() {
        const idSolicitud = $(this).data('id');
        const nombre = $(this).data('nombre');
        const origen = $(this).data('origen');
        const destino = $(this).data('destino');
        const peso = $(this).data('peso');
        const volumen = $(this).data('volumen');

        // Determinar si estamos en formulario de cliente o empresa
        const tipo = $('#edit_tipoCotizacion').val();
        const formPrefix = tipo === 'cliente' ? 'Cliente' : 'Empresa';

        $(`#edit_nombre${formPrefix}`).val(nombre);
        $(`#edit_idSolicitud${formPrefix}`).val(idSolicitud);
        $(`#edit_solicitudInfo${formPrefix}`).html(`
            <strong>Origen:</strong> ${origen}<br>
            <strong>Destino:</strong> ${destino}<br>
            <strong>Peso original:</strong> ${peso} kg<br>
            <strong>Volumen original:</strong> ${volumen} m³
        `);

        // Cerrar solo el modal de búsqueda, mantener abierto el principal
        if (tipo === 'cliente') {
            $('#editBuscarSolicitudClienteModal').modal('hide');
        } else {
            $('#editBuscarSolicitudEmpresaModal').modal('hide');
        }
    });

    // Manejar selección de vehículo (edición)
    $(document).on('click', '.seleccionar-vehiculo-edicion', function() {
        const idVehiculo = $(this).data('id');
        const placa = $(this).data('placa');
        const marca = $(this).data('marca');
        const modelo = $(this).data('modelo');
        const capacidadPeso = $(this).data('capacidadpeso');
        const capacidadVolumen = $(this).data('capacidadvolumen');
        const monto = $(this).data('monto');

        // Determinar si estamos en formulario de cliente o empresa
        const tipo = $('#edit_tipoCotizacion').val();
        const formPrefix = tipo === 'cliente' ? 'Cliente' : 'Empresa';

        $(`#edit_vehiculoInfo${formPrefix}`).val(`${placa} - ${marca} ${modelo}`);
        $(`#edit_idVehiculoHidden${formPrefix}`).val(idVehiculo);
        $(`#edit_vehiculoDetalle${formPrefix}`).html(`
            <strong>Capacidad:</strong> Peso: ${capacidadPeso} kg, Volumen: ${capacidadVolumen} m³<br>
            <strong>Monto base:</strong> $${monto}
        `);
        $(`#edit_montoBase${formPrefix}`).val(monto);

        // Cerrar solo el modal de búsqueda, mantener abierto el principal
        $('#editBuscarVehiculoModal').modal('hide');
    });

    // Manejar clic en botón editar
    $(document).on('click', '.editar', function(e) {
        e.preventDefault();
        modalPrincipalAbierto = false;
        
        const idCotizacion = $(this).data('id');
        const tipoCotizacion = $(this).closest('tr').find('td:nth-child(2)').text().toLowerCase() === 'natural' ? 'cliente' : 'empresa';
        
        // Cerrar modal principal si está abierto
        $('#cotizacionModal').modal('hide');
        
        // Mostrar el modal de edición
        $('#editarCotizacionModal').modal('show');
        
        // Resto del código para cargar datos...
        $('#editClienteForm, #editEmpresaForm').hide();
        $(`#edit${tipoCotizacion.charAt(0).toUpperCase() + tipoCotizacion.slice(1)}Form`).show();
        
        $.ajax({
            url: '../cotizacion/obtener.php',
            method: 'GET',
            data: { id: idCotizacion, tipo: tipoCotizacion },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    const formPrefix = tipoCotizacion === 'cliente' ? 'Cliente' : 'Empresa';
                    
                    $('#edit_idCotizacion').val(idCotizacion);
                    $('#edit_tipoCotizacion').val(tipoCotizacion);
                    
                    // Llenar formulario...
                    $(`#edit_nombre${formPrefix}`).val(data[`nombre_${tipoCotizacion}`]);
                    $(`#edit_idSolicitud${formPrefix}`).val(data.idSolicitud || data.idSolicitudempresa);
                    $(`#edit_solicitudInfo${formPrefix}`).html(`
                        <strong>Origen:</strong> ${data.origen}<br>
                        <strong>Destino:</strong> ${data.destino}<br>
                        <strong>Peso original:</strong> ${data.peso_solicitud} kg<br>
                        <strong>Volumen original:</strong> ${data.volumen_solicitud} m³
                    `);
                    
                    $(`#edit_vehiculoInfo${formPrefix}`).val(`${data.placa} - ${data.marca} ${data.modelo}`);
                    $(`#edit_idVehiculoHidden${formPrefix}`).val(data.idVehiculo);
                    $(`#edit_vehiculoDetalle${formPrefix}`).html(`
                        <strong>Capacidad:</strong> Peso: ${data.capacidadPeso} kg, Volumen: ${data.capacidadVolumen} m³<br>
                        <strong>Monto base:</strong> $${data.monto}
                    `);
                    
                    $(`#edit_peso${formPrefix}`).val(data.peso);
                    $(`#edit_volumen${formPrefix}`).val(data.volumen);
                    $(`#edit_pesoExcedido${formPrefix}`).val(data.pesoExcedido);
                    $(`#edit_volumenExcedido${formPrefix}`).val(data.volumenExcedido);
                    $(`#edit_cargoAdicional${formPrefix}`).val(data.cargoAdicional);
                    $(`#edit_montoBase${formPrefix}`).val(data.montoBase);
                    $(`#edit_montoFinal${formPrefix}`).val(data.montoFinal);
                    
                    $(`#edit_peso${formPrefix}, #edit_volumen${formPrefix}, #edit_cargoAdicional${formPrefix}`).off('input').on('input', function() {
                        calcularMontosEdicion(formPrefix, data.capacidadPeso, data.capacidadVolumen);
                    });
                } else {
                    mostrarMensajeError(response.message);
                    $('#editarCotizacionModal').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                mostrarMensajeError('Error al cargar los datos de la cotización');
                $('#editarCotizacionModal').modal('hide');
            }
        });
    });

    // Función para calcular montos en edición
    function calcularMontosEdicion(formPrefix, capacidadPeso, capacidadVolumen) {
        const peso = parseFloat($(`#edit_peso${formPrefix}`).val()) || 0;
        const volumen = parseFloat($(`#edit_volumen${formPrefix}`).val()) || 0;
        const cargoAdicional = parseFloat($(`#edit_cargoAdicional${formPrefix}`).val()) || 0;
        const montoBase = parseFloat($(`#edit_montoBase${formPrefix}`).val()) || 0;

        // Calcular excedentes
        const pesoExcedido = Math.max(0, peso - capacidadPeso);
        const volumenExcedido = Math.max(0, volumen - capacidadVolumen);

        $(`#edit_pesoExcedido${formPrefix}`).val(pesoExcedido.toFixed(2));
        $(`#edit_volumenExcedido${formPrefix}`).val(volumenExcedido.toFixed(2));

        // Mostrar alertas de excedentes
        const excedePeso = pesoExcedido > 0;
        const excedeVolumen = volumenExcedido > 0;
        
        $(`#edit_alertaPeso${formPrefix}`).toggle(excedePeso);
        $(`#edit_alertaVolumen${formPrefix}`).toggle(excedeVolumen);
        
        if (excedePeso && excedeVolumen) {
            $(`#edit_alertaPeso${formPrefix}`).hide();
            $(`#edit_alertaVolumen${formPrefix}`).hide();
            $(`#edit_alertaAdicional${formPrefix}`).show().text('Debes agregar cargo adicional por exceder los límites de peso y volumen');
        } else if (excedePeso) {
            $(`#edit_alertaAdicional${formPrefix}`).show().text('Debes agregar cargo adicional por exceder el límite de peso');
        } else if (excedeVolumen) {
            $(`#edit_alertaAdicional${formPrefix}`).show().text('Debes agregar cargo adicional por exceder el límite de volumen');
        } else {
            $(`#edit_alertaAdicional${formPrefix}`).hide();
        }

        // Calcular monto final
        const montoFinal = montoBase + cargoAdicional;
        $(`#edit_montoFinal${formPrefix}`).val(montoFinal.toFixed(2));
    }

    // Guardar cambios en la edición
    $('#actualizarCotizacion').click(function() {
        const idCotizacion = $('#edit_idCotizacion').val();
        const tipo = $('#edit_tipoCotizacion').val();
        const formPrefix = tipo === 'cliente' ? 'Cliente' : 'Empresa';
        const formId = `#formEditCotizacion${formPrefix}`;
        
        // Validar campos requeridos
        if (!$(`#edit_idSolicitud${formPrefix}`).val() || !$(`#edit_idVehiculoHidden${formPrefix}`).val()) {
            mostrarMensajeError('Debes seleccionar una solicitud y un vehículo');
            return;
        }

        // Preparar datos del formulario
        const formData = $(formId).serializeArray();
        formData.push({name: 'idCotizacion', value: idCotizacion});
        formData.push({name: 'tipo', value: tipo});
        
        // Validar excedentes sin cargo adicional
        const pesoExcedido = parseFloat($(`#edit_pesoExcedido${formPrefix}`).val()) || 0;
        const volumenExcedido = parseFloat($(`#edit_volumenExcedido${formPrefix}`).val()) || 0;
        const cargoAdicional = parseFloat($(`#edit_cargoAdicional${formPrefix}`).val()) || 0;
        
        if ((pesoExcedido > 0 || volumenExcedido > 0) && cargoAdicional <= 0) {
            Swal.fire({
                title: 'Advertencia',
                text: 'Hay excedentes de peso o volumen pero no se ha especificado un cargo adicional. ¿Deseas continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'No, corregir'
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarActualizacion(formData);
                }
            });
        } else {
            enviarActualizacion(formData);
        }
    });

    function enviarActualizacion(formData) {
        $.ajax({
            url: '../cotizacion/actualizar.php',
            method: 'POST',
            data: $.param(formData),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#editarCotizacionModal').modal('hide');
                        location.reload(); // Recargar la página para ver los cambios
                    });
                } else {
                    mostrarMensajeError(response.message);
                }
            },
            error: function(xhr, status, error) {
                mostrarMensajeError('Error en la conexión al servidor');
            }
        });
    }

    // Función auxiliar para mostrar mensajes de error
    function mostrarMensajeError(mensaje) {
        Swal.fire({
            title: 'Error',
            text: mensaje,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
</script>