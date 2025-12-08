<!-- Modal para Editar Cliente - Diseño Moderno -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="modalEditarClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarClienteLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-user-edit me-2"></i>Editar Cliente
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalEditarCliente').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCliente" enctype="multipart/form-data">
                    <input type="hidden" id="edit_idCliente" name="idCliente">
                    <input type="hidden" id="edit_tipoCliente" name="tipoCliente">
                    
                    <!-- Campos para Persona Natural -->
                    <div id="edit_camposNatural" class="animate-fade-in">
                        <div class="section-divider">
                            <span>Información Personal</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_nombre" name="nombre" placeholder="Nombres" required>
                                    <label for="edit_nombre">Nombres</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_apellidopat" name="apellidopat" placeholder="Apellido Paterno">
                                    <label for="edit_apellidopat">Apellido Paterno</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_apellidoMat" name="apellidoMat" placeholder="Apellido Materno">
                                    <label for="edit_apellidoMat">Apellido Materno</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="edit_idGenero" name="idGenero" required>
                                        <option value="">Seleccionar</option>
                                    </select>
                                    <label for="edit_idGenero">Género</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider mt-4">
                            <span>Documento de Identidad</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="edit_idTipoDocumento" name="idTipoDocumento" required>
                                        <option value="">Seleccionar</option>
                                    </select>
                                    <label for="edit_idTipoDocumento">Tipo de Documento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_numerodocumento" name="numerodocumento" placeholder="Número de Documento" required readonly>
                                    <label for="edit_numerodocumento">Número de Documento</label>
                                    <div class="invalid-feedback" id="edit_errorDocumento">Por favor, ingrese un documento válido</div>
                                    <div class="invalid-feedback" id="edit_errorDocumentoDuplicado">Este documento ya está registrado</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campos para Empresa -->
                    <div id="edit_camposEmpresa" style="display:none;" class="animate-fade-in">
                        <div class="section-divider">
                            <span>Información de la Empresa</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_razonSocial" name="razonSocial" placeholder="Razón Social" required>
                                    <label for="edit_razonSocial">Razón Social</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="edit_idTipoRuc" name="idTipoRuc" required>
                                        <option value="">Seleccionar</option>
                                    </select>
                                    <label for="edit_idTipoRuc">Tipo de RUC</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_ruc" name="ruc" maxlength="11" placeholder="RUC" required readonly>
                                    <label for="edit_ruc">RUC</label>
                                    <div class="invalid-feedback" id="edit_errorRuc">El RUC debe tener 11 dígitos</div>
                                    <div class="invalid-feedback" id="edit_errorRucDuplicado">Este RUC ya está registrado</div>
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
                                <select class="form-select" id="edit_idTipoDireccion" name="idTipoDireccion" required>
                                    <option value="">Seleccionar</option>
                                </select>
                                <label for="edit_idTipoDireccion">Tipo de Dirección</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_direccion" name="direccion" placeholder="Dirección">
                                <label for="edit_direccion">Dirección</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_telefono" name="telefono" placeholder="Teléfono">
                                <label for="edit_telefono">Teléfono</label>
                                <div class="invalid-feedback" id="edit_errorTelefono">El teléfono debe tener 9 dígitos</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="edit_correo" name="correo" placeholder="Correo Electrónico">
                                <label for="edit_correo">Correo Electrónico</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Estado</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                           <div class="form-group">
                        <label for="edit_status">Estado</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEditarCliente').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarCliente">
                    <i class="fas fa-save me-2"></i>Actualizar Cliente
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para el modal de edición de clientes */
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

#modalEditarCliente .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarCliente .modal-title::after {
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
    // Función para cargar los datos del cliente a editar
    function cargarDatosCliente(id, tipo) {
        $.ajax({
            url: '../clientes/obtener.php',
            type: 'POST',
            data: { id: id, tipo: tipo },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Configurar el tipo de cliente
                    $('#edit_tipoCliente').val(tipo);
                    $('#edit_idCliente').val(id);
                    
                    // Mostrar firma actual si existe
                    if (response.data.firmas) {
                        $('#edit_firmaPreview').attr('src', '../uploads/firmas/' + response.data.firmas).show();
                    } else {
                        $('#edit_firmaPreview').hide();
                    }
                    
                    if (tipo === 'Natural') {
                        // Mostrar campos de persona natural
                        $('#edit_camposNatural').show();
                        $('#edit_camposEmpresa').hide();
                        
                        // Llenar campos básicos
                        $('#edit_nombre').val(response.data.nombre);
                        $('#edit_apellidopat').val(response.data.apellidopat);
                        $('#edit_apellidoMat').val(response.data.apellidoMat);
                        $('#edit_numerodocumento').val(response.data.numerodocumento);
                        
                        // Llenar combos con valores actuales
                        $('#edit_idGenero').val(response.data.idGenero);
                        $('#edit_idTipoDocumento').val(response.data.idTipoDocumento);
                        $('#edit_idTipoDireccion').val(response.data.idTipoDireccion);
                    } else {
                        // Mostrar campos de empresa
                        $('#edit_camposNatural').hide();
                        $('#edit_camposEmpresa').show();
                        
                        // Llenar campos básicos
                        $('#edit_razonSocial').val(response.data.razonSocial);
                        $('#edit_ruc').val(response.data.ruc);
                        
                        // Llenar combos con valores actuales
                        $('#edit_idTipoRuc').val(response.data.idTipoRuc);
                        $('#edit_idTipoDireccion').val(response.data.idTipoDireccion);
                    }
                    
                    // Campos comunes
                    $('#edit_direccion').val(response.data.direccion);
                    $('#edit_telefono').val(response.data.telefono);
                    $('#edit_correo').val(response.data.correo);
                    $('#edit_status').val(response.data.status);
                    
                    // Cargar opciones de los combos
                    cargarCombosEdicion(tipo, response.data);
                    
                    // Mostrar modal
                    $('#modalEditarCliente').modal('show');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar los datos del cliente', 'error');
            }
        });
    }

    // Evento para el botón editar
    $(document).on('click', '.editar-cliente', function() {
        var id = $(this).data('id');
        var tipo = $(this).data('tipo');
        cargarDatosCliente(id, tipo);
    });

    // Validación de teléfono en tiempo real
    $('#edit_telefono').on('input', function() {
        var telefono = $(this).val().replace(/\D/g, '');
        $(this).val(telefono);
        
        if (telefono.length > 9) {
            $('#edit_errorTelefono').removeClass('d-none');
            $(this).val(telefono.substring(0, 9));
        } else if (telefono.length === 9) {
            $('#edit_errorTelefono').addClass('d-none');
        } else {
            $('#edit_errorTelefono').removeClass('d-none');
        }
    });

    // Función para actualizar el cliente
    $('#btnActualizarCliente').click(function() {
        var telefono = $('#edit_telefono').val().replace(/\D/g, '');
        if (telefono.length !== 9) {
            $('#edit_errorTelefono').removeClass('d-none');
            return false;
        }

        var formData = new FormData($('#formEditarCliente')[0]);
        var tipo = $('#edit_tipoCliente').val();
        var url = tipo === 'Natural' ? '../clientes/actualizarpersona.php' : '../clientes/actualizarempresa.php';
        
        var $btn = $('#btnActualizarCliente');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                $btn.prop('disabled', false).html('Actualizar');
                
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#modalEditarCliente').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                $btn.prop('disabled', false).html('Actualizar');
                Swal.fire('Error', 'Error al actualizar el cliente', 'error');
            }
        });
    });

    // Función para cargar los combos con opciones
    function cargarCombosEdicion(tipo, data) {
        // Cargar tipos de documento (solo para Natural)
        if (tipo === 'Natural') {
            $.ajax({
                url: '../clientes/cargartipodoc.php',
                type: 'GET',
                success: function(response) {
                    $('#edit_idTipoDocumento').html('<option value="">Seleccionar</option>' + response);
                    $('#edit_idTipoDocumento').val(data.idTipoDocumento);
                }
            });
        }
        
        // Cargar géneros (solo para Natural)
        if (tipo === 'Natural') {
            $.ajax({
                url: '../clientes/cargargenero.php',
                type: 'GET',
                success: function(response) {
                    $('#edit_idGenero').html('<option value="">Seleccionar</option>' + response);
                    $('#edit_idGenero').val(data.idGenero);
                }
            });
        }
        
        // Cargar tipos de dirección (para ambos)
        $.ajax({
            url: '../clientes/cargartipodirecc.php',
            type: 'GET',
            success: function(response) {
                $('#edit_idTipoDireccion').html('<option value="">Seleccionar</option>' + response);
                $('#edit_idTipoDireccion').val(data.idTipoDireccion);
            }
        });
        
        // Cargar tipos de RUC (solo para Empresa)
        if (tipo === 'Empresa') {
            $.ajax({
                url: '../clientes/cargartiporuc.php',
                type: 'GET',
                success: function(response) {
                    $('#edit_idTipoRuc').html('<option value="">Seleccionar</option>' + response);
                    $('#edit_idTipoRuc').val(data.idTipoRuc);
                }
            });
        }
    }
});
</script>