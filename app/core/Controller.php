<?php
class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . ".php";
        return new $model();
    }

    public function view($view, $data = [], $layouts = true)
    {
        extract($data);

        if ($layouts) {
            $rol = $_SESSION['user']['rol'] ?? null;
            if ($rol == 1) { // validacion para la vista de un admin
                require_once '../app/views/layouts/admin/header.php';
                require_once '../app/views/' . $view . '.php';
                require_once '../app/views/layouts/admin/footer.php';
            } elseif ($rol == 2) { //validacion para la vista de un usuario normal(profesor, estudiante)
                require_once '../app/views/layouts/users/header.php';
                require_once '../app/views/' . $view . '.php';
                require_once '../app/views/layouts/users/footer.php';
            } else {
                // Si no tiene rol definido o es inválido, podrías redirigirlo
                header("Location: " . BASE_URL . "/auth/index");
                exit;
            }
        } else {
            require_once '../app/views/' . $view . '.php';
        }
    }

    public function verificarSession()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/auth/index");
            exit;
        }
    }
}
