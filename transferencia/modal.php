<style>
    #modalTransaccionFinanciera .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalTransaccionFinanciera .modal-title::after {
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
<!-- Modal para Transacciones Financieras - Diseño Moderno -->
<div class="modal fade" id="modalTransaccionFinanciera" tabindex="-1" role="dialog" aria-labelledby="modalTransaccionFinancieraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTransaccionFinancieraLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-money-bill-wave me-2"></i>Registro de Transacción Financiera
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalTransaccionFinanciera').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formTransaccionFinanciera">
                    <input type="hidden" id="idtransaccion" name="idtransaccion">
                    
                    <!-- Sección de Servicio (opcional) -->
                    <div class="section-divider">
                        <span>Información de Servicio (Opcional)</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="servicioInfo" placeholder="Servicio relacionado" readonly>
                                <label for="servicioInfo">Servicio relacionado</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary w-100 h-100" onclick="buscarServicio()">
                                <i class="fas fa-search me-2"></i>Buscar Servicio
                            </button>
                        </div>
                    </div>
                    
                    <input type="hidden" id="idServicio" name="idServicio">
                    
                    <!-- Campos principales de la transacción -->
                    <div class="section-divider mt-4">
                        <span>Detalles de la Transacción</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Ingreso">Ingreso</option>
                                    <option value="Egreso">Egreso</option>
                                </select>
                                <label for="tipo">Tipo de Transacción</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Activo" selected>Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Concepto" required>
                                <label for="concepto">Concepto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="monto" name="monto" placeholder="Monto" step="0.01" min="0" required>
                                <label for="monto">Monto</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                                <label for="fecha">Fecha</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Crédito">Crédito</option>
                                </select>
                                <label for="metodo_pago">Método de Pago</label>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalTransaccionFinanciera').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarTransaccion">
                    <i class="fas fa-save me-2"></i>Guardar Transacción
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar Servicios -->
<div class="modal fade" id="modalBuscarServicio" tabindex="-1" role="dialog" aria-labelledby="modalBuscarServicioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarServicioLabel">
                    <i class="fas fa-search me-2"></i>Buscar Servicio
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarServicio').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="busquedaServicio" placeholder="Buscar por nombre, tipo de carga, estado...">
                            <button class="btn btn-primary" type="button" onclick="filtrarServicios()">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Servicio</th>
                                <th>Tipo de Carga</th>
                                <th>Estado</th>
                                <th>Fecha Registro</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaServicios">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarServicio').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputFecha = document.getElementById("fecha");
        const hoy = new Date();
        const yyyy = hoy.getFullYear();
        const mm = String(hoy.getMonth() + 1).padStart(2, '0');
        const dd = String(hoy.getDate()).padStart(2, '0');
        const fechaMinima = `${yyyy}-${mm}-${dd}`;
        inputFecha.min = fechaMinima;
    });
     $('#monto').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
</script>

<script>
    // Función para abrir el modal de búsqueda de servicios
function buscarServicio() {
    $('#modalBuscarServicio').modal('show');
    cargarServicios(); // Cargar todos los servicios inicialmente
}

// Función para cargar servicios (sin filtro)
function cargarServicios() {
    $.ajax({
        url: '../transferencia/obtenerservicios.php',
        type: 'GET',
        success: function(response) {
            $('#tablaServicios').html(response);
        },
        error: function(xhr, status, error) {
            alert('Error al cargar servicios: ' + error);
        }
    });
}

// Función para filtrar servicios según búsqueda
function filtrarServicios() {
    const busqueda = $('#busquedaServicio').val();
    
    $.ajax({
        url: '../transferencia/filtrar.php',
        type: 'POST',
        data: { busqueda: busqueda },
        success: function(response) {
            $('#tablaServicios').html(response);
        },
        error: function(xhr, status, error) {
            alert('Error al filtrar servicios: ' + error);
        }
    });
}

// Función para seleccionar un servicio (se llamaría desde el botón en la tabla)
function seleccionarServicio(idServicio, nombreServicio) {
    $('#idServicio').val(idServicio);
    $('#servicioInfo').val(nombreServicio);
    $('#modalBuscarServicio').modal('hide');
}

$('#btnGuardarTransaccion').click(function () {
    if ($('#formTransaccionFinanciera')[0].checkValidity()) {
        const formData = $('#formTransaccionFinanciera').serialize();

        $.ajax({
            url: '../transferencia/guardar.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Transacción guardada correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    $('#modalTransaccionFinanciera').modal('hide');
                    location.reload(); // Recarga la página
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo guardar la transacción: ' + error,
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