
    <style>
        :root {
            --primary-color: #5d87ff;
            --primary-light: rgba(93, 135, 255, 0.1);
            --primary-dark: #4569cb;
            --danger-color: #f55252;
            --light-gray: #edf2f9;
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        .modal-content {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            color: white;
            border-bottom: 1px solid var(--light-gray);
            padding: 15px 20px;
        }

        .modal-title {
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .modal-body {
            padding: 20px;
        }

        .form-floating > label {
            color: #6c757d;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(93, 135, 255, 0.25);
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 5;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .is-invalid {
            border-color: var(--danger-color) !important;
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.875rem;
        }

        .section-divider {
            position: relative;
            text-align: center;
            margin: 25px 0;
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
        #modalEditarUsuario .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarUsuario .modal-title::after {
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


<!-- Modal de Edición -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 23px; color:black">
                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario">
                    <input type="hidden" id="idUsuarioEditar" name="idUsuario">
                    
                    <div class="section-divider">
                        <span>Información Personal</span>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreCompletoEditar" name="nombreCompleto" required>
                                <label for="nombreCompletoEditar">Nombres</label>
                                <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apellidosEditar" name="apellidos" required>
                                <label for="apellidosEditar">Apellidos</label>
                                <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idGeneroEditar" name="idGenero" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM genero WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idGenero'].'">'.$row['genero'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idGeneroEditar">Género</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDocumentoEditar" name="idTipoDocumento" required>
                                    <option value="">Tipo Documento</option>
                                  <?php
                                    $query = $conn->query("SELECT * FROM tipodocumento WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoDocumento'].'">'.$row['tipoDocumento'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDocumentoEditar">Tipo Documento</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="numerodocumentoEditar" name="numerodocumento" required maxlength="11">
                                <label for="numerodocumentoEditar">Número Documento</label>
                                <div class="invalid-feedback" id="docError">Ingrese un documento válido</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider">
                        <span>Información de Contacto</span>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="correoEditar" name="correo" required>
                                <label for="correoEditar">Correo Electrónico</label>
                                <div class="invalid-feedback">Ingrese un correo válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="telefonoEditar" name="telefono" required maxlength="9" pattern="[0-9]{9}">
                                <label for="telefonoEditar">Teléfono</label>
                                <div class="invalid-feedback">9 dígitos requeridos</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating password-input-container">
                                <input type="password" class="form-control" id="contrasenaEditar" name="contrasena" placeholder="Dejar vacío para no cambiar">
                                <label for="contrasenaEditar">Nueva Contraseña</label>
                                <button type="button" class="password-toggle" onclick="togglePassword('contrasenaEditar')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating password-input-container">
                                <input type="password" class="form-control" id="confirmarContrasenaEditar" name="confirmar_contrasena" placeholder="Confirmar contraseña">
                                <label for="confirmarContrasenaEditar">Confirmar Contraseña</label>
                                <button type="button" class="password-toggle" onclick="togglePassword('confirmarContrasenaEditar')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">Las contraseñas no coinciden</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider">
                        <span>Información de Dirección</span>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDireccionEditar" name="idTipoDireccion" required>
                                    <option value="">Tipo Dirección</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodireccion WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoDireccion'].'">'.$row['tipoDireccion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDireccionEditar">Tipo Dirección</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <textarea class="form-control" id="direccionEditar" name="direccion" style="height: 100px" required></textarea>
                                <label for="direccionEditar">Dirección Completa</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="idRolEditar" name="idRol" required>
                                    <option value="">Seleccionar Rol</option>
                                   <?php
                                    $query = $conn->query("SELECT * FROM roles");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idRol'].'">'.$row['nombreRol'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idRolEditar">Rol</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estadoEditar" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="estadoEditar">Estado</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" id="btnActualizarUsuario" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios -->



<script>
// Función para mostrar/ocultar contraseña
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Validación de documento según tipo
function validarDocumento() {
    const tipoDoc = $('#idTipoDocumentoEditar').val();
    const numDoc = $('#numerodocumentoEditar').val().trim();
    const docInput = $('#numerodocumentoEditar');
    const docError = $('#docError');
    
    if (tipoDoc === '1') { // DNI
        if (numDoc.length !== 8 || !/^\d+$/.test(numDoc)) {
            docInput.addClass('is-invalid');
            docError.text('DNI debe tener 8 dígitos');
            return false;
        }
    } else if (tipoDoc === '2' || tipoDoc === '3') { // Carnet Extranjería/Pasaporte
        if (numDoc.length !== 11 || !/^\d+$/.test(numDoc)) {
            docInput.addClass('is-invalid');
            docError.text('Debe tener 11 dígitos');
            return false;
        }
    }
    
    docInput.removeClass('is-invalid');
    return true;
}

// Validación de teléfono
function validarTelefono() {
    const telefono = $('#telefonoEditar').val().trim();
    if (telefono.length !== 9 || !/^\d+$/.test(telefono)) {
        $('#telefonoEditar').addClass('is-invalid');
        return false;
    }
    $('#telefonoEditar').removeClass('is-invalid');
    return true;
}

// Validación de contraseñas
function validarContrasenas() {
    const pass1 = $('#contrasenaEditar').val();
    const pass2 = $('#confirmarContrasenaEditar').val();
    
    if (pass1 && pass1 !== pass2) {
        $('#confirmarContrasenaEditar').addClass('is-invalid');
        return false;
    }
    $('#confirmarContrasenaEditar').removeClass('is-invalid');
    return true;
}

// Función para abrir modal con datos del usuario
function abrirModalEditarUsuario(idUsuario) {
    $.ajax({
        url: 'usuarios/obtener.php',
        type: 'POST',
        data: { idUsuario: idUsuario },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Llenar formulario
                const user = response.data;
                $('#idUsuarioEditar').val(user.idUsuario);
                $('#nombreCompletoEditar').val(user.nombreCompleto);
                $('#apellidosEditar').val(user.apellidos);
                $('#idGeneroEditar').val(user.idGenero);
                $('#idTipoDocumentoEditar').val(user.idTipoDocumento);
                $('#numerodocumentoEditar').val(user.numerodocumento);
                $('#correoEditar').val(user.correo);
                $('#telefonoEditar').val(user.telefono);
                $('#idTipoDireccionEditar').val(user.idTipoDireccion);
                $('#direccionEditar').val(user.direccion);
                $('#idRolEditar').val(user.idRol);
                $('#estadoEditar').val(user.estado);
                
                // Mostrar modal
                $('#modalEditarUsuario').modal('show');
            } else {
                Swal.fire('Error', response.message || 'No se pudo cargar el usuario', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Error al conectar con el servidor', 'error');
        }
    });
}

// Evento para el botón editar
$(document).on('click', '.editar-usuario', function() {
    const idUsuario = $(this).data('id');
    abrirModalEditarUsuario(idUsuario);
});

// Eventos de validación en tiempo real
$('#idTipoDocumentoEditar, #numerodocumentoEditar').on('change keyup', validarDocumento);
$('#telefonoEditar').on('input', validarTelefono);
$('#contrasenaEditar, #confirmarContrasenaEditar').on('keyup', validarContrasenas);

// Evento para guardar cambios
$('#btnActualizarUsuario').click(function() {
    // Validar todo antes de enviar
    const isDocValid = validarDocumento();
    const isPhoneValid = validarTelefono();
    const isPassValid = validarContrasenas();
    
    if (!isDocValid || !isPhoneValid || !isPassValid) {
        Swal.fire('Error', 'Corrija los campos marcados en rojo', 'error');
        return;
    }

    const formData = new FormData($('#formEditarUsuario')[0]);
    
    $.ajax({
        url: 'usuarios/actualizar.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: 'Éxito',
                    text: response.message,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    $('#modalEditarUsuario').modal('hide');
                    location.reload();
                });
            } else {
                Swal.fire('Error', response.message || 'Error al actualizar', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Error al conectar con el servidor', 'error');
        }
    });
});
</script>
