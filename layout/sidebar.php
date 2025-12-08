<?php
// sidebar.php - Ya no necesita session_start() porque se hace en index.php
include_once(__DIR__ . '/../conexion/conexion.php');

// Verificar si el usuario ha iniciado sesión y tiene un rol asignado
$id_rol = isset($_SESSION['idRol']) ? $_SESSION['idRol'] : null;
$userId = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 0;
?>
<!-- Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
 <div class="brand-logo d-flex align-items-center justify-content-between px-3 py-2">
  <a href="../index.php" class="d-flex align-items-center text-decoration-none">
    <img id="logoEmpresa" src="" alt="Logo" class="rounded-circle shadow-sm logo-img-animated" />
    <span class="ms-3 fw-bold fs-5 text-dark name-brand">TRANSPORTES</span>
  </a>
  <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
    <i class="ti ti-x fs-8"></i>
  </div>
</div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <!-- Dashboard - Accesible para todos los roles -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Inicio</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark" href="../index.php" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-primary">
                    <i class="ti ti-layout-dashboard fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Dashboard</span>
                </span>
              </a>
            </li>
            
            <!-- Gestión de Clientes - Solo Administrador -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Gestión de Clientes</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-info">
                    <i class="ti ti-apps fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Gestión Clientes</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../clientes.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Clientes</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../servicio.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Servicios</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../zonas.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Zonas</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../tarifa.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Tarifas</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../contratos.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Facturación</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Gestion Solicitudes y Cargas - Solo Administrador -->
            <?php if ($id_rol == 1 || $id_rol == 2): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Gestion Solicitudes y Cargas</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-warning">
                    <i class="ti ti-file-description fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Solicitudes</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../solicitudes.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Solicitud</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../vehiculos.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Vehiculos</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../cotizacion.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Cotizacion</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../asignacion.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Asignacion</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../seguimiento.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Seguimiento</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Planificacion y Rutas - Solo Administrador y Logística -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Planificacion y Rutas</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-success">
                    <i class="ti ti-route fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Rutas</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../rutas.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Rutas</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../conductores.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Conductores</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../planificacion.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Planificacion</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            <!-- Monitoreos tiempo real - Solo Logística (Rol 2) -->
            <?php if ($id_rol == 2|| $id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Monitoreos tiempo real</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-danger">
                    <i class="ti ti-device-analytics fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Monitoreo</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../eventos.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Eventos Rutas</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
               <!-- Gestion Solicitudes y Cargas - Solo Administrador -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Gestión Financiera</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-warning">
                    <i class="ti ti-file-description fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Gestión Financiera</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../transferencia.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Transferencias</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../cuentas.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Cuentas Clientes</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../proveedores.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Proveedores</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../pagar.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Cuentas Proveedores</span>
                    </span>
                  </a>
                </li>
               
              </ul>
            </li>
            <?php endif; ?>
            
            
            <!-- Gestión de Conductores - Solo Logística (Rol 2) -->
            <?php if ( $id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Gestión de Conductores</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-secondary">
                    <i class="ti ti-user-circle fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Conductores</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../cursos.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Cursos</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../registro.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Registro</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../asistencia.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Asistencias</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../sanciones.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Sanciones</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Módulo de Almacén - Solo Almacén (Rol 4) -->
            <?php if ($id_rol == 4|| $id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Módulo de Almacén</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-primary">
                    <i class="ti ti-building-warehouse fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Almacén</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../almacen.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Almacen</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../categoria.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Categoria</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../subcategoria.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Subcategoria</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../productos.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Productos</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../movimientos.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Movimientos</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Asistencia - Solo Conductores (Rol 3) -->
            <?php if ($id_rol == 3): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Mi Panel</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark" href="../asistencia.php" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-secondary">
                    <i class="ti ti-user-check fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Mi Asistencia</span>
                </span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- Configuraciones - Solo Administrador -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Configuraciones</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <span class="d-flex align-items-center">
                  <span class="icon-box bg-gradient-info">
                    <i class="ti ti-settings fs-5"></i>
                  </span>
                  <span class="hide-menu ms-3">Sistema</span>
                  <span class="arrow-icon ms-auto"><i class="ti ti-chevron-right"></i></span>
                </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../usuarios.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Usuarios</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../configuraciones.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Configuraciones</span>
                    </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../condiciones.php">
                    <span class="d-flex align-items-center">
                      <i class="ti ti-circle-filled fs-1"></i>
                      <span class="hide-menu ms-2">Condiciones</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
      <script>
document.addEventListener("DOMContentLoaded", function () {
  fetch("../planificacion/logo.php")
    .then(response => response.json())
    .then(data => {
      const logoPath = data.logo_path || "../configuracion/empresa/default_logo.jpg";
      document.getElementById("logoEmpresa").src = logoPath;
    })
    .catch(error => {
      console.error("Error al cargar el logo:", error);
      document.getElementById("logoEmpresa").src = "../configuracion/empresa/default_logo.jpg";
    });
});
</script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
  const arrows = document.querySelectorAll('.sidebar-link.has-arrow');
  
  arrows.forEach(arrow => {
    arrow.addEventListener('click', function(e) {
      e.preventDefault();
      const parent = this.parentElement;
      const submenu = this.nextElementSibling;
      
      // Cerrar otros menús abiertos
      document.querySelectorAll('.sidebar-item .first-level').forEach(menu => {
        if (menu !== submenu && menu.classList.contains('show')) {
          menu.classList.remove('show');
          menu.previousElementSibling.setAttribute('aria-expanded', 'false');
        }
      });
      
      // Alternar el menú actual
      submenu.classList.toggle('show');
      this.setAttribute('aria-expanded', submenu.classList.contains('show'));
    });
  });
});
      </script>
      <style>
        /* Mejoras visuales para el sidebar */
/* Sidebar Premium Styles */
:root {
  --sidebar-bg: #fff;
  --sidebar-width: 270px;
  --primary-color: #5d87ff;
  --info-color: #539BFF;
  --warning-color: #FFAE1F;
  --danger-color: #FA896B;
  --success-color: #13DEB9;
  --secondary-color: #5A76A6;
  --dark-color: #2b2e4a;
}

.left-sidebar {
  background: var(--sidebar-bg);
  box-shadow: 1px 0 20px rgba(0,0,0,0.08);
  width: var(--sidebar-width);
  transition: all 0.3s ease;
  position: relative;
  z-index: 10;
}

.sidebar-nav {
  padding: 15px 10px;
  height: calc(100vh - 70px);
  display: flex;
  flex-direction: column;
}

.sidebar-item {
  margin-bottom: 5px;
  position: relative;
}

.sidebar-link {
  border-radius: 8px;
  padding: 12px 15px;
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  color: #5a6a85;
  font-weight: 500;
}

.sidebar-link:hover {
  background: rgba(93, 135, 255, 0.06);
  transform: translateX(5px);
  color: var(--primary-color);
}

.sidebar-link:hover .icon-box {
  transform: scale(1.1);
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}

.sidebar-link.waves-effect {
  position: relative;
  overflow: hidden;
}

.icon-box {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  margin-right: 12px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.bg-gradient-primary {
  background: linear-gradient(135deg, var(--primary-color), #6c8cff);
  color: white;
}

.bg-gradient-info {
  background: linear-gradient(135deg, var(--info-color), #7aa8ff);
  color: white;
}

.bg-gradient-warning {
  background: linear-gradient(135deg, var(--warning-color), #ffc246);
  color: white;
}

.bg-gradient-danger {
  background: linear-gradient(135deg, var(--danger-color), #ff9d7d);
  color: white;
}

.bg-gradient-success {
  background: linear-gradient(135deg, var(--success-color), #2ce9b6);
  color: white;
}

.bg-gradient-secondary {
  background: linear-gradient(135deg, var(--secondary-color), #6d84b4);
  color: white;
}

.bg-gradient-dark {
  background: linear-gradient(135deg, var(--dark-color), #3a3f6d);
  color: white;
}

.has-arrow .arrow-icon {
  transition: all 0.3s ease;
  opacity: 0.6;
  font-size: 0.9rem;
}

.has-arrow[aria-expanded="true"] .arrow-icon {
  transform: rotate(90deg);
  opacity: 1;
  color: var(--primary-color);
}

.first-level {
  padding-left: 15px;
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.first-level .sidebar-link {
  padding: 10px 15px 10px 35px;
  font-size: 0.9rem;
}

.sub-link {
  position: relative;
}

.sub-link::before {
  content: '';
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: rgba(93, 135, 255, 0.3);
  transition: all 0.3s ease;
}

.sub-link:hover::before {
  background: var(--primary-color);
  width: 8px;
  height: 8px;
}

.upgrade-card {
  border: none;
  position: relative;
  overflow: hidden;
  z-index: 1;
  transition: all 0.5s ease;
  margin-top: auto;
}

.upgrade-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.upgrade-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.circle-shape-1 {
  position: absolute;
  top: -20px;
  right: -20px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  animation: pulse 6s infinite linear;
}

.circle-shape-2 {
  position: absolute;
  bottom: -30px;
  right: -30px;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background: rgba(255,255,255,0.05);
  animation: pulse 8s infinite linear;
}

.btn-hover-shine {
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}

.btn-hover-shine::after {
  content: '';
  position: absolute;
  top: -50%;
  left: -60%;
  width: 20%;
  height: 200%;
  background: rgba(255,255,255,0.2);
  transform: rotate(30deg);
  transition: all 0.6s ease;
}

.btn-hover-shine:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.btn-hover-shine:hover::after {
  left: 120%;
}

.nav-small-cap {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #6c757d;
  padding: 12px 15px;
  margin-top: 10px;
  position: relative;
}

.nav-small-cap::after {
  content: '';
  position: absolute;
  left: 15px;
  right: 15px;
  bottom: 0;
  height: 1px;
  background: rgba(0,0,0,0.05);
}

/* Animations */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
  0% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.1); opacity: 0.7; }
  100% { transform: scale(1); opacity: 1; }
}

.first-level li {
  animation: fadeIn 0.3s ease forwards;
  opacity: 0;
}

.first-level li:nth-child(1) { animation-delay: 0.1s; }
.first-level li:nth-child(2) { animation-delay: 0.2s; }
.first-level li:nth-child(3) { animation-delay: 0.3s; }
.first-level li:nth-child(4) { animation-delay: 0.4s; }
.first-level li:nth-child(5) { animation-delay: 0.5s; }

/* Active state */
.sidebar-link.active {
  background: rgba(93, 135, 255, 0.1);
  color: var(--primary-color);
  font-weight: 600;
}

.sidebar-link.active .icon-box {
  box-shadow: 0 5px 15px rgba(93, 135, 255, 0.2);
  transform: scale(1.05);
}

/* Scrollbar styling */
.simplebar-scrollbar::before {
  background: rgba(0,0,0,0.2);
  border-radius: 10px;
}

.simplebar-track.simplebar-vertical {
  width: 6px;
}
      </style>
      <style>
  .logo-img-animated {
  width: 80px;
  height: 80px;
  object-fit: cover;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 2px solid #2c3c69;
}

.logo-img-animated:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.name-brand {
  font-family: 'Segoe UI', sans-serif;
  color: #2c3c69;
  transition: color 0.3s ease;
}

.name-brand:hover {
  color: #1c76b3;
}

</style>