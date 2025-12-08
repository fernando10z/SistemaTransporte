<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Código QR de Envío</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div id="qrCodeContainer"></div>
                        <button id="descargarQR" class="btn btn-primary mt-3">
                            <i class="fas fa-download"></i> Descargar QR
                        </button>
                    </div>
                    <div class="col-md-6">
                        <div class="qr-info">
                            <p><strong>Cliente:</strong> <span id="qrCliente"></span></p>
                            <p><strong>Documento:</strong> <span id="qrDocumento"></span></p>
                            <p><strong>Vehículo:</strong> <span id="qrVehiculo"></span></p>
                            <p><strong>Tipo de carga:</strong> <span id="qrCarga"></span></p>
                            <p><strong>Peso:</strong> <span id="qrPeso"></span></p>
                            <p><strong>Volumen:</strong> <span id="qrVolumen"></span></p>
                            <p><strong>Monto:</strong> <span id="qrMonto"></span></p>
                            <p><strong>Origen:</strong> <span id="qrOrigen"></span></p>
                            <p><strong>Destino:</strong> <span id="qrDestino"></span></p>
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
