<!-- Modal de Reprogramación -->
<div class="modal fade" id="reprogramarModal" tabindex="-1" aria-labelledby="reprogramarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reprogramarModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-calendar-alt me-2"></i>Reprogramar Planificación
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#reprogramarModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formReprogramacion">
                    <input type="hidden" id="idPlanificacionReprogramar" name="idPlanificacion">
                    <input type="hidden" id="tipoPlanificacionReprogramar" name="tipoPlanificacion">
                    <input type="hidden" id="planificacionOriginal" name="planificacionOriginal">
                    
                    <div class="mb-4">
                        <div class="form-floating">
                            <textarea class="form-control" id="motivoReprogramacion" name="motivo" style="height: 100px;" required></textarea>
                            <label for="motivoReprogramacion">Motivo de la reprogramación</label>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaReprogramada" name="fechaReprogramada" required>
                                <label for="fechaReprogramada">Nueva Fecha</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="horaReprogramada" name="horaReprogramada" required>
                                <label for="horaReprogramada">Nueva Hora</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#reprogramarModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarReprogramacion">
                    <i class="fas fa-save me-2"></i>Guardar Reprogramación
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de reprogramación */
#reprogramarModal .modal-content {
    border: none;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

#reprogramarModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid #edf2f9;
    padding: 20px 25px;
}

#reprogramarModal .modal-title {
    color: #334d6e;
    font-weight: 700;
    display: inline-block;
    position: relative;
}

#reprogramarModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 50px;
    height: 3px;
    background-color: #5d87ff;
    border-radius: 2px;
}

#reprogramarModal .modal-body {
    padding: 25px;
}

#reprogramarModal .modal-footer {
    border-top: 1px solid #edf2f9;
    padding: 16px 25px;
    background-color: #fff;
}

/* Estilos para campos flotantes */
#reprogramarModal .form-floating > .form-control,
#reprogramarModal .form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid #edf2f9;
    border-radius: 8px;
    transition: all 0.3s ease;
    color: #334d6e;
}

#reprogramarModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#reprogramarModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: #8492a6;
}

#reprogramarModal .form-floating > .form-control:focus,
#reprogramarModal .form-floating > .form-select:focus {
    border-color: #5d87ff;
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#reprogramarModal .form-floating > .form-control:focus ~ label,
#reprogramarModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#reprogramarModal .form-floating > .form-select ~ label {
    color: #5d87ff;
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para botones */
#reprogramarModal .btn {
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

#reprogramarModal .btn-primary {
    background-color: #5d87ff;
    border-color: #5d87ff;
}

#reprogramarModal .btn-primary:hover {
    background-color: #4569cb;
    border-color: #4569cb;
}

#reprogramarModal .btn-outline-secondary {
    color: #8492a6;
    border-color: #edf2f9;
}

#reprogramarModal .btn-outline-secondary:hover {
    background-color: #edf2f9;
    color: #334d6e;
    border-color: #edf2f9;
}

/* Espaciado */
#reprogramarModal .mb-4 {
    margin-bottom: 1.5rem !important;
}

#reprogramarModal .g-3 {
    --bs-gutter-y: 1rem;
}

/* Iconos */
#reprogramarModal .me-2 {
    margin-right: 0.5rem !important;
}
</style>
<script>
   $(document).ready(function() {
    // Manejar clic en botón reprogramar
    $('.reprogramar').click(function() {
        const idPlanificacion = $(this).data('id');
        const tipoPlanificacion = $(this).data('type');
        
        // Guardar datos en el modal
        $('#idPlanificacionReprogramar').val(idPlanificacion);
        $('#tipoPlanificacionReprogramar').val(tipoPlanificacion);
        $('#planificacionOriginal').val(idPlanificacion);
        
        // Mostrar modal
        $('#reprogramarModal').modal('show');
    });
    
    // Guardar reprogramación
    $('#btnGuardarReprogramacion').click(function() {
        const formData = $('#formReprogramacion').serialize();
        const tipoPlanificacion = $('#tipoPlanificacionReprogramar').val();
        
        let endpoint = '';
        if (tipoPlanificacion === 'cliente') {
            endpoint = '../planificacion/guardarreprogrmacioncliente.php';
        } else {
            endpoint = '../planificacion/guardarreprogrmacionempresa.php';
        }
        
        $.ajax({
            url: endpoint,
            type: 'POST',
            data: formData,
            dataType: 'json', // Asegura que jQuery espere JSON
            success: function(result) {
                // result ya es un objeto JSON parseado
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al procesar la solicitud: ' + error
                });
            }
        });
    });
})
</script>