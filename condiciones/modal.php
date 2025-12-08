<!-- Modal Registrar Términos y Condiciones - Diseño Moderno -->
<div class="modal fade" id="modalRegistrarTermino" tabindex="-1" aria-labelledby="tituloModalTermino" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <form id="formRegistrarTermino">
        <div class="modal-header text-white">
          <h5 class="modal-title d-flex align-items-center" id="tituloModalTermino" style="font-size: 23px; color:black">
            <i class="fas fa-file-contract me-2"></i>Registrar Término y Condición
          </h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body p-4">
          <div class="mb-4 animate__animated animate__fadeInUp">
            <div class="form-floating">
              <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
              <label for="titulo">Título <span class="text-danger">*</span></label>
            </div>
          </div>
          <div class="mb-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="form-floating">
              <textarea class="form-control" id="contenido" name="contenido" placeholder="Contenido" style="height: 200px" required></textarea>
              <label for="contenido">Contenido <span class="text-danger">*</span></label>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-2"></i>Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
/* Estilos personalizados para el modal de términos y condiciones */
#modalRegistrarTermino .modal-content {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

#modalRegistrarTermino .modal-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

#modalRegistrarTermino .modal-title {
  font-size: 1.25rem;
  font-weight: 600;
}

#modalRegistrarTermino .modal-body {
  padding: 1.5rem;
}

#modalRegistrarTermino .modal-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid #f0f0f0;
}
#modalRegistrarTermino .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalRegistrarTermino .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
/* Estilos para formularios */
#modalRegistrarTermino .form-floating > .form-control,
#modalRegistrarTermino .form-floating > .form-select {
  height: auto;
  min-height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid #edf2f9;
  border-radius: 8px;
  transition: all 0.3s ease;
}

#modalRegistrarTermino .form-floating > textarea.form-control {
  height: 200px;
  min-height: 200px;
  padding-top: 1.5rem;
}

#modalRegistrarTermino .form-floating > .form-control:focus,
#modalRegistrarTermino .form-floating > .form-select:focus {
  border-color: #5d87ff;
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#modalRegistrarTermino .form-floating > label {
  padding: 1rem 0.75rem;
  color: #8492a6;
}

#modalRegistrarTermino .form-floating > .form-control:focus ~ label,
#modalRegistrarTermino .form-floating > .form-control:not(:placeholder-shown) ~ label,
#modalRegistrarTermino .form-floating > .form-select ~ label {
  color: #5d87ff;
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Botones */
#modalRegistrarTermino .btn-primary {
  background-color: #5d87ff;
  border-color: #5d87ff;
  padding: 0.5rem 1.25rem;
}

#modalRegistrarTermino .btn-primary:hover {
  background-color: #4569cb;
  border-color: #4569cb;
}

#modalRegistrarTermino .btn-outline-secondary {
  border-color: #edf2f9;
  color: #8492a6;
  padding: 0.5rem 1.25rem;
}

#modalRegistrarTermino .btn-outline-secondary:hover {
  background-color: #edf2f9;
  color: #334d6e;
}

/* Animaciones */
.animate__animated {
  animation-duration: 0.5s;
}

.animate__fadeInUp {
  animation-name: fadeInUp;
}

.animate__delay-1s {
  animation-delay: 0.2s;
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

/* Texto requerido */
.text-danger {
  color: #f55252 !important;
}
</style>
<script>
 $(document).ready(function() {
  $('#formRegistrarTermino').submit(function(e) {
    e.preventDefault();

    const formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '../condiciones/guardar.php',
      data: formData,
      dataType: 'json', // esto evita tener que hacer JSON.parse manual
      success: function(response) {
        if (response.success) {
          Swal.fire({
            icon: 'success',
            title: '¡Guardado!',
            text: response.message,
            timer: 2000,
            showConfirmButton: false
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message || 'No se pudo guardar',
          });
        }
      },
      error: function(xhr) {
        // Mostrar el error si viene con HTML inesperado o error del servidor
        let errorMsg = 'Error de conexión con el servidor.';
        if (xhr.responseText) {
          try {
            const json = JSON.parse(xhr.responseText);
            errorMsg = json.message || errorMsg;
          } catch (e) {
            console.error('Respuesta no válida:', xhr.responseText);
          }
        }
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: errorMsg,
        });
      }
    });
  });
});

</script>
