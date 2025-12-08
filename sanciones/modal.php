<!-- Modal Principal - Registrar Sanción - Diseño Moderno -->
<div class="modal fade" id="modalRegistrarSancion" tabindex="-1" aria-labelledby="modalRegistrarSancionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarSancionLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-exclamation-triangle me-2"></i>Registrar Sanción
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalRegistrarSancion').modal('hide')"></button>
            </div>
            <form id="formSancion">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Información del Conductor</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-9">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreConductor" readonly>
                                <label for="nombreConductor">Conductor <span class="text-danger">*</span></label>
                                <input type="hidden" id="idConductor" name="idConductor">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-outline-primary w-100 h-100" id="btnBuscarConductor">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Detalles de la Sanción</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="motivo" name="motivo" style="height: 100px" required></textarea>
                                <label for="motivo">Motivo <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipo_sancion" name="tipo_sancion" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Advertencia">Advertencia</option>
                                    <option value="Suspensión">Suspensión</option>
                                    <option value="Multa">Multa</option>
                                </select>
                                <label for="tipo_sancion">Tipo de Sanción <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" id="grupoMontoMulta" style="display: none;">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="monto_multa" name="monto_multa" min="0" step="0.01" value="0">
                                <label for="monto_multa">Monto de Multa (S/) <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fecha_inicio_sancion" name="fecha_inicio_sancion">
                                <label for="fecha_inicio_sancion">Fecha Inicio Sanción</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fecha_fin_sancion" name="fecha_fin_sancion">
                                <label for="fecha_fin_sancion">Fecha Fin Sanción</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="observaciones" name="observaciones" style="height: 100px"></textarea>
                                <label for="observaciones">Observaciones</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-5s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="supervisor" name="supervisor" required>
                                <label for="supervisor">Supervisor <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estado" name="estado">
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Resuelta">Resuelta</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#modalRegistrarSancion').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="guardarSancion()">
                        <i class="fas fa-save me-2"></i>Guardar Sanción
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Búsqueda de Conductores - Diseño Moderno -->
<div class="modal fade" id="modalBuscarConductor" tabindex="-1" aria-labelledby="modalBuscarConductorLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarConductorLabel">
                    <i class="fas fa-search me-2"></i>Buscar Conductor
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalBuscarConductor').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="busquedaConductor" placeholder="Buscar por nombre, apellido, documento o licencia...">
                        <button class="btn btn-primary" type="button" id="btnBuscarConductorModal">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tablaConductores">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Licencia</th>
                                <th>Documento</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="resultadosConductores" class="table-group-divider">
                            <!-- Los resultados se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalBuscarConductor').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modals de sanciones */
#modalRegistrarSancion .modal-content,
#modalBuscarConductor .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#modalRegistrarSancion .modal-header,
#modalBuscarConductor .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#modalRegistrarSancion .modal-title,
#modalBuscarConductor .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#modalRegistrarSancion .modal-body,
#modalBuscarConductor .modal-body {
    padding: 25px;
}

#modalRegistrarSancion .modal-footer,
#modalBuscarConductor .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#modalRegistrarSancion .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#modalRegistrarSancion .section-divider span {
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

#modalRegistrarSancion .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#modalRegistrarSancion .form-floating > .form-control,
#modalRegistrarSancion .form-floating > .form-select,
#modalBuscarConductor .form-floating > .form-control {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#modalRegistrarSancion .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#modalRegistrarSancion .form-floating > .form-control:focus,
#modalRegistrarSancion .form-floating > .form-select:focus,
#modalBuscarConductor .form-floating > .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#modalRegistrarSancion .form-floating > label,
#modalBuscarConductor .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#modalRegistrarSancion .form-floating > .form-control:focus ~ label,
#modalRegistrarSancion .form-floating > .form-control:not(:placeholder-shown) ~ label,
#modalRegistrarSancion .form-floating > .form-select ~ label,
#modalBuscarConductor .form-floating > .form-control:focus ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#modalRegistrarSancion .text-danger,
#modalBuscarConductor .text-danger {
    color: var(--danger-color) !important;
}

/* Estilos para tablas en el modal de búsqueda */
#modalBuscarConductor .table {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
    --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
    margin-bottom: 0;
}

#modalBuscarConductor .table thead th {
    background-color: var(--light-gray);
    color: var(--dark-color);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

#modalBuscarConductor .table-hover tbody tr:hover {
    background-color: var(--light-gray);
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

.animate__delay-4s {
    animation-delay: 0.8s;
}

.animate__delay-5s {
    animation-delay: 1s;
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

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

/* Estilos para los botones */
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

.btn-outline-secondary {
    border-color: var(--light-gray);
    color: var(--gray-color);
}

.btn-outline-secondary:hover {
    background-color: var(--light-gray);
    color: var(--dark-color);
}

.btn-outline-primary {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white;
}

/* Estilos para elementos readonly */
input[readonly], select[readonly] {
    background-color: var(--light-gray);
    border-color: var(--light-gray);
    cursor: not-allowed;
}

/* Estilos para el input group */
.input-group-text {
    background-color: var(--light-gray);
    color: var(--gray-color);
    border-color: var(--light-gray);
}

/* Ajustes de altura para elementos */
.h-100 {
    height: 100% !important;
}

.w-100 {
    width: 100% !important;
}
#modalRegistrarSancion .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalRegistrarSancion .modal-title::after {
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
    // Validación para fechas de seguro
    $('#fecha_inicio_sancion').change(function() {
        const fechaInicio = new Date($(this).val());
        const fechaVencimientoInput = $('#fecha_fin_sancion');
        
        if ($(this).val()) {
            // Establecer la fecha mínima para el vencimiento
            fechaVencimientoInput.attr('min', $(this).val());
            
            // Si la fecha de vencimiento ya tiene un valor y es anterior, corregirla
            if (fechaVencimientoInput.val()) {
                const fechaVencimiento = new Date(fechaVencimientoInput.val());
                if (fechaVencimiento < fechaInicio) {
                    fechaVencimientoInput.val($(this).val());
                    mostrarFeedbackError(fechaVencimientoInput);
                }
            }
        }
    });
    
    // Validación en tiempo real
    $('#fecha_fin_sancion').on('input change', function() {
        const fechaInicio = $('#fecha_inicio_sancion').val();
        const fechaVencimiento = $(this).val();
        
        if (fechaInicio && fechaVencimiento) {
            const dateInicio = new Date(fechaInicio);
            const dateVencimiento = new Date(fechaVencimiento);
            
            if (dateVencimiento < dateInicio) {
                $(this).val(fechaInicio);
                mostrarFeedbackError($(this));
            }
        }
    });
    
    // Función para mostrar feedback visual
    function mostrarFeedbackError(elemento) {
        // Efecto visual de error
        elemento.addClass('is-invalid');
        setTimeout(() => elemento.removeClass('is-invalid'), 1000);
        
        // Efecto de animación
        elemento.css('transform', 'translateX(5px)');
        setTimeout(() => {
            elemento.css('transform', 'translateX(-5px)');
            setTimeout(() => elemento.css('transform', ''), 100);
        }, 100);
    }
});
</script>
<script>
$(document).ready(function() {
    // Control del campo de multa
    $('#tipo_sancion').change(function() {
        if ($(this).val() === 'Multa') {
            $('#grupoMontoMulta').show();
            $('#monto_multa').attr('required', true);
        } else {
            $('#grupoMontoMulta').hide();
            $('#monto_multa').attr('required', false);
            $('#monto_multa').val('0');
        }
    });

    // Función para abrir el modal de búsqueda
    $('#btnBuscarConductor').click(function() {
        $('#modalBuscarConductor').modal('show');
        cargarConductores();
    });

    // Función para buscar conductores
    $('#busquedaConductor').keyup(function() {
        var busqueda = $(this).val();
        if(busqueda.length >= 2 || busqueda.length == 0) {
            $.ajax({
                url: '../sanciones/buscarconductor.php',
                type: 'POST',
                data: { busqueda: busqueda },
                success: function(response) {
                    $('#resultadosConductores').html(response);
                },
                error: function() {
                    $('#resultadosConductores').html('<tr><td colspan="4" class="text-center text-danger">Error al cargar los datos</td></tr>');
                }
            });
        }
    });

    // Función para cargar todos los conductores
    function cargarConductores() {
        $.ajax({
            url: '../sanciones/buscarconductor.php',
            type: 'POST',
            data: { busqueda: '' },
            success: function(response) {
                $('#resultadosConductores').html(response);
            },
            error: function() {
                $('#resultadosConductores').html('<tr><td colspan="4" class="text-center text-danger">Error al cargar los datos</td></tr>');
            }
        });
    }

    // Cierre correcto de los modales
    $('#closeMainModal, #cancelMainModal').click(function() {
        $('#modalRegistrarSancion').modal('hide');
    });

    $('#closeSearchModal, #cancelSearchModal').click(function() {
        $('#modalBuscarConductor').modal('hide');
    });

    // Restaurar scroll al cerrar modal de búsqueda
    $('#modalBuscarConductor').on('hidden.bs.modal', function () {
        $('body').addClass('modal-open');
    });
});

// Función para seleccionar un conductor
function seleccionarConductor(idConductor, nombreCompleto) {
    $('#idConductor').val(idConductor);
    $('#nombreConductor').val(nombreCompleto);
    $('#modalBuscarConductor').modal('hide');
    $('#busquedaConductor').val('');
}

// Función para guardar la sanción
function guardarSancion() {
    // Validar campos requeridos
    if($('#idConductor').val() === '' || $('#motivo').val() === '' || $('#tipo_sancion').val() === '' || $('#supervisor').val() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Todos los campos obligatorios deben ser completados'
        });
        return;
    }

    // Validar monto si es multa
    if($('#tipo_sancion').val() === 'Multa' && ($('#monto_multa').val() === '' || parseFloat($('#monto_multa').val()) <= 0)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debe ingresar un monto válido para la multa'
        });
        return;
    }

    // Si no es multa, forzar el valor a 0
    if ($('#tipo_sancion').val() !== 'Multa') {
        $('#monto_multa').val('0');
    }
    
    
    const formData = {
        idConductor: $('#idConductor').val(),
        motivo: $('#motivo').val(),
        tipo_sancion: $('#tipo_sancion').val(),
        monto_multa: $('#monto_multa').val(),
        fecha_inicio_sancion: $('#fecha_inicio_sancion').val(),
        fecha_fin_sancion: $('#fecha_fin_sancion').val(),
        observaciones: $('#observaciones').val(),
        supervisor: $('#supervisor').val(),
        estado: $('#estado').val()
    };

    // Configurar AJAX correctamente
    $.ajax({
        url: '../sanciones/guardar.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        dataType: 'json',
        success: function(response) {
            // Verificar si la respuesta es válida
            if (response && response.status) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#modalRegistrarSancion').modal('hide');
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error desconocido'
                    });
                }
            } else {
                throw new Error('Respuesta inválida del servidor');
            }
        },
        error: function(xhr, status, error) {
            let errorMsg = 'Error al comunicarse con el servidor';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMsg
            });
        }
    });
}
</script>