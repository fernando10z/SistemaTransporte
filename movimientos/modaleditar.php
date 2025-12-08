<style>
    #modalEditarMovimiento .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarMovimiento .modal-title::after {
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
<!-- Modal para Editar Movimiento de Productos -->
<div class="modal fade" id="modalEditarMovimiento" tabindex="-1" role="dialog" aria-labelledby="modalEditarMovimientoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="modalEditarMovimientoLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Movimiento de Producto
                </h5>
                <button type="button" class="btn-close btn-close-black" aria-label="Close" onclick="$('#modalEditarMovimiento').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarMovimiento">
                    <input type="hidden" id="idMovimientoEdit" name="idMovimiento">
                    <input type="hidden" id="idProductoEdit" name="idProducto">
                    <input type="hidden" id="stockMinimoProductoEdit" name="stockMinimoProducto">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipoMovimientoEdit" name="tipoMovimiento" required>
                                    <option value="">Seleccionar</option>
                                    <option value="entrada">Entrada</option>
                                    <option value="salida">Salida</option>
                                </select>
                                <label for="tipoMovimientoEdit">Tipo de Movimiento</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="motivoMovimientoEdit" name="motivoMovimiento" required>
                                    <option value="">Seleccionar motivo</option>
                                    <option value="En tránsito">En tránsito</option>
                                    <option value="Almacenado">Almacenado</option>
                                    <option value="Pendiente revisión">Pendiente revisión</option>
                                    <option value="Entrega">Entrega</option>
                                    <option value="Traslado">Traslado</option>
                                    <option value="Devolución">Devolución</option>
                                </select>
                                <label for="motivoMovimientoEdit">Motivo</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Ubicación del Producto (Referencia)</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreAlmacenMovEdit" name="nombreAlmacenMov" placeholder="Almacén" readonly>
                                <input type="hidden" id="idAlmacenMovEdit" name="idAlmacenMov">
                                <label for="nombreAlmacenMovEdit">Almacén</label>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2 w-100" id="btnBuscarAlmacenEdit">
                                <i class="fas fa-search me-1"></i> Buscar Almacén
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreCategoriaMovEdit" name="nombreCategoriaMov" placeholder="Categoría" readonly>
                                <input type="hidden" id="idCategoriaMovEdit" name="idCategoriaMov">
                                <label for="nombreCategoriaMovEdit">Categoría</label>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2 w-100" id="btnBuscarCategoriaEdit" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Categoría
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreSubcategoriaMovEdit" name="nombreSubcategoriaMov" placeholder="Subcategoría" readonly>
                                <input type="hidden" id="idSubcategoriaMovEdit" name="idSubcategoriaMov">
                                <label for="nombreSubcategoriaMovEdit">Subcategoría</label>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2 w-100" id="btnBuscarSubcategoriaEdit" disabled>
                                <i class="fas fa-search me-1"></i> Buscar Subcategoría
                            </button>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary w-100" id="btnBuscarProductoEdit" disabled>
                                <i class="fas fa-boxes me-2"></i>Buscar Producto
                            </button>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información del Producto</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="codigoProductoMovEdit" name="codigoProductoMov" placeholder="Código de Producto" readonly>
                                <label for="codigoProductoMovEdit">Código de Producto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreProductoMovEdit" name="nombreProductoMov" placeholder="Nombre de Producto" readonly>
                                <label for="nombreProductoMovEdit">Nombre de Producto</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stockInicialMovEdit" name="stockInicialMov" placeholder="Stock Inicial" readonly>
                                <label for="stockInicialMovEdit">Stock Inicial</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="cantidadMovEdit" name="cantidadMov" placeholder="Cantidad" min="1" required>
                                <label for="cantidadMovEdit">Cantidad</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stockFinalMovEdit" name="stockFinalMov" placeholder="Stock Final" readonly>
                                <label for="stockFinalMovEdit">Stock Final</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="precioSolesMovEdit" name="precioSolesMov" placeholder="Precio en Soles" step="0.01" min="0" required>
                                <label for="precioSolesMovEdit">Precio en Soles</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="fechaMovimientoEdit" name="fechaMovimiento" required>
                                <label for="fechaMovimientoEdit">Fecha de Movimiento</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="observacionMovEdit" name="observacionMov" placeholder="Observaciones" style="height: 100px"></textarea>
                                <label for="observacionMovEdit">Observaciones</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEditarMovimiento').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarMovimiento">
                    <i class="fas fa-save me-2"></i>Actualizar Movimiento
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Almacén (Edición) -->
<div class="modal fade" id="modalBuscarAlmacenEdit" tabindex="-1" role="dialog" aria-labelledby="modalBuscarAlmacenEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarAlmacenEditLabel">
                    <i class="fas fa-warehouse me-2"></i>Seleccionar Almacén
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarAlmacenEdit').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarAlmacenEdit" placeholder="Buscar almacén...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarAlmacenEdit">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaAlmacenesEdit">
                        <thead class="table-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los almacenes se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarAlmacenEdit').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Categorías (Edición) -->
<div class="modal fade" id="modalBuscarCategoriaEdit" tabindex="-1" role="dialog" aria-labelledby="modalBuscarCategoriaEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarCategoriaEditLabel">
                    <i class="fas fa-list me-2"></i>Seleccionar Categoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarCategoriaEdit').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarCategoriaEdit" placeholder="Buscar categoría...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarCategoriaEdit">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaCategoriasEdit">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarCategoriaEdit').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Subcategorías (Edición) -->
<div class="modal fade" id="modalBuscarSubcategoriaEdit" tabindex="-1" role="dialog" aria-labelledby="modalBuscarSubcategoriaEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarSubcategoriaEditLabel">
                    <i class="fas fa-list-ol me-2"></i>Seleccionar Subcategoría
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarSubcategoriaEdit').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarSubcategoriaEdit" placeholder="Buscar subcategoría...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarSubcategoriaEdit">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaSubcategoriasEdit">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarSubcategoriaEdit').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Productos (Edición) -->
<div class="modal fade" id="modalBuscarProductoEdit" tabindex="-1" role="dialog" aria-labelledby="modalBuscarProductoEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalBuscarProductoEditLabel">
                    <i class="fas fa-boxes me-2"></i>Seleccionar Producto
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalBuscarProductoEdit').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscarProductoEdit" placeholder="Buscar producto...">
                            <button class="btn btn-primary" type="button" id="btnFiltrarProductoEdit">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaProductosEdit">
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
                <button type="button" class="btn btn-secondary" onclick="$('#modalBuscarProductoEdit').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cargar datos al abrir el modal
    $(document).on('click', '.editar-movimiento', function() {
        let idMovimiento = $(this).data('id');
        cargarDatosMovimiento(idMovimiento);
    });

    // Calcular stock final automáticamente y validar stock mínimo
    $('#cantidadMovEdit').on('input', function() {
        calcularStockFinalEdit();
        validarStockMinimoEdit();
    });

    $('#tipoMovimientoEdit').change(function() {
        calcularStockFinalEdit();
        validarStockMinimoEdit();
    });

    // Abrir modal de búsqueda de almacén
    $('#btnBuscarAlmacenEdit').click(function() {
        cargarAlmacenesEdit();
        $('#modalBuscarAlmacenEdit').modal('show');
    });

    // Abrir modal de búsqueda de categoría
    $('#btnBuscarCategoriaEdit').click(function() {
        let idAlmacen = $('#idAlmacenMovEdit').val();
        if (idAlmacen) {
            cargarCategoriasEdit(idAlmacen);
            $('#modalBuscarCategoriaEdit').modal('show');
        }
    });

    // Abrir modal de búsqueda de subcategoría
    $('#btnBuscarSubcategoriaEdit').click(function() {
        let idAlmacen = $('#idAlmacenMovEdit').val();
        let idCategoria = $('#idCategoriaMovEdit').val();
        if (idAlmacen && idCategoria) {
            cargarSubcategoriasEdit(idAlmacen, idCategoria);
            $('#modalBuscarSubcategoriaEdit').modal('show');
        }
    });

    // Abrir modal de búsqueda de producto
    $('#btnBuscarProductoEdit').click(function() {
        let idAlmacen = $('#idAlmacenMovEdit').val();
        let idCategoria = $('#idCategoriaMovEdit').val();
        let idSubcategoria = $('#idSubcategoriaMovEdit').val();
        if (idAlmacen && idCategoria && idSubcategoria) {
            cargarProductosEdit(idAlmacen, idCategoria, idSubcategoria);
            $('#modalBuscarProductoEdit').modal('show');
        }
    });

    // Filtrar almacenes en el modal
    $('#btnFiltrarAlmacenEdit').click(function() {
        filtrarTabla('#buscarAlmacenEdit', '#tablaAlmacenesEdit', 0);
    });

    $('#buscarAlmacenEdit').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarAlmacenEdit', '#tablaAlmacenesEdit', 0);
        }
    });

    // Filtrar categorías en el modal
    $('#btnFiltrarCategoriaEdit').click(function() {
        filtrarTabla('#buscarCategoriaEdit', '#tablaCategoriasEdit', 0);
    });

    $('#buscarCategoriaEdit').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarCategoriaEdit', '#tablaCategoriasEdit', 0);
        }
    });

    // Filtrar subcategorías en el modal
    $('#btnFiltrarSubcategoriaEdit').click(function() {
        filtrarTabla('#buscarSubcategoriaEdit', '#tablaSubcategoriasEdit', 0);
    });

    $('#buscarSubcategoriaEdit').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarSubcategoriaEdit', '#tablaSubcategoriasEdit', 0);
        }
    });

    // Filtrar productos en el modal
    $('#btnFiltrarProductoEdit').click(function() {
        filtrarTabla('#buscarProductoEdit', '#tablaProductosEdit', 1);
    });

    $('#buscarProductoEdit').keyup(function(e) {
        if (e.keyCode === 13) {
            filtrarTabla('#buscarProductoEdit', '#tablaProductosEdit', 1);
        }
    });

    // Limpiar campos dependientes cuando cambia el almacén
    $('#idAlmacenMovEdit').change(function() {
        $('#nombreCategoriaMovEdit, #idCategoriaMovEdit').val('');
        $('#nombreSubcategoriaMovEdit, #idSubcategoriaMovEdit').val('');
        $('#btnBuscarSubcategoriaEdit, #btnBuscarProductoEdit').prop('disabled', true);
        $('#idProductoEdit').val('');
        $('#codigoProductoMovEdit, #nombreProductoMovEdit, #stockInicialMovEdit').val('');
    });

    // Limpiar campos dependientes cuando cambia la categoría
    $('#idCategoriaMovEdit').change(function() {
        $('#nombreSubcategoriaMovEdit, #idSubcategoriaMovEdit').val('');
        $('#btnBuscarProductoEdit').prop('disabled', true);
        $('#idProductoEdit').val('');
        $('#codigoProductoMovEdit, #nombreProductoMovEdit, #stockInicialMovEdit').val('');
    });

    // Actualizar movimiento
    $('#btnActualizarMovimiento').click(function() {
        if (validarFormularioMovimientoEdit()) {
            let stockFinal = parseInt($('#stockFinalMovEdit').val()) || 0;
            let stockMinimo = parseInt($('#stockMinimoProductoEdit').val()) || 0;
            let tipo = $('#tipoMovimientoEdit').val();
            
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
                        actualizarMovimiento();
                    }
                });
            } else {
                actualizarMovimiento();
            }
        }
    });
});

function calcularStockFinalEdit() {
    let stockInicial = parseInt($('#stockInicialMovEdit').val()) || 0;
    let cantidad = parseInt($('#cantidadMovEdit').val()) || 0;
    let tipo = $('#tipoMovimientoEdit').val();
    
    if (tipo === 'entrada') {
        $('#stockFinalMovEdit').val(stockInicial + cantidad);
    } else if (tipo === 'salida') {
        $('#stockFinalMovEdit').val(stockInicial - cantidad);
    }
}

function validarStockMinimoEdit() {
    let stockFinal = parseInt($('#stockFinalMovEdit').val()) || 0;
    let stockMinimo = parseInt($('#stockMinimoProductoEdit').val()) || 0;
    let tipo = $('#tipoMovimientoEdit').val();
    
    if (tipo === 'salida' && stockFinal < stockMinimo) {
        Swal.fire({
            title: 'Advertencia',
            text: '¡Atención! El stock final será menor que el stock mínimo permitido.',
            icon: 'warning',
            confirmButtonText: 'Entendido'
        });
    }
}

function filtrarTabla(inputSelector, tablaSelector, columna) {
    let termino = $(inputSelector).val().toLowerCase();
    $(tablaSelector + ' tbody tr').each(function() {
        let texto = $(this).find('td').eq(columna).text().toLowerCase();
        $(this).toggle(texto.includes(termino));
    });
}

function cargarAlmacenesEdit() {
    $.ajax({
        url: '../movimientos/obteneralmacen.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#tablaAlmacenesEdit tbody').empty();
            if (response.length === 0) {
                $('#tablaAlmacenesEdit tbody').append('<tr><td colspan="2" class="text-center">No se encontraron almacenes</td></tr>');
            } else {
                response.forEach(function(almacen) {
                    $('#tablaAlmacenesEdit tbody').append(`
                        <tr>
                            <td>${almacen.nombre}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarAlmacenEdit" 
                                        data-id="${almacen.idAlmacen}" 
                                        data-nombre="${almacen.nombre}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $(document).off('click', '.btnSeleccionarAlmacenEdit').on('click', '.btnSeleccionarAlmacenEdit', function() {
                    let id = $(this).data('id');
                    let nombre = $(this).data('nombre');
                    
                    $('#nombreAlmacenMovEdit').val(nombre);
                    $('#idAlmacenMovEdit').val(id);
                    $('#nombreAlmacenMovEdit').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#btnBuscarCategoriaEdit').prop('disabled', false);
                    $('#nombreCategoriaMovEdit, #idCategoriaMovEdit').val('');
                    $('#nombreSubcategoriaMovEdit, #idSubcategoriaMovEdit').val('');
                    $('#btnBuscarSubcategoriaEdit, #btnBuscarProductoEdit').prop('disabled', true);
                    $('#idProductoEdit').val('');
                    $('#codigoProductoMovEdit, #nombreProductoMovEdit, #stockInicialMovEdit').val('');
                    
                    $('#modalBuscarAlmacenEdit').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los almacenes', 'error');
        }
    });
}

function cargarCategoriasEdit(idAlmacen) {
    $.ajax({
        url: '../movimientos/obtenercategorias.php',
        type: 'GET',
        data: { idAlmacen: idAlmacen },
        dataType: 'json',
        success: function(response) {
            $('#tablaCategoriasEdit tbody').empty();
            if (response.length === 0) {
                $('#tablaCategoriasEdit tbody').append('<tr><td colspan="2" class="text-center">No se encontraron categorías</td></tr>');
            } else {
                response.forEach(function(categoria) {
                    $('#tablaCategoriasEdit tbody').append(`
                        <tr>
                            <td>${categoria.nombreCategoria}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarCategoriaEdit" 
                                        data-id="${categoria.idCategoria}" 
                                        data-nombre="${categoria.nombreCategoria}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $(document).off('click', '.btnSeleccionarCategoriaEdit').on('click', '.btnSeleccionarCategoriaEdit', function() {
                    let id = $(this).data('id');
                    let nombre = $(this).data('nombre');
                    
                    $('#nombreCategoriaMovEdit').val(nombre);
                    $('#idCategoriaMovEdit').val(id);
                    $('#nombreCategoriaMovEdit').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#btnBuscarSubcategoriaEdit').prop('disabled', false);
                    $('#nombreSubcategoriaMovEdit, #idSubcategoriaMovEdit').val('');
                    $('#btnBuscarProductoEdit').prop('disabled', true);
                    $('#idProductoEdit').val('');
                    $('#codigoProductoMovEdit, #nombreProductoMovEdit, #stockInicialMovEdit').val('');
                    
                    $('#modalBuscarCategoriaEdit').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las categorías', 'error');
        }
    });
}

function cargarSubcategoriasEdit(idAlmacen, idCategoria) {
    $.ajax({
        url: '../movimientos/obtenersubcategoria.php',
        type: 'GET',
        data: { 
            idAlmacen: idAlmacen,
            idCategoria: idCategoria
        },
        dataType: 'json',
        success: function(response) {
            $('#tablaSubcategoriasEdit tbody').empty();
            if (response.length === 0) {
                $('#tablaSubcategoriasEdit tbody').append('<tr><td colspan="2" class="text-center">No se encontraron subcategorías</td></tr>');
            } else {
                response.forEach(function(subcategoria) {
                    $('#tablaSubcategoriasEdit tbody').append(`
                        <tr>
                            <td>${subcategoria.nomArea}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarSubcategoriaEdit" 
                                        data-id="${subcategoria.idsubcategoria}" 
                                        data-nombre="${subcategoria.nomArea}">
                                    <i class="fas fa-check me-1"></i> Seleccionar
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $(document).off('click', '.btnSeleccionarSubcategoriaEdit').on('click', '.btnSeleccionarSubcategoriaEdit', function() {
                    let id = $(this).data('id');
                    let nombre = $(this).data('nombre');
                    
                    $('#nombreSubcategoriaMovEdit').val(nombre);
                    $('#idSubcategoriaMovEdit').val(id);
                    $('#nombreSubcategoriaMovEdit').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#btnBuscarProductoEdit').prop('disabled', false);
                    
                    $('#modalBuscarSubcategoriaEdit').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar las subcategorías', 'error');
        }
    });
}

function cargarProductosEdit(idAlmacen, idCategoria, idSubcategoria) {
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
            $('#tablaProductosEdit tbody').empty();
            if (response.length === 0) {
                $('#tablaProductosEdit tbody').append('<tr><td colspan="5" class="text-center">No se encontraron productos</td></tr>');
            } else {
                response.forEach(function(producto) {
                    $('#tablaProductosEdit tbody').append(`
                        <tr>
                            <td>${producto.codigoProducto}</td>
                            <td>${producto.nombreProducto}</td>
                            <td>${producto.stock}</td>
                            <td>${producto.stock_minimo}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarProductoEdit" 
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
                
                $(document).off('click', '.btnSeleccionarProductoEdit').on('click', '.btnSeleccionarProductoEdit', function() {
                    let id = $(this).data('id');
                    let codigo = $(this).data('codigo');
                    let nombre = $(this).data('nombre');
                    let stock = $(this).data('stock');
                    let stockMinimo = $(this).data('stock-minimo');
                    
                    $('#idProductoEdit').val(id);
                    $('#codigoProductoMovEdit').val(codigo);
                    $('#nombreProductoMovEdit').val(nombre);
                    $('#stockInicialMovEdit').val(stock);
                    $('#stockMinimoProductoEdit').val(stockMinimo);
                    
                    $('#codigoProductoMovEdit').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#nombreProductoMovEdit').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    $('#stockInicialMovEdit').next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    
                    $('#modalBuscarProductoEdit').modal('hide');
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los productos', 'error');
        }
    });
}

function cargarDatosMovimiento(idMovimiento) {
    $.ajax({
        url: '../movimientos/obtener.php',
        type: 'GET',
        data: { idMovimiento: idMovimiento },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Llenar los campos del formulario con los datos del movimiento
                $('#idMovimientoEdit').val(response.data.idMovimiento);
                $('#idProductoEdit').val(response.data.idProducto);
                $('#tipoMovimientoEdit').val(response.data.tipo);
                $('#motivoMovimientoEdit').val(response.data.motivo);
                $('#idAlmacenMovEdit').val(response.data.idAlmacen);
                $('#nombreAlmacenMovEdit').val(response.data.nombreAlmacen);
                
                // Cargar información del producto
                $('#codigoProductoMovEdit').val(response.data.codigoProducto);
                $('#nombreProductoMovEdit').val(response.data.nombreProducto);
                $('#stockInicialMovEdit').val(response.data.stock_inicial);
                $('#cantidadMovEdit').val(response.data.cantidad);
                $('#stockFinalMovEdit').val(response.data.stock_final);
                $('#stockMinimoProductoEdit').val(response.data.stock_minimo);
                $('#precioSolesMovEdit').val(response.data.precio_soles);
                
                // Formatear fecha para el input datetime-local
                let fechaMov = new Date(response.data.fecha_movimiento);
                let fechaFormateada = fechaMov.toISOString().slice(0, 16);
                $('#fechaMovimientoEdit').val(fechaFormateada);
                
                $('#observacionMovEdit').val(response.data.observacion);
                
                // Cargar información de categoría y subcategoría
                $('#nombreCategoriaMovEdit').val(response.data.nombreCategoria);
                $('#idCategoriaMovEdit').val(response.data.idCategoria);
                $('#nombreSubcategoriaMovEdit').val(response.data.nomArea);
                $('#idSubcategoriaMovEdit').val(response.data.idsubcategoria);
                
                // Habilitar botones de búsqueda según datos existentes
                if (response.data.idAlmacen) {
                    $('#btnBuscarCategoriaEdit').prop('disabled', false);
                }
                if (response.data.idAlmacen && response.data.idCategoria) {
                    $('#btnBuscarSubcategoriaEdit').prop('disabled', false);
                }
                if (response.data.idAlmacen && response.data.idCategoria && response.data.idsubcategoria) {
                    $('#btnBuscarProductoEdit').prop('disabled', false);
                }
                
                // Activar etiquetas flotantes
                $('.form-floating input, .form-floating select').each(function() {
                    if ($(this).val()) {
                        $(this).next('label').addClass('active').css('transform', 'scale(0.9) translateY(-0.5rem) translateX(0)');
                    }
                });
                
                // Mostrar el modal
                $('#modalEditarMovimiento').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudieron cargar los datos del movimiento', 'error');
        }
    });
}

function validarFormularioMovimientoEdit() {
    let valido = true;
    let mensajes = [];
    
    if ($('#tipoMovimientoEdit').val() === '') {
        mensajes.push('Debe seleccionar un tipo de movimiento');
        valido = false;
    }
    
    if ($('#motivoMovimientoEdit').val() === '') {
        mensajes.push('Debe seleccionar un motivo');
        valido = false;
    }
    
    if (!$('#idProductoEdit').val()) {
        mensajes.push('Debe seleccionar un producto');
        valido = false;
    }
    
    if ($('#cantidadMovEdit').val() === '' || parseInt($('#cantidadMovEdit').val()) <= 0) {
        mensajes.push('La cantidad debe ser mayor a cero');
        valido = false;
    }
    
    if ($('#precioSolesMovEdit').val() === '' || parseFloat($('#precioSolesMovEdit').val()) < 0) {
        mensajes.push('El precio debe ser válido');
        valido = false;
    }
    
    if ($('#tipoMovimientoEdit').val() === 'salida') {
        let stockInicial = parseInt($('#stockInicialMovEdit').val()) || 0;
        let cantidad = parseInt($('#cantidadMovEdit').val()) || 0;
        
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

function actualizarMovimiento() {
    // Obtener todos los datos del formulario
    const formData = {
        idMovimiento: $('#idMovimientoEdit').val(),
        idProducto: $('#idProductoEdit').val(),
        tipo: $('#tipoMovimientoEdit').val(),
        stock_inicial: $('#stockInicialMovEdit').val(),
        cantidad: $('#cantidadMovEdit').val(),
        precio_soles: $('#precioSolesMovEdit').val(),
        stock_final: $('#stockFinalMovEdit').val(),
        observacion: $('#observacionMovEdit').val(),
        motivo: $('#motivoMovimientoEdit').val(),
        fecha_movimiento: $('#fechaMovimientoEdit').val()
    };

    // Enviar datos al servidor
    $.ajax({
        url: '../movimientos/actualizar.php',
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
                    $('#modalEditarMovimiento').modal('hide');
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
            let errorMsg = 'Ocurrió un error al actualizar el movimiento';
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