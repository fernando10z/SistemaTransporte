<!-- Modal para agregar/editar almacén - Diseño Moderno -->
<div class="modal fade" id="almacenModal" tabindex="-1" aria-labelledby="almacenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="almacenModalLabel" style="font-size: 23px; color:black">
          <i class="fas fa-warehouse me-2"></i>Nuevo Almacén
        </h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#almacenModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <form id="almacenForm">
          <input type="hidden" id="idAlmacen" name="idAlmacen">
          
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <label for="nombre">Nombre <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" id="ubicacion" name="ubicacion" style="height: 100px" required></textarea>
                <label for="ubicacion">Ubicación <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="estado" name="estado">
                  <option value="Activo">Activo</option>
                  <option value="Inactivo">Inactivo</option>
                </select>
                <label for="estado">Estado</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="$('#almacenModal').modal('hide')">
          <i class="fas fa-times me-2"></i>Cancelar
        </button>
        <button type="button" class="btn btn-primary" id="btnGuardarAlmacen">
          <i class="fas fa-save me-2"></i>Guardar
        </button>
      </div>
    </div>
  </div>
</div>

<style>
/* Estilos específicos para el modal de almacén */
#almacenModal .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#almacenModal .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#almacenModal .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}

#almacenModal .modal-body {
  padding: 25px;
}

#almacenModal .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}
#almacenModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#almacenModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#almacenModal .form-floating > .form-control,
#almacenModal .form-floating > .form-select {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#almacenModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#almacenModal .form-floating > .form-control:focus,
#almacenModal .form-floating > .form-select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#almacenModal .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#almacenModal .form-floating > .form-control:focus ~ label,
#almacenModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#almacenModal .form-floating > .form-select ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#almacenModal .text-danger {
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
    // Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#almacenModal').modal('hide');
    });
$(document).ready(function() {
    // Manejar el clic en el botón Guardar
    $('#btnGuardarAlmacen').click(function() {
        // Validar el formulario
        if ($('#almacenForm')[0].checkValidity()) {
            // Obtener los datos del formulario
            let formData = {
                idAlmacen: $('#idAlmacen').val(),
                nombre: $('#nombre').val(),
                ubicacion: $('#ubicacion').val(),
                estado: $('#estado').val()
            };
            
            // Enviar los datos al servidor
            $.ajax({
                url: '../almacen/guardar.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Cerrar el modal
                    $('#almacenModal').modal('hide');
                    
                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        title: 'Éxito',
                        text: 'El almacén ha sido guardado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        // Recargar la página después de cerrar el alert
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Mostrar SweetAlert de error
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error al guardar el almacén: ' + error,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        } else {
            // Mostrar SweetAlert si el formulario no es válido
            Swal.fire({
                title: 'Advertencia',
                text: 'Por favor complete todos los campos requeridos',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
        }
    });
    
    // Limpiar el modal cuando se cierre
    $('#almacenModal').on('hidden.bs.modal', function () {
        $('#almacenForm')[0].reset();
        $('#idAlmacen').val('');
        $('#almacenModalLabel').text('Nuevo Almacén');
    });
});

// Función para editar un almacén (puedes llamarla desde tu tabla)
function editarAlmacen(idAlmacen, nombre, ubicacion, estado) {
    $('#idAlmacen').val(idAlmacen);
    $('#nombre').val(nombre);
    $('#ubicacion').val(ubicacion);
    $('#estado').val(estado);
    $('#almacenModalLabel').text('Editar Almacén');
    $('#almacenModal').modal('show');
}
</script>