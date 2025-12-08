
<!-- Modal Principal de Cuentas por Cobrar -->
<!-- Modal Cuentas por Cobrar - Diseño Moderno -->
<div class="modal fade" id="cuentasCobrarModal" tabindex="-1" aria-labelledby="cuentasCobrarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="cuentasCobrarModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-money-bill-wave me-2"></i>Registrar Cuenta por Cobrar
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCuentasCobrar">
                    <div class="section-divider mb-4">
                        <span>Tipo de Cliente</span>
                    </div>

                    <div class="row mb-4 animate__animated animate__fadeInUp">
                        <div class="col-md-12">
                            <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input class="form-check-input" type="radio" name="tipoClienteCobro" id="cobroNatural" value="natural" checked autocomplete="off">
                                    <i class="fas fa-user me-2"></i>Cliente Natural
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input class="form-check-input" type="radio" name="tipoClienteCobro" id="cobroEmpresa" value="empresa" autocomplete="off">
                                    <i class="fas fa-building me-2"></i>Cliente Empresa
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Campos para Cliente Natural -->
                    <div id="camposCobroNatural" class="animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="clienteCobro" placeholder="Cliente" readonly>
                                        <button class="btn btn-primary" type="button" id="btnBuscarClienteCobro">
                                            <i class="fas fa-search me-2"></i>Buscar
                                        </button>
                                    </div>
                                    <label for="clienteCobro">Cliente <span class="text-danger">*</span></label>
                                </div>
                                <input type="hidden" id="idClienteCobro" name="idCliente">
                            </div>
                        </div>
                    </div>

                    <!-- Campos para Cliente Empresa -->
                    <div id="camposCobroEmpresa" style="display: none;" class="animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="empresaCobro" placeholder="Empresa" readonly>
                                        <button class="btn btn-primary" type="button" id="btnBuscarEmpresaCobro">
                                            <i class="fas fa-search me-2"></i>Buscar
                                        </button>
                                    </div>
                                    <label for="empresaCobro">Empresa <span class="text-danger">*</span></label>
                                </div>
                                <input type="hidden" id="idEmpresaCobro" name="idEmpresa">
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mt-4 mb-4">
                        <span>Detalles de la Cuenta</span>
                    </div>

                    <!-- Campos comunes -->
                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcionCobro" name="descripcion" placeholder="Descripción" style="height: 100px" required></textarea>
                                <label for="descripcionCobro">Descripción <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="montoTotal" name="monto_total" placeholder="Monto Total" step="0.01" min="0" required>
                                <label for="montoTotal">Monto Total <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaEmision" name="fecha_emision" placeholder="Fecha Emisión" required>
                                <label for="fechaEmision">Fecha Emisión <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaVencimiento" name="fecha_vencimiento" placeholder="Fecha Vencimiento" required>
                                <label for="fechaVencimiento">Fecha Vencimiento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="estadoCobro" name="estado" required>
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Parcial">Parcial</option>
                                </select>
                                <label for="estadoCobro">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="montoPagado" name="monto_pagado" placeholder="Monto Pagado" step="0.01" min="0" value="0">
                                <label for="montoPagado">Monto Pagado</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="montoFinal" name="monto_final" placeholder="Monto Final" step="0.01" min="0" readonly>
                                <label for="montoFinal">Monto Final</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarCuentaCobrar">
                    <i class="fas fa-save me-2"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Cliente Natural - Diseño Moderno -->
<div class="modal fade" id="modalBuscarClienteCobro" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>Buscar Cliente Natural
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="buscarClienteCobroInput" placeholder="Buscar por nombre, apellido o documento...">
                        <button class="btn btn-primary" type="button" id="btnBuscarClienteCobro">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaClientesCobro">
                        <thead class="table-light">
                            <tr>
                                <th>Documento</th>
                                <th>Nombre Completo</th>
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

<!-- Modal para Buscar Empresa - Diseño Moderno -->
<div class="modal fade" id="modalBuscarEmpresaCobro" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-building me-2"></i>Buscar Empresa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="buscarEmpresaCobroInput" placeholder="Buscar por razón social o RUC...">
                        <button class="btn btn-primary" type="button" id="btnBuscarEmpresaCobro">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaEmpresasCobro">
                        <thead class="table-light">
                            <tr>
                                <th>RUC</th>
                                <th>Razón Social</th>
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
/* Estilos para los modales de cuentas por cobrar */
#cuentasCobrarModal .modal-content,
#modalBuscarClienteCobro .modal-content,
#modalBuscarEmpresaCobro .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#cuentasCobrarModal .modal-header,
#modalBuscarClienteCobro .modal-header,
#modalBuscarEmpresaCobro .modal-header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding: 13px 15px;
}

#cuentasCobrarModal .modal-title,
#modalBuscarClienteCobro .modal-title,
#modalBuscarEmpresaCobro .modal-title {
  color: white;
  font-weight: 600;
  display: flex;
  align-items: center;
}

#cuentasCobrarModal .modal-body,
#modalBuscarClienteCobro .modal-body,
#modalBuscarEmpresaCobro .modal-body {
  padding: 25px;
}

#cuentasCobrarModal .modal-footer,
#modalBuscarClienteCobro .modal-footer,
#modalBuscarEmpresaCobro .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#cuentasCobrarModal .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}
#cuentasCobrarModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#cuentasCobrarModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#cuentasCobrarModal .section-divider span {
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

#cuentasCobrarModal .section-divider:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: var(--light-gray);
  z-index: 0;
}

/* Estilos para los botones de radio como pestañas */
.btn-group-toggle .btn {
  padding: 12px;
  font-weight: 500;
}

.btn-group-toggle .btn.active {
  background-color: var(--primary-color);
  color: white;
}

/* Estilos para los formularios */
#cuentasCobrarModal .form-floating > .form-control,
#cuentasCobrarModal .form-floating > .form-select,
#modalBuscarClienteCobro .form-floating > .form-control,
#modalBuscarEmpresaCobro .form-floating > .form-control {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#cuentasCobrarModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#cuentasCobrarModal .form-floating > .form-control:focus,
#cuentasCobrarModal .form-floating > .form-select:focus,
#modalBuscarClienteCobro .form-floating > .form-control:focus,
#modalBuscarEmpresaCobro .form-floating > .form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#cuentasCobrarModal .form-floating > label,
#modalBuscarClienteCobro .form-floating > label,
#modalBuscarEmpresaCobro .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#cuentasCobrarModal .form-floating > .form-control:focus ~ label,
#cuentasCobrarModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#cuentasCobrarModal .form-floating > .form-select ~ label,
#modalBuscarClienteCobro .form-floating > .form-control:focus ~ label,
#modalBuscarEmpresaCobro .form-floating > .form-control:focus ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#cuentasCobrarModal .text-danger,
#modalBuscarClienteCobro .text-danger,
#modalBuscarEmpresaCobro .text-danger {
  color: var(--danger-color) !important;
}

/* Estilos para las tablas de búsqueda */
#modalBuscarClienteCobro .table,
#modalBuscarEmpresaCobro .table {
  --bs-table-bg: transparent;
  --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
  --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
  margin-bottom: 0;
}

#modalBuscarClienteCobro .table thead th,
#modalBuscarEmpresaCobro .table thead th {
  background-color: var(--light-gray);
  color: var(--dark-color);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

#modalBuscarClienteCobro .table-hover tbody tr:hover,
#modalBuscarEmpresaCobro .table-hover tbody tr:hover {
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
        // Elementos del formulario de cobro
        const montoTotalInput = document.getElementById('montoTotal');
        const montoPagadoInput = document.getElementById('montoPagado');
        const montoFinalInput = document.getElementById('montoFinal');
        const estadoSelect = document.getElementById('estadoCobro');
        const btnGuardarCobro = document.getElementById('btnGuardarCuentaCobrar');
        const formCuentasCobrar = document.getElementById('formCuentasCobrar');

        // Función para validar montos y habilitar/deshabilitar botón
        function validarMontosCobro() {
            const montoTotal = parseFloat(montoTotalInput.value) || 0;
            const montoPagado = parseFloat(montoPagadoInput.value) || 0;
            
            if (montoPagado > montoTotal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El monto pagado no puede exceder el monto total',
                    confirmButtonText: 'Entendido'
                });
                btnGuardarCobro.disabled = true;
                return false;
            }
            
            btnGuardarCobro.disabled = false;
            return true;
        }

        // Función para calcular el monto final y actualizar estado
        function calcularMontoFinalCobro() {
            if (!validarMontosCobro()) return;
            
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
        montoTotalInput.addEventListener('input', calcularMontoFinalCobro);
        montoPagadoInput.addEventListener('input', calcularMontoFinalCobro);
        montoTotalInput.addEventListener('change', calcularMontoFinalCobro);
        montoPagadoInput.addEventListener('change', calcularMontoFinalCobro);

        // Validar al enviar el formulario
        formCuentasCobrar.addEventListener('submit', function(e) {
            if (!validarMontosCobro()) {
                e.preventDefault();
            }
        });

        // Manejo de cambio entre cliente natural y empresa
        const cobroNatural = document.getElementById('cobroNatural');
        const cobroEmpresa = document.getElementById('cobroEmpresa');
        const camposNatural = document.getElementById('camposCobroNatural');
        const camposEmpresa = document.getElementById('camposCobroEmpresa');

        cobroNatural.addEventListener('change', function() {
            if (this.checked) {
                camposNatural.style.display = 'block';
                camposEmpresa.style.display = 'none';
            }
        });

        cobroEmpresa.addEventListener('change', function() {
            if (this.checked) {
                camposNatural.style.display = 'none';
                camposEmpresa.style.display = 'block';
            }
        });

        // Inicializar el cálculo al cargar
        calcularMontoFinalCobro();
    });
</script>
<script>
        $(document).ready(function() {
    // Validación para fechas de seguro
    $('#fechaEmision').change(function() {
        const fechaInicio = new Date($(this).val());
        const fechaVencimientoInput = $('#fechaVencimiento');
        
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
    $('#fechaVencimiento').on('input change', function() {
        const fechaInicio = $('#fechaEmision').val();
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
  $('#montoTotal').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
    $('#montoPagado').off('input change').on('input change', function() {
             const value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
        $(this).val('0.00');
         }
         });
</script>
<script>
    $(document).ready(function() {
    // Toggle entre cliente natural y empresa
    $('input[name="tipoClienteCobro"]').change(function() {
        if ($(this).val() === 'natural') {
            $('#camposCobroNatural').show();
            $('#camposCobroEmpresa').hide();
        } else {
            $('#camposCobroNatural').hide();
            $('#camposCobroEmpresa').show();
        }
    });

    // Abrir modal para buscar cliente natural
    $('#btnBuscarClienteCobro').click(function() {
        $('#modalBuscarClienteCobro').modal('show');
        cargarClientesNaturales();
    });

    // Abrir modal para buscar empresa
    $('#btnBuscarEmpresaCobro').click(function() {
        $('#modalBuscarEmpresaCobro').modal('show');
        cargarEmpresas();
    });

    // Buscar clientes naturales
    $('#buscarClienteCobroInput').keyup(function() {
        cargarClientesNaturales($(this).val());
    });

    // Buscar empresas
    $('#buscarEmpresaCobroInput').keyup(function() {
        cargarEmpresas($(this).val());
    });

    // Calcular monto final al cambiar monto pagado
    $('#montoPagado').on('input', function() {
        const montoTotal = parseFloat($('#montoTotal').val()) || 0;
        const montoPagado = parseFloat($(this).val()) || 0;
        const montoFinal = montoTotal - montoPagado;
        
        $('#montoFinal').val(montoFinal.toFixed(2));
        
        // Actualizar estado según montos
        if (montoPagado === 0) {
            $('#estadoCobro').val('Pendiente');
        } else if (montoPagado >= montoTotal) {
            $('#estadoCobro').val('Pagado');
        } else {
            $('#estadoCobro').val('Parcial');
        }
    });

    // Guardar cuenta por cobrar
    $('#btnGuardarCuentaCobrar').click(function() {
        const formData = $('#formCuentasCobrar').serialize();
        const tipoCliente = $('input[name="tipoClienteCobro"]:checked').val();
        
        // Agregar tipo de cliente al formData
        const data = formData + '&tipoCliente=' + tipoCliente;
        
        $.ajax({
            url: '../cuentas/guardar.php',
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#cuentasCobrarModal').modal('hide');
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

function cargarClientesNaturales(search = '') {
    $.ajax({
        url: '../cuentas/buscarclientes.php',
        type: 'GET',
        data: { search: search },
        success: function(response) {
            $('#tablaClientesCobro tbody').empty();
            response.forEach(function(cliente) {
                const nombreCompleto = cliente.nombre + ' ' + cliente.apellidopat + ' ' + cliente.apellidoMat;
                $('#tablaClientesCobro tbody').append(`
                    <tr>
                        <td>${cliente.numerodocumento}</td>
                        <td>${nombreCompleto}</td>
                        <td>${cliente.telefono}</td>
                        <td>${cliente.correo}</td>
                        <td>${cliente.status}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btnSeleccionarCliente" 
                                    data-id="${cliente.idCliente}" 
                                    data-nombre="${nombreCompleto}">
                                Seleccionar
                            </button>
                        </td>
                    </tr>
                `);
            });
            
            // Configurar evento para botones de selección
            $('.btnSeleccionarCliente').click(function() {
                const idCliente = $(this).data('id');
                const nombreCliente = $(this).data('nombre');
                
                $('#idClienteCobro').val(idCliente);
                $('#clienteCobro').val(nombreCliente);
                $('#modalBuscarClienteCobro').modal('hide');
            });
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar clientes: ' + error
            });
        }
    });
}

function cargarEmpresas(search = '') {
    $.ajax({
        url: '../cuentas/buscarempresa.php',
        type: 'GET',
        data: { search: search },
        success: function(response) {
            $('#tablaEmpresasCobro tbody').empty();
            response.forEach(function(empresa) {
                $('#tablaEmpresasCobro tbody').append(`
                    <tr>
                        <td>${empresa.ruc}</td>
                        <td>${empresa.razonSocial}</td>
                        <td>${empresa.telefono}</td>
                        <td>${empresa.correo}</td>
                        <td>${empresa.status}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btnSeleccionarEmpresa" 
                                    data-id="${empresa.idEmpresa}" 
                                    data-nombre="${empresa.razonSocial}">
                                Seleccionar
                            </button>
                        </td>
                    </tr>
                `);
            });
            
            // Configurar evento para botones de selección
            $('.btnSeleccionarEmpresa').click(function() {
                const idEmpresa = $(this).data('id');
                const nombreEmpresa = $(this).data('nombre');
                
                $('#idEmpresaCobro').val(idEmpresa);
                $('#empresaCobro').val(nombreEmpresa);
                $('#modalBuscarEmpresaCobro').modal('hide');
            });
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar empresas: ' + error
            });
        }
    });
}
</script>