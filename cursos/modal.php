<!-- Modal de Cursos para Conductores -->
<div class="modal fade" id="cursoModal" tabindex="-1" aria-labelledby="cursoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cursoModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-truck-moving me-2"></i><span id="modalTitle">Nuevo Curso para Conductores</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cursoForm">
                    <input type="hidden" id="idCurso">
                    
                    <div class="section-divider">
                        <span>Información del Curso</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" placeholder="Nombre del Curso" required>
                                <label for="nombre_curso">
                                    <i class="fas fa-book me-2"></i>Nombre del Curso <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="entidad" name="entidad" placeholder="Entidad Certificadora" required>
                                <label for="entidad">
                                    <i class="fas fa-university me-2"></i>Entidad Certificadora <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del Curso" style="height: 120px" required></textarea>
                                <label for="descripcion">
                                    <i class="fas fa-align-left me-2"></i>Descripción del Curso <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Activado" selected>Activado</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>
                                <label for="estado">
                                    <i class="fas fa-power-off me-2"></i>Estado del Curso <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Guardar Curso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de cursos */
#cursoModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#cursoModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#cursoModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#cursoModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#cursoModal .modal-body {
    padding: 25px;
}

#cursoModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para iconos en labels */
.form-floating label i {
    color: var(--primary-color);
    width: 20px;
    text-align: center;
    margin-right: 5px;
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
    document.getElementById('cursoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('../cursos/guardar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: data.message,
                confirmButtonColor: '#1a365d'
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error || 'Ocurrió un error al guardar el curso',
                confirmButtonColor: '#1a365d'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error en la conexión: ' + error.message,
            confirmButtonColor: '#1a365d'
        });
    });
});

</script>
