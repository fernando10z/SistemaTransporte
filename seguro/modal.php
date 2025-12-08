<!-- Modal principal para registrar seguro -->
<div class="modal fade" id="registrarSeguroModal" tabindex="-1" role="dialog" aria-labelledby="registrarSeguroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="registrarSeguroModalLabel">Registrar Seguro de Vehículo</h5>
                <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="registrarSeguroForm">
                <!-- Añadido contenedor con scroll -->
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="form-group">
                        <label for="vehiculoInfo">Vehículo</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="vehiculoInfo" placeholder="Seleccione un vehículo" readonly>
                            <input type="hidden" id="idVehiculo" name="idVehiculo">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="buscarVehiculoBtn">Buscar Vehículo</button>
                            </div>
                        </div>
                    </div>
                    <!-- En el formulario dentro del modal, añade este campo -->
                    <div class="form-group">
                        <label for="codigo">Código de Seguro</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="SEG0001" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="generarCodigoBtn">
                                    <i class="fas fa-sync-alt"></i> Generar
                                </button>
                            </div>
                        </div>
                    </div>
                                        <div class="form-group">
                        <label for="nombre_seguro">Nombre del Seguro</label>
                        <input type="text" class="form-control" id="nombre_seguro" name="nombre_seguro" placeholder="Ingrese el nombre del seguro">
                    </div>
                    
                    <div class="form-group">
                        <label for="numero_poliza">Número de Póliza</label>
                        <input type="text" class="form-control" id="numero_poliza" name="numero_poliza" placeholder="Ingrese el número de póliza">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value="Pendiente" selected>Pendiente</option>
                            <option value="Vencido">Vencido</option>
                            <option value="Anulada">Anulada</option>
                            <option value="Realizada">Realizada</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Ingrese observaciones adicionales"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Seguro</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para buscar vehículos -->
<div class="modal fade" id="buscarVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="buscarVehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarVehiculoModalLabel">Buscar Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Añadido contenedor con scroll -->
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="form-group">
                    <input type="text" id="searchVehiculoInput" class="form-control" placeholder="Buscar por placa, marca o modelo...">
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="vehiculosTableBody">
                            <!-- Los vehículos se cargarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Función para generar el código correlativo
    function generarCodigoCorrelativo() {
        $.ajax({
            url: '../seguro/generarcodigo.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#codigo').val(response.codigo);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al generar el código'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al conectar con el servidor: ' + error
                });
            }
        });
    }

    // Generar código al hacer clic en el botón
    $('#generarCodigoBtn').click(function() {
        generarCodigoCorrelativo();
    });

    // Generar código automáticamente al abrir el modal
    $('#registrarSeguroModal').on('show.bs.modal', function() {
        generarCodigoCorrelativo();
    });
    });
</script>
<script>
$(document).ready(function() {
    // Abrir modal de búsqueda de vehículos
    $('#buscarVehiculoBtn').click(function() {
        $('#buscarVehiculoModal').modal('show');
        cargarVehiculos();
    });

    // Buscar vehículos mientras se escribe
    $('#searchVehiculoInput').keyup(function() {
        cargarVehiculos($(this).val());
    });

    // Función para cargar vehículos
    function cargarVehiculos(searchTerm = '') {
        $.ajax({
            url: '../seguro/buscarvehiculos.php',
            type: 'GET',
            data: { search: searchTerm },
            success: function(response) {
                $('#vehiculosTableBody').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#vehiculosTableBody').html('<tr><td colspan="4" class="text-center">Error al cargar los vehículos</td></tr>');
            }
        });
    }
// Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#registrarSeguroModal').modal('hide');
    });

    // Efecto hover para botones
    $('.btn').hover(
        function() {
            $(this).addClass('shadow-sm');
        },
        function() {
            $(this).removeClass('shadow-sm');
        }
    );
    // Seleccionar vehículo
    $(document).on('click', '.seleccionar-vehiculo', function() {
        const idVehiculo = $(this).data('id');
        const placa = $(this).data('placa');
        const marca = $(this).data('marca');
        const modelo = $(this).data('modelo');
        
        $('#idVehiculo').val(idVehiculo);
        $('#vehiculoInfo').val(`${placa} - ${marca} ${modelo}`);
        $('#buscarVehiculoModal').modal('hide');
    });

  $('#registrarSeguroForm').submit(function(e) {
    e.preventDefault();
    
    // Mostrar loader o deshabilitar botón
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
    
    $.ajax({
        url: '../seguro/guardarseguro.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json', // Esperamos JSON como respuesta
        success: function(response) {
            // Restaurar botón
            submitBtn.prop('disabled', false).html('Guardar Seguro');
            
            // Verificar si response ya es un objeto (puede pasar con dataType: 'json')
            const result = typeof response === 'string' ? JSON.parse(response) : response;
            
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: result.message,
                    timer: 2000,
                    showConfirmButton: false,
                    willClose: () => {
                        $('#registrarSeguroModal').modal('hide');
                        // Actualizar la tabla/listado sin recargar toda la página
                        if (typeof actualizarListadoSeguros === 'function') {
                            actualizarListadoSeguros();
                        } else {
                            location.reload();
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: result.message.replace(/\n/g, '<br>'),
                    confirmButtonText: 'Entendido'
                });
            }
        },
        error: function(xhr, status, error) {
            // Restaurar botón
            submitBtn.prop('disabled', false).html('Guardar Seguro');
            
            let errorMsg = 'Error al conectar con el servidor';
            
            if (xhr.responseText) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    errorMsg = response.message || errorMsg;
                } catch (e) {
                    errorMsg = xhr.responseText;
                }
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: errorMsg,
                confirmButtonText: 'Entendido'
            });
        }
    });
});

    // Resetear formulario al cerrar el modal
    $('#registrarSeguroModal').on('hidden.bs.modal', function() {
        $('#registrarSeguroForm')[0].reset();
        $('#vehiculoInfo').val('');
        $('#idVehiculo').val('');
    });
});
</script>
<script>
    $(document).ready(function() {
    // Validación para fechas de seguro
    $('#fecha_inicio').change(function() {
        const fechaInicio = new Date($(this).val());
        const fechaVencimientoInput = $('#fecha_vencimiento');
        
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
    $('#fecha_vencimiento').on('input change', function() {
        const fechaInicio = $('#fecha_inicio').val();
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
</script>
<style>
/* Estructura principal del modal */
#registrarSeguroModal .modal-dialog {
    max-width: 600px;
}

#registrarSeguroModal .modal-content {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    background: #ffffff;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Encabezado de lujo */
#registrarSeguroModal .modal-header {
    background: #ffffff;
    color: #1a1a1a;
    padding: 22px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
}

#registrarSeguroModal .modal-title {
    font-weight: 700;
    font-size: 1.5rem;
    letter-spacing: -0.3px;
    color: #1a1a1a;
    position: relative;
    display: inline-block;
}

#registrarSeguroModal .modal-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #3a7bd5, #00d2ff);
    border-radius: 3px;
}

#registrarSeguroModal .close {
    color: #a0a0a0;
    opacity: 0.8;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-size: 1.8rem;
    text-shadow: none;
    margin-top: -5px;
}

#registrarSeguroModal .close:hover {
    color: #1a1a1a;
    opacity: 1;
    transform: rotate(90deg) scale(1.1);
}

/* Cuerpo del modal - Estilo ultra limpio */
#registrarSeguroModal .modal-body {
    padding: 24px;
    background: #ffffff;
    /* Scroll personalizado */
    scrollbar-width: thin;
    scrollbar-color: #3a7bd5 #f1f1f1;
}

/* Personalización del scroll para WebKit */
#registrarSeguroModal .modal-body::-webkit-scrollbar {
    width: 8px;
}

#registrarSeguroModal .modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#registrarSeguroModal .modal-body::-webkit-scrollbar-thumb {
    background-color: #3a7bd5;
    border-radius: 10px;
    border: 2px solid #f1f1f1;
}

/* Campos de formulario premium */
#registrarSeguroModal .form-control {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 11px 15px;
    font-size: 15px;
    transition: all 0.3s ease;
    background-color: #fafafa;
    box-shadow: none;
    height: auto;
}

#registrarSeguroModal .form-control:focus {
    border-color: #3a7bd5;
    box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.08);
    background-color: #ffffff;
}

#registrarSeguroModal textarea.form-control {
    min-height: 110px;
    resize: vertical;
}

/* Etiquetas elegantes */
#registrarSeguroModal .form-group label {
    font-weight: 600;
    color: #4a4a4a;
    margin-bottom: 10px;
    font-size: 13px;
    display: block;
    letter-spacing: 0.2px;
}

/* Pie del modal - Estilo minimalista */
#registrarSeguroModal .modal-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding: 18px 28px;
    background: #ffffff;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Botones de diseño exclusivo */
#registrarSeguroModal .btn {
    border: none;
    border-radius: 10px;
    padding: 12px 26px;
    font-weight: 600;
    letter-spacing: 0.3px;
    font-size: 12px;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    min-width: 120px;
    text-align: center;
}

#registrarSeguroModal .btn-secondary {
    background-color: #f5f5f5;
    color: #4a4a4a;
}

#registrarSeguroModal .btn-secondary:hover {
    background-color: #e9e9e9;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
}

#registrarSeguroModal .btn-primary {
    background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    color: white;
    box-shadow: 0 4px 15px rgba(58, 123, 213, 0.25);
}

#registrarSeguroModal .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(58, 123, 213, 0.35);
    background: linear-gradient(135deg, #3570c7, #00c8f5);
}

#registrarSeguroModal .btn-primary::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, 
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.2) 50%,
                rgba(255, 255, 255, 0) 100%);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

#registrarSeguroModal .btn-primary:hover::after {
    transform: translateX(100%);
}

/* Efectos al hacer click */
@keyframes btnClick {
    0% { transform: scale(1); }
    50% { transform: scale(0.97); }
    100% { transform: scale(1); }
}

#registrarSeguroModal .btn:active {
    animation: btnClick 0.3s ease;
}

/* Selectores personalizados */
#registrarSeguroModal select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234a4a4a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    padding-right: 40px;
}

/* Estilos para el modal de búsqueda de vehículos */
#buscarVehiculoModal .modal-content {
    border-radius: 18px;
}

#buscarVehiculoModal .table {
    margin-top: 15px;
}

#buscarVehiculoModal .table th {
    font-weight: 600;
    color: #4a4a4a;
}

#buscarVehiculoModal .seleccionar-vehiculo {
    background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    color: white;
    border: none;
    border-radius: 6px;
    padding: 5px 12px;
    font-size: 12px;
    transition: all 0.3s;
}

#buscarVehiculoModal .seleccionar-vehiculo:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(58, 123, 213, 0.3);
}

/* Estilos para el scroll en el modal de búsqueda */
#buscarVehiculoModal .modal-body {
    scrollbar-width: thin;
    scrollbar-color: #3a7bd5 #f1f1f1;
}

#buscarVehiculoModal .modal-body::-webkit-scrollbar {
    width: 8px;
}

#buscarVehiculoModal .modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#buscarVehiculoModal .modal-body::-webkit-scrollbar-thumb {
    background-color: #3a7bd5;
    border-radius: 10px;
    border: 2px solid #f1f1f1;
}

/* Prevenir que el scroll del body se vea afectado */
body.modal-open {
    overflow: auto;
    padding-right: 0 !important;
}
</style>