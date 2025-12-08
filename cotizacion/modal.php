<style>
    .form-section {
        display: none;
    }
    .form-section.active {
        display: block;
    }
    .table-hover tbody tr:hover {
        cursor: pointer;
        background-color: #f5f5f5;
    }
    .alert-excedente {
        display: none;
        font-size: 0.9rem;
        padding: 0.5rem;
        margin-top: 0.25rem;
    }
    .input-group-btn {
        margin-left: 5px;
    }
    .info-display {
        margin-top: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
</style>
<!-- Modal de Cotización Principal - Diseño Moderno Completo -->
<div class="modal fade" id="cotizacionModal" tabindex="-1" aria-labelledby="cotizacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cotizacionModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Nueva Cotización
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Tipo de Cotización</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipoCotizacion" id="clienteRadio" value="cliente" checked>
                                <label class="form-check-label" for="clienteRadio">Cliente Natural</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipoCotizacion" id="empresaRadio" value="empresa">
                                <label class="form-check-label" for="empresaRadio">Empresa</label>
                            </div>
                            <label>Tipo de Cotización <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>

                <!-- Formulario para Cliente Natural -->
                <div id="clienteForm" class="form-section active">
                    <form id="formCotizacionCliente">
                        <input type="hidden" name="tipo" value="cliente">
                        
                        <div class="section-divider mt-4">
                            <span>Información del Cliente</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-12">
                                        <label for="nombreCliente">Solicitud Cliente <span class="text-danger">*</span></label>
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nombreCliente" placeholder="Solicitud Cliente" readonly required>
                                        <input type="hidden" id="idSolicitudCliente" name="idSolicitud">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#buscarSolicitudClienteModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="solicitudInfoCliente" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Detalles del Vehículo</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="vehiculoInfoCliente" placeholder="Vehículo" readonly required>
                                        <input type="hidden" id="idVehiculoHiddenCliente" name="idVehiculo">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#buscarVehiculoModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="vehiculoDetalleCliente" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Medidas de Carga</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="pesoCliente" name="peso" placeholder="Peso (kg)" readonly>
                                    <label for="pesoCliente">Peso (kg) <span class="text-danger">*</span></label>
                                    <div id="alertaPesoCliente" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de peso</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="volumenCliente" name="volumen" placeholder="Volumen (m³)"  readonly>
                                    <label for="volumenCliente">Volumen (m³) <span class="text-danger">*</span></label>
                                    <div id="alertaVolumenCliente" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de volumen</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-4s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="pesoExcedidoCliente" name="pesoExcedido" placeholder="Peso Excedido (kg)" readonly>
                                    <label for="pesoExcedidoCliente">Peso Excedido (kg)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="volumenExcedidoCliente" name="volumenExcedido" placeholder="Volumen Excedido (m³)" readonly>
                                    <label for="volumenExcedidoCliente">Volumen Excedido (m³)</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Montos</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-5s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="cargoAdicionalCliente" name="cargoAdicional" placeholder="Cargo Adicional ($)" value="0.00">
                                    <label for="cargoAdicionalCliente">Cargo Adicional ($)</label>
                                    <div id="alertaAdicionalCliente" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder los límites de peso y volumen</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="montoBaseCliente" name="montoBase" placeholder="Monto Base ($)" readonly>
                                    <label for="montoBaseCliente">Monto Base ($)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="montoFinalCliente" name="montoFinal" placeholder="Monto Final ($)" readonly>
                                    <label for="montoFinalCliente">Monto Final ($)</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Formulario para Empresa -->
                <div id="empresaForm" class="form-section">
                    <form id="formCotizacionEmpresa">
                        <input type="hidden" name="tipo" value="empresa">
                        
                        <div class="section-divider mt-4">
                            <span>Información de la Empresa</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="col-12">
                                <label for="nombreEmpresa">Solicitud Empresa <span class="text-danger">*</span></label>

                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nombreEmpresa" placeholder="Solicitud Empresa" readonly required>
                                        <input type="hidden" id="idSolicitudEmpresa" name="idSolicitud">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#buscarSolicitudEmpresaModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="solicitudInfoEmpresa" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Detalles del Vehículo</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="vehiculoInfoEmpresa" placeholder="Vehículo" readonly required>
                                        <input type="hidden" id="idVehiculoHiddenEmpresa" name="idVehiculo">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#buscarVehiculoModal" data-bs-backdrop="static">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                    <div id="vehiculoDetalleEmpresa" class="info-display small text-muted mt-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Medidas de Carga</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="pesoEmpresa" name="peso" placeholder="Peso (kg)" readonly>
                                    <label for="pesoEmpresa">Peso (kg) <span class="text-danger">*</span></label>
                                    <div id="alertaPesoEmpresa" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de peso</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="volumenEmpresa" name="volumen" placeholder="Volumen (m³)" readonly>
                                    <label for="volumenEmpresa">Volumen (m³) <span class="text-danger">*</span></label>
                                    <div id="alertaVolumenEmpresa" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder el límite de volumen</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-4s">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="pesoExcedidoEmpresa" name="pesoExcedido" placeholder="Peso Excedido (kg)" readonly>
                                    <label for="pesoExcedidoEmpresa">Peso Excedido (kg)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="volumenExcedidoEmpresa" name="volumenExcedido" placeholder="Volumen Excedido (m³)" readonly>
                                    <label for="volumenExcedidoEmpresa">Volumen Excedido (m³)</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Montos</span>
                        </div>
                        
                        <div class="row g-3 animate__animated animate__fadeInUp animate__delay-5s">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="cargoAdicionalEmpresa" name="cargoAdicional" placeholder="Cargo Adicional ($)" value="0.00">
                                    <label for="cargoAdicionalEmpresa">Cargo Adicional ($)</label>
                                    <div id="alertaAdicionalEmpresa" class="alert-excedente alert alert-danger mt-2 small">Debes agregar cargo adicional por exceder los límites de peso y volumen</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="montoBaseEmpresa" name="montoBase" placeholder="Monto Base ($)" readonly>
                                    <label for="montoBaseEmpresa">Monto Base ($)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="montoFinalEmpresa" name="montoFinal" placeholder="Monto Final ($)" readonly>
                                    <label for="montoFinalEmpresa">Monto Final ($)</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="guardarCotizacion">
                    <i class="fas fa-save me-2"></i> Guardar Cotización
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Solicitud de Cliente Natural - Diseño Moderno -->
<div class="modal fade" id="buscarSolicitudClienteModal" tabindex="-1" aria-labelledby="buscarSolicitudClienteModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarSolicitudClienteModalLabel">
                    <i class="fas fa-search me-2"></i>Buscar Solicitud de Cliente
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
                            <input type="text" class="form-control" id="busquedaSolicitudCliente" placeholder="Buscar por nombre, origen o destino...">
                            <label for="busquedaSolicitudCliente">Buscar solicitudes</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaSolicitudesCliente">
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
                        <tbody id="cuerpoTablaSolicitudesCliente">
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

<!-- Modal para Buscar Solicitud de Empresa - Diseño Moderno -->
<div class="modal fade" id="buscarSolicitudEmpresaModal" tabindex="-1" aria-labelledby="buscarSolicitudEmpresaModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarSolicitudEmpresaModalLabel">
                    <i class="fas fa-search me-2"></i>Buscar Solicitud de Empresa
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
                            <input type="text" class="form-control" id="busquedaSolicitudEmpresa" placeholder="Buscar por empresa, origen o destino...">
                            <label for="busquedaSolicitudEmpresa">Buscar solicitudes</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaSolicitudesEmpresa">
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
                        <tbody id="cuerpoTablaSolicitudesEmpresa">
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

<!-- Modal para Buscar Vehículo - Diseño Moderno -->
<div class="modal fade" id="buscarVehiculoModal" tabindex="-1" aria-labelledby="buscarVehiculoModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarVehiculoModalLabel">
                    <i class="fas fa-truck me-2"></i>Buscar Vehículo
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
                            <input type="text" class="form-control" id="busquedaVehiculo" placeholder="Buscar por placa, marca o modelo...">
                            <label for="busquedaVehiculo">Buscar vehículos</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="tablaVehiculos">
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
                        <tbody id="cuerpoTablaVehiculos">
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
/* Estilos específicos para el modal de cotización */
#cotizacionModal .modal-content,
#buscarSolicitudClienteModal .modal-content,
#buscarSolicitudEmpresaModal .modal-content,
#buscarVehiculoModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#cotizacionModal .modal-header,
#buscarSolicitudClienteModal .modal-header,
#buscarSolicitudEmpresaModal .modal-header,
#buscarVehiculoModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#cotizacionModal .modal-title,
#buscarSolicitudClienteModal .modal-title,
#buscarSolicitudEmpresaModal .modal-title,
#buscarVehiculoModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#cotizacionModal .modal-body,
#buscarSolicitudClienteModal .modal-body,
#buscarSolicitudEmpresaModal .modal-body,
#buscarVehiculoModal .modal-body {
    padding: 25px;
}

#cotizacionModal .modal-footer,
#buscarSolicitudClienteModal .modal-footer,
#buscarSolicitudEmpresaModal .modal-footer,
#buscarVehiculoModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
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
#cotizacionModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#cotizacionModal .modal-title::after {
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
// Variables globales específicas para este modal
let cotizacionModalVehiculoSeleccionado = null;
let cotizacionModalSolicitudSeleccionada = null;
let cotizacionModalTipoSolicitudActual = 'cliente';

// Configuración inicial del modal principal
$(document).ready(function() {
    // Inicializar modal de cotización
    $('#cotizacionModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    });

    // Cambiar entre formularios de cliente y empresa
    $('input[name="tipoCotizacion"]').change(function() {
        cotizacionModalTipoSolicitudActual = $(this).val();
        $('.form-section').removeClass('active');
        $(`#${cotizacionModalTipoSolicitudActual}Form`).addClass('active');
    });

    // Configurar modales secundarios específicos
    cotizacionModalConfigurarModalesSecundarios();

    // Búsqueda en tiempo real
    $('#busquedaSolicitudCliente').on('input', function() {
        cotizacionModalCargarSolicitudesClientes($(this).val());
    });

    $('#busquedaSolicitudEmpresa').on('input', function() {
        cotizacionModalCargarSolicitudesEmpresas($(this).val());
    });

    $('#busquedaVehiculo').on('input', function() {
        cotizacionModalCargarVehiculos($(this).val());
    });

    // Calcular montos cuando cambian los valores
    $('input[name="peso"], input[name="volumen"], input[name="cargoAdicional"]').on('input', function() {
        const inputId = $(this).attr('id');
        const formPrefix = inputId.includes('Cliente') ? 'Cliente' : 'Empresa';
        cotizacionModalCalcularMontos(formPrefix);
    });

    // Guardar cotización
    $('#guardarCotizacion').click(cotizacionModalGuardarCotizacion);
});

// Configurar modales secundarios específicos para este modal
function cotizacionModalConfigurarModalesSecundarios() {
    $('#buscarSolicitudClienteModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    }).on('show.bs.modal', function() {
        cotizacionModalCargarSolicitudesClientes();
    });

    $('#buscarSolicitudEmpresaModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    }).on('show.bs.modal', function() {
        cotizacionModalCargarSolicitudesEmpresas();
    });

    $('#buscarVehiculoModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    }).on('show.bs.modal', function() {
        cotizacionModalCargarVehiculos();
    });
}
// Cuando se cierra un modal secundario, volver a mostrar el modal principal que estaba activo
        $('.modal').on('hidden.bs.modal', function () {
            const id = $(this).attr('id');
            const secundarios = ['buscarSolicitudClienteModal', 'buscarSolicitudEmpresaModal', 'buscarVehiculoModal'];

            if (secundarios.includes(id) && modalPadreActual) {
                $('#' + modalPadreActual).modal('show');
            }
        });
    
// Cargar solicitudes de clientes naturales
function cotizacionModalCargarSolicitudesClientes(busqueda = '') {
    $.ajax({
        url: '../cotizacion/obtenersolicitudes.php',
        method: 'POST',
        data: { busqueda: busqueda },
        dataType: 'json',
        success: function(response) {
            let html = '';
            if (response.error) {
                html = `<tr><td colspan="9" class="text-center">${response.error}</td></tr>`;
            } else {
                response.forEach(solicitud => {
                    html += `
                        <tr data-id="${solicitud.idSolicitud}" 
                            data-peso="${solicitud.peso}"
                            data-volumen="${solicitud.volumen}"
                            data-cliente="${solicitud.nombre} ${solicitud.apellidopat} ${solicitud.apellidoMat}"
                            data-tipo="${solicitud.tipoCarga}"
                            data-origen="${solicitud.origen}"
                            data-destino="${solicitud.destino}"
                            data-fecha="${solicitud.fechaEnvio}">
                            <td>${solicitud.idSolicitud}</td>
                            <td>${solicitud.nombre} ${solicitud.apellidopat} ${solicitud.apellidoMat}</td>
                            <td>${solicitud.tipoCarga}</td>
                            <td>${solicitud.peso}</td>
                            <td>${solicitud.volumen}</td>
                            <td>${solicitud.origen}</td>
                            <td>${solicitud.destino}</td>
                            <td>${solicitud.fechaEnvio}</td>
                            <td><button class="btn btn-sm btn-primary seleccionar-solicitud-cotizacion">Seleccionar</button></td>
                        </tr>
                    `;
                });
            }
            $('#cuerpoTablaSolicitudesCliente').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar solicitudes:', error);
            $('#cuerpoTablaSolicitudesCliente').html(`<tr><td colspan="9" class="text-center">Error al cargar las solicitudes</td></tr>`);
        }
    });
}

// Cargar solicitudes de empresas
function cotizacionModalCargarSolicitudesEmpresas(busqueda = '') {
    $.ajax({
        url: '../cotizacion/obtenersolitucempresa.php',
        method: 'POST',
        data: { busqueda: busqueda },
        dataType: 'json',
        success: function(response) {
            let html = '';
            if (response.error) {
                html = `<tr><td colspan="8" class="text-center">${response.error}</td></tr>`;
            } else {
                response.forEach(solicitud => {
                    html += `
                        <tr data-id="${solicitud.idSolicitudempresa}" 
                            data-peso="${solicitud.peso}"
                            data-volumen="${solicitud.volumen}"
                            data-empresa="${solicitud.razonSocial}"
                            data-tipo="${solicitud.tipo_carga}"
                            data-origen="${solicitud.origen}"
                            data-destino="${solicitud.destino}">
                            <td>${solicitud.idSolicitudempresa}</td>
                            <td>${solicitud.razonSocial}</td>
                            <td>${solicitud.tipo_carga}</td>
                            <td>${solicitud.peso}</td>
                            <td>${solicitud.volumen}</td>
                            <td>${solicitud.origen}</td>
                            <td>${solicitud.destino}</td>
                            <td><button class="btn btn-sm btn-primary seleccionar-solicitud-cotizacion">Seleccionar</button></td>
                        </tr>
                    `;
                });
            }
            $('#cuerpoTablaSolicitudesEmpresa').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar solicitudes:', error);
            $('#cuerpoTablaSolicitudesEmpresa').html(`<tr><td colspan="8" class="text-center">Error al cargar las solicitudes</td></tr>`);
        }
    });
}

// Cargar vehículos
function cotizacionModalCargarVehiculos(busqueda = '') {
    $.ajax({
        url: '../cotizacion/obtenervehiculo.php',
        method: 'POST',
        data: { busqueda: busqueda },
        dataType: 'json',
        success: function(response) {
            let html = '';
            if (response.error) {
                html = `<tr><td colspan="9" class="text-center">${response.error}</td></tr>`;
            } else {
                response.forEach(vehiculo => {
                    html += `
                        <tr data-id="${vehiculo.idVehiculo}" 
                            data-placa="${vehiculo.placa}" 
                            data-marca="${vehiculo.marca}" 
                            data-modelo="${vehiculo.modelo}"
                            data-capacidad-peso="${vehiculo.capacidadPeso}"
                            data-capacidad-volumen="${vehiculo.capacidadVolumen}"
                            data-monto="${vehiculo.monto}">
                            <td>${vehiculo.idVehiculo}</td>
                            <td>${vehiculo.placa}</td>
                            <td>${vehiculo.marca}</td>
                            <td>${vehiculo.modelo}</td>
                            <td>${vehiculo.capacidadPeso}</td>
                            <td>${vehiculo.capacidadVolumen}</td>
                            <td>${vehiculo.monto}</td>
                            <td>${vehiculo.estado}</td>
                            <td><button class="btn btn-sm btn-primary seleccionar-vehiculo-cotizacion">Seleccionar</button></td>
                        </tr>
                    `;
                });
            }
            $('#cuerpoTablaVehiculos').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar vehículos:', error);
            $('#cuerpoTablaVehiculos').html(`<tr><td colspan="9" class="text-center">Error al cargar los vehículos</td></tr>`);
        }
    });
}

// Seleccionar solicitud (común para cliente y empresa)
$(document).on('click', '.seleccionar-solicitud-cotizacion', function() {
    const row = $(this).closest('tr');
    const id = row.data('id');
    const tipo = $('#cotizacionModal input[name="tipoCotizacion"]:checked').val();
    
    if (tipo === 'cliente') {
        const cliente = row.data('cliente');
        const tipoCarga = row.data('tipo');
        const peso = row.data('peso');
        const volumen = row.data('volumen');
        const origen = row.data('origen');
        const destino = row.data('destino');
        const fecha = row.data('fecha');

        $('#nombreCliente').val(cliente);
        $('#idSolicitudCliente').val(id);
        $('#solicitudInfoCliente').html(`
            <strong>Tipo Carga:</strong> ${tipoCarga}<br>
            <strong>Peso:</strong> ${peso} kg<br>
            <strong>Volumen:</strong> ${volumen} m³<br>
            <strong>Ruta:</strong> ${origen} → ${destino}<br>
            <strong>Fecha Envío:</strong> ${fecha}
        `);

        $('#pesoCliente').val(peso);
        $('#volumenCliente').val(volumen);
        
        if ($('#idVehiculoHiddenCliente').val()) {
            cotizacionModalCalcularMontos('Cliente');
        }
        
        $('#buscarSolicitudClienteModal').modal('hide');
    } else {
        const empresa = row.data('empresa');
        const tipoCarga = row.data('tipo');
        const peso = row.data('peso');
        const volumen = row.data('volumen');
        const origen = row.data('origen');
        const destino = row.data('destino');

        $('#nombreEmpresa').val(empresa);
        $('#idSolicitudEmpresa').val(id);
        $('#solicitudInfoEmpresa').html(`
            <strong>Tipo Carga:</strong> ${tipoCarga}<br>
            <strong>Peso:</strong> ${peso} kg<br>
            <strong>Volumen:</strong> ${volumen} m³<br>
            <strong>Ruta:</strong> ${origen} → ${destino}
        `);

        $('#pesoEmpresa').val(peso);
        $('#volumenEmpresa').val(volumen);
        
        if ($('#idVehiculoHiddenEmpresa').val()) {
            cotizacionModalCalcularMontos('Empresa');
        }
        
        $('#buscarSolicitudEmpresaModal').modal('hide');
    }
    
    cotizacionModalMostrarMensajeExito('Solicitud seleccionada correctamente');
});

// Seleccionar vehículo
$(document).on('click', '.seleccionar-vehiculo-cotizacion', function() {
    const row = $(this).closest('tr');
    const id = row.data('id');
    const placa = row.data('placa');
    const marca = row.data('marca');
    const modelo = row.data('modelo');
    const capacidadPeso = row.data('capacidad-peso');
    const capacidadVolumen = row.data('capacidad-volumen');
    const monto = row.data('monto');

    cotizacionModalVehiculoSeleccionado = {
        id, placa, marca, modelo, capacidadPeso, capacidadVolumen, monto
    };

    const tipo = $('#cotizacionModal input[name="tipoCotizacion"]:checked').val();
    const formPrefix = tipo === 'cliente' ? 'Cliente' : 'Empresa';
    
    $(`#vehiculoInfo${formPrefix}`).val(`${placa} - ${marca} ${modelo}`);
    $(`#idVehiculoHidden${formPrefix}`).val(id);
    $(`#vehiculoDetalle${formPrefix}`).html(`
        <strong>Capacidad:</strong> Peso: ${capacidadPeso} kg, Volumen: ${capacidadVolumen} m³<br>
        <strong>Monto base:</strong> $${monto}
    `);

    $(`#montoBase${formPrefix}`).val(monto);
    
    if ($(`#idSolicitud${formPrefix}`).val()) {
        cotizacionModalCalcularMontos(formPrefix);
    }

    $('#buscarVehiculoModal').modal('hide');
    cotizacionModalMostrarMensajeExito('Vehículo seleccionado correctamente');
});

// Calcular montos
function cotizacionModalCalcularMontos(formPrefix) {
    const peso = parseFloat($(`#peso${formPrefix}`).val()) || 0;
    const volumen = parseFloat($(`#volumen${formPrefix}`).val()) || 0;
    const capacidadPeso = cotizacionModalVehiculoSeleccionado ? cotizacionModalVehiculoSeleccionado.capacidadPeso : 0;
    const capacidadVolumen = cotizacionModalVehiculoSeleccionado ? cotizacionModalVehiculoSeleccionado.capacidadVolumen : 0;
    const cargoAdicional = parseFloat($(`#cargoAdicional${formPrefix}`).val()) || 0;
    const montoBase = parseFloat($(`#montoBase${formPrefix}`).val()) || 0;

    // Calcular excedentes
    const pesoExcedido = Math.max(0, peso - capacidadPeso);
    const volumenExcedido = Math.max(0, volumen - capacidadVolumen);

    $(`#pesoExcedido${formPrefix}`).val(pesoExcedido.toFixed(2));
    $(`#volumenExcedido${formPrefix}`).val(volumenExcedido.toFixed(2));

    // Mostrar alertas de excedentes
    const excedePeso = pesoExcedido > 0;
    const excedeVolumen = volumenExcedido > 0;
    
    $(`#alertaPeso${formPrefix}`).toggle(excedePeso);
    $(`#alertaVolumen${formPrefix}`).toggle(excedeVolumen);
    
    if (excedePeso && excedeVolumen) {
        $(`#alertaPeso${formPrefix}`).hide();
        $(`#alertaVolumen${formPrefix}`).hide();
        $(`#alertaAdicional${formPrefix}`).show().text('Debes agregar cargo adicional por exceder los límites de peso y volumen');
    } else if (excedePeso) {
        $(`#alertaAdicional${formPrefix}`).show().text('Debes agregar cargo adicional por exceder el límite de peso');
    } else if (excedeVolumen) {
        $(`#alertaAdicional${formPrefix}`).show().text('Debes agregar cargo adicional por exceder el límite de volumen');
    } else {
        $(`#alertaAdicional${formPrefix}`).hide();
    }

    // Calcular monto final
    const montoFinal = montoBase + cargoAdicional;
    $(`#montoFinal${formPrefix}`).val(montoFinal.toFixed(2));
}

// Guardar cotización
function cotizacionModalGuardarCotizacion() {
    const tipo = $('input[name="tipoCotizacion"]:checked').val();
    const formPrefix = tipo.charAt(0).toUpperCase() + tipo.slice(1);
    const formId = `#formCotizacion${formPrefix}`;
    
    // Validar campos requeridos
    if (!$(`#idSolicitud${formPrefix}`).val() || !$(`#idVehiculoHidden${formPrefix}`).val()) {
        cotizacionModalMostrarMensajeError('Debes seleccionar una solicitud y un vehículo');
        return;
    }

    // Preparar datos del formulario
    const formData = $(formId).serialize();
    
    // Validar excedentes sin cargo adicional
    const pesoExcedido = parseFloat($(`#pesoExcedido${formPrefix}`).val()) || 0;
    const volumenExcedido = parseFloat($(`#volumenExcedido${formPrefix}`).val()) || 0;
    const cargoAdicional = parseFloat($(`#cargoAdicional${formPrefix}`).val()) || 0;
    
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
                cotizacionModalEnviarCotizacion(formData);
            }
        });
    } else {
        cotizacionModalEnviarCotizacion(formData);
    }
}

function cotizacionModalEnviarCotizacion(formData) {
    $.ajax({
        url: '../cotizacion/guardarcotizacion.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: 'Éxito',
                    text: response.message,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    $('#cotizacionModal').modal('hide');
                    location.reload();
                });
            } else {
                cotizacionModalMostrarMensajeError(response.message);
                if (response.error_details) {
                    console.error('Detalles del error:', response.error_details);
                }
            }
        },
        error: function(xhr, status, error) {
            cotizacionModalMostrarMensajeError('Error en la conexión al servidor');
            console.error('Error AJAX:', error);
        }
    });
}

// Funciones auxiliares
function cotizacionModalMostrarMensajeExito(mensaje) {
    Swal.fire({
        title: 'Éxito',
        text: mensaje,
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
}

function cotizacionModalMostrarMensajeError(mensaje) {
    Swal.fire({
        title: 'Error',
        text: mensaje,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}
</script>
