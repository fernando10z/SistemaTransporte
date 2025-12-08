<!-- Modal de edición de asignación -->
<div class="modal fade" id="editarAsignacionModal" tabindex="-1" aria-labelledby="editarAsignacionModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarAsignacionModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Asignación
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarAsignacionModal').modal('hide')"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form id="editarAsignacionForm">
                    <input type="hidden" id="editar_idAsignacion">
                    <input type="hidden" id="editar_tipoAsignacion">
                    
                    <!-- Sección para Cliente Natural -->
                    <div id="editar_seccionNatural" style="display: none;" class="animate-fade-in">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-outline-primary" id="editar_buscarCotizacionNatural" style="padding: 10px 20px; border-radius: 6px;">
                                <i class="fas fa-search me-2"></i> Buscar Cotización Cliente
                            </button>
                        </div>
                        
                        <!-- Información de la cotización (solo lectura) -->
                        <div id="editar_infoCotizacionNatural" class="readonly-info mt-4" style="display: none;">
                            <div class="section-divider">
                                <span>Información de la Cotización</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_codigoCotizacionNatural" readonly>
                                        <label for="editar_codigoCotizacionNatural">Código</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_clienteNaturalNombre" readonly>
                                        <label for="editar_clienteNaturalNombre">Cliente</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_vehiculoNatural" readonly>
                                        <label for="editar_vehiculoNatural">Vehículo</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_pesoNatural" readonly>
                                        <label for="editar_pesoNatural">Peso</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_volumenNatural" readonly>
                                        <label for="editar_volumenNatural">Volumen</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="editar_idCotizacionNatural">
                        </div>
                    </div>

                    <!-- Sección para Empresa -->
                    <div id="editar_seccionEmpresa" style="display: none;" class="animate-fade-in">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-outline-primary" id="editar_buscarCotizacionEmpresa" style="padding: 10px 20px; border-radius: 6px;">
                                <i class="fas fa-search me-2"></i> Buscar Cotización Empresa
                            </button>
                        </div>
                        
                        <!-- Información de la cotización (solo lectura) -->
                        <div id="editar_infoCotizacionEmpresa" class="readonly-info mt-4" style="display: none;">
                            <div class="section-divider">
                                <span>Información de la Cotización</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_codigoCotizacionEmpresa" readonly>
                                        <label for="editar_codigoCotizacionEmpresa">Código</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_empresaNombre" readonly>
                                        <label for="editar_empresaNombre">Empresa</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_vehiculoEmpresa" readonly>
                                        <label for="editar_vehiculoEmpresa">Vehículo</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_pesoEmpresa" readonly>
                                        <label for="editar_pesoEmpresa">Peso</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="editar_volumenEmpresa" readonly>
                                        <label for="editar_volumenEmpresa">Volumen</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="editar_idCotizacionEmpresa">
                        </div>
                    </div>

                    <!-- Campos editables para la asignación -->
                    <div class="section-divider mt-4">
                        <span>Detalles de la Asignación</span>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="form-floating">
                            <textarea class="form-control" id="editar_observaciones" style="height: 100px;"></textarea>
                            <label for="editar_observaciones">Observaciones</label>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-floating">
                            <select class="form-select" id="editar_estadoAsignacion">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En tránsito">En tránsito</option>
                                <option value="Entregado">Entregado</option>
                            </select>
                            <label for="editar_estadoAsignacion">Estado</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#editarAsignacionModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="actualizarAsignacion">
                    <i class="fas fa-save me-2"></i>Actualizar Asignación
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar cotizaciones de clientes naturales (edición) -->
<div class="modal fade" id="editar_modalCotizacionesNaturales" tabindex="-1" aria-labelledby="editar_modalCotizacionesNaturalesLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editar_modalCotizacionesNaturalesLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-invoice me-2"></i>Seleccionar Cotización - Clientes Naturales
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editar_modalCotizacionesNaturales').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <!-- Barra de búsqueda -->
                <div class="input-group mb-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="editar_buscarNaturalInput" placeholder="Buscar...">
                        <label for="editar_buscarNaturalInput">Buscar por código, cliente o vehículo...</label>
                    </div>
                    <button class="btn btn-primary" type="button" id="editar_buscarNaturalBtn" style="border-radius: 0 6px 6px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="editar_tablaCotizacionesNaturales">
                        <thead class="table-light">
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Vehículo</th>
                                <th>Peso</th>
                                <th>Volumen</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#editar_modalCotizacionesNaturales').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar cotizaciones de empresas (edición) -->
<div class="modal fade" id="editar_modalCotizacionesEmpresas" tabindex="-1" aria-labelledby="editar_modalCotizacionesEmpresasLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editar_modalCotizacionesEmpresasLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-invoice me-2"></i>Seleccionar Cotización - Empresas
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editar_modalCotizacionesEmpresas').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <!-- Barra de búsqueda -->
                <div class="input-group mb-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="editar_buscarEmpresaInput" placeholder="Buscar...">
                        <label for="editar_buscarEmpresaInput">Buscar por código, empresa o vehículo...</label>
                    </div>
                    <button class="btn btn-primary" type="button" id="editar_buscarEmpresaBtn" style="border-radius: 0 6px 6px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="editar_tablaCotizacionesEmpresas">
                        <thead class="table-light">
                            <tr>
                                <th>Código</th>
                                <th>Empresa</th>
                                <th>Vehículo</th>
                                <th>Peso</th>
                                <th>Volumen</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#editar_modalCotizacionesEmpresas').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de edición */
#editarAsignacionModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

#editarAsignacionModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block;
    position: relative;
}

#editarAsignacionModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 50px;
    height: 3px;
    background-color:  #334d6e;;
    border-radius: 2px;
}

/* Estilos para los botones de búsqueda */
#editar_buscarCotizacionNatural, #editar_buscarCotizacionEmpresa {
    transition: var(--transition);
}

#editar_buscarCotizacionNatural:hover, #editar_buscarCotizacionEmpresa:hover {
    background-color: var(--primary-color);
    color: white;
}

/* Estilos para los modales de selección */
#editar_modalCotizacionesNaturales .modal-header,
#editar_modalCotizacionesEmpresas .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

#editar_modalCotizacionesNaturales .modal-title,
#editar_modalCotizacionesEmpresas .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block;
    position: relative;
}

#editar_modalCotizacionesNaturales .modal-title::after,
#editar_modalCotizacionesEmpresas .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 50px;
    height: 3px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

/* Estilos para el botón de actualización */
#actualizarAsignacion {
    background-color: #334d6e;;
    border-color: #334d6e;;
}

#actualizarAsignacion:hover {
    background-color: #334d6e;;
    border-color: #334d6e;;
}

</style>
<script>
$(document).ready(function() {
    // Manejar clic en botón editar
    $(document).on('click', '.editar', function() {
        const id = $(this).data('id');
        const tipo = $(this).data('type');
        
        // Mostrar loading
        Swal.fire({
            title: 'Cargando datos',
            html: 'Por favor espere...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Obtener datos de la asignación
        $.ajax({
            url: 'asignacion/obtener.php',
            type: 'POST',
            data: {
                id: id,
                tipo: tipo
            },
            dataType: 'json',
            success: function(response) {
                Swal.close();
                
                if(response.success) {
                    // Llenar el formulario con los datos obtenidos
                    $('#editar_idAsignacion').val(response.idAsignacion);
                    $('#editar_tipoAsignacion').val(tipo);
                    $('#editar_observaciones').val(response.observaciones);
                    $('#editar_estadoAsignacion').val(response.estado);
                    
                    // Mostrar la sección correspondiente según el tipo
                    if(tipo === 'cliente') {
                        $('#editar_seccionNatural').show();
                        $('#editar_seccionEmpresa').hide();
                        
                        // Llenar datos de cotización natural
                        $('#editar_idCotizacionNatural').val(response.idCotizacion);
                        $('#editar_codigoCotizacionNatural').val(response.idCotizacion);
                        $('#editar_clienteNaturalNombre').val(response.cliente);
                        $('#editar_vehiculoNatural').val(response.vehiculo_placa + ' - ' + response.vehiculo_modelo);
                        $('#editar_pesoNatural').val(response.peso + ' kg');
                        $('#editar_volumenNatural').val(response.volumen + ' m³');
                        
                        $('#editar_infoCotizacionNatural').show();
                    } else {
                        $('#editar_seccionNatural').hide();
                        $('#editar_seccionEmpresa').show();
                        
                        // Llenar datos de cotización empresa
                        $('#editar_idCotizacionEmpresa').val(response.idCotizacion);
                        $('#editar_codigoCotizacionEmpresa').val(response.idCotizacion);
                        $('#editar_empresaNombre').val(response.cliente);
                        $('#editar_vehiculoEmpresa').val(response.vehiculo_placa + ' - ' + response.vehiculo_modelo);
                        $('#editar_pesoEmpresa').val(response.peso + ' kg');
                        $('#editar_volumenEmpresa').val(response.volumen + ' m³');
                        
                        $('#editar_infoCotizacionEmpresa').show();
                    }
                    
                    // Mostrar el modal de edición
                    var editarModal = new bootstrap.Modal(document.getElementById('editarAsignacionModal'));
                    editarModal.show();
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar los datos', 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Error al cargar los datos: ' + error, 'error');
            }
        });
    });
    
    // Abrir modal de búsqueda para clientes naturales (edición)
    $('#editar_buscarCotizacionNatural').click(function() {
        var modalNatural = new bootstrap.Modal(document.getElementById('editar_modalCotizacionesNaturales'));
        modalNatural.show();
        cargarCotizacionesNaturalesEdicion();
    });

    // Abrir modal de búsqueda para empresas (edición)
    $('#editar_buscarCotizacionEmpresa').click(function() {
        var modalEmpresa = new bootstrap.Modal(document.getElementById('editar_modalCotizacionesEmpresas'));
        modalEmpresa.show();
        cargarCotizacionesEmpresasEdicion();
    });

    // Función para cargar cotizaciones de clientes naturales (edición)
    function cargarCotizacionesNaturalesEdicion() {
        $.ajax({
            url: 'asignacion/buscarcliente.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var tabla = $('#editar_tablaCotizacionesNaturales tbody');
                tabla.empty();
                
                if(data.length === 0) {
                    tabla.append('<tr><td colspan="8" class="text-center">No hay cotizaciones pendientes</td></tr>');
                    return;
                }
                
                $.each(data, function(index, cotizacion) {
                    var fila = '<tr>' +
                        '<td>' + cotizacion.idCotizacion + '</td>' +
                        '<td>' + cotizacion.nombreCliente + '</td>' +
                        '<td>' + cotizacion.placa + ' - ' + cotizacion.modelo + '</td>' +
                        '<td>' + cotizacion.peso + ' kg</td>' +
                        '<td>' + cotizacion.volumen + ' m³</td>' +
                        '<td>S/ ' + cotizacion.montoFinal + '</td>' +
                        '<td>' + cotizacion.estado + '</td>' +
                        '<td><button class="btn btn-sm btn-primary editar_seleccionar-natural" data-id="' + cotizacion.idCotizacion + 
                        '" data-codigo="' + cotizacion.idCotizacion + 
                        '" data-cliente="' + cotizacion.nombreCliente + 
                        '" data-vehiculo="' + cotizacion.placa + ' - ' + cotizacion.modelo + 
                        '" data-peso="' + cotizacion.peso + 
                        '" data-volumen="' + cotizacion.volumen + '">Seleccionar</button></td>' +
                        '</tr>';
                    tabla.append(fila);
                });
                
                // Asignar evento a los botones de selección
                $('.editar_seleccionar-natural').click(function() {
                    var id = $(this).data('id');
                    var codigo = $(this).data('codigo');
                    var cliente = $(this).data('cliente');
                    var vehiculo = $(this).data('vehiculo');
                    var peso = $(this).data('peso');
                    var volumen = $(this).data('volumen');
                    
                    $('#editar_idCotizacionNatural').val(id);
                    $('#editar_codigoCotizacionNatural').val(codigo);
                    $('#editar_clienteNaturalNombre').val(cliente);
                    $('#editar_vehiculoNatural').val(vehiculo);
                    $('#editar_pesoNatural').val(peso + ' kg');
                    $('#editar_volumenNatural').val(volumen + ' m³');
                    
                    $('#editar_infoCotizacionNatural').show();
                    bootstrap.Modal.getInstance(document.getElementById('editar_modalCotizacionesNaturales')).hide();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar las cotizaciones: ' + error
                });
            }
        });
    }

    // Función para cargar cotizaciones de empresas (edición)
    function cargarCotizacionesEmpresasEdicion() {
        $.ajax({
            url: 'asignacion/buscarempresa.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var tabla = $('#editar_tablaCotizacionesEmpresas tbody');
                tabla.empty();
                
                if(data.length === 0) {
                    tabla.append('<tr><td colspan="8" class="text-center">No hay cotizaciones pendientes</td></tr>');
                    return;
                }
                
                $.each(data, function(index, cotizacion) {
                    var fila = '<tr>' +
                        '<td>' + cotizacion.idCotizacionEmpresa + '</td>' +
                        '<td>' + cotizacion.razonSocial + '</td>' +
                        '<td>' + cotizacion.placa + ' - ' + cotizacion.modelo + '</td>' +
                        '<td>' + cotizacion.peso + ' kg</td>' +
                        '<td>' + cotizacion.volumen + ' m³</td>' +
                        '<td>S/ ' + cotizacion.montoFinal + '</td>' +
                        '<td>' + cotizacion.estado + '</td>' +
                        '<td><button class="btn btn-sm btn-primary editar_seleccionar-empresa" data-id="' + cotizacion.idCotizacionEmpresa + 
                        '" data-codigo="' + cotizacion.idCotizacionEmpresa + 
                        '" data-empresa="' + cotizacion.razonSocial + 
                        '" data-vehiculo="' + cotizacion.placa + ' - ' + cotizacion.modelo + 
                        '" data-peso="' + cotizacion.peso + 
                        '" data-volumen="' + cotizacion.volumen + '">Seleccionar</button></td>' +
                        '</tr>';
                    tabla.append(fila);
                });
                
                // Asignar evento a los botones de selección
                $('.editar_seleccionar-empresa').click(function() {
                    var id = $(this).data('id');
                    var codigo = $(this).data('codigo');
                    var empresa = $(this).data('empresa');
                    var vehiculo = $(this).data('vehiculo');
                    var peso = $(this).data('peso');
                    var volumen = $(this).data('volumen');
                    
                    $('#editar_idCotizacionEmpresa').val(id);
                    $('#editar_codigoCotizacionEmpresa').val(codigo);
                    $('#editar_empresaNombre').val(empresa);
                    $('#editar_vehiculoEmpresa').val(vehiculo);
                    $('#editar_pesoEmpresa').val(peso + ' kg');
                    $('#editar_volumenEmpresa').val(volumen + ' m³');
                    
                    $('#editar_infoCotizacionEmpresa').show();
                    bootstrap.Modal.getInstance(document.getElementById('editar_modalCotizacionesEmpresas')).hide();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar las cotizaciones: ' + error
                });
            }
        });
    }

    // Actualizar la asignación
    $('#actualizarAsignacion').click(function() {
        const idAsignacion = $('#editar_idAsignacion').val();
        const tipoAsignacion = $('#editar_tipoAsignacion').val();
        const observaciones = $('#editar_observaciones').val();
        const estado = $('#editar_estadoAsignacion').val();
        
        let idCotizacion;
        if(tipoAsignacion === 'cliente') {
            idCotizacion = $('#editar_idCotizacionNatural').val();
            if(!idCotizacion) {
                Swal.fire('Advertencia', 'Por favor seleccione una cotización', 'warning');
                return;
            }
        } else {
            idCotizacion = $('#editar_idCotizacionEmpresa').val();
            if(!idCotizacion) {
                Swal.fire('Advertencia', 'Por favor seleccione una cotización', 'warning');
                return;
            }
        }
        
        // Mostrar confirmación antes de actualizar
        Swal.fire({
            title: '¿Confirmar actualización?',
            text: "¿Está seguro de actualizar esta asignación?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar datos al servidor
                $.ajax({
                    url: 'asignacion/actualizar.php',
                    type: 'POST',
                    data: {
                        idAsignacion: idAsignacion,
                        tipoAsignacion: tipoAsignacion,
                        idCotizacion: idCotizacion,
                        observaciones: observaciones,
                        estado: estado
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Asignación actualizada correctamente',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                // Cerrar modal y recargar página
                                bootstrap.Modal.getInstance(document.getElementById('editarAsignacionModal')).hide();
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message || 'Error al actualizar', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'Error al actualizar: ' + error, 'error');
                    }
                });
            }
        });
    });
    
    // Manejar el cierre del modal de edición para limpiar el formulario
    $('#editarAsignacionModal').on('hidden.bs.modal', function () {
        $('#editarAsignacionForm')[0].reset();
        $('#editar_infoCotizacionNatural, #editar_infoCotizacionEmpresa').hide();
    });
});
</script>