<style>
    #historialModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#historialModal .modal-title::after {
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
<!-- Modal para Ver Historial Mejorado -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="historialModalLabel">Historial Completo de Reprogramaciones</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Filtros -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="text" id="busquedaHistorial" class="form-control" placeholder="Buscar...">
                            <button class="btn btn-outline-secondary" type="button" id="btnBuscarHistorial">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="date" id="filtroFechaDesde" class="form-control" placeholder="Desde">
                    </div>
                    <div class="col-md-4">
                        <input type="date" id="filtroFechaHasta" class="form-control" placeholder="Hasta">
                    </div>
                    <div class="col-md-3 mt-2">
                        <select id="filtroEstado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Cancelado">Cancelado</option>
                            <option value="Anulado">Anulado</option>
                            <option value="anulada">Anulada</option>
                        </select>
                    </div>
                </div>
                
                <!-- Tabla de Historial -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaHistorial">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Cliente/Empresa</th>
                                <th>Conductor</th>
                                <th>Vehículo</th>
                                <th>Ruta</th>
                                <th>Fecha/Hora Original</th>
                                <th>Nueva Fecha/Hora</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoHistorial">
                            <!-- Datos se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Para exportar a PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<!-- Para exportar a Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


<!-- SweetAlert2 para mensajes bonitos -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome para íconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
$(document).ready(function() {
    // Manejar clic en botón ver historial
    $(document).on('click', '.ver', function() {
        const idPlanificacion = $(this).data('id');
        const tipoPlanificacion = $(this).data('type');
        
        verificarHistorial(idPlanificacion, tipoPlanificacion);
    });
    
    // Función para verificar si hay historial antes de abrir el modal
    function verificarHistorial(idPlanificacion, tipoPlanificacion) {
        const endpoint = tipoPlanificacion === 'cliente' 
            ? '../planificacion/obtenerhistoralcliente.php?id=' + idPlanificacion
            : '../planificacion/obtenerhistroialempresa.php?id=' + idPlanificacion;
        
        $.ajax({
            url: endpoint,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                // Mostrar loader mientras se verifica
                Swal.fire({
                    title: 'Cargando historial',
                    html: 'Por favor espere...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                Swal.close(); // Cerrar el loader
                
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error,
                        timer: 3000
                    });
                    return;
                }
                
                if (response.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Sin datos',
                        text: 'No hay registros en el historial de reprogramaciones',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    return;
                }
                
                // Si hay datos, cargar el modal
                cargarHistorial(idPlanificacion, tipoPlanificacion, response);
            },
            error: function(xhr, status, error) {
                Swal.close(); // Cerrar el loader
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo verificar el historial: ' + error,
                    timer: 3000
                });
            }
        });
    }
    
    // Función para cargar el historial en el modal (solo se llama si hay datos)
    function cargarHistorial(idPlanificacion, tipoPlanificacion, data) {
        // Construir el contenido del modal
        let html = `
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex">
                    <button id="btnExportPDF" class="btn btn-danger me-2">
                        <i class="fas fa-file-pdf me-1"></i> PDF
                    </button>
                    <button id="btnExportExcel" class="btn btn-success">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </button>
                </div>
                <div class="d-flex">
                    <input type="date" id="filtroFechaDesde" class="form-control me-2" style="width: 150px;">
                    <input type="date" id="filtroFechaHasta" class="form-control me-2" style="width: 150px;">
                    <input type="text" id="busquedaHistorial" class="form-control me-2" placeholder="Buscar..." style="width: 200px;">
                    <select id="filtroEstado" class="form-select" style="width: 150px;">
                        <option value="">Todos</option>
                        <option value="Activo">Activo</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Cancelado">Cancelado</option>
                        <option value="Anulado">Anulado</option>
                        <option value="anulada">Anulada</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tablaHistorial">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Cliente/Empresa</th>
                            <th>Conductor</th>
                            <th>Vehículo</th>
                            <th>Ruta</th>
                            <th>Fecha/Hora Original</th>
                            <th>Nueva Fecha/Hora</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoHistorial">
        `;
        
        data.forEach((item, index) => {
            const estado = item.estado || 'Pendiente';
            const badgeClass = {
                'Activo': 'success',
                'Pendiente': 'warning',
                'Cancelado': 'danger',
                'Anulado': 'secondary',
                'anulada': 'secondary'
            }[estado] || 'secondary';
            
            // Botones de acción
            let acciones = '';
            if (estado === 'Activo' || estado === 'Pendiente') {
                acciones = `
                    <button class="btn btn-sm btn-danger cancelar-reprogramacion" 
                        data-id="${item.idReprogramacion}" 
                        data-tipo="${tipoPlanificacion}"
                        data-planificacion="${idPlanificacion}"
                        title="Cancelar">
                        <i class="fas fa-times"></i>
                    </button>
                `;
            }
            
          
            
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.cliente_empresa || 'N/A'}</td>
                    <td>${item.conductor || 'N/A'}</td>
                    <td>${item.vehiculo || 'N/A'}</td>
                    <td>${item.ruta || 'N/A'}</td>
                    <td>${item.fechaOriginal} ${item.horaOriginal || ''}</td>
                    <td>${item.fechaReprogramada || ''} ${item.horaReprogramada || ''}</td>
                    <td>${item.motivo || 'Sin motivo'}</td>
                    <td><span class="badge bg-${badgeClass}">${estado}</span></td>
                    <td>${item.fechaRegistro || 'N/A'}</td>
                    <td>${acciones}</td>
                </tr>
            `;
        });
        
        html += `
                    </tbody>
                </table>
            </div>
        `;
        
        $('#historialModal .modal-body').html(html);
        initFiltros();
        initAcciones(tipoPlanificacion);
        $('#historialModal').modal('show');
    }
    
    // Función para inicializar filtros
    function initFiltros() {
        $('#busquedaHistorial').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#tablaHistorial tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().includes(value));
            });
        });
        
        $('#filtroEstado').change(function() {
            const estado = $(this).val();
            $('#tablaHistorial tbody tr').each(function() {
                const rowEstado = $(this).find('td:eq(8)').text().trim();
                $(this).toggle(!estado || rowEstado === estado);
            });
        });
        
        // Filtros de fecha
        $('#filtroFechaDesde, #filtroFechaHasta').change(function() {
            const desde = $('#filtroFechaDesde').val();
            const hasta = $('#filtroFechaHasta').val();
            
            $('#tablaHistorial tbody tr').each(function() {
                const fecha = $(this).find('td:eq(9)').text().split(' ')[0];
                const show = (!desde || fecha >= desde) && (!hasta || fecha <= hasta);
                $(this).toggle(show);
            });
        });
    }
    
    // Función para inicializar botones de acción
    function initAcciones(tipoPlanificacion) {
        // Cancelar reprogramación
        $(document).on('click', '.cancelar-reprogramacion', function() {
            const idReprogramacion = $(this).data('id');
            const idPlanificacion = $(this).data('planificacion');
            const tipo = $(this).data('tipo');
            
            Swal.fire({
                title: '¿Cancelar reprogramación?',
                text: "La planificación volverá a estado 'Planificado'",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelarReprogramacion(idReprogramacion, idPlanificacion, tipo);
                }
            });
        });
        
        // Eliminar reprogramación anulada
        $(document).on('click', '.eliminar-reprogramacion', function() {
            const idReprogramacion = $(this).data('id');
            const tipo = $(this).data('tipo');
            
            Swal.fire({
                title: '¿Eliminar registro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarReprogramacion(idReprogramacion, tipo);
                }
            });
        });
        
        // Exportar a PDF
$('#btnExportPDF').click(function () {
    $.ajax({
        url: '../planificacion/logo.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'landscape' });
            const pageWidth = doc.internal.pageSize.getWidth();

            const config = {
                logo_path: response.logo_path,
                title: 'HISTORIAL DE REPROGRAMACIONES',
                subtitle: 'Generado el ' + new Date().toLocaleString(),
                font: 'Arial',
                primary_color: [44, 60, 105],
                secondary_color: [245, 245, 245],
                header_color: [255, 255, 255],
                accent_color: [28, 118, 179],
                margin_left: 15,
                image_size: 20,
                title_y_position: 20,
                subtitle_y_position: 28,
                table_y_position: 40,
                footer_text: 'Transportes y Logística - Todos los derechos reservados'
            };

            const logoImg = new Image();
            logoImg.src = config.logo_path;

            logoImg.onload = function () {
                doc.addImage(logoImg, 'PNG', config.margin_left, 10, config.image_size, config.image_size);
                generarContenido(doc, config, pageWidth);
            };

            logoImg.onerror = function () {
                generarContenido(doc, config, pageWidth); // Generar sin logo si falla
            };
        },
        error: function () {
            alert('No se pudo obtener el logo de la empresa.');
        }
    });
});

function generarContenido(doc, config, pageWidth) {
    doc.setFont(config.font, 'bold');
    doc.setFontSize(16);
    doc.setTextColor(...config.primary_color);
    doc.text(config.title, pageWidth / 2, config.title_y_position, { align: 'center' });

    doc.setFontSize(10);
    doc.setTextColor(...config.accent_color);
    doc.text(config.subtitle, pageWidth / 2, config.subtitle_y_position, { align: 'center' });

    doc.autoTable({
        html: '#tablaHistorial',
        startY: config.table_y_position,
        theme: 'grid',
        styles: {
            fontSize: 9,
            halign: 'center',
            valign: 'middle'
        },
        headStyles: {
            fillColor: config.primary_color,
            textColor: config.header_color,
            fontStyle: 'bold'
        },
        alternateRowStyles: {
            fillColor: config.secondary_color
        }
    });

    const finalY = doc.lastAutoTable.finalY || config.table_y_position + 10;
    doc.setFontSize(8);
    doc.setTextColor(150);
    doc.text(config.footer_text, pageWidth / 2, finalY + 15, { align: 'center' });

    doc.save('historial_reprogramaciones.pdf');
}


        
   $('#btnExportExcel').click(function () {
    const table = document.getElementById('tablaHistorial');
    const wb = XLSX.utils.book_new();
    const ws_data = [['HISTORIAL DE REPROGRAMACIONES']]; // Título
    const currentDate = new Date().toLocaleString();
    ws_data.push(['Generado el: ' + currentDate]); // Subtítulo
    ws_data.push([]); // Línea en blanco

    // Extraer la tabla HTML a un array
    const htmlData = XLSX.utils.table_to_sheet(table, { raw: true });
    const data = XLSX.utils.sheet_to_json(htmlData, { header: 1 });

    // Unir la data con encabezado
    Array.prototype.push.apply(ws_data, data);

    // Crear hoja de cálculo
    const ws = XLSX.utils.aoa_to_sheet(ws_data);

    // Aplicar ancho automático a las columnas
    const range = XLSX.utils.decode_range(ws['!ref']);
    const colWidths = [];
    for (let C = range.s.c; C <= range.e.c; ++C) {
        let maxLen = 10;
        for (let R = range.s.r; R <= range.e.r; ++R) {
            const cell = ws[XLSX.utils.encode_cell({ r: R, c: C })];
            if (cell && cell.v) {
                const len = String(cell.v).length;
                if (len > maxLen) maxLen = len;
            }
        }
        colWidths.push({ wch: maxLen + 2 });
    }
    ws['!cols'] = colWidths;

    // Estilos básicos para bordes (sólo Excel lo interpreta visualmente)
    for (let R = 3; R <= range.e.r + 3; ++R) {
        for (let C = range.s.c; C <= range.e.c; ++C) {
            const cellAddress = XLSX.utils.encode_cell({ r: R, c: C });
            if (!ws[cellAddress]) continue;
            ws[cellAddress].s = {
                border: {
                    top: { style: "thin", color: { rgb: "000000" } },
                    bottom: { style: "thin", color: { rgb: "000000" } },
                    left: { style: "thin", color: { rgb: "000000" } },
                    right: { style: "thin", color: { rgb: "000000" } },
                },
            };
        }
    }

    // Aplicar negrita al título y encabezado
    ws['A1'].s = { font: { bold: true, sz: 14 } };
    ws['A2'].s = { font: { italic: true, sz: 10 } };
    for (let C = 0; C <= range.e.c; ++C) {
        const cellAddress = XLSX.utils.encode_cell({ r: 3, c: C });
        if (ws[cellAddress]) {
            ws[cellAddress].s = {
                ...ws[cellAddress].s,
                font: { bold: true },
                fill: { fgColor: { rgb: "CCCCCC" } },
            };
        }
    }

    // Crear libro y descargar
    XLSX.utils.book_append_sheet(wb, ws, "Historial");
    XLSX.writeFile(wb, "historial_reprogramaciones.xlsx");
});


    }
    
    // Función para cancelar reprogramación
    function cancelarReprogramacion(idReprogramacion, idPlanificacion, tipo) {
        const endpoint = tipo === 'cliente' 
            ? '../planificacion/cancelarreprogramacion.php'
            : '../planificacion/cancelarreprogramacionempresa.php';
        
        $.ajax({
            url: endpoint,
            type: 'POST',
            data: {
                idReprogramacion: idReprogramacion,
                idPlanificacion: idPlanificacion
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
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
                    text: 'Error al procesar la solicitud: ' + error
                });
            }
        });
    }

});
</script>