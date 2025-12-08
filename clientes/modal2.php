<!-- Modal para Clientes -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modalClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalClienteLabel">Registro de Cliente</h5>
                <button type="button" class="close text-white" aria-label="Close" onclick="$('#modalCliente').modal('hide')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCliente" enctype="multipart/form-data">
                    <input type="hidden" id="idCliente" name="idCliente">
                    
                    <!-- Radio buttons para Tipo de Cliente -->
                    <div class="form-group">
                        <label class="d-block">Tipo de Cliente</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoCliente" id="tipoNatural" value="Natural" checked>
                            <label class="form-check-label" for="tipoNatural">Persona Natural</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoCliente" id="tipoEmpresa" value="Empresa">
                            <label class="form-check-label" for="tipoEmpresa">Empresa</label>
                        </div>
                    </div>
                    
                    <!-- Campos para Persona Natural -->
                    <div id="camposNatural">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombres</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidopat">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidopat" name="apellidopat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellidoMat">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidoMat" name="apellidoMat">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="idGenero">Género</label>
                                <select class="form-control" id="idGenero" name="idGenero" required>
                                    <option value="">Seleccionar</option>
                                    <!-- Opciones se llenarán con AJAX -->
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="idTipoDocumento">Tipo de Documento</label>
                                <select class="form-control" id="idTipoDocumento" name="idTipoDocumento" required>
                                    <option value="">Seleccionar</option>
                                    <!-- Opciones se llenarán con AJAX -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numerodocumento">Número de Documento</label>
                            <input type="text" class="form-control" id="numerodocumento" name="numerodocumento" required>
                            <small id="errorDocumento" class="text-danger d-none">Por favor, ingrese un documento válido</small>
                            <small id="errorDocumentoDuplicado" class="text-danger d-none">Este documento ya está registrado</small>
                        </div>
                    </div>
                    
                    <!-- Campos para Empresa -->
                    <div id="camposEmpresa" style="display:none;">
                        <div class="form-group">
                            <label for="razonSocial">Razón Social</label>
                            <input type="text" class="form-control" id="razonSocial" name="razonSocial" disabled required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="idTipoRuc">Tipo de RUC</label>
                                <select class="form-control" id="idTipoRuc" name="idTipoRuc" disabled required>
                                    <option value="">Seleccionar</option>
                                    <!-- Opciones se llenarán con AJAX -->
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ruc">RUC</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" maxlength="11" disabled required>
                                <small id="errorRuc" class="text-danger d-none">El RUC debe tener 11 dígitos</small>
                                <small id="errorRucDuplicado" class="text-danger d-none">Este RUC ya está registrado</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campos comunes -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idTipoDireccion">Tipo de Dirección</label>
                            <select class="form-control" id="idTipoDireccion" name="idTipoDireccion" required>
                                <option value="">Seleccionar</option>
                                <!-- Opciones se llenarán con AJAX -->
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                            <small id="errorTelefono" class="text-danger d-none">El teléfono debe tener 9 dígitos</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="correo">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firmas">Firma Digital (Subir imagen)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="firmas" name="firmas" accept="image/*">
                            <label class="custom-file-label" for="firmas">Seleccionar archivo...</label>
                        </div>
                        <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF (Máx. 2MB)</small>
                        <div id="previewFirma" class="mt-2" style="display:none;">
                            <img id="firmaPreview" src="#" alt="Vista previa de la firma" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Activo" selected>Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#modalCliente').modal('hide')">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarCliente" disabled>Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Variables para almacenar las longitudes máximas
    var maxLengthDoc = 0;
    var maxLengthRuc = 11;
    var maxLengthTelefono = 9;
    var documentoDuplicado = false;
    var rucDuplicado = false;
    
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
            }
        });
    }

    // Mostrar vista previa de la firma
    $('#firmas').change(function() {
        if (this.files && this.files[0]) {
            var file = this.files[0];
            
            // Validar tamaño máximo (2MB)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El tamaño máximo permitido es 2MB'
                });
                $(this).val('');
                return;
            }
            
            // Validar tipo de archivo
            if (!file.type.match('image.*')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tipo de archivo no válido',
                    text: 'Solo se permiten imágenes (JPG, PNG, GIF)'
                });
                $(this).val('');
                return;
            }
            
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#firmaPreview').attr('src', e.target.result);
                $('#previewFirma').show();
            }
            reader.readAsDataURL(file);
            
            // Actualizar label del input file
            $(this).next('.custom-file-label').html(file.name);
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
                        $('#errorDocumentoDuplicado').removeClass('d-none');
                        documentoDuplicado = true;
                    } else {
                        $('#errorDocumentoDuplicado').addClass('d-none');
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
                        $('#errorRucDuplicado').removeClass('d-none');
                        rucDuplicado = true;
                    } else {
                        $('#errorRucDuplicado').addClass('d-none');
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
            $('#camposNatural').show();
            $('#nombre, #apellidopat, #apellidoMat, #idGenero, #idTipoDocumento, #numerodocumento').prop('disabled', false).prop('required', true);
            $('#camposEmpresa').hide();
            $('#razonSocial, #ruc, #idTipoRuc').prop('disabled', true).prop('required', false);
            $('#razonSocial, #ruc').val('');
            $('#idTipoRuc').val('');
        } else {
            $('#camposEmpresa').show();
            $('#razonSocial, #ruc, #idTipoRuc').prop('disabled', false).prop('required', true);
            $('#camposNatural').hide();
            $('#nombre, #apellidopat, #apellidoMat, #idGenero, #idTipoDocumento, #numerodocumento').prop('disabled', true).prop('required', false);
            $('#nombre, #apellidopat, #apellidoMat, #numerodocumento').val('');
            $('#idGenero, #idTipoDocumento').val('');
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
            $('#errorDocumento').addClass('d-none');
        }
        
        validarFormulario();
    });

    function validarNumeroDocumento() {
        var numDoc = $('#numerodocumento').val();
        
        if (maxLengthDoc > 0) {
            if (numDoc.length === maxLengthDoc) {
                $('#errorDocumento').addClass('d-none');
                verificarDocumentoDuplicado();
            } else if (numDoc.length > 0) {
                $('#errorDocumento').removeClass('d-none');
            } else {
                $('#errorDocumento').addClass('d-none');
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
            $('#errorRuc').addClass('d-none');
            verificarRucDuplicado();
        } else if (ruc.length > 0) {
            $('#errorRuc').removeClass('d-none');
        } else {
            $('#errorRuc').addClass('d-none');
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
        
        if (telefono.length === maxLengthTelefono) {
            $('#errorTelefono').addClass('d-none');
        } else if (telefono.length > 0) {
            $('#errorTelefono').removeClass('d-none');
        } else {
            $('#errorTelefono').addClass('d-none');
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
            if (ruc.length !== maxLengthRuc) {
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
        
        $('#btnGuardarCliente').prop('disabled', !valido);
        return valido;
    }

    // Función para guardar el cliente
    $('#btnGuardarCliente').click(function() {
        if ($('#formCliente')[0].checkValidity() && validarFormulario()) {
            var formData = new FormData($('#formCliente')[0]);
            var url = $('#tipoNatural').is(':checked') ? '../clientes/guardarpersona.php' : '../clientes/guardarempresa.php';
            
            var $btn = $('#btnGuardarCliente');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
            
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
                            title: 'Éxito',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalCliente').modal('hide');
                            location.reload();
                        });
                    } else {
                        $btn.prop('disabled', false).html('Guardar');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: (res && res.message) || 'Error al guardar los datos'
                        });
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html('Guardar');
                    try {
                        var errRes = xhr.responseJSON || JSON.parse(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errRes.message || 'Error al procesar la solicitud'
                        });
                    } catch (e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al conectar con el servidor'
                        });
                    }
                }
            });
        } else {
            $('#formCliente')[0].reportValidity();
        }
    });

    // Validar formulario cuando cambie cualquier campo
    $('#formCliente').on('change input', validarFormulario);

    // Inicializar campos al cargar
    toggleCamposCliente();
});
</script>