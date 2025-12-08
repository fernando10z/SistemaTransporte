<!-- Modal para Editar Conductor - Diseño Moderno -->
<div class="modal fade" id="editarConductorModal" tabindex="-1" aria-labelledby="editarConductorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarConductorModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-user-edit me-2"></i>Editar Conductor
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarConductorModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarConductor">
                    <input type="hidden" id="idConductorEdit" name="idConductor">
                    
                    <div class="section-divider">
                        <span>Información Personal</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreEdit" name="nombre" required>
                                <label for="nombreEdit">Nombres <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apepatEdit" name="apepat" required>
                                <label for="apepatEdit">Apellido Paterno <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apematEdit" name="apemat">
                                <label for="apematEdit">Apellido Materno</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDocumentoEdit" name="idTipoDocumento" style="pointer-events: none;" aria-readonly="false">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodocumento WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$row['idTipoDocumento']}'>{$row['tipoDocumento']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDocumentoEdit">Tipo de Documento <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="numerodocumentoEdit" name="numerodocumento" required maxlength="12" readonly>
                                <label for="numerodocumentoEdit">Número de Documento <span class="text-danger">*</span></label>
                                <div class="invalid-feedback d-none" id="documento-error-edit"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idGeneroEdit" name="idGenero" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM genero WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$row['idGenero']}'>{$row['genero']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idGeneroEdit">Género <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mt-4">
                        <span>Información de Contacto</span>
                    </div>

                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDireccionEdit" name="idTipoDireccion" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodireccion WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$row['idTipoDireccion']}'>{$row['tipoDireccion']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDireccionEdit">Tipo de Dirección <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="direccionEdit" name="direccion" required>
                                <label for="direccionEdit">Dirección <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mt-4">
                        <span>Información Profesional</span>
                    </div>

                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tipolicenciaEdit" name="tipolicenciaEdit" required>
                                <label for="tipolicenciaEdit">Tipo de Licencia <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="licenciaEdit" name="licencia" required maxlength="15">
                                <label for="licenciaEdit">Licencia de Conducir <span class="text-danger">*</span></label>
                                <div class="invalid-feedback d-none" id="licencia-error-edit">La licencia debe tener 15 caracteres</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="telefonoEdit" name="telefono" required maxlength="9">
                                <label for="telefonoEdit">Teléfono <span class="text-danger">*</span></label>
                                <div class="invalid-feedback d-none" id="telefono-error-edit">Debe tener 9 dígitos</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="correoEdit" name="correo">
                                <label for="correoEdit">Correo</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="horastrabajoEdit" name="horastrabajo">
                                <label for="horastrabajoEdit">Horas de Trabajo</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#editarConductorModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizar">
                    <i class="fas fa-save me-2"></i>Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el modal de edición de conductor */
#editarConductorModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#editarConductorModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}
#editarConductorModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarConductorModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}


#editarConductorModal .modal-body {
    padding: 25px;
}

#editarConductorModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#editarConductorModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#editarConductorModal .section-divider span {
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

#editarConductorModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#editarConductorModal .form-floating > .form-control,
#editarConductorModal .form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#editarConductorModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#editarConductorModal .form-floating > .form-control:focus,
#editarConductorModal .form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarConductorModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#editarConductorModal .form-floating > .form-control:focus ~ label,
#editarConductorModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarConductorModal .form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarConductorModal .text-danger {
    color: var(--danger-color) !important;
}

#editarConductorModal .invalid-feedback {
    font-size: 0.8rem;
    margin-top: 0.25rem;
    color: var(--danger-color);
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

/* Estilos para elementos readonly */
input[readonly], select[readonly] {
    background-color: var(--light-gray);
    border-color: var(--light-gray);
    cursor: not-allowed;
}

/* Estilos para selects deshabilitados */
select[style*="pointer-events: none"] {
    background-color: var(--light-gray);
    border-color: var(--light-gray);
    cursor: not-allowed;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script>
$(document).ready(function() {
    // Variables para control de validación
    let documentoValidoEdit = true;
    let telefonoValidoEdit = true;
    let licenciaValidaEdit = true;

    // Función para mostrar/ocultar mensajes de error
    function toggleErrorEdit(element, show, message = '') {
        const errorElement = $(`#${element}-edit`);
        const inputElement = $(`#${element}Edit`);
        
        if (show) {
            errorElement.removeClass('d-none').addClass('d-block');
            inputElement.addClass('is-invalid');
            if (message) {
                errorElement.text(message);
            }
        } else {
            errorElement.removeClass('d-block').addClass('d-none');
            inputElement.removeClass('is-invalid');
        }
    }

    // Función para validar el documento en edición
    function validarDocumentoEdit() {
        const tipoDocumento = $('#idTipoDocumentoEdit').val();
        const numeroDocumento = $('#numerodocumentoEdit').val().trim();
        
        toggleErrorEdit('documento-error', false);
        
        if (!tipoDocumento) {
            documentoValidoEdit = false;
            actualizarBotonActualizar();
            return;
        }
        
        if (numeroDocumento.length === 0) {
            documentoValidoEdit = false;
            actualizarBotonActualizar();
            return;
        }
        
        if (tipoDocumento === '1') { // DNI
            if (numeroDocumento.length !== 8 || !/^\d+$/.test(numeroDocumento)) {
                toggleErrorEdit('documento-error', true, 'Debe tener 8 dígitos');
                documentoValidoEdit = false;
            } else {
                documentoValidoEdit = true;
            }
        } else { // Otros documentos
            if (numeroDocumento.length !== 12 || !/^\d+$/.test(numeroDocumento)) {
                toggleErrorEdit('documento-error', true, 'Debe tener 12 dígitos');
                documentoValidoEdit = false;
            } else {
                documentoValidoEdit = true;
            }
        }
        
        actualizarBotonActualizar();
    }

    // Función para validar la licencia en edición
    function validarLicenciaEdit() {
        const licencia = $('#licenciaEdit').val().trim();
        
        if (licencia.length !== 15) {
            toggleErrorEdit('licencia-error', true);
            licenciaValidaEdit = false;
        } else {
            toggleErrorEdit('licencia-error', false);
            licenciaValidaEdit = true;
        }
        
        actualizarBotonActualizar();
    }

    // Función para validar el teléfono en edición
    function validarTelefonoEdit() {
        const telefono = $('#telefonoEdit').val().trim();
        
        if (telefono.length !== 9 || !/^\d+$/.test(telefono)) {
            toggleErrorEdit('telefono-error', true);
            telefonoValidoEdit = false;
        } else {
            toggleErrorEdit('telefono-error', false);
            telefonoValidoEdit = true;
        }
        
        actualizarBotonActualizar();
    }

    // Función para actualizar el estado del botón actualizar
    function actualizarBotonActualizar() {
        const formValido = $('#formEditarConductor')[0].checkValidity() && 
                         documentoValidoEdit && 
                         telefonoValidoEdit && 
                         licenciaValidaEdit;
        
        $('#btnActualizar').prop('disabled', !formValido);
    }

    // Eventos de validación en tiempo real
    $('#idTipoDocumentoEdit').change(validarDocumentoEdit);
    $('#numerodocumentoEdit').on('input', validarDocumentoEdit);
    $('#licenciaEdit').on('input', validarLicenciaEdit);
    $('#telefonoEdit').on('input', validarTelefonoEdit);
    $('#formEditarConductor').on('input change', actualizarBotonActualizar);

    // Evento para abrir el modal de edición
    $(document).on('click', '.editar-conductor', function() {
        const idConductor = $(this).data('id');
        
        // Limpiar errores
        $('.invalid-feedback').addClass('d-none').removeClass('d-block');
        $('.is-invalid').removeClass('is-invalid');
        
        // Obtener datos del conductor
        $.ajax({
            url: '../conductores/obtener.php',
            method: 'POST',
            data: { idConductor: idConductor },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const conductor = response.data;
                    
                    // Llenar el formulario
                    $('#idConductorEdit').val(conductor.idConductor);
                    $('#nombreEdit').val(conductor.nombre);
                    $('#apepatEdit').val(conductor.Apepat);
                    $('#apematEdit').val(conductor.Apemat);
                    $('#idTipoDocumentoEdit').val(conductor.idTipoDocumento).trigger('change');
                    $('#numerodocumentoEdit').val(conductor.numerodocumento);
                    $('#idGeneroEdit').val(conductor.idGenero);
                    $('#idTipoDireccionEdit').val(conductor.idTipoDireccion);
                    $('#direccionEdit').val(conductor.direccion);
                    $('#licenciaEdit').val(conductor.licencia);
                    $('#telefonoEdit').val(conductor.telefono);
                    $('#correoEdit').val(conductor.Correo);
                    $('#tipolicenciaEdit').val(conductor.tipolicencia);
                    $('#horastrabajoEdit').val(conductor.horastrabajo);
                    
                    // Mostrar modal
                    $('#editarConductorModal').modal('show');
                    
                    // Validar campos
                    validarDocumentoEdit();
                    validarLicenciaEdit();
                    validarTelefonoEdit();
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'No se pudo obtener los datos del conductor',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al conectar con el servidor',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Evento para actualizar conductor
    $('#btnActualizar').click(function() {
        if ($('#btnActualizar').prop('disabled')) return;
        
        const formData = $('#formEditarConductor').serialize();
        
        $.ajax({
            url: '../conductores/actualizar.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Conductor actualizado correctamente',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#editarConductorModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Error al actualizar el conductor',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Error en la conexión',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>