<style>
  /* Estilos personalizados para el scroll */
  .modal-scrollable {
    max-height: 70vh;
    overflow-y: auto;
  }
  
  .modal-scrollable::-webkit-scrollbar {
    width: 8px;
  }
  
  .modal-scrollable::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }
  
  .modal-scrollable::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
  }
  
  .modal-scrollable::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
  
  .table-scrollable {
    max-height: 50vh;
    overflow-y: auto;
    display: block;
  }
</style>

<!-- Modal Registrar Mantenimiento -->
<div class="modal fade" id="registrarMantenimientoModal" tabindex="-1" aria-labelledby="registrarMantenimientoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="registrarMantenimientoModalLabel">Registrar Mantenimiento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formMantenimiento">
        <div class="modal-body modal-scrollable">
          <!-- Campo para seleccionar vehículo -->
          <div class="row mb-3">
            <div class="col-md-9">
              <label for="vehiculoSeleccionado" class="form-label">Vehículo</label>
              <input type="text" class="form-control" id="vehiculoSeleccionado" readonly>
              <input type="hidden" id="idVehiculo" name="idVehiculo">
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="button" class="btn btn-info w-100" id="btnBuscarVehiculo">
                <i class="fas fa-search"></i> Buscar Vehículo
              </button>
            </div>
          </div>
          
          <!-- Campos del formulario -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="tipo_mantenimiento" class="form-label">Tipo de Mantenimiento</label>
              <select class="form-select" id="tipo_mantenimiento" name="tipo_mantenimiento" required>
                <option value="">Seleccionar...</option>
                <option value="Preventivo">Preventivo</option>
                <option value="Correctivo">Correctivo</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="fecha_mantenimiento" class="form-label">Fecha de Mantenimiento</label>
              <input type="date" class="form-control" id="fecha_mantenimiento" name="fecha_mantenimiento" required>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="fecha_proxima_mantenimiento" class="form-label">Próximo Mantenimiento</label>
              <input type="date" class="form-control" id="fecha_proxima_mantenimiento" name="fecha_proxima_mantenimiento" required>
            </div>
            <div class="col-md-6">
              <label for="kilometraje" class="form-label">Kilometraje</label>
              <input type="number" class="form-control" id="kilometraje" name="kilometraje">
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="costo" class="form-label">Costo (S/)</label>
              <input type="number" step="0.01" class="form-control" id="costo" name="costo">
            </div>
            <div class="col-md-6">
              <label for="taller" class="form-label">Taller</label>
              <input type="text" class="form-control" id="taller" name="taller">
            </div>
          </div>
          
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
              <option value="Pendiente">Pendiente</option>
              <option value="Realizado">Realizado</option>
              <option value="Vencido">Vencido</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Editar Mantenimiento -->
<div class="modal fade" id="editarMantenimientoModal" tabindex="-1" aria-labelledby="editarMantenimientoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editarMantenimientoModalLabel">Editar Mantenimiento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditarMantenimiento">
        <input type="hidden" id="edit_idMantenimiento" name="idMantenimiento">
        <div class="modal-body modal-scrollable">
          <!-- Campo para seleccionar vehículo -->
          <div class="row mb-3">
            <div class="col-md-9">
              <label for="edit_vehiculoSeleccionado" class="form-label">Vehículo</label>
              <input type="text" class="form-control" id="edit_vehiculoSeleccionado" readonly>
              <input type="hidden" id="edit_idVehiculo" name="idVehiculo">
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="button" class="btn btn-info w-100" id="btnBuscarVehiculoEditar">
                <i class="fas fa-search"></i> Buscar Vehículo
              </button>
            </div>
          </div>
          
          <!-- Campos del formulario -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="edit_tipo_mantenimiento" class="form-label">Tipo de Mantenimiento</label>
              <select class="form-select" id="edit_tipo_mantenimiento" name="tipo_mantenimiento" required>
                <option value="">Seleccionar...</option>
                <option value="Preventivo">Preventivo</option>
                <option value="Correctivo">Correctivo</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="edit_fecha_mantenimiento" class="form-label">Fecha de Mantenimiento</label>
              <input type="date" class="form-control" id="edit_fecha_mantenimiento" name="fecha_mantenimiento" required>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="edit_fecha_proxima_mantenimiento" class="form-label">Próximo Mantenimiento</label>
              <input type="date" class="form-control" id="edit_fecha_proxima_mantenimiento" name="fecha_proxima_mantenimiento" required>
            </div>
            <div class="col-md-6">
              <label for="edit_kilometraje" class="form-label">Kilometraje</label>
              <input type="number" class="form-control" id="edit_kilometraje" name="kilometraje">
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="edit_costo" class="form-label">Costo (S/)</label>
              <input type="number" step="0.01" class="form-control" id="edit_costo" name="costo">
            </div>
            <div class="col-md-6">
              <label for="edit_taller" class="form-label">Taller</label>
              <input type="text" class="form-control" id="edit_taller" name="taller">
            </div>
          </div>
          
          <div class="mb-3">
            <label for="edit_descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="3"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="edit_observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="edit_observaciones" name="observaciones" rows="2"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="edit_estado" class="form-label">Estado</label>
            <select class="form-select" id="edit_estado" name="estado" required>
              <option value="Pendiente">Pendiente</option>
              <option value="Realizado">Realizado</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Buscar Vehículo -->
<div class="modal fade" id="buscarVehiculoModal" tabindex="-1" aria-labelledby="buscarVehiculoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="buscarVehiculoModalLabel">Buscar Vehículo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-scrollable">
        <!-- Barra de búsqueda -->
        <div class="input-group mb-3">
          <input type="text" id="buscarVehiculoInput" class="form-control" placeholder="Buscar por placa, marca o modelo...">
          <button class="btn btn-outline-secondary" type="button" id="limpiarBusquedaVehiculo">
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <!-- Tabla de resultados -->
        <div class="table-responsive table-scrollable">
          <table class="table table-striped table-hover" id="tablaVehiculos">
            <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
              <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="cuerpoTablaVehiculos">
              <!-- Los datos se cargarán aquí dinámicamente -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Abrir modal de búsqueda de vehículo
    $('#btnBuscarVehiculo, #btnBuscarVehiculoEditar').click(function() {
        $('#buscarVehiculoModal').modal('show');
        cargarVehiculos();
    });
    
    // Cargar vehículos en la tabla de búsqueda
    function cargarVehiculos() {
        $.ajax({
            url: '../mantemientovehiculos/buscarvehiculos.php',
            method: 'GET',
            dataType: 'json',
            success: function(vehiculos) {
                const tbody = $('#cuerpoTablaVehiculos');
                tbody.empty();
                
                if(vehiculos.length === 0) {
                    tbody.append('<tr><td colspan="6" class="text-center">No se encontraron vehículos</td></tr>');
                    return;
                }
                
                vehiculos.forEach(function(vehiculo) {
                    const row = `
                        <tr>
                            <td>${vehiculo.placa || 'N/A'}</td>
                            <td>${vehiculo.marca || 'N/A'}</td>
                            <td>${vehiculo.modelo || 'N/A'}</td>
                            <td>${vehiculo.capacidadPeso ? vehiculo.capacidadPeso + ' kg' : 'N/A'}</td>
                            <td>
                                <span class="badge ${vehiculo.estado === 'Disponible' ? 'bg-success' : 'bg-warning'}">
                                    ${vehiculo.estado || 'N/A'}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btnSeleccionarVehiculo" 
                                        data-id="${vehiculo.idVehiculo}"
                                        data-placa="${vehiculo.placa}"
                                        data-marca="${vehiculo.marca}"
                                        data-modelo="${vehiculo.modelo}">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los vehículos:", error);
                $('#cuerpoTablaVehiculos').html('<tr><td colspan="6" class="text-center text-danger">Error al cargar los vehículos</td></tr>');
            }
        });
    }
    
    // Seleccionar vehículo (para ambos modales)
    $(document).on('click', '.btnSeleccionarVehiculo', function() {
        const idVehiculo = $(this).data('id');
        const placa = $(this).data('placa');
        const marca = $(this).data('marca');
        const modelo = $(this).data('modelo');
        
        // Determinar si estamos en modal de edición o registro
        const isEditModal = $('#buscarVehiculoModal').data('edit-mode');
        
        if(isEditModal) {
            $('#edit_idVehiculo').val(idVehiculo);
            $('#edit_vehiculoSeleccionado').val(`${placa} - ${marca} ${modelo}`);
        } else {
            $('#idVehiculo').val(idVehiculo);
            $('#vehiculoSeleccionado').val(`${placa} - ${marca} ${modelo}`);
        }
        
        $('#buscarVehiculoModal').modal('hide');
    });
    
    // Filtrar vehículos en la búsqueda
    $('#buscarVehiculoInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#tablaVehiculos tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // Limpiar búsqueda
    $('#limpiarBusquedaVehiculo').click(function() {
        $('#buscarVehiculoInput').val('');
        $('#tablaVehiculos tbody tr').show();
    });
    
    // Enviar formulario de mantenimiento (Guardar)
    $('#formMantenimiento').submit(function(e) {
        e.preventDefault();
        
        // Validar que se haya seleccionado un vehículo
        if(!$('#idVehiculo').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe seleccionar un vehículo'
            });
            return;
        }
        
        const formData = $(this).serialize();
        
        $.ajax({
            url: '../mantemientovehiculos/guardar.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                // Mostrar spinner de carga
                $('#registrarMantenimientoModal').find('.modal-footer button[type="submit"]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
            },
            complete: function() {
                // Restaurar texto del botón
                $('#registrarMantenimientoModal').find('.modal-footer button[type="submit"]').html('Guardar');
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#registrarMantenimientoModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al guardar el mantenimiento'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la conexión con el servidor: ' + error
                });
            }
        });
    });
    
    // Enviar formulario de edición de mantenimiento (Actualizar)
    $('#formEditarMantenimiento').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
        $.ajax({
            url: '../mantemientovehiculos/actualizar.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                // Mostrar spinner de carga
                $('#editarMantenimientoModal').find('.modal-footer button[type="submit"]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...');
            },
            complete: function() {
                // Restaurar texto del botón
                $('#editarMantenimientoModal').find('.modal-footer button[type="submit"]').html('Actualizar');
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editarMantenimientoModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al actualizar el mantenimiento'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la conexión con el servidor: ' + error
                });
            }
        });
    });
    
    // Configurar fechas por defecto
    const today = new Date().toISOString().split('T')[0];
    $('#fecha_mantenimiento').val(today);
    
    // Calcular próxima fecha de mantenimiento (30 días después)
    const nextMonth = new Date();
    nextMonth.setDate(nextMonth.getDate() + 30);
    const nextMonthStr = nextMonth.toISOString().split('T')[0];
    $('#fecha_proxima_mantenimiento').val(nextMonthStr);
    
    // Manejar cambio en fecha de mantenimiento para actualizar próxima fecha
    $('#fecha_mantenimiento, #edit_fecha_mantenimiento').change(function() {
        if($(this).val()) {
            const fecha = new Date($(this).val());
            fecha.setDate(fecha.getDate() + 30);
            const fechaStr = fecha.toISOString().split('T')[0];
            
            if($(this).attr('id') === 'fecha_mantenimiento') {
                $('#fecha_proxima_mantenimiento').val(fechaStr);
            } else {
                $('#edit_fecha_proxima_mantenimiento').val(fechaStr);
            }
        }
    });
    
    // Cargar datos para edición cuando se hace clic en el botón editar
    $(document).on('click', '.editar-mantenimiento', function() {
        const idMantenimiento = $(this).data('id');
        
        $.ajax({
            url: '../mantemientovehiculos/obtenermantenimiento.php',
            method: 'POST',
            data: { id: idMantenimiento },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    // Llenar el formulario con los datos
                    $('#edit_idMantenimiento').val(response.data.idMantenimiento);
                    $('#edit_idVehiculo').val(response.data.idVehiculo);
                    $('#edit_vehiculoSeleccionado').val(response.data.vehiculo);
                    $('#edit_tipo_mantenimiento').val(response.data.tipo_mantenimiento);
                    $('#edit_fecha_mantenimiento').val(response.data.fecha_mantenimiento);
                    $('#edit_fecha_proxima_mantenimiento').val(response.data.fecha_proxima_mantenimiento);
                    $('#edit_kilometraje').val(response.data.kilometraje);
                    $('#edit_costo').val(response.data.costo);
                    $('#edit_taller').val(response.data.taller);
                    $('#edit_descripcion').val(response.data.descripcion);
                    $('#edit_observaciones').val(response.data.observaciones);
                    $('#edit_estado').val(response.data.estado);
                    
                    // Mostrar el modal de edición
                    $('#editarMantenimientoModal').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al cargar los datos del mantenimiento'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar los datos del mantenimiento'
                });
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // =============================================
    // 1. Configuración para ambos modales
    // =============================================
    
    // Validación para el modal de registro
    $('#fecha_mantenimiento').change(function() {
        validarYConfigurarFechas(false);
    });
    
    // Validación para el modal de edición
    $('#edit_fecha_mantenimiento').change(function() {
        validarYConfigurarFechas(true);
    });
    
    // Validación en tiempo real para ambos modales
    $('input[type="date"]').on('input', function() {
        const isEditModal = $(this).closest('#editarMantenimientoModal').length > 0;
        validarFechasEnTiempoReal(isEditModal);
    });
    
    // =============================================
    // 2. Configuración específica del modal de edición
    // =============================================
    
    $('#editarMantenimientoModal').on('show.bs.modal', function(event) {
        // Poner el campo de fecha de mantenimiento en solo lectura
        $('#edit_fecha_mantenimiento').prop('readonly', true);
        
        // Configurar validación de fechas
        configurarValidacionFechas();
    });
    
    $('#editarMantenimientoModal').on('hidden.bs.modal', function() {
        // Restablecer campos al cerrar el modal
        $('#edit_fecha_mantenimiento').prop('readonly', false);
        $('#edit_fecha_proxima_mantenimiento')
            .removeAttr('min')
            .removeAttr('title')
            .off('input change');
    });
    
    // =============================================
    // 3. Funciones de validación
    // =============================================
    
    function validarYConfigurarFechas(isEditModal) {
        const fechaMantenimientoInput = isEditModal ? $('#edit_fecha_mantenimiento') : $('#fecha_mantenimiento');
        const fechaProximaInput = isEditModal ? $('#edit_fecha_proxima_mantenimiento') : $('#fecha_proxima_mantenimiento');
        
        if (fechaMantenimientoInput.val()) {
            // Establecer la fecha mínima para el próximo mantenimiento
            fechaProximaInput.attr('min', fechaMantenimientoInput.val());
            
            // Si la fecha próxima ya tiene un valor y es anterior, corregirla
            if (fechaProximaInput.val()) {
                const fechaMantenimiento = new Date(fechaMantenimientoInput.val());
                const fechaProxima = new Date(fechaProximaInput.val());
                
                if (fechaProxima < fechaMantenimiento) {
                    fechaProximaInput.val(fechaMantenimientoInput.val());
                    mostrarFeedbackError(fechaProximaInput);
                }
            }
        }
    }
    
    function validarFechasEnTiempoReal(isEditModal) {
        const fechaMantenimientoInput = isEditModal ? $('#edit_fecha_mantenimiento') : $('#fecha_mantenimiento');
        const fechaProximaInput = isEditModal ? $('#edit_fecha_proxima_mantenimiento') : $('#fecha_proxima_mantenimiento');
        
        if (fechaMantenimientoInput.val() && fechaProximaInput.val()) {
            const fechaMantenimiento = new Date(fechaMantenimientoInput.val());
            const fechaProxima = new Date(fechaProximaInput.val());
            
            if (fechaProxima < fechaMantenimiento) {
                fechaProximaInput.val(fechaMantenimientoInput.val());
                mostrarFeedbackError(fechaProximaInput);
            }
        }
    }
    
    function configurarValidacionFechas() {
        const fechaMantenimiento = $('#edit_fecha_mantenimiento').val();
        
        if (fechaMantenimiento) {
            const inputProxima = $('#edit_fecha_proxima_mantenimiento');
            
            // Establecer atributos para bloquear fechas anteriores
            inputProxima.attr({
                'min': fechaMantenimiento,
                'title': `Solo fechas igual o posteriores a ${fechaMantenimiento}`
            });
            
            // Validación en tiempo real
            inputProxima.on('input change', function() {
                const fechaSeleccionada = $(this).val();
                if (fechaSeleccionada && new Date(fechaSeleccionada) < new Date(fechaMantenimiento)) {
                    $(this).val(fechaMantenimiento);
                    mostrarFeedbackError($(this));
                }
            });
        }
    }
    
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
