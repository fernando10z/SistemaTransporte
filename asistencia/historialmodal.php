<!-- Modal Historial - Versión Profesional -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h5 class="modal-title mb-0" id="historialModalLabel" style="color: black; font-size:23px">
                            <i class="fas fa-clipboard-list me-2"></i>Historial de Asistencia
                        </h5>
                        <p class="mb-0 small" id="periodoHistorial"></p>
                    </div>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body bg-light">
                <!-- Encabezado con info del conductor -->
                <div class="card mb-4  shadow-sm">
                    <div class="card-body bg-white rounded">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-1 text-primary" id="nombreConductor"></h4>
                                <div id="infoConductor" class="text-muted">
                                    <span class="badge bg-secondary me-2"><i class="fas fa-id-card me-1"></i> <span id="documentoConductor"></span></span>
                                    <span class="badge bg-info"><i class="fas fa-id-badge me-1"></i> <span id="licenciaConductor"></span></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="fechaFiltro">
                                    <input type="text" class="form-control border-end-0" id="busquedaHistorial" placeholder="Buscar por día u observaciones...">
                                    <button class="btn btn-primary" type="button" id="btnBuscarHistorial">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <div class="btn-group ms-2">
                                        <a href="#" class="btn btn-danger" id="btnPdfHistorial" title="Exportar a PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <a href="#" class="btn btn-success" id="btnExcelHistorial" title="Exportar a Excel">
                                            <i class="fas fa-file-excel"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
   <!-- Agregar estos campos en el modal -->
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Desde</label>
        <input type="date" class="form-control" id="fechaDesde">
    </div>
    <div class="col-md-6">
        <label class="form-label">Hasta</label>
        <input type="date" class="form-control" id="fechaHasta">
    </div>
</div>

<!-- Agregar este div para la paginación -->
<div id="paginacionHistorial" class="d-flex justify-content-center mt-3"></div>
<!-- Agregar este div antes del cierre del modal-body -->
<div id="paginacionHistorial" class="d-flex justify-content-center mt-3"></div>
                <!-- Tabla de historial con scroll -->
                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th class="text-center" style="width: 120px;">Fecha</th>
                                <th class="text-center" style="width: 100px;">Día</th>
                                <th class="text-center" style="width: 100px;">Entrada</th>
                                <th class="text-center" style="width: 100px;">Salida</th>
                                <th class="text-center" style="width: 120px;">Horas</th>
                                <th class="text-center">Observaciones</th>
                                <th class="text-center" style="width: 120px;">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaHistorial">
                            <!-- Datos se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Justificación -->
<div class="modal fade" id="justificarModal" tabindex="-1" aria-labelledby="justificarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                <h5 class="modal-title" id="justificarModalLabel">
                    <i class="fas fa-file-signature me-2"></i>Justificar Ausencia
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formJustificacion" enctype="multipart/form-data">
                    <input type="hidden" id="idConductorJustificar" name="idConductor">
                    <input type="hidden" id="fechaFaltaJustificar" name="fecha_registro">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Conductor</label>
                            <input type="text" class="form-control" id="nombreConductorJustificar" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Documento</label>
                            <input type="text" class="form-control" id="documentoConductorJustificar" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Día de la falta</label>
                            <input type="text" class="form-control" id="diaJustificar" name="dia" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fecha de la falta</label>
                            <input type="text" class="form-control" id="fechaMostrarJustificar" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" value="Justificado" readonly>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="motivoJustificacion" class="form-label">Motivo de la ausencia</label>
                        <textarea class="form-control" id="motivoJustificacion" name="motivojustificacion" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fotoJustificacion" class="form-label">Evidencia (Imagen)</label>
                        <input class="form-control" type="file" id="fotoJustificacion" name="fotojustificacion" accept="image/*" required>
                        <div class="form-text">Formatos aceptados: JPG, PNG, JPEG. Tamaño máximo: 2MB</div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Justificación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    let currentConductorId = null;
    let esAdministrador = false;
    let currentPage = 1;
    const recordsPerPage = 5;
    let allProcessedData = [];
    let currentFilters = {
        busqueda: '',
        fechaDesde: '',
        fechaHasta: ''
    };
    
    // Verificar rol del usuario
    $.ajax({
        url: '../asistencia/auth.php',
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
            esAdministrador = (response.id_rol == 1);
        },
        error: function() {
            console.error('Error al verificar rol');
            esAdministrador = false;
        }
    });

    // Función para registrar ausentes automáticamente
    function registrarAusentesAutomatico() {
        $.ajax({
            url: '../asistencia/ausente.php',
            method: 'GET',
            dataType: 'text',
            success: function(response) {
                console.log(response);
            },
            error: function() {
                console.error('Error al ejecutar registro automático de ausentes');
            }
        });
    }

    // Ejecutar registro de ausentes al cargar la página
    registrarAusentesAutomatico();

    // Función para obtener nombre del día
    function getNombreDia(fechaStr) {
        const fecha = new Date(fechaStr);
        return fecha.toLocaleDateString('es-PE', { weekday: 'long' });
    }

    // Formatear fecha a dd/mm/aaaa
    function formatFecha(fechaStr) {
        const fecha = new Date(fechaStr);
        if (isNaN(fecha.getTime())) {
            return 'Fecha inválida';
        }
        const dia = fecha.getDate().toString().padStart(2, '0');
        const mes = (fecha.getMonth() + 1).toString().padStart(2, '0');
        const año = fecha.getFullYear();
        return `${dia}/${mes}/${año}`;
    }

    // Manejador para ver historial
    $(document).on('click', '.ver-asistencia', function() {
        currentConductorId = $(this).data('id');
        currentPage = 1;
        currentFilters = {
            busqueda: '',
            fechaDesde: '',
            fechaHasta: ''
        };
        $('#busquedaHistorial').val('');
        $('#fechaDesde').val('');
        $('#fechaHasta').val('');
        cargarHistorialConductor(currentConductorId);
    });

    // Función principal para cargar historial
    function cargarHistorialConductor(idConductor, busqueda = '', fechaDesde = '', fechaHasta = '', page = 1) {
        // Actualizar filtros actuales
        currentFilters = {
            busqueda: busqueda,
            fechaDesde: fechaDesde,
            fechaHasta: fechaHasta
        };
        
        $.ajax({
            url: '../asistencia/obtenerhistorial.php',
            method: 'POST',
            data: { 
                idConductor: idConductor,
                busqueda: busqueda,
                fechaDesde: fechaDesde,
                fechaHasta: fechaHasta
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#nombreConductor').text(response.nombreCompleto);
                    $('#documentoConductor').text(response.tipoDocumento + ' ' + response.documento);
                    $('#licenciaConductor').text(response.tipoLicencia + ' (' + response.licencia + ')');
                    
                    // Procesar datos del historial
                    procesarDatosHistorial(response, fechaDesde, fechaHasta);
                    
                    // Actualizar enlaces de exportación con los filtros actuales
                    actualizarEnlacesExportacion();
                    
                    // Mostrar modal
                    $('#historialModal').modal('show');
                } else {
                    Swal.fire('Error', response.error || 'No se pudo cargar el historial', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al conectar con el servidor', 'error');
            }
        });
    }

    // Actualizar enlaces de exportación con los filtros actuales
    function actualizarEnlacesExportacion() {
        $('#btnPdfHistorial').attr('href', 
            `../reportes/generarpdfasistenciahistorial.php?idConductor=${currentConductorId}&busqueda=${currentFilters.busqueda}&fechaDesde=${currentFilters.fechaDesde}&fechaHasta=${currentFilters.fechaHasta}`);
        
        $('#btnExcelHistorial').attr('href', 
            `../reportes/generarexcelasistenciahistorial.php?idConductor=${currentConductorId}&busqueda=${currentFilters.busqueda}&fechaDesde=${currentFilters.fechaDesde}&fechaHasta=${currentFilters.fechaHasta}`);
    }

    // Procesar datos del historial
    function procesarDatosHistorial(response, fechaDesde = '', fechaHasta = '') {
        // Ordenar historial por fecha (ascendente)
        response.historial.sort((a, b) => new Date(a.fecha_registro) - new Date(b.fecha_registro));
        
        // Obtener primera y última fecha del historial
        const primerRegistro = response.historial.length > 0 ? 
            new Date(response.historial[0].fecha_registro) : new Date();
        const ultimoRegistro = response.historial.length > 0 ?
            new Date(response.historial[response.historial.length - 1].fecha_registro) : new Date();
        
        // Usar fechas de filtro si existen
        const fechaInicio = fechaDesde ? new Date(fechaDesde) : primerRegistro;
        const fechaFin = fechaHasta ? new Date(fechaHasta) : new Date(); // Usar fecha actual como máximo
        
        // Asegurarse de que la fecha de inicio no sea anterior al primer registro
        const fechaInicioAjustada = fechaInicio < primerRegistro ? primerRegistro : fechaInicio;
        
        $('#periodoHistorial').html(`
            <i class="fas fa-calendar-alt me-1"></i> 
            Historial desde ${formatFecha(fechaInicioAjustada)} hasta ${formatFecha(fechaFin)}
        `);
        
        // Mostrar solo los registros existentes (asistencias y ausentes registrados)
        allProcessedData = response.historial.map(registro => {
            return {
                tipo: registro.estado === 'Ausente' ? 'ausencia' : 'asistencia',
                fecha: registro.fecha_registro,
                dia: getNombreDia(registro.fecha_registro),
                registro: registro
            };
        });
        
        // Paginar y mostrar datos
        actualizarTablaYPaginacion();
    }

    // Actualizar tabla y paginación
    function actualizarTablaYPaginacion() {
        const totalPages = Math.ceil(allProcessedData.length / recordsPerPage);
        const paginatedData = paginarDatos(allProcessedData, currentPage);
        
        generarTablaHistorial(paginatedData);
        generarPaginacion(totalPages, currentPage);
    }

    // Paginar datos
    function paginarDatos(data, page) {
        const start = (page - 1) * recordsPerPage;
        const end = start + recordsPerPage;
        return data.slice(start, end);
    }

    // Generar tabla de historial
    function generarTablaHistorial(datosPagina) {
        let tablaHtml = '';
        
        datosPagina.forEach(item => {
            switch(item.tipo) {
                case 'asistencia':
                    const registro = item.registro;
                    tablaHtml += `
                        <tr class="table-success">
                            <td class="text-center">${formatFecha(registro.fecha_registro)}</td>
                            <td class="text-center">${registro.dia || item.dia}</td>
                            <td class="text-center">${registro.hora_entrada || '-'}</td>
                            <td class="text-center">${registro.hora_salida || '-'}</td>
                            <td class="text-center">${registro.horas_conducidas || '0'} hrs</td>
                            <td>${registro.observaciones || '-'}</td>
                            <td class="text-center"><span class="badge bg-success">${registro.estado || 'Ingreso'}</span></td>
                        </tr>
                    `;
                    break;
                    
                case 'ausencia':
                    const botonJustificar = esAdministrador ? 
                        `<button class="btn btn-sm btn-outline-primary btn-justificar" 
                            data-fecha="${item.fecha}" 
                            data-dia="${item.dia}"
                            data-idconductor="${currentConductorId}"
                            data-nombre="${$('#nombreConductor').text()}"
                            data-documento="${$('#documentoConductor').text()}">
                            <i class="fas fa-edit"></i> Justificar
                        </button>` : '';

                    tablaHtml += `
                        <tr class="table-danger">
                            <td class="text-center">${formatFecha(item.fecha)}</td>
                            <td class="text-center">${item.dia}</td>
                            <td class="text-center text-uppercase fw-bold" colspan="4">NO ASISTIÓ</td>
                            <td class="text-center">
                                <span class="badge bg-danger me-2">Ausente</span>
                                ${botonJustificar}
                            </td>
                        </tr>
                    `;
                    break;
            }
        });
        
        $('#tablaHistorial').html(tablaHtml);
    }

    // Generar paginación
    function generarPaginacion(totalPages, currentPage) {
        let paginacionHtml = '<nav><ul class="pagination justify-content-center">';
        
        // Botón Anterior
        paginacionHtml += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage - 1}">Anterior</a>
            </li>
        `;
        
        // Números de página
        const maxPagesToShow = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
        let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);
        
        if (endPage - startPage + 1 < maxPagesToShow) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }
        
        if (startPage > 1) {
            paginacionHtml += `
                <li class="page-item">
                    <a class="page-link" href="#" data-page="1">1</a>
                </li>
                ${startPage > 2 ? '<li class="page-item disabled"><span class="page-link">...</span></li>' : ''}
            `;
        }
        
        for (let i = startPage; i <= endPage; i++) {
            paginacionHtml += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }
        
        if (endPage < totalPages) {
            paginacionHtml += `
                ${endPage < totalPages - 1 ? '<li class="page-item disabled"><span class="page-link">...</span></li>' : ''}
                <li class="page-item">
                    <a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>
                </li>
            `;
        }
        
        // Botón Siguiente
        paginacionHtml += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${currentPage + 1}">Siguiente</a>
            </li>
        `;
        
        paginacionHtml += '</ul></nav>';
        $('#paginacionHistorial').html(paginacionHtml);
    }

    // Manejador de paginación
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = parseInt($(this).data('page'));
        if (isNaN(page) || page < 1 || page > $(this).closest('ul').find('.page-item:not(.disabled)').length) return;
        
        currentPage = page;
        actualizarTablaYPaginacion();
    });

    // Manejador de búsqueda
    $('#btnBuscarHistorial').click(function() {
        currentPage = 1;
        const busqueda = $('#busquedaHistorial').val();
        const fechaDesde = $('#fechaDesde').val();
        const fechaHasta = $('#fechaHasta').val();
        
        if(currentConductorId) {
            cargarHistorialConductor(currentConductorId, busqueda, fechaDesde, fechaHasta);
        }
    });

    // Manejador de tecla Enter en búsqueda
    $('#busquedaHistorial').keypress(function(e) {
        if(e.which === 13) {
            $('#btnBuscarHistorial').click();
        }
    });

    // Manejador para justificar ausencia
    $(document).on('click', '.btn-justificar', function() {
        const fechaFalta = $(this).data('fecha');
        const diaFalta = $(this).data('dia');
        const idConductor = $(this).data('idconductor');
        const nombreConductor = $(this).data('nombre');
        const documentoConductor = $(this).data('documento');
        
        const fechaFormateada = formatFecha(fechaFalta);
        
        $('#idConductorJustificar').val(idConductor);
        $('#nombreConductorJustificar').val(nombreConductor);
        $('#documentoConductorJustificar').val(documentoConductor);
        $('#diaJustificar').val(diaFalta);
        $('#fechaFaltaJustificar').val(fechaFalta);
        $('#fechaMostrarJustificar').val(fechaFormateada);
        
        $('#motivoJustificacion').val('');
        $('#fotoJustificacion').val('');
        
        $('#justificarModal').modal('show');
    });
    
    // Manejador para enviar justificación
    $('#formJustificacion').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const $modal = $('#justificarModal');
        
        Swal.fire({
            title: '¿Confirmar justificación?',
            text: '¿Está seguro que desea registrar esta justificación?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../asistencia/guardarjusti.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $modal.modal('hide');
                        Swal.fire({
                            title: 'Procesando',
                            html: 'Guardando justificación...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        if(response.success) {
                            Swal.fire({
                                title: 'Éxito',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                                cargarHistorialConductor(currentConductorId);
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.error,
                                icon: 'error'
                            }).then(() => {
                                $modal.modal('show');
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al conectar con el servidor',
                            icon: 'error'
                        }).then(() => {
                            $modal.modal('show');
                        });
                    }
                });
            }
        });
    });
});
</script>
<style>
.swal2-container {
    z-index: 99999 !important;
}
</style>
<style>
/* Estilos personalizados */
#historialModal .modal-header {
    border-bottom: 3px solid #0d6efd;
}
#historialModal .table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}
#historialModal .table td {
    vertical-align: middle;
}
#historialModal .badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
    font-weight: 500;
}
#historialModal .table-danger td {
    color: #721c24;
    background-color: #f8d7da;
}
#historialModal .table-success td {
    color: #155724;
    background-color: #d4edda;
}
</style>