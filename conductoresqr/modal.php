<div class="modal fade" id="qrConductorModal" tabindex="-1" aria-labelledby="qrConductorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="qrConductorModalLabel">Código QR del Conductor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 text-center">
            <div id="qrCodeContainer" class="mb-3" style="min-height: 200px;">
              <!-- Aquí se generará el QR -->
            </div>
            <button id="descargarQR" class="btn btn-primary">
              <i class="fas fa-download me-2"></i>Descargar QR
            </button>
          </div>
          <div class="col-md-6">
            <div class="qr-info">
              <h5 class="mb-3">Información del Conductor</h5>
              <p><strong>ID:</strong> <span id="qrIdConductor"></span></p>
              <p><strong>Nombre:</strong> <span id="qrNombre"></span></p>
              <p><strong>Documento:</strong> <span id="qrDocumento"></span></p>
              <p><strong>Licencia:</strong> <span id="qrLicencia"></span></p>
              <p><strong>Teléfono:</strong> <span id="qrTelefono"></span></p>
              <p><strong>Correo:</strong> <span id="qrCorreo"></span></p>
              <p><strong>Token QR:</strong> <span id="qrToken" class="text-muted small"></span></p>
              <p><strong>Fecha Generación:</strong> <span id="qrFecha"></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
