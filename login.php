<?php
require_once 'conexion/conexion.php';
$logo_path = 'https://via.placeholder.com/100';
try {
    $query = "SELECT logo FROM configuracion_empresa LIMIT 1";
    $stmt = $conn->query($query);
    
    if ($stmt && $stmt->rowCount() > 0) {
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!empty($empresa['logo'])) {
            $logo_path = '../configuracion/empresa/' . $empresa['logo'];
        }
    }
} catch(PDOException $e) {
    error_log("Error al obtener configuración: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Transportes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6e8efb;
            --secondary: #a777e3;
            --error: #ff4757;
            --success: #2ed573;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        /* Burbujas de fondo */
        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            top: 0;
            left: 0;
        }
        
        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s linear infinite;
            opacity: 0.6;
        }
        
        .bubble:nth-child(1) { width: 40px; height: 40px; left: 10%; animation-duration: 8s; }
        .bubble:nth-child(2) { width: 20px; height: 20px; left: 20%; animation-duration: 5s; animation-delay: 1s; }
        .bubble:nth-child(3) { width: 50px; height: 50px; left: 35%; animation-duration: 7s; animation-delay: 2s; }
        .bubble:nth-child(4) { width: 80px; height: 80px; left: 50%; animation-duration: 11s; animation-delay: 0s; }
        .bubble:nth-child(5) { width: 35px; height: 35px; left: 55%; animation-duration: 6s; animation-delay: 1s; }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-100vh) rotate(360deg); }
        }
        
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 400px;
            padding: 40px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logo-container {
            margin: 0 auto 25px;
            width: 120px;
            height: 120px;
            animation: bounceIn 0.6s;
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
        }
        
        .logo:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
        }
        
        h1::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 3px;
        }
        
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(110, 142, 251, 0.2);
            outline: none;
        }
        
        button {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        /* Estilos para errores */
        .error-message {
            color: var(--error);
            margin-top: 15px;
            font-size: 14px;
            padding: 10px;
            background: rgba(255, 71, 87, 0.1);
            border-radius: 5px;
            border-left: 3px solid var(--error);
            animation: shake 0.4s ease;
        }
        
        .input-error {
            border-color: var(--error) !important;
            animation: inputError 0.4s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        @keyframes inputError {
            0%, 100% { border-color: var(--error); }
            50% { border-color: #ff8e9e; }
        }
        
        .footer-text {
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }
        
        #contactLink {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        #contactLink:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>
    
    <div class="login-container">
        <div class="logo-container">
            <img src="<?php echo htmlspecialchars($logo_path); ?>" alt="Logo de la empresa" class="logo">
        </div>
        <h1>Iniciar Sesión</h1>
        
        <form id="loginForm" action="conexion/session.php" method="POST">
            <div class="input-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            
            <div class="input-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            
            <button type="submit">Ingresar</button>  
            <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
                <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
                <script>
                    // Añade clase de error a los inputs
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('correo').classList.add('input-error');
                        document.getElementById('contrasena').classList.add('input-error');
                        
                        // Remueve la clase después de 2 segundos
                        setTimeout(function() {
                            document.getElementById('correo').classList.remove('input-error');
                            document.getElementById('contrasena').classList.remove('input-error');
                        }, 2000);
                    });
                </script>
            <?php endif; ?>
        </form>
        
        <p class="footer-text">¿No tienes una cuenta? <a href="#" id="contactLink">Contacta al administrador</a></p>
    </div>

    <script>
        // Efecto simple para el logo
        const logo = document.querySelector('.logo');
        logo.addEventListener('mouseenter', () => {
            logo.style.transform = 'scale(1.05)';
        });
        logo.addEventListener('mouseleave', () => {
            logo.style.transform = 'scale(1)';
        });
        
        // Efecto para el botón
        const btn = document.querySelector('button');
        btn.addEventListener('mouseenter', () => {
            btn.style.transform = 'translateY(-2px)';
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translateY(0)';
        });
        
        // Contactar al administrador
        document.getElementById('contactLink').addEventListener('click', function(e) {
            e.preventDefault();
            alert("Por favor contacta al administrador del sistema para crear una cuenta.");
        });
    </script>
</body>
</html>