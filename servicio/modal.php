<!-- Modal para Registrar Servicio - Diseño Moderno -->
<div class="modal fade" id="registrarServicioModal" tabindex="-1" role="dialog" aria-labelledby="registrarServicioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarServicioModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Registrar Nuevo Servicio
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#registrarServicioModal').modal('hide')"></button>
            </div>
            <form id="registrarServicioForm">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Información del Servicio</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreServicio" name="nombreServicio" placeholder="Nombre del Servicio" required>
                                <label for="nombreServicio">Nombre del Servicio <span class="text-danger">*</span></label>
                                <small class="form-text text-muted">Ingrese un nombre descriptivo</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Configuración del Servicio</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipoCarga" name="tipoCarga" required>
                                    <option value="">Seleccione...</option>
                                    <option value="General">General</option>
                                    <option value="Perecible">Perecible</option>
                                    <option value="Peligrosa">Peligrosa</option>
                                    <option value="Refrigerada">Refrigerada</option>
                                    <option value="Voluminosa">Voluminosa</option>
                                </select>
                                <label for="tipoCarga">Tipo de Carga <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estadoServicio" name="Estado" required>
                                    <option value="Activo" selected>Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="estadoServicio">Estado <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#registrarServicioModal').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Registrar Servicio
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de servicio */
#registrarServicioModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#registrarServicioModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#registrarServicioModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#registrarServicioModal .modal-body {
    padding: 25px;
}

#registrarServicioModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#registrarServicioModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#registrarServicioModal .section-divider span {
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

#registrarServicioModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#registrarServicioModal .form-floating > .form-control,
#registrarServicioModal .form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#registrarServicioModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#registrarServicioModal .form-floating > .form-control:focus,
#registrarServicioModal .form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#registrarServicioModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#registrarServicioModal .form-floating > .form-control:focus ~ label,
#registrarServicioModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#registrarServicioModal .form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#registrarServicioModal .text-danger {
    color: var(--danger-color) !important;
}

#registrarServicioModal .form-text {
    font-size: 12px;
    margin-top: 5px;
    color: var(--gray-color);
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

.animate__fadeInLeft {
    animation-name: fadeInLeft;
}

.animate__fadeInRight {
    animation-name: fadeInRight;
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

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Personalizaciones para bootstrap */
.row {
    --bs-gutter-x: 1.5rem;
}

.g-3 {
    --bs-gutter-y: 1rem;
}

.mt-3 {
    margin-top: 1rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}
</style>

<!-- Script para guardar con mejoras -->
<script>
$(document).ready(function() {
    // Abrir modal con animación
    $('#abrirRegistroServicio').click(function() {
        $('#registrarServicioForm')[0].reset();
        $('#registrarServicioModal').modal('show');
        
        // Resetear clases de animación
        $('.form-group').removeClass('animate__animated animate__fadeInUp animate__fadeInLeft animate__fadeInRight');
        setTimeout(function() {
            $('.form-group').addClass('animate__animated animate__fadeInUp');
            $('.modal-footer button').addClass('animate__animated');
            $('.modal-footer button:first').addClass('animate__fadeInLeft');
            $('.modal-footer button:last').addClass('animate__fadeInRight');
        }, 100);
    });

    // Cerrar modal correctamente
    $('[data-dismiss="modal"], .close').click(function() {
        $('#registrarServicioModal').modal('hide');
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
    $('#registrarServicioForm').submit(function(e) {
        e.preventDefault();
        
        // Validación visual
        let isValid = true;
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });
        
        if (!isValid) {
            Swal.fire('Advertencia', 'Por favor complete los campos obligatorios', 'warning');
            return false;
        }
        
        $.ajax({
            url: '../servicio/guardar.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-primary').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Guardando...');
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        background: '#f8f9fa',
                       
                    }).then(function() {
                        $('#registrarServicioModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        confirmButtonColor: '#3085d6'
                    });
                }
            },
            complete: function() {
                $('.btn-primary').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Registrar Servicio');
            },
            error: function() {
                Swal.fire({
                    title: 'Error de conexión',
                    text: 'Ocurrió un error al comunicarse con el servidor',
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
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
#registrarServicioModal .modal-dialog {
    max-width: 600px;
}

#registrarServicioModal .modal-content {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    background: #ffffff;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Encabezado de lujo */
#registrarServicioModal .modal-header {
    background: #ffffff;
    color: #1a1a1a;
    padding: 22px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
}

#registrarServicioModal .modal-title {
    font-weight: 700;
    font-size: 1.5rem;
    letter-spacing: -0.3px;
    color: #1a1a1a;
    position: relative;
    display: inline-block;
}

#registrarServicioModal .modal-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #3a7bd5, #00d2ff);
    border-radius: 3px;
}

#registrarServicioModal .close {
    color: #a0a0a0;
    opacity: 0.8;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-size: 1.8rem;
    text-shadow: none;
    margin-top: -5px;
}

#registrarServicioModal .close:hover {
    color: #1a1a1a;
    opacity: 1;
    transform: rotate(90deg) scale(1.1);
}

/* Cuerpo del modal - Estilo ultra limpio */
#registrarServicioModal .modal-body {
    padding: 24px;
    background: #ffffff;
}

/* Campos de formulario premium */
#registrarServicioModal .form-control {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 11px 15px;
    font-size: 15px;
    transition: all 0.3s ease;
    background-color: #fafafa;
    box-shadow: none;
    height: auto;
}

#registrarServicioModal .form-control:focus {
    border-color: #3a7bd5;
    box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.08);
    background-color: #ffffff;
}

#registrarServicioModal textarea.form-control {
    min-height: 110px;
    resize: vertical;
}

/* Etiquetas elegantes */
#registrarServicioModal .form-group label {
    font-weight: 600;
    color: #4a4a4a;
    margin-bottom: 10px;
    font-size: 13px;
    display: block;
    letter-spacing: 0.2px;
}

/* Pie del modal - Estilo minimalista */
#registrarServicioModal .modal-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding: 18px 28px;
    background: #ffffff;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Botones de diseño exclusivo */
#registrarServicioModal .btn {
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

#registrarServicioModal .btn-secondary {
    background-color: #f5f5f5;
    color: #4a4a4a;
}

#registrarServicioModal .btn-secondary:hover {
    background-color: #e9e9e9;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
}

#registrarServicioModal .btn-primary {
    background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    color: white;
    box-shadow: 0 4px 15px rgba(58, 123, 213, 0.25);
}

#registrarServicioModal .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(58, 123, 213, 0.35);
    background: linear-gradient(135deg, #3570c7, #00c8f5);
}

#registrarServicioModal .btn-primary::after {
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

#registrarServicioModal .btn-primary:hover::after {
    transform: translateX(100%);
}

/* Efectos al hacer click */
@keyframes btnClick {
    0% { transform: scale(1); }
    50% { transform: scale(0.97); }
    100% { transform: scale(1); }
}

#registrarServicioModal .btn:active {
    animation: btnClick 0.3s ease;
}

/* Selectores personalizados */
#registrarServicioModal select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234a4a4a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    padding-right: 40px;
}
</style>