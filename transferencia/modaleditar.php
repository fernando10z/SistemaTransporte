<style>
    #modalEditarTransaccion .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarTransaccion .modal-title::after {
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
<!-- Modal para Editar Transacciones Financieras -->
<div class="modal fade" id="modalEditarTransaccion" tabindex="-1" role="dialog" aria-labelledby="modalEditarTransaccionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarTransaccionLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Transacción Financiera
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalEditarTransaccion').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarTransaccion">
                    <input type="hidden" id="edit_idtransaccion" name="idtransaccion">
                    
                    <!-- Sección de Servicio (opcional) -->
                    <div class="section-divider">
                        <span>Información de Servicio (Opcional)</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_servicioInfo" placeholder="Servicio relacionado" readonly>
                                <label for="edit_servicioInfo">Servicio relacionado</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarServicioEditar()">
                                <i class="fas fa-search me-2"></i>Buscar Servicio
                            </button>
                        </div>
                    </div>
                    
                    <input type="hidden" id="edit_idServicio" name="idServicio">
                    
                    <!-- Campos principales de la transacción -->
                    <div class="section-divider mt-4">
                        <span>Detalles de la Transacción</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_tipo" name="tipo" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Ingreso">Ingreso</option>
                                    <option value="Egreso">Egreso</option>
                                </select>
                                <label for="edit_tipo">Tipo de Transacción</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_estado" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="edit_estado">Estado</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_concepto" name="concepto" placeholder="Concepto" required>
                                <label for="edit_concepto">Concepto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="edit_monto" name="monto" placeholder="Monto" step="0.01" min="0" required>
                                <label for="edit_monto">Monto</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="edit_fecha" name="fecha" required>
                                <label for="edit_fecha">Fecha</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_metodo_pago" name="metodo_pago" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Crédito">Crédito</option>
                                </select>
                                <label for="edit_metodo_pago">Método de Pago</label>
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
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEditarTransaccion').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarTransaccion">
                    <i class="fas fa-save me-2"></i>Actualizar Transacción
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Función para abrir el modal de edición
$(document).on('click', '.editar-transaccion', function () {
    const idtransaccion = $(this).data('id');

    $.ajax({
        url: '../transferencia/obtener.php',
        type: 'POST',
        data: { idtransaccion: idtransaccion },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const data = response.data;

                // Llenar campos del formulario
                $('#edit_idtransaccion').val(data.idtransaccion);
                $('#edit_idServicio').val(data.idServicio || '');
                $('#edit_servicioInfo').val(data.nombreServicio || '');
                $('#edit_tipo').val(data.tipo);
                $('#edit_estado').val(data.estado);
                $('#edit_concepto').val(data.concepto);
                $('#edit_monto').val(data.monto);
                $('#edit_metodo_pago').val(data.metodo_pago);
                $('#edit_observaciones').val(data.observaciones || '');

                const fechaVigenciaBD = data.fecha?.split(' ')[0] || ''; // Limpiar formato si tiene hora

                // Establecer la fecha actual y mínima en el campo de fecha
                $('#edit_fecha').val(fechaVigenciaBD);
                $('#edit_fecha').attr('min', fechaVigenciaBD);

                // Bloquear fechas anteriores a la fecha actual desde BD
                $('#edit_fecha').off('change').on('change', function () {
                    if (fechaVigenciaBD && this.value < fechaVigenciaBD) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha no permitida',
                            text: 'No puedes seleccionar una fecha anterior a la vigente (' + fechaVigenciaBD + ')',
                            confirmButtonText: 'Entendido'
                        });
                        this.value = fechaVigenciaBD;
                    }
                });

                // Mostrar el modal de edición
                $('#modalEditarTransaccion').modal('show');

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'No se pudo obtener los datos de la transacción',
                    confirmButtonText: 'Cerrar'
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al obtener los datos: ' + error,
                confirmButtonText: 'Cerrar'
            });
        }
    });
});
  $('#edit_monto').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });

// Función para buscar servicio en el modal de edición
function buscarServicioEditar() {
    // Cerrar temporalmente el modal de edición (pero mantenerlo en memoria)
    $('#modalEditarTransaccion').modal('hide');
    
    // Mostrar el modal de búsqueda
    $('#modalBuscarServicio').modal('show');
    
    // Cuando se cierra el modal de búsqueda, volver a mostrar el de edición
    $('#modalBuscarServicio').on('hidden.bs.modal', function() {
        $('#modalEditarTransaccion').modal('show');
        $(this).off('hidden.bs.modal'); // Eliminar el evento para no acumular listeners
    });
    
    cargarServicios(); // Cargar todos los servicios inicialmente
    
    // Cambiar la función de selección para que actualice los campos del modal de edición
    window.seleccionarServicio = function(idServicio, nombreServicio) {
        $('#edit_idServicio').val(idServicio);
        $('#edit_servicioInfo').val(nombreServicio);
        $('#modalBuscarServicio').modal('hide');
    };
}

// Función para actualizar la transacción
$('#btnActualizarTransaccion').click(function() {
    if ($('#formEditarTransaccion')[0].checkValidity()) {
        const formData = $('#formEditarTransaccion').serialize();

        $.ajax({
            url: '../transferencia/actualizar.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message || 'Transacción actualizada correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        $('#modalEditarTransaccion').modal('hide');
                        location.reload(); // Recarga la página
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'No se pudo actualizar la transacción',
                        confirmButtonText: 'Cerrar'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar: ' + error,
                    confirmButtonText: 'Cerrar'
                });
            }
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor complete todos los campos requeridos',
            confirmButtonText: 'Ok'
        });
    }
});
</script>
