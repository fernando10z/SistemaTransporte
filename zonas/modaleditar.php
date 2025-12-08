<!-- Modal para Editar Zona - Diseño Moderno -->
<div class="modal fade" id="editarZonaModal" tabindex="-1" role="dialog" aria-labelledby="editarZonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarZonaModalLabel" style="font-size: 22px; color:black">
                    <i class="fas fa-map-marker-alt me-2"></i>Editar Zona de Cobertura
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarZonaModal').modal('hide')"></button>
            </div>
            <form id="editarZonaForm">
                <input type="hidden" id="edit_idZona" name="idZona">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Ubicación Geográfica</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_nombreZona" name="nombreZona" placeholder="Nombre de Zona" required>
                                <label for="edit_nombreZona">Nombre de Zona <span class="text-danger">*</span></label>
                                <small class="form-text text-muted">Ejemplo: Zona Norte, Zona Centro, etc.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_departamento" name="departamento" placeholder="Departamento" required>
                                <label for="edit_departamento">Departamento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_provincia" name="provincia" placeholder="Provincia" required>
                                <label for="edit_provincia">Provincia <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_distrito" name="distrito" placeholder="Distrito" required>
                                <label for="edit_distrito">Distrito <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="edit_descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="edit_descripcion">Descripción</label>
                                <small class="form-text text-muted">Detalles adicionales sobre la zona</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_Estado" name="Estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="edit_Estado">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#editarZonaModal').modal('hide')">
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
/* Estilos específicos para el modal de edición de zona */
#editarZonaModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarZonaModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#editarZonaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarZonaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 50px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#editarZonaModal .modal-body {
    padding: 25px;
}

#editarZonaModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#editarZonaModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#editarZonaModal .section-divider span {
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

#editarZonaModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#editarZonaModal .form-floating > .form-control,
#editarZonaModal .form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#editarZonaModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#editarZonaModal .form-floating > .form-control:focus,
#editarZonaModal .form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarZonaModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#editarZonaModal .form-floating > .form-control:focus ~ label,
#editarZonaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarZonaModal .form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarZonaModal .text-danger {
    color: var(--danger-color) !important;
}

#editarZonaModal .form-text {
    font-size: 12px;
    margin-top: 5px;
    color: var(--gray-color);
}
</style>
<!-- Script para edición -->
<script>
$(document).ready(function() {
    // Abrir modal de edición
    $(document).on('click', '.editar-zona', function() {
        var idZona = $(this).data('id');
        
        $.ajax({
            url: '../zonas/obtener.php',
            type: 'POST',
            data: {id: idZona},
            dataType: 'json',
            beforeSend: function() {
                // Mostrar spinner si es necesario
            },
            success: function(response) {
                if(response.success) {
                    $('#edit_idZona').val(response.data.idZona);
                    $('#edit_nombreZona').val(response.data.nombreZona);
                    $('#edit_departamento').val(response.data.departamento);
                    $('#edit_provincia').val(response.data.provincia);
                    $('#edit_distrito').val(response.data.distrito);
                    $('#edit_descripcion').val(response.data.descripcion);
                    $('#edit_Estado').val(response.data.Estado);
                    
                    $('#editarZonaModal').modal('show');
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar la zona', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });

    // Enviar formulario de edición
    $('#editarZonaForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '../zonas/actualizar.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-primary').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            complete: function() {
                $('.btn-primary').prop('disabled', false).html('Guardar Cambios');
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });
});
</script>