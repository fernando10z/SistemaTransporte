<!-- Modal para Tarifas - Diseño Moderno -->
<div class="modal fade" id="tarifaModal" tabindex="-1" aria-labelledby="tarifaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header  text-white">
                <h5 class="modal-title d-flex align-items-center" id="tarifaModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-tags me-2"></i>Registrar Nueva Tarifa
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tarifaForm">
                <input type="hidden" id="idTarifa" name="idTarifa">
                <div class="modal-body p-4">
                    <div class="section-divider">
                        <span>Información de Tarifa</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <!-- Servicio -->
                            <div class="mb-3">
                                <label for="servicioInfo" class="form-label">Servicio <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="servicioInfo" readonly>
                                    <input type="hidden" id="idServicio" name="idServicio">
                                    <button class="btn btn-primary" type="button" id="btnBuscarServicio">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                                <small class="text-muted" id="tipoCargaInfo"></small>
                            </div>
                            
                            <!-- Monto -->
                            <div class="form-floating">
                                <input type="number" class="form-control" id="monto" name="monto" placeholder="Monto (S/)" step="0.01" min="0" required>
                                <label for="monto">Monto (S/) <span class="text-danger">*</span></label>
                            </div>
                            
                            <!-- Fecha Vigencia -->
                            <div class="form-floating mt-3">
                                <input type="date" class="form-control" id="fechaVigencia" name="fechaVigencia" placeholder="Fecha de Vigencia">
                                <label for="fechaVigencia">Fecha de Vigencia</label>
                            </div>
                        </div>
                        
                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Zona -->
                            <div class="mb-3">
                                <label for="zonaInfo" class="form-label">Zona de Cobertura <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="zonaInfo" readonly>
                                    <input type="hidden" id="idZona" name="idZona">
                                    <button class="btn btn-primary" type="button" id="btnBuscarZona">
                                        <i class="fas fa-search me-1"></i> Buscar
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Detalles Zona -->
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="departamentoInfo" placeholder="Departamento" readonly>
                                        <label for="departamentoInfo">Departamento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="provinciaInfo" placeholder="Provincia" readonly>
                                        <label for="provinciaInfo">Provincia</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mt-2">
                                <input type="text" class="form-control" id="distritoInfo" placeholder="Distrito" readonly>
                                <label for="distritoInfo">Distrito</label>
                            </div>
                            
                            <!-- Estado -->
                            <div class="form-floating mt-3">
                                <select class="form-select" id="Estado" name="Estado" required>
                                    <option value="Activo" selected>Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="Estado">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <!-- Observaciones -->
                    <div class="form-floating animate__animated animate__fadeInUp animate__delay-1s">
                        <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones" style="height: 100px"></textarea>
                        <label for="observaciones">Observaciones</label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Tarifa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Buscar Servicios - Diseño Moderno -->
<div class="modal fade" id="serviciosModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fas fa-concierge-bell me-2"></i>Seleccionar Servicio
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control" id="buscarServicio" placeholder="Buscar servicio...">
                        <button class="btn btn-primary" type="button" id="btnFiltrarServicios">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaServicios">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo de Carga</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Zonas - Diseño Moderno -->
<div class="modal fade" id="zonasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fas fa-map-marked-alt me-2"></i>Seleccionar Zona
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control" id="buscarZona" placeholder="Buscar zona...">
                        <button class="btn btn-primary" type="button" id="btnFiltrarZonas">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaZonas">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Zona</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos personalizados para los modales de tarifas */
#tarifaModal .modal-content,
#serviciosModal .modal-content,
#zonasModal .modal-content {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

#tarifaModal .modal-header,
#serviciosModal .modal-header,
#zonasModal .modal-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

#tarifaModal .modal-title,
#serviciosModal .modal-title,
#zonasModal .modal-title {
  font-size: 1.25rem;
  font-weight: 600;
}

#tarifaModal .modal-body,
#serviciosModal .modal-body,
#zonasModal .modal-body {
  padding: 1.5rem;
}

#tarifaModal .modal-footer,
#serviciosModal .modal-footer,
#zonasModal .modal-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid #f0f0f0;
}
#tarifaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#tarifaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
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
.form-floating > .form-control,
.form-floating > .form-select {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid #edf2f9;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.form-floating > textarea.form-control {
  height: 100px;
  min-height: 100px;
  padding-top: 1.5rem;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
  border-color: #5d87ff;
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

.form-floating > label {
  padding: 1rem 0.75rem;
  color: #8492a6;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
  color: #5d87ff;
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para tablas */
.table {
  --bs-table-bg: transparent;
  --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
  --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
  margin-bottom: 0;
}

.table thead th {
  background-color: #edf2f9;
  color: #334d6e;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
  background-color: #edf2f9;
}

/* Botones */
.btn-primary {
  background-color: #5d87ff;
  border-color: #5d87ff;
  padding: 0.5rem 1.25rem;
}

.btn-primary:hover {
  background-color: #4569cb;
  border-color: #4569cb;
}

.btn-outline-secondary {
  border-color: #edf2f9;
  color: #8492a6;
  padding: 0.5rem 1.25rem;
}

.btn-outline-secondary:hover {
  background-color: #edf2f9;
  color: #334d6e;
}

.btn-info {
  background-color: #539BFF;
  border-color: #539BFF;
}

/* Elementos readonly */
input[readonly], select[readonly] {
  background-color: #f8f9fe;
  border-color: #edf2f9;
  cursor: not-allowed;
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
    // Obtener la fecha actual en formato YYYY-MM-DD
    const today = new Date();
    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Los meses empiezan en 0
    const year = today.getFullYear();
    const todayFormatted = `${year}-${month}-${day}`;
    
    // Establecer la fecha mínima como hoy y el valor por defecto como hoy
    $('#fechaVigencia').attr('min', todayFormatted);
    $('#fechaVigencia').val(todayFormatted);
    
    // Validar cuando se intenta cambiar manualmente la fecha
    $('#fechaVigencia').on('change', function() {
        const selectedDate = new Date(this.value);
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Eliminar la parte de la hora para comparar solo fechas
        
    });
});
</script>
<script>
    $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#monto').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
</script>
<script>
$(document).ready(function() {
    // Variables globales para almacenar datos
    var serviciosData = [];
    var zonasData = [];
    
    // Abrir modal principal
    $('#nuevaTarifaBtn').click(function() {
        $('#tarifaForm')[0].reset();
        $('#idTarifa').val('');
        $('#tarifaModalLabel').text('Registrar Nueva Tarifa');
        $('#tarifaModal').modal('show');
    });

    // ============ SERVICIOS ============
    // Buscar servicios
    $('#btnBuscarServicio').click(function() {
        cargarServicios();
        $('#serviciosModal').modal('show');
    });

    // Cargar servicios
    function cargarServicios(filtro = '') {
        $.ajax({
            url: '../tarifa/servicios.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    serviciosData = response.data;
                    filtrarServicios(filtro);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar los servicios', 'error');
            }
        });
    }

    // Filtrar servicios
    function filtrarServicios(filtro) {
        var tbody = $('#tablaServicios tbody');
        tbody.empty();
        
        var datosFiltrados = serviciosData;
        
        if(filtro) {
            filtro = filtro.toLowerCase();
            datosFiltrados = serviciosData.filter(function(servicio) {
                return servicio.nombreServicio.toLowerCase().includes(filtro) || 
                       servicio.tipoCarga.toLowerCase().includes(filtro);
            });
        }
        
        if(datosFiltrados.length === 0) {
            tbody.append('<tr><td colspan="3" class="text-center">No se encontraron resultados</td></tr>');
        } else {
            $.each(datosFiltrados, function(index, servicio) {
                tbody.append(`
                    <tr>
                        <td>${servicio.nombreServicio}</td>
                        <td>${servicio.tipoCarga}</td>
                        <td>
                            <button class="btn btn-sm btn-success seleccionar-servicio" 
                                    data-id="${servicio.idServicio}"
                                    data-nombre="${servicio.nombreServicio}"
                                    data-tipo="${servicio.tipoCarga}">
                                <i class="fas fa-check"></i> Seleccionar
                            </button>
                        </td>
                    </tr>
                `);
            });
        }
    }

    // Evento para filtrar servicios
    $('#btnFiltrarServicios').click(function() {
        filtrarServicios($('#buscarServicio').val());
    });

    // Filtrar al escribir en el buscador
    $('#buscarServicio').keyup(function() {
        filtrarServicios($(this).val());
    });

    // Seleccionar servicio
    $(document).on('click', '.seleccionar-servicio', function() {
        $('#idServicio').val($(this).data('id'));
        $('#servicioInfo').val($(this).data('nombre'));
        $('#tipoCargaInfo').text('Tipo de carga: ' + $(this).data('tipo'));
        $('#serviciosModal').modal('hide');
    });

    // ============ ZONAS ============
    // Buscar zonas
    $('#btnBuscarZona').click(function() {
        cargarZonas();
        $('#zonasModal').modal('show');
    });

    // Cargar zonas
    function cargarZonas(filtro = '') {
        $.ajax({
            url: '../tarifa/zonas.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    zonasData = response.data;
                    filtrarZonas(filtro);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar las zonas', 'error');
            }
        });
    }

    // Filtrar zonas
    function filtrarZonas(filtro) {
        var tbody = $('#tablaZonas tbody');
        tbody.empty();
        
        var datosFiltrados = zonasData;
        
        if(filtro) {
            filtro = filtro.toLowerCase();
            datosFiltrados = zonasData.filter(function(zona) {
                return zona.nombreZona.toLowerCase().includes(filtro) || 
                       zona.departamento.toLowerCase().includes(filtro) ||
                       zona.provincia.toLowerCase().includes(filtro) ||
                       zona.distrito.toLowerCase().includes(filtro);
            });
        }
        
        if(datosFiltrados.length === 0) {
            tbody.append('<tr><td colspan="5" class="text-center">No se encontraron resultados</td></tr>');
        } else {
            $.each(datosFiltrados, function(index, zona) {
                tbody.append(`
                    <tr>
                        <td>${zona.nombreZona}</td>
                        <td>${zona.departamento}</td>
                        <td>${zona.provincia}</td>
                        <td>${zona.distrito}</td>
                        <td>
                            <button class="btn btn-sm btn-success seleccionar-zona" 
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
        }
    }

    // Evento para filtrar zonas
    $('#btnFiltrarZonas').click(function() {
        filtrarZonas($('#buscarZona').val());
    });

    // Filtrar al escribir en el buscador
    $('#buscarZona').keyup(function() {
        filtrarZonas($(this).val());
    });

    // Seleccionar zona
    $(document).on('click', '.seleccionar-zona', function() {
        $('#idZona').val($(this).data('id'));
        $('#zonaInfo').val($(this).data('nombre'));
        $('#departamentoInfo').val($(this).data('departamento'));
        $('#provinciaInfo').val($(this).data('provincia'));
        $('#distritoInfo').val($(this).data('distrito'));
        $('#zonasModal').modal('hide');
    });

    // ============ GUARDAR TARIFA ============
    $('#tarifaForm').submit(function(e) {
        e.preventDefault();
        
        if(!$('#idServicio').val()) {
            Swal.fire('Error', 'Debe seleccionar un servicio', 'error');
            return;
        }
        
        if(!$('#idZona').val()) {
            Swal.fire('Error', 'Debe seleccionar una zona', 'error');
            return;
        }
        
        $.ajax({
            url: '../tarifa/guardar.php',
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
                $('.btn-primary').prop('disabled', false).html('Guardar Tarifa');
            },
            error: function() {
                Swal.fire('Error', 'Error al comunicarse con el servidor', 'error');
            }
        });
    });
});
</script>