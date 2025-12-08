<!-- Modal Editar Vehículo - Diseño Moderno -->
<div class="modal fade" id="editarVehiculoModal" tabindex="-1" aria-labelledby="editarVehiculoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarVehiculoModalLabel" style="font-size: 23px; color:black">
          <i class="fas fa-edit me-2"></i>Editar Vehículo
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarVehiculo">
          <input type="hidden" id="idVehiculoEdit" name="idVehiculo">
          
          <div class="section-divider">
            <span>Información Básica</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="placaEdit" name="placa" readonly placeholder="Placa">
                <label for="placaEdit">Placa <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: ABC-123</small>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="marcaEdit" name="marca" required placeholder="Marca">
                <label for="marcaEdit">Marca <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: Volvo</small>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="modeloEdit" name="modelo" required placeholder="Modelo">
                <label for="modeloEdit">Modelo <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: FH16</small>
              </div>
            </div>
            
            <div class="col-md-6">
                              <label for="zonaCoberturaEdit">Zona de Cobertura <span class="text-danger">*</span></label>

              <div class="form-floating">
                <div class="input-group">
                  <input type="text" class="form-control" id="zonaCoberturaEdit" name="zonaCobertura" readonly placeholder="Zona de Cobertura">
                  <button class="btn btn-outline-primary" type="button" onclick="buscarZonasEdit()">
                    <i class="fas fa-search me-1"></i> Buscar
                  </button>
                </div>
                <input type="hidden" id="idZonaEdit" name="idZona">
              </div>
            </div>
          </div>
          
          <div class="section-divider mt-4">
            <span>Capacidades</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" step="0.01" class="form-control" id="capacidadPesoEdit" name="capacidadPeso" required placeholder="Capacidad de Peso">
                <label for="capacidadPesoEdit">Capacidad de Peso (kg) <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: 10000.50</small>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" step="0.01" class="form-control" id="capacidadVolumenEdit" name="capacidadVolumen" required placeholder="Capacidad de Volumen">
                <label for="capacidadVolumenEdit">Capacidad de Volumen (m³) <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: 50.75</small>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-floating">
                <div class="input-group">
                  <span class="input-group-text">S/</span>
                  <input type="number" step="0.01" class="form-control" id="MontoEdit" name="monto" required placeholder="Monto">
                </div>
                <small class="form-text text-muted">Ej: 1500.00</small>
              </div>
            </div>
          </div>
          
          <div class="section-divider mt-4">
            <span>Estado</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" id="estadoEdit" name="estado" required>
                  <option value="Disponible">Disponible</option>
                  <option value="Ocupado">Ocupado</option>
                  <option value="Mantenimiento">En Mantenimiento</option>
                </select>
                <label for="estadoEdit">Estado <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-2"></i> Cancelar
        </button>
        <button type="button" class="btn btn-primary" onclick="actualizarVehiculo()">
          <i class="fas fa-save me-2"></i> Actualizar Vehículo
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para buscar zonas - Diseño Moderno -->
<div class="modal fade" id="buscarZonasModalEdit" tabindex="-1" aria-labelledby="buscarZonasModalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buscarZonasModalEditLabel">
          <i class="fas fa-map-marked-alt me-2"></i>Buscar Zonas de Cobertura
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="section-divider">
          <span>Filtros de Búsqueda</span>
        </div>
        
        <div class="row g-3 animate__animated animate__fadeInUp">
          <div class="col-md-8">
            <div class="form-floating">
              <div class="input-group">
                <input type="text" class="form-control" id="searchZonaInputEdit" placeholder="Buscar zonas...">
                <button class="btn btn-primary" type="button" onclick="filtrarZonasEdit()">
                  <i class="fas fa-search me-1"></i> Buscar
                </button>
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-check form-switch mt-3">
              <input class="form-check-input" type="checkbox" id="filterActivosEdit" checked>
              <label class="form-check-label" for="filterActivosEdit">Mostrar solo zonas activas</label>
            </div>
          </div>
        </div>
        
        <div class="section-divider mt-4">
          <span>Resultados</span>
        </div>
        
        <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th>Zona</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th width="120px">Acción</th>
              </tr>
            </thead>
            <tbody id="zonasTableBodyEdit">
              <!-- Las zonas se cargarán aquí dinámicamente -->
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
/* Estilos específicos para el modal de edición de vehículo */
#editarVehiculoModal .modal-content,
#buscarZonasModalEdit .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#editarVehiculoModal .modal-header,
#buscarZonasModalEdit .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#editarVehiculoModal .modal-title,
#buscarZonasModalEdit .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}

#editarVehiculoModal .modal-body,
#buscarZonasModalEdit .modal-body {
  padding: 25px;
}

#editarVehiculoModal .modal-footer,
#buscarZonasModalEdit .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#editarVehiculoModal .section-divider,
#buscarZonasModalEdit .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}

#editarVehiculoModal .section-divider span,
#buscarZonasModalEdit .section-divider span {
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

#editarVehiculoModal .section-divider:before,
#buscarZonasModalEdit .section-divider:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: var(--light-gray);
  z-index: 0;
}

#editarVehiculoModal .form-floating > .form-control,
#editarVehiculoModal .form-floating > .form-select,
#buscarZonasModalEdit .form-floating > .form-control {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#editarVehiculoModal .form-floating > label,
#buscarZonasModalEdit .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#editarVehiculoModal .form-floating > .form-control:focus ~ label,
#editarVehiculoModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarVehiculoModal .form-floating > .form-select ~ label,
#buscarZonasModalEdit .form-floating > .form-control:focus ~ label,
#buscarZonasModalEdit .form-floating > .form-control:not(:placeholder-shown) ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarVehiculoModal .text-danger,
#buscarZonasModalEdit .text-danger {
  color: var(--danger-color) !important;
}

#editarVehiculoModal .form-text,
#buscarZonasModalEdit .form-text {
  font-size: 12px;
  margin-top: 5px;
  color: var(--gray-color);
}

#editarVehiculoModal .input-group .btn,
#buscarZonasModalEdit .input-group .btn {
  height: 56px;
  border-radius: 0 8px 8px 0;
}

#editarVehiculoModal .input-group .form-control,
#buscarZonasModalEdit .input-group .form-control {
  border-radius: 8px 0 0 8px;
}

#buscarZonasModalEdit .table {
  margin-bottom: 0;
}

#buscarZonasModalEdit .table th {
  border-top: none;
  font-weight: 600;
  color: var(--dark-color);
  background-color: var(--light-gray);
}

#buscarZonasModalEdit .table td {
  vertical-align: middle;
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
#editarVehiculoModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarVehiculoModal .modal-title::after {
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
    // Validar el campo monto para que no acepte valores negativos
    $('#MontoEdit').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
      $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#capacidadVolumenEdit').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
      $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#capacidadPesoEdit').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
</script>
<script>
// Función para abrir el modal de edición con los datos del vehículo
$(document).on('click', '.editar-vehiculo', function() {
    const idVehiculo = $(this).data('id');
    
    fetch(`../vehiculos/obtener.php?id=${idVehiculo}`)
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Llenar datos básicos
            $('#idVehiculoEdit').val(data.vehiculo.idVehiculo);
            $('#placaEdit').val(data.vehiculo.placa);
            $('#marcaEdit').val(data.vehiculo.marca);
            $('#modeloEdit').val(data.vehiculo.modelo);
            $('#capacidadPesoEdit').val(data.vehiculo.capacidadPeso);
            $('#capacidadVolumenEdit').val(data.vehiculo.capacidadVolumen);
            $('#MontoEdit').val(data.vehiculo.monto);
            $('#estadoEdit').val(data.vehiculo.estado);
            
            // Llenar datos de la zona si existen
            if(data.vehiculo.idZona && data.vehiculo.nombreZona) {
                $('#zonaCoberturaEdit').val(data.vehiculo.nombreZona);
                $('#idZonaEdit').val(data.vehiculo.idZona);
            }
            
            $('#editarVehiculoModal').modal('show');
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'No se pudo obtener los datos del vehículo', 'error');
    });
});

// Función para abrir el modal de búsqueda de zonas en edición
function buscarZonasEdit() {
    $('#buscarZonasModalEdit').modal('show');
    cargarZonasEdit();
}

// Función para cargar las zonas en el modal de edición
function cargarZonasEdit(searchTerm = '', soloActivos = true) {
    fetch(`../vehiculos/buscarzona.php?search=${encodeURIComponent(searchTerm)}&activos=${soloActivos ? '1' : '0'}`)
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('zonasTableBodyEdit');
        tableBody.innerHTML = '';
        
        if(data.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center">No se encontraron zonas</td></tr>';
            return;
        }
        
        data.forEach(zona => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${zona.nombreZona}</td>
                <td>${zona.departamento}</td>
                <td>${zona.provincia}</td>
                <td>${zona.distrito}</td>
                <td>${zona.descripcion.substring(0, 50)}${zona.descripcion.length > 50 ? '...' : ''}</td>
                <td><span class="badge ${zona.Estado === 'Activo' ? 'bg-success' : 'bg-secondary'}">${zona.Estado}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="seleccionarZonaEdit(${zona.idZona}, '${zona.nombreZona}')">
                        <i class="fas fa-check"></i> Seleccionar
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Ocurrió un error al cargar las zonas', 'error');
    });
}

// Función para filtrar zonas en edición
function filtrarZonasEdit() {
    const searchTerm = document.getElementById('searchZonaInputEdit').value;
    const soloActivos = document.getElementById('filterActivosEdit').checked;
    cargarZonasEdit(searchTerm, soloActivos);
}

// Función para seleccionar una zona en edición
function seleccionarZonaEdit(idZona, nombreZona) {
    $('#zonaCoberturaEdit').val(nombreZona);
    $('#idZonaEdit').val(idZona);
    $('#buscarZonasModalEdit').modal('hide');
}

// Función para actualizar el vehículo
function actualizarVehiculo() {
    // Validar que se haya seleccionado una zona
    if(!$('#idZonaEdit').val()) {
        Swal.fire('Advertencia', 'Debe seleccionar una zona de cobertura', 'warning');
        return;
    }

    const formData = new FormData(document.getElementById('formEditarVehiculo'));
    
    fetch('../vehiculos/actualizar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Vehículo actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#editarVehiculoModal').modal('hide');
                location.reload();
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Ocurrió un error al actualizar el vehículo', 'error');
    });
}
</script>