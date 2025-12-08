<!-- Modal Editar Curso -->
<div class="modal fade" id="cursoModalEditar" tabindex="-1" aria-labelledby="cursoModalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cursoModalEditarLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Curso
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cursoFormEditar">
                    <input type="hidden" id="idCursoEditar">
                    
                    <div class="section-divider">
                        <span>Información del Curso</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre_cursoEditar" placeholder="Nombre del Curso" required>
                                <label for="nombre_cursoEditar">
                                    <i class="fas fa-book me-2"></i>Nombre del Curso <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="entidadEditar" placeholder="Entidad Certificadora" required>
                                <label for="entidadEditar">
                                    <i class="fas fa-university me-2"></i>Entidad Certificadora <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcionEditar" placeholder="Descripción del Curso" style="height: 120px" required></textarea>
                                <label for="descripcionEditar">
                                    <i class="fas fa-align-left me-2"></i>Descripción <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estadoEditar" required>
                                    <option value="Activado">Activado</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>
                                <label for="estadoEditar">
                                    <i class="fas fa-power-off me-2"></i>Estado <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de edición de cursos */
#cursoModalEditar .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#cursoModalEditar .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}
#cursoModalEditar .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#cursoModalEditar .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#cursoModalEditar .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#cursoModalEditar .modal-body {
    padding: 25px;
}

#cursoModalEditar .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
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

/* Estilos para los formularios flotantes */
.form-floating > .form-control,
.form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para secciones divididas */
.section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

.section-divider span {
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

.section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

/* Estilos para iconos en labels */
.form-floating label i {
    color: var(--primary-color);
    width: 20px;
    text-align: center;
    margin-right: 5px;
}

/* Estilos para textarea */
textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

/* Estilos para botones */
.btn-outline-secondary {
    border-color: var(--gray-color);
    color: var(--gray-color);
}

.btn-outline-secondary:hover {
    background-color: var(--gray-color);
    color: white;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}
</style>
<script>
$(document).ready(function() {
    // Manejar clic en botón editar
    $(document).on('click', '.editar-curso', function() {
        var idCurso = $(this).data('id');
        console.log('Intentando editar curso ID:', idCurso); // Para depuración
        
        // Obtener datos del curso
        $.ajax({
            url: '../cursos/obtener.php',
            type: 'GET',
            data: { id: idCurso },
            dataType: 'json',
            success: function(response) {
                console.log('Respuesta recibida:', response); // Para depuración
                if (!response.error) {
                    // Llenar el formulario de edición
                    $('#idCursoEditar').val(response.idCurso);
                    $('#nombre_cursoEditar').val(response.nombre_curso);
                    $('#entidadEditar').val(response.entidad);
                    $('#descripcionEditar').val(response.descripcion);
                    $('#estadoEditar').val(response.estado);
                    
                    // Mostrar el modal
                    $('#cursoModalEditar').modal('show');
                } else {
                    Swal.fire('Error', response.error, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', error);
                Swal.fire('Error', 'No se pudieron obtener los datos del curso', 'error');
            }
        });
    });
    
    // Manejar envío del formulario de edición
    $('#cursoFormEditar').submit(function(e) {
        e.preventDefault();
        
        var formData = {
            idCurso: $('#idCursoEditar').val(),
            nombre_curso: $('#nombre_cursoEditar').val(),
            entidad: $('#entidadEditar').val(),
            descripcion: $('#descripcionEditar').val(),
            estado: $('#estadoEditar').val()
        };
        
        $.ajax({
            url: '../cursos/actualizar.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire('Éxito', response.success, 'success').then(() => {
                        $('#cursoModalEditar').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.error, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Error al actualizar el curso: ' + error, 'error');
            }
        });
    });
});
</script>