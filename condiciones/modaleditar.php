<!-- Modal Editar Término - Diseño Moderno -->
<div class="modal fade" id="modalEditarTermino" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <form id="formEditarTermino">
        <div class="modal-header  text-white">
          <h5 class="modal-title d-flex align-items-center" id="modalEditarLabel" style="font-size: 23px; color:black">
            <i class="fas fa-edit me-2"></i>Editar Término
          </h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <input type="hidden" name="id_terminos" id="edit_id_terminos">

          <div class="section-divider mb-4">
            <span>Información del Término</span>
          </div>

          <div class="mb-4 animate__animated animate__fadeInUp">
            <div class="form-floating">
              <input type="text" class="form-control" id="edit_titulo" name="titulo" placeholder="Título" required>
              <label for="edit_titulo">Título <span class="text-danger">*</span></label>
            </div>
          </div>

          <div class="mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="form-floating">
              <textarea class="form-control" id="edit_contenido" name="contenido" placeholder="Contenido" style="height: 200px" required></textarea>
              <label for="edit_contenido">Contenido <span class="text-danger">*</span></label>
            </div>
          </div>

          <div class="mb-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="form-floating">
              <input type="number" class="form-control" id="edit_orden" name="orden" placeholder="Orden" required min="1">
              <label for="edit_orden">Orden <span class="text-danger">*</span></label>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-2"></i>Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
/* Estilos personalizados para el modal de edición */
#modalEditarTermino .modal-content {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

#modalEditarTermino .modal-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

#modalEditarTermino .modal-title {
  font-size: 1.25rem;
  font-weight: 600;
}

#modalEditarTermino .modal-body {
  padding: 1.5rem;
}

#modalEditarTermino .modal-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid #f0f0f0;
}

/* Estilos para sección divisora */
.section-divider {
  position: relative;
  text-align: center;
  margin: 2rem 0 1.5rem;
  overflow: hidden;
}

.section-divider span {
  position: relative;
  display: inline-block;
  padding: 0 1rem;
  background-color: #fff;
  color: #5d87ff;
  font-weight: 600;
  font-size: 0.875rem;
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
  background-color: #edf2f9;
  z-index: 0;
}

/* Estilos para formularios */
#modalEditarTermino .form-floating > .form-control,
#modalEditarTermino .form-floating > .form-select {
  height: auto;
  min-height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid #edf2f9;
  border-radius: 8px;
  transition: all 0.3s ease;
}

#modalEditarTermino .form-floating > textarea.form-control {
  height: 200px;
  min-height: 200px;
  padding-top: 1.5rem;
}

#modalEditarTermino .form-floating > .form-control:focus,
#modalEditarTermino .form-floating > .form-select:focus {
  border-color: #5d87ff;
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#modalEditarTermino .form-floating > label {
  padding: 1rem 0.75rem;
  color: #8492a6;
}

#modalEditarTermino .form-floating > .form-control:focus ~ label,
#modalEditarTermino .form-floating > .form-control:not(:placeholder-shown) ~ label,
#modalEditarTermino .form-floating > .form-select ~ label {
  color: #5d87ff;
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Botones */
#modalEditarTermino .btn-primary {
  background-color: #5d87ff;
  border-color: #5d87ff;
  padding: 0.5rem 1.25rem;
}
#modalEditarTermino .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarTermino .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#modalEditarTermino .btn-primary:hover {
  background-color: #4569cb;
  border-color: #4569cb;
}

#modalEditarTermino .btn-outline-secondary {
  border-color: #edf2f9;
  color: #8492a6;
  padding: 0.5rem 1.25rem;
}

#modalEditarTermino .btn-outline-secondary:hover {
  background-color: #edf2f9;
  color: #334d6e;
}

/* Texto requerido */
.text-danger {
  color: #f55252 !important;
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
</style>
<script>
    // Cargar datos al modal
$(document).on('click', '.btnEditarTermino', function () {
  const id = $(this).data('id');

  $.post('../condiciones/obtener.php', { id_terminos: id }, function (response) {
    const res = JSON.parse(response);
    if (res.success) {
      $('#edit_id_terminos').val(res.data.id_terminos);
      $('#edit_titulo').val(res.data.titulo);
      $('#edit_contenido').val(res.data.contenido);
      $('#edit_orden').val(res.data.orden);
      $('#modalEditarTermino').modal('show');
    } else {
      Swal.fire('Error', res.message, 'error');
    }
  });
});

// Enviar cambios
$('#formEditarTermino').submit(function (e) {
  e.preventDefault();
  const formData = $(this).serialize();

  $.post('../condiciones/actualizar.php', formData, function (response) {
    const res = JSON.parse(response);
    if (res.success) {
      Swal.fire({
        icon: 'success',
        title: '¡Actualizado!',
        text: res.message,
        timer: 2000,
        showConfirmButton: false
      }).then(() => {
        location.reload();
      });
    } else {
      Swal.fire('Error', res.message, 'error');
    }
  });
});

</script>