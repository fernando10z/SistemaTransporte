<!-- Modal Cuentas por Pagar - Diseño Moderno -->
<div class="modal fade" id="cuentasPagarModal" tabindex="-1" aria-labelledby="cuentasPagarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="cuentasPagarModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Registrar Cuenta por Pagar
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCuentasPagar">
                    <div class="section-divider mb-4">
                        <span>Información del Proveedor</span>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="proveedorPago" placeholder="Proveedor" readonly>
                                    <button class="btn btn-primary" type="button" id="btnBuscarProveedorPago">
                                        <i class="fas fa-search me-2"></i>Buscar
                                    </button>
                                </div>
                                <label for="proveedorPago">Proveedor <span class="text-danger">*</span></label>
                            </div>
                            <input type="hidden" id="idProveedorPago" name="idProveedor">
                        </div>
                    </div>

                    <div class="section-divider mt-4 mb-4">
                        <span>Detalles del Pago</span>
                    </div>

                    <!-- Campos comunes -->
                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcionPago" name="descripcion" placeholder="Descripción" style="height: 100px" required></textarea>
                                <label for="descripcionPago">Descripción <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="montoTotalPago" name="monto_total" placeholder="Monto Total" step="0.01" min="0" required>
                                <label for="montoTotalPago">Monto Total <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaEmisionPago" name="fecha_emision" placeholder="Fecha Emisión" required>
                                <label for="fechaEmisionPago">Fecha Emisión <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaVencimientoPago" name="fecha_vencimiento" placeholder="Fecha Vencimiento" required>
                                <label for="fechaVencimientoPago">Fecha Vencimiento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="estadoPago" name="estado" required>
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Parcial">Parcial</option>
                                </select>
                                <label for="estadoPago">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="montoPagadoPago" name="monto_pagado" placeholder="Monto Pagado" step="0.01" min="0" value="0">
                                <label for="montoPagadoPago">Monto Pagado</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="montoFinalPago" name="monto_final" placeholder="Monto Final" step="0.01" min="0" readonly>
                                <label for="montoFinalPago">Monto Final</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarCuentaPagar">
                    <i class="fas fa-save me-2"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Proveedor - Diseño Moderno -->
<div class="modal fade" id="modalBuscarProveedorPago" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-truck me-2"></i>Buscar Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="buscarProveedorPagoInput" placeholder="Buscar por nombre, RUC o contacto...">
                        <button class="btn btn-primary" type="button" id="btnBuscarProveedor">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaProveedoresPago">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para los modales de cuentas por pagar */
#cuentasPagarModal .modal-content,
#modalBuscarProveedorPago .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#cuentasPagarModal .modal-header,
#modalBuscarProveedorPago .modal-header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding: 13px 15px;
}
#cuentasPagarModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#cuentasPagarModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#modalBuscarProveedorPago .modal-header {
  background-color: var(--info-color);
}

#cuentasPagarModal .modal-title,
#modalBuscarProveedorPago .modal-title {
  color: white;
  font-weight: 600;
  display: flex;
  align-items: center;
}

#cuentasPagarModal .modal-body,
#modalBuscarProveedorPago .modal-body {
  padding: 25px;
}

#cuentasPagarModal .modal-footer,
#modalBuscarProveedorPago .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#cuentasPagarModal .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}

#cuentasPagarModal .section-divider span {
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

#cuentasPagarModal .section-divider:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: var(--light-gray);
  z-index: 0;
}

/* Estilos para los formularios */
#cuentasPagarModal .form-floating > .form-control,
#cuentasPagarModal .form-floating > .form-select,
#modalBuscarProveedorPago .form-floating > .form-control {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#cuentasPagarModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#cuentasPagarModal .form-floating > .form-control:focus,
#cuentasPagarModal .form-floating > .form-select:focus,
#modalBuscarProveedorPago .form-floating > .form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#cuentasPagarModal .form-floating > label,
#modalBuscarProveedorPago .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#cuentasPagarModal .form-floating > .form-control:focus ~ label,
#cuentasPagarModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#cuentasPagarModal .form-floating > .form-select ~ label,
#modalBuscarProveedorPago .form-floating > .form-control:focus ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#cuentasPagarModal .text-danger,
#modalBuscarProveedorPago .text-danger {
  color: var(--danger-color) !important;
}

/* Estilos para las tablas de búsqueda */
#modalBuscarProveedorPago .table {
  --bs-table-bg: transparent;
  --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
  --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
  margin-bottom: 0;
}

#modalBuscarProveedorPago .table thead th {
  background-color: var(--light-gray);
  color: var(--dark-color);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

#modalBuscarProveedorPago .table-hover tbody tr:hover {
  background-color: var(--light-gray);
}

/* Variables CSS */
:root {
  --primary-color: #5d87ff;
  --primary-light: rgba(93, 135, 255, 0.1);
  --primary-dark: #4569cb;
  --info-color: #539BFF;
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

/* Personalizaciones para bootstrap */
.row {
  --bs-gutter-x: 1.5rem;
}

.g-3 {
  --bs-gutter-y: 1rem;
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

/* Estilos para los botones */
.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-primary:hover {
  background-color: var(--primary-dark);
  border-color: var(--primary-dark);
}

.btn-outline-secondary {
  border-color: var(--light-gray);
  color: var(--gray-color);
}

.btn-outline-secondary:hover {
  background-color: var(--light-gray);
  color: var(--dark-color);
}

.btn-info {
  background-color: var(--info-color);
  border-color: var(--info-color);
}

/* Estilos para elementos readonly */
input[readonly], select[readonly] {
  background-color: var(--light-gray);
  border-color: var(--light-gray);
  cursor: not-allowed;
}

/* Estilos para el input group */
.input-group-text {
  background-color: var(--light-gray);
  color: var(--gray-color);
  border-color: var(--light-gray);
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elementos del formulario
        const montoTotalInput = document.getElementById('montoTotalPago');
        const montoPagadoInput = document.getElementById('montoPagadoPago');
        const montoFinalInput = document.getElementById('montoFinalPago');
        const estadoSelect = document.getElementById('estadoPago');
        const btnGuardar = document.getElementById('btnGuardarCuentaPagar');
        const formCuentasPagar = document.getElementById('formCuentasPagar');

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
         $(document).ready(function() {
    // Validación para fechas de seguro
    $('#fechaEmisionPago').change(function() {
        const fechaInicio = new Date($(this).val());
        const fechaVencimientoInput = $('#fechaVencimientoPago');
        
        if ($(this).val()) {
            // Establecer la fecha mínima para el vencimiento
            fechaVencimientoInput.attr('min', $(this).val());
            
            // Si la fecha de vencimiento ya tiene un valor y es anterior, corregirla
            if (fechaVencimientoInput.val()) {
                const fechaVencimiento = new Date(fechaVencimientoInput.val());
                if (fechaVencimiento < fechaInicio) {
                    fechaVencimientoInput.val($(this).val());
                    mostrarFeedbackError(fechaVencimientoInput);
                }
            }
        }
    });
    
    // Validación en tiempo real
    $('#fechaVencimientoPago').on('input change', function() {
        const fechaInicio = $('#fechaEmisionPago').val();
        const fechaVencimiento = $(this).val();
        
        if (fechaInicio && fechaVencimiento) {
            const dateInicio = new Date(fechaInicio);
            const dateVencimiento = new Date(fechaVencimiento);
            
            if (dateVencimiento < dateInicio) {
                $(this).val(fechaInicio);
                mostrarFeedbackError($(this));
            }
        }
    });
    
    // Función para mostrar feedback visual
    function mostrarFeedbackError(elemento) {
        // Efecto visual de error
        elemento.addClass('is-invalid');
        setTimeout(() => elemento.removeClass('is-invalid'), 1000);
        
        // Efecto de animación
        elemento.css('transform', 'translateX(5px)');
        setTimeout(() => {
            elemento.css('transform', 'translateX(-5px)');
            setTimeout(() => elemento.css('transform', ''), 100);
        }, 100);
    }
});
  $('#montoTotalPago').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
    $('#montoPagadoPago').off('input change').on('input change', function() {
             const value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
        $(this).val('0.00');
         }
         });
</script>
<script>
$(document).ready(function() {
    // Abrir modal para buscar proveedor
    $('#btnBuscarProveedorPago').click(function() {
        $('#modalBuscarProveedorPago').modal('show');
        cargarProveedores();
    });

    // Buscar proveedores
    $('#buscarProveedorPagoInput').keyup(function() {
        cargarProveedores($(this).val());
    });

    // Calcular monto final al cambiar monto pagado
    $('#montoPagadoPago').on('input', function() {
        const montoTotal = parseFloat($('#montoTotalPago').val()) || 0;
        const montoPagado = parseFloat($(this).val()) || 0;
        const montoFinal = montoTotal - montoPagado;
        
        $('#montoFinalPago').val(montoFinal.toFixed(2));
        
        // Actualizar estado según montos
        if (montoPagado === 0) {
            $('#estadoPago').val('Pendiente');
        } else if (montoPagado >= montoTotal) {
            $('#estadoPago').val('Pagado');
        } else {
            $('#estadoPago').val('Parcial');
        }
    });

    // Guardar cuenta por pagar
    $('#btnGuardarCuentaPagar').click(function() {
        const formData = $('#formCuentasPagar').serialize();
        
        $.ajax({
            url: '../pagar/guardar.php',
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
                        $('#cuentasPagarModal').modal('hide');
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
                    text: 'Ocurrió un error al guardar: ' + error
                });
            }
        });
    });
});

function cargarProveedores(search = '') {
    $.ajax({
        url: '../pagar/obtenerproveedor.php',
        type: 'GET',
        data: { search: search },
        success: function(response) {
            $('#tablaProveedoresPago tbody').empty();
            response.forEach(function(proveedor) {
                $('#tablaProveedoresPago tbody').append(`
                    <tr>
                        <td>${proveedor.numero_ruc}</td>
                        <td>${proveedor.nombre_empresa}</td>
                        <td>${proveedor.contacto_nombre}</td>
                        <td>${proveedor.contacto_telefono}</td>
                        <td>${proveedor.contacto_correo}</td>
                        <td>${proveedor.estado}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btnSeleccionarProveedor" 
                                    data-id="${proveedor.idProveedor}" 
                                    data-nombre="${proveedor.nombre_empresa}">
                                Seleccionar
                            </button>
                        </td>
                    </tr>
                `);
            });
            
            // Configurar evento para botones de selección
            $('.btnSeleccionarProveedor').click(function() {
                const idProveedor = $(this).data('id');
                const nombreProveedor = $(this).data('nombre');
                
                $('#idProveedorPago').val(idProveedor);
                $('#proveedorPago').val(nombreProveedor);
                $('#modalBuscarProveedorPago').modal('hide');
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
</script>