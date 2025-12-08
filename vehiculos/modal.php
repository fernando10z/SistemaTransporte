<!-- Modal Registrar Vehículo - Diseño Moderno -->
<div class="modal fade" id="registrarVehiculoModal" tabindex="-1" aria-labelledby="registrarVehiculoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrarVehiculoModalLabel" style="font-size: 23px; color:black">
          <i class="fas fa-truck me-2"></i>Registrar Vehículo
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formRegistroVehiculo">
          <div class="section-divider">
            <span>Información Básica</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="placa" name="placa" required placeholder="Placa">
                <label for="placa">Placa <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: ABC-123</small>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="marca" name="marca" required placeholder="Marca">
                <label for="marca">Marca <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: Volvo</small>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="modelo" name="modelo" required placeholder="Modelo">
                <label for="modelo">Modelo <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: FH16</small>
              </div>
            </div>
            
            <div class="col-md-6">
            <label for="zonaCobertura">Zona de Cobertura <span class="text-danger">*</span></label>
              <div class="form-floating">
                <div class="input-group">
                  <input type="text" class="form-control" id="zonaCobertura" name="zonaCobertura" readonly>
                  <button class="btn btn-outline-primary" type="button" onclick="buscarZonas()">
                    <i class="fas fa-search me-1"></i> Buscar
                  </button>
                </div>
                <input type="hidden" id="idZona" name="idZona">
              </div>
            </div>
          </div>
          
          <div class="section-divider mt-4">
            <span>Capacidades</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" step="0.01" class="form-control" id="capacidadPeso" name="capacidadPeso" required placeholder="Capacidad de Peso">
                <label for="capacidadPeso">Capacidad de Peso (kg) <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: 10000.50</small>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" step="0.01" class="form-control" id="capacidadVolumen" name="capacidadVolumen" required placeholder="Capacidad de Volumen">
                <label for="capacidadVolumen">Capacidad de Volumen (m³) <span class="text-danger">*</span></label>
                <small class="form-text text-muted">Ej: 50.75</small>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-floating">
                <div class="input-group">
                  <span class="input-group-text">S/</span>
                  <input type="number" step="0.01" class="form-control" id="Monto" name="Monto" required placeholder="Monto">
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
                <select class="form-select" id="estado" name="estado" required>
                  <option value="Disponible" selected>Disponible</option>
                  <option value="Ocupado">Ocupado</option>
                  <option value="Mantenimiento">En Mantenimiento</option>
                </select>
                <label for="estado">Estado <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-2"></i> Cancelar
        </button>
        <button type="button" class="btn btn-primary" onclick="guardarVehiculo()">
          <i class="fas fa-save me-2"></i> Guardar Vehículo
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para buscar zonas - Diseño Moderno -->
<div class="modal fade" id="buscarZonasModal" tabindex="-1" aria-labelledby="buscarZonasModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buscarZonasModalLabel">
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
                <input type="text" class="form-control" id="searchZonaInput" placeholder="Buscar zonas...">
                <button class="btn btn-primary" type="button" onclick="filtrarZonas()">
                  <i class="fas fa-search me-1"></i> Buscar
                </button>
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-check form-switch mt-3">
              <input class="form-check-input" type="checkbox" id="filterActivos" checked>
              <label class="form-check-label" for="filterActivos">Mostrar solo zonas activas</label>
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
            <tbody id="zonasTableBody">
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
/* Estilos específicos para el modal de vehículo */
#registrarVehiculoModal .modal-content,
#buscarZonasModal .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

#registrarVehiculoModal .modal-header,
#buscarZonasModal .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#registrarVehiculoModal .modal-title,
#buscarZonasModal .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}

#registrarVehiculoModal .modal-body,
#buscarZonasModal .modal-body {
  padding: 25px;
}

#registrarVehiculoModal .modal-footer,
#buscarZonasModal .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#registrarVehiculoModal .section-divider,
#buscarZonasModal .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}

#registrarVehiculoModal .section-divider span,
#buscarZonasModal .section-divider span {
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

#registrarVehiculoModal .section-divider:before,
#buscarZonasModal .section-divider:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: var(--light-gray);
  z-index: 0;
}

#registrarVehiculoModal .form-floating > .form-control,
#registrarVehiculoModal .form-floating > .form-select,
#buscarZonasModal .form-floating > .form-control {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#registrarVehiculoModal .form-floating > label,
#buscarZonasModal .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#registrarVehiculoModal .form-floating > .form-control:focus ~ label,
#registrarVehiculoModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#registrarVehiculoModal .form-floating > .form-select ~ label,
#buscarZonasModal .form-floating > .form-control:focus ~ label,
#buscarZonasModal .form-floating > .form-control:not(:placeholder-shown) ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#registrarVehiculoModal .text-danger,
#buscarZonasModal .text-danger {
  color: var(--danger-color) !important;
}

#registrarVehiculoModal .form-text,
#buscarZonasModal .form-text {
  font-size: 12px;
  margin-top: 5px;
  color: var(--gray-color);
}

#registrarVehiculoModal .input-group .btn,
#buscarZonasModal .input-group .btn {
  height: 56px;
  border-radius: 0 8px 8px 0;
}

#registrarVehiculoModal .input-group .form-control,
#buscarZonasModal .input-group .form-control {
  border-radius: 8px 0 0 8px;
}

#buscarZonasModal .table {
  margin-bottom: 0;
}

#buscarZonasModal .table th {
  border-top: none;
  font-weight: 600;
  color: var(--dark-color);
  background-color: var(--light-gray);
}

#buscarZonasModal .table td {
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
#registrarVehiculoModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#registrarVehiculoModal .modal-title::after {
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
    $('#Monto').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
      $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#capacidadVolumen').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
      $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#capacidadPeso').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
</script>
<script>
// Función para abrir el modal de búsqueda de zonas
function buscarZonas() {
  $('#buscarZonasModal').modal('show');
  cargarZonas();
}

// Función para cargar las zonas desde la base de datos
function cargarZonas(searchTerm = '', soloActivos = true) {
  fetch(`../vehiculos/buscarzona.php?search=${encodeURIComponent(searchTerm)}&activos=${soloActivos ? '1' : '0'}`)
    .then(response => response.json())
    .then(data => {
      const tableBody = document.getElementById('zonasTableBody');
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
            <button class="btn btn-sm btn-primary" onclick="seleccionarZona(${zona.idZona}, '${zona.nombreZona}')">
              <i class="fas fa-check"></i> Seleccionar
            </button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Ocurrió un error al cargar las zonas');
    });
}

// Función para filtrar zonas según el término de búsqueda
function filtrarZonas() {
  const searchTerm = document.getElementById('searchZonaInput').value;
  const soloActivos = document.getElementById('filterActivos').checked;
  cargarZonas(searchTerm, soloActivos);
}

// Función para seleccionar una zona y cerrar el modal
function seleccionarZona(idZona, nombreZona) {
  document.getElementById('zonaCobertura').value = nombreZona;
  document.getElementById('idZona').value = idZona;
  $('#buscarZonasModal').modal('hide');
}

// Función para guardar el vehículo (con SweetAlert y recarga automática)
function guardarVehiculo() {
  const formData = new FormData(document.getElementById('formRegistroVehiculo'));
  
  fetch('../vehiculos/guardar.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      Swal.fire({
        icon: 'success',
        title: 'Vehículo registrado correctamente',
        showConfirmButton: false,
        timer: 2000
      }).then(() => {
        $('#registrarVehiculoModal').modal('hide');
        location.reload(); // Recarga la página después del mensaje
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: data.message
      });
    }
  })
  .catch(error => {
    console.error('Error:', error);
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Ocurrió un error al registrar el vehículo'
    });
  });
}

// Event listeners para el filtrado automático al escribir
document.getElementById('searchZonaInput').addEventListener('keyup', function(e) {
  if (e.key === 'Enter') {
    filtrarZonas();
  }
});

document.getElementById('filterActivos').addEventListener('change', function() {
  filtrarZonas();
});

</script>

<style>
/* Estilos adicionales para mejorar la apariencia */
.modal-content {
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.modal-header {
  border-bottom: none;
  padding-bottom: 0;
}

.modal-title {
  font-weight: 600;
}

.table th {
  font-weight: 600;
  background-color:black;
}

.badge {
  font-weight: 500;
  padding: 5px 10px;
}

.form-control, .form-select {
  border-radius: 5px;
  padding: 10px;
}

.btn {
  border-radius: 5px;
  padding: 8px 15px;
  font-weight: 500;
}

.input-group-text {
  background-color: #f8f9fa;
}
</style>