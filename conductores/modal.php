<!-- Modal de Registro de Conductor -->
<div class="modal fade" id="registroConductorModal" tabindex="-1" aria-labelledby="registroConductorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroConductorModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-user-tie me-2"></i>Registrar Nuevo Conductor
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#registroConductorModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formConductor">
                    <div class="section-divider mb-4">
                        <span>Información Personal</span>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                                <label for="nombre">Nombres</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apepat" name="apepat" placeholder="Apellido Paterno" required>
                                <label for="apepat">Apellido Paterno</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apemat" name="apemat" placeholder="Apellido Materno">
                                <label for="apemat">Apellido Materno</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mb-4">
                        <span>Documentación</span>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDocumento" name="idTipoDocumento" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodocumento WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$row['idTipoDocumento']}'>{$row['tipoDocumento']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDocumento">Tipo de Documento</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="numerodocumento" name="numerodocumento" placeholder="Número de Documento" required maxlength="12">
                                <label for="numerodocumento">Número de Documento</label>
                                <div class="invalid-feedback" id="documento-error"></div>
                                <div class="invalid-feedback" id="documento-duplicado-error">Este número de documento ya está registrado</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idGenero" name="idGenero" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM genero WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$row['idGenero']}'>{$row['genero']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idGenero">Género</label>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mb-4">
                        <span>Dirección</span>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDireccion" name="idTipoDireccion" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodireccion WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$row['idTipoDireccion']}'>{$row['tipoDireccion']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDireccion">Tipo de Dirección</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
                                <label for="direccion">Dirección</label>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mb-4">
                        <span>Información Profesional</span>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tipolicencia" name="tipolicencia" placeholder="Tipo de Licencia" required>
                                <label for="tipolicencia">Tipo de Licencia</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="licencia" name="licencia" placeholder="Licencia de Conducir" required maxlength="15">
                                <label for="licencia">Licencia de Conducir</label>
                                <div class="invalid-feedback" id="licencia-error">La licencia debe tener entre 8 y 15 caracteres</div>
                                <div class="invalid-feedback" id="licencia-duplicado-error">Esta licencia ya está registrada</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required maxlength="9">
                                <label for="telefono">Teléfono</label>
                                <div class="invalid-feedback" id="telefono-error">Debe tener 9 dígitos</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mb-4">
                        <span>Información de Acceso</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                                <label for="correo">Correo</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-radius: 0 6px 6px 0;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="horastrabajo" name="horastrabajo" placeholder="Horas de trabajo" required>
                                <label for="horastrabajo">Horas de trabajo</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#registroConductorModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardar" disabled>
                    <i class="fas fa-save me-2"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para el modal de conductor */
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

/* Estilos para el modal */
.modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#registroConductorModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

#registroConductorModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block;
    position: relative;
}

#registroConductorModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 50px;
    height: 3px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Divisores de sección */
.section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

.section-divider span {
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

.section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

/* Estilos para los campos flotantes */
.form-floating > .form-control,
.form-floating > .form-select,
.form-floating > .form-control-plaintext {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: var(--border-radius);
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > .form-control-plaintext ~ label {
    color: var(--gray-color);
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

.form-floating > .form-control-plaintext ~ label,
.form-floating > .form-control:disabled ~ label {
    color: var(--gray-color);
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

/* Estilos para campos con input-group (contraseña) */
.form-floating .input-group .form-control {
    border-radius: var(--border-radius) 0 0 var(--border-radius);
    height: 56px;
    padding-top: 1.5rem;
}

.form-floating .input-group .btn {
    height: 56px;
    border-left: none;
}

/* Estilos para mensajes de error */
.invalid-feedback {
    display: none;
    color: var(--danger-color);
    font-size: 12px;
    margin-top: 5px;
}

.form-control.is-invalid {
    border-color: var(--danger-color);
    background-image: none;
}

.form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(245, 82, 82, 0.15);
}

.form-control.is-invalid ~ .invalid-feedback {
    display: block;
}

/* Estilos para botones */
.btn {
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 6px;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

.btn-outline-secondary {
    color: var(--gray-color);
    border-color: var(--light-gray);
}

.btn-outline-secondary:hover {
    background-color: var(--light-gray);
    color: var(--dark-color);
    border-color: var(--light-gray);
}

.btn-close {
    opacity: 0.5;
    transition: var(--transition);
}

.btn-close:hover {
    opacity: 1;
}

/* Personalizaciones para bootstrap */
.row {
    --bs-gutter-x: 1.5rem;
}

.g-3 {
    --bs-gutter-y: 1rem;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

/* Ajustes para el label de contraseña con input-group */
.form-floating > .input-group ~ label {
    left: 12px;
    z-index: 3;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#contrasena');
    
    togglePassword.addEventListener('click', function() {
        // Cambiar el tipo de input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Cambiar el icono del ojo
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
    });
});
</script>
<script>
    $(document).ready(function() {
        // Variables para control de validación
        let documentoValido = false;
        let telefonoValido = false;
        let documentoNoDuplicado = false;
        let licenciaValida = false;
        let licenciaNoDuplicada = false;

        // Función para mostrar/ocultar mensajes de error
        function toggleError(element, show, message = '') {
            const errorElement = $(`#${element}-error`);
            const inputElement = $(`#${element}`);
            
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

        // Función para validar el documento según el tipo
        function validarDocumento() {
            const tipoDocumento = $('#idTipoDocumento').val();
            const numeroDocumento = $('#numerodocumento').val().trim();
            
            // Ocultar mensajes al inicio
            toggleError('documento', false);
            toggleError('documento-duplicado', false);
            
            // Si no hay tipo de documento seleccionado, no validar
            if (!tipoDocumento) {
                documentoValido = false;
                actualizarBotonGuardar();
                return;
            }
            
            // Si no hay número ingresado, no mostrar error
            if (numeroDocumento.length === 0) {
                documentoValido = false;
                actualizarBotonGuardar();
                return;
            }
            
            // Validar según tipo de documento
            if (tipoDocumento === '1') { // DNI
                // Limitar a 8 dígitos
                if (numeroDocumento.length > 8) {
                    $('#numerodocumento').val(numeroDocumento.substring(0, 8));
                }
                
                // Mostrar error solo si está escribiendo y no cumple
                if (numeroDocumento.length !== 8 || !/^\d+$/.test(numeroDocumento)) {
                    toggleError('documento', true, 'Debe tener exactamente 8 dígitos');
                    documentoValido = false;
                } else {
                    toggleError('documento', false);
                    documentoValido = true;
                }
            } else { // Otros documentos (12 dígitos)
                // Limitar a 12 dígitos
                if (numeroDocumento.length > 12) {
                    $('#numerodocumento').val(numeroDocumento.substring(0, 12));
                }
                
                // Mostrar error solo si está escribiendo y no cumple
                if (numeroDocumento.length !== 12 || !/^\d+$/.test(numeroDocumento)) {
                    toggleError('documento', true, 'Debe tener exactamente 12 dígitos');
                    documentoValido = false;
                } else {
                    toggleError('documento', false);
                    documentoValido = true;
                }
            }
            
            if(documentoValido) {
                verificarDocumentoDuplicado();
            } else {
                documentoNoDuplicado = false;
                actualizarBotonGuardar();
            }
        }

        // Función para verificar si el documento ya existe
        function verificarDocumentoDuplicado() {
            const tipoDocumento = $('#idTipoDocumento').val();
            const numeroDocumento = $('#numerodocumento').val().trim();
            
            $.ajax({
                url: '../conductores/verficar.php',
                method: 'POST',
                data: {
                    idTipoDocumento: tipoDocumento,
                    numerodocumento: numeroDocumento
                },
                success: function(response) {
                    if (response.existe) {
                        toggleError('documento-duplicado', true);
                        documentoNoDuplicado = false;
                    } else {
                        toggleError('documento-duplicado', false);
                        documentoNoDuplicado = true;
                    }
                    actualizarBotonGuardar();
                },
                error: function() {
                    documentoNoDuplicado = false;
                    actualizarBotonGuardar();
                }
            });
        }

        // Función para validar la licencia (ahora solo 15 caracteres exactos)
        function validarLicencia() {
            const licencia = $('#licencia').val().trim();
            
            // Limitar a 15 caracteres
            if (licencia.length > 15) {
                $('#licencia').val(licencia.substring(0, 15));
            }
            
            // Validar exactamente 15 caracteres
            if (licencia.length !== 15) {
                toggleError('licencia', true, 'La licencia debe tener exactamente 15 caracteres');
                licenciaValida = false;
            } else {
                toggleError('licencia', false);
                licenciaValida = true;
            }
            
            if(licenciaValida) {
                verificarLicenciaDuplicada();
            } else {
                licenciaNoDuplicada = false;
                actualizarBotonGuardar();
            }
        }

        // Función para verificar si la licencia ya existe
        function verificarLicenciaDuplicada() {
            const licencia = $('#licencia').val().trim();
            
            $.ajax({
                url: '../conductores/verificarlicencia.php',
                method: 'POST',
                data: {
                    licencia: licencia
                },
                success: function(response) {
                    if (response.existe) {
                        toggleError('licencia-duplicado', true);
                        licenciaNoDuplicada = false;
                    } else {
                        toggleError('licencia-duplicado', false);
                        licenciaNoDuplicada = true;
                    }
                    actualizarBotonGuardar();
                },
                error: function() {
                    licenciaNoDuplicada = false;
                    actualizarBotonGuardar();
                }
            });
        }

        // Función para validar el teléfono
        function validarTelefono() {
            const telefono = $('#telefono').val().trim();
            
            // Limitar a 9 dígitos
            if (telefono.length > 9) {
                $('#telefono').val(telefono.substring(0, 9));
            }
            
            // Validar exactamente 9 dígitos
            if (telefono.length !== 9 || !/^\d+$/.test(telefono)) {
                toggleError('telefono', true, 'Debe tener exactamente 9 dígitos');
                telefonoValido = false;
            } else {
                toggleError('telefono', false);
                telefonoValido = true;
            }
            
            actualizarBotonGuardar();
        }

        // Función para actualizar el estado del botón guardar
        function actualizarBotonGuardar() {
            // Verificar que todos los campos requeridos estén llenos
            const form = $('#formConductor')[0];
            let formValido = true;
            
            // Verificar campos requeridos
            $(form).find('[required]').each(function() {
                if (!$(this).val()) {
                    formValido = false;
                    return false; // Salir del each
                }
            });
            
            // Verificar todas las validaciones
            formValido = formValido && 
                         documentoValido && 
                         telefonoValido && 
                         documentoNoDuplicado &&
                         licenciaValida &&
                         licenciaNoDuplicada;
            
            $('#btnGuardar').prop('disabled', !formValido);
        }

        // Limpiar el modal cuando se cierra
        $('#registroConductorModal').on('hidden.bs.modal', function () {
            $('#formConductor')[0].reset();
            $('.invalid-feedback').addClass('d-none').removeClass('d-block');
            $('.is-invalid').removeClass('is-invalid');
            
            // Resetear variables de validación
            documentoValido = false;
            telefonoValido = false;
            documentoNoDuplicado = false;
            licenciaValida = false;
            licenciaNoDuplicada = false;
            
            $('#btnGuardar').prop('disabled', true);
        });

        // Eventos de validación en tiempo real
        $('#idTipoDocumento').change(validarDocumento);
        $('#numerodocumento').on('input', validarDocumento);
        $('#licencia').on('input', validarLicencia);
        $('#telefono').on('input', validarTelefono);

        // Validar al cambiar cualquier campo del formulario
        $('#formConductor').on('input change', function() {
            actualizarBotonGuardar();
        });

        // Guardar conductor
        $('#btnGuardar').click(function() {
            if ($('#btnGuardar').prop('disabled')) return;
            
            const formData = $('#formConductor').serialize();
            
            $.ajax({
                url: '../conductores/guardar.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Conductor registrado correctamente',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#registroConductorModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message || 'Ocurrió un error al registrar',
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