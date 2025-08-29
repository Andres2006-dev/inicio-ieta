<?php
class AuthController extends Controller
{

    private $model;
    function __construct()
    {
        $this->model = $this->model('User');
    }

    //poder ver el login del usuario
    public function index()
    {
        $this->view("auth/index", [], false);
    }

    //funcion para el login
    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $numDoc = trim($_POST['numDoc'] ?? '');
                $password = trim($_POST['password'] ?? '');
                if (empty($numDoc) || empty($password)) {
                    echo json_encode(["status" => "error", "mensaje" => "Todos los datos son requeridos"]);
                    return;
                }
                if (!is_numeric($numDoc)) {
                    echo json_encode(["status" => "error", "mensaje" => "El numero de documento debe de ser un numero"]);
                    return;
                }
                $sql = "SELECT * FROM users WHERE numero_documento = ? AND estado = 1";
                $usuario = $this->model->list_one($sql, [$numDoc]);

                if ($usuario && password_verify($password, $usuario['password'])) {
                    $_SESSION['user'] = [
                        "id" => $usuario["id"],
                        "nombre" => $usuario["pri_nombre"],
                        "apellido" => $usuario["pri_apellido"],
                        "rol" => $usuario['rol'],
                        "tipo_usuario" => $usuario['tipo_usuario']
                    ];
                    if ($usuario['rol'] == 1) {
                        echo json_encode(["status" => "success", "redirect" => "admin/dashboard"]);
                    }elseif($usuario['rol'] == 2){
                        echo json_encode(["status" => "success", "redirect" => "users/index"]);
                    }else{
                        echo json_encode(["status" => "error", "mensaje" => "Rol no existente"]);
                    }
                } else {
                    echo json_encode(["status" => "error", "mensaje" => "Las credenciales son incorrectas"]);
                }
            } else {
                $this->view("auth/index", [], false);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "mensaje" => $e->getMessage()]);
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        $this->view('auth/index', [], false);
    }
}
