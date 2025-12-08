<!-- Modal Editar Configuración Empresa - Diseño Moderno -->
<div class="modal fade" id="modalEditarConfiguracionEmpresa" tabindex="-1" aria-labelledby="editarConfigLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarConfigLabel" style="font-size: 23px; color:black">
          <i class="fas fa-building me-2"></i>Editar Configuración de Empresa
        </h5>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditarConfiguracionEmpresa" enctype="multipart/form-data" method="POST" action="">
        <div class="modal-body">
          <input type="hidden" name="id_configuracion" id="id_configuracion">
          <input type="hidden" id="firma-actual" name="firma-actual">
          <input type="hidden" id="logo-actual" name="logo-actual">

          <div class="section-divider">
            <span>Información Básica</span>
          </div>

          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" required>
                <label for="nombre_empresa">Nombre de la Empresa <span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="ruc" id="ruc" required>
                <label for="ruc">RUC <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>

          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="direccion" id="direccion" required>
                <label for="direccion">Dirección <span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="telefono" id="telefono" required>
                <label for="telefono">Teléfono <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>

          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
              <div class="form-floating">
                <input type="email" class="form-control" name="correo" id="correo" required>
                <label for="correo">Correo Electrónico <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>

          <div class="section-divider mt-4">
            <span>Imágenes</span>
          </div>

          <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body">
                  <div class="form-floating">
                    <div class="input-group">
                      <input type="file" class="form-control d-none" name="firmas" id="firmas" accept="image/*">
                      <input type="text" class="form-control" id="firmas-text" placeholder="Seleccionar archivo" readonly>
                      <button class="btn btn-outline-primary" type="button" id="btn-firmas">
                        <i class="fas fa-folder-open me-2"></i>Seleccionar
                      </button>
                    </div>
                    <label class="mt-2">Firma de la Empresa</label>
                  </div>
                  <div class="mt-3 text-center">
                    <img id="firma-preview" src="" alt="Firma actual" class="img-thumbnail" style="max-width: 200px; max-height: 120px;">
                    <small class="text-muted d-block mt-1">Imagen actual</small>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body">
                  <div class="form-floating">
                    <div class="input-group">
                      <input type="file" class="form-control d-none" name="logo" id="logo" accept="image/*">
                      <input type="text" class="form-control" id="logo-text" placeholder="Seleccionar archivo" readonly>
                      <button class="btn btn-outline-primary" type="button" id="btn-logo">
                        <i class="fas fa-folder-open me-2"></i>Seleccionar
                      </button>
                    </div>
                    <label class="mt-2">Logo de la Empresa</label>
                  </div>
                  <div class="mt-3 text-center">
                    <img id="logo-preview" src="" alt="Logo actual" class="img-thumbnail" style="max-width: 200px; max-height: 120px;">
                    <small class="text-muted d-block mt-1">Imagen actual</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-2"></i>Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Actualizar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
/* Estilos para el modal de configuración de empresa */
#modalEditarConfiguracionEmpresa .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#modalEditarConfiguracionEmpresa .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#modalEditarConfiguracionEmpresa .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}

#modalEditarConfiguracionEmpresa .modal-body {
  padding: 25px;
}

#modalEditarConfiguracionEmpresa .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#modalEditarConfiguracionEmpresa .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}

#modalEditarConfiguracionEmpresa .section-divider span {
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

#modalEditarConfiguracionEmpresa .section-divider:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: var(--light-gray);
  z-index: 0;
}

#modalEditarConfiguracionEmpresa .form-floating > .form-control,
#modalEditarConfiguracionEmpresa .form-floating > .form-select {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#modalEditarConfiguracionEmpresa .form-floating > .form-control:focus,
#modalEditarConfiguracionEmpresa .form-floating > .form-select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#modalEditarConfiguracionEmpresa .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#modalEditarConfiguracionEmpresa .form-floating > .form-control:focus ~ label,
#modalEditarConfiguracionEmpresa .form-floating > .form-control:not(:placeholder-shown) ~ label,
#modalEditarConfiguracionEmpresa .form-floating > .form-select ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#modalEditarConfiguracionEmpresa .text-danger {
  color: var(--danger-color) !important;
}

#modalEditarConfiguracionEmpresa .card {
  border-radius: var(--border-radius);
  transition: var(--transition);
}

#modalEditarConfiguracionEmpresa .card:hover {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

#modalEditarConfiguracionEmpresa .img-thumbnail {
  border-radius: var(--border-radius);
  background-color: var(--light-gray);
  border: 1px dashed var(--gray-color);
  padding: 5px;
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

.mt-4 {
  margin-top: 1.5rem !important;
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

.btn-outline-primary {
  border-color: var(--primary-color);
  color: var(--primary-color);
}

.btn-outline-primary:hover {
  background-color: var(--primary-color);
  color: white;
}

/* Estilos para elementos readonly */
input[readonly], select[readonly] {
  background-color: var(--light-gray);
  border-color: var(--light-gray);
  cursor: not-allowed;
}

/* Estilos para el input group */
.input-group-text {
  background-color: var(--light-gray);
  color: var(--gray-color);
  border-color: var(--light-gray);
}
#modalEditarConfiguracionEmpresa .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarConfiguracionEmpresa .modal-title::after {
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
<script>
    $(document).ready(function() {
  // Manejar el botón de selección de archivos para firma
  $('#btn-firmas').click(function() {
    $('#firmas').click();
  });

  // Manejar el botón de selección de archivos para logo
  $('#btn-logo').click(function() {
    $('#logo').click();
  });

  // Mostrar nombre de archivo seleccionado para firma
  $('#firmas').change(function() {
    if (this.files && this.files[0]) {
      $('#firmas-text').val(this.files[0].name);
      
      // Mostrar vista previa
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#firma-preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }
  });

  // Mostrar nombre de archivo seleccionado para logo
  $('#logo').change(function() {
    if (this.files && this.files[0]) {
      $('#logo-text').val(this.files[0].name);
      
      // Mostrar vista previa
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#logo-preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }
  });

  // Manejar el click para editar configuración
  $(document).on('click', '.editar-configuracion', function() {
    var id_configuracion = $(this).data('id');

    $.ajax({
      url: '../configuracion/obtener.php',
      method: 'GET',
      data: { id_configuracion: id_configuracion },
      dataType: 'json',
      success: function(data) {
        if (data.error) {
          Swal.fire('Error', data.error, 'error');
        } else {
          $('#id_configuracion').val(data.id_configuracion);
          $('#nombre_empresa').val(data.nombre_empresa);
          $('#ruc').val(data.ruc);
          $('#direccion').val(data.direccion);
          $('#telefono').val(data.telefono);
          $('#correo').val(data.correo);
          
          // Manejar imágenes
          if (data.firmas) {
            $('#firma-actual').val(data.firmas);
            $('#firma-preview').attr('src', 'empresa/' + data.firmas);
          }
          if (data.logo) {
            $('#logo-actual').val(data.logo);
            $('#logo-preview').attr('src', 'empresa/' + data.logo);
          }

          // Mostrar el modal
          $('#modalEditarConfiguracionEmpresa').modal('show');
        }
      },
      error: function() {
        Swal.fire('Error', 'No se pudo obtener la configuración', 'error');
      }
    });
  });

 // Manejar el envío del formulario
$('#formEditarConfiguracionEmpresa').submit(function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    Swal.fire({
        title: 'Actualizando configuración',
        text: 'Por favor espere...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: '../configuracion/actualizar.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.success) {
                Swal.fire({
                    title: 'Éxito',
                    text: response.message || 'Configuración actualizada correctamente',
                    icon: 'success'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Error', response.error || 'Error desconocido al actualizar', 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            
            try {
                // Intentamos parsear la respuesta aunque falle
                var response = JSON.parse(xhr.responseText);
                Swal.fire('Error', response.error || 'Error en la respuesta del servidor', 'error');
            } catch (e) {
                Swal.fire('Error', 'Error al procesar la respuesta del servidor: ' + error, 'error');
            }
            
            console.error('Error en la petición:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
        }
    });
});
    })
</script>