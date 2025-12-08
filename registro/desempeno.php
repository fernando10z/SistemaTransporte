<div class="modal fade" id="desempenoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-chart-line me-2"></i> Registrar Desempeño
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="desempenoForm">
                    <input type="hidden" id="idregistrarDesempeno">
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Conductor</label>
                                <input type="text" class="form-control" id="conductorInfoDesempeno" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Documento</label>
                                <input type="text" class="form-control" id="documentoInfoDesempeno" readonly>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Curso</label>
                                <input type="text" class="form-control" id="cursoInfoDesempeno" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notaDesempeno" class="form-label">Nota (1-20)</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" id="decrementarNota">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" class="form-control text-center" id="notaDesempeno" 
                                           min="1" max="20" value="1" onkeydown="return false">
                                    <button class="btn btn-outline-secondary" type="button" id="incrementarNota">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estadoDesempeno" class="form-label">Estado</label>
                                <select class="form-select" id="estadoDesempeno" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Acabado">Acabado</option>
                                    <option value="No Culmino">No Culminó</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="observacionesDesempeno" class="form-label">Observaciones</label>
                                <textarea class="form-control" id="observacionesDesempeno" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Guardar Desempeño
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables globales
    let currentRegistroId = null;
    
    // Manejadores de incremento/decremento
    const notaInput = document.getElementById('notaDesempeno');
    document.getElementById('incrementarNota').addEventListener('click', () => {
        let nota = parseInt(notaInput.value);
        if (nota < 20) notaInput.value = nota + 1;
    });
    
    document.getElementById('decrementarNota').addEventListener('click', () => {
        let nota = parseInt(notaInput.value);
        if (nota > 1) notaInput.value = nota - 1;
    });

    // Función para cargar datos en el modal
    window.cargarDatosDesempeno = function(registroId) {
        currentRegistroId = registroId;
        
        Swal.fire({
            title: 'Cargando datos',
            html: 'Por favor espere...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        fetch(`../registro/obtenerregistro.php?id=${registroId}`)
            .then(response => {
                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                return response.json();
            })
            .then(data => {
                Swal.close();
                
                if (!data) throw new Error('No se recibieron datos');
                
                // Llenar campos del modal
                document.getElementById('conductorInfoDesempeno').value = 
                    `${data.nombre || ''} ${data.Apepat || ''} ${data.Apemat || ''}`.trim();
                
                document.getElementById('documentoInfoDesempeno').value = 
                    `${data.tipoDocumento || ''}: ${data.numerodocumento || ''}`.trim();
                
                document.getElementById('cursoInfoDesempeno').value = 
                `${data.nombre_curso|| ''} - ${data.entidad|| ''}`.trim() ;
                
                // Si existe desempeño previo
                if (data.nota) {
                    notaInput.value = data.nota;
                    document.getElementById('estadoDesempeno').value = data.estado || 'Pendiente';
                    document.getElementById('observacionesDesempeno').value = data.observaciones || '';
                } else {
                    // Valores por defecto
                    notaInput.value = 1;
                    document.getElementById('estadoDesempeno').value = 'Pendiente';
                    document.getElementById('observacionesDesempeno').value = '';
                }
                
                new bootstrap.Modal(document.getElementById('desempenoModal')).show();
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al cargar datos: ' + error.message
                });
            });
    };

    // Manejador del formulario
    document.getElementById('desempenoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nota = parseInt(notaInput.value);
        if (nota < 1 || nota > 20) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La nota debe estar entre 1 y 20'
            });
            return;
        }
        
        const formData = {
            idregistrar: currentRegistroId,
            nota: nota,
            estado: document.getElementById('estadoDesempeno').value,
            observaciones: document.getElementById('observacionesDesempeno').value
        };
        
        Swal.fire({
            title: 'Guardando',
            html: 'Por favor espere...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        fetch('../registro/guardardesempeno.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en el servidor');
            return response.json();
        })
        .then(data => {
            if (data.error) throw new Error(data.error);
            
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: data.success || 'Desempeño guardado',
                timer: 1500,
                showConfirmButton: false
            }).then(() => location.reload());
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Error al guardar'
            });
        });
    });
    
    // Event delegation para botones de edición
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.editar-desempeno');
        if (btn && btn.dataset.id) {
            cargarDatosDesempeno(btn.dataset.id);
        }
    });
});
</script>