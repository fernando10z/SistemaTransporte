<!-- Modal para Editar Tarifa - Diseño Moderno -->
<div class="modal fade" id="editarTarifaModal" tabindex="-1" role="dialog" aria-labelledby="editarTarifaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarTarifaModalLabel" style="font-size: 23px; color:black">
    <i class="fas fa-pen-square me-2"></i>Editar Tarifa
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarTarifaModal').modal('hide')"></button>
            </div>
            <form id="editarTarifaForm">
                <input type="hidden" id="edit_idTarifa" name="idTarifa">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Información de Tarifa</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">                             
                               <label for="edit_servicioInfo">Servicio <span class="text-danger">*</span></label>
                            <!-- Servicio -->
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="edit_servicioInfo"readonly>
                                    <input type="hidden" id="edit_idServicio" name="idServicio">
                                    <button class="btn btn-outline-primary" type="button" id="edit_btnBuscarServicio">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <small class="form-text text-muted" id="edit_tipoCargaInfo"></small>
                            </div>
                            
                            <!-- Monto -->
                            <div class="form-floating mt-3">
                                <input type="number" class="form-control" id="edit_monto" name="monto" placeholder="Monto (S/)" step="0.01" min="0" required>
                                <label for="edit_monto">Monto (S/) <span class="text-danger">*</span></label>
                            </div>
                            
                            <!-- Fecha Vigencia -->
                            <div class="form-floating mt-3">
                                <input type="date" class="form-control" id="edit_fechaVigencia" name="fechaVigencia" placeholder="Fecha de Vigencia">
                                <label for="edit_fechaVigencia">Fecha de Vigencia</label>
                            </div>
                        </div>
                        
                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Zona -->                         
                              <label for="edit_zonaInfo">Zona de Cobertura <span class="text-danger">*</span></label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="edit_zonaInfo" readonly>
                                    <input type="hidden" id="edit_idZona" name="idZona">
                                    <button class="btn btn-outline-primary" type="button" id="edit_btnBuscarZona">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Detalles Zona -->
                            <div class="row g-2 mt-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="edit_departamentoInfo" placeholder="Departamento" readonly>
                                        <label for="edit_departamentoInfo">Departamento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="edit_provinciaInfo" placeholder="Provincia" readonly>
                                        <label for="edit_provinciaInfo">Provincia</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mt-2">
                                <input type="text" class="form-control" id="edit_distritoInfo" placeholder="Distrito" readonly>
                                <label for="edit_distritoInfo">Distrito</label>
                            </div>
                            
                            <!-- Estado -->
                            <div class="form-floating mt-3">
                                <select class="form-select" id="edit_Estado" name="Estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="edit_Estado">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <!-- Observaciones -->
                    <div class="form-floating animate__animated animate__fadeInUp animate__delay-1s">
                        <textarea class="form-control" id="edit_observaciones" name="observaciones" placeholder="Observaciones" style="height: 100px"></textarea>
                        <label for="edit_observaciones">Observaciones</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#editarTarifaModal').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Actualizar Tarifa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Buscar Servicios (Estilo Moderno) -->
<div class="modal fade modal-search" id="serviciosModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-list me-2"></i>Seleccionar Servicio
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#serviciosModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <!-- Barra de búsqueda -->
                <div class="form-floating mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="buscarServicioEdit" placeholder="Buscar servicio...">
                        <button class="btn btn-primary" type="button" id="btnFiltrarServiciosEdit">
                            <i class="fas fa-search me-1"></i> Filtrar
                        </button>
                    </div>
                    <label for="buscarServicioEdit">Buscar servicio</label>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaServiciosEdit">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo de Carga</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Zonas (Estilo Moderno) -->
<div class="modal fade modal-search" id="zonasModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-map-marked-alt me-2"></i>Seleccionar Zona
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#zonasModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <!-- Barra de búsqueda -->
                <div class="form-floating mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="buscarZonaEdit" placeholder="Buscar zona...">
                        <button class="btn btn-primary" type="button" id="btnFiltrarZonasEdit">
                            <i class="fas fa-search me-1"></i> Filtrar
                        </button>
                    </div>
                    <label for="buscarZonaEdit">Buscar zona</label>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaZonasEdit">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre Zona</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th width="120px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de edición de tarifa */
#editarTarifaModal .modal-content,
#serviciosModal .modal-content,
#zonasModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarTarifaModal .modal-header,
#serviciosModal .modal-header,
#zonasModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}


#serviciosModal .modal-title,
#zonasModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}
#editarTarifaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarTarifaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 50px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

#editarTarifaModal .modal-body,
#serviciosModal .modal-body,
#zonasModal .modal-body {
    padding: 25px;
}

#editarTarifaModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#editarTarifaModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#editarTarifaModal .section-divider span {
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

#editarTarifaModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

/* Estilos para tablas en modales de búsqueda */
#serviciosModal .table,
#zonasModal .table {
    margin-bottom: 0;
}

#serviciosModal .table th,
#zonasModal .table th {
    border-top: none;
    font-weight: 600;
    color: var(--dark-color);
    background-color: var(--light-gray);
}

#serviciosModal .table td,
#zonasModal .table td {
    vertical-align: middle;
}

/* Estilos para botones de acción en tablas */
.btn-table-action {
    padding: 5px 10px;
    font-size: 13px;
}

/* Estilos para inputs de búsqueda */
.modal-search .form-floating > .form-control {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
}

.modal-search .input-group .btn {
    height: 56px;
    border-radius: 0 8px 8px 0;
}

/* Variables CSS (deben estar definidas globalmente) */
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
    $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#edit_monto').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
</script>
<style>
    /* Asegurar que los modales de búsqueda aparezcan sobre el modal principal */
    #serviciosModal, #zonasModal {
        z-index: 1060 !important; /* Bootstrap modal z-index es 1050 por defecto */
    }
    
    /* Fondo oscuro para el modal de búsqueda */
    .modal-backdrop.show {
        opacity: 0.5;
    }
    
    /* Asegurar que el modal de búsqueda no herede el backdrop del modal principal */
    .modal.modal-search {
        z-index: 1061;
    }
</style>
<script>
$(document).ready(function() {
    // Abrir modal de edición con el botón especificado
    $(document).on('click', '.editar-tarifa', function() {
        var idTarifa = $(this).data('id');
        
        $.ajax({
            url: '../tarifa/obtener.php',
            type: 'POST',
            data: {id: idTarifa},
            dataType: 'json',
            beforeSend: function() {
                // Mostrar spinner de carga si es necesario
            },
            success: function(response) {
                if(response.success) {
                    // Llenar los campos del formulario
                    $('#edit_idTarifa').val(response.data.idTarifa);
                    $('#edit_idServicio').val(response.data.idServicio);
                    $('#edit_servicioInfo').val(response.data.nombreServicio);
                    $('#edit_tipoCargaInfo').text('Tipo de carga: ' + response.data.tipoCarga);
                    $('#edit_idZona').val(response.data.idZona);
                    $('#edit_zonaInfo').val(response.data.nombreZona);
                    $('#edit_departamentoInfo').val(response.data.departamento);
                    $('#edit_provinciaInfo').val(response.data.provincia);
                    $('#edit_distritoInfo').val(response.data.distrito);
                    $('#edit_monto').val(response.data.monto);
                    $('#edit_observaciones').val(response.data.observaciones);
                    $('#edit_Estado').val(response.data.Estado);
                    
                    // =============================================
                    // MANEJO ESPECÍFICO DE FECHA DE VIGENCIA
                    // =============================================
                    const fechaVigenciaBD = response.data.fechaVigencia;
                    
                    // 1. Establecer la fecha actual de la BD
                    $('#edit_fechaVigencia').val(fechaVigenciaBD);
                    
                    // 2. Configurar fecha mínima como la fecha de vigencia actual
                    if (fechaVigenciaBD) {
                        $('#edit_fechaVigencia').attr('min', fechaVigenciaBD);
                    }
                    
                    // 3. Validar si el usuario intenta cambiar manualmente
                    $('#edit_fechaVigencia').off('change').on('change', function() {
                        if (fechaVigenciaBD && this.value < fechaVigenciaBD) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fecha no permitida',
                                text: 'No puedes seleccionar una fecha anterior a la vigencia actual (' + fechaVigenciaBD + ')',
                                confirmButtonText: 'Entendido'
                            });
                            this.value = fechaVigenciaBD; // Revertir al valor original
                        }
                    });
                    // =============================================
                    
                    // Mostrar el modal
                    $('#editarTarifaModal').modal('show');
                } else {
                    Swal.fire('Error', response.message || 'Error al cargar la tarifa', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });


    // Buscar servicios (para edición)
    $('#edit_btnBuscarServicio').click(function() {
        $.ajax({
            url: '../tarifa/servicios.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    var tbody = $('#tablaServicios tbody');
                    tbody.empty();
                    
                    $.each(response.data, function(index, servicio) {
                        tbody.append(`
                            <tr>
                                <td>${servicio.nombreServicio}</td>
                                <td>${servicio.tipoCarga}</td>
                                <td>
                                    <button class="btn btn-sm btn-success seleccionar-servicio-edit" 
                                            data-id="${servicio.idServicio}"
                                            data-nombre="${servicio.nombreServicio}"
                                            data-tipo="${servicio.tipoCarga}">
                                        <i class="fas fa-check"></i> Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                    
                    $('#serviciosModal').modal('show');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar los servicios', 'error');
            }
        });
    });

    // Seleccionar servicio (para edición)
    $(document).on('click', '.seleccionar-servicio-edit', function() {
        $('#edit_idServicio').val($(this).data('id'));
        $('#edit_servicioInfo').val($(this).data('nombre'));
        $('#edit_tipoCargaInfo').text('Tipo de carga: ' + $(this).data('tipo'));
        $('#serviciosModal').modal('hide');
    });

    // Buscar zonas (para edición)
    $('#edit_btnBuscarZona').click(function() {
        $.ajax({
            url: '../tarifa/zonas.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    var tbody = $('#tablaZonas tbody');
                    tbody.empty();
                    
                    $.each(response.data, function(index, zona) {
                        tbody.append(`
                            <tr>
                                <td>${zona.nombreZona}</td>
                                <td>${zona.departamento}</td>
                                <td>${zona.provincia}</td>
                                <td>${zona.distrito}</td>
                                <td>
                                    <button class="btn btn-sm btn-success seleccionar-zona-edit" 
                                            data-id="${zona.idZona}"
                                            data-nombre="${zona.nombreZona}"
                                            data-departamento="${zona.departamento}"
                                            data-provincia="${zona.provincia}"
                                            data-distrito="${zona.distrito}">
                                        <i class="fas fa-check"></i> Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                    
                    $('#zonasModal').modal('show');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar las zonas', 'error');
            }
        });
    });

    // Seleccionar zona (para edición)
    $(document).on('click', '.seleccionar-zona-edit', function() {
        $('#edit_idZona').val($(this).data('id'));
        $('#edit_zonaInfo').val($(this).data('nombre'));
        $('#edit_departamentoInfo').val($(this).data('departamento'));
        $('#edit_provinciaInfo').val($(this).data('provincia'));
        $('#edit_distritoInfo').val($(this).data('distrito'));
        $('#zonasModal').modal('hide');
    });

    // Enviar formulario de edición
    $('#editarTarifaForm').submit(function(e) {
        e.preventDefault();
        
        if(!$('#edit_idServicio').val()) {
            Swal.fire('Error', 'Debe seleccionar un servicio', 'error');
            return;
        }
        
        if(!$('#edit_idZona').val()) {
            Swal.fire('Error', 'Debe seleccionar una zona', 'error');
            return;
        }
        
        $.ajax({
            url: '../tarifa/actualizar.php',
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
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            complete: function() {
                $('.btn-primary').prop('disabled', false).html('Actualizar Tarifa');
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });
});
</script>
