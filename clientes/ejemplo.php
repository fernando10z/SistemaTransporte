<!-- Modal para Editar Cliente - Diseño Moderno -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="modalEditarClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarClienteLabel">
                    <i class="fas fa-user-edit me-2"></i>Editar Cliente
                </h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="$('#modalEditarCliente').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCliente" enctype="multipart/form-data">
                    <input type="hidden" id="edit_idCliente" name="idCliente">
                    
                    <!-- Selector de Tipo de Cliente (solo visual en edición) -->
                    <div class="tipo-cliente-selector mb-4">
                        <label class="form-label fw-medium mb-3">Tipo de Cliente</label>
                        <div class="d-flex gap-4">
                            <div class="tipo-cliente-option" id="edit_selectorNatural">
                                <input class="form-check-input" type="radio" name="tipoCliente" id="edit_tipoNatural" value="Natural" disabled>
                                <label class="tipo-cliente-label" for="edit_tipoNatural">
                                    <div class="icon-container">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Persona Natural</span>
                                </label>
                            </div>
                            <div class="tipo-cliente-option" id="edit_selectorEmpresa">
                                <input class="form-check-input" type="radio" name="tipoCliente" id="edit_tipoEmpresa" value="Empresa" disabled>
                                <label class="tipo-cliente-label" for="edit_tipoEmpresa">
                                    <div class="icon-container">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>Empresa</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-content">
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
                            <span>Información Adicional</span>
                        </div>
                        
                            
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Estado</label>
                                <div class="status-selector">
                                    <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select class="form-control" id="id_status" name="status" required>
                                        <option value="Activo" selected>Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                                </div>
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