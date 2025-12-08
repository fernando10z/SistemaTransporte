 <style>
  #nombreUsuario {
  font-family: 'Segoe UI', sans-serif;
  transition: color 0.3s ease;
}

#nombreUsuario:hover {
  color: #1c76b3;
}

.nav-icon-hover img:hover {
  transform: scale(1.05);
  transition: transform 0.2s ease;
}

 </style>
 <!--  Header Start -->
<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
   
    </ul>

    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
            <img id="logoEmpresa" src="../configuracion/empresa/logo_683f42f234013.jpeg" alt="Logo Empresa" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">
              <div class="d-flex align-items-center gap-2 px-3 mb-2">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3" id="nombreUsuario">Hola, Usuario</p>
              </div>
              <a href="../login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
  // Cargar el logo de la empresa
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

  // Cargar el nombre del usuario
  fetch("../conexion/sessionusuario.php")
    .then(response => response.json())
    .then(data => {
      const nombre = data.nombre || "Usuario";
      document.getElementById("nombreUsuario").textContent = `Hola, ${nombre}`;
    })
    .catch(error => {
      console.error("Error al cargar el nombre de usuario:", error);
      document.getElementById("nombreUsuario").textContent = "Hola, Usuario";
    });
});
</script>
