<!-- Modal para Editar Servicio - Diseño Moderno -->
<div class="modal fade" id="editarServicioModal" tabindex="-1" role="dialog" aria-labelledby="editarServicioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarServicioModalLabel" style="font-size: 24px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Servicio
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarServicioModal').modal('hide')"></button>
            </div>
            <form id="editarServicioForm">
                <input type="hidden" id="edit_idServicio" name="idServicio">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Información del Servicio</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_nombreServicio" name="nombreServicio" placeholder="Nombre del Servicio" required>
                                <label for="edit_nombreServicio">Nombre del Servicio <span class="text-danger">*</span></label>
                            <small class="form-text text-muted">Ingrese un nombre descriptivo</small>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="edit_descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="edit_descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Configuración del Servicio</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_tipoCarga" name="tipoCarga" required>
                                    <option value="General">General</option>
                                    <option value="Perecible">Perecible</option>
                                    <option value="Peligrosa">Peligrosa</option>
                                    <option value="Refrigerada">Refrigerada</option>
                                    <option value="Voluminosa">Voluminosa</option>
                                </select>
                                <label for="edit_tipoCarga">Tipo de Carga <span class="text-danger">*</span></label>
                            </div>
                        </div>
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
                    <button type="button" class="btn btn-outline-secondary animate__animated animate__fadeInLeft" onclick="$('#editarServicioModal').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary animate__animated animate__fadeInRight">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de edición de servicio */
#editarServicioModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarServicioModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}
#editarServicioModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarServicioModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}


#editarServicioModal .modal-body {
    padding: 25px;
}

#editarServicioModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#editarServicioModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#editarServicioModal .section-divider span {
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

#editarServicioModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#editarServicioModal .form-floating > .form-control,
#editarServicioModal .form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#editarServicioModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#editarServicioModal .form-floating > .form-control:focus,
#editarServicioModal .form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarServicioModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#editarServicioModal .form-floating > .form-control:focus ~ label,
#editarServicioModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarServicioModal .form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarServicioModal .text-danger {
    color: var(--danger-color) !important;
}
#editarServicioModal .form-text {
    font-size: 12px;
    margin-top: 5px;
    color: var(--gray-color);
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

.mt-4 {
    margin-top: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}
</style>
<script>
$(document).ready(function() {
    // Abrir modal de edición con los datos del servicio
    $(document).on('click', '.editar-servicio', function() {
        var idServicio = $(this).data('id');
        
        $.ajax({
            url: '../servicio/obtener.php',
            type: 'POST',
            data: {id: idServicio},
            dataType: 'json',
            beforeSend: function() {
                // Mostrar carga si es necesario
            },
            success: function(response) {
                if(response.success) {
                    var servicio = response.data;
                    
                    $('#edit_idServicio').val(servicio.idServicio);
                    $('#edit_nombreServicio').val(servicio.nombreServicio);
                    $('#edit_descripcion').val(servicio.descripcion);
                    $('#edit_tipoCarga').val(servicio.tipoCarga);
                    $('#edit_Estado').val(servicio.Estado);
                    
                    $('#editarServicioModal').modal('show');
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar los datos', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });
    // Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#editarServicioModal').modal('hide');
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

    // Enviar formulario de edición
    $(document).ready(function() {
    // Enviar formulario de edición
    $('#editarServicioForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '../servicio/actualizar.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#editarServicioModal .btn-primary').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        $('#editarServicioModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            complete: function() {
                $('#editarServicioModal .btn-primary').prop('disabled', false).html('Guardar Cambios');
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });
});
    // Efectos de focus en los inputs
    $('#editarServicioModal input, #editarServicioModal select, #editarServicioModal textarea').focus(function() {
        $(this).addClass('shadow-sm').parent().addClass('text-primary');
    }).blur(function() {
        $(this).removeClass('shadow-sm').parent().removeClass('text-primary');
    });

    // Animación al cerrar el modal
    $('#editarServicioModal').on('hide.bs.modal', function () {
        $(this).find('.form-group, .modal-footer button').removeClass('animate__animated animate__fadeInUp animate__fadeInLeft animate__fadeInRight');
    });
});
</script>