<!-- Modal para Editar Evento de Ruta -->
<div class="modal fade" id="modalEditarEvento" tabindex="-1" role="dialog" aria-labelledby="modalEditarEventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarEventoLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Evento en Ruta
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalEditarEvento').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarEvento">
                    <input type="hidden" id="editIdEvento" name="idEvento">
                    <input type="hidden" id="editTipoPlanificacion" name="tipoPlanificacion">
                    
                    <!-- Campos para Persona Natural -->
                    <div id="editCamposNatural" style="display:none;">
                        <div class="section-divider">
                            <span>Información de Planificación</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editClienteNaturalInfo" placeholder="Cliente" readonly>
                                    <label for="editClienteNaturalInfo">Cliente</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarPlanificacionClienteEditar()">
                                    <i class="fas fa-search me-2"></i>Buscar Planificación
                                </button>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editRutaCliente" placeholder="Ruta" readonly>
                                    <label for="editRutaCliente">Ruta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editConductorCliente" placeholder="Conductor" readonly>
                                    <label for="editConductorCliente">Conductor</label>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="editIdPlanificacionCliente" name="idPlanificacion">
                    </div>
                    
                    <!-- Campos para Empresa -->
                    <div id="editCamposEmpresa" style="display:none;">
                        <div class="section-divider">
                            <span>Información de Planificación</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editEmpresaInfo" placeholder="Empresa" readonly>
                                    <label for="editEmpresaInfo">Empresa</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarPlanificacionEmpresaEditar()">
                                    <i class="fas fa-search me-2"></i>Buscar Planificación
                                </button>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editRutaEmpresa" placeholder="Ruta" readonly>
                                    <label for="editRutaEmpresa">Ruta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editConductorEmpresa" placeholder="Conductor" readonly>
                                    <label for="editConductorEmpresa">Conductor</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Para empresas, cambia el name a idPlanificacionEmpresa -->
                        <input type="hidden" id="editIdPlanificacionEmpresa" name="idPlanificacionempresa"> 
              </div>
                    
                    <!-- Campos comunes -->
                    <div class="section-divider mt-4">
                        <span>Detalles del Evento</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="editTipoEvento" name="tipoEvento" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Desvío">Desvío</option>
                                    <option value="Retraso">Retraso</option>
                                    <option value="Incidente">Incidente</option>
                                    <option value="Iniciando">Iniciando</option>
                                    <option value="Completado">Completado</option>
                                </select>
                                <label for="editTipoEvento">Tipo de Evento</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="editFechaEvento" name="fechaEvento" required>
                                <label for="editFechaEvento">Fecha y Hora del Evento</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="editLatitud" name="latitud" placeholder="Latitud" required>
                                <label for="editLatitud">Latitud</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="editLongitud" name="longitud" placeholder="Longitud" required>
                                <label for="editLongitud">Longitud</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="editDescripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="editDescripcion">Descripción</label>
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

<!-- Modales de búsqueda para edición (similares a los de registro pero con prefijo "edit") -->
<!-- Modal para buscar Planificación de Cliente (Edición) -->
<div class="modal fade" id="modalBuscarPlanificacionClienteEditar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarPlanificacionClienteLabel">
                    <i class="fas fa-search me-2"></i>Buscar Planificación - Clientes Naturales
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarPlanificacionClienteEditar').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="busquedaPlanificacionClienteedit" placeholder="Buscar por nombre, documento, ruta...">
                            <button class="btn btn-primary" type="button" onclick="filtrarPlanificacionesCliente()">
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
                                <th>Ruta</th>
                                <th>Conductor</th>
                                <th>Fecha Planificación</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPlanificacionesClienteEditar">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarPlanificacionCliente').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar Planificación de Empresa (Edición) -->
<div class="modal fade" id="modalBuscarPlanificacionEmpresaEditar" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarPlanificacionEmpresaLabel">
                    <i class="fas fa-search me-2"></i>Buscar Planificación - Empresas
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarPlanificacionEmpresaEditar').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="busquedaPlanificacionEmpresa" placeholder="Buscar por razón social, RUC, ruta...">
                            <button class="btn btn-primary" type="button" onclick="filtrarPlanificacionesEmpresa()">
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
                                <th>Ruta</th>
                                <th>Conductor</th>
                                <th>Fecha Planificación</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPlanificacionesEmpresaEditar">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarPlanificacionEmpresa').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<style>
    #modalEditarEvento .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarEvento .modal-title::after {
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
    // Función para manejar el clic en el botón editar
$(document).on('click', '.editar', function() {
    const idEvento = $(this).data('id');
    const tipoPlanificacion = $(this).data('type');
    
    // Mostrar el modal de edición
    $('#modalEditarEvento').modal('show');
    
    // Configurar el tipo de planificación
    $('#editTipoPlanificacion').val(tipoPlanificacion);
    
    // Mostrar los campos correspondientes
    if (tipoPlanificacion === 'cliente') {
        $('#editCamposNatural').show();
        $('#editCamposEmpresa').hide();
    } else {
        $('#editCamposNatural').hide();
        $('#editCamposEmpresa').show();
    }
    
    // Cargar los datos del evento
    cargarDatosEvento(idEvento, tipoPlanificacion);
});

// Función para cargar los datos del evento
function cargarDatosEvento(idEvento, tipoPlanificacion) {
    $.ajax({
        url: '../eventos/obtener.php',
        type: 'GET',
        data: { id: idEvento, tipo: tipoPlanificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const evento = response.data;

                // Convertir fechaEvento a formato datetime-local (YYYY-MM-DDTHH:MM)
                const fechaEvento = new Date(evento.fechaEvento);
                const pad = num => num.toString().padStart(2, '0');
                const fechaFormatoInput = `${fechaEvento.getFullYear()}-${pad(fechaEvento.getMonth()+1)}-${pad(fechaEvento.getDate())}T${pad(fechaEvento.getHours())}:${pad(fechaEvento.getMinutes())}`;

                // Llenar campos del formulario
                $('#editIdEvento').val(idEvento);
                $('#editTipoEvento').val(evento.tipoEvento);

                // Asignar valor y min al campo fecha
                $('#editFechaEvento').val(fechaFormatoInput).attr('min', fechaFormatoInput);

                $('#editLatitud').val(evento.latitud);
                $('#editLongitud').val(evento.longitud);
                $('#editDescripcion').val(evento.descripcion);

                if (tipoPlanificacion === 'cliente') {
                    $('#editClienteNaturalInfo').val(evento.clienteInfo);
                    $('#editRutaCliente').val(evento.ruta);
                    $('#editConductorCliente').val(evento.conductor);
                    $('#editIdPlanificacionCliente').val(evento.idPlanificacion);
                } else {
                    $('#editEmpresaInfo').val(evento.empresaInfo);
                    $('#editRutaEmpresa').val(evento.ruta);
                    $('#editConductorEmpresa').val(evento.conductor);
                    $('#editIdPlanificacionEmpresa').val(evento.idPlanificacionempresa);
                }

                // Validar que la fecha no sea menor a la mínima permitida
                $('#editFechaEvento').off('change').on('change', function() {
                    if (this.value < this.min) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha no permitida',
                            text: 'No puedes seleccionar una fecha anterior a la fecha del evento.',
                            confirmButtonText: 'Entendido'
                        });
                        this.value = this.min;
                    }
                });

            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'No se pudieron cargar los datos del evento', 'error');
        }
    });
}

// Función para actualizar el evento
$('#btnActualizarEvento').click(function() {
    const tipoPlanificacion = $('#editTipoPlanificacion').val();
    const formData = $('#formEditarEvento').serialize();
        console.log("Datos a enviar:", formData); // Verifica qué se está enviando

    let url = tipoPlanificacion === 'cliente' 
        ? '../eventos/actualizarclientes.php' 
        : '../eventos/actualizarempresa.php';
    
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
                    showConfirmButton: false
                }).then(() => {
                    $('#modalEditarEvento').modal('hide');
                    location.reload(); // Recargar la página
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
                text: 'Ocurrió un error al actualizar el evento'
            });
        }
    });
});

// Funciones para buscar planificaciones en edición
function buscarPlanificacionClienteEditar() {
    $('#modalBuscarPlanificacionClienteEditar').modal('show');
    cargarPlanificacionesClienteEditar();
}

function buscarPlanificacionEmpresaEditar() {
    $('#modalBuscarPlanificacionEmpresaEditar').modal('show');
    cargarPlanificacionesEmpresaEditar();
}

function cargarPlanificacionesClienteEditar() {
    $.ajax({
        url: '../eventos/obtenerplanificacioncliente.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Datos recibidos:', data);
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
                                <button class="btn btn-sm btn-primary" onclick="seleccionarPlanificacionClienteEditar(
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
            $('#tablaPlanificacionesClienteEditar').html(html);
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText);
            $('#tablaPlanificacionesClienteEditar').html('<tr><td colspan="6" class="text-center">Error al cargar datos</td></tr>');
        }
    });
}

function cargarPlanificacionesEmpresaEditar() {
    $.ajax({
        url: '../eventos/obtenerplanificacionempresa.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let html = '';
            if (data.length === 0) {
                html = '<tr><td colspan="6" class="text-center">No se encontraron planificaciones</td></tr>';
            } else {
                data.forEach(planificacion => {
                    html += `
                        <tr>
                            <td>${planificacion.razonSocial}</td>
                            <td>${planificacion.ruc}</td>
                            <td>${planificacion.ruta}</td>
                            <td>${planificacion.conductor}</td>
                            <td>${planificacion.fecha_planificada} ${planificacion.hora_planificada}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="seleccionarPlanificacionEmpresaEditar(
                                    '${planificacion.id_planificacion}',
                                    '${planificacion.razonSocial.replace(/'/g, "\\'")}',
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
            $('#tablaPlanificacionesEmpresaEditar').html(html);
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText);
            $('#tablaPlanificacionesEmpresaEditar').html('<tr><td colspan="6" class="text-center">Error al cargar datos</td></tr>');
        }
    });
}

// Funciones para seleccionar planificación en edición
function seleccionarPlanificacionClienteEditar(idPlanificacion, nombreCompleto, ruta, conductor) {
    $('#editIdPlanificacionCliente').val(idPlanificacion);
    $('#editClienteNaturalInfo').val(nombreCompleto);
    $('#editRutaCliente').val(ruta);
    $('#editConductorCliente').val(conductor);
    $('#modalBuscarPlanificacionClienteEditar').modal('hide');
}

function seleccionarPlanificacionEmpresaEditar(idPlanificacion, razonSocial, ruta, conductor) {
    $('#editIdPlanificacionEmpresa').val(idPlanificacion);
    $('#editEmpresaInfo').val(razonSocial);
    $('#editRutaEmpresa').val(ruta);
    $('#editConductorEmpresa').val(conductor);
    $('#modalBuscarPlanificacionEmpresaEditar').modal('hide');
}

// Funciones de filtrado para edición
function filtrarPlanificacionesClienteEditar() {
    const busqueda = $('#busquedaPlanificacionClienteedit').val().toLowerCase();
    $('#tablaPlanificacionesClienteEditar tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

function filtrarPlanificacionesEmpresaEditar() {
    const busqueda = $('#busquedaPlanificacionEmpresaedit').val().toLowerCase();
    $('#tablaPlanificacionesEmpresaEditar tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        $(this).toggle(textoFila.includes(busqueda));
    });
}

</script>