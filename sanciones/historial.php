<!-- Modal para Historial de Sanciones -->
<div class="modal fade" id="historialSancionesModal" tabindex="-1" aria-labelledby="historialSancionesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header  text-white">
        <h5 class="modal-title" id="historialSancionesModalLabel" style="font-size: 23px; color:black">Historial de Sanciones del Conductor</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Información del conductor -->
        <div class="row mb-4">
          <div class="col-md-6">
            <h6><strong>Conductor:</strong> <span id="modalNombreConductor"></span></h6>
            <h6><strong>Documento:</strong> <span id="modalDocumentoConductor"></span></h6>
          </div>
          <div class="col-md-6">
            <h6><strong>Licencia:</strong> <span id="modalLicenciaConductor"></span></h6>
            <h6><strong>Total sanciones:</strong> <span id="modalTotalSanciones" class="badge bg-secondary"></span></h6>
          </div>
        </div>
        
        <!-- Barra de búsqueda -->
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" id="buscarHistorial" class="form-control" placeholder="Buscar en historial...">
              <button class="btn btn-outline-secondary" type="button" id="limpiarBusqueda">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="col-md-6 text-end">
            <button id="btnExportarPDF" class="btn btn-danger me-2">
              <i class="fas fa-file-pdf"></i> Exportar PDF
            </button>
            <button id="btnExportarExcel" class="btn btn-success">
              <i class="fas fa-file-excel"></i> Exportar Excel
            </button>
          </div>
        </div>
        
        <!-- Tabla de historial -->
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="tablaHistorial">
            <thead class="table-dark">
              <tr>
                <th># Sanción</th>
                <th>Tipo Sanción</th>
                <th>Motivo</th>
                <th>Monto Multa</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Supervisor</th>
                <th>Fecha Registro</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody id="cuerpoTablaHistorial">
              <!-- Los datos se cargarán aquí dinámicamente -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<style>
  #historialSancionesModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#historialSancionesModal .modal-title::after {
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
    // Manejar clic en botón Ver
    $('.btnVerSancion').click(function() {
        const idSancion = $(this).data('idconductor');
        cargarHistorialConductor(idSancion);
    });
    
    // Limpiar búsqueda
    $('#limpiarBusqueda').click(function() {
        $('#buscarHistorial').val('');
        $('#tablaHistorial tbody tr').show();
    });
    
    // Filtrar tabla al escribir en la búsqueda
    $('#buscarHistorial').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#tablaHistorial tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // Exportar a PDF (ejemplo básico)
    $('#btnExportarPDF').click(function() {
        // Aquí iría el código para generar PDF
        alert('Exportar a PDF funcionalidad');
    });
    
    // Exportar a Excel (ejemplo básico)
    $('#btnExportarExcel').click(function() {
        // Aquí iría el código para generar Excel
        alert('Exportar a Excel funcionalidad');
    });
});

function cargarHistorialConductor(idSancion) {
    // Primero obtener el idConductor asociado a esta sanción
    $.ajax({
        url: '../sanciones/obtenerhistorial.php',
        method: 'POST',
        data: { idSancion: idSancion },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                const idConductor = response.idConductor;
                
                // Ahora obtener el historial completo del conductor
                obtenerHistorialConductor(idConductor, response.datosConductor);
            } else {
                alert('Error al obtener datos del conductor');
            }
        },
        error: function() {
            alert('Error en la solicitud AJAX');
        }
    });
}

function obtenerHistorialConductor(idConductor, datosConductor) {
    $.ajax({
        url: '../sanciones/obtenerhisotiralconductor.php',
        method: 'POST',
        data: { idConductor: idConductor },
        dataType: 'json',
        success: function(historial) {
            // Mostrar datos del conductor en el modal
            $('#modalNombreConductor').text(datosConductor.nombre_completo);
            $('#modalDocumentoConductor').text(datosConductor.documento_completo);
            $('#modalLicenciaConductor').text(datosConductor.licencia_completa);
            $('#modalTotalSanciones').text(historial.length);
            
            // Llenar la tabla con el historial
            const tbody = $('#cuerpoTablaHistorial');
            tbody.empty();
            
            historial.forEach(function(sancion) {
                const badgeClass = sancion.estado === 'Pendiente' ? 'primary' : 
                                 sancion.estado === 'En Proceso' ? 'warning' : 'success';
                
                const row = `
                    <tr>
                        <td>${sancion.idSancion}</td>
                        <td>${sancion.tipo_sancion}</td>
                        <td>${sancion.motivo || ''}</td>
                        <td>${sancion.monto_multa ? 'S/ ' + sancion.monto_multa : 'N/A'}</td>
                        <td>${sancion.fecha_inicio_sancion || 'N/A'}</td>
                        <td>${sancion.fecha_fin_sancion || 'N/A'}</td>
                        <td>${sancion.supervisor}</td>
                        <td>${sancion.fecha_registro}</td>
                        <td><span class="badge bg-${badgeClass}">${sancion.estado}</span></td>
                    </tr>
                `;
                tbody.append(row);
            });
            
            // Mostrar el modal
            $('#historialSancionesModal').modal('show');
        },
        error: function() {
            alert('Error al obtener el historial del conductor');
        }
    });
}
</script>