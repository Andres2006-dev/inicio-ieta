<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Biblioteca</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <header>
        <div class="container">
            <h1>Panel de Administración</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Inicio</a></li>
                    <li><a href="libros.php">Gestión de Libros</a></li>
                    <li><a href="#">Gestión de Usuarios</a></li>
                    <li><a href="prestamos.php">Gestión de Préstamos</a></li>
                    <li><a href="<?= BASE_URL ?>/auth/logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>