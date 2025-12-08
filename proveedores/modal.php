<style>
/* Estilos para el modal de proveedores */
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

/* Estilos para el input de archivo */
.file-input-container {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-input-button {
    border: 1px dashed var(--light-gray);
    border-radius: var(--border-radius);
    padding: 15px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    width: 100%;
}

.file-input-button:hover {
    border-color: var(--primary-color);
    background-color: var(--primary-light);
}

.file-input {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-name {
    margin-top: 8px;
    font-size: 14px;
    color: var(--gray-color);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
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
#modalProveedor .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalProveedor .modal-title::after {
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

<!-- Modal para Proveedor - Diseño Moderno -->
<div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="modalProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="modalProveedorLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-truck me-2"></i>Registro de Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-black" aria-label="Close" onclick="$('#modalProveedor').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formProveedor" enctype="multipart/form-data">
                    <input type="hidden" id="idProveedor" name="idProveedor">
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Nombre de la Empresa" required>
                                <label for="nombre_empresa">Nombre de la Empresa</label>
                                <div class="invalid-feedback">Por favor ingrese el nombre de la empresa</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información de Identificación</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idTipoRuc" name="idTipoRuc" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipo_ruc WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoRuc'].'">'.$row['descripcion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idTipoRuc">Tipo de RUC</label>
                                <div class="invalid-feedback">Por favor seleccione un tipo de RUC</div>
                            </div>
                        </div>
                       <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="numero_ruc" name="numero_ruc" placeholder="Número de RUC" required maxlength="11" pattern="\d{11}">
                                            <label for="numero_ruc">Número de RUC</label>
                                            <div class="invalid-feedback" id="ruc-feedback">El RUC debe tener exactamente 11 dígitos</div>
                                        </div>
                                    </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="idGenero" name="idGenero">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM genero WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idGenero'].'">'.$row['genero'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idGenero">Género</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información de Contacto</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contacto_nombre" name="contacto_nombre" placeholder="Nombre de Contacto">
                                <label for="contacto_nombre">Nombre de Contacto</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="contacto_telefono" name="contacto_telefono" placeholder="Teléfono de Contacto" maxlength="9" pattern="\d{9}">
                                <label for="contacto_telefono">Teléfono de Contacto</label>
                                <div class="invalid-feedback">El teléfono debe tener exactamente 9 dígitos</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="contacto_correo" name="contacto_correo" placeholder="Correo de Contacto">
                                <label for="contacto_correo">Correo de Contacto</label>
                                <div class="invalid-feedback">Ingrese un correo electrónico válido</div>
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
                                <textarea class="form-control" id="direccion" name="direccion" placeholder="Dirección Completa" style="height: 100px"></textarea>
                                <label for="direccion">Dirección Completa</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información Adicional</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="estado" name="estado">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="firma" class="form-label">Firma del Proveedor</label>
                            <div class="file-input-container">
                                <div class="file-input-button">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: var(--primary-color);"></i>
                                    <p>Haz clic para subir una imagen</p>
                                    <p class="file-name" id="file-name">No se ha seleccionado ningún archivo</p>
                                </div>
                                <input type="file" class="file-input" id="firma" name="firma" accept="image/*,.pdf,.doc,.docx">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalProveedor').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardarProveedor" disabled>
                    <i class="fas fa-save me-2"></i>Guardar Proveedor
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    // Variables para controlar la validación del RUC
    let rucValido = false;
    let rucUnico = false;
    let validandoRuc = false;

    // Función para validar el formulario
    function validarFormulario() {
        let isValid = true;
        
        // Validar campos requeridos
        $('#formProveedor [required]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Validar RUC (11 dígitos)
        const ruc = $('#numero_ruc').val().trim();
        if (ruc.length !== 11) {
            $('#numero_ruc').addClass('is-invalid');
            rucValido = false;
            isValid = false;
        } else {
            $('#numero_ruc').removeClass('is-invalid');
            rucValido = true;
        }
        
        // Validar teléfono (9 dígitos si está presente)
        const telefono = $('#contacto_telefono').val().trim();
        if (telefono !== '' && telefono.length !== 9) {
            $('#contacto_telefono').addClass('is-invalid');
            isValid = false;
        } else {
            $('#contacto_telefono').removeClass('is-invalid');
        }
        
        // Validar email si está presente
        const email = $('#contacto_correo').val().trim();
        if (email !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#contacto_correo').addClass('is-invalid');
            isValid = false;
        } else {
            $('#contacto_correo').removeClass('is-invalid');
        }
        
        // Deshabilitar botón si el RUC no es único
        const isUpdate = $('#idProveedor').val() !== '';
        const botonHabilitado = isValid && (isUpdate || (rucUnico && rucValido));
        
        $('#btnGuardarProveedor').prop('disabled', !botonHabilitado);
        
        return isValid;
    }

    // Función para verificar si el RUC ya existe
    function verificarRucUnico() {
        const tipoRuc = $('#idTipoRuc').val();
        const numeroRuc = $('#numero_ruc').val().trim();
        const idProveedor = $('#idProveedor').val() || null;
        
        if (!tipoRuc || numeroRuc.length !== 11 || validandoRuc) {
            return;
        }
        
        validandoRuc = true;
        $('#numero_ruc').addClass('validando');
        
        $.ajax({
            url: '../proveedores/verificar_ruc.php',
            type: 'GET',
            data: {
                idTipoRuc: tipoRuc,
                numero_ruc: numeroRuc,
                idProveedor: idProveedor
            },
            dataType: 'json',
            success: function(response) {
                if (response.existe) {
                    $('#numero_ruc').addClass('is-invalid');
                    $('#ruc-feedback').removeClass('d-none').text('Este RUC ya está registrado para este tipo de RUC');
                    rucUnico = false;
                } else {
                    $('#numero_ruc').removeClass('is-invalid');
                    $('#ruc-feedback').addClass('d-none');
                    rucUnico = true;
                }
                validarFormulario();
            },
            error: function(xhr) {
                console.error('Error al verificar RUC:', xhr.responseText);
                rucUnico = false;
                validarFormulario();
            },
            complete: function() {
                validandoRuc = false;
                $('#numero_ruc').removeClass('validando');
            }
        });
    }

    // Eventos de validación en tiempo real
    $('#numero_ruc').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
        validarFormulario();
        
        // Verificar RUC único solo cuando tenga 11 dígitos
        if (this.value.length === 11) {
            verificarRucUnico();
        } else {
            rucUnico = false;
            validarFormulario();
        }
    });
    
    $('#idTipoRuc').on('change', function() {
        if ($('#numero_ruc').val().trim().length === 11) {
            verificarRucUnico();
        }
    });
    
    $('#contacto_telefono').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);
        validarFormulario();
    });
    
    $('#contacto_correo, #nombre_empresa, #idTipoDireccion').on('input change', validarFormulario);
    
    // Mostrar nombre del archivo seleccionado
    $('#firma').change(function() {
        $('#file-name').text(this.files.length ? this.files[0].name : 'No se ha seleccionado ningún archivo');
    });
    
    // Enviar formulario
    $('#btnGuardarProveedor').click(function(e) {
        e.preventDefault();
        
        if (!validarFormulario()) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor complete todos los campos requeridos correctamente'
            });
            return;
        }
        
        const formData = new FormData($('#formProveedor')[0]);
        const isUpdate = $('#idProveedor').val() !== '';
        
        $.ajax({
            url: '../proveedores/guardar.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                $('#btnGuardarProveedor').prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...'
                );
            },
            complete: function() {
                $('#btnGuardarProveedor').prop('disabled', false).html('Guardar');
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#modalProveedor').modal('hide');
                        if (isUpdate) {
                            // Actualizar la fila en la tabla si es edición
                            actualizarFilaProveedor(response.id);
                        } else {
                            // Recargar o agregar nueva fila si es nuevo
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error desconocido al procesar la solicitud'
                    });
                }
            },
            error: function(xhr) {
                let errorMsg = 'Error en la comunicación con el servidor';
                try {
                    const response = JSON.parse(xhr.responseText);
                    errorMsg = response.message || errorMsg;
                } catch (e) {
                    errorMsg = xhr.statusText || errorMsg;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg
                });
            }
        });
    });
    
    // Función para actualizar la fila en la tabla (opcional)
    function actualizarFilaProveedor(idProveedor) {
        // Implementar lógica para actualizar la fila sin recargar la página
        // Esto depende de cómo tengas estructurada tu tabla de proveedores
        console.log('Actualizar proveedor ID:', idProveedor);
        // location.reload(); // Opción simple si no implementas actualización dinámica
    }
});
</script>