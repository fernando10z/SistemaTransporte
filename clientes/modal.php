<!-- Modal para Clientes - Diseño Moderno -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modalClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalClienteLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-user-plus me-2"></i>Registro de Cliente
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalCliente').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formCliente" enctype="multipart/form-data">
                    <input type="hidden" id="idCliente" name="idCliente">
                    
                    <!-- Selector de Tipo de Cliente -->
                    <div class="tipo-cliente-selector mb-4">
                        <label class="form-label fw-medium mb-3">Tipo de Cliente</label>
                        <div class="d-flex gap-4">
                            <div class="tipo-cliente-option" id="selectorNatural">
                                <input class="form-check-input" type="radio" name="tipoCliente" id="tipoNatural" value="Natural" checked>
                                <label class="tipo-cliente-label" for="tipoNatural">
                                    <div class="icon-container">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Persona Natural</span>
                                </label>
                            </div>
                            <div class="tipo-cliente-option" id="selectorEmpresa">
                                <input class="form-check-input" type="radio" name="tipoCliente" id="tipoEmpresa" value="Empresa">
                                <label class="tipo-cliente-label" for="tipoEmpresa">
                                    <div class="icon-container">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>Empresa</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-content">
                        <!-- Campos para Persona Natural -->
                        <div id="camposNatural" class="animate-fade-in">
                            <div class="section-divider">
                                <span>Información Personal</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                                        <label for="nombre">Nombres</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="apellidopat" name="apellidopat" placeholder="Apellido Paterno">
                                        <label for="apellidopat">Apellido Paterno</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="apellidoMat" name="apellidoMat" placeholder="Apellido Materno">
                                        <label for="apellidoMat">Apellido Materno</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="idGenero" name="idGenero" required>
                                            <option value="">Seleccionar</option>
                                        </select>
                                        <label for="idGenero">Género</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="section-divider mt-4">
                                <span>Documento de Identidad</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="idTipoDocumento" name="idTipoDocumento" required>
                                            <option value="">Seleccionar</option>
                                        </select>
                                        <label for="idTipoDocumento">Tipo de Documento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="numerodocumento" name="numerodocumento" placeholder="Número de Documento" required>
                                        <label for="numerodocumento">Número de Documento</label>
                                        <div class="invalid-feedback" id="errorDocumento">Por favor, ingrese un documento válido</div>
                                        <div class="invalid-feedback" id="errorDocumentoDuplicado">Este documento ya está registrado</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Campos para Empresa -->
                        <div id="camposEmpresa" style="display:none;" class="animate-fade-in">
                            <div class="section-divider">
                                <span>Información de la Empresa</span>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" disabled required>
                                        <label for="razonSocial">Razón Social</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="idTipoRuc" name="idTipoRuc" disabled required>
                                            <option value="">Seleccionar</option>
                                        </select>
                                        <label for="idTipoRuc">Tipo de RUC</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="ruc" name="ruc" maxlength="11" placeholder="RUC" disabled required>
                                        <label for="ruc">RUC</label>
                                        <div class="invalid-feedback" id="errorRuc">El RUC debe tener 11 dígitos</div>
                                        <div class="invalid-feedback" id="errorRucDuplicado">Este RUC ya está registrado</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Campos comunes -->
                        <div class="section-divider mt-4">
                            <span>Información de Contacto</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="idTipoDireccion" name="idTipoDireccion" required>
                                        <option value="">Seleccionar</option>
                                    </select>
                                    <label for="idTipoDireccion">Tipo de Dirección</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                                    <label for="direccion">Dirección</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                                    <label for="telefono">Teléfono</label>
                                    <div class="invalid-feedback" id="errorTelefono">El teléfono debe tener 9 dígitos</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico">
                                    <label for="correo">Correo Electrónico</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Información Adicional</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Firma Digital</label>
                                <div class="file-upload-container">
                                    <div class="file-upload-preview" id="previewFirma">
                                        <img id="firmaPreview" src="#" alt="Vista previa de la firma">
                                        <div class="file-preview-overlay">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                    </div>
                                    <div class="file-upload-input">
                                        <input type="file" id="firmas" name="firmas" accept="image/*" class="form-control">
                                        <label for="firmas" class="file-upload-label">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>Seleccionar archivo</span>
                                        </label>
                                        <div class="file-upload-hints">
                                            <small>Formatos: JPG, PNG, GIF</small>
                                            <small>Máx. 2MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Estado</label>
                                <div class="status-selector">
                                    <div class="form-check form-switch form-switch-lg">
                                        <input class="form-check-input" type="checkbox" id="statusSwitch" checked>
                                        <input type="hidden" id="status" name="status" value="Activo">
                                        <label class="form-check-label" for="statusSwitch">
                                            <span class="status-text active">Activo</span>
                                            <span class="status-text inactive">Inactivo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalCliente').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarCliente" disabled>
                    <i class="fas fa-save me-2"></i>Guardar Cliente
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para el modal de clientes */
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
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 20px 25px;
}

#modalCliente .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalCliente .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 50px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

.modal-body {
    padding: 25px;
    max-height: 75vh;
    overflow-y: auto;
}

.modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

/* Selector de tipo de cliente */
.tipo-cliente-selector {
    padding-bottom: 20px;
    border-bottom: 1px solid var(--light-gray);
}

.tipo-cliente-option {
    position: relative;
    width: 170px;
}

.tipo-cliente-option .form-check-input {
    position: absolute;
    opacity: 0;
}

.tipo-cliente-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
    border: 2px solid var(--light-gray);
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    text-align: center;
}

.tipo-cliente-label .icon-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background-color: var(--primary-light);
    border-radius: 50%;
    margin-bottom: 12px;
    color: var(--primary-color);
    font-size: 20px;
    transition: var(--transition);
}

.tipo-cliente-label span {
    font-weight: 500;
    color: var(--dark-color);
    transition: var(--transition);
}

.tipo-cliente-option .form-check-input:checked + .tipo-cliente-label {
    border-color: var(--primary-color);
    background-color: var(--primary-light);
}

.tipo-cliente-option .form-check-input:checked + .tipo-cliente-label .icon-container {
    background-color: var(--primary-color);
    color: white;
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
.form-floating > .form-select {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
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

/* Estilos para etiquetas y texto */
.form-label {
    color: var(--dark-color);
    margin-bottom: 8px;
}

.fw-medium {
    font-weight: 500;
}

/* Estilos para la carga de archivos */
.file-upload-container {
    display: flex;
    align-items: center;
    gap: 15px;
}

.file-upload-preview {
    width: 100px;
    height: 100px;
    border-radius: var(--border-radius);
    overflow: hidden;
    position: relative;
    background-color: var(--light-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px dashed var(--gray-color);
}

.file-upload-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file-preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    opacity: 0;
    transition: var(--transition);
}

.file-upload-preview:hover .file-preview-overlay {
    opacity: 1;
}

.file-upload-input {
    flex: 1;
}

.file-upload-input input[type="file"] {
    display: none;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 15px;
    border: 1px dashed var(--gray-color);
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    background-color: var(--light-color);
}

.file-upload-label:hover {
    background-color: var(--primary-light);
    border-color: var(--primary-color);
}

.file-upload-label i {
    font-size: 24px;
    margin-bottom: 8px;
    color: var(--primary-color);
}

.file-upload-label span {
    font-weight: 500;
    color: var(--dark-color);
}

.file-upload-hints {
    display: flex;
    justify-content: space-between;
    margin-top: 8px;
}

.file-upload-hints small {
    color: var(--gray-color);
    font-size: 11px;
}

/* Selector de estado (switch) */
.status-selector {
    display: flex;
    align-items: center;
    margin-top: 8px;
}

.form-switch-lg {
    padding-left: 2.75rem;
}

.form-switch-lg .form-check-input {
    width: 3rem;
    height: 1.5rem;
    border-radius: 1.5rem;
    background-color: #ccc;
    border: none;
}

.form-switch-lg .form-check-input:checked {
    background-color: var(--success-color);
    border-color: var(--success-color);
}

.form-switch-lg .form-check-input:focus {
    box-shadow: 0 0 0 3px rgba(54, 179, 126, 0.15);
}

.form-check-label .status-text {
    margin-left: 10px;
    font-weight: 500;
}

.form-check-label .status-text.active {
    color: var(--success-color);
    display: inline;
}

.form-check-label .status-text.inactive {
    color: var(--danger-color);
    display: none;
}

.form-switch-lg .form-check-input:not(:checked) ~ .form-check-label .status-text.active {
    display: none;
}

.form-switch-lg .form-check-input:not(:checked) ~ .form-check-label .status-text.inactive {
    display: inline;
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

/* Animaciones */
.animate-fade-in {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
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

.mt-4 {
    margin-top: 2rem !important;
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

.gap-4 {
    gap: 1.5rem !important;
}
</style>

<script>
$(document).ready(function() {
    // Variables para almacenar las longitudes máximas
    var maxLengthDoc = 0;
    var maxLengthRuc = 11;
    var maxLengthTelefono = 9;
    var documentoDuplicado = false;
    var rucDuplicado = false;
    
    // Inicializar vista previa de firma
    $('#previewFirma').hide();
    
    // Cargar combos al iniciar
    cargarCombos();
    
    // Función para cargar los combos desde la base de datos
    function cargarCombos() {
        // Cargar tipos de documento
        $.ajax({
            url: '../clientes/cargartipodoc.php',
            type: 'GET',
            success: function(response) {
                $('#idTipoDocumento').html('<option value="">Seleccionar</option>' + response);
            },
            error: function(xhr, status, error) {
                console.error('Error cargando tipos de documento:', error);
                notificarError('No se pudieron cargar los tipos de documento');
            }
        });
        
        // Cargar géneros
        $.ajax({
            url: '../clientes/cargargenero.php',
            type: 'GET',
            success: function(response) {
                $('#idGenero').html('<option value="">Seleccionar</option>' + response);
            },
            error: function(xhr, status, error) {
                console.error('Error cargando géneros:', error);
                notificarError('No se pudieron cargar los géneros');
            }
        });
        
        // Cargar tipos de dirección
        $.ajax({
            url: '../clientes/cargartipodirecc.php',
            type: 'GET',
            success: function(response) {
                $('#idTipoDireccion').html('<option value="">Seleccionar</option>' + response);
            },
            error: function(xhr, status, error) {
                console.error('Error cargando tipos de dirección:', error);
                notificarError('No se pudieron cargar los tipos de dirección');
            }
        });
        
        // Cargar tipos de RUC
        $.ajax({
            url: '../clientes/cargartiporuc.php',
            type: 'GET',
            success: function(response) {
                $('#idTipoRuc').html('<option value="">Seleccionar</option>' + response);
            },
            error: function(xhr, status, error) {
                console.error('Error cargando tipos de RUC:', error);
                notificarError('No se pudieron cargar los tipos de RUC');
            }
        });
    }
    
    // Función para mostrar notificaciones de error
    function notificarError(mensaje) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#f55252',
            customClass: {
                popup: 'swal-error-toast'
            }
        });
    }

    // Mostrar vista previa de la firma
    $('#firmas').change(function() {
        if (this.files && this.files[0]) {
            var file = this.files[0];
            
            // Validar tamaño máximo (2MB)
            if (file.size > 2 * 1024 * 1024) {
                notificarError('El archivo es demasiado grande. El tamaño máximo permitido es 2MB');
                $(this).val('');
                return;
            }
            
            // Validar tipo de archivo
            if (!file.type.match('image.*')) {
                notificarError('Solo se permiten imágenes (JPG, PNG, GIF)');
                $(this).val('');
                return;
            }
            
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#firmaPreview').attr('src', e.target.result);
                $('#previewFirma').fadeIn(300);
            }
            reader.readAsDataURL(file);
            
            // Actualizar label del input file
            $(this).next('.file-upload-label').find('span').text(file.name);
        }
    });

    // Toggle estado con switch
    $('#statusSwitch').change(function() {
        if($(this).is(':checked')) {
            $('#status').val('Activo');
        } else {
            $('#status').val('Inactivo');
        }
    });

    // Función para verificar documento duplicado
    function verificarDocumentoDuplicado() {
        var tipoDoc = $('#idTipoDocumento').val();
        var numDoc = $('#numerodocumento').val();
        
        if (tipoDoc && numDoc && numDoc.length === maxLengthDoc) {
            $.ajax({
                url: '../clientes/verificar_documento.php',
                type: 'POST',
                data: {
                    tipoDocumento: tipoDoc,
                    numeroDocumento: numDoc,
                    idCliente: $('#idCliente').val() || 0
                },
                success: function(res) {
                    if (res.existe) {
                        $('#numerodocumento').addClass('is-invalid');
                        $('#errorDocumento').hide();
                        $('#errorDocumentoDuplicado').show();
                        documentoDuplicado = true;
                    } else {
                        $('#errorDocumentoDuplicado').hide();
                        if ($('#numerodocumento').val().length === maxLengthDoc) {
                            $('#numerodocumento').removeClass('is-invalid');
                        }
                        documentoDuplicado = false;
                    }
                    validarFormulario();
                }
            });
        }
    }

    // Función para verificar RUC duplicado
    function verificarRucDuplicado() {
        var ruc = $('#ruc').val();
        
        if (ruc && ruc.length === maxLengthRuc) {
            $.ajax({
                url: '../clientes/verificar_ruc.php',
                type: 'POST',
                data: { 
                    ruc: ruc,
                    idEmpresa: $('#idCliente').val() || 0
                },
                success: function(res) {
                    if (res.existe) {
                        $('#ruc').addClass('is-invalid');
                        $('#errorRuc').hide();
                        $('#errorRucDuplicado').show();
                        rucDuplicado = true;
                    } else {
                        $('#errorRucDuplicado').hide();
                        if ($('#ruc').val().length === maxLengthRuc) {
                            $('#ruc').removeClass('is-invalid');
                        }
                        rucDuplicado = false;
                    }
                    validarFormulario();
                }
            });
        }
    }

    // Función para cambiar entre campos de Natural y Empresa
    function toggleCamposCliente() {
        if ($('#tipoNatural').is(':checked')) {
            $('#camposEmpresa').hide();
            $('#camposNatural').fadeIn(300);
            $('#nombre, #apellidopat, #apellidoMat, #idGenero, #idTipoDocumento, #numerodocumento').prop('disabled', false).prop('required', true);
            $('#razonSocial, #ruc, #idTipoRuc').prop('disabled', true).prop('required', false);
            $('#razonSocial, #ruc').val('');
            $('#idTipoRuc').val('');
            
            // Resaltar visualmente el selector seleccionado
            $('#selectorNatural').addClass('selected');
            $('#selectorEmpresa').removeClass('selected');
        } else {
            $('#camposNatural').hide();
            $('#camposEmpresa').fadeIn(300);
            $('#razonSocial, #ruc, #idTipoRuc').prop('disabled', false).prop('required', true);
            $('#nombre, #apellidopat, #apellidoMat, #idGenero, #idTipoDocumento, #numerodocumento').prop('disabled', true).prop('required', false);
            $('#nombre, #apellidopat, #apellidoMat, #numerodocumento').val('');
            $('#idGenero, #idTipoDocumento').val('');
            
            // Resaltar visualmente el selector seleccionado
            $('#selectorEmpresa').addClass('selected');
            $('#selectorNatural').removeClass('selected');
        }
        validarFormulario();
    }

    // Eventos
    $('input[name="tipoCliente"]').change(toggleCamposCliente);

    $('#idTipoDocumento').change(function() {
        var tipoDoc = $(this).val();
        if (tipoDoc == "1") {
            maxLengthDoc = 8;
            $('#errorDocumento').text('El DNI debe tener 8 dígitos');
        } else if (tipoDoc == "2" || tipoDoc == "3") {
            maxLengthDoc = 12;
            $('#errorDocumento').text('El documento debe tener 12 dígitos');
        } else {
            maxLengthDoc = 0;
        }
        
        // Validar el número de documento actual si hay uno
        if ($('#numerodocumento').val().length > 0) {
            validarNumeroDocumento();
        } else {
            $('#numerodocumento').removeClass('is-invalid');
        }
        
        validarFormulario();
    });

    function validarNumeroDocumento() {
        var numDoc = $('#numerodocumento').val();
        
        if (maxLengthDoc > 0) {
            if (numDoc.length === maxLengthDoc) {
                $('#numerodocumento').removeClass('is-invalid');
                verificarDocumentoDuplicado();
            } else if (numDoc.length > 0) {
                $('#numerodocumento').addClass('is-invalid');
                $('#errorDocumento').show();
                $('#errorDocumentoDuplicado').hide();
            } else {
                $('#numerodocumento').removeClass('is-invalid');
            }
        }
    }

    $('#numerodocumento').on('input', function() {
        var value = this.value.replace(/[^0-9]/g, '');
        if (maxLengthDoc > 0 && value.length > maxLengthDoc) {
            value = value.slice(0, maxLengthDoc);
        }
        this.value = value;
        
        validarNumeroDocumento();
        validarFormulario();
    });

    function validarRuc() {
        var ruc = $('#ruc').val();
        
        if (ruc.length === maxLengthRuc) {
            $('#ruc').removeClass('is-invalid');
            verificarRucDuplicado();
        } else if (ruc.length > 0) {
            $('#ruc').addClass('is-invalid');
            $('#errorRuc').show();
            $('#errorRucDuplicado').hide();
        } else {
            $('#ruc').removeClass('is-invalid');
        }
    }

    $('#ruc').on('input', function() {
        var value = this.value.replace(/[^0-9]/g, '');
        if (value.length > maxLengthRuc) {
            value = value.slice(0, maxLengthRuc);
        }
        this.value = value;
        
        validarRuc();
        validarFormulario();
    });

    function validarTelefono() {
        var telefono = $('#telefono').val();
        
        if (telefono.length === maxLengthTelefono || telefono.length === 0) {
            $('#telefono').removeClass('is-invalid');
        } else if (telefono.length > 0) {
            $('#telefono').addClass('is-invalid');
        }
    }

    $('#telefono').on('input', function() {
        var value = this.value.replace(/[^0-9]/g, '');
        if (value.length > maxLengthTelefono) {
            value = value.slice(0, maxLengthTelefono);
        }
        this.value = value;
        
        validarTelefono();
        validarFormulario();
    });

    // Función para validar todo el formulario
    function validarFormulario() {
        var valido = true;
        
        if ($('#tipoNatural').is(':checked')) {
            var tipoDoc = $('#idTipoDocumento').val();
            var numDoc = $('#numerodocumento').val();
            
            if (!tipoDoc || !numDoc || numDoc.length !== maxLengthDoc) {
                valido = false;
            }
            
            if (documentoDuplicado) {
                valido = false;
            }
        } else {
            var ruc = $('#ruc').val();
            if (!$('#idTipoRuc').val() || !$('#razonSocial').val() || ruc.length !== maxLengthRuc) {
                valido = false;
            }
            
            if (rucDuplicado) {
                valido = false;
            }
        }
        
        var telefono = $('#telefono').val();
        if (telefono && telefono.length !== maxLengthTelefono) {
            valido = false;
        }
        
        if (valido) {
            $('#btnGuardarCliente').prop('disabled', false).addClass('pulse-animation');
        } else {
            $('#btnGuardarCliente').prop('disabled', true).removeClass('pulse-animation');
        }
        
        return valido;
    }

    // Función para guardar el cliente
    $('#btnGuardarCliente').click(function() {
        if ($('#formCliente')[0].checkValidity() && validarFormulario()) {
            var formData = new FormData($('#formCliente')[0]);
            var url = $('#tipoNatural').is(':checked') ? '../clientes/guardarpersona.php' : '../clientes/guardarempresa.php';
            
            // Botón con animación de carga
            var $btn = $('#btnGuardarCliente');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Guardando...');
            
            // Mostrar notificación de carga
            Swal.fire({
                title: 'Guardando cliente',
                text: 'Por favor espere...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res && res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Cliente guardado!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false,
                            backdrop: `rgba(0,0,0,0.4)`,
                            background: '#fff',
                            customClass: {
                                popup: 'animated bounceIn'
                            }
                        }).then(() => {
                            $('#modalCliente').modal('hide');
                            location.reload();
                        });
                    } else {
                        $btn.prop('disabled', false).html('<i class="fas fa-save me-2"></i>Guardar Cliente');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: (res && res.message) || 'Error al guardar los datos',
                            confirmButtonColor: '#5d87ff'
                        });
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html('<i class="fas fa-save me-2"></i>Guardar Cliente');
                    try {
                        var errRes = xhr.responseJSON || JSON.parse(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errRes.message || 'Error al procesar la solicitud',
                            confirmButtonColor: '#5d87ff'
                        });
                    } catch (e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al conectar con el servidor',
                            confirmButtonColor: '#5d87ff'
                        });
                    }
                }
            });
        } else {
            // Marcar campos inválidos visualmente
            $('#formCliente').find(':required').each(function() {
                if (!this.validity.valid) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            // Notificar sobre campos requeridos
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor complete todos los campos requeridos correctamente',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fff',
                iconColor: '#ffab00'
            });
        }
    });

    // Validar formulario cuando cambie cualquier campo
    $('#formCliente').on('change input', 'input, select', function() {
        // Quitar la clase is-invalid cuando el usuario empiece a editar
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        }
        validarFormulario();
    });

    // Inicializar campos al cargar
    toggleCamposCliente();
});
</script>