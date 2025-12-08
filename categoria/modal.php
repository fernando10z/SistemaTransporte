<!-- Modal para agregar categoría - Diseño Moderno -->
<div class="modal fade" id="agregarCategoriaModal" tabindex="-1" aria-labelledby="agregarCategoriaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarCategoriaModalLabel">
          <i class="fas fa-tags me-2"></i>Nueva Categoría
        </h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#agregarCategoriaModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <form id="formAgregarCategoria">
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="almacen" name="idAlmacen" required>
                  <option value="">Seleccionar almacén</option>
                  <!-- Las opciones se llenarán con JavaScript -->
                </select>
                <label for="almacen">Almacén <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" required>
                <label for="nombreCategoria">Nombre de Categoría <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" id="descripcion" name="descripcion" style="height: 100px" required></textarea>
                <label for="descripcion">Descripción <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="status" name="status">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                <label for="status">Estado</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="$('#agregarCategoriaModal').modal('hide')">
          <i class="fas fa-times me-2"></i>Cancelar
        </button>
        <button type="button" class="btn btn-primary" id="btnGuardarCategoria">
          <i class="fas fa-save me-2"></i>Guardar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar categoría - Diseño Moderno -->
<div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarCategoriaModalLabel">
          <i class="fas fa-edit me-2"></i>Editar Categoría
        </h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarCategoriaModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarCategoria">
          <input type="hidden" id="edit_idCategoria" name="idCategoria">
          
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="edit_almacen" name="idAlmacen" required>
                  <option value="">Seleccionar almacén</option>
                  <!-- Las opciones se llenarán con JavaScript -->
                </select>
                <label for="edit_almacen">Almacén <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="edit_nombreCategoria" name="nombreCategoria" required>
                <label for="edit_nombreCategoria">Nombre de Categoría <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" id="edit_descripcion" name="descripcion" style="height: 100px" required></textarea>
                <label for="edit_descripcion">Descripción <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="edit_status" name="status">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                <label for="edit_status">Estado</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="$('#editarCategoriaModal').modal('hide')">
          <i class="fas fa-times me-2"></i>Cancelar
        </button>
        <button type="button" class="btn btn-primary" id="btnActualizarCategoria">
          <i class="fas fa-save me-2"></i>Guardar Cambios
        </button>
      </div>
    </div>
  </div>
</div>

<style>
/* Estilos para los modales de categoría */
#agregarCategoriaModal .modal-content,
#editarCategoriaModal .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#agregarCategoriaModal .modal-header,
#editarCategoriaModal .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#agregarCategoriaModal .modal-title,
#editarCategoriaModal .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}
#agregarCategoriaModal .modal-title,
#editarCategoriaModal .modal-title{
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#agregarCategoriaModal .modal-title::after, 
#editarCategoriaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#agregarCategoriaModal .modal-body,
#editarCategoriaModal .modal-body {
  padding: 25px;
}

#agregarCategoriaModal .modal-footer,
#editarCategoriaModal .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#agregarCategoriaModal .form-floating > .form-control,
#agregarCategoriaModal .form-floating > .form-select,
#editarCategoriaModal .form-floating > .form-control,
#editarCategoriaModal .form-floating > .form-select {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#agregarCategoriaModal .form-floating > textarea.form-control,
#editarCategoriaModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#agregarCategoriaModal .form-floating > .form-control:focus,
#agregarCategoriaModal .form-floating > .form-select:focus,
#editarCategoriaModal .form-floating > .form-control:focus,
#editarCategoriaModal .form-floating > .form-select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#agregarCategoriaModal .form-floating > label,
#editarCategoriaModal .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#agregarCategoriaModal .form-floating > .form-control:focus ~ label,
#agregarCategoriaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#agregarCategoriaModal .form-floating > .form-select ~ label,
#editarCategoriaModal .form-floating > .form-control:focus ~ label,
#editarCategoriaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarCategoriaModal .form-floating > .form-select ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#agregarCategoriaModal .text-danger,
#editarCategoriaModal .text-danger {
  color: var(--danger-color) !important;
}

/* Variables CSS */
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

/* Animaciones */
.animate__animated {
  animation-duration: 0.5s;
}

.animate__fadeInUp {
  animation-name: fadeInUp;
}

.animate__fadeInLeft {
  animation-name: fadeInLeft;
}

.animate__fadeInRight {
  animation-name: fadeInRight;
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

@keyframes fadeInLeft {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Personalizaciones para bootstrap */
.row {
  --bs-gutter-x: 1.5rem;
}

.g-3 {
  --bs-gutter-y: 1rem;
}

.mt-3 {
  margin-top: 1rem !important;
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
</style>
<script>
        // Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#editarCategoriaModal').modal('hide');
    });
    $(document).ready(function() {
    // Variables para los modales
    let agregarCategoriaModal = new bootstrap.Modal(document.getElementById('agregarCategoriaModal'));
    let editarCategoriaModal = new bootstrap.Modal(document.getElementById('editarCategoriaModal'));
    
    // Cargar almacenes en ambos selects al abrir los modales
    $('#agregarCategoriaModal').on('show.bs.modal', function() {
        cargarAlmacenes('#almacen');
    });
    
    $('#editarCategoriaModal').on('show.bs.modal', function() {
        cargarAlmacenes('#edit_almacen');
    });
    
// Función mejorada para cargar almacenes
function cargarAlmacenes(selectId, callback) {
    $.ajax({
        url: '../categoria/obteneralmacen.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            const selectElement = $(selectId);
            selectElement.empty();
            
            if(response && response.length > 0) {
                selectElement.append('<option value="">Seleccionar almacén</option>');
                response.forEach(function(almacen) {
                    selectElement.append(`<option value="${almacen.idAlmacen}">${almacen.nombre}</option>`);
                });
                
                if (typeof callback === 'function') {
                    callback();
                }
            } else {
                selectElement.append('<option value="">No hay almacenes disponibles</option>');
                if (typeof callback === 'function') callback();
            }
        },
        error: function(xhr, status, error) {
            $(selectId).html('<option value="">Error al cargar almacenes</option>');
            console.error('Error al cargar almacenes:', error);
            if (typeof callback === 'function') callback();
        }
    });
}
    // Guardar nueva categoría
    $('#btnGuardarCategoria').click(function() {
        if($('#formAgregarCategoria')[0].checkValidity()) {
            Swal.fire({
                title: 'Guardando...',
                html: 'Registrando nueva categoría',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
            $.ajax({
                url: '../categoria/guardar.php',
                type: 'POST',
                data: $('#formAgregarCategoria').serialize(),
                success: function(response) {
                    if(response.success) {
                        agregarCategoriaModal.hide();
                        Swal.fire({
                            title: 'Éxito',
                            text: response.message,
                            icon: 'success'
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error al guardar la categoría', 'error');
                }
            });
        } else {
            Swal.fire('Advertencia', 'Complete todos los campos requeridos', 'warning');
        }
    });
    
    $(document).on('click', '.editar-categoria', function() {
    const idCategoria = $(this).data('id');
    
    Swal.fire({
        title: 'Cargando...',
        html: 'Obteniendo datos de la categoría',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '../categoria/obtener.php',
        type: 'GET',
        data: { idCategoria: idCategoria },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if(response.success) {
                // Llenar campos básicos
                $('#edit_idCategoria').val(response.data.idCategoria);
                $('#edit_nombreCategoria').val(response.data.nombreCategoria);
                $('#edit_descripcion').val(response.data.descripcion);
                $('#edit_status').val(response.data.status);
                
                // Mostrar el nombre del almacén actual (opcional)
                $('#nombre_almacen_actual').text(response.data.nombre_almacen);
                
                // Mostrar modal primero
                editarCategoriaModal.show();
                
                // Cargar almacenes y seleccionar el correcto
                cargarAlmacenes('#edit_almacen', function() {
                    $('#edit_almacen').val(response.data.idAlmacen);
                    
                    // Opcional: Mostrar tooltip con info del almacén actual
                    $('#edit_almacen').attr('title', 'Actual: ' + response.data.nombre_almacen)
                                     .tooltip('update');
                });
            } else {
                Swal.fire('Error', response.message || 'Error al obtener datos', 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Error al conectar con el servidor: ' + error, 'error');
        }
    });
});


    
    // Actualizar categoría
    $('#btnActualizarCategoria').click(function() {
        if($('#formEditarCategoria')[0].checkValidity()) {
            Swal.fire({
                title: 'Guardando...',
                html: 'Actualizando categoría',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
            $.ajax({
                url: '../categoria/actualizar.php',
                type: 'POST',
                data: $('#formEditarCategoria').serialize(),
                success: function(response) {
                    if(response.success) {
                        editarCategoriaModal.hide();
                        Swal.fire({
                            title: 'Éxito',
                            text: response.message,
                            icon: 'success'
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error al actualizar la categoría', 'error');
                }
            });
        } else {
            Swal.fire('Advertencia', 'Complete todos los campos requeridos', 'warning');
        }
    });
});
</script>