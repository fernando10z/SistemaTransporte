<!-- Modal para editar almacén - Diseño Moderno -->
<div class="modal fade" id="editarAlmacenModal" tabindex="-1" aria-labelledby="editarAlmacenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarAlmacenModalLabel" style="font-size: 23px; color:black">
          <i class="fas fa-warehouse me-2"></i>Editar Almacén
        </h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarAlmacenModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarAlmacen">
          <input type="hidden" id="edit_idAlmacen" name="idAlmacen">
          
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                <label for="edit_nombre">Nombre <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" id="edit_ubicacion" name="ubicacion" style="height: 100px" required></textarea>
                <label for="edit_ubicacion">Ubicación <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="edit_estado" name="estado">
                  <option value="Activo">Activo</option>
                  <option value="Inactivo">Inactivo</option>
                </select>
                <label for="edit_estado">Estado</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="$('#editarAlmacenModal').modal('hide')">
          <i class="fas fa-times me-2"></i>Cancelar
        </button>
        <button type="button" class="btn btn-primary" id="btnActualizarAlmacen">
          <i class="fas fa-save me-2"></i>Guardar Cambios
        </button>
      </div>
    </div>
  </div>
</div>

<style>
/* Estilos específicos para el modal de edición de almacén */
#editarAlmacenModal .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#editarAlmacenModal .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#editarAlmacenModal .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}

#editarAlmacenModal .modal-body {
  padding: 25px;
}

#editarAlmacenModal .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}
#editarAlmacenModal .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}
#editarAlmacenModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarAlmacenModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#editarAlmacenModal .form-floating > .form-control,
#editarAlmacenModal .form-floating > .form-select {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#editarAlmacenModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#editarAlmacenModal .form-floating > .form-control:focus,
#editarAlmacenModal .form-floating > .form-select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarAlmacenModal .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#editarAlmacenModal .form-floating > .form-control:focus ~ label,
#editarAlmacenModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarAlmacenModal .form-floating > .form-select ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarAlmacenModal .text-danger {
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
  $(document).ready(function() {
    // Variable para mantener la instancia del modal
    let editarAlmacenModal;
    
    // Inicializar el modal al cargar la página
    const modalElement = document.getElementById('editarAlmacenModal');
    if (modalElement) {
        editarAlmacenModal = new bootstrap.Modal(modalElement);
    }

    // Manejar clic en botón editar
    $(document).on('click', '.editar-almacen', function() {
        const idAlmacen = $(this).data('id');
        
        // Mostrar loading
        Swal.fire({
            title: 'Cargando...',
            html: 'Obteniendo datos del almacén',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Obtener datos del almacén
        $.ajax({
            url: '../almacen/obtener.php',
            type: 'GET',
            data: { idAlmacen: idAlmacen },
            success: function(response) {
                Swal.close();
                
                if(response.success) {
                    // Llenar el modal con los datos
                    $('#edit_idAlmacen').val(response.data.idAlmacen);
                    $('#edit_nombre').val(response.data.nombre);
                    $('#edit_ubicacion').val(response.data.ubicacion);
                    $('#edit_estado').val(response.data.estado);
                    
                    // Mostrar el modal
                    editarAlmacenModal.show();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al obtener los datos del almacén', 'error');
            }
        });
    });
       // Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#editarAlmacenModal').modal('hide');
    });
    // Manejar clic en botón Guardar Cambios
    $('#btnActualizarAlmacen').click(function() {
        // Validar formulario
        if($('#formEditarAlmacen')[0].checkValidity()) {
            // Mostrar loading
            Swal.fire({
                title: 'Guardando...',
                html: 'Actualizando almacén',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Enviar datos al servidor
            $.ajax({
                url: '../almacen/actualizar.php',
                type: 'POST',
                data: $('#formEditarAlmacen').serialize(),
                success: function(response) {
                    if(response.success) {
                        // Cerrar modal
                        editarAlmacenModal.hide();
                        
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            // Recargar la página
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error al actualizar el almacén', 'error');
                }
            });
        } else {
            Swal.fire('Advertencia', 'Por favor complete todos los campos requeridos', 'warning');
        }
    });
});
</script>