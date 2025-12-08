<!-- Modal para editar subcategoría - Diseño Moderno -->
<div class="modal fade" id="editarSubcategoriaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:23px; color:black">
          <i class="fas fa-edit me-2"></i>Editar Subcategoría
        </h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#editarSubcategoriaModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarSubcategoria">
          <input type="hidden" id="edit_idSubcategoria" name="idSubcategoria">
          
          <div class="section-divider">
            <span>Información Básica</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="edit_selectAlmacen" name="idAlmacen" required>
                  <option value="">Cargando almacenes...</option>
                </select>
                <label for="edit_selectAlmacen">Almacén <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-md-10">
              <div class="form-floating">
                <input type="text" class="form-control" id="edit_nombreCategoriaSeleccionada" readonly required>
                <label for="edit_nombreCategoriaSeleccionada">Categoría <span class="text-danger">*</span></label>
                <input type="hidden" id="edit_idCategoria" name="idCategoria">
              </div>
            </div>
            <div class="col-md-2">
              <button class="btn btn-outline-primary w-100 h-100" type="button" id="edit_btnBuscarCategoria">
                <i class="fas fa-search me-2"></i>Buscar
              </button>
            </div>
          </div>
          
          <div class="section-divider mt-4">
            <span>Detalles de Subcategoría</span>
          </div>
          
          <div class="row g-3 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="edit_nomArea" name="nomArea" required>
                <label for="edit_nomArea">Nombre de Subcategoría <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" id="edit_descripcion" name="descripcion" style="height: 100px" required></textarea>
                <label for="edit_descripcion">Descripción <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
          
          <div class="row g-3 mt-3 animate__animated animate__fadeInUp animate__delay-4s">
            <div class="col-12">
              <div class="form-floating">
                <select class="form-select" id="edit_status" name="status" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                <label for="edit_status">Estado <span class="text-danger">*</span></label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="$('#editarSubcategoriaModal').modal('hide')">
          <i class="fas fa-times me-2"></i>Cancelar
        </button>
        <button type="button" class="btn btn-primary" id="btnActualizarSubcategoria">
          <i class="fas fa-save me-2"></i>Actualizar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para buscar categorías - Diseño Moderno -->
<div class="modal fade" id="buscarCategoriaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-search me-2"></i>Seleccionar Categoría
        </h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#buscarCategoriaModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" id="buscarCategoriaInput" placeholder="Buscar por nombre o descripción...">
            <button class="btn btn-primary" type="button" id="btnBuscarCategoriaModal">
              Buscar
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="tablaCategorias" class="table-group-divider"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="$('#buscarCategoriaModal').modal('hide')">
          <i class="fas fa-times me-2"></i>Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<style>
/* Estilos para los modales de subcategoría */
#editarSubcategoriaModal .modal-content,
#buscarCategoriaModal .modal-content {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}
#editarSubcategoriaModal .modal-title {
    color: var(--dark-color);
    font-weight: 700;
    display: inline-block; /* importante para que ::after quede debajo */
    position: relative;     /* necesario para ubicar ::after relativo al título */
}

#editarSubcategoriaModal .modal-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px; /* espacio debajo del texto */
    width: 47px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}
#editarSubcategoriaModal .modal-header,
#buscarCategoriaModal .modal-header {
  background-color: #fff;
  border-bottom: 1px solid var(--light-gray);
  padding: 13px 15px;
}

#editarSubcategoriaModal .modal-title,
#buscarCategoriaModal .modal-title {
  color: var(--dark-color);
  font-weight: 600;
  display: flex;
  align-items: center;
}

#editarSubcategoriaModal .modal-body,
#buscarCategoriaModal .modal-body {
  padding: 25px;
}

#editarSubcategoriaModal .modal-footer,
#buscarCategoriaModal .modal-footer {
  border-top: 1px solid var(--light-gray);
  padding: 16px 25px;
  background-color: #fff;
}

#editarSubcategoriaModal .section-divider {
  position: relative;
  text-align: center;
  margin: 30px 0 25px;
  overflow: hidden;
}

#editarSubcategoriaModal .section-divider span {
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

#editarSubcategoriaModal .section-divider:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: var(--light-gray);
  z-index: 0;
}

#editarSubcategoriaModal .form-floating > .form-control,
#editarSubcategoriaModal .form-floating > .form-select,
#buscarCategoriaModal .form-floating > .form-control {
  height: 56px;
  padding: 1rem 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 8px;
  transition: var(--transition);
  color: var(--dark-color);
}

#editarSubcategoriaModal .form-floating > textarea.form-control {
  height: auto;
  min-height: 100px;
  padding-top: 1.5rem;
}

#editarSubcategoriaModal .form-floating > .form-control:focus,
#editarSubcategoriaModal .form-floating > .form-select:focus,
#buscarCategoriaModal .form-floating > .form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.15);
}

#editarSubcategoriaModal .form-floating > label,
#buscarCategoriaModal .form-floating > label {
  padding: 1rem 0.75rem;
  color: var(--gray-color);
}

#editarSubcategoriaModal .form-floating > .form-control:focus ~ label,
#editarSubcategoriaModal .form-floating > .form-control:not(:placeholder-shown) ~ label,
#editarSubcategoriaModal .form-floating > .form-select ~ label,
#buscarCategoriaModal .form-floating > .form-control:focus ~ label {
  color: var(--primary-color);
  opacity: 0.8;
  transform: scale(0.9) translateY(-0.5rem) translateX(0);
}

#editarSubcategoriaModal .text-danger,
#buscarCategoriaModal .text-danger {
  color: var(--danger-color) !important;
}

/* Estilos para la tabla de búsqueda */
#buscarCategoriaModal .table {
  --bs-table-bg: transparent;
  --bs-table-striped-bg: rgba(237, 242, 249, 0.5);
  --bs-table-hover-bg: rgba(237, 242, 249, 0.8);
  margin-bottom: 0;
}

#buscarCategoriaModal .table thead th {
  background-color: var(--light-gray);
  color: var(--dark-color);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.5px;
}

#buscarCategoriaModal .table-hover tbody tr:hover {
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

.mt-3 {
  margin-top: 1rem !important;
}

.mt-4 {
  margin-top: 1.5rem !important;
}

.me-2 {
  margin-right: 0.5rem !important;
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

.btn-outline-primary {
  border-color: var(--primary-color);
  color: var(--primary-color);
}

.btn-outline-primary:hover {
  background-color: var(--primary-color);
  color: white;
}

/* Estilos para elementos readonly */
input[readonly], select[readonly] {
  background-color: var(--light-gray);
  border-color: var(--light-gray);
  cursor: not-allowed;
}

/* Estilos para el input group */
.input-group-text {
  background-color: var(--light-gray);
  color: var(--gray-color);
  border-color: var(--light-gray);
}
</style>
<script>
  (function() {
    // Variables para los modales (ámbito local)
    let editarSubcategoriaModal;
    let buscarCategoriaModalEditar;

    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar modales
        editarSubcategoriaModal = new bootstrap.Modal(document.getElementById('editarSubcategoriaModal'));
        buscarCategoriaModalEditar = new bootstrap.Modal(document.getElementById('buscarCategoriaModal'), {
            backdrop: 'static',
            keyboard: false
        });
        
        // Evento para botones de edición
        document.addEventListener('click', function(e) {
            if (e.target.closest('.editar-subcategoria')) {
                const button = e.target.closest('.editar-subcategoria');
                const idSubcategoria = button.getAttribute('data-id');
                cargarDatosSubcategoria(idSubcategoria);
            }
        });
        
        // Botón para buscar categorías en modal de edición
        document.getElementById('edit_btnBuscarCategoria')?.addEventListener('click', function() {
            const idAlmacen = document.getElementById('edit_selectAlmacen').value;
            if (idAlmacen) {
                buscarCategoriasPorAlmacen(idAlmacen, 'edit');
                buscarCategoriaModalEditar.show();
            }
        });
        
        // Botón actualizar
        document.getElementById('btnActualizarSubcategoria')?.addEventListener('click', actualizarSubcategoria);
    });

    function cargarDatosSubcategoria(idSubcategoria) {
        fetch(`../subcategoria/obtener.php?idSubcategoria=${idSubcategoria}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Llenar campos del formulario
                    document.getElementById('edit_idSubcategoria').value = data.idSubcategoria;
                    document.getElementById('edit_nomArea').value = data.nomArea;
                    document.getElementById('edit_descripcion').value = data.descripcion;
                    document.getElementById('edit_status').value = data.status;
                    
                    // Cargar almacenes y seleccionar el correcto
                    cargarAlmacenesParaEdicion(data.idAlmacen, data.idCategoria, data.nombreCategoria);
                    
                    // Mostrar modal
                    editarSubcategoriaModal.show();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Error al cargar datos', 'error');
            });
    }
    // Dentro de la función IIFE, añade este código:
document.addEventListener('click', function(e) {
    // Cerrar modal al hacer clic en botones de cierre
    if (e.target.closest('[data-dismiss="modal"], .btn-close')) {
        buscarCategoriaModalEditar.hide();
    }
    
    // Cerrar modal al seleccionar categoría (ya incluido en tu función buscarCategoriasPorAlmacen)
    if (e.target.closest('.btn-seleccionar')) {
        buscarCategoriaModalEditar.hide();
    }
});

    function cargarAlmacenesParaEdicion(idAlmacen, idCategoria, nombreCategoria) {
        fetch('../subcategoria/obteneralmacen.php')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('edit_selectAlmacen');
                select.innerHTML = '<option value="">Seleccionar almacén...</option>';
                
                data.forEach(almacen => {
                    const option = document.createElement('option');
                    option.value = almacen.idAlmacen;
                    option.textContent = almacen.nombre;
                    option.selected = (almacen.idAlmacen == idAlmacen);
                    select.appendChild(option);
                });
                
                // Establecer categoría seleccionada
                document.getElementById('edit_idCategoria').value = idCategoria;
                document.getElementById('edit_nombreCategoriaSeleccionada').value = nombreCategoria;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('edit_selectAlmacen').innerHTML = '<option value="">Error al cargar</option>';
            });
    }

    function buscarCategoriasPorAlmacen(idAlmacen, prefix = '') {
        fetch(`../subcategoria/buscarcategoria.php?idAlmacen=${idAlmacen}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('tablaCategorias');
                tbody.innerHTML = '';
                
                if (data.length > 0) {
                    data.forEach(categoria => {
                        const tr = document.createElement('tr');
                        
                        tr.innerHTML = `
                            <td>${categoria.nombreCategoria}</td>
                            <td>${categoria.descripcion}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-seleccionar" 
                                        data-id="${categoria.idCategoria}" 
                                        data-nombre="${categoria.nombreCategoria}">
                                    Seleccionar
                                </button>
                            </td>
                        `;
                        
                        tr.querySelector('.btn-seleccionar').addEventListener('click', function() {
                            document.getElementById(`${prefix}_idCategoria`).value = this.dataset.id;
                            document.getElementById(`${prefix}_nombreCategoriaSeleccionada`).value = this.dataset.nombre;
                            buscarCategoriaModalEditar.hide();
                        });
                        
                        tbody.appendChild(tr);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center">No hay categorías</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('tablaCategorias').innerHTML = '<tr><td colspan="3" class="text-center text-danger">Error al cargar</td></tr>';
            });
    }

    function actualizarSubcategoria() {
        const form = document.getElementById('formEditarSubcategoria');
        
        if (form.checkValidity()) {
            const formData = new FormData(form);
            
            Swal.fire({
                title: 'Actualizando...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
            fetch('../subcategoria/actualizar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: data.message,
                        icon: 'success'
                    }).then(() => {
                        editarSubcategoriaModal.hide();
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Error al actualizar', 'error');
                console.error('Error:', error);
            });
        } else {
            Swal.fire('Advertencia', 'Complete todos los campos', 'warning');
        }
    }
})();
</script>
<style>
  #editarSubcategoriaModal{
    font-size: 78%;
  }
  /* Asegura que el modal de búsqueda tenga mayor z-index */
#buscarCategoriaModal {
    z-index: 1060 !important; /* Bootstrap usa 1050 para modales */
}

/* Oscurece el fondo del modal padre */
.modal-backdrop.show {
    opacity: 0.5 !important;
}
</style>
