<!-- Modal para Registrar Zona - Diseño Moderno -->
<div class="modal fade" id="registrarZonaModal" tabindex="-1" role="dialog" aria-labelledby="registrarZonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarZonaModalLabel">
                    <i class="fas fa-map-marked-alt me-2"></i>Registrar Nueva Zona
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#registrarZonaModal').modal('hide')"></button>
            </div>
            <form id="registrarZonaForm">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Ubicación Geográfica</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreZona" name="nombreZona" placeholder="Nombre de Zona" required>
                                <label for="nombreZona">Nombre de Zona <span class="text-danger">*</span></label>
                                <small class="form-text text-muted">Ejemplo: Zona Norte, Zona Centro, etc.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" required>
                                <label for="departamento">Departamento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" required>
                                <label for="provincia">Provincia <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Distrito" required>
                                <label for="distrito">Distrito <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcionZona" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="descripcionZona">Descripción</label>
                                <small class="form-text text-muted">Detalles adicionales sobre la zona</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estadoZona" name="Estado" required>
                                    <option value="Activo" selected>Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="estadoZona">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#registrarZonaModal').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Registrar Zona
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de zona */
#registrarZonaModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#registrarZonaModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#registrarZonaModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#registrarZonaModal .modal-body {
    padding: 25px;
}

#registrarZonaModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#registrarZonaModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#registrarZonaModal .section-divider span {
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

#registrarZonaModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#registrarZonaModal .form-floating > .form-control,
#registrarZonaModal .form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#registrarZonaModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#registrarZonaModal .form-floating > .form-control:focus,
#registrarZonaModal .form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#registrarZonaModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#registrarZonaModal .form-floating > .form-control:focus ~ label,
#registrarZonaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#registrarZonaModal .form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#registrarZonaModal .text-danger {
    color: var(--danger-color) !important;
}

#registrarZonaModal .form-text {
    font-size: 12px;
    margin-top: 5px;
    color: var(--gray-color);
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
</style>

<!-- Script para guardar -->
<script>
$(document).ready(function() {
    // Abrir modal
    $('#abrirRegistroZona').click(function() {
        $('#registrarZonaForm')[0].reset();
        $('#registrarZonaModal').modal('show');
    });
 // Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#registrarZonaModal').modal('hide');
    });

    // Efecto hover para botones
    $('.btn').hover(
        function() {
            $(this).addClass('shadow-sm');
        },
        function() {
            $(this).removeClass('shadow-sm');
        }
    );
    // Enviar formulario
    $('#registrarZonaForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '../zonas/guardar.php',
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
                $('.btn-primary').prop('disabled', false).html('Registrar Zona');
            },
            error: function() {
                Swal.fire('Error', 'Ocurrió un error al comunicarse con el servidor', 'error');
            }
        });
    });
    
 // Efectos de focus en los inputs
    $('input, select, textarea').focus(function() {
        $(this).addClass('shadow-sm').parent().addClass('text-primary');
    }).blur(function() {
        $(this).removeClass('shadow-sm').parent().removeClass('text-primary');
    });
});
</script>

<!-- Estilos adicionales -->
<style>
 /* Estructura principal del modal */
#registrarZonaModal .modal-dialog {
    max-width: 600px;
}

#registrarZonaModal .modal-content {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    background: #ffffff;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Encabezado de lujo */
#registrarZonaModal .modal-header {
    background: #ffffff;
    color: #1a1a1a;
    padding: 22px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
}

#registrarZonaModal .modal-title {
    font-weight: 700;
    font-size: 1.5rem;
    letter-spacing: -0.3px;
    color: #1a1a1a;
    position: relative;
    display: inline-block;
}

#registrarZonaModal .modal-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #3a7bd5, #00d2ff);
    border-radius: 3px;
}

#registrarZonaModal .close {
    color: #a0a0a0;
    opacity: 0.8;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-size: 1.8rem;
    text-shadow: none;
    margin-top: -5px;
}

#registrarZonaModal .close:hover {
    color: #1a1a1a;
    opacity: 1;
    transform: rotate(90deg) scale(1.1);
}

/* Cuerpo del modal - Estilo ultra limpio */
#registrarZonaModal .modal-body {
    padding: 24px;
    background: #ffffff;
}

/* Campos de formulario premium */
#registrarZonaModal .form-control {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 11px 15px;
    font-size: 15px;
    transition: all 0.3s ease;
    background-color: #fafafa;
    box-shadow: none;
    height: auto;
}

#registrarZonaModal .form-control:focus {
    border-color: #3a7bd5;
    box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.08);
    background-color: #ffffff;
}

#registrarZonaModal textarea.form-control {
    min-height: 110px;
    resize: vertical;
}

/* Etiquetas elegantes */
#registrarZonaModal .form-group label {
    font-weight: 600;
    color: #4a4a4a;
    margin-bottom: 10px;
    font-size: 13px;
    display: block;
    letter-spacing: 0.2px;
}

/* Pie del modal - Estilo minimalista */
#registrarZonaModal .modal-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding: 18px 28px;
    background: #ffffff;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Botones de diseño exclusivo */
#registrarZonaModal .btn {
    border: none;
    border-radius: 10px;
    padding: 12px 26px;
    font-weight: 600;
    letter-spacing: 0.3px;
    font-size: 12px;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    min-width: 120px;
    text-align: center;
}

#registrarZonaModal .btn-secondary {
    background-color: #f5f5f5;
    color: #4a4a4a;
}

#registrarZonaModal .btn-secondary:hover {
    background-color: #e9e9e9;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
}

#registrarZonaModal .btn-primary {
    background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    color: white;
    box-shadow: 0 4px 15px rgba(58, 123, 213, 0.25);
}

#registrarZonaModal .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(58, 123, 213, 0.35);
    background: linear-gradient(135deg, #3570c7, #00c8f5);
}

#registrarZonaModal .btn-primary::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, 
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.2) 50%,
                rgba(255, 255, 255, 0) 100%);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

#registrarZonaModal .btn-primary:hover::after {
    transform: translateX(100%);
}

/* Efectos al hacer click */
@keyframes btnClick {
    0% { transform: scale(1); }
    50% { transform: scale(0.97); }
    100% { transform: scale(1); }
}

#registrarZonaModal .btn:active {
    animation: btnClick 0.3s ease;
}

/* Selectores personalizados */
#registrarZonaModal select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234a4a4a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    padding-right: 40px;
}
</style>