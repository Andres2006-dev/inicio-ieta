<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Biblioteca del Colegio</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="<?= BASE_URL ?>/auth/login" method="POST" id="formLogin" onsubmit="return false">
            <div class="form-group">
                <label for="numDoc">Numero de documento:</label>
                <input type="number" id="numDoc" name="numDoc" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" id="ingresar" onclick="registrar()">Ingresar</button>
        </form>
    </div>

    <script>
        async function registrar() {
            let btn = document.getElementById('ingresar');
            btn.disabled = true;
            btn.innerText = "Ingresando...";
            let form = document.getElementById('formLogin');
            let url = form.getAttribute('action');
            const formData = new FormData(form);

            let numDoc = document.getElementById("numDoc").value.trim();
            let password = document.getElementById("password").value.trim();

            if (numDoc === "" || password === "") {
                Swal.fire({
                    icon: "warning",
                    title: "Atención",
                    text: "Todos los campos son requeridos"
                });
                btn.disabled = false;
                btn.innerText = "Ingresar";
                return;
            }

            try {
                let request = await fetch(url, {
                    method: "POST",
                    body: formData
                });
                let response = await request.json();
                btn.disabled = false;
                btn.innerText = "Ingresar";
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "¡Bienvenido!",
                        text: "Iniciando sesión...",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "<?= BASE_URL ?>/" + response.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.mensaje
                    });

                }
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error de conexión",
                    text: "No se pudo conectar con el servidor"
                });
            } finally {
                btn.disabled = false;
                btn.innerText = "Ingresar";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>