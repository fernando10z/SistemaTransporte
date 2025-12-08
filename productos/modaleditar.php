<style>
/* Estilos para el modal de edición de productos */
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
.modal-editar-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.modal-editar-header {
    color: white;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

.modal-editar-title {
    color: white;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.modal-editar-body {
    padding: 25px;
    max-height: 75vh;
    overflow-y: auto;
}

.modal-editar-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para el contenido del formulario */
.form-editar-content {
    margin-top: 20px;
}

.section-editar-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

.section-editar-divider span {
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

.section-editar-divider:before {
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

.btn-close-white {
    filter: invert(1);
    opacity: 0.8;
}

.btn-close-white:hover {
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

.w-100 {
    width: 100% !important;
}

.text-end {
    text-align: end !important;
}

.text-center {
    text-align: center !important;
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
#modalEditarProducto .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarProducto .modal-title::after {
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

<!-- Modal para Editar Producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-editar-content">
            <div class="modal-header modal-editar-header">
                <h5 class="modal-title modal-editar-title" id="modalEditarProductoLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Producto
                </h5>
                <button type="button" class="btn-close btn-close-black" aria-label="Close" onclick="$('#modalEditarProducto').modal('hide')"></button>
            </div>
            <div class="modal-body modal-editar-body">
                <form id="formEditarProducto">
                    <input type="hidden" id="edit_idProducto" name="idProducto">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_codigoProducto" name="codigoProducto" placeholder="Código de Producto" readonly>
                                <label for="edit_codigoProducto">Código de Producto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_nombreProducto" name="nombreProducto" placeholder="Nombre de Producto" required>
                                <label for="edit_nombreProducto">Nombre de Producto</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="edit_descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="edit_descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-editar-divider mt-4">
                        <span>Información de Almacenamiento</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="edit_idAlmacen" name="idAlmacen" required>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="edit_idAlmacen">Almacén</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="edit_idCategoria" name="idCategoria" required disabled>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="edit_idCategoria">Categoría</label>
                            </div>
                            <button type="button" class="btn btn-primary mt-2 w-100" id="edit_btnBuscarCategoria" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Categoría
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="edit_idsubcategoria" name="idsubcategoria" required disabled>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="edit_idsubcategoria">Subcategoría</label>
                            </div>
                            <button type="button" class="btn btn-primary mt-2 w-100" id="edit_btnBuscarSubcategoria" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Subcategoría
                            </button>
                        </div>
                    </div>
                    
                    <div class="section-editar-divider mt-4">
                        <span>Control de Stock</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="edit_stock" name="stock" placeholder="Stock Actual" min="0" value="0">
                                <label for="edit_stock">Stock Actual</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="edit_stock_minimo" name="stock_minimo" placeholder="Stock Mínimo" min="0" value="0">
                                <label for="edit_stock_minimo">Stock Mínimo</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="edit_status">Estado</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-editar-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEditarProducto').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarProducto">
                    <i class="fas fa-save me-2"></i>Actualizar Producto
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Categorías (Edición) -->
<div class="modal fade" id="modalEditarBuscarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarBuscarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditarBuscarCategoriaLabel">
                    <i class="fas fa-list me-2"></i>Seleccionar Categoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalEditarBuscarCategoria').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="edit_buscarCategoria" placeholder="Buscar categoría...">
                            <button class="btn btn-primary" type="button" id="edit_btnFiltrarCategoria">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="edit_tablaCategorias">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalEditarBuscarCategoria').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Subcategorías (Edición) -->
<div class="modal fade" id="modalEditarBuscarSubcategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarBuscarSubcategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditarBuscarSubcategoriaLabel">
                    <i class="fas fa-list-ol me-2"></i>Seleccionar Subcategoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalEditarBuscarSubcategoria').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="edit_buscarSubcategoria" placeholder="Buscar subcategoría...">
                            <button class="btn btn-primary" type="button" id="edit_btnFiltrarSubcategoria">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="edit_tablaSubcategorias">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalEditarBuscarSubcategoria').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Manejar clic en botón editar
    $(document).on('click', '.editar-producto', function() {
        const idProducto = $(this).data('id');
        obtenerProductoParaEdicion(idProducto);
    });

    // Habilitar categoría cuando se selecciona almacén (edición)
    $('#edit_idAlmacen').change(function() {
        if ($(this).val() !== '') {
            $('#edit_idCategoria').prop('disabled', false);
            $('#edit_btnBuscarCategoria').prop('disabled', false);
            // Limpiar categoría y subcategoría al cambiar almacén
            $('#edit_idCategoria').val('');
            $('#edit_idsubcategoria').val('').prop('disabled', true);
            $('#edit_btnBuscarSubcategoria').prop('disabled', true);
        } else {
            $('#edit_idCategoria').prop('disabled', true).val('');
            $('#edit_btnBuscarCategoria').prop('disabled', true);
            $('#edit_idsubcategoria').prop('disabled', true).val('');
            $('#edit_btnBuscarSubcategoria').prop('disabled', true);
        }
    });
    
    // Habilitar subcategoría cuando se selecciona categoría (edición)
    $('#edit_idCategoria').change(function() {
        if ($(this).val() !== '') {
            $('#edit_idsubcategoria').prop('disabled', false);
            $('#edit_btnBuscarSubcategoria').prop('disabled', false);
            // Limpiar subcategoría al cambiar categoría
            $('#edit_idsubcategoria').val('');
        } else {
            $('#edit_idsubcategoria').prop('disabled', true).val('');
            $('#edit_btnBuscarSubcategoria').prop('disabled', true);
        }
    });
    
    // Abrir modal para buscar categorías (edición)
    $('#edit_btnBuscarCategoria').click(function() {
        const idAlmacen = $('#edit_idAlmacen').val();
        if (idAlmacen) {
            cargarCategoriasParaEdicion(idAlmacen);
            $('#modalEditarBuscarCategoria').modal('show');
        } else {
            Swal.fire('Error', 'Debe seleccionar un almacén primero', 'error');
        }
    });
    
    // Abrir modal para buscar subcategorías (edición)
    $('#edit_btnBuscarSubcategoria').click(function() {
        const idAlmacen = $('#edit_idAlmacen').val();
        const idCategoria = $('#edit_idCategoria').val();
        
        if (idAlmacen && idCategoria) {
            cargarSubcategoriasParaEdicion(idAlmacen, idCategoria);
            $('#modalEditarBuscarSubcategoria').modal('show');
        } else {
            Swal.fire('Error', 'Debe seleccionar un almacén y categoría primero', 'error');
        }
    });
    
    // Filtrar categorías (edición)
    $('#edit_btnFiltrarCategoria').click(function() {
        filtrarTablaEdicion('edit_tablaCategorias', 'edit_buscarCategoria');
    });
    
    // Filtrar subcategorías (edición)
    $('#edit_btnFiltrarSubcategoria').click(function() {
        filtrarTablaEdicion('edit_tablaSubcategorias', 'edit_buscarSubcategoria');
    });
    
    // Actualizar producto
    $('#btnActualizarProducto').click(function() {
        actualizarProducto();
    });
    
    // Permitir filtrar con Enter (edición)
    $('#edit_buscarCategoria').keypress(function(e) {
        if (e.which == 13) {
            filtrarTablaEdicion('edit_tablaCategorias', 'edit_buscarCategoria');
        }
    });
    
    $('#edit_buscarSubcategoria').keypress(function(e) {
        if (e.which == 13) {
            filtrarTablaEdicion('edit_tablaSubcategorias', 'edit_buscarSubcategoria');
        }
    });
});

function obtenerProductoParaEdicion(idProducto) {
    $.ajax({
        url: '../productos/obtenerproductos.php',
        type: 'GET',
        data: { idProducto: idProducto },
        dataType: 'json',
        beforeSend: function() {
            // Mostrar loader si es necesario
        },
        success: function(response) {
            if (response.success) {
                const producto = response.data;
                
                // Llenar el formulario con los datos del producto
                $('#edit_idProducto').val(producto.idProducto);
                $('#edit_codigoProducto').val(producto.codigoProducto);
                $('#edit_nombreProducto').val(producto.nombreProducto);
                $('#edit_descripcion').val(producto.descripcion);
                $('#edit_stock').val(producto.stock);
                $('#edit_stock_minimo').val(producto.stock_minimo);
                $('#edit_status').val(producto.status);
                
                // Cargar almacén y seleccionar el correcto
                cargarAlmacenParaEdicion(producto.idAlmacen, producto.idCategoria, producto.idsubcategoria);
                
                // Mostrar el modal
                $('#modalEditarProducto').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Error al obtener el producto: ' + error, 'error');
        }
    });
}

function cargarAlmacenParaEdicion(idAlmacen, idCategoria, idSubcategoria) {
    // Primero cargar almacenes
    $.ajax({
        url: '../productos/obteneralmacen.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#edit_idAlmacen').empty().append('<option value="">Seleccionar</option>');
                $.each(response.data, function(index, almacen) {
                    $('#edit_idAlmacen').append(`<option value="${almacen.idAlmacen}">${almacen.nombreAlmacen}</option>`);
                });
                
                // Seleccionar el almacén del producto
                $('#edit_idAlmacen').val(idAlmacen).trigger('change');
                
                // Cargar categorías para el almacén seleccionado
                cargarCategoriaParaEdicion(idAlmacen, idCategoria, idSubcategoria);
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los almacenes: ' + error, 'error');
        }
    });
}

function cargarCategoriaParaEdicion(idAlmacen, idCategoria, idSubcategoria) {
    if (!idAlmacen) return;
    
    $.ajax({
        url: '../productos/cargarcategoria.php',
        type: 'GET',
        data: { idAlmacen: idAlmacen },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#edit_idCategoria').empty().append('<option value="">Seleccionar</option>');
                $.each(response.data, function(index, categoria) {
                    $('#edit_idCategoria').append(`<option value="${categoria.idCategoria}">${categoria.nombreCategoria}</option>`);
                });
                
                // Seleccionar la categoría del producto
                $('#edit_idCategoria').val(idCategoria).trigger('change');
                
                // Cargar subcategorías para la categoría seleccionada
                cargarSubcategoriaParaEdicion(idAlmacen, idCategoria, idSubcategoria);
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las categorías: ' + error, 'error');
        }
    });
}

function cargarSubcategoriaParaEdicion(idAlmacen, idCategoria, idSubcategoria) {
    if (!idAlmacen || !idCategoria) return;
    
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
                $('#edit_idsubcategoria').empty().append('<option value="">Seleccionar</option>');
                $.each(response.data, function(index, subcategoria) {
                    $('#edit_idsubcategoria').append(`<option value="${subcategoria.idsubcategoria}">${subcategoria.nombreSubcategoria}</option>`);
                });
                
                // Seleccionar la subcategoría del producto
                $('#edit_idsubcategoria').val(idSubcategoria);
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las subcategorías: ' + error, 'error');
        }
    });
}

function cargarCategoriasParaEdicion(idAlmacen) {
    $.ajax({
        url: '../productos/cargarcategoria.php',
        type: 'GET',
        data: { idAlmacen: idAlmacen },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const tbody = $('#edit_tablaCategorias tbody');
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
                                <button class="btn btn-primary btn-sm edit_btn-seleccionar-categoria" 
                                        data-id="${categoria.idCategoria}" 
                                        data-nombre="${categoria.nombreCategoria}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Asignar evento a los botones de selección
                $('.edit_btn-seleccionar-categoria').click(function() {
                    const id = $(this).data('id');
                    const nombre = $(this).data('nombre');
                    
                    $('#edit_idCategoria').val(id).trigger('change');
                    $('#modalEditarBuscarCategoria').modal('hide');
                    
                    // Actualizar el select con la categoría seleccionada
                    if ($('#edit_idCategoria option[value="' + id + '"]').length === 0) {
                        $('#edit_idCategoria').append(new Option(nombre, id));
                    }
                    $('#edit_idCategoria').val(id);
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

function cargarSubcategoriasParaEdicion(idAlmacen, idCategoria) {
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
                const tbody = $('#edit_tablaSubcategorias tbody');
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
                                <button class="btn btn-primary btn-sm edit_btn-seleccionar-subcategoria" 
                                        data-id="${subcategoria.idsubcategoria}" 
                                        data-nombre="${subcategoria.nombreSubcategoria}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                // Asignar evento a los botones de selección
                $('.edit_btn-seleccionar-subcategoria').click(function() {
                    const id = $(this).data('id');
                    const nombre = $(this).data('nombre');
                    
                    $('#edit_idsubcategoria').val(id);
                    $('#modalEditarBuscarSubcategoria').modal('hide');
                    
                    // Actualizar el select con la subcategoría seleccionada
                    if ($('#edit_idsubcategoria option[value="' + id + '"]').length === 0) {
                        $('#edit_idsubcategoria').append(new Option(nombre, id));
                    }
                    $('#edit_idsubcategoria').val(id);
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

function filtrarTablaEdicion(idTabla, idBusqueda) {
    const valor = $('#' + idBusqueda).val().toLowerCase();
    $('#' + idTabla + ' tbody tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
    });
}

function actualizarProducto() {
    const formData = $('#formEditarProducto').serialize();
    
    // Validar que el código tenga el formato PR + 4 dígitos
    const codigo = $('#edit_codigoProducto').val();
    if (!/^PR\d{4}$/.test(codigo)) {
        Swal.fire('Error', 'El código del producto no tiene el formato correcto (PR0001)', 'error');
        return;
    }

    if (!$('#formEditarProducto')[0].checkValidity()) {
        Swal.fire('Error', 'Por favor complete todos los campos requeridos', 'error');
        return;
    }

    Swal.fire({
        title: '¿Actualizar producto?',
        text: '¿Está seguro de actualizar este producto?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../productos/actualizar.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#btnActualizarProducto').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Actualizando...');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Éxito',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#modalEditarProducto').modal('hide');
                            location.reload(); // Recargar la página para ver los cambios
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Error al actualizar el producto: ' + error, 'error');
                },
                complete: function() {
                    $('#btnActualizarProducto').prop('disabled', false).html('<i class="fas fa-save me-2"></i> Actualizar Producto');
                }
            });
        }
    });
}
</script>