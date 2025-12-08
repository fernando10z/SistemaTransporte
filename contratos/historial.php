<!-- Modal para Historial de Servicios -->
<div class="modal fade" id="historialServiciosModal" tabindex="-1" aria-labelledby="historialServiciosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="historialServiciosModalLabel" style="color:black">Historial de Servicios</h5>
                <button type="button" class="btn-close-custom" onclick="$('#historialServiciosModal').modal('hide')" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Información del Cliente/Empresa -->
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-user-circle me-2"></i>Información del Cliente</span>
                        <div>
                            <button id="btnExportPDF" class="btn btn-sm btn-danger me-2">
                                <i class="fas fa-file-pdf me-1"></i> PDF
                            </button>
                            <button id="btnExportExcel" class="btn btn-sm btn-success">
                                <i class="fas fa-file-excel me-1"></i> Excel
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="infoClienteHistorial">
                        <div class="text-center py-4">
                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                            <p class="mt-2">Cargando información...</p>
                        </div>
                    </div>
                </div>
                
                <!-- Tabla de Historial -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="tablaHistorialServicios">
                        <thead class="thead-dark">
                            <tr>
                                <th># Contrato</th>
                                <th>Fecha Servicio</th>
                                <th>Servicio</th>
                                <th>Zona</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Peso (kg)</th>
                                <th>Volumen (m³)</th>
                                <th>Monto (S/)</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="bodyHistorialServicios">
                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    <i class="fas fa-spinner fa-spin text-primary"></i> Cargando historial...
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="8" class="text-end fw-bold">Total:</td>
                                <td id="totalMonto" class="fw-bold">S/ 0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#historialServiciosModal').modal('hide')">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.btn-close-custom {
    background: none;
    border: none;
    color: black;
    font-size: 1.5rem;
    padding: 0.5rem;
    line-height: 1;
    opacity: 0.8;
    transition: opacity 0.2s ease;
}

.btn-close-custom:hover {
    opacity: 1;
    color: black;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}
#historialServiciosModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#historialServiciosModal .modal-title::after {
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
$(document).ready(function() {
    // Variables para almacenar datos
    let currentTipo = '';
    let currentIdEntidad = '';
    let historialData = [];
    let clienteInfo = {};
    
    // Manejar clic en botón ver historial
    $(document).on('click', '.ver-historial', function() {
        currentTipo = $(this).data('tipo');
        currentIdEntidad = $(this).data('identidad');
        
        // Mostrar el modal
        $('#historialServiciosModal').modal('show');
        
        // Cargar datos del cliente/empresa
        cargarInfoCliente(currentTipo, currentIdEntidad);
        
        // Cargar historial de servicios
        cargarHistorialServicios(currentTipo, currentIdEntidad);
    });
    
    // Función para cargar información del cliente/empresa
    function cargarInfoCliente(tipo, idEntidad) {
        const endpoint = tipo === 'Natural' ? '../contratos/obtenerinfonatural.php' : '../contratos/obtenerinfoempresa.php';
        
        $('#infoClienteHistorial').html(`
            <div class="text-center py-4">
                <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                <p class="mt-2">Cargando información...</p>
            </div>
        `);
        
        $.ajax({
            url: endpoint,
            type: 'GET',
            data: { id: idEntidad },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    clienteInfo = response.data; // Almacenar información del cliente
                    
                    let html = '';
                    if(tipo === 'Natural') {
                        html = `
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-user me-2"></i>Nombre:</strong> ${response.data.nombre} ${response.data.apellidopat} ${response.data.apellidoMat}</p>
                                    <p><strong><i class="fas fa-id-card me-2"></i>Documento:</strong> ${response.data.tipoDocumento} - ${response.data.numerodocumento}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-phone me-2"></i>Teléfono:</strong> ${response.data.telefono || 'No registrado'}</p>
                                    <p><strong><i class="fas fa-envelope me-2"></i>Correo:</strong> ${response.data.correo || 'No registrado'}</p>
                                    <p><strong><i class="fas fa-map-marker-alt me-2"></i>Dirección:</strong> ${response.data.direccion || 'No registrada'}</p>
                                </div>
                            </div>
                        `;
                    } else {
                        html = `
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-building me-2"></i>Razón Social:</strong> ${response.data.razonSocial}</p>
                                    <p><strong><i class="fas fa-id-card me-2"></i>RUC:</strong> ${response.data.ruc} (${response.data.tipoRuc})</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-phone me-2"></i>Teléfono:</strong> ${response.data.telefono || 'No registrado'}</p>
                                    <p><strong><i class="fas fa-envelope me-2"></i>Correo:</strong> ${response.data.correo || 'No registrado'}</p>
                                    <p><strong><i class="fas fa-map-marker-alt me-2"></i>Dirección:</strong> ${response.data.direccion || 'No registrada'}</p>
                                </div>
                            </div>
                        `;
                    }
                    
                    $('#infoClienteHistorial').html(html);
                    $('#historialServiciosModalLabel').html(`<i class="fas fa-history me-2"></i>Historial de Servicios - ${tipo === 'Natural' ? response.data.nombre : response.data.razonSocial}`);
                } else {
                    $('#infoClienteHistorial').html(`
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>${response.message}
                        </div>
                    `);
                }
            },
            error: function() {
                $('#infoClienteHistorial').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Error al cargar la información del cliente
                    </div>
                `);
            }
        });
    }
    
    // Función para cargar historial de servicios
    function cargarHistorialServicios(tipo, idEntidad) {
        const endpoint = tipo === 'Natural' ? '../contratos/historialnatural.php' : '../contratos/historialempresa.php';
        
        $('#bodyHistorialServicios').html(`
            <tr>
                <td colspan="10" class="text-center py-4">
                    <i class="fas fa-spinner fa-spin text-primary"></i> Cargando historial...
                </td>
            </tr>
        `);
        
        $.ajax({
            url: endpoint,
            type: 'GET',
            data: { id: idEntidad },
            dataType: 'json',
            success: function(response) {
                const tbody = $('#bodyHistorialServicios');
                tbody.empty();
                
                if(response.success) {
                    historialData = response.data; // Almacenar datos para exportación
                    
                    if(response.data.length === 0) {
                        tbody.append(`
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted">
                                    <i class="fas fa-info-circle me-2"></i>No se encontraron servicios registrados
                                </td>
                            </tr>
                        `);
                    } else {
                        let totalMonto = 0;
                        
                        response.data.forEach((servicio, index) => {
                            const badge = getBadgeClass(servicio.estado);
                            totalMonto += parseFloat(servicio.monto) || 0;
                            
                            tbody.append(`
                                <tr>
                                    <td class="fw-bold">${servicio.idContrato}</td>
                                    <td>${formatDate(servicio.fechaServicio)}</td>
                                    <td>${servicio.servicio}</td>
                                    <td>${servicio.zona}</td>
                                    <td>${servicio.origen}</td>
                                    <td>${servicio.destino}</td>
                                    <td>${servicio.peso ? parseFloat(servicio.peso).toFixed(2) : '-'}</td>
                                    <td>${servicio.volumen ? parseFloat(servicio.volumen).toFixed(2) : '-'}</td>
                                    <td class="fw-bold">S/${parseFloat(servicio.monto).toFixed(2)}</td>
                                    <td><span class="badge ${badge}">${servicio.estado}</span></td>
                                </tr>
                            `);
                        });
                        
                        $('#totalMonto').text(`S/${totalMonto.toFixed(2)}`);
                    }
                } else {
                    tbody.append(`
                        <tr>
                            <td colspan="10" class="text-center py-4 text-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>${response.message}
                            </td>
                        </tr>
                    `);
                }
            },
            error: function() {
                $('#bodyHistorialServicios').html(`
                    <tr>
                        <td colspan="10" class="text-center py-4 text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>Error al cargar el historial
                        </td>
                    </tr>
                `);
            }
        });
    }
    
    // Función para exportar a Excel
    $('#btnExportExcel').click(function() {
        if(historialData.length === 0) {
            Swal.fire('Error', 'No hay datos para exportar', 'error');
            return;
        }
        
        // Redirigir al script de generación de Excel
        const tipo = currentTipo === 'Natural' ? 'natural' : 'empresa';
        window.location.href = `../reportes/generarexcelhistorialcontratos.php?tipo=${tipo}&id=${currentIdEntidad}`;
    });
    
    // Función para exportar a PDF
    $('#btnExportPDF').click(function() {
        if(historialData.length === 0) {
            Swal.fire('Error', 'No hay datos para exportar', 'error');
            return;
        }
        
        // Redirigir al script de generación de PDF
        const tipo = currentTipo === 'Natural' ? 'natural' : 'empresa';
        window.location.href = `../reportes/generarpdfhistorialcontratos.php?tipo=${tipo}&id=${currentIdEntidad}`;
    });
    
    // Función auxiliar para determinar clase del badge según estado
    function getBadgeClass(estado) {
        switch(estado) {
            case 'Pendiente': return 'bg-warning';
            case 'En Proceso': return 'bg-info';
            case 'Completado': return 'bg-success';
            case 'Anulado': return 'bg-danger';
            default: return 'bg-secondary';
        }
    }
    
    // Función para formatear fecha
    function formatDate(dateString) {
        if(!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('es-PE');
    }
});
</script>