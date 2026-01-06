<?php
session_start();
require_once 'conexion/conexion.php';
// variables para configuración de empresa
$logo_path = '';
$favicon_path = '';
$nombre_empresa = '';
$ruc_empresa = '';
$direccion_empresa = '';
$telefono_empresa = '';
$correo_empresa = '';
$firma_empresa = '';

// Obtener configuración de la empresa
try {
    $query = "SELECT nombre_empresa, ruc, direccion, telefono, correo, firmas, logo 
              FROM configuracion_empresa 
              LIMIT 1";
    $stmt = $conn->query($query);
    
    if ($stmt && $stmt->rowCount() > 0) {
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $nombre_empresa = $empresa['nombre_empresa'] ?? '';
        $ruc_empresa = $empresa['ruc'] ?? '';
        $direccion_empresa = $empresa['direccion'] ?? '';
        $telefono_empresa = $empresa['telefono'] ?? '';
        $correo_empresa = $empresa['correo'] ?? '';
        $firma_empresa = $empresa['firmas'] ?? '';
        $logo_path = !empty($empresa['logo']) ? 'configuracion/empresa/' . $empresa['logo'] : '';
    }
} catch(PDOException $e) {
    error_log("Error al obtener configuración de empresa: " . $e->getMessage());
}

// variables para configuración de login
$brand_primary = '';
$brand_dark = '';
$slogan = '';
$tip = '';

// Obtener configuración de la página de login
try {
    $query_login = "SELECT brand_primary, brand_dark, slogan, tip, first_title, second_title 
                    FROM configuracion_login 
                    LIMIT 1";
    $stmt_login = $conn->query($query_login);
    
    if ($stmt_login && $stmt_login->rowCount() > 0) {
        $config_login = $stmt_login->fetch(PDO::FETCH_ASSOC);
        
        $brand_primary = $config_login['brand_primary'] ?? '';
        $brand_dark = $config_login['brand_dark'] ?? '';
        $slogan = $config_login['slogan'] ?? '';
        $tip = $config_login['tip'] ?? '';
        $first_title = $config_login['first_title'] ?? '';
        $second_title = $config_login['second_title'] ?? '';
    }
} catch(PDOException $e) {
    error_log("Error al obtener configuración de login: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | <?php echo htmlspecialchars($nombre_empresa); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="<?php echo htmlspecialchars($logo_path); ?>">
    <style>
        :root {
            --brand-primary: <?php echo !empty($brand_primary) ? htmlspecialchars($brand_primary) : '#2ECC71'; ?>;
            --brand-dark: <?php echo !empty($brand_dark) ? htmlspecialchars($brand_dark) : '#27AE60'; ?>;
            --brand-accent: <?php echo !empty($brand_primary) ? htmlspecialchars($brand_primary) : '#27AE60'; ?>    ;
            
            --bg-cream: #E8EEF5;
            --bg-white: #FFFFFF;
            --bg-light: #F8F9FA;
            
            --text-primary: #2C3E50;
            --text-secondary: #7F8C8D;
            --text-tertiary: #A0ADB9;
            
            --border-color: #E8ECEF;
            
            --error-color: #E74C3C;
            --error-bg: #FADBD8;
            
            --success-color: #2ECC71;
            --info-bg: #E8F8F0;
            --info-border: #C1EED7;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', -apple-system, sans-serif;
            background: var(--bg-cream);
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* ═══════════════════════════════════════════
           CONTENEDOR PRINCIPAL
           ═══════════════════════════════════════════ */
        .main-wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        /* ═══════════════════════════════════════════
           PANEL IZQUIERDO - ILUSTRACIÓN
           ═══════════════════════════════════════════ */
        .illustration-panel {
            flex: 1;
            background: linear-gradient(135deg, #E8EEF5 0%, #D8E4F2 100%);
            display: flex;
            flex-direction: column;
            padding: 32px 40px;
            position: relative;
            overflow: hidden;
        }

        /* Logo en esquina */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .brand-logo-image {
            width: 42px;
            height: 42px;
            background: white;
            border-radius: 10px;
            padding: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .brand-logo-image img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

        .brand-logo span {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        /* Contenido central */
        .illustration-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .main-illustration {
            width: 100%;
            max-width: 380px;
            margin-bottom: 32px;
        }

        .main-illustration img {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.1));
        }

        .main-title {
            font-size: 42px;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .main-title span {
            color: var(--brand-primary);
            display: block;
        }

        .feature-list {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 15px;
            color: var(--text-secondary);
            margin-top: 16px;
        }

        .feature-list::before {
            content: '✓';
            width: 24px;
            height: 24px;
            background: var(--brand-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .feature-description {
            font-size: 15px;
            color: var(--brand-dark);
            font-weight: 600;
        }

        .feature-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
            margin-top: 12px;
            max-width: 480px;
        }

        /* ═══════════════════════════════════════════
           PANEL DERECHO - FORMULARIO
           ═══════════════════════════════════════════ */
        .form-panel {
            flex: 0 0 520px;
            background: var(--bg-white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 32px 40px;
            position: relative;
            z-index: 2;
        }

        .form-container {
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
        }

        .form-header {
            margin-bottom: 28px;
        }

        .form-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .form-header p {
            font-size: 15px;
            color: var(--text-secondary);
        }

        /* Info box */
        .info-box {
            padding: 16px 18px;
            background: var(--info-bg);
            border: 2px solid var(--info-border);
            border-radius: 12px;
            margin-bottom: 28px;
        }

        .info-box-content {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-box-icon {
            width: 20px;
            height: 20px;
            background: var(--brand-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .info-box-text {
            font-size: 13px;
            color: var(--brand-dark);
            line-height: 1.6;
            font-weight: 500;
        }

        /* ═══════════════════════════════════════════
           FORMULARIO
           ═══════════════════════════════════════════ */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--text-tertiary);
            pointer-events: none;
            z-index: 1;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            font-size: 15px;
            font-family: inherit;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: var(--bg-light);
            color: var(--text-primary);
            transition: all 0.2s ease;
        }

        .form-group input::placeholder {
            color: var(--text-tertiary);
        }

        .form-group input:hover {
            background: var(--bg-white);
            border-color: #D1D9E0;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--brand-primary);
            background: var(--bg-white);
            box-shadow: 0 0 0 4px rgba(46, 204, 113, 0.1);
        }

        .form-group input:focus + .input-icon {
            color: var(--brand-primary);
        }

        .form-group input.input-error {
            border-color: var(--error-color);
            background: var(--error-bg);
        }

        /* Toggle password visibility */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 18px;
            color: var(--text-tertiary);
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
            z-index: 1;
        }

        .toggle-password:hover {
            color: var(--text-secondary);
        }

        .forgot-link {
            display: block;
            text-align: right;
            margin-top: -12px;
            margin-bottom: 24px;
            font-size: 13px;
            color: var(--brand-primary);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 15px 24px;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            color: white;
            background: var(--brand-primary);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.2);
        }

        .btn-submit:hover {
            background: var(--brand-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46, 204, 113, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .help-text {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .help-text a {
            color: var(--brand-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .help-text a:hover {
            text-decoration: underline;
        }

        .footer-text {
            margin-top: 28px;
            text-align: center;
            font-size: 13px;
            color: var(--text-tertiary);
        }

        /* ═══════════════════════════════════════════
           SWEETALERT CUSTOM STYLES
           ═══════════════════════════════════════════ */
        .swal2-popup {
            border-radius: 16px !important;
            padding: 24px !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .swal2-title {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: var(--text-primary) !important;
        }

        .swal2-html-container {
            font-size: 14px !important;
            color: var(--text-secondary) !important;
        }

        .swal2-confirm {
            background: var(--brand-primary) !important;
            border-radius: 10px !important;
            padding: 10px 24px !important;
            font-weight: 600 !important;
            font-size: 14px !important;
        }

        .swal2-confirm:hover {
            background: var(--brand-dark) !important;
        }

        /* ═══════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════ */
        @media (max-width: 1100px) {
            .illustration-panel {
                padding: 28px 32px;
            }

            .main-illustration {
                max-width: 320px;
            }

            .main-title {
                font-size: 36px;
            }

            .form-panel {
                flex: 0 0 480px;
                padding: 28px 32px;
            }
        }

        @media (max-width: 900px) {
            body {
                overflow-y: auto;
            }

            .main-wrapper {
                flex-direction: column;
                height: auto;
            }

            .illustration-panel {
                padding: 32px 24px;
                min-height: auto;
            }

            .main-illustration {
                max-width: 280px;
                margin-bottom: 24px;
            }

            .main-title {
                font-size: 32px;
            }

            .feature-list {
                font-size: 14px;
            }

            .form-panel {
                flex: none;
                padding: 32px 24px;
            }
        }

        @media (max-width: 640px) {
            .brand-logo {
                margin-bottom: 24px;
            }

            .illustration-panel {
                padding: 24px 20px;
            }

            .main-illustration {
                max-width: 240px;
            }

            .main-title {
                font-size: 28px;
            }

            .form-panel {
                padding: 28px 20px;
            }

            .form-header h1 {
                font-size: 28px;
            }

            .info-box {
                padding: 14px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- Panel de Ilustración -->
        <div class="illustration-panel">
            <div class="brand-logo">
                <div class="brand-logo-image">
                    <img src="<?php echo htmlspecialchars($logo_path); ?>" alt="Logo">
                </div>
                <span><?php echo htmlspecialchars($nombre_empresa); ?></span>
            </div>

            <div class="illustration-content">
                <div class="main-illustration">
                    <img src="assets/img/transporte.png" alt="Sistema de Transporte">
                </div>

                <h2 class="main-title">
                   <p><?php echo htmlspecialchars($first_title); ?></p>
                    <span><?php echo htmlspecialchars($second_title); ?></span>
                </h2>

                <div class="feature-list">
                    <span class="feature-description">Control logístico eficiente</span>
                </div>

                <p class="feature-subtitle">
                  <?php echo htmlspecialchars($slogan); ?>
                </p>
            </div>
        </div>

        <!-- Panel de Formulario -->
        <div class="form-panel">
            <div class="form-container">
                <div class="form-header">
                    <h1>Iniciar Sesión</h1>
                    <p>Bienvenido, ingresa tus credenciales.</p>
                </div>

                <div class="info-box">
                    <div class="info-box-content">
                        <div class="info-box-icon"><i class="fas fa-info-circle"></i></div>
                        <p class="info-box-text">
                            <?php echo htmlspecialchars($tip); ?>
                        </p>
                    </div>
                </div>

                <form id="loginForm" action="conexion/session.php" method="POST">
                    <div class="form-group">
                        <label for="correo">Correo Electrónico</label>
                        <div class="input-wrapper">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input 
                                type="email" 
                                id="correo" 
                                name="correo" 
                                placeholder="tucorreo@ejemplo.com"
                                required 
                                autocomplete="email"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <div class="input-wrapper">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input 
                                type="password" 
                                id="contrasena" 
                                name="contrasena" 
                                placeholder="Ingresa tu contraseña"
                                required 
                                autocomplete="current-password"
                            >
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>

                    <button type="submit" class="btn-submit">Iniciar Sesión</button>
                </form>

                <div class="help-text">
                    ¿Necesitas ayuda? <a href="#" id="contactLink">Contacta soporte</a>
                </div>

                <div class="footer-text">
                    © <?php echo date('Y'); ?> Gestión de Almacén
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mostrar SweetAlert si hay error (desde esquina superior derecha)
        <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error de acceso',
                text: '<?php echo htmlspecialchars($_GET['error']); ?>',
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            // Marcar inputs con error
            document.getElementById('correo').classList.add('input-error');
            document.getElementById('contrasena').classList.add('input-error');
            
            setTimeout(() => {
                document.getElementById('correo').classList.remove('input-error');
                document.getElementById('contrasena').classList.remove('input-error');
            }, 4000);
        <?php endif; ?>

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('contrasena');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.querySelector('i').className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });

        // Contacto con SweetAlert
        document.getElementById('contactLink').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Contacto de Soporte',
                text: 'Por favor contacta al 902218391.',
                confirmButtonText: 'Entendido',
                position: 'center'
            });
        });

        // Focus automático
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('correo').focus();
        });

        // Animación al submit con SweetAlert
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-submit');
            btn.textContent = 'Iniciando sesión...';
            btn.style.opacity = '0.7';
            btn.disabled = true;
        });
    </script>
</body>
</html>