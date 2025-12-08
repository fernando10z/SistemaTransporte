<!-- Modal Registrar Curso para Conductor -->
<div class="modal fade" id="registrarCursoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 23px; color:black">
                    <i class="fas fa-certificate me-2"></i>Registrar Curso para Conductor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrarCursoForm">
                    <div class="section-divider">
                        <span>Información del Registro</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-6">
                             <label for="buscarConductor">Conductor <span class="text-danger">*</span></label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="buscarConductor" placeholder="Buscar conductor" readonly>
                                    <input type="hidden" id="idConductor">
                                    <button class="btn btn-outline-primary" type="button" id="btnBuscarConductor">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <div id="conductorInfo" class="info-display small text-muted mt-1 d-none">
                                    <small>Conductor seleccionado:</small>
                                    <div id="conductorSelected" class="fw-bold"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                                    <label for="buscarCurso">Curso <span class="text-danger">*</span></label>

                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="buscarCurso" placeholder="Buscar curso" readonly>
                                    <input type="hidden" id="idCurso">
                                    <button class="btn btn-outline-primary" type="button" id="btnBuscarCurso">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <div id="cursoInfo" class="info-display small text-muted mt-1 d-none">
                                    <small>Curso seleccionado:</small>
                                    <div id="cursoSelected" class="fw-bold"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaInicio" placeholder="Fecha de Inicio" required>
                                <label for="fechaInicio">Fecha de Inicio <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaFinal" placeholder="Fecha de Finalización">
                                <label for="fechaFinal">Fecha de Finalización</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="Observacion" placeholder="Observaciones" style="height: 100px"></textarea>
                                <label for="Observacion">Observaciones</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Guardar Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar conductores -->
<div class="modal fade" id="buscarConductorModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-users me-2"></i>Buscar Conductor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Filtros de Búsqueda</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchConductorInput" placeholder="Escriba nombre, apellido o licencia...">
                                <button class="btn btn-outline-primary" type="button" id="searchConductorBtn">
                                    <i class="fas fa-search me-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="conductoresTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Licencia</th>
                                <th>Teléfono</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="conductoresResults">
                            <!-- Resultados de búsqueda aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar cursos -->
<div class="modal fade" id="buscarCursoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    <i class="fas fa-book me-2"></i>Buscar Curso
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-divider">
                    <span>Filtros de Búsqueda</span>
                </div>
                
                <div class="row g-3 animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="form-floating">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchCursoInput" placeholder="Escriba nombre del curso o entidad...">
                                <button class="btn btn-outline-primary" type="button" id="searchCursoBtn">
                                    <i class="fas fa-search me-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
                    <table class="table table-hover" id="cursosTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Curso</th>
                                <th>Entidad</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cursosResults">
                            <!-- Resultados de búsqueda aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modales de cursos para conductores */
#registrarCursoModal .modal-content,
#buscarConductorModal .modal-content,
#buscarCursoModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#registrarCursoModal .modal-header,
#buscarConductorModal .modal-header,
#buscarCursoModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#registrarCursoModal .modal-title,
#buscarConductorModal .modal-title,
#buscarCursoModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#registrarCursoModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#registrarCursoModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#buscarConductorModal .modal-title::after,
#buscarCursoModal .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#registrarCursoModal .modal-body,
#buscarConductorModal .modal-body,
#buscarCursoModal .modal-body {
    padding: 25px;
}

#registrarCursoModal .modal-footer,
#buscarConductorModal .modal-footer,
#buscarCursoModal .modal-footer {
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

/* Estilos para los botones de búsqueda */
.input-group .btn-outline-primary {
    height: 56px;
    border-radius: 0 8px 8px 0;
}

.input-group .form-control {
    border-radius: 8px 0 0 8px;
}

/* Estilos para tablas */
.table {
    margin-bottom: 0;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: var(--dark-color);
    background-color: var(--light-gray);
}

.table td {
    vertical-align: middle;
}

/* Estilos para textarea */
textarea.form-control {
    min-height: 100px;
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

/* Estilos para información de selección */
.info-display {
    padding: 8px;
    background-color: var(--light-gray);
    border-radius: 4px;
    margin-top: 5px;
}
</style>
<script>
    $(document).ready(function() {
    // Validación para fechas de seguro
    $('#fechaInicio').change(function() {
        const fechaInicio = new Date($(this).val());
        const fechaVencimientoInput = $('#fechaFinal');
        
        if ($(this).val()) {
            // Establecer la fecha mínima para el vencimiento
            fechaVencimientoInput.attr('min', $(this).val());
            
            // Si la fecha de vencimiento ya tiene un valor y es anterior, corregirla
            if (fechaVencimientoInput.val()) {
                const fechaVencimiento = new Date(fechaVencimientoInput.val());
                if (fechaVencimiento < fechaInicio) {
                    fechaVencimientoInput.val($(this).val());
                    mostrarFeedbackError(fechaVencimientoInput);
                }
            }
        }
    });
    
    // Validación en tiempo real
    $('#fechaFinal').on('input change', function() {
        const fechaInicio = $('#fechaInicio').val();
        const fechaVencimiento = $(this).val();
        
        if (fechaInicio && fechaVencimiento) {
            const dateInicio = new Date(fechaInicio);
            const dateVencimiento = new Date(fechaVencimiento);
            
            if (dateVencimiento < dateInicio) {
                $(this).val(fechaInicio);
                mostrarFeedbackError($(this));
            }
        }
    });
    
    // Función para mostrar feedback visual
    function mostrarFeedbackError(elemento) {
        // Efecto visual de error
        elemento.addClass('is-invalid');
        setTimeout(() => elemento.removeClass('is-invalid'), 1000);
        
        // Efecto de animación
        elemento.css('transform', 'translateX(5px)');
        setTimeout(() => {
            elemento.css('transform', 'translateX(-5px)');
            setTimeout(() => elemento.css('transform', ''), 100);
        }, 100);
    }
});
</script>
<script>
$(document).ready(function() {
    // Abrir modal de búsqueda de conductores
    $('#btnBuscarConductor').click(function() {
        $('#buscarConductorModal').modal('show');
        $('#searchConductorInput').val('').focus();
        buscarConductores();
    });

    // Abrir modal de búsqueda de cursos
    $('#btnBuscarCurso').click(function() {
        $('#buscarCursoModal').modal('show');
        $('#searchCursoInput').val('').focus();
        buscarCursos();
    });

    // Buscar conductores
    function buscarConductores() {
        const search = $('#searchConductorInput').val();
        
        $.ajax({
            url: '../registro/buscarconductores.php',
            type: 'GET',
            data: { search: search },
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.length > 0) {
                    response.forEach(conductor => {
                        html += `
                            <tr>
                                <td>${conductor.nombre_completo}</td>
                                <td>${conductor.licencia}</td>
                                <td>${conductor.telefono}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary seleccionar-conductor" 
                                        data-id="${conductor.idConductor}"
                                        data-nombre="${conductor.nombre_completo}">
                                        <i class="fas fa-check"></i> Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="4" class="text-center">No se encontraron conductores</td></tr>';
                }
                $('#conductoresResults').html(html);
            },
            error: function(xhr, status, error) {
                console.error("Error al buscar conductores:", error);
                Swal.fire('Error', 'No se pudo realizar la búsqueda de conductores', 'error');
            }
        });
    }

    // Buscar cursos
    function buscarCursos() {
        const search = $('#searchCursoInput').val();
        
        $.ajax({
            url: '../registro/buscarcusos.php',
            type: 'GET',
            data: { search: search },
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.length > 0) {
                    response.forEach(curso => {
                        html += `
                            <tr>
                                <td>${curso.nombre_curso}</td>
                                <td>${curso.entidad}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary seleccionar-curso" 
                                        data-id="${curso.idCurso}"
                                        data-nombre="${curso.nombre_curso} - ${curso.entidad}">
                                        <i class="fas fa-check"></i> Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="3" class="text-center">No se encontraron cursos</td></tr>';
                }
                $('#cursosResults').html(html);
            },
            error: function(xhr, status, error) {
                console.error("Error al buscar cursos:", error);
                Swal.fire('Error', 'No se pudo realizar la búsqueda de cursos', 'error');
            }
        });
    }

    // Evento de búsqueda de conductores
    $('#searchConductorBtn').click(function() {
        buscarConductores();
    });

    $('#searchConductorInput').keyup(function(e) {
        if (e.key === 'Enter') {
            buscarConductores();
        }
    });

    // Evento de búsqueda de cursos
    $('#searchCursoBtn').click(function() {
        buscarCursos();
    });

    $('#searchCursoInput').keyup(function(e) {
        if (e.key === 'Enter') {
            buscarCursos();
        }
    });

    // Seleccionar conductor
    $(document).on('click', '.seleccionar-conductor', function() {
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');
        
        $('#idConductor').val(id);
        $('#buscarConductor').val(nombre);
        $('#conductorInfo').removeClass('d-none');
        $('#conductorSelected').text(nombre);
        $('#buscarConductorModal').modal('hide');
    });

    // Seleccionar curso
    $(document).on('click', '.seleccionar-curso', function() {
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');
        
        $('#idCurso').val(id);
        $('#buscarCurso').val(nombre);
        $('#cursoInfo').removeClass('d-none');
        $('#cursoSelected').text(nombre);
        $('#buscarCursoModal').modal('hide');
    });

    // Guardar nuevo registro
    $('#registrarCursoForm').submit(function(e) {
        e.preventDefault();
        
        const formData = {
            idConductor: $('#idConductor').val(),
            idCurso: $('#idCurso').val(),
            fechaInicio: $('#fechaInicio').val(),
            fechaFinal: $('#fechaFinal').val(),
            Observacion: $('#Observacion').val()
        };
        
        // Validación
        if (!formData.idConductor || !formData.idCurso || !formData.fechaInicio) {
            Swal.fire({
                title: 'Error',
                text: 'Debe seleccionar un conductor, un curso y especificar la fecha de inicio',
                icon: 'error',
                confirmButtonText: 'Entendido'
            });
            return;
        }
        
        // Validar fecha final no sea menor a fecha inicio
        if (formData.fechaFinal && new Date(formData.fechaFinal) < new Date(formData.fechaInicio)) {
            Swal.fire({
                title: 'Error',
                text: 'La fecha final no puede ser anterior a la fecha de inicio',
                icon: 'error',
                confirmButtonText: 'Entendido'
            });
            return;
        }
        
        Swal.fire({
            title: '¿Guardar registro?',
            text: "¿Desea guardar este registro de curso?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../registro/guardar.php',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Registro exitoso',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                $('#registrarCursoModal').modal('hide');
                                location.reload(); // Recargar la página
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.error,
                                icon: 'error',
                                confirmButtonText: 'Entendido'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al guardar el registro: ' + error,
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                    }
                });
            }
        });
    });

    // Limpiar formulario al cerrar modal
    $('#registrarCursoModal').on('hidden.bs.modal', function () {
        $('#registrarCursoForm')[0].reset();
        $('#idConductor').val('');
        $('#idCurso').val('');
        $('#conductorInfo').addClass('d-none');
        $('#cursoInfo').addClass('d-none');
    });
});
</script>