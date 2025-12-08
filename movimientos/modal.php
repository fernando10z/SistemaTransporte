<style>
/* Estilos para el modal de productos */
:root {
    --primary-color: #5d87ff;
    --primary-light: rgba(93, 135, 255, 0.1);
    --primary-dark: #4569cb;
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

/* Estilos para el modal */
.modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

.modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

.modal-body {
    padding: 25px;
    max-height: 75vh;
    overflow-y: auto;
}

.modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para el contenido del formulario */
.form-content {
    margin-top: 20px;
}

.section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

.section-divider span {
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

.section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

/* Estilos para los campos flotantes */
.form-floating > .form-control,
.form-floating > .form-select,
.form-floating > .form-control-plaintext {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus,
.form-floating > .form-control-plaintext:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label,
.form-floating > .form-control-plaintext ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

.form-floating > .form-control-plaintext ~ label::after {
    background-color: transparent;
}

/* Textarea específico */
textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

/* Estilos para botones */
.btn {
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 6px;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white;
}

.btn-outline-secondary {
    color: var(--gray-color);
    border-color: var(--light-gray);
}

.btn-outline-secondary:hover {
    background-color: var(--light-gray);
    color: var(--dark-color);
    border-color: var(--light-gray);
}

.btn-sm {
    padding: 5px 10px;
    font-size: 0.875rem;
}

.btn-close {
    opacity: 0.5;
    transition: var(--transition);
}

.btn-close:hover {
    opacity: 1;
}

/* Tablas en modales de búsqueda */
.table {
    color: var(--text-color);
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    background-color: var(--light-gray);
    border-bottom: 2px solid var(--light-gray);
}

.table-hover tbody tr:hover {
    background-color: var(--light-color);
}

/* Input group para búsqueda */
.input-group {
    border-radius: var(--border-radius);
    overflow: hidden;
}

.input-group .form-control {
    border-right: none;
}

.input-group .btn {
    border-left: none;
    background-color: white;
}

/* Personalizaciones para bootstrap */
.row {
    --bs-gutter-x: 1.5rem;
}

.g-3 {
    --bs-gutter-y: 1rem;
}

.mt-1 {
    margin-top: 0.5rem !important;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-4 {
    margin-top: 2rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.me-1 {
    margin-right: 0.25rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

/* Responsividad */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 0.5rem auto;
    }
    
    .modal-body {
        padding: 15px;
    }
    
    .section-divider span {
        font-size: 12px;
    }
}
#modalMovimientoProducto .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalMovimientoProducto .modal-title::after {
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

<!-- Modal para Movimiento de Productos -->
<div class="modal fade" id="modalMovimientoProducto" tabindex="-1" role="dialog" aria-labelledby="modalMovimientoProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="modalMovimientoProductoLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-exchange-alt me-2"></i>Registro de Movimiento de Producto
                </h5>
                <button type="button" class="btn-close btn-close-black" aria-label="Close" onclick="$('#modalMovimientoProducto').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formMovimientoProducto">
                    <input type="hidden" id="idMovimiento" name="idMovimiento">
                    <input type="hidden" id="idProducto" name="idProducto">
                    <input type="hidden" id="stockMinimoProducto" name="stockMinimoProducto">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipoMovimiento" name="tipoMovimiento" required>
                                    <option value="">Seleccionar</option>
                                    <option value="entrada">Entrada</option>
                                    <option value="salida">Salida</option>
                                </select>
                                <label for="tipoMovimiento">Tipo de Movimiento</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="motivoMovimiento" name="motivoMovimiento" required disabled>
                                    <option value="">Seleccionar motivo</option>
                                </select>
                                <label for="motivoMovimiento">Motivo</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Ubicación del Producto</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idAlmacenMov" name="idAlmacenMov" required>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="idAlmacenMov">Almacén</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreCategoriaMov" name="nombreCategoriaMov" placeholder="Categoría" readonly>
                                <input type="hidden" id="idCategoriaMov" name="idCategoriaMov">
                                <label for="nombreCategoriaMov">Categoría</label>
                            </div>
                            <button type="button" class="btn btn-primary mt-2 w-100" id="btnBuscarCategoriaMov" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Categoría
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreSubcategoriaMov" name="nombreSubcategoriaMov" placeholder="Subcategoría" readonly>
                                <input type="hidden" id="idSubcategoriaMov" name="idSubcategoriaMov">
                                <label for="nombreSubcategoriaMov">Subcategoría</label>
                            </div>
                            <button type="button" class="btn btn-primary mt-2 w-100" id="btnBuscarSubcategoriaMov" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Subcategoría
                            </button>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary w-100" id="btnBuscarProductoMov" disabled>
                                <i class="fas fa-boxes me-1"></i> Buscar Producto
                            </button>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información del Producto</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="codigoProductoMov" name="codigoProductoMov" placeholder="Código de Producto" readonly>
                                <label for="codigoProductoMov">Código de Producto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreProductoMov" name="nombreProductoMov" placeholder="Nombre de Producto" readonly>
                                <label for="nombreProductoMov">Nombre de Producto</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stockInicialMov" name="stockInicialMov" placeholder="Stock Inicial" readonly>
                                <label for="stockInicialMov">Stock Inicial</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="cantidadMov" name="cantidadMov" placeholder="Cantidad" min="1" required>
                                <label for="cantidadMov">Cantidad</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stockFinalMov" name="stockFinalMov" placeholder="Stock Final" readonly>
                                <label for="stockFinalMov">Stock Final</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="precioSolesMov" name="precioSolesMov" placeholder="Precio en Soles" step="0.01" min="0" required>
                                <label for="precioSolesMov">Precio en Soles</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="fechaMovimiento" name="fechaMovimiento" required>
                                <label for="fechaMovimiento">Fecha de Movimiento</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="observacionMov" name="observacionMov" placeholder="Observaciones" style="height: 100px"></textarea>
                                <label for="observacionMov">Observaciones</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalMovimientoProducto').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarMovimiento">
                    <i class="fas fa-save me-2"></i>Guardar Movimiento
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para Buscar Categorías (Movimiento) -->
<div class="modal fade" id="modalBuscarCategoriaMov" tabindex="-1" role="dialog" aria-labelledby="modalBuscarCategoriaMovLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarCategoriaMovLabel">
                    <i class="fas fa-list me-2"></i>Seleccionar Categoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarCategoriaMov').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarCategoriaMov" placeholder="Buscar categoría...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarCategoriaMov">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaCategoriasMov">
                        <thead class="table-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las categorías se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarCategoriaMov').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Subcategorías (Movimiento) -->
<div class="modal fade" id="modalBuscarSubcategoriaMov" tabindex="-1" role="dialog" aria-labelledby="modalBuscarSubcategoriaMovLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarSubcategoriaMovLabel">
                    <i class="fas fa-list-ol me-2"></i>Seleccionar Subcategoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarSubcategoriaMov').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarSubcategoriaMov" placeholder="Buscar subcategoría...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarSubcategoriaMov">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaSubcategoriasMov">
                        <thead class="table-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las subcategorías se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarSubcategoriaMov').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Productos (Movimiento) -->
<div class="modal fade" id="modalBuscarProductoMov" tabindex="-1" role="dialog" aria-labelledby="modalBuscarProductoMovLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarProductoMovLabel">
                    <i class="fas fa-boxes me-2"></i>Seleccionar Producto
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarProductoMov').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarProductoMov" placeholder="Buscar producto...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarProductoMov">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaProductosMov">
                        <thead class="table-primary">
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Stock Mínimo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los productos se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarProductoMov').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fechaMovimiento');

    // Obtener fecha y hora actual en formato compatible con datetime-local (YYYY-MM-DDTHH:MM)
    const now = new Date();
    const pad = (n) => n.toString().padStart(2, '0');
    const fechaActual = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`;

    // Establecer valor por defecto y mínimo
    fechaInput.value = fechaActual;
    fechaInput.min = fechaActual;

    // Validar en caso de que el usuario intente cambiarlo manualmente a una fecha pasada
    fechaInput.addEventListener('change', function () {
        if (this.value < this.min) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha no válida',
                text: 'No puedes seleccionar una fecha u hora anterior a la actual.',
                confirmButtonText: 'Entendido'
            });
            this.value = this.min;
        }
    });
});
      $('#cantidadMov').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0');
                    }
                });
                  $('#precioSolesMov').off('input change').on('input change', function() {
                    const value = parseFloat($(this).val());
                    if (isNaN(value) || value < 0) {
                        $(this).val('0.00');
                    }
                });
</script>
<script>
 $(document).ready(function() {
    // Cargar almacenes al abrir el modal
    $('#modalMovimientoProducto').on('show.bs.modal', function() {
        cargarAlmacenesMov();
        // Establecer fecha actual por defecto
        let now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        $('#fechaMovimiento').val(now.toISOString().slice(0, 16));
        
        // Limpiar formulario
        $('#formMovimientoProducto')[0].reset();
        $('#idProducto').val('');
        
        // Deshabilitar campos dependientes
        $('#btnBuscarCategoriaMov, #btnBuscarSubcategoriaMov, #btnBuscarProductoMov').prop('disabled', true);
        $('#nombreCategoriaMov, #nombreSubcategoriaMov').val('');
        $('#idCategoriaMov, #idSubcategoriaMov').val('');
    });

    // Habilitar/deshabilitar campos según selección
    $('#tipoMovimiento').change(function() {
        let tipo = $(this).val();
        $('#motivoMovimiento').prop('disabled', tipo === '');
        
        // Limpiar y cargar opciones de motivo según el tipo
        $('#motivoMovimiento').empty().append('<option value="">Seleccionar motivo</option>');
        
        if (tipo === 'entrada') {
            $('#motivoMovimiento').append('<option value="En tránsito">En tránsito</option>');
        } else if (tipo === 'salida') {
            $('#motivoMovimiento').append('<option value="Traslado">Traslado</option>');
        }
    });

    // Habilitar búsqueda de categoría cuando se selecciona almacén
    $('#idAlmacenMov').change(function() {
        let almacenSeleccionado = $(this).val() !== '';
        $('#btnBuscarCategoriaMov').prop('disabled', !almacenSeleccionado);
        
        // Limpiar campos de categoría y dependientes
        $('#nombreCategoriaMov, #idCategoriaMov').val('');
        $('#nombreSubcategoriaMov, #idSubcategoriaMov').val('');
        $('#btnBuscarSubcategoriaMov, #btnBuscarProductoMov').prop('disabled', true);
        $('#idProducto').val('');
        $('#codigoProductoMov, #nombreProductoMov, #stockInicialMov').val('');
    });

    // Calcular stock final automáticamente y validar stock mínimo
    $('#cantidadMov').on('input', function() {
        calcularStockFinal();
        validarStockMinimo();
    });

    $('#tipoMovimiento').change(function() {
        calcularStockFinal();
        validarStockMinimo();
    });

    function calcularStockFinal() {
        let stockInicial = parseInt($('#stockInicialMov').val()) || 0;
        let cantidad = parseInt($('#cantidadMov').val()) || 0;
        let tipo = $('#tipoMovimiento').val();
        
        if (tipo === 'entrada') {
            $('#stockFinalMov').val(stockInicial + cantidad);
        } else if (tipo === 'salida') {
            $('#stockFinalMov').val(stockInicial - cantidad);
        }
    }

    // Función para validar stock mínimo
 // Función para validar stock mínimo y controlar el botón
function validarStockMinimo() {
    let stockFinal = parseInt($('#stockFinalMov').val()) || 0;
    let stockMinimo = parseInt($('#stockMinimoProducto').val()) || 0;
    let tipo = $('#tipoMovimiento').val();
    const botonGuardar = $('#btnGuardarMovimiento');

    if (tipo === 'salida' && stockFinal < stockMinimo) {
        botonGuardar.prop('disabled', true); // deshabilita el botón
        Swal.fire({
            title: 'Advertencia',
            text: '¡Atención! El stock final será menor que el stock mínimo permitido.',
            icon: 'warning',
            confirmButtonText: 'Entendido'
        });
    } else {
        botonGuardar.prop('disabled', false); // habilita el botón si está correcto
    }
}

// Ejecutar la función cada vez que cambien los valores involucrados
$('#stockFinalMov, #stockMinimoProducto, #tipoMovimiento').on('input change', validarStockMinimo);


    // Abrir modal de búsqueda de categoría
    $('#btnBuscarCategoriaMov').click(function() {
        let idAlmacen = $('#idAlmacenMov').val();
        if (idAlmacen) {
            cargarCategoriasMov(idAlmacen);
            $('#modalBuscarCategoriaMov').modal('show');
        }
    });

    // Abrir modal de búsqueda de subcategoría
    $('#btnBuscarSubcategoriaMov').click(function() {
        let idAlmacen = $('#idAlmacenMov').val();
        let idCategoria = $('#idCategoriaMov').val();
        if (idAlmacen && idCategoria) {
            cargarSubcategoriasMov(idAlmacen, idCategoria);
            $('#modalBuscarSubcategoriaMov').modal('show');
        }
    });

    // Abrir modal de búsqueda de producto
    $('#btnBuscarProductoMov').click(function() {
        let idAlmacen = $('#idAlmacenMov').val();
        let idCategoria = $('#idCategoriaMov').val();
        let idSubcategoria = $('#idSubcategoriaMov').val();
        if (idAlmacen && idCategoria && idSubcategoria) {
            cargarProductosMov(idAlmacen, idCategoria, idSubcategoria);
            $('#modalBuscarProductoMov').modal('show');
        }
    });

    // Filtrar categorías en el modal
    $('#btnFiltrarCategoriaMov').click(function() {
        filtrarTabla('#buscarCategoriaMov', '#tablaCategoriasMov', 0);
    });

    $('#buscarCategoriaMov').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarCategoriaMov', '#tablaCategoriasMov', 0);
        }
    });

    // Filtrar subcategorías en el modal
    $('#btnFiltrarSubcategoriaMov').click(function() {
        filtrarTabla('#buscarSubcategoriaMov', '#tablaSubcategoriasMov', 0);
    });

    $('#buscarSubcategoriaMov').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarSubcategoriaMov', '#tablaSubcategoriasMov', 0);
        }
    });

    // Filtrar productos en el modal
    $('#btnFiltrarProductoMov').click(function() {
        filtrarTabla('#buscarProductoMov', '#tablaProductosMov', 1);
    });

    $('#buscarProductoMov').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarProductoMov', '#tablaProductosMov', 1);
        }
    });

    function filtrarTabla(inputSelector, tablaSelector, columna) {
        let termino = $(inputSelector).val().toLowerCase();
        $(tablaSelector + ' tbody tr').each(function() {
            let texto = $(this).find('td').eq(columna).text().toLowerCase();
            $(this).toggle(texto.includes(termino));
        });
    }

    // Guardar movimiento con validación de stock mínimo
    $('#btnGuardarMovimiento').click(function() {
        if (validarFormularioMovimiento()) {
            let stockFinal = parseInt($('#stockFinalMov').val()) || 0;
            let stockMinimo = parseInt($('#stockMinimoProducto').val()) || 0;
            let tipo = $('#tipoMovimiento').val();
            
            if (tipo === 'salida' && stockFinal < stockMinimo) {
                Swal.fire({
                    title: 'Confirmación',
                    text: 'El stock final será menor que el stock mínimo. ¿Desea continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        guardarMovimiento();
                    }
                });
            } else {
                guardarMovimiento();
            }
        }
    });
});

function cargarAlmacenesMov() {
    $.ajax({
        url: '../movimientos/obteneralmacen.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#idAlmacenMov').empty().append('<option value="">Seleccionar</option>');
            response.forEach(function(almacen) {
                $('#idAlmacenMov').append(`<option value="${almacen.idAlmacen}">${almacen.nombre}</option>`);
            });
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los almacenes', 'error');
        }
    });
}

function cargarCategoriasMov(idAlmacen) {
    $.ajax({
        url: '../movimientos/obtenercategorias.php',
        type: 'GET',
        data: { idAlmacen: idAlmacen },
        dataType: 'json',
        success: function(response) {
            $('#tablaCategoriasMov tbody').empty();
            if (response.length === 0) {
                $('#tablaCategoriasMov tbody').append('<tr><td colspan="2" class="text-center">No se encontraron categorías</td></tr>');
            } else {
                response.forEach(function(categoria) {
                    $('#tablaCategoriasMov tbody').append(`
                        <tr>
                            <td>${categoria.nombreCategoria}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarCategoriaMov" 
                                        data-id="${categoria.idCategoria}" 
                                        data-nombre="${categoria.nombreCategoria}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $(document).off('click', '.btnSeleccionarCategoriaMov').on('click', '.btnSeleccionarCategoriaMov', function() {
                    let id = $(this).data('id');
                    let nombre = $(this).data('nombre');
                    
                    $('#nombreCategoriaMov').val(nombre);
                    $('#idCategoriaMov').val(id);
                    $('#nombreCategoriaMov').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#btnBuscarSubcategoriaMov').prop('disabled', false);
                    $('#nombreSubcategoriaMov, #idSubcategoriaMov').val('');
                    $('#btnBuscarProductoMov').prop('disabled', true);
                    $('#idProducto').val('');
                    $('#codigoProductoMov, #nombreProductoMov, #stockInicialMov').val('');
                    
                    $('#modalBuscarCategoriaMov').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las categorías', 'error');
        }
    });
}

function cargarSubcategoriasMov(idAlmacen, idCategoria) {
    $.ajax({
        url: '../movimientos/obtenersubcategoria.php',
        type: 'GET',
        data: { 
            idAlmacen: idAlmacen,
            idCategoria: idCategoria
        },
        dataType: 'json',
        success: function(response) {
            $('#tablaSubcategoriasMov tbody').empty();
            if (response.length === 0) {
                $('#tablaSubcategoriasMov tbody').append('<tr><td colspan="2" class="text-center">No se encontraron subcategorías</td></tr>');
            } else {
                response.forEach(function(subcategoria) {
                    $('#tablaSubcategoriasMov tbody').append(`
                        <tr>
                            <td>${subcategoria.nomArea}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarSubcategoriaMov" 
                                        data-id="${subcategoria.idsubcategoria}" 
                                        data-nombre="${subcategoria.nomArea}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $(document).off('click', '.btnSeleccionarSubcategoriaMov').on('click', '.btnSeleccionarSubcategoriaMov', function() {
                    let id = $(this).data('id');
                    let nombre = $(this).data('nombre');
                    
                    $('#nombreSubcategoriaMov').val(nombre);
                    $('#idSubcategoriaMov').val(id);
                    $('#nombreSubcategoriaMov').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#btnBuscarProductoMov').prop('disabled', false);
                    $('#idProducto').val('');
                    $('#codigoProductoMov, #nombreProductoMov, #stockInicialMov').val('');
                    
                    $('#modalBuscarSubcategoriaMov').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las subcategorías', 'error');
        }
    });
}

function cargarProductosMov(idAlmacen, idCategoria, idSubcategoria) {
    $.ajax({
        url: '../movimientos/obtenerproductos.php',
        type: 'GET',
        data: { 
            idAlmacen: idAlmacen,
            idCategoria: idCategoria,
            idSubcategoria: idSubcategoria
        },
        dataType: 'json',
        success: function(response) {
            $('#tablaProductosMov tbody').empty();
            if (response.length === 0) {
                $('#tablaProductosMov tbody').append('<tr><td colspan="5" class="text-center">No se encontraron productos</td></tr>');
            } else {
                response.forEach(function(producto) {
                    $('#tablaProductosMov tbody').append(`
                        <tr>
                            <td>${producto.codigoProducto}</td>
                            <td>${producto.nombreProducto}</td>
                            <td>${producto.stock}</td>
                            <td>${producto.stock_minimo}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarProductoMov" 
                                        data-id="${producto.idProducto}" 
                                        data-codigo="${producto.codigoProducto}"
                                        data-nombre="${producto.nombreProducto}"
                                        data-stock="${producto.stock}"
                                        data-stock-minimo="${producto.stock_minimo}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $(document).off('click', '.btnSeleccionarProductoMov').on('click', '.btnSeleccionarProductoMov', function() {
                    let id = $(this).data('id');
                    let codigo = $(this).data('codigo');
                    let nombre = $(this).data('nombre');
                    let stock = $(this).data('stock');
                    let stockMinimo = $(this).data('stock-minimo');
                    
                    $('#idProducto').val(id);
                    $('#codigoProductoMov').val(codigo);
                    $('#nombreProductoMov').val(nombre);
                    $('#stockInicialMov').val(stock);
                    $('#stockMinimoProducto').val(stockMinimo); // Campo oculto para stock mínimo
                    
                    $('#codigoProductoMov').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#nombreProductoMov').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#stockInicialMov').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    
                    $('#modalBuscarProductoMov').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los productos', 'error');
        }
    });
}

function validarFormularioMovimiento() {
    let valido = true;
    let mensajes = [];
    
    if ($('#tipoMovimiento').val() === '') {
        mensajes.push('Debe seleccionar un tipo de movimiento');
        valido = false;
    }
    
    if ($('#motivoMovimiento').val() === '') {
        mensajes.push('Debe seleccionar un motivo');
        valido = false;
    }
    
    if ($('#idAlmacenMov').val() === '') {
        mensajes.push('Debe seleccionar un almacén');
        valido = false;
    }
    
    if ($('#idCategoriaMov').val() === '') {
        mensajes.push('Debe seleccionar una categoría');
        valido = false;
    }
    
    if ($('#idSubcategoriaMov').val() === '') {
        mensajes.push('Debe seleccionar una subcategoría');
        valido = false;
    }
    
    if (!$('#idProducto').val()) {
        mensajes.push('Debe seleccionar un producto');
        valido = false;
    }
    
    if ($('#cantidadMov').val() === '' || parseInt($('#cantidadMov').val()) <= 0) {
        mensajes.push('La cantidad debe ser mayor a cero');
        valido = false;
    }
    
    if ($('#precioSolesMov').val() === '' || parseFloat($('#precioSolesMov').val()) < 0) {
        mensajes.push('El precio debe ser válido');
        valido = false;
    }
    
    if ($('#tipoMovimiento').val() === 'salida') {
        let stockInicial = parseInt($('#stockInicialMov').val()) || 0;
        let cantidad = parseInt($('#cantidadMov').val()) || 0;
        
        if (cantidad > stockInicial) {
            mensajes.push('No hay suficiente stock para realizar la salida');
            valido = false;
        }
    }
    
    if (!valido) {
        Swal.fire('Error', mensajes.join('<br>'), 'error');
    }
    
    return valido;
}
function guardarMovimiento() {
    // Obtener todos los datos del formulario
    const formData = {
        idProducto: $('#idProducto').val(),
        tipo: $('#tipoMovimiento').val(),
        stock_inicial: $('#stockInicialMov').val(),
        cantidad: $('#cantidadMov').val(),
        precio_soles: $('#precioSolesMov').val(),
        stock_final: $('#stockFinalMov').val(),
        observacion: $('#observacionMov').val(),
        motivo: $('#motivoMovimiento').val(),
        fecha_movimiento: $('#fechaMovimiento').val()
    };

    // Validación básica del ID del producto
    if (!formData.idProducto) {
        Swal.fire('Error', 'No se ha seleccionado un producto válido', 'error');
        return;
    }

    // Enviar datos al servidor
    $.ajax({
        url: '../movimientos/guardar.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: 'Éxito',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    $('#modalMovimientoProducto').modal('hide');
                                            location.reload();
                    if (typeof cargarTablaMovimientos === 'function') {
                        cargarTablaMovimientos();
                    }
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            let errorMsg = 'Ocurrió un error al guardar el movimiento';
            try {
                const response = JSON.parse(xhr.responseText);
                if (response && response.message) {
                    errorMsg = response.message;
                }
            } catch (e) {}
            
            Swal.fire('Error', errorMsg, 'error');
        }
    });
}
</script>