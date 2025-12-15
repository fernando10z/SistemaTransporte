<style>
  :root {
    --header-height: 70px;
    --header-bg: #FFFFFF;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-tertiary: #94A3B8;
    --border-color: #E2E8F0;
    --hover-bg: #F8FAFC;
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .app-header {
    position: fixed;
    top: 0;
    right: 0;
    left: 280px;
    height: var(--header-height);
    background: var(--header-bg);
    border-bottom: 1px solid var(--border-color);
    z-index: 999;
    transition: left 0.3s ease;
  }

  .app-header .navbar {
    height: 100%;
    padding: 0 32px;
  }

  .sidebartoggler {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    color: var(--text-secondary);
    transition: var(--transition);
    cursor: pointer;
  }

  .sidebartoggler:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
  }

  .sidebartoggler i {
    font-size: 22px;
  }

  .header-search {
    position: relative;
    max-width: 400px;
    width: 100%;
    margin-left: 24px;
  }

  .header-search input {
    width: 100%;
    padding: 10px 16px 10px 42px;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    font-size: 14px;
    color: var(--text-primary);
    background: var(--hover-bg);
    transition: var(--transition);
  }

  .header-search input:focus {
    outline: none;
    background: var(--header-bg);
    border-color: var(--text-secondary);
  }

  .header-search input::placeholder {
    color: var(--text-tertiary);
  }

  .header-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-tertiary);
    font-size: 18px;
    pointer-events: none;
  }

  .navbar-nav {
    gap: 12px;
  }

  /* Avatar del usuario */
  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid var(--border-color);
    transition: var(--transition);
    cursor: pointer;
  }

  .user-avatar:hover {
    border-color: var(--text-secondary);
    transform: scale(1.05);
  }

  /* Botón de notificaciones (opcional) */
  .notification-btn {
    position: relative;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    color: var(--text-secondary);
    transition: var(--transition);
    cursor: pointer;
  }

  .notification-btn:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
  }

  .notification-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 8px;
    height: 8px;
    background: #EF4444;
    border-radius: 50%;
    border: 2px solid var(--header-bg);
  }

  .dropdown-menu {
    min-width: 280px;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    padding: 0;
    margin-top: 12px;
    overflow: hidden;
  }

  .dropdown-menu-animate-up {
    animation: dropdownSlide 0.3s ease;
  }

  @keyframes dropdownSlide {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Header del dropdown */
  .dropdown-header-section {
    padding: 20px;
    background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
    border-bottom: 1px solid var(--border-color);
  }

  .dropdown-user-info {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .dropdown-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    object-fit: cover;
    border: 2px solid var(--border-color);
  }

  .dropdown-user-details h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: var(--text-primary);
  }

  .dropdown-user-details p {
    margin: 2px 0 0;
    font-size: 13px;
    color: var(--text-secondary);
  }

  /* Body del dropdown */
  .dropdown-body {
    padding: 12px 0;
  }

  .dropdown-item {
    padding: 10px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--text-secondary);
    font-size: 14px;
    transition: var(--transition);
    cursor: pointer;
    text-decoration: none;
  }

  .dropdown-item:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
  }

  .dropdown-item i {
    font-size: 18px;
    width: 20px;
    text-align: center;
  }

  /* Divider */
  .dropdown-divider {
    margin: 8px 0;
    border-top: 1px solid var(--border-color);
  }

  /* Footer del dropdown */
  .dropdown-footer {
    padding: 12px 20px;
    border-top: 1px solid var(--border-color);
  }

  .btn-logout {
    width: 100%;
    padding: 10px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    background: transparent;
    color: var(--text-secondary);
    font-size: 14px;
    font-weight: 600;
    transition: var(--transition);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .btn-logout:hover {
    background: #FEE2E2;
    border-color: #FCA5A5;
    color: #DC2626;
  }

  .header-search {
    position: relative;
    max-width: 400px;
    width: 100%;
    margin-left: 24px;
  }

  .search-results {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--header-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    max-height: 400px;
    overflow-y: auto;
    display: none;
    z-index: 1000;
  }

  .search-results.show {
    display: block;
  }

  .search-results::-webkit-scrollbar {
    width: 6px;
  }

  .search-results::-webkit-scrollbar-thumb {
    background: var(--border-color);
    border-radius: 10px;
  }

  .search-category {
    padding: 12px 16px 8px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-tertiary);
    border-top: 1px solid var(--border-color);
  }

  .search-category:first-child {
    border-top: none;
  }

  .search-item {
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    color: var(--text-secondary);
  }

  .search-item:hover {
    background: var(--hover-bg);
    color: var(--text-primary);
  }

  .search-item-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
  }

  .search-item-text {
    flex: 1;
  }

  .search-item-title {
    font-size: 14px;
    font-weight: 500;
    margin: 0;
  }

  .search-item-path {
    font-size: 12px;
    color: var(--text-tertiary);
    margin: 2px 0 0;
  }

  .search-empty {
    padding: 32px 16px;
    text-align: center;
    color: var(--text-tertiary);
    font-size: 14px;
  }

  .search-empty i {
    font-size: 48px;
    margin-bottom: 12px;
    opacity: 0.3;
  }

  @media (max-width: 1199px) {
    .app-header {
      left: 0;
    }
    
    .header-search {
      display: none;
    }
  }

  @media (max-width: 768px) {
    .app-header .navbar {
      padding: 0 16px;
    }
    
    .notification-btn {
      display: none;
    }
  }
</style>

<!--  Header Start -->
<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <!-- Toggle Sidebar (Mobile) -->
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
    </ul>

    <!-- Search Bar -->
    <div class="header-search d-none d-md-block">
      <i class="ti ti-search header-search-icon"></i>
      <input type="text" id="globalSearch" placeholder="Buscar módulos..." autocomplete="off" />
      <div id="searchResults" class="search-results"></div>
    </div>

    <!-- Right Section -->
    <div class="navbar-collapse justify-content-end px-0">
      <ul class="navbar-nav flex-row ms-auto align-items-center">
        <!-- User Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="javascript:void(0)" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img id="logoEmpresa" src="../configuracion/empresa/logo_683f42f234013.jpeg" alt="Usuario" class="user-avatar">
          </a>
          
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="userDropdown">
            <!-- Header del dropdown -->
            <div class="dropdown-header-section">
              <div class="dropdown-user-info">
                <img id="logoEmpresaDropdown" src="../configuracion/empresa/logo_683f42f234013.jpeg" alt="Usuario" class="dropdown-avatar">
                <div class="dropdown-user-details">
                  <h6 id="nombreUsuario">Cargando...</h6>
                </div>
              </div>
            </div>

            <!-- Futuras Mejoras -->
            <!-- <div class="dropdown-body">
              <a href="../perfil.php" class="dropdown-item">
                <i class="ti ti-user"></i>
                <span>Mi Perfil</span>
              </a>
              <a href="../configuraciones.php" class="dropdown-item">
                <i class="ti ti-settings"></i>
                <span>Configuración</span>
              </a>
              <a href="javascript:void(0)" class="dropdown-item">
                <i class="ti ti-help"></i>
                <span>Ayuda</span>
              </a>
            </div>

            <div class="dropdown-divider"></div> -->

            <!-- Footer del dropdown -->
            <div class="dropdown-footer">
              <a href="../login.php" class="btn-logout">
                <i class="ti ti-logout"></i>
                <span>Cerrar Sesión</span>
              </a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!--  Header End -->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    fetch("../planificacion/logo.php")
      .then(response => response.json())
      .then(data => {
        const logoPath = data.logo_path || "../configuracion/empresa/default_logo.jpg";
        document.getElementById("logoEmpresa").src = logoPath;
        document.getElementById("logoEmpresaDropdown").src = logoPath;
      })
      .catch(error => {
        console.error("Error al cargar el logo:", error);
        const defaultLogo = "../configuracion/empresa/default_logo.jpg";
        document.getElementById("logoEmpresa").src = defaultLogo;
        document.getElementById("logoEmpresaDropdown").src = defaultLogo;
      });

    fetch("../conexion/sessionusuario.php")
      .then(response => response.json())
      .then(data => {
        const nombre = data.nombre || "Usuario";
        document.getElementById("nombreUsuario").textContent = nombre;
      })
      .catch(error => {
        console.error("Error al cargar el nombre de usuario:", error);
        document.getElementById("nombreUsuario").textContent = "Usuario";
      });

    // Toggle sidebar en móvil
    const sidebarToggle = document.getElementById('headerCollapse');
    if (sidebarToggle) {
      sidebarToggle.addEventListener('click', function() {
        document.querySelector('.left-sidebar').classList.toggle('show');
      });
    }

    //Busqueda global de módulos
    const searchModules = {
      'Inicio': [
        { name: 'Dashboard', path: '../index.php', icon: 'ti-layout-dashboard', color: 'bg-gradient-primary', keywords: ['inicio', 'dashboard', 'panel', 'principal'] }
      ],
      'Gestión de Clientes': [
        { name: 'Clientes', path: '../clientes.php', icon: 'ti-users', color: 'bg-gradient-info', keywords: ['clientes', 'cliente', 'personas'], roles: [1] },
        { name: 'Servicios', path: '../servicio.php', icon: 'ti-briefcase', color: 'bg-gradient-info', keywords: ['servicios', 'servicio'], roles: [1] },
        { name: 'Zonas', path: '../zonas.php', icon: 'ti-map-pin', color: 'bg-gradient-info', keywords: ['zonas', 'zona', 'ubicaciones'], roles: [1] },
        { name: 'Tarifas', path: '../tarifa.php', icon: 'ti-currency-dollar', color: 'bg-gradient-info', keywords: ['tarifas', 'tarifa', 'precios'], roles: [1] },
        { name: 'Facturación', path: '../contratos.php', icon: 'ti-file-invoice', color: 'bg-gradient-info', keywords: ['facturación', 'contratos', 'facturas'], roles: [1] }
      ],
      'Solicitudes y Cargas': [
        { name: 'Solicitudes', path: '../solicitudes.php', icon: 'ti-clipboard-text', color: 'bg-gradient-warning', keywords: ['solicitudes', 'solicitud', 'pedidos'], roles: [1, 2] },
        { name: 'Vehículos', path: '../vehiculos.php', icon: 'ti-truck', color: 'bg-gradient-warning', keywords: ['vehículos', 'vehiculo', 'camiones'], roles: [1, 2] },
        { name: 'Cotización', path: '../cotizacion.php', icon: 'ti-calculator', color: 'bg-gradient-warning', keywords: ['cotización', 'cotizacion', 'presupuesto'], roles: [1, 2] },
        { name: 'Asignación', path: '../asignacion.php', icon: 'ti-user-check', color: 'bg-gradient-warning', keywords: ['asignación', 'asignacion', 'asignar'], roles: [1, 2] },
        { name: 'Seguimiento', path: '../seguimiento.php', icon: 'ti-eye', color: 'bg-gradient-warning', keywords: ['seguimiento', 'tracking', 'rastreo'], roles: [1, 2] }
      ],
      'Planificación': [
        { name: 'Rutas', path: '../rutas.php', icon: 'ti-route', color: 'bg-gradient-success', keywords: ['rutas', 'ruta', 'caminos'], roles: [1] },
        { name: 'Conductores', path: '../conductores.php', icon: 'ti-steering-wheel', color: 'bg-gradient-success', keywords: ['conductores', 'conductor', 'choferes'], roles: [1] },
        { name: 'Planificación', path: '../planificacion.php', icon: 'ti-calendar', color: 'bg-gradient-success', keywords: ['planificación', 'planificacion', 'programación'], roles: [1] }
      ],
      'Monitoreo': [
        { name: 'Eventos Rutas', path: '../eventos.php', icon: 'ti-activity', color: 'bg-gradient-danger', keywords: ['eventos', 'evento', 'monitoreo', 'tiempo real'], roles: [1, 2] }
      ],
      'Finanzas': [
        { name: 'Transferencias', path: '../transferencia.php', icon: 'ti-arrows-exchange', color: 'bg-gradient-warning', keywords: ['transferencias', 'transferencia', 'pagos'], roles: [1] },
        { name: 'Cuentas Clientes', path: '../cuentas.php', icon: 'ti-wallet', color: 'bg-gradient-warning', keywords: ['cuentas', 'cuenta', 'clientes'], roles: [1] },
        { name: 'Proveedores', path: '../proveedores.php', icon: 'ti-building-store', color: 'bg-gradient-warning', keywords: ['proveedores', 'proveedor'], roles: [1] },
        { name: 'Cuentas Proveedores', path: '../pagar.php', icon: 'ti-credit-card', color: 'bg-gradient-warning', keywords: ['pagar', 'cuentas proveedores', 'deudas'], roles: [1] }
      ],
      'Personal': [
        { name: 'Cursos', path: '../cursos.php', icon: 'ti-certificate', color: 'bg-gradient-secondary', keywords: ['cursos', 'curso', 'capacitación'], roles: [1] },
        { name: 'Registro', path: '../registro.php', icon: 'ti-user-plus', color: 'bg-gradient-secondary', keywords: ['registro', 'registrar', 'alta'], roles: [1] },
        { name: 'Asistencias', path: '../asistencia.php', icon: 'ti-user-check', color: 'bg-gradient-secondary', keywords: ['asistencias', 'asistencia', 'presencia'], roles: [1, 3] },
        { name: 'Sanciones', path: '../sanciones.php', icon: 'ti-alert-triangle', color: 'bg-gradient-secondary', keywords: ['sanciones', 'sancion', 'multas'], roles: [1] }
      ],
      'Inventario': [
        { name: 'Almacén', path: '../almacen.php', icon: 'ti-building-warehouse', color: 'bg-gradient-primary', keywords: ['almacén', 'almacen', 'bodega'], roles: [1, 4] },
        { name: 'Categorías', path: '../categoria.php', icon: 'ti-category', color: 'bg-gradient-primary', keywords: ['categorías', 'categoria', 'tipos'], roles: [1, 4] },
        { name: 'Subcategorías', path: '../subcategoria.php', icon: 'ti-list', color: 'bg-gradient-primary', keywords: ['subcategorías', 'subcategoria'], roles: [1, 4] },
        { name: 'Productos', path: '../productos.php', icon: 'ti-package', color: 'bg-gradient-primary', keywords: ['productos', 'producto', 'items'], roles: [1, 4] },
        { name: 'Movimientos', path: '../movimientos.php', icon: 'ti-arrows-move', color: 'bg-gradient-primary', keywords: ['movimientos', 'movimiento', 'traslados'], roles: [1, 4] }
      ],
      'Sistema': [
        { name: 'Usuarios', path: '../usuarios.php', icon: 'ti-user-circle', color: 'bg-gradient-info', keywords: ['usuarios', 'usuario', 'cuentas'], roles: [1] },
        { name: 'Configuraciones', path: '../configuraciones.php', icon: 'ti-settings', color: 'bg-gradient-info', keywords: ['configuraciones', 'configuracion', 'ajustes', 'settings'], roles: [1] },
        { name: 'Condiciones', path: '../condiciones.php', icon: 'ti-file-text', color: 'bg-gradient-info', keywords: ['condiciones', 'términos', 'terminos'], roles: [1] }
      ]
    };

    const searchInput = document.getElementById('globalSearch');
    const searchResults = document.getElementById('searchResults');
    let userRole = null;

    // Obtener rol del usuario
    fetch("../conexion/sessionusuario.php")
      .then(response => response.json())
      .then(data => {
        userRole = parseInt(data.id_rol) || 1;
      })
      .catch(error => {
        console.error("Error al obtener rol:", error);
        userRole = 1;
      });

    // Función de búsqueda
    searchInput.addEventListener('input', function() {
      const query = this.value.toLowerCase().trim();
      
      if (query.length === 0) {
        searchResults.classList.remove('show');
        searchResults.innerHTML = '';
        return;
      }

      const results = {};
      let hasResults = false;

      // Filtrar módulos según búsqueda y rol
      Object.keys(searchModules).forEach(category => {
        const filtered = searchModules[category].filter(module => {
          // Verificar permisos de rol
          if (module.roles && !module.roles.includes(userRole)) {
            return false;
          }
          
          // Buscar en nombre y keywords
          const searchText = (module.name + ' ' + module.keywords.join(' ')).toLowerCase();
          return searchText.includes(query);
        });

        if (filtered.length > 0) {
          results[category] = filtered;
          hasResults = true;
        }
      });

      // Mostrar resultados
      if (hasResults) {
        let html = '';
        Object.keys(results).forEach(category => {
          html += `<div class="search-category">${category}</div>`;
          results[category].forEach(module => {
            html += `
              <a href="${module.path}" class="search-item">
                <div class="search-item-icon ${module.color}">
                  <i class="ti ${module.icon}"></i>
                </div>
                <div class="search-item-text">
                  <div class="search-item-title">${module.name}</div>
                  <div class="search-item-path">${category}</div>
                </div>
              </a>
            `;
          });
        });
        searchResults.innerHTML = html;
        searchResults.classList.add('show');
      } else {
        searchResults.innerHTML = `
          <div class="search-empty">
            <i class="ti ti-search-off"></i>
            <p>No se encontraron resultados para "${query}"</p>
          </div>
        `;
        searchResults.classList.add('show');
      }
    });

    // Cerrar resultados al hacer clic fuera
    document.addEventListener('click', function(e) {
      if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
        searchResults.classList.remove('show');
      }
    });

    // Limpiar al hacer clic en resultado
    searchResults.addEventListener('click', function() {
      searchInput.value = '';
      searchResults.classList.remove('show');
    });
  });
</script>