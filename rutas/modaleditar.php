<!-- Modal Editar Ruta -->
<div class="modal fade" id="editarRutaModal" tabindex="-1" aria-labelledby="editarRutaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarRutaModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-route me-2"></i>Editar Ruta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarRuta" action="../rutas/actualizar.php" method="POST">
                <input type="hidden" id="edit_idRuta" name="idRuta">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Información Básica</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_origen" name="origen" placeholder="Origen" required>
                                <label for="edit_origen">Origen <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_destino" name="destino" placeholder="Destino" required>
                                <label for="edit_destino">Destino <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" id="edit_distancia_km" name="distancia_km" placeholder="Distancia (km)" required>
                                <label for="edit_distancia_km">Distancia (km) <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="edit_tiempo_estimado" name="tiempo_estimado" placeholder="Tiempo Estimado" required>
                                <label for="edit_tiempo_estimado">Tiempo Estimado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Detalles Adicionales</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="edit_descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="edit_descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="edit_idZona" name="edit_idZona" placeholder="Zona de Cobertura" readonly required>
                                    <input type="hidden" id="edit_idZonaHidden" name="idZonaHidden">
                                    <button class="btn btn-outline-primary" type="button" id="btnEditBuscarZona">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <label for="edit_idZona">Zona de Cobertura <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="edit_estado" name="estado">
                                    <option value="Activado" selected>Activado</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>
                                <label for="edit_estado">Estado</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Buscar Zona para Edición -->
<div class="modal fade" id="zonaEditSearchModal" tabindex="-1" aria-labelledby="zonaEditSearchModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="zonaEditSearchModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-map-marked-alt me-2"></i>Buscar Zona de Cobertura
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
                                <input type="text" class="form-control" id="editSearchZonaInput" placeholder="Buscar zona por nombre, departamento, provincia o distrito">
                                <button class="btn btn-outline-primary" type="button" id="btnEditSearchZona">
                                    <i class="fas fa-search me-1"></i> Buscar
                                </button>
                            </div>
                            <label for="editSearchZonaInput">Buscar zona</label>
                        </div>
                    </div>
                </div>
                
                <div class="section-divider mt-4">
                    <span>Resultados</span>
                </div>
                
                <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover">
                        <thead class="thead-light" style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Estado</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="zonaEditTableBody">
                            <!-- Los resultados de la búsqueda se cargarán aquí -->
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
/* Estilos específicos para los modales de edición de ruta */
#editarRutaModal .modal-content,
#zonaEditSearchModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarRutaModal .modal-header,
#zonaEditSearchModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#editarRutaModal .modal-title,
#zonaEditSearchModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#editarRutaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#zonaEditSearchModal .modal-title::after {
    content: '';
    position: absolute;
    left: 37px;
    bottom: 16px;
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#editarRutaModal .modal-body,
#zonaEditSearchModal .modal-body {
    padding: 25px;
}

#editarRutaModal .modal-footer,
#zonaEditSearchModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para textarea en formulario flotante */
#edit_descripcion {
    min-height: 100px;
    resize: vertical;
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

/* Estilos para scroll personalizado */
.custom-modal-scroll {
    max-height: 70vh;
    overflow-y: auto;
}

.custom-table-scroll {
    max-height: 60vh;
    overflow-y: auto;
}
#editarRutaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarRutaModal .modal-title::after {
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
    function cargarDatosRuta(idRuta) {
        $.ajax({
            url: '../rutas/obtener.php',
            type: 'GET',
            data: { idRuta: idRuta },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const ruta = response.data;
                    
                    // Rellenar los campos del formulario
                    $('#edit_idRuta').val(ruta.idRuta);
                    $('#edit_origen').val(ruta.origen);
                    $('#edit_destino').val(ruta.destino);
                    $('#edit_distancia_km').val(ruta.distancia_km);
                    $('#edit_tiempo_estimado').val(ruta.tiempo_estimado.substring(0, 5)); // Formato HH:MM
                    $('#edit_descripcion').val(ruta.descripcion);
                    
                    // Usar el nombreZona real obtenido del JOIN
                    $('#edit_idZona').val(ruta.nombreZona);
                    $('#edit_idZonaHidden').val(ruta.idZona); // Guardar el ID real para actualización
                    
                    // Establecer el valor del select de estado
                    $('#edit_estado').val(ruta.estado);
                    
                    $('#editarRutaModal').modal('show');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Error al cargar los datos: ' + error, 'error');
            }
        });
    }
    

    // Mostrar modal de edición cuando se hace clic en tu botón de editar
    $(document).on('click', '.editar-ruta', function() {
        const idRuta = $(this).data('id');
        cargarDatosRuta(idRuta);
    });

    // Mostrar modal de búsqueda de zona para edición
    $('#btnEditBuscarZona').click(function() {
        $('#zonaEditSearchModal').modal('show');
    });
    
    // Buscar zonas al hacer clic en el botón de búsqueda
    $('#btnEditSearchZona').click(function() {
        buscarZonasParaEdicion();
    });
    
    // También buscar al presionar Enter en el campo de búsqueda
    $('#editSearchZonaInput').keypress(function(e) {
        if (e.which == 13) {
            buscarZonasParaEdicion();
            return false;
        }
    });
    
    // Función para buscar zonas (para edición)
    function buscarZonasParaEdicion() {
        const searchTerm = $('#editSearchZonaInput').val();
        
        $.ajax({
            url: '../rutas/buscarzona.php',
            type: 'GET',
            data: { search: searchTerm },
            dataType: 'json',
            success: function(response) {
                let html = '';
                
                if (response.error) {
                    html = `<tr><td colspan="7" class="text-center">Error: ${response.error}</td></tr>`;
                } else if (response.length > 0) {
                    response.forEach(function(zona) {
                        html += `
                            <tr>
                                <td>${zona.idZona}</td>
                                <td>${zona.nombreZona}</td>
                                <td>${zona.departamento}</td>
                                <td>${zona.provincia}</td>
                                <td>${zona.distrito}</td>
                                <td><span class="badge ${zona.Estado === 'Activo' ? 'bg-success' : 'bg-secondary'}">${zona.Estado}</span></td>
                                <td><button class="btn btn-sm btn-primary btnEditSeleccionarZona" data-id="${zona.idZona}" data-nombre="${zona.nombreZona}">Seleccionar</button></td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="7" class="text-center">No se encontraron zonas</td></tr>';
                }
                
                $('#zonaEditTableBody').html(html);
            },
            error: function(xhr, status, error) {
                $('#zonaEditTableBody').html('<tr><td colspan="7" class="text-center">Error al cargar las zonas</td></tr>');
            }
        });
    }

    // Mostrar todas las zonas al abrir el modal de búsqueda para edición
    $('#zonaEditSearchModal').on('show.bs.modal', function() {
        $('#editSearchZonaInput').val('');
        buscarZonasParaEdicion();
    });
    
    // Seleccionar zona y cerrar modal de búsqueda (para edición)
    $(document).on('click', '.btnEditSeleccionarZona', function() {
        const idZona = $(this).data('id');
        const nombreZona = $(this).data('nombre');
        
        $('#edit_idZona').val(nombreZona);
        $('#edit_idZonaHidden').val(idZona);
        $('#zonaEditSearchModal').modal('hide');
    });
    
    // Manejar el envío del formulario de edición con AJAX
   $('#formEditarRuta').submit(function(e) {
    e.preventDefault();
    
    // Obtener el valor del select de estado
    const estado = $('#edit_estado').val();
    const formData = $(this).serializeArray();
    formData.push({name: 'estado', value: estado});
    
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $.param(formData),
        dataType: 'json',
        success: function(response) {
            if (response && response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.message || 'Ruta actualizada correctamente',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response?.message || 'Error desconocido al actualizar',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error en la comunicación con el servidor: ' + error,
                confirmButtonText: 'Aceptar'
            });
        }
    });
});
});
</script>