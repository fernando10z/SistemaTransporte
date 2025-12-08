<!-- Modal para Eventos de Envío - Diseño Moderno -->
<div class="modal fade" id="modalEventoEnvio" tabindex="-1" role="dialog" aria-labelledby="modalEventoEnvioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEventoEnvioLabel">
                    <i class="fas fa-truck me-2"></i>Registro de Evento de Envío
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalEventoEnvio').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEventoEnvio">
                    <input type="hidden" id="idEventoEnvio" name="idEventoEnvio">
                    
                    <!-- Selector de Tipo de Cliente -->
                    <div class="tipo-cliente-selector mb-4">
                        <label class="form-label fw-medium mb-3">Tipo de Cliente</label>
                        <div class="d-flex gap-4">
                            <div class="tipo-cliente-option" id="selectorNaturalEnvio">
                                <input class="form-check-input" type="radio" name="tipoClienteEnvio" id="tipoNaturalEnvio" value="Natural" checked>
                                <label class="tipo-cliente-label" for="tipoNaturalEnvio">
                                    <div class="icon-container">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Persona Natural</span>
                                </label>
                            </div>
                            <div class="tipo-cliente-option" id="selectorEmpresaEnvio">
                                <input class="form-check-input" type="radio" name="tipoClienteEnvio" id="tipoEmpresaEnvio" value="Empresa">
                                <label class="tipo-cliente-label" for="tipoEmpresaEnvio">
                                    <div class="icon-container">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>Empresa</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-content">
                        <!-- Campos para Persona Natural -->
                        <div id="camposNaturalEnvio" class="animate-fade-in">
                            <div class="section-divider">
                                <span>Información de Seguimiento</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="clienteNaturalInfoEnvio" placeholder="Cliente" readonly>
                                        <label for="clienteNaturalInfoEnvio">Cliente</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarSeguimientoCliente()">
                                        <i class="fas fa-search me-2"></i>Buscar Seguimiento
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="codigoSeguimientoCliente" placeholder="Código Seguimiento" readonly>
                                        <label for="codigoSeguimientoCliente">Código Seguimiento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="vehiculoCliente" placeholder="Vehículo" readonly>
                                        <label for="vehiculoCliente">Vehículo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" id="idSeguimientoCliente" name="idSeguimiento">
                        </div>
                        
                        <!-- Campos para Empresa -->
                        <div id="camposEmpresaEnvio" style="display:none;" class="animate-fade-in">
                            <div class="section-divider">
                                <span>Información de Seguimiento</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="empresaInfoEnvio" placeholder="Empresa" readonly>
                                        <label for="empresaInfoEnvio">Empresa</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarSeguimientoEmpresa()">
                                        <i class="fas fa-search me-2"></i>Buscar Seguimiento
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="codigoSeguimientoEmpresa" placeholder="Código Seguimiento" readonly>
                                        <label for="codigoSeguimientoEmpresa">Código Seguimiento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="vehiculoEmpresa" placeholder="Vehículo" readonly>
                                        <label for="vehiculoEmpresa">Vehículo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" id="idSeguimientoEmpresa" name="idSeguimientoEmpresa">
                        </div>
                        
                        <!-- Campos comunes -->
                        <div class="section-divider mt-4">
                            <span>Detalles del Evento</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="tipoSeguimiento" name="tipoSeguimiento" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Inicio">Inicio</option>
                                        <option value="En tránsito">En tránsito</option>
                                        <option value="Entregado">Entregado</option>
                                        <option value="Incidentado">Incidentado</option>
                                        <option value="Cancelado">Cancelado</option>
                                    </select>
                                    <label for="tipoSeguimiento">Estado del Envío</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" id="fechaEventoEnvio" name="fechaEvento" required>
                                    <label for="fechaEventoEnvio">Fecha y Hora del Evento</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="latitudEnvio" name="latitud" placeholder="Latitud" required>
                                    <label for="latitudEnvio">Latitud</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="longitudEnvio" name="longitud" placeholder="Longitud" required>
                                    <label for="longitudEnvio">Longitud</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-2">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones" style="height: 100px"></textarea>
                                    <label for="observaciones">Observaciones</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEventoEnvio').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarEventoEnvio">
                    <i class="fas fa-save me-2"></i>Guardar Evento
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar Seguimiento de Cliente -->
<div class="modal fade" id="modalBuscarSeguimientoCliente" tabindex="-1" role="dialog" aria-labelledby="modalBuscarSeguimientoClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarSeguimientoClienteLabel">
                    <i class="fas fa-search me-2"></i>Buscar Seguimiento - Clientes Naturales
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarSeguimientoCliente').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="busquedaSeguimientoCliente" placeholder="Buscar por nombre, documento, código seguimiento...">
                            <button class="btn btn-primary" type="button" onclick="filtrarSeguimientosCliente()">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Cliente</th>
                                <th>Documento</th>
                                <th>Código Seguimiento</th>
                                <th>Vehículo</th>
                                <th>Estado</th>
                                <th>Última Actualización</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaSeguimientosCliente">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarSeguimientoCliente').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar Seguimiento de Empresa -->
<div class="modal fade" id="modalBuscarSeguimientoEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalBuscarSeguimientoEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarSeguimientoEmpresaLabel">
                    <i class="fas fa-search me-2"></i>Buscar Seguimiento - Empresas
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarSeguimientoEmpresa').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="busquedaSeguimientoEmpresa" placeholder="Buscar por razón social, RUC, código seguimiento...">
                            <button class="btn btn-primary" type="button" onclick="filtrarSeguimientosEmpresa()">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Empresa</th>
                                <th>RUC</th>
                                <th>Código Seguimiento</th>
                                <th>Vehículo</th>
                                <th>Estado</th>
                                <th>Última Actualización</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaSeguimientosEmpresa">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarSeguimientoEmpresa').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="datetime-local" class="form-control" id="fechaEventoEnvio" name="fechaEvento" required>
        <label for="fechaEventoEnvio">Fecha y Hora del Evento</label>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFechaHora = document.getElementById('fechaEventoEnvio');

        // Obtener fecha y hora actual en formato YYYY-MM-DDTHH:MM
        const now = new Date();
        const pad = num => num.toString().padStart(2, '0');
        const fechaActual = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`;

        // Establecer valor y mínimo
        inputFechaHora.value = fechaActual;
        inputFechaHora.min = fechaActual;

        // Validar cambio
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
    $('input[name="tipoClienteEnvio"]').change(function() {
        if ($(this).val() === 'Natural') {
            $('#camposNaturalEnvio').show();
            $('#camposEmpresaEnvio').hide();
            $('#idSeguimientoEmpresa').val('');
            $('#empresaInfoEnvio').val('');
            $('#codigoSeguimientoEmpresa').val('');
            $('#vehiculoEmpresa').val('');
        } else {
            $('#camposNaturalEnvio').hide();
            $('#camposEmpresaEnvio').show();
            $('#idSeguimientoCliente').val('');
            $('#clienteNaturalInfoEnvio').val('');
            $('#codigoSeguimientoCliente').val('');
            $('#vehiculoCliente').val('');
        }
    });

    // Configurar fecha actual por defecto
    $('#fechaEventoEnvio').val(new Date().toISOString().slice(0, 16));

    // Botón guardar evento
    $('#btnGuardarEventoEnvio').click(function() {
        guardarEventoEnvio();
    });
});

function buscarSeguimientoCliente() {
    $('#modalBuscarSeguimientoCliente').modal('show');
    cargarSeguimientosCliente();
}

function buscarSeguimientoEmpresa() {
    $('#modalBuscarSeguimientoEmpresa').modal('show');
    cargarSeguimientosEmpresa();
}

function cargarSeguimientosCliente() {
    $.ajax({
        url: '../envios/obtenerclientes.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                $('#tablaSeguimientosCliente').html('<tr><td colspan="7" class="text-center">'+data.error+'</td></tr>');
                return;
            }
            
            let html = '';
            if (data.length === 0) {
                html = '<tr><td colspan="7" class="text-center">No se encontraron seguimientos</td></tr>';
            } else {
                data.forEach(seguimiento => {
                    html += `
                        <tr>
                            <td>${seguimiento.nombre_completo || 'N/A'}</td>
                            <td>${seguimiento.tipoDocumento || 'N/A'}: ${seguimiento.numero_documento || 'N/A'}</td>
                            <td>${seguimiento.codigoSeguimiento || 'N/A'}</td>
                            <td>${seguimiento.vehiculo || 'N/A'}</td>
                            <td>${seguimiento.estado_envio || 'N/A'}</td>
                            <td>${seguimiento.ultima_actualizacion || 'N/A'}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="seleccionarSeguimientoCliente(
                                    '${seguimiento.id_seguimiento}',
                                    '${(seguimiento.nombre_completo || 'N/A').toString().replace(/'/g, "\\'")}',
                                    '${(seguimiento.codigoSeguimiento || 'N/A').toString().replace(/'/g, "\\'")}',
                                    '${(seguimiento.vehiculo || 'N/A').toString().replace(/'/g, "\\'")}'
                                )">
                                    <i class="fas fa-check"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `;
                });
            }
            $('#tablaSeguimientosCliente').html(html);
        },
        error: function(xhr, status, error) {
            $('#tablaSeguimientosCliente').html('<tr><td colspan="7" class="text-center">Error al cargar datos</td></tr>');
        }
    });
}

function cargarSeguimientosEmpresa() {
    $.ajax({
        url: '../envios/obtenerempresa.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                $('#tablaSeguimientosEmpresa').html('<tr><td colspan="7" class="text-center">'+data.error+'</td></tr>');
                return;
            }
            
            let html = '';
            if (data.length === 0) {
                html = '<tr><td colspan="7" class="text-center">No se encontraron seguimientos</td></tr>';
            } else {
                data.forEach(seguimiento => {
                    html += `
                        <tr>
                            <td>${seguimiento.razon_social || 'N/A'}</td>
                            <td>${seguimiento.ruc || 'N/A'}</td>
                            <td>${seguimiento.codigoSeguimiento || 'N/A'}</td>
                            <td>${seguimiento.vehiculo || 'N/A'}</td>
                            <td>${seguimiento.estado_envio || 'N/A'}</td>
                            <td>${seguimiento.ultima_actualizacion || 'N/A'}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="seleccionarSeguimientoEmpresa(
                                    '${seguimiento.id_seguimiento}',
                                    '${(seguimiento.razon_social || 'N/A').toString().replace(/'/g, "\\'")}',
                                    '${(seguimiento.codigoSeguimiento || 'N/A').toString().replace(/'/g, "\\'")}',
                                    '${(seguimiento.vehiculo || 'N/A').toString().replace(/'/g, "\\'")}'
                                )">
                                    <i class="fas fa-check"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `;
                });
            }
            $('#tablaSeguimientosEmpresa').html(html);
        },
        error: function(error) {
            $('#tablaSeguimientosEmpresa').html('<tr><td colspan="7" class="text-center">Error al cargar datos</td></tr>');
        }
    });
}

function filtrarSeguimientosCliente() {
    const busqueda = $('#busquedaSeguimientoCliente').val().toLowerCase();
    $('#tablaSeguimientosCliente tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

function filtrarSeguimientosEmpresa() {
    const busqueda = $('#busquedaSeguimientoEmpresa').val().toLowerCase();
    $('#tablaSeguimientosEmpresa tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

function seleccionarSeguimientoCliente(idSeguimiento, nombreCompleto, codigoSeguimiento, vehiculo) {
    $('#idSeguimientoCliente').val(idSeguimiento);
    $('#clienteNaturalInfoEnvio').val(nombreCompleto);
    $('#codigoSeguimientoCliente').val(codigoSeguimiento);
    $('#vehiculoCliente').val(vehiculo);
    $('#modalBuscarSeguimientoCliente').modal('hide');
}

function seleccionarSeguimientoEmpresa(idSeguimiento, razonSocial, codigoSeguimiento, vehiculo) {
    $('#idSeguimientoEmpresa').val(idSeguimiento);
    $('#empresaInfoEnvio').val(razonSocial);
    $('#codigoSeguimientoEmpresa').val(codigoSeguimiento);
    $('#vehiculoEmpresa').val(vehiculo);
    $('#modalBuscarSeguimientoEmpresa').modal('hide');
}

function guardarEventoEnvio() {
    const formData = $('#formEventoEnvio').serialize();
    const tipoCliente = $('input[name="tipoClienteEnvio"]:checked').val();
    
    let url = '';
    if (tipoCliente === 'Natural') {
        url = '../envios/guardarcliente.php';
    } else {
        url = '../envios/guardarempresa.php';
    }
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false,
                    willClose: () => {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Ocurrió un error al guardar el evento'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al comunicarse con el servidor'
            });
        }
    });
}

// Obtener ubicación actual
function obtenerUbicacionActualEnvio() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                $('#latitudEnvio').val(position.coords.latitude);
                $('#longitudEnvio').val(position.coords.longitude);
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

// Llamar a obtenerUbicacionActualEnvio() cuando se abra el modal
$('#modalEventoEnvio').on('shown.bs.modal', function() {
    obtenerUbicacionActualEnvio();
});
</script>

<style>
/* Estilos para el modal de eventos de envío */
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

.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Estilos para la tabla */
.table-responsive {
    margin-top: 1rem;
}

.table {
    font-size: 0.9rem;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}
</style>