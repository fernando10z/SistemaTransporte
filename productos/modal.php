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
#modalProducto .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalProducto .modal-title::after {
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
<!-- Modal para Producto - Diseño Moderno -->
<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="modalProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="modalProductoLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-box me-2"></i>Registro de Producto
                </h5>
                <button type="button" class="btn-close btn-close-black" aria-label="Close" onclick="$('#modalProducto').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formProducto">
                    <input type="hidden" id="idProducto" name="idProducto">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="codigoProducto" name="codigoProducto" placeholder="Código de Producto" readonly>
                                <label for="codigoProducto">Código de Producto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Nombre de Producto" required>
                                <label for="nombreProducto">Nombre de Producto</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información de Almacenamiento</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idAlmacen" name="idAlmacen" required>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="idAlmacen">Almacén</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idCategoria" name="idCategoria" required disabled>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="idCategoria">Categoría</label>
                            </div>
                            <button type="button" class="btn btn-primary mt-2 w-100" id="btnBuscarCategoria" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Categoría
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idsubcategoria" name="idsubcategoria" required disabled>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="idsubcategoria">Subcategoría</label>
                            </div>
                            <button type="button" class="btn btn-primary mt-2 w-100" id="btnBuscarSubcategoria" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Subcategoría
                            </button>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Control de Stock</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Actual" min="0" value="0">
                                <label for="stock">Stock Actual</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" placeholder="Stock Mínimo" min="0" value="0">
                                <label for="stock_minimo">Stock Mínimo</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="status" name="status">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="status">Estado</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalProducto').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarProducto">
                    <i class="fas fa-save me-2"></i>Guardar Producto
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Categorías -->
<div class="modal fade" id="modalBuscarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalBuscarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarCategoriaLabel">
                    <i class="fas fa-list me-2"></i>Seleccionar Categoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarCategoria').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarCategoria" placeholder="Buscar categoría...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarCategoria">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaCategorias">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarCategoria').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Subcategorías -->
<div class="modal fade" id="modalBuscarSubcategoria" tabindex="-1" role="dialog" aria-labelledby="modalBuscarSubcategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarSubcategoriaLabel">
                    <i class="fas fa-list-ol me-2"></i>Seleccionar Subcategoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarSubcategoria').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarSubcategoria" placeholder="Buscar subcategoría...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarSubcategoria">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaSubcategorias">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarSubcategoria').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cargar almacenes al iniciar
    cargarAlmacenes();
    
    // Generar código de producto automático
    generarCodigoProducto();
    // Cuando abras el modal para agregar producto
$('#btnAgregarProducto').click(function() {
    // Limpiar formulario
    $('#formProducto')[0].reset();
    
    // Generar nuevo código
    generarCodigoProducto();
    
    // Mostrar modal
    $('#modalProducto').modal('show');
});

// También llama a generarCodigoProducto() cuando el modal se muestre
$('#modalProducto').on('shown.bs.modal', function() {
    generarCodigoProducto();
});
    // Habilitar categoría cuando se selecciona almacén
    $('#idAlmacen').change(function() {
        if ($(this).val() !== '') {
            $('#idCategoria').prop('disabled', false);
            $('#btnBuscarCategoria').prop('disabled', false);
            // Limpiar categoría y subcategoría al cambiar almacén
            $('#idCategoria').val('');
            $('#idsubcategoria').val('').prop('disabled', true);
            $('#btnBuscarSubcategoria').prop('disabled', true);
        } else {
            $('#idCategoria').prop('disabled', true).val('');
            $('#btnBuscarCategoria').prop('disabled', true);
            $('#idsubcategoria').prop('disabled', true).val('');
            $('#btnBuscarSubcategoria').prop('disabled', true);
        }
    });
    
    // Habilitar subcategoría cuando se selecciona categoría
    $('#idCategoria').change(function() {
        if ($(this).val() !== '') {
            $('#idsubcategoria').prop('disabled', false);
            $('#btnBuscarSubcategoria').prop('disabled', false);
            // Limpiar subcategoría al cambiar categoría
            $('#idsubcategoria').val('');
        } else {
            $('#idsubcategoria').prop('disabled', true).val('');
            $('#btnBuscarSubcategoria').prop('disabled', true);
        }
    });
    
    // Abrir modal para buscar categorías
    $('#btnBuscarCategoria').click(function() {
        const idAlmacen = $('#idAlmacen').val();
        if (idAlmacen) {
            cargarCategorias(idAlmacen);
            $('#modalBuscarCategoria').modal('show');
        } else {
            Swal.fire('Error', 'Debe seleccionar un almacén primero', 'error');
        }
    });
    
    // Abrir modal para buscar subcategorías
    $('#btnBuscarSubcategoria').click(function() {
        const idAlmacen = $('#idAlmacen').val();
        const idCategoria = $('#idCategoria').val();
        
        if (idAlmacen && idCategoria) {
            cargarSubcategorias(idAlmacen, idCategoria);
            $('#modalBuscarSubcategoria').modal('show');
        } else {
            Swal.fire('Error', 'Debe seleccionar un almacén y categoría primero', 'error');
        }
    });
    
    // Filtrar categorías
    $('#btnFiltrarCategoria').click(function() {
        filtrarTabla('tablaCategorias', 'buscarCategoria');
    });
    
    // Filtrar subcategorías
    $('#btnFiltrarSubcategoria').click(function() {
        filtrarTabla('tablaSubcategorias', 'buscarSubcategoria');
    });
    
    // Guardar producto
    $('#btnGuardarProducto').click(function() {
        guardarProducto();
    });
    
    // Permitir filtrar con Enter
    $('#buscarCategoria').keypress(function(e) {
        if (e.which == 13) {
            filtrarTabla('tablaCategorias', 'buscarCategoria');
        }
    });
    
    $('#buscarSubcategoria').keypress(function(e) {
        if (e.which == 13) {
            filtrarTabla('tablaSubcategorias', 'buscarSubcategoria');
        }
    });
});
function generarCodigoProducto() {
    console.log("Iniciando generación de código...");
    
    $.ajax({
        url: '../productos/generarcodigo.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log("Respuesta del servidor:", response);
            
            if (response.success) {
                $('#codigoProducto').val(response.codigo);
                console.log("Código asignado:", response.codigo);
            } else {
                // Si hay error, usar PR0001 como valor por defecto
                $('#codigoProducto').val(response.codigo || 'PR0001');
                console.error('Error al generar código:', response.message);
                
                // Mostrar alerta solo si es un error inesperado (no el valor por defecto)
                if (!response.codigo) {
                    Swal.fire('Advertencia', 'Se usó código por defecto (PR0001)', 'warning');
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición AJAX:", status, error);
            
            // En caso de error en la petición AJAX, usar PR0001
            $('#codigoProducto').val('PR0001');
            
            Swal.fire('Error', 'No se pudo conectar al servidor para generar el código. Se usará PR0001', 'error');
        }
    });
}
function cargarAlmacenes() {
    $.ajax({
        url: '../productos/obteneralmacen.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#idAlmacen').empty().append('<option value="">Seleccionar</option>');
                $.each(response.data, function(index, almacen) {
                    $('#idAlmacen').append(`<option value="${almacen.idAlmacen}">${almacen.nombreAlmacen}</option>`);
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los almacenes: ' + error, 'error');
        }
    });
}

function cargarCategorias(idAlmacen) {
    $.ajax({
        url: '../productos/cargarcategoria.php',
        type: 'GET',
        data: { idAlmacen: idAlmacen },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const tbody = $('#tablaCategorias tbody');
                tbody.empty();
                
                if (response.data.length === 0) {
                    tbody.append('<tr><td colspan="2" class="text-center">No se encontraron categorías</td></tr>');
                    return;
                }
                
                $.each(response.data, function(index, categoria) {
                    tbody.append(`
                        <tr>
                            <td>${categoria.nombreCategoria}</td>
                            <td class="text-end">
                                <button class="btn btn-primary btn-sm btn-seleccionar-categoria" 
                                        data-id="${categoria.idCategoria}" 
                                        data-nombre="${categoria.nombreCategoria}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Asignar evento a los botones de selección
                $('.btn-seleccionar-categoria').click(function() {
                    const id = $(this).data('id');
                    const nombre = $(this).data('nombre');
                    
                    $('#idCategoria').val(id).trigger('change');
                    $('#modalBuscarCategoria').modal('hide');
                    
                    // Actualizar el select con la categoría seleccionada
                    if ($('#idCategoria option[value="' + id + '"]').length === 0) {
                        $('#idCategoria').append(new Option(nombre, id));
                    }
                    $('#idCategoria').val(id);
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las categorías: ' + error, 'error');
        }
    });
}

function cargarSubcategorias(idAlmacen, idCategoria) {
    $.ajax({
        url: '../productos/cargarsubcategoria.php',
        type: 'GET',
        data: { 
            idAlmacen: idAlmacen,
            idCategoria: idCategoria 
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const tbody = $('#tablaSubcategorias tbody');
                tbody.empty();
                
                if (response.data.length === 0) {
                    tbody.append('<tr><td colspan="2" class="text-center">No se encontraron subcategorías</td></tr>');
                    return;
                }
                
                $.each(response.data, function(index, subcategoria) {
                    tbody.append(`
                        <tr>
                            <td>${subcategoria.nombreSubcategoria}</td>
                            <td class="text-end">
                                <button class="btn btn-primary btn-sm btn-seleccionar-subcategoria" 
                                        data-id="${subcategoria.idsubcategoria}" 
                                        data-nombre="${subcategoria.nombreSubcategoria}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Asignar evento a los botones de selección
                $('.btn-seleccionar-subcategoria').click(function() {
                    const id = $(this).data('id');
                    const nombre = $(this).data('nombre');
                    
                    $('#idsubcategoria').val(id);
                    $('#modalBuscarSubcategoria').modal('hide');
                    
                    // Actualizar el select con la subcategoría seleccionada
                    if ($('#idsubcategoria option[value="' + id + '"]').length === 0) {
                        $('#idsubcategoria').append(new Option(nombre, id));
                    }
                    $('#idsubcategoria').val(id);
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las subcategorías: ' + error, 'error');
        }
    });
}

function filtrarTabla(idTabla, idBusqueda) {
    const valor = $('#' + idBusqueda).val().toLowerCase();
    $('#' + idTabla + ' tbody tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
    });
}

function guardarProducto() {
   // Validar que el código tenga el formato PR + 4 dígitos
    const codigo = $('#codigoProducto').val();
    if (!/^PR\d{4}$/.test(codigo)) {
        Swal.fire('Error', 'El código del producto no tiene el formato correcto (PR0001)', 'error');
        return;
    }

    // Resto de tu código de validación y guardado...
    if (!$('#formProducto')[0].checkValidity()) {
        Swal.fire('Error', 'Por favor complete todos los campos requeridos', 'error');
        return;
    }

    const formData = $('#formProducto').serialize();
    
    Swal.fire({
        title: '¿Guardar producto?',
        text: '¿Está seguro de guardar este producto?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../productos/guardar.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#btnGuardarProducto').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Guardando...');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Éxito',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#modalProducto').modal('hide');
                            location.reload(); // Recargar la página para ver los cambios
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Error al guardar el producto: ' + error, 'error');
                },
                complete: function() {
                    $('#btnGuardarProducto').prop('disabled', false).html('<i class="fas fa-save me-2"></i> Guardar Producto');
                }
            });
        }
    });
}
</script>