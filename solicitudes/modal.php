<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Solicitudes</title>
    <!-- Bootstrap CSS -->
  
    <style>
        body.modal-open {
            overflow: hidden;
            padding-right: 0 !important;
        }
        
        .modal {
            overflow-y: auto;
        }
        
        .modal-dialog {
            margin: 10px auto;
        }
        
        .btn-close-white {
            filter: invert(1);
        }
        
        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
        
    </style>
</head>
<body>
<!-- Modal para Registrar Solicitud - Diseño Moderno -->
<div class="modal fade" id="registroSolicitudModal" tabindex="-1" aria-labelledby="registroSolicitudModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroSolicitudModalLabel" style="font-size: 23px; color:black">
                    <i class="fas fa-file-alt me-2"></i>Registrar Nueva Solicitud
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#registroSolicitudModal').modal('hide')"></button>
            </div>
            <form id="formSolicitud">
                <div class="modal-body">
                    <div class="section-divider">
                        <span>Información del Cliente</span>
                    </div>
                    
                    <div class="row g-3 animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <label class="fw-bold mb-2">Tipo de Cliente:</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoCliente" id="clienteNatural" value="natural" checked>
                                    <label class="form-check-label" for="clienteNatural">
                                        Cliente Natural
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoCliente" id="clienteEmpresa" value="empresa">
                                    <label class="form-check-label" for="clienteEmpresa">
                                        Empresa
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="infoClienteEmpresa" readonly>
                                <label for="infoClienteEmpresa" id="labelClienteEmpresa">Cliente</label>
                                <input type="hidden" id="idClienteEmpresa" name="idClienteEmpresa">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary w-100 h-100" id="btnBuscarClienteEmpresa">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                        </div>
                    </div>

                    <div class="section-divider mt-4">
                        <span>Detalles de la Carga</span>
                    </div>

                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="tipoCarga" name="tipoCarga" required>
                                    <option value="">Seleccione...</option>
                                    <option value="General">General</option>
                                    <option value="Perecible">Perecible</option>
                                    <option value="Peligrosa">Peligrosa</option>
                                    <option value="Refrigerada">Refrigerada</option>
                                    <option value="Voluminosa">Voluminosa</option>
                                </select>
                                <label for="tipoCarga">Tipo de Carga <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" id="peso" name="peso">
                                <label for="peso">Peso (kg)</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" id="volumen" name="volumen">
                                <label for="volumen">Volumen (m³)</label>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider mt-4">
                        <span>Información de Envío</span>
                    </div>

                    <div class="row g-3 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="origen" name="origen" required>
                                <label for="origen">Origen <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="destino" name="destino" required>
                                <label for="destino">Destino <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaEnvio" name="fechaEnvio" required>
                                <label for="fechaEnvio">Fecha de Envío <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcion" name="descripcion" style="height: 100px"></textarea>
                                <label for="descripcion">Descripción</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="$('#registroSolicitudModal').modal('hide')">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="guardarSolicitud()">
                        <i class="fas fa-save me-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Buscar Cliente Natural -->
<div class="modal fade" id="buscarClienteNaturalModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>Buscar Cliente Natural
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarClienteNaturalModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="buscarNaturalInput" placeholder="Buscar por nombre, apellido o documento...">
                        <button class="btn btn-primary" type="button" onclick="buscarClientesNaturales($('#buscarNaturalInput').val())">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaClientesNaturales" class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarClienteNaturalModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Empresa -->
<div class="modal fade" id="buscarClienteEmpresaModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-building me-2"></i>Buscar Empresa
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarClienteEmpresaModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="buscarEmpresaInput" placeholder="Buscar por razón social o RUC...">
                        <button class="btn btn-primary" type="button" onclick="buscarClientesEmpresas($('#buscarEmpresaInput').val())">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Razón Social</th>
                                <th>RUC</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaClientesEmpresas" class="table-group-divider">
                            <!-- Datos se cargarán via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarClienteEmpresaModal').modal('hide')">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para los modals */
#registroSolicitudModal .modal-content,
#buscarClienteNaturalModal .modal-content,
#buscarClienteEmpresaModal .modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#registroSolicitudModal .modal-header,
#buscarClienteNaturalModal .modal-header,
#buscarClienteEmpresaModal .modal-header {
    background-color: #fff;
    border-bottom: 1px solid var(--light-gray);
    padding: 13px 15px;
}

#registroSolicitudModal .modal-title,
#buscarClienteNaturalModal .modal-title,
#buscarClienteEmpresaModal .modal-title {
    color: var(--dark-color);
    font-weight: 600;
    display: flex;
    align-items: center;
}

#registroSolicitudModal .modal-body,
#buscarClienteNaturalModal .modal-body,
#buscarClienteEmpresaModal .modal-body {
    padding: 25px;
}

#registroSolicitudModal .modal-footer,
#buscarClienteNaturalModal .modal-footer,
#buscarClienteEmpresaModal .modal-footer {
    border-top: 1px solid var(--light-gray);
    padding: 16px 25px;
    background-color: #fff;
}

#registroSolicitudModal .section-divider,
#buscarClienteNaturalModal .section-divider,
#buscarClienteEmpresaModal .section-divider {
    position: relative;
    text-align: center;
    margin: 30px 0 25px;
    overflow: hidden;
}

#registroSolicitudModal .section-divider span,
#buscarClienteNaturalModal .section-divider span,
#buscarClienteEmpresaModal .section-divider span {
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

#registroSolicitudModal .section-divider:before,
#buscarClienteNaturalModal .section-divider:before,
#buscarClienteEmpresaModal .section-divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--light-gray);
    z-index: 0;
}

#registroSolicitudModal .form-floating > .form-control,
#registroSolicitudModal .form-floating > .form-select,
#buscarClienteNaturalModal .form-floating > .form-control,
#buscarClienteEmpresaModal .form-floating > .form-control {
    height: 56px;
    padding: 1rem 0.75rem;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
    color: var(--dark-color);
}

#registroSolicitudModal .form-floating > textarea.form-control {
    height: auto;
    min-height: 100px;
    padding-top: 1.5rem;
}

#registroSolicitudModal .form-floating > .form-control:focus,
#registroSolicitudModal .form-floating > .form-select:focus,
#buscarClienteNaturalModal .form-floating > .form-control:focus,
#buscarClienteEmpresaModal .form-floating > .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#registroSolicitudModal .form-floating > label,
#buscarClienteNaturalModal .form-floating > label,
#buscarClienteEmpresaModal .form-floating > label {
    padding: 1rem 0.75rem;
    color: var(--gray-color);
}

#registroSolicitudModal .form-floating > .form-control:focus ~ label,
#registroSolicitudModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#registroSolicitudModal .form-floating > .form-select ~ label,
#buscarClienteNaturalModal .form-floating > .form-control:focus ~ label,
#buscarClienteEmpresaModal .form-floating > .form-control:focus ~ label {
    color: var(--primary-color);
    opacity: 0.8;
    transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#registroSolicitudModal .text-danger,
#buscarClienteNaturalModal .text-danger,
#buscarClienteEmpresaModal .text-danger {
    color: var(--danger-color) !important;
}

/* Estilos para tablas en los modals de búsqueda */
#buscarClienteNaturalModal .table,
#buscarClienteEmpresaModal .table {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
    --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
    margin-bottom: 0;
}

#buscarClienteNaturalModal .table thead th,
#buscarClienteEmpresaModal .table thead th {
    background-color: var(--light-gray);
    color: var(--dark-color);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

#buscarClienteNaturalModal .table-hover tbody tr:hover,
#buscarClienteEmpresaModal .table-hover tbody tr:hover {
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
#registroSolicitudModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#registroSolicitudModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
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

.mt-3 {
    margin-top: 1rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

/* Estilos para los radio buttons */
.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(93, 135, 255, 0.25);
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
</style>
<script>
    $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#peso').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
</script>

<script>
    $(document).ready(function() {
    // Validar el campo monto para que no acepte valores negativos
    $('#volumen').on('input change', function() {
        const value = parseFloat($(this).val());
        
        // Si el valor es negativo o no es un número válido, lo establecemos a 0
        if (isNaN(value) || value < 0) {
            $(this).val('0.00');
        }
    });
})
</script>

<script>
    // Variable para controlar el tipo de cliente seleccionado
    let tipoClienteSeleccionado = 'natural';
    
    $(document).ready(function() {
        // Manejar la apertura y cierre de modales
        $('.modal').on('show.bs.modal', function() {
            $('body').addClass('modal-open');
        });
        
        $('.modal').on('hidden.bs.modal', function() {
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
        });
        
        // Escuchar cambios en el radio button
        $('input[name="tipoCliente"]').change(function() {
            tipoClienteSeleccionado = $(this).val();
            
            // Cambiar el label según el tipo de cliente
            if (tipoClienteSeleccionado === 'natural') {
                $('#labelClienteEmpresa').text('Cliente:');
            } else {
                $('#labelClienteEmpresa').text('Empresa:');
            }
            
            // Limpiar los campos al cambiar
            $('#infoClienteEmpresa').val('');
            $('#idClienteEmpresa').val('');
        });
        
        // Manejar el botón de búsqueda
        $('#btnBuscarClienteEmpresa').click(function() {
            if (tipoClienteSeleccionado === 'natural') {
                buscarClientesNaturales('');
                $('#buscarClienteNaturalModal').modal('show');
            } else {
                buscarClientesEmpresas('');
                $('#buscarClienteEmpresaModal').modal('show');
            }
        });

        // Buscar clientes naturales al escribir en el campo de búsqueda
        $('#buscarNaturalInput').keyup(function(e) {
            if (e.keyCode === 13) { // Enter key
                buscarClientesNaturales($(this).val());
            }
        });

        // Buscar empresas al escribir en el campo de búsqueda
        $('#buscarEmpresaInput').keyup(function(e) {
            if (e.keyCode === 13) { // Enter key
                buscarClientesEmpresas($(this).val());
            }
        });
    });

    function buscarClientesNaturales(busqueda) {
        $.ajax({
            url: '../solicitudes/buscarclientes.php',
            type: 'GET',
            data: { busqueda: busqueda },
            beforeSend: function() {
                $('#tablaClientesNaturales').html('<tr><td colspan="8" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></td></tr>');
            },
            success: function(response) {
                $('#tablaClientesNaturales').html(response);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar los datos de clientes naturales',
                    confirmButtonColor: '#3085d6'
                });
                console.error('Error al buscar clientes naturales:', error);
            }
        });
    }

    function buscarClientesEmpresas(busqueda) {
        $.ajax({
            url: '../solicitudes/buscarempresa.php',
            type: 'GET',
            data: { busqueda: busqueda },
            beforeSend: function() {
                $('#tablaClientesEmpresas').html('<tr><td colspan="7" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></td></tr>');
            },
            success: function(response) {
                $('#tablaClientesEmpresas').html(response);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar los datos de empresas',
                    confirmButtonColor: '#3085d6'
                });
                console.error('Error al buscar empresas:', error);
            }
        });
    }

    function seleccionarClienteNatural(id, nombre, apellidoPat, apellidoMat) {
        $('#idClienteEmpresa').val(id);
        $('#infoClienteEmpresa').val(nombre + ' ' + apellidoPat + ' ' + apellidoMat + ' (ID: ' + id + ')');
        $('#buscarClienteNaturalModal').modal('hide');
        $('body').removeClass('modal-open');
    }

    function seleccionarClienteEmpresa(id, razonSocial, ruc) {
        $('#idClienteEmpresa').val(id);
        $('#infoClienteEmpresa').val(razonSocial + ' (RUC: ' + ruc + ')');
        $('#buscarClienteEmpresaModal').modal('hide');
        $('body').removeClass('modal-open');
    }

    function guardarSolicitud() {
        if (!$('#idClienteEmpresa').val()) {
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Por favor seleccione un ' + (tipoClienteSeleccionado === 'natural' ? 'cliente' : 'empresa'),
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        
        if (!$('#tipoCarga').val()) {
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Por favor seleccione el tipo de carga',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        const formData = $('#formSolicitud').serialize();
        const url = tipoClienteSeleccionado === 'natural' ? '../solicitudes/guardarcliente.php' : '../solicitudes/guardarempresa.php';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('button[onclick="guardarSolicitud()"]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
            },
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: data.message,
                            confirmButtonColor: '#3085d6',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            $('#registroSolicitudModal').modal('hide');
                            $('body').removeClass('modal-open');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonColor: '#3085d6'
                        });
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Solicitud registrada correctamente',
                        confirmButtonColor: '#3085d6',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        $('#registroSolicitudModal').modal('hide');
                        $('body').removeClass('modal-open');
                        location.reload();
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al guardar la solicitud: ' + error,
                    confirmButtonColor: '#3085d6'
                });
            },
            complete: function() {
                $('button[onclick="guardarSolicitud()"]').html('Guardar');
            }
        });
    }
</script>
</body>
</html>