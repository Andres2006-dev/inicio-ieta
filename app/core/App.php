<?php
class App {
    protected $controlador = 'homeController';
    protected $metodo = 'index';
    protected $parametros = [];
    
    public function __construct() {
        $url = $this->parseUrl();
        if (file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
            $this->controlador = $url[0] . 'Controller';
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controlador . '.php';
        $this->controlador = new $this->controlador;

        if (isset($url[1]) && method_exists($this->controlador, $url[1])) {
            $this->metodo = $url[1];
            unset($url[1]);
        }

        $this->parametros = $url ? array_values($url) : [];
        call_user_func_array([$this->controlador, $this->metodo], $this->parametros);
    }
    # http://localhost/mvc-app/public/index.php?url=usuario/registrar
    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ['Home'];
    }
}
