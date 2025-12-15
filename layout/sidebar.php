<?php
include_once(__DIR__ . '/../conexion/conexion.php');

$id_rol = isset($_SESSION['idRol']) ? $_SESSION['idRol'] : null;
$userId = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 0;

try {
    $stmt = $conn->prepare("SELECT logo, nombre_empresa FROM configuracion_empresa LIMIT 1");
    $stmt->execute();
    $config = $stmt->fetch(PDO::FETCH_ASSOC);
    $logo_path = $config ? $config['logo'] : '../configuracion/empresa/default_logo.jpg';
    $nombre_empresa = $config ? $config['nombre_empresa'] : 'Empresa por defecto';
} catch (PDOException $e) {
    $logo_path = '../configuracion/empresa/default_logo.jpg';
    $nombre_empresa = 'Empresa por defecto';
}

?>

<style>
  :root {
    --sidebar-bg: #FFFFFF;
    --sidebar-width: 280px;
    --sidebar-collapsed-width: 80px;
    
    --brand-primary: #2ECC71;
    --brand-dark: #27AE60;
    --brand-light: #E8F8F0;
    
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-tertiary: #94A3B8;
    
    --border-color: #E2E8F0;
    --hover-bg: #F8FAFC;
    --active-bg: #F1F5F9;
    
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .left-sidebar {
    background: var(--sidebar-bg);
    width: var(--sidebar-width);
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    transition: var(--transition);
    z-index: 1000;
  }

  .brand-logo {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 72px;
  }

  .brand-logo a {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: var(--transition);
  }

  .logo-img-animated {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    object-fit: cover;
    transition: var(--transition);
    border: 2px solid var(--border-color);
  }

  .logo-img-animated:hover {
    transform: scale(1.05);
    border-color: var(--text-secondary);
  }

  .name-brand {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: -0.02em;
  }

  .close-btn {
    width: 32px;
    height: 32px;
    display: none;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
    color: var(--text-secondary);
  }

  .close-btn:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
  }

  .sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 16px 12px;
  }

  .sidebar-nav::-webkit-scrollbar {
    width: 6px;
  }

  .sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
  }

  .sidebar-nav::-webkit-scrollbar-thumb {
    background: var(--border-color);
    border-radius: 10px;
  }

  .sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }

  #sidebarnav {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .nav-small-cap {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 16px 12px 8px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-tertiary);
    margin-top: 8px;
  }

  .nav-small-cap:first-child {
    margin-top: 0;
  }

  .nav-small-cap-icon {
    font-size: 4px !important;
  }

  .sidebar-item {
    margin-bottom: 2px;
  }

  .sidebar-link {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 14px;
    font-weight: 500;
    transition: var(--transition);
    position: relative;
    cursor: pointer;
  }

  .sidebar-link:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
  }

  .sidebar-link.active {
    background: var(--active-bg);
    color: var(--text-primary);
    font-weight: 600;
  }

  .icon-box {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 18px;
    transition: var(--transition);
  }

  /* Colores sólidos en vez de gradientes */
  .bg-gradient-primary {
    background: #EEF2FF;
    color: #5B5FC7;
  }

  .bg-gradient-info {
    background: #E0F2FE;
    color: #0891B2;
  }

  .bg-gradient-warning {
    background: #FEF3C7;
    color: #D97706;
  }

  .bg-gradient-danger {
    background: #FEE2E2;
    color: #DC2626;
  }

  .bg-gradient-success {
    background: #D1FAE5;
    color: #059669;
  }

  .bg-gradient-secondary {
    background: #F1F5F9;
    color: #64748B;
  }

  .sidebar-link:hover .icon-box {
    transform: scale(1.05);
  }

  .sidebar-link.active .icon-box {
    transform: scale(1.05);
  }

  .arrow-icon {
    margin-left: auto;
    color: var(--text-tertiary);
    font-size: 16px;
    transition: var(--transition);
  }

  .sidebar-link[aria-expanded="true"] .arrow-icon {
    transform: rotate(90deg);
    color: var(--text-secondary);
  }

  .first-level {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .first-level.show {
    max-height: 500px;
  }

  .first-level .sidebar-link {
    padding: 8px 12px 8px 52px;
    font-size: 13px;
    position: relative;
  }

  /* Ocultar ícono de círculo de Tabler */
  .ti-circle-filled {
    display: none;
  }

  @media (max-width: 1199px) {
    .left-sidebar {
      transform: translateX(-100%);
    }
    
    .left-sidebar.show {
      transform: translateX(0);
    }
    
    .close-btn {
      display: flex;
    }
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(-10px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .first-level.show .sidebar-item {
    animation: slideIn 0.2s ease forwards;
  }

  .first-level.show .sidebar-item:nth-child(1) { animation-delay: 0.05s; }
  .first-level.show .sidebar-item:nth-child(2) { animation-delay: 0.1s; }
  .first-level.show .sidebar-item:nth-child(3) { animation-delay: 0.15s; }
  .first-level.show .sidebar-item:nth-child(4) { animation-delay: 0.2s; }
  .first-level.show .sidebar-item:nth-child(5) { animation-delay: 0.25s; }

  .hide-menu {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .sidebar-link span:not(.arrow-icon) {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
  }

  /* Efecto ripple sutil al hacer clic - SIN COLOR */
  .sidebar-link::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 10px;
    background: var(--text-secondary);
    opacity: 0;
    transform: scale(0);
    transition: all 0.4s ease;
  }

  .sidebar-link:active::after {
    opacity: 0.05;
    transform: scale(1);
  }
</style>

<!-- Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <div>
        <!-- Brand Logo -->
        <div class="brand-logo">
          <a href="../index.php">
            <img id="logoEmpresa" src="configuracion/empresa/<?php echo $logo_path; ?>" alt="Logo" class="logo-img-animated" />
            <span class="name-brand"><?php echo $nombre_empresa; ?></span>
          </a>
          <div class="close-btn" id="sidebarCollapse">
            <i class="ti ti-x fs-7"></i>
          </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            
            <!-- Dashboard -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Inicio</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../index.php" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-primary">
                    <i class="ti ti-layout-dashboard"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </span>
              </a>
            </li>
            
            <!-- Gestión de Clientes - Solo Administrador -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Gestión de Clientes</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-info">
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">Clientes</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../clientes.php">
                    <span class="hide-menu">Clientes</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../servicio.php">
                    <span class="hide-menu">Servicios</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../zonas.php">
                    <span class="hide-menu">Zonas</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../tarifa.php">
                    <span class="hide-menu">Tarifas</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../contratos.php">
                    <span class="hide-menu">Facturación</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Gestión Solicitudes - Admin y Logística -->
            <?php if ($id_rol == 1 || $id_rol == 2): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Solicitudes y Cargas</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-warning">
                    <i class="ti ti-clipboard-text"></i>
                  </span>
                  <span class="hide-menu">Solicitudes</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../solicitudes.php">
                    <span class="hide-menu">Solicitudes</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../vehiculos.php">
                    <span class="hide-menu">Vehículos</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../cotizacion.php">
                    <span class="hide-menu">Cotización</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../asignacion.php">
                    <span class="hide-menu">Asignación</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../seguimiento.php">
                    <span class="hide-menu">Seguimiento</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Planificación y Rutas - Solo Admin -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Planificación</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-success">
                    <i class="ti ti-route"></i>
                  </span>
                  <span class="hide-menu">Rutas</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../rutas.php">
                    <span class="hide-menu">Rutas</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../conductores.php">
                    <span class="hide-menu">Conductores</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../planificacion.php">
                    <span class="hide-menu">Planificación</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Monitoreo - Admin y Logística -->
            <?php if ($id_rol == 2 || $id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Monitoreo</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-danger">
                    <i class="ti ti-activity"></i>
                  </span>
                  <span class="hide-menu">Tiempo Real</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../eventos.php">
                    <span class="hide-menu">Eventos Rutas</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Gestión Financiera - Solo Admin -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Finanzas</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-warning">
                    <i class="ti ti-currency-dollar"></i>
                  </span>
                  <span class="hide-menu">Gestión Financiera</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../transferencia.php">
                    <span class="hide-menu">Transferencias</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../cuentas.php">
                    <span class="hide-menu">Cuentas Clientes</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../proveedores.php">
                    <span class="hide-menu">Proveedores</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../pagar.php">
                    <span class="hide-menu">Cuentas Proveedores</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Conductores - Solo Admin -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Personal</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-secondary">
                    <i class="ti ti-user-circle"></i>
                  </span>
                  <span class="hide-menu">Conductores</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../cursos.php">
                    <span class="hide-menu">Cursos</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../registro.php">
                    <span class="hide-menu">Registro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../asistencia.php">
                    <span class="hide-menu">Asistencias</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../sanciones.php">
                    <span class="hide-menu">Sanciones</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Almacén - Almacén y Admin -->
            <?php if ($id_rol == 4 || $id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Inventario</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-primary">
                    <i class="ti ti-package"></i>
                  </span>
                  <span class="hide-menu">Almacén</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../almacen.php">
                    <span class="hide-menu">Almacén</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../categoria.php">
                    <span class="hide-menu">Categorías</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../subcategoria.php">
                    <span class="hide-menu">Subcategorías</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../productos.php">
                    <span class="hide-menu">Productos</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../movimientos.php">
                    <span class="hide-menu">Movimientos</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
            <!-- Panel Conductor - Solo Conductores -->
            <?php if ($id_rol == 3): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Mi Panel</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../asistencia.php" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-success">
                    <i class="ti ti-user-check"></i>
                  </span>
                  <span class="hide-menu">Mi Asistencia</span>
                </span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- Configuraciones - Solo Admin -->
            <?php if ($id_rol == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon"></i>
              <span class="hide-menu">Sistema</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <span class="icon-box bg-gradient-info">
                    <i class="ti ti-settings"></i>
                  </span>
                  <span class="hide-menu">Configuración</span>
                </span>
                <span class="arrow-icon"><i class="ti ti-chevron-right"></i></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../usuarios.php">
                    <span class="hide-menu">Usuarios</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../configuraciones.php">
                    <span class="hide-menu">Configuraciones</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link sub-link" href="../condiciones.php">
                    <span class="hide-menu">Condiciones</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            
          </ul>
        </nav>
      </div>
    </aside>
    <!--  Sidebar End -->

<script>
// Cargar logo dinámicamente
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

// Manejo de menús colapsables
document.addEventListener('DOMContentLoaded', function() {
  const menuLinks = document.querySelectorAll('.sidebar-link.has-arrow');
  
  menuLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      
      const submenu = this.nextElementSibling;
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      
      // Cerrar otros menús
      document.querySelectorAll('.first-level.show').forEach(menu => {
        if (menu !== submenu) {
          menu.classList.remove('show');
          menu.previousElementSibling.setAttribute('aria-expanded', 'false');
        }
      });
      
      // Toggle menú actual
      if (isExpanded) {
        submenu.classList.remove('show');
        this.setAttribute('aria-expanded', 'false');
      } else {
        submenu.classList.add('show');
        this.setAttribute('aria-expanded', 'true');
      }
    });
  });
  
  // Marcar enlace activo según URL
  const currentPath = window.location.pathname;
  document.querySelectorAll('.sidebar-link').forEach(link => {
    const href = link.getAttribute('href');
    if (href && currentPath.includes(href.replace('../', ''))) {
      link.classList.add('active');
      
      // Expandir menú padre si es submenú
      const parentSubmenu = link.closest('.first-level');
      if (parentSubmenu) {
        parentSubmenu.classList.add('show');
        parentSubmenu.previousElementSibling.setAttribute('aria-expanded', 'true');
      }
    }
  });
});

// Toggle sidebar en móvil
const sidebarToggle = document.getElementById('sidebarCollapse');
if (sidebarToggle) {
  sidebarToggle.addEventListener('click', function() {
    document.querySelector('.left-sidebar').classList.toggle('show');
  });
}
</script>