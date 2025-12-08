<!-- Modal Editar Cuenta por Cobrar - Diseño Moderno -->
<div class="modal fade" id="editarCuentaModal" tabindex="-1" aria-labelledby="editarCuentaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="editarCuentaModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Cuenta por Cobrar
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCuenta">
                    <input type="hidden" id="editarIdCuenta" name="id">
                    <input type="hidden" id="editarTipoCuenta" name="tipo">
                    
                    <!-- Campos para Cliente Natural -->
                    <div id="editarCamposNatural" style="display: none;" class="animate__animated animate__fadeInUp">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="editarClienteCobro" placeholder="Cliente" readonly>
                                        <button class="btn btn-primary" type="button" id="btnEditarBuscarCliente">
                                            <i class="fas fa-search me-2"></i>Buscar
                                        </button>
                                    </div>
                                    <label for="editarClienteCobro">Cliente <span class="text-danger">*</span></label>
                                </div>
                                <input type="hidden" id="editarIdCliente" name="idCliente">
                            </div>
                        </div>
                    </div>

                    <!-- Campos para Cliente Empresa -->
                    <div id="editarCamposEmpresa" style="display: none;" class="animate__animated animate__fadeInUp">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="editarEmpresaCobro" placeholder="Empresa" readonly>
                                        <button class="btn btn-primary" type="button" id="btnEditarBuscarEmpresa">
                                            <i class="fas fa-search me-2"></i>Buscar
                                        </button>
                                    </div>
                                    <label for="editarEmpresaCobro">Empresa <span class="text-danger">*</span></label>
                                </div>
                                <input type="hidden" id="editarIdEmpresa" name="idEmpresa">
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mt-4 mb-4">
                        <span>Detalles de la Cuenta</span>
                    </div>

                    <!-- Campos comunes -->
                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="editarDescripcion" name="descripcion" placeholder="Descripción" style="height: 100px" required></textarea>
                                <label for="editarDescripcion">Descripción <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="editarMontoTotal" name="monto_total" placeholder="Monto Total" step="0.01" min="0" required>
                                <label for="editarMontoTotal">Monto Total <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="editarFechaEmision" name="fecha_emision" placeholder="Fecha Emisión" required>
                                <label for="editarFechaEmision">Fecha Emisión <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="editarFechaVencimiento" name="fecha_vencimiento" placeholder="Fecha Vencimiento" required>
                                <label for="editarFechaVencimiento">Fecha Vencimiento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="editarEstado" name="estado" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Parcial">Parcial</option>
                                </select>
                                <label for="editarEstado">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="editarMontoPagado" name="monto_pagado" placeholder="Monto Pagado" step="0.01" min="0">
                                <label for="editarMontoPagado">Monto Pagado</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="editarMontoFinal" name="monto_final" placeholder="Monto Final" step="0.01" min="0" readonly>
                                <label for="editarMontoFinal">Monto Final</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarCuenta">
                    <i class="fas fa-save me-2"></i>Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Cliente Natural - Diseño Moderno -->
<div class="modal fade" id="modalEditarBuscarCliente" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
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
                        <input type="text" class="form-control" id="editarBuscarClienteInput" placeholder="Buscar por nombre, apellido o documento...">
                        <button class="btn btn-primary" type="button" id="btnBuscarClienteEditar">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="editarTablaClientes">
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
<div class="modal fade" id="modalEditarBuscarEmpresa" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
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
                        <input type="text" class="form-control" id="editarBuscarEmpresaInput" placeholder="Buscar por razón social o RUC...">
                        <button class="btn btn-primary" type="button" id="btnBuscarEmpresaEditar">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="editarTablaEmpresas">
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
/* Estilos para los modales de edición de cuentas por cobrar */
#editarCuentaModal .modal-content,
#modalEditarBuscarCliente .modal-content,
#modalEditarBuscarEmpresa .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#editarCuentaModal .modal-header,
#modalEditarBuscarCliente .modal-header,
#modalEditarBuscarEmpresa .modal-header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding: 13px 15px;
}
#editarCuentaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarCuentaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#modalEditarBuscarCliente .modal-header,
#modalEditarBuscarEmpresa .modal-header {
  background-color: var(--info-color);
}

#editarCuentaModal .modal-title,
#modalEditarBuscarCliente .modal-title,
#modalEditarBuscarEmpresa .modal-title {
  color: white;
  font-weight: 600;
  display: flex;
  align-items: center;
}

#editarCuentaModal .modal-body,
#modalEditarBuscarCliente .modal-body,
#modalEditarBuscarEmpresa .modal-body {
  padding: 25px;
}

#editarCuentaModal .modal-footer,
#modalEditarBuscarCliente .modal-footer,
#modalEditarBuscarEmpresa .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#editarCuentaModal .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}

#editarCuentaModal .section-divider span {
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

#editarCuentaModal .section-divider:before {
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
#editarCuentaModal .form-floating > .form-control,
#editarCuentaModal .form-floating > .form-select,
#modalEditarBuscarCliente .form-floating > .form-control,
#modalEditarBuscarEmpresa .form-floating > .form-control {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#editarCuentaModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#editarCuentaModal .form-floating > .form-control:focus,
#editarCuentaModal .form-floating > .form-select:focus,
#modalEditarBuscarCliente .form-floating > .form-control:focus,
#modalEditarBuscarEmpresa .form-floating > .form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarCuentaModal .form-floating > label,
#modalEditarBuscarCliente .form-floating > label,
#modalEditarBuscarEmpresa .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#editarCuentaModal .form-floating > .form-control:focus ~ label,
#editarCuentaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarCuentaModal .form-floating > .form-select ~ label,
#modalEditarBuscarCliente .form-floating > .form-control:focus ~ label,
#modalEditarBuscarEmpresa .form-floating > .form-control:focus ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarCuentaModal .text-danger,
#modalEditarBuscarCliente .text-danger,
#modalEditarBuscarEmpresa .text-danger {
  color: var(--danger-color) !important;
}

/* Estilos para las tablas de búsqueda */
#modalEditarBuscarCliente .table,
#modalEditarBuscarEmpresa .table {
  --bs-table-bg: transparent;
  --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
  --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
  margin-bottom: 0;
}

#modalEditarBuscarCliente .table thead th,
#modalEditarBuscarEmpresa .table thead th {
  background-color: var(--light-gray);
  color: var(--dark-color);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

#modalEditarBuscarCliente .table-hover tbody tr:hover,
#modalEditarBuscarEmpresa .table-hover tbody tr:hover {
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
    // Elementos del formulario de edición
    const montoTotalInput = document.getElementById('editarMontoTotal');
    const montoPagadoInput = document.getElementById('editarMontoPagado');
    const montoFinalInput = document.getElementById('editarMontoFinal');
    const estadoSelect = document.getElementById('editarEstado');
    const btnActualizar = document.getElementById('btnActualizarCuenta');
    const formEditarCuenta = document.getElementById('formEditarCuenta');
    const tipoCuentaInput = document.getElementById('editarTipoCuenta');

    // Función para validar montos y habilitar/deshabilitar botón
    function validarMontosEdicion() {
        const montoTotal = parseFloat(montoTotalInput.value) || 0;
        const montoPagado = parseFloat(montoPagadoInput.value) || 0;
        
        if (montoPagado > montoTotal) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El monto pagado no puede exceder el monto total',
                confirmButtonText: 'Entendido'
            });
            btnActualizar.disabled = true;
            return false;
        }
        
        btnActualizar.disabled = false;
        return true;
    }

    // Función para calcular el monto final y actualizar estado
    function calcularMontoFinalEdicion() {
        if (!validarMontosEdicion()) return;
        
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
    montoTotalInput.addEventListener('input', calcularMontoFinalEdicion);
    montoPagadoInput.addEventListener('input', calcularMontoFinalEdicion);
    montoTotalInput.addEventListener('change', calcularMontoFinalEdicion);
    montoPagadoInput.addEventListener('change', calcularMontoFinalEdicion);

    // Validar al enviar el formulario
    formEditarCuenta.addEventListener('submit', function(e) {
        if (!validarMontosEdicion()) {
            e.preventDefault();
        }
    });

    // Mostrar campos según tipo de cliente al cargar el modal
    document.getElementById('editarCuentaModal').addEventListener('show.bs.modal', function() {
        const tipoCuenta = tipoCuentaInput.value;
        const camposNatural = document.getElementById('editarCamposNatural');
        const camposEmpresa = document.getElementById('editarCamposEmpresa');
        
        if (tipoCuenta === 'natural') {
            camposNatural.style.display = 'block';
            camposEmpresa.style.display = 'none';
        } else if (tipoCuenta === 'empresa') {
            camposNatural.style.display = 'none';
            camposEmpresa.style.display = 'block';
        }
        
        // Calcular valores iniciales
        calcularMontoFinalEdicion();
    });

    // Inicializar el cálculo al cargar si el modal está visible
    if (document.getElementById('editarCuentaModal').classList.contains('show')) {
        calcularMontoFinalEdicion();
    }
});
</script>
<script>
      $('#editarMontoTotal').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
    $('#editarMontoPagado').off('input change').on('input change', function() {
             const value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
        $(this).val('0.00');
         }
         });
</script>
<script>
$(document).ready(function() {
    // Manejar clic en botón editar
    $(document).on('click', '.editar-cuenta', function() {
        const id = $(this).data('id');
        const tipo = $(this).data('tipo');
        
        // Limpiar formulario
        $('#formEditarCuenta')[0].reset();
        
        // Configurar tipo de cuenta
        $('#editarTipoCuenta').val(tipo);
        $('#editarIdCuenta').val(id);
        
        // Mostrar campos según tipo
        if (tipo === 'Natural') {
            $('#editarCamposNatural').show();
            $('#editarCamposEmpresa').hide();
        } else {
            $('#editarCamposNatural').hide();
            $('#editarCamposEmpresa').show();
        }
        
        // Cargar datos de la cuenta
        cargarDatosCuenta(id, tipo);
        
        // Mostrar modal
        $('#editarCuentaModal').modal('show');
    });

    function cargarDatosCuenta(id, tipo) {
    $.ajax({
        url: '../cuentas/obtener.php',
        type: 'GET',
        data: { id: id, tipo: tipo },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const cuenta = response.data;

                // Procesar fechas
                const fechaEmisionBD = cuenta.fecha_emision?.split(' ')[0] || '';
                const fechaVencimiento = cuenta.fecha_vencimiento?.split(' ')[0] || '';

                // Establecer fecha emisión
                $('#editarFechaEmision').val(fechaEmisionBD);
                $('#editarFechaEmision').attr('min', fechaEmisionBD); // Bloquear fechas anteriores a la BD

                // Establecer fecha vencimiento y bloquear con base en fecha emisión (la editable)
                $('#editarFechaVencimiento').val(fechaVencimiento);
                $('#editarFechaVencimiento').attr('min', fechaEmisionBD); // Al inicio lo igualamos a la fecha de emisión

                // Validar cambios en fecha emisión
                $('#editarFechaEmision').off('change').on('change', function () {
                    const nuevaFechaEmision = this.value;
                    if (nuevaFechaEmision < fechaEmisionBD) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha no permitida',
                            text: 'No puedes seleccionar una fecha de emisión anterior a la registrada (' + fechaEmisionBD + ')',
                            confirmButtonText: 'Entendido'
                        });
                        this.value = fechaEmisionBD;
                    } else {
                        // Si la nueva fecha es válida, actualizar mínimo en fecha de vencimiento
                        $('#editarFechaVencimiento').attr('min', nuevaFechaEmision);
                    }
                });

                // Validar cambios en fecha vencimiento
                $('#editarFechaVencimiento').off('change').on('change', function () {
                    const fechaEmisionActual = $('#editarFechaEmision').val();
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

                // Rellenar demás campos
                $('#editarDescripcion').val(cuenta.descripcion);
                $('#editarMontoTotal').val(cuenta.monto_total);
                $('#editarMontoPagado').val(cuenta.monto_pagado);
                $('#editarMontoFinal').val(cuenta.monto_final);
                $('#editarEstado').val(cuenta.estado);

                // Datos según tipo
                if (tipo === 'Natural') {
                    $('#editarIdCliente').val(cuenta.idCliente);
                    $('#editarClienteCobro').val(cuenta.nombre);
                } else {
                    $('#editarIdEmpresa').val(cuenta.idEmpresa);
                    $('#editarEmpresaCobro').val(cuenta.nombre);
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar datos: ' + error
            });
        }
    });
}

    // Abrir modal para buscar cliente
    $('#btnEditarBuscarCliente').click(function() {
        $('#modalEditarBuscarCliente').modal('show');
        cargarClientesParaEditar();
    });

    // Abrir modal para buscar empresa
    $('#btnEditarBuscarEmpresa').click(function() {
        $('#modalEditarBuscarEmpresa').modal('show');
        cargarEmpresasParaEditar();
    });

    // Buscar clientes en modal de edición
    $('#editarBuscarClienteInput').keyup(function() {
        cargarClientesParaEditar($(this).val());
    });

    // Buscar empresas en modal de edición
    $('#editarBuscarEmpresaInput').keyup(function() {
        cargarEmpresasParaEditar($(this).val());
    });

    // Cargar clientes para edición
    function cargarClientesParaEditar(search = '') {
        $.ajax({
            url: '../cuentas/buscarclientes.php',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                $('#editarTablaClientes tbody').empty();
                response.forEach(function(cliente) {
                    const nombreCompleto = cliente.nombre + ' ' + cliente.apellidopat + ' ' + cliente.apellidoMat;
                    $('#editarTablaClientes tbody').append(`
                        <tr>
                            <td>${cliente.numerodocumento}</td>
                            <td>${nombreCompleto}</td>
                            <td>${cliente.telefono}</td>
                            <td>${cliente.correo}</td>
                            <td>${cliente.status}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarClienteEditar" 
                                        data-id="${cliente.idCliente}" 
                                        data-nombre="${nombreCompleto}">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Configurar evento para botones de selección
                $('.btnSeleccionarClienteEditar').click(function() {
                    const idCliente = $(this).data('id');
                    const nombreCliente = $(this).data('nombre');
                    
                    $('#editarIdCliente').val(idCliente);
                    $('#editarClienteCobro').val(nombreCliente);
                    $('#modalEditarBuscarCliente').modal('hide');
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

    // Cargar empresas para edición
    function cargarEmpresasParaEditar(search = '') {
        $.ajax({
            url: '../cuentas/buscarempresa.php',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                $('#editarTablaEmpresas tbody').empty();
                response.forEach(function(empresa) {
                    $('#editarTablaEmpresas tbody').append(`
                        <tr>
                            <td>${empresa.ruc}</td>
                            <td>${empresa.razonSocial}</td>
                            <td>${empresa.telefono}</td>
                            <td>${empresa.correo}</td>
                            <td>${empresa.status}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarEmpresaEditar" 
                                        data-id="${empresa.idEmpresa}" 
                                        data-nombre="${empresa.razonSocial}">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Configurar evento para botones de selección
                $('.btnSeleccionarEmpresaEditar').click(function() {
                    const idEmpresa = $(this).data('id');
                    const nombreEmpresa = $(this).data('nombre');
                    
                    $('#editarIdEmpresa').val(idEmpresa);
                    $('#editarEmpresaCobro').val(nombreEmpresa);
                    $('#modalEditarBuscarEmpresa').modal('hide');
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

    // Calcular monto final al editar
    $('#editarMontoPagado').on('input', function() {
        const montoTotal = parseFloat($('#editarMontoTotal').val()) || 0;
        const montoPagado = parseFloat($(this).val()) || 0;
        const montoFinal = montoTotal - montoPagado;
        
        $('#editarMontoFinal').val(montoFinal.toFixed(2));
        
        // Actualizar estado según montos
        if (montoPagado === 0) {
            $('#editarEstado').val('Pendiente');
        } else if (montoPagado >= montoTotal) {
            $('#editarEstado').val('Pagado');
        } else {
            $('#editarEstado').val('Parcial');
        }
    });

    // Actualizar cuenta
    $('#btnActualizarCuenta').click(function() {
        const formData = $('#formEditarCuenta').serialize();
        const tipo = $('#editarTipoCuenta').val();
        
        $.ajax({
            url: '../cuentas/actualizar.php',
            type: 'POST',
            data: formData + '&tipo=' + tipo,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editarCuentaModal').modal('hide');
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