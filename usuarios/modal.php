<style>
/* Estilos para el modal de usuarios */
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

.modal-header {
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

.modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

.modal-body {
    padding: 25px;
    max-height: 75vh;
    overflow-y: auto;
}

.modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
}

/* Estilos para el contenido del formulario */
.form-content {
    margin-top: 20px;
}

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
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus,
.form-floating > .form-control-plaintext:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

.form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label,
.form-floating > .form-control-plaintext ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

.form-floating > .form-control-plaintext ~ label::after {
    background-color: transparent;
}

/* Textarea específico */
textarea.form-control {
    min-height: 100px;
    resize: vertical;
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

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white;
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

.btn-sm {
    padding: 5px 10px;
    font-size: 0.875rem;
}

.btn-close {
    opacity: 0.5;
    transition: var(--transition);
}

.btn-close:hover {
    opacity: 1;
}

/* Estilo para el botón de mostrar contraseña */
.password-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-color);
    cursor: pointer;
    z-index: 5;
}

.password-toggle:hover {
    color: var(--primary-color);
}

.password-input-container {
    position: relative;
}

/* Tablas en modales de búsqueda */
.table {
    color: var(--text-color);
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    background-color: var(--light-gray);
    border-bottom: 2px solid var(--light-gray);
}

.table-hover tbody tr:hover {
    background-color: var(--light-color);
}

/* Input group para búsqueda */
.input-group {
    border-radius: var(--border-radius);
    overflow: hidden;
}

.input-group .form-control {
    border-right: none;
}

.input-group .btn {
    border-left: none;
    background-color: white;
}

/* Personalizaciones para bootstrap */
.row {
    --bs-gutter-x: 1.5rem;
}

.g-3 {
    --bs-gutter-y: 1rem;
}

.mt-1 {
    margin-top: 0.5rem !important;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-4 {
    margin-top: 2rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.me-1 {
    margin-right: 0.25rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

/* Estilos para campos inválidos */
.is-invalid {
    border-color: var(--danger-color) !important;
}

.invalid-feedback {
    color: var(--danger-color);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Responsividad */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 0.5rem auto;
    }
    
    .modal-body {
        padding: 15px;
    }
    
    .section-divider span {
        font-size: 12px;
    }
}
#modalUsuario .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalUsuario .modal-title::after {
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

<!-- Modal para Usuario - Diseño Moderno -->
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="modalUsuarioLabel" style="font-size:23px; color:black">
                    <i class="fas fa-user-plus me-2"></i>Registro de Usuario
                </h5>
                <button type="button" class="btn-close btn-close-black" aria-label="Close" onclick="$('#modalUsuario').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" enctype="multipart/form-data">
                    <input type="hidden" id="idUsuario" name="idUsuario">
                    
                    <div class="section-divider">
                        <span>Información Personal</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" placeholder="Nombres" required>
                                <label for="nombreCompleto">Nombres</label>
                                <div class="invalid-feedback">Por favor ingrese los nombres</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                <label for="apellidos">Apellidos</label>
                                <div class="invalid-feedback">Por favor ingrese los apellidos</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idGenero" name="idGenero" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM genero WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idGenero'].'">'.$row['genero'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idGenero">Género</label>
                                <div class="invalid-feedback">Por favor seleccione un género</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDocumento" name="idTipoDocumento" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodocumento WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoDocumento'].'">'.$row['tipoDocumento'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDocumento">Tipo de Documento</label>
                                <div class="invalid-feedback">Por favor seleccione un tipo de documento</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="numerodocumento" name="numerodocumento" placeholder="Número de Documento" required maxlength="11">
                                <label for="numerodocumento">Número de Documento</label>
                                <div class="invalid-feedback" id="documento-feedback">Por favor ingrese el número de documento</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información de Contacto</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>
                                <label for="correo">Correo Electrónico</label>
                                <div class="invalid-feedback">Por favor ingrese un correo válido</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" maxlength="9" pattern="\d{9}" required>
                                <label for="telefono">Teléfono</label>
                                <div class="invalid-feedback">El teléfono debe tener exactamente 9 dígitos</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-floating password-input-container">
                                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                                <label for="contrasena">Contraseña</label>
                                <button type="button" class="password-toggle" onclick="togglePassword('contrasena')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">Por favor ingrese una contraseña</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating password-input-container">
                                <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
                                <label for="confirmar_contrasena">Confirmar Contraseña</label>
                                <button type="button" class="password-toggle" onclick="togglePassword('confirmar_contrasena')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">Las contraseñas no coinciden</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información de Dirección</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoDireccion" name="idTipoDireccion" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodireccion WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoDireccion'].'">'.$row['tipoDireccion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idTipoDireccion">Tipo de Dirección</label>
                                <div class="invalid-feedback">Por favor seleccione un tipo de dirección</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <textarea class="form-control" id="direccion" name="direccion" placeholder="Dirección Completa" style="height: 100px" required></textarea>
                                <label for="direccion">Dirección Completa</label>
                                <div class="invalid-feedback">Por favor ingrese la dirección</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="idRol" name="idRol" required>
                                    <option value="">Seleccionar Rol</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM roles");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idRol'].'">'.$row['nombreRol'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idRol">Rol del Usuario</label>
                                <div class="invalid-feedback">Por favor seleccione un rol</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalUsuario').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarUsuario" disabled>
                    <i class="fas fa-save me-2"></i>Guardar Usuario
                </button>
            </div>
        </div>
    </div>
</div>
<script>
// Función para mostrar/ocultar contraseña
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

$(document).ready(function() {
    // Variables para controlar la validación de documento único
    let documentoValido = false;
    let documentoValidando = false;

    // Validar documento según tipo seleccionado
    $('#idTipoDocumento').change(function() {
        validarDocumento();
    });
    
    $('#numerodocumento').on('input', function() {
        validarDocumento();
    });
    
    function validarDocumento() {
        const tipoDoc = $('#idTipoDocumento').val();
        const numDoc = $('#numerodocumento').val();
        const docInput = $('#numerodocumento');
        const docFeedback = $('#documento-feedback');
        const btnGuardar = $('#btnGuardarUsuario');
        
        // Resetear estado de validación
        documentoValido = false;
        btnGuardar.prop('disabled', true);
        
        // Obtener el nombre del tipo de documento seleccionado
        const tipoDocNombre = $('#idTipoDocumento option:selected').text().toLowerCase();
        
        if (tipoDoc === '') {
            docInput.removeClass('is-invalid');
            docFeedback.text('Por favor seleccione un tipo de documento primero');
            return;
        }
        
        // Validar formato según tipo de documento
        if (tipoDocNombre.includes('dni')) {
            docInput.attr('maxlength', '8');
            
            if (numDoc.length !== 8 || !/^\d+$/.test(numDoc)) {
                docInput.addClass('is-invalid');
                docFeedback.text('El DNI debe tener exactamente 8 dígitos numéricos');
                return;
            }
        } else {
            docInput.attr('maxlength', '11');
            
            if (numDoc.length !== 11 || !/^\d+$/.test(numDoc)) {
                docInput.addClass('is-invalid');
                docFeedback.text('El documento debe tener exactamente 11 dígitos numéricos');
                return;
            }
        }
        
        // Si el formato es correcto, verificar si ya existe en la base de datos
        if (numDoc.length > 0 && !documentoValidando) {
            documentoValidando = true;
            docFeedback.text('Verificando documento...');
            
            $.ajax({
                url: '../usuarios/verficar.php',
                type: 'POST',
                data: {
                    idTipoDocumento: tipoDoc,
                    numerodocumento: numDoc,
                    idUsuario: $('#idUsuario').val() || 0 // Para excluir al usuario actual en edición
                },
                dataType: 'json',
                success: function(response) {
                    documentoValidando = false;
                    
                    if (response.existe) {
                        docInput.addClass('is-invalid');
                        docFeedback.text('Este número de documento ya está registrado para este tipo de documento');
                        documentoValido = false;
                    } else {
                        docInput.removeClass('is-invalid');
                        docFeedback.text('');
                        documentoValido = true;
                        verificarEstadoBotonGuardar();
                    }
                },
                error: function() {
                    documentoValidando = false;
                    docInput.addClass('is-invalid');
                    docFeedback.text('Error al verificar documento');
                    documentoValido = false;
                }
            });
        }
    }
    
    // Validar teléfono (9 dígitos)
    $('#telefono').on('input', function() {
        const telefono = $(this).val();
        
        if (telefono.length !== 9 || !/^\d+$/.test(telefono)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
        verificarEstadoBotonGuardar();
    });
    
    // Validación de contraseñas coincidentes
    $('#confirmar_contrasena').on('keyup', function() {
        if ($('#contrasena').val() !== $('#confirmar_contrasena').val()) {
            $('#confirmar_contrasena').addClass('is-invalid');
        } else {
            $('#confirmar_contrasena').removeClass('is-invalid');
        }
        verificarEstadoBotonGuardar();
    });

    // Función para verificar si se puede habilitar el botón guardar
    function verificarEstadoBotonGuardar() {
        const form = document.getElementById('formUsuario');
        const telefonoValido = $('#telefono').val().length === 9 && /^\d+$/.test($('#telefono').val());
        const contrasenasValidas = $('#contrasena').val() === $('#confirmar_contrasena').val();
        const esNuevo = $('#idUsuario').val() === '';
        
        // Validar si todos los campos requeridos están llenos y válidos
        let formularioValido = true;
        $(form).find('[required]').each(function() {
            if (!$(this).val()) {
                formularioValido = false;
                return false; // Salir del each
            }
        });
        
        // Solo validar contraseña si es nuevo usuario o si se está cambiando
        if (!esNuevo && $('#contrasena').val() === '' && $('#confirmar_contrasena').val() === '') {
            contrasenasValidas = true;
        }
        
        // Habilitar botón solo si todo es válido
        $('#btnGuardarUsuario').prop('disabled', 
            !formularioValido || 
            !documentoValido || 
            !telefonoValido || 
            !contrasenasValidas ||
            $('#numerodocumento').hasClass('is-invalid') ||
            $('#telefono').hasClass('is-invalid') ||
            $('#confirmar_contrasena').hasClass('is-invalid')
        );
    }

    // Validación de formulario antes de enviar
    $('#btnGuardarUsuario').click(function() {
        let form = $('#formUsuario')[0];
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            guardarUsuario();
        }
        form.classList.add('was-validated');
    });

    function guardarUsuario() {
        let formData = new FormData($('#formUsuario')[0]);
        
        $.ajax({
            url: '../usuarios/guardar.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#modalUsuario').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
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
    }
});

// Función para editar usuario (llamar desde tu tabla principal)
function editarUsuario(idUsuario) {
    $.ajax({
        url: '../usuarios/obtener.php',
        type: 'POST',
        data: {idUsuario: idUsuario},
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                $('#idUsuario').val(response.data.idUsuario);
                $('#nombreCompleto').val(response.data.nombreCompleto);
                $('#apellidos').val(response.data.apellidos);
                $('#idGenero').val(response.data.idGenero);
                $('#correo').val(response.data.correo);
                $('#contrasena').val('').attr('placeholder', 'Dejar en blanco para no cambiar');
                $('#confirmar_contrasena').val('').attr('placeholder', 'Dejar en blanco para no cambiar');
                $('#idTipoDireccion').val(response.data.idTipoDireccion);
                $('#direccion').val(response.data.direccion);
                $('#telefono').val(response.data.telefono);
                $('#idTipoDocumento').val(response.data.idTipoDocumento);
                $('#numerodocumento').val(response.data.numerodocumento);
                $('#idRol').val(response.data.idRol);
                $('#estado').val(response.data.estado);
                
                // Validar documento según el tipo seleccionado
                validarDocumento();
                
                $('#modalUsuario').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al obtener los datos del usuario: ' + error
            });
        }
    });
}

// Función para abrir el modal en modo nuevo
function abrirModalUsuario() {
    if (typeof $('#modalUsuario').modal !== 'function') {
        console.error('Bootstrap Modal no está cargado correctamente');
        alert('Error al cargar el sistema. Recarga la página.');
        return;
    }
    
    // Resetear el formulario
    const form = document.getElementById('formUsuario');
    if (form) {
        form.reset();
        form.classList.remove('was-validated');
    }
    
    // Resetear el campo de ID
    $('#idUsuario').val('');
    
    // Cambiar el texto del modal para nuevo registro
    $('#modalUsuarioLabel').html('<i class="fas fa-user-plus me-2"></i>Registrar Nuevo Usuario');
    
    // Mostrar el modal
    $('#modalUsuario').modal('show');
    
    // Habilitar el botón de guardar
    $('#btnGuardarUsuario').prop('disabled', false);
}
</script>