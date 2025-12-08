<div class="modal fade" id="registrarConfiguracionModal" tabindex="-1" role="dialog" aria-labelledby="registrarConfiguracionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="registrarConfiguracionModalLabel">Registrar Configuración de Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRegistrarConfiguracion" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_empresa">Nombre de la Empresa *</label>
                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
                            </div>
                            <div class="form-group">
                                <label for="ruc">RUC</label>
                                <input type="text" class="form-control" id="ruc" name="ruc">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo">Logo de la Empresa</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo" accept="image/*">
                                    <label class="custom-file-label" for="logo">Seleccionar archivo</label>
                                </div>
                                <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                <div class="mt-2" id="logo-preview-container" style="display:none;">
                                    <img id="logo-preview" src="#" alt="Vista previa del logo" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firmas">Firma Autorizada</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="firmas" name="firmas" accept="image/*">
                                    <label class="custom-file-label" for="firmas">Seleccionar archivo</label>
                                </div>
                                <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                <div class="mt-2" id="firma-preview-container" style="display:none;">
                                    <img id="firma-preview" src="#" alt="Vista previa de la firma" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Mostrar nombre del archivo seleccionado
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        
        // Mostrar vista previa de la imagen
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            const previewId = $(this).attr('id') + '-preview';
            const containerId = $(this).attr('id') + '-preview-container';
            
            reader.onload = function(e) {
                $('#' + previewId).attr('src', e.target.result);
                $('#' + containerId).show();
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Enviar formulario via AJAX
    $('#formRegistrarConfiguracion').submit(function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '../configuracion/guardar.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error || 'Ocurrió un error al guardar la configuración'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al comunicarse con el servidor: ' + error
                });
            },
            complete: function() {
                $('button[type="submit"]').prop('disabled', false).html('Guardar Configuración');
            }
        });
    });
});
</script>