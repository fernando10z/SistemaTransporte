<div class="modal fade" id="historialDesempenoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header  text-white">
                <h5 class="modal-title">
                    <i class="fas fa-history me-2"></i> Historial de Desempeño
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-user-tie me-2"></i>Información del Conductor</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nombre:</strong> <span id="historialNombre"></span></p>
                                        <p><strong>Documento:</strong> <span id="historialDocumento"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Licencia:</strong> <span id="historialLicencia"></span></p>
                                        <p><strong>Estado:</strong> <span id="historialEstadoConductor"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Resumen de Desempeño</h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4 border-end">
                                        <h5 class="mb-0" id="totalCursos">0</h5>
                                        <small class="text-muted">Total Cursos</small>
                                    </div>
                                    <div class="col-md-4 border-end">
                                        <h5 class="mb-0 text-success" id="cursosCompletados">0</h5>
                                        <small class="text-muted">Completados</small>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="mb-0 text-warning" id="cursosPendientes">0</h5>
                                        <small class="text-muted">Pendientes</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barra de herramientas con búsqueda y botones de exportación -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" id="buscarHistorial" class="form-control" placeholder="Buscar en historial...">
                            <button class="btn btn-outline-secondary" type="button" id="limpiarBusqueda">Limpiar</button>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="btn-group">
                            <button class="btn btn-danger" id="btnExportarPDF">
                                <i class="fas fa-file-pdf me-1"></i> PDF
                            </button>
                            <button class="btn btn-success" id="btnExportarExcel">
                                <i class="fas fa-file-excel me-1"></i> Excel
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de tabla con scroll -->
                <div class="table-container" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover table-sm" id="tablaHistorial">
                        <thead class="table-light" style="position: sticky; top: 0; z-index: 1; background-color: #f8f9fa;">
                            <tr>
                                <th>Curso</th>
                                <th>Entidad</th>
                                <th>Nota</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Fecha Registro</th>
                                <th>Estado Registro</th>
                                <th>Estado Desempeño</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoHistorial">
                            <!-- Datos se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCerrarModal">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Incluir las librerías necesarias para exportación -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<style>
    #historialDesempenoModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#historialDesempenoModal .modal-title::after {
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
<style>
    /* Estilos para mejorar el scroll y la tabla */
    .table-container {
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
    
    .table-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .table-container::-webkit-scrollbar-thumb {
        background-color: #adb5bd;
        border-radius: 4px;
    }
    
    .table-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }
    
    /* Asegurar que las celdas tengan un ancho adecuado */
    #tablaHistorial th, #tablaHistorial td {
        white-space: nowrap;
        min-width: 100px;
    }
    
    #tablaHistorial th:nth-child(1), 
    #tablaHistorial td:nth-child(1) {
        min-width: 200px; /* Más ancho para el nombre del curso */
    }
</style>

<script>
// Inicializar jsPDF
const { jsPDF } = window.jspdf;

$(document).ready(function() {
    // Variable para almacenar los datos del historial
    let datosHistorial = [];
    let nombreConductor = '';
    let idConductorActual = null;
    
    // Función para actualizar el resumen de desempeño
    function actualizarResumen() {
        const totalCursos = datosHistorial.length;
        const cursosCompletados = datosHistorial.filter(c => c.estado_desempeno === 'Acabado').length;
        const cursosPendientes = totalCursos - cursosCompletados;
        
        $('#totalCursos').text(totalCursos);
        $('#cursosCompletados').text(cursosCompletados);
        $('#cursosPendientes').text(cursosPendientes);
    }
    
    // Función para cargar datos del historial
    function cargarHistorial(idConductor) {
        // Mostrar carga
        $('#cuerpoHistorial').html('<tr><td colspan="9" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></td></tr>');
        
        // Obtener datos del historial con anti-cache
        $.ajax({
            url: '../registro/obtener_historial.php',
            type: 'GET',
            cache: false, // Deshabilitar cache
            data: { 
                idConductor: idConductor,
                _t: new Date().getTime() // Timestamp para evitar cache
            },
            dataType: 'json',
            success: function(response) {
                if (response.success && response.data) {
                    const conductor = response.conductor;
                    const cursos = response.data;
                    datosHistorial = cursos; // Almacenar datos para exportación
                    nombreConductor = conductor.nombre + ' ' + conductor.Apepat + ' ' + conductor.Apemat;
                    
                    // Llenar información del conductor
                    $('#historialNombre').text(nombreConductor);
                    $('#historialDocumento').text(conductor.tipoDocumento + ': ' + conductor.numerodocumento);
                    $('#historialLicencia').text(conductor.tipolicencia + ' (' + conductor.licencia + ')');
                    $('#historialEstadoConductor').html(conductor.estado === 'Activo' ? 
                        '<span class="badge bg-success">Activo</span>' : 
                        '<span class="badge bg-danger">Inactivo</span>');
                    
                    // Actualizar resumen
                    actualizarResumen();
                    
                    // Llenar tabla de cursos
                    renderizarTabla(cursos);
                } else {
                    $('#cuerpoHistorial').html('<tr><td colspan="9" class="text-center text-danger">No se encontraron registros de desempeño</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                $('#cuerpoHistorial').html('<tr><td colspan="9" class="text-center text-danger">Error al cargar el historial</td></tr>');
                console.error("Error al cargar historial:", error);
            }
        });
    }
    
    // Manejar clic en botón ver desempeño
    $(document).on('click', '.ver-desempeno', function() {
        idConductorActual = $(this).data('idconductor');
        $('#historialDesempenoModal').modal('show');
        cargarHistorial(idConductorActual);
    });
    
    // Función para renderizar la tabla
    function renderizarTabla(cursos) {
        let html = '';
        if (cursos.length > 0) {
            cursos.forEach(curso => {
                // Estado del registro
                let estadoRegistro = '';
                if (curso.estado_registro === 'Activado') {
                    estadoRegistro = '<span class="badge bg-success">Activado</span>';
                } else if (curso.estado_registro === 'Terminado') {
                    estadoRegistro = '<span class="badge bg-primary">Terminado</span>';
                } else if (curso.estado_registro === 'No terminado') {
                    estadoRegistro = '<span class="badge bg-warning text-dark">No terminado</span>';
                } else {
                    estadoRegistro = '<span class="badge bg-light text-dark">Desconocido</span>';
                }
                
                // Estado desempeño
                let estadoDesempeno = 'N/A';
                let nota = 'N/A';
                let fechaRegistro = 'N/A';
                let botonEstado = '';
                
                if (curso.idDesempeno) {
                    nota = curso.nota || 'N/A';
                    fechaRegistro = curso.fecha_registro || 'N/A';
                    
                    // Verificación explícita de valores
                    switch(curso.estado_desempeno) {
                        case 'Pendiente':
                            estadoDesempeno = '<span class="badge bg-secondary">Pendiente</span>';
                            break;
                        case 'Acabado':
                            estadoDesempeno = '<span class="badge bg-success">Acabado</span>';
                            break;
                        case 'No Culmino':
                            estadoDesempeno = '<span class="badge bg-danger">No Culminó</span>';
                            break;
                        default:
                            estadoDesempeno = '<span class="badge bg-light text-dark">Desconocido</span>';
                    }
                    
                    botonEstado = `
                        <button class="btn btn-sm btn-warning cambiar-estado-desempeno" 
                            data-iddesempeno="${curso.idDesempeno}"
                            data-idregistrar="${curso.idregistrar}"
                            title="Cambiar estado desempeño">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    `;
                } else {
                    estadoDesempeno = '<span class="badge bg-light text-dark">Sin registro</span>';
                    botonEstado = '<button class="btn btn-sm btn-secondary" disabled><i class="fas fa-ban"></i></button>';
                }
                
                html += `
                    <tr>
                        <td>${curso.nombre_curso}</td>
                        <td>${curso.entidad}</td>
                        <td>${nota}</td>
                        <td>${curso.fechaInicio}</td>
                        <td>${curso.fechaFinal || 'En curso'}</td>
                        <td>${fechaRegistro}</td>
                        <td>${estadoRegistro}</td>
                        <td>${estadoDesempeno}</td>
                        <td>${botonEstado}</td>
                    </tr>
                `;
            });
        } else {
            html = '<tr><td colspan="9" class="text-center text-muted">No se encontraron registros de desempeño</td></tr>';
        }
        
        $('#cuerpoHistorial').html(html);
    }
    
    // Función de búsqueda
    $('#buscarHistorial').on('keyup', function() {
        const valorBusqueda = $(this).val().toLowerCase();
        
        if (valorBusqueda === '') {
            renderizarTabla(datosHistorial);
            return;
        }
        
        const resultados = datosHistorial.filter(curso => {
            return (
                curso.nombre_curso.toLowerCase().includes(valorBusqueda) ||
                curso.entidad.toLowerCase().includes(valorBusqueda) ||
                (curso.nota && curso.nota.toString().includes(valorBusqueda)) ||
                curso.fechaInicio.toLowerCase().includes(valorBusqueda) ||
                (curso.fechaFinal && curso.fechaFinal.toLowerCase().includes(valorBusqueda)) ||
                curso.estado_registro.toLowerCase().includes(valorBusqueda) ||
                curso.estado_desempeno.toLowerCase().includes(valorBusqueda)
            );
        });
        
        renderizarTabla(resultados);
    });
    
    // Limpiar búsqueda
    $('#limpiarBusqueda').click(function() {
        $('#buscarHistorial').val('');
        renderizarTabla(datosHistorial);
    });
    
    // Exportar a PDF
    $('#btnExportarPDF').click(function() {
        if (datosHistorial.length === 0) {
            Swal.fire('Advertencia', 'No hay datos para exportar', 'warning');
            return;
        }
        
        const doc = new jsPDF();
        
        // Título del documento
        doc.setFontSize(16);
        doc.text(`Historial de Desempeño - ${nombreConductor}`, 14, 15);
        doc.setFontSize(10);
        doc.text(`Generado el: ${new Date().toLocaleDateString()}`, 14, 22);
        
        // Encabezados de la tabla
        const headers = [
            ['Curso', 'Entidad', 'Nota', 'Inicio', 'Fin', 'Fecha Registro', 'Estado Registro', 'Estado Desempeño']
        ];
        
        // Datos de la tabla
        const data = datosHistorial.map(curso => [
            curso.nombre_curso,
            curso.entidad,
            curso.nota || 'N/A',
            curso.fechaInicio,
            curso.fechaFinal || 'En curso',
            curso.fecha_registro || 'N/A',
            curso.estado_registro,
            curso.estado_desempeno || 'N/A'
        ]);
        
        // Configuración de la tabla
        doc.autoTable({
            head: headers,
            body: data,
            startY: 30,
            styles: {
                fontSize: 8,
                cellPadding: 2,
                overflow: 'linebreak'
            },
            headStyles: {
                fillColor: [41, 128, 185],
                textColor: 255,
                fontStyle: 'bold'
            },
            alternateRowStyles: {
                fillColor: [245, 245, 245]
            },
            margin: { top: 30 }
        });
        
        // Guardar el PDF
        doc.save(`Historial_${nombreConductor.replace(/ /g, '_')}_${new Date().toISOString().slice(0,10)}.pdf`);
    });
    
    // Exportar a Excel
    $('#btnExportarExcel').click(function() {
        if (datosHistorial.length === 0) {
            Swal.fire('Advertencia', 'No hay datos para exportar', 'warning');
            return;
        }
        
        // Preparar los datos
        const datosExcel = datosHistorial.map(curso => ({
            'Curso': curso.nombre_curso,
            'Entidad': curso.entidad,
            'Nota': curso.nota || 'N/A',
            'Fecha Inicio': curso.fechaInicio,
            'Fecha Fin': curso.fechaFinal || 'En curso',
            'Fecha Registro': curso.fecha_registro || 'N/A',
            'Estado Registro': curso.estado_registro,
            'Estado Desempeño': curso.estado_desempeno || 'N/A'
        }));
        
        // Crear hoja de trabajo
        const ws = XLSX.utils.json_to_sheet(datosExcel);
        
        // Crear libro de trabajo
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Historial");
        
        // Generar archivo Excel
        XLSX.writeFile(wb, `Historial_${nombreConductor.replace(/ /g, '_')}_${new Date().toISOString().slice(0,10)}.xlsx`);
    });
    
    // Cambiar estado del desempeño - FUNCIÓN MEJORADA
    $(document).on('click', '.cambiar-estado-desempeno', function() {
        const idDesempeno = $(this).data('iddesempeno');
        const idregistrar = $(this).data('idregistrar');
        
        Swal.fire({
            title: 'Cambiar estado del desempeño',
            text: 'Seleccione el nuevo estado para este desempeño',
            input: 'select',
            inputOptions: {
                'Pendiente': 'Pendiente',
                'Acabado': 'Acabado',
                'No Culmino': 'No Culmino'
            },
            inputPlaceholder: 'Seleccione un estado',
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value) {
                    return 'Debe seleccionar un estado';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar loader mientras se procesa
                Swal.fire({
                    title: 'Actualizando estado',
                    html: 'Por favor espere...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
                
                // Determinar el estado correspondiente en registrarcurso
                let estadoRegistro = 'Activado';
                if (result.value === 'Acabado') {
                    estadoRegistro = 'Terminado';
                } else if (result.value === 'No Culmino') {
                    estadoRegistro = 'No terminado';
                }
                
                // Enviar ambos cambios en una sola solicitud
                $.ajax({
                    url: '../registro/cambiar_estado.php',
                    type: 'POST',
                    cache: false, // Deshabilitar cache
                    data: {
                        idDesempeno: idDesempeno,
                        estadoDesempeno: result.value,
                        idregistrar: idregistrar,
                        estadoRegistro: estadoRegistro,
                        _t: new Date().getTime() // Timestamp para evitar cache
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                title: 'Éxito',
                                text: response.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                // *** SOLUCIÓN: Recargar datos del servidor para asegurar sincronización ***
                                cargarHistorial(idConductorActual);
                            });
                        } else {
                            Swal.fire('Error', response.error, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire('Error', 'Error al actualizar los estados: ' + error, 'error');
                        console.error("Detalles del error:", xhr.responseText);
                    }
                });
            }
        });
    });
    
    // Configurar cierre del modal SIN recarga automática
    $('#btnCerrarModal').click(function() {
        $('#historialDesempenoModal').modal('hide');
    });
    
    $('#historialDesempenoModal .btn-close').click(function() {
        $('#historialDesempenoModal').modal('hide');
    });
    
    // Opcional: Agregar un botón para recargar manualmente si es necesario
    $('#historialDesempenoModal').on('hidden.bs.modal', function () {
        // Limpiar datos cuando se cierre el modal
        datosHistorial = [];
        nombreConductor = '';
        idConductorActual = null;
        $('#buscarHistorial').val('');
    });
});
</script>