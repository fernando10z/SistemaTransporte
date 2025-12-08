<style>
    #modalEditarProveedor .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#modalEditarProveedor .modal-title::after {
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
<!-- Modal para Editar Proveedor -->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalEditarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="modalEditarProveedorLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-edit me-2"></i>Editar Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="$('#modalEditarProveedor').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarProveedor">
                    <input type="hidden" id="edit_idProveedor" name="idProveedor">
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_nombre_empresa" name="nombre_empresa" placeholder="Nombre de la Empresa" required>
                                <label for="edit_nombre_empresa">Nombre de la Empresa</label>
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
                                <select class="form-select" id="edit_idTipoRuc" name="idTipoRuc" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipo_ruc WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoRuc'].'">'.$row['descripcion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="edit_idTipoRuc">Tipo de RUC</label>
                                <div class="invalid-feedback">Por favor seleccione un tipo de RUC</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_numero_ruc" name="numero_ruc" placeholder="Número de RUC" required maxlength="11" pattern="\d{11}">
                                <label for="edit_numero_ruc">Número de RUC</label>
                                <div class="invalid-feedback">El RUC debe tener exactamente 11 dígitos</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="edit_idGenero" name="idGenero">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM genero WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idGenero'].'">'.$row['genero'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="edit_idGenero">Género</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Información de Contacto</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_contacto_nombre" name="contacto_nombre" placeholder="Nombre de Contacto">
                                <label for="edit_contacto_nombre">Nombre de Contacto</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="edit_contacto_telefono" name="contacto_telefono" placeholder="Teléfono de Contacto" maxlength="9" pattern="\d{9}">
                                <label for="edit_contacto_telefono">Teléfono de Contacto</label>
                                <div class="invalid-feedback">El teléfono debe tener exactamente 9 dígitos</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="edit_contacto_correo" name="contacto_correo" placeholder="Correo de Contacto">
                                <label for="edit_contacto_correo">Correo de Contacto</label>
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
                                <select class="form-select" id="edit_idTipoDireccion" name="idTipoDireccion" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $query = $conn->query("SELECT * FROM tipodireccion WHERE status = '1'");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row['idTipoDireccion'].'">'.$row['tipoDireccion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="edit_idTipoDireccion">Tipo de Dirección</label>
                                <div class="invalid-feedback">Por favor seleccione un tipo de dirección</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <textarea class="form-control" id="edit_direccion" name="direccion" placeholder="Dirección Completa" style="height: 100px"></textarea>
                                <label for="edit_direccion">Dirección Completa</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider mt-4">
                        <span>Estado</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="edit_estado" name="estado">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label for="edit_estado">Estado</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#modalEditarProveedor').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarProveedor">
                    <i class="fas fa-save me-2"></i>Actualizar Proveedor
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Función para abrir el modal de edición
    $(document).on('click', '.editar-proveedor', function() {
        const idProveedor = $(this).data('id');
        
        // Mostrar spinner de carga
        $('#btnActualizarProveedor').prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...'
        );
        
        // Limpiar formulario
        $('#formEditarProveedor')[0].reset();
        
        // Obtener datos del proveedor
        $.ajax({
            url: '../proveedores/obtener.php',
            type: 'GET',
            data: { id: idProveedor },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const proveedor = response.data;
                    
                    // Llenar el formulario con los datos del proveedor
                    $('#edit_idProveedor').val(proveedor.idProveedor);
                    $('#edit_nombre_empresa').val(proveedor.nombre_empresa);
                    $('#edit_idTipoRuc').val(proveedor.idTipoRuc);
                    $('#edit_numero_ruc').val(proveedor.numero_ruc);
                    $('#edit_contacto_nombre').val(proveedor.contacto_nombre || '');
                    $('#edit_contacto_telefono').val(proveedor.contacto_telefono || '');
                    $('#edit_contacto_correo').val(proveedor.contacto_correo || '');
                    $('#edit_idTipoDireccion').val(proveedor.idTipoDireccion);
                    $('#edit_direccion').val(proveedor.direccion || '');
                    $('#edit_idGenero').val(proveedor.idGenero || '');
                    $('#edit_estado').val(proveedor.estado || 'Activo');
                    
                    // Mostrar el modal
                    $('#modalEditarProveedor').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al cargar los datos del proveedor'
                    });
                }
            },
            error: function(xhr) {
                let errorMsg = 'Error al cargar los datos del proveedor';
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
            },
            complete: function() {
                $('#btnActualizarProveedor').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Actualizar Proveedor');
            }
        });
    });
    
    // Función para validar el formulario de edición
    function validarFormularioEdicion() {
        let isValid = true;
        
        // Validar campos requeridos
        $('#formEditarProveedor [required]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Validar RUC (11 dígitos)
        const ruc = $('#edit_numero_ruc').val().trim();
        if (ruc.length !== 11) {
            $('#edit_numero_ruc').addClass('is-invalid');
            isValid = false;
        } else {
            $('#edit_numero_ruc').removeClass('is-invalid');
        }
        
        // Validar teléfono (9 dígitos si está presente)
        const telefono = $('#edit_contacto_telefono').val().trim();
        if (telefono !== '' && telefono.length !== 9) {
            $('#edit_contacto_telefono').addClass('is-invalid');
            isValid = false;
        } else {
            $('#edit_contacto_telefono').removeClass('is-invalid');
        }
        
        // Validar email si está presente
        const email = $('#edit_contacto_correo').val().trim();
        if (email !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#edit_contacto_correo').addClass('is-invalid');
            isValid = false;
        } else {
            $('#edit_contacto_correo').removeClass('is-invalid');
        }
        
        return isValid;
    }
    
    // Eventos de validación en tiempo real
    $('#edit_numero_ruc').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
        validarFormularioEdicion();
    });
    
    $('#edit_contacto_telefono').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);
        validarFormularioEdicion();
    });
    
    $('#edit_contacto_correo, #edit_nombre_empresa, #edit_idTipoRuc, #edit_idTipoDireccion').on('input change', validarFormularioEdicion);
    
    // Enviar formulario de edición
    $('#btnActualizarProveedor').click(function(e) {
        e.preventDefault();
        
        if (!validarFormularioEdicion()) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor complete todos los campos requeridos correctamente'
            });
            return;
        }
        
        const formData = $('#formEditarProveedor').serialize();
        
        $.ajax({
            url: '../proveedores/actualizar.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#btnActualizarProveedor').prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...'
                );
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
                        $('#modalEditarProveedor').modal('hide');
                        // Actualizar la fila en la tabla sin recargar
                        actualizarFilaProveedor(response.id);
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error desconocido al actualizar el proveedor'
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
            },
            complete: function() {
                $('#btnActualizarProveedor').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Actualizar Proveedor');
            }
        });
    });
    
    // Función para actualizar la fila en la tabla
    function actualizarFilaProveedor(idProveedor) {
        // Obtener los nuevos datos del proveedor
        $.ajax({
            url: '../proveedores/obtener.php',
            type: 'GET',
            data: { id: idProveedor },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const proveedor = response.data;
                    
                    // Actualizar la fila en la tabla (ajusta según tu estructura HTML)
                    const fila = $(`button.editar-proveedor[data-id="${idProveedor}"]`).closest('tr');
                    
                    fila.find('.nombre-empresa').text(proveedor.nombre_empresa);
                    fila.find('.numero-ruc').text(proveedor.numero_ruc);
                    fila.find('.tipo-ruc').text(proveedor.tipo_ruc_desc);
                    fila.find('.contacto-nombre').text(proveedor.contacto_nombre || 'N/A');
                    fila.find('.contacto-telefono').text(proveedor.contacto_telefono || 'N/A');
                    fila.find('.estado').html(
                        proveedor.estado === 'Activo' ? 
                        '<span class="badge bg-success">Activo</span>' : 
                        '<span class="badge bg-danger">Inactivo</span>'
                    );
                    
                    // Mostrar notificación de éxito
                    Toast.fire({
                        icon: 'success',
                        title: 'Proveedor actualizado correctamente'
                    });
                }
            }
        });
    }
    
    // Configuración para notificaciones Toast
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
});
</script>