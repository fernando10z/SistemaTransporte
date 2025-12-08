<!-- Modal Buscar Vehículo -->
<div class="modal fade" id="buscarVehiculoModal" tabindex="-1" aria-labelledby="buscarVehiculoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="buscarVehiculoModalLabel">Buscar Vehículo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Barra de búsqueda -->
        <div class="input-group mb-3">
          <input type="text" id="buscarVehiculoInput" class="form-control" placeholder="Buscar por placa, marca o modelo...">
          <button class="btn btn-outline-secondary" type="button" id="limpiarBusquedaVehiculo">
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <!-- Tabla de resultados -->
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="tablaVehiculos">
            <thead class="table-dark">
              <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="cuerpoTablaVehiculos">
              <!-- Los datos se cargarán aquí dinámicamente -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>