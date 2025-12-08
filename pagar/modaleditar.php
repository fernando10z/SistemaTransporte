<!-- Modal Editar Cuenta por Pagar - Diseño Moderno -->
<div class="modal fade" id="editarCuentaPagarModal" tabindex="-1" aria-labelledby="editarCuentaPagarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-dark fw-bold" id="editarCuentaPagarModalLabel" style="font-size: 23px; color:black">
                   <i class="fas fa-pen-to-square" style="margin-right: 8px;"></i>Editar Cuenta por Pagar

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCuentaPagar">
                    <input type="hidden" id="editarIdPago" name="idpago">
                    
                    <div class="section-divider mb-4">
                        <span>Información del Proveedor</span>
                    </div>

                    <!-- Campos para Proveedor -->
                    <div class="row mb-3 animate__animated animate__fadeInUp">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editarProveedorPago" placeholder="Proveedor" readonly>
                                    <button class="btn btn-primary" type="button" id="btnEditarBuscarProveedor">
                                        <i class="fas fa-search me-2"></i> Buscar
                                    </button>
                                </div>
                                <label for="editarProveedorPago">Proveedor <span class="text-danger">*</span></label>
                            </div>
                            <input type="hidden" id="editarIdProveedor" name="idProveedor">
                        </div>
                    </div>

                    <div class="section-divider mt-4 mb-4">
                        <span>Detalles del Pago</span>
                    </div>

                    <!-- Campos comunes -->
                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="editarDescripcionPago" name="descripcion" placeholder="Descripción" style="height: 100px" required></textarea>
                                <label for="editarDescripcionPago">Descripción <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="editarMontoTotalPago" name="monto_total" placeholder="Monto Total" step="0.01" min="0" required>
                                <label for="editarMontoTotalPago">Monto Total <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="editarFechaEmisionPago" name="fecha_emision" placeholder="Fecha Emisión" required>
                                <label for="editarFechaEmisionPago">Fecha Emisión <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="editarFechaVencimientoPago" name="fecha_vencimiento" placeholder="Fecha Vencimiento" required>
                                <label for="editarFechaVencimientoPago">Fecha Vencimiento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="editarEstadoPago" name="estado" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Parcial">Parcial</option>
                                </select>
                                <label for="editarEstadoPago">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="editarMontoPagadoPago" name="monto_pagado" placeholder="Monto Pagado" step="0.01" min="0">
                                <label for="editarMontoPagadoPago">Monto Pagado</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="editarMontoFinalPago" name="monto_final" placeholder="Monto Final" step="0.01" min="0" readonly>
                                <label for="editarMontoFinalPago">Monto Final</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarPago">
                    <i class="fas fa-save me-2"></i>Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Proveedor - Diseño Moderno -->
<div class="modal fade" id="modalEditarBuscarProveedor" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-truck me-2"></i>Buscar Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control" id="editarBuscarProveedorInput" placeholder="Buscar por nombre, RUC o contacto...">
                        <button class="btn btn-primary" type="button" id="btnBuscarProveedorEditar">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="editarTablaProveedores">
                        <thead class="table-light">
                            <tr>
                                <th>RUC</th>
                                <th>Empresa</th>
                                <th>Contacto</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos personalizados para los modales de cuentas por pagar */
#editarCuentaPagarModal .modal-content,
#modalEditarBuscarProveedor .modal-content {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

#editarCuentaPagarModal .modal-header,
#modalEditarBuscarProveedor .modal-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid #f0f0f0;
}

#editarCuentaPagarModal .modal-title,
#modalEditarBuscarProveedor .modal-title {
  font-size: 1.25rem;
  font-weight: 600;
  display: flex;
  align-items: center;
}

#editarCuentaPagarModal .modal-body,
#modalEditarBuscarProveedor .modal-body {
  padding: 1.5rem;
}
#editarCuentaPagarModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarCuentaPagarModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#editarCuentaPagarModal .modal-footer,
#modalEditarBuscarProveedor .modal-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid #f0f0f0;
}

.section-divider {
  position: relative;
  text-align: center;
  margin: 2rem 0 1.5rem;
  overflow: hidden;
}

.section-divider span {
  position: relative;
  display: inline-block;
  padding: 0 1rem;
  background-color: #fff;
  color: #5d87ff;
  font-weight: 600;
  font-size: 0.875rem;
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
  background-color: #edf2f9;
  z-index: 0;
}

/* Estilos para formularios */
.form-floating > .form-control,
.form-floating > .form-select {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid #edf2f9;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
  border-color: #5d87ff;
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

.form-floating > label {
  padding: 1rem 0.75rem;
  color: #8492a6;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
  color: #5d87ff;
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para tablas */
.table {
  --bs-table-bg: transparent;
  --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
  --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
  margin-bottom: 0;
}

.table thead th {
  background-color: #edf2f9;
  color: #334d6e;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
  background-color: #edf2f9;
}

/* Botones */
.btn-primary {
  background-color: #5d87ff;
  border-color: #5d87ff;
  padding: 0.5rem 1.25rem;
}

.btn-primary:hover {
  background-color: #4569cb;
  border-color: #4569cb;
}

.btn-outline-secondary {
  border-color: #edf2f9;
  color: #8492a6;
  padding: 0.5rem 1.25rem;
}

.btn-outline-secondary:hover {
  background-color: #edf2f9;
  color: #334d6e;
}

/* Elementos readonly */
input[readonly], select[readonly] {
  background-color: #f8f9fe;
  border-color: #edf2f9;
  cursor: not-allowed;
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elementos del formulario
        const montoTotalInput = document.getElementById('editarMontoTotalPago');
        const montoPagadoInput = document.getElementById('editarMontoPagadoPago');
        const montoFinalInput = document.getElementById('editarMontoFinalPago');
        const estadoSelect = document.getElementById('estadoPago');
        const btnGuardar = document.getElementById('btnActualizarPago');
        const formCuentasPagar = document.getElementById('formEditarCuentaPagar');

        // Función para validar montos y habilitar/deshabilitar botón
        function validarMontos() {
            const montoTotal = parseFloat(montoTotalInput.value) || 0;
            const montoPagado = parseFloat(montoPagadoInput.value) || 0;
            
            if (montoPagado > montoTotal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El monto pagado no puede exceder el monto total',
                    confirmButtonText: 'Entendido'
                });
                btnGuardar.disabled = true;
                return false;
            }
            
            btnGuardar.disabled = false;
            return true;
        }

        // Función para calcular el monto final y actualizar estado
        function calcularMontoFinal() {
            if (!validarMontos()) return;
            
            const montoTotal = parseFloat(montoTotalInput.value) || 0;
            const montoPagado = parseFloat(montoPagadoInput.value) || 0;
            const montoFinal = montoTotal - montoPagado;
            
            montoFinalInput.value = montoFinal.toFixed(2);
            
            // Actualizar estado según los montos
            if (montoPagado === 0) {
                estadoSelect.value = 'Pendiente';
            } else if (montoPagado >= montoTotal) {
                estadoSelect.value = 'Pagado';
            } else {
                estadoSelect.value = 'Parcial';
            }
        }

        // Event listeners para los cambios en los inputs
        montoTotalInput.addEventListener('input', calcularMontoFinal);
        montoPagadoInput.addEventListener('input', calcularMontoFinal);
        montoTotalInput.addEventListener('change', calcularMontoFinal);
        montoPagadoInput.addEventListener('change', calcularMontoFinal);

        // Validar al enviar el formulario
        formCuentasPagar.addEventListener('submit', function(e) {
            if (!validarMontos()) {
                e.preventDefault();
            }
        });

        // Inicializar el cálculo al cargar
        calcularMontoFinal();
    });
</script>
<script>
      $('#editarMontoTotalPago').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
    $('#editarMontoPagadoPago').off('input change').on('input change', function() {
             const value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
        $(this).val('0.00');
         }
         });
</script>
<script>
$(document).ready(function() {
    // Manejar clic en botón editar pago
    $(document).on('click', '.editar-pago', function() {
        const id = $(this).data('id');
        
        // Limpiar formulario
        $('#formEditarCuentaPagar')[0].reset();
        
        // Configurar ID del pago
        $('#editarIdPago').val(id);
        
        // Cargar datos del pago
        cargarDatosPago(id);
        
        // Mostrar modal
        $('#editarCuentaPagarModal').modal('show');
    });

    // Cargar datos del pago
   function cargarDatosPago(id) {
    $.ajax({
        url: '../pagar/obtener.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const pago = response.data;

                // Procesar fechas
                const fechaEmisionBD = pago.fecha_emision?.split(' ')[0] || '';
                const fechaVencimiento = pago.fecha_vencimiento?.split(' ')[0] || '';

                // Establecer fecha de emisión
                $('#editarFechaEmisionPago').val(fechaEmisionBD);
                $('#editarFechaEmisionPago').attr('min', fechaEmisionBD); // No permitir menor que BD

                // Establecer fecha de vencimiento y bloquear hacia atrás
                $('#editarFechaVencimientoPago').val(fechaVencimiento);
                $('#editarFechaVencimientoPago').attr('min', fechaEmisionBD); // Se actualiza si cambia fecha emisión

                // Validar cambio en fecha de emisión
                $('#editarFechaEmisionPago').off('change').on('change', function () {
                    const nuevaFecha = this.value;
                    if (nuevaFecha < fechaEmisionBD) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha no permitida',
                            text: 'No puedes seleccionar una fecha de emisión anterior a la registrada (' + fechaEmisionBD + ')',
                            confirmButtonText: 'Entendido'
                        });
                        this.value = fechaEmisionBD;
                    } else {
                        // Actualizar mínimo permitido en vencimiento
                        $('#editarFechaVencimientoPago').attr('min', nuevaFecha);
                    }
                });

                // Validar cambio en fecha de vencimiento
                $('#editarFechaVencimientoPago').off('change').on('change', function () {
                    const fechaEmisionActual = $('#editarFechaEmisionPago').val();
                    if (this.value < fechaEmisionActual) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha no permitida',
                            text: 'La fecha de vencimiento no puede ser anterior a la fecha de emisión (' + fechaEmisionActual + ')',
                            confirmButtonText: 'Entendido'
                        });
                        this.value = fechaEmisionActual;
                    }
                });

                // Llenar los demás campos
                $('#editarIdProveedor').val(pago.idProveedor);
                $('#editarProveedorPago').val(pago.nombre_empresa);
                $('#editarDescripcionPago').val(pago.descripcion);
                $('#editarMontoTotalPago').val(pago.monto_total);
                $('#editarMontoPagadoPago').val(pago.monto_pagado);
                $('#editarMontoFinalPago').val(pago.monto_total - pago.monto_pagado);
                $('#editarEstadoPago').val(pago.estado);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar datos: ' + error
            });
        }
    });
}

    // Abrir modal para buscar proveedor
    $('#btnEditarBuscarProveedor').click(function() {
        $('#modalEditarBuscarProveedor').modal('show');
        cargarProveedoresParaEditar();
    });

    // Buscar proveedores en modal de edición
    $('#editarBuscarProveedorInput').keyup(function() {
        cargarProveedoresParaEditar($(this).val());
    });

    // Cargar proveedores para edición
    function cargarProveedoresParaEditar(search = '') {
        $.ajax({
            url: '../pagar/obtenerproveedor.php',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                $('#editarTablaProveedores tbody').empty();
                response.forEach(function(proveedor) {
                    $('#editarTablaProveedores tbody').append(`
                        <tr>
                            <td>${proveedor.numero_ruc}</td>
                            <td>${proveedor.nombre_empresa}</td>
                            <td>${proveedor.contacto_nombre}</td>
                            <td>${proveedor.contacto_telefono}</td>
                            <td>${proveedor.contacto_correo}</td>
                            <td>${proveedor.estado}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarProveedorEditar" 
                                        data-id="${proveedor.idProveedor}" 
                                        data-nombre="${proveedor.nombre_empresa}">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Configurar evento para botones de selección
                $('.btnSeleccionarProveedorEditar').click(function() {
                    const idProveedor = $(this).data('id');
                    const nombreProveedor = $(this).data('nombre');
                    
                    $('#editarIdProveedor').val(idProveedor);
                    $('#editarProveedorPago').val(nombreProveedor);
                    $('#modalEditarBuscarProveedor').modal('hide');
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar proveedores: ' + error
                });
            }
        });
    }

    // Calcular monto final al editar
    $('#editarMontoPagadoPago').on('input', function() {
        const montoTotal = parseFloat($('#editarMontoTotalPago').val()) || 0;
        const montoPagado = parseFloat($(this).val()) || 0;
        const montoFinal = montoTotal - montoPagado;
        
        $('#editarMontoFinalPago').val(montoFinal.toFixed(2));
        
        // Actualizar estado según montos
        if (montoPagado === 0) {
            $('#editarEstadoPago').val('Pendiente');
        } else if (montoPagado >= montoTotal) {
            $('#editarEstadoPago').val('Pagado');
        } else {
            $('#editarEstadoPago').val('Parcial');
        }
    });

    // Actualizar pago
    $('#btnActualizarPago').click(function() {
        const formData = $('#formEditarCuentaPagar').serialize();
        
        $.ajax({
            url: '../pagar/actualizar.php',
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
                        $('#editarCuentaPagarModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al actualizar: ' + error
                });
            }
        });
    });
});
</script>