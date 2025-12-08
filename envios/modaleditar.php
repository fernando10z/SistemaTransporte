<!-- Modal para Editar Evento de Envío -->
<div class="modal fade" id="modalEditarEvento" tabindex="-1" role="dialog" aria-labelledby="modalEditarEventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarEventoLabel">
                    <i class="fas fa-edit me-2"></i>Editar Evento de Envío
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalEditarEvento').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarEvento">
                    <input type="hidden" id="edit_idEvento" name="idEvento">
                    <input type="hidden" id="edit_tipoEnvio" name="tipoEnvio">
                    
                    <!-- Campos comunes -->
                    <div class="section-divider">
                        <span>Información del Seguimiento</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_remitente" placeholder="Remitente" readonly>
                                <label for="edit_remitente">Remitente</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary w-100 h-100" id="btnBuscarSeguimientoEdit">
                                <i class="fas fa-search me-2"></i>Buscar Seguimiento
                            </button>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_codigoSeguimiento" placeholder="Código Seguimiento" readonly>
                                <label for="edit_codigoSeguimiento">Código Seguimiento</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_vehiculo" placeholder="Vehículo" readonly>
                                <label for="edit_vehiculo">Vehículo</label>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="edit_idSeguimiento" name="idSeguimiento">
                    
                    <div class="section-divider mt-4">
                        <span>Detalles del Evento</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_tipoSeguimiento" name="tipoSeguimiento" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Inicio">Inicio</option>
                                    <option value="En tránsito">En tránsito</option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Incidentado">Incidentado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                                <label for="edit_tipoSeguimiento">Estado del Envío</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="edit_fechaEvento" name="fechaEvento" required>
                                <label for="edit_fechaEvento">Fecha y Hora del Evento</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_latitud" name="latitud" placeholder="Latitud" required>
                                <label for="edit_latitud">Latitud</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_longitud" name="longitud" placeholder="Longitud" required>
                                <label for="edit_longitud">Longitud</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="edit_observaciones" name="observaciones" placeholder="Observaciones" style="height: 100px"></textarea>
                                <label for="edit_observaciones">Observaciones</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEditarEvento').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarEvento">
                    <i class="fas fa-save me-2"></i>Actualizar Evento
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Seguimiento en Edición -->
<div class="modal fade" id="modalBuscarSeguimientoEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-search me-2"></i>Buscar Seguimiento
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarSeguimientoEdit').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="busquedaSeguimientoEdit" placeholder="Buscar por código, remitente...">
                            <button class="btn btn-primary" type="button" onclick="filtrarSeguimientosEdit()">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Remitente</th>
                                <th>Código Seguimiento</th>
                                <th>Vehículo</th>
                                <th>Estado</th>
                                <th>Última Actualización</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaSeguimientosEdit">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarSeguimientoEdit').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Función para abrir el modal de edición
function abrirModalEditar(idEvento, tipoEnvio) {
    // Limpiar formulario
    $('#formEditarEvento')[0].reset();
    
    // Configurar tipo de envío
    $('#edit_tipoEnvio').val(tipoEnvio);
    $('#edit_idEvento').val(idEvento);
    
  // Obtener datos del evento
$.ajax({
    url: '../envios/obtener.php',
    type: 'GET',
    dataType: 'json',
    data: {
        idEvento: idEvento,
        tipoEnvio: tipoEnvio
    },
    success: function(response) {
        if(response.success) {
            const evento = response.data;

            // Convertir fecha a formato datetime-local (YYYY-MM-DDTHH:MM)
            const fechaEvento = new Date(evento.fechaEvento);
            const pad = num => num.toString().padStart(2, '0');
            const fechaFormatoInput = `${fechaEvento.getFullYear()}-${pad(fechaEvento.getMonth()+1)}-${pad(fechaEvento.getDate())}T${pad(fechaEvento.getHours())}:${pad(fechaEvento.getMinutes())}`;

            // Llenar campos del formulario
            $('#edit_remitente').val(evento.remitente);
            $('#edit_codigoSeguimiento').val(evento.codigoSeguimiento);
            $('#edit_vehiculo').val(evento.vehiculo);
            $('#edit_idSeguimiento').val(evento.idSeguimiento);
            $('#edit_tipoSeguimiento').val(evento.tipoSeguimiento);
            $('#edit_fechaEvento').val(fechaFormatoInput).attr('min', fechaFormatoInput);
            $('#edit_latitud').val(evento.latitud);
            $('#edit_longitud').val(evento.longitud);
            $('#edit_observaciones').val(evento.observaciones);

            // Bloquear fechas y horas anteriores
            $('#edit_fechaEvento').off('change').on('change', function () {
                if (this.value < this.min) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fecha y hora no permitidas',
                        text: 'No puedes seleccionar una fecha/hora anterior a la del evento.',
                        confirmButtonText: 'Entendido'
                    });
                    this.value = this.min;
                }
            });

            // Mostrar modal
            $('#modalEditarEvento').modal('show');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
            });
        }
    },
    error: function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo cargar la información del evento'
        });
    }
});
}
// Botón para buscar seguimiento en edición
$('#btnBuscarSeguimientoEdit').click(function() {
    const tipoEnvio = $('#edit_tipoEnvio').val();
    $('#modalBuscarSeguimientoEdit').modal('show');
    cargarSeguimientosEdit(tipoEnvio);
});

// Función para cargar seguimientos en modal de edición
function cargarSeguimientosEdit(tipoEnvio) {
    const url = tipoEnvio === 'empresa' ? 
        '../envios/obtenerempresa.php' : 
        '../envios/obtenerclientes.php';
    
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let html = '';
            if (data.error) {
                html = '<tr><td colspan="6" class="text-center">'+data.error+'</td></tr>';
            } else if (data.length === 0) {
                html = '<tr><td colspan="6" class="text-center">No se encontraron seguimientos</td></tr>';
            } else {
                data.forEach(seguimiento => {
                    const remitente = tipoEnvio === 'empresa' ? 
                        seguimiento.razon_social || 'N/A' : 
                        seguimiento.nombre_completo || 'N/A';
                    
                    html += `
                        <tr>
                            <td>${remitente}</td>
                            <td>${seguimiento.codigoSeguimiento || 'N/A'}</td>
                            <td>${seguimiento.vehiculo || 'N/A'}</td>
                            <td>${seguimiento.estado_envio || 'N/A'}</td>
                            <td>${seguimiento.ultima_actualizacion || 'N/A'}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="seleccionarSeguimientoEdit(
                                    '${seguimiento.id_seguimiento}',
                                    '${remitente.replace(/'/g, "\\'")}',
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
            $('#tablaSeguimientosEdit').html(html);
        },
        error: function() {
            $('#tablaSeguimientosEdit').html('<tr><td colspan="6" class="text-center">Error al cargar datos</td></tr>');
        }
    });
}

// Función para seleccionar seguimiento en edición
function seleccionarSeguimientoEdit(idSeguimiento, remitente, codigoSeguimiento, vehiculo) {
    $('#edit_idSeguimiento').val(idSeguimiento);
    $('#edit_remitente').val(remitente);
    $('#edit_codigoSeguimiento').val(codigoSeguimiento);
    $('#edit_vehiculo').val(vehiculo);
    $('#modalBuscarSeguimientoEdit').modal('hide');
}

// Función para filtrar seguimientos en edición
function filtrarSeguimientosEdit() {
    const busqueda = $('#busquedaSeguimientoEdit').val().toLowerCase();
    $('#tablaSeguimientosEdit tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

// Botón para actualizar evento
$('#btnActualizarEvento').click(function() {
    const formData = $('#formEditarEvento').serialize();
    const tipoEnvio = $('#edit_tipoEnvio').val();
    
    $.ajax({
        url: '../envios/actualizar.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if(response.success) {
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
                    text: response.message
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo actualizar el evento'
            });
        }
    });
});

// Obtener ubicación actual en edición
function obtenerUbicacionActualEdit() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                $('#edit_latitud').val(position.coords.latitude);
                $('#edit_longitud').val(position.coords.longitude);
            },
            function(error) {
                console.error('Error al obtener ubicación:', error);
            }
        );
    }
}

// Evento cuando se muestra el modal de edición
$('#modalEditarEvento').on('shown.bs.modal', function() {
    obtenerUbicacionActualEdit();
});

// Evento para botones editar en la tabla
$(document).on('click', '.editar', function() {
    const idEvento = $(this).data('id');
    const tipoEnvio = $(this).data('type');
    abrirModalEditar(idEvento, tipoEnvio);
});
</script>