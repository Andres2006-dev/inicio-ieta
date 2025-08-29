<?php

class HomeController extends Controller
{

    public function index()
    {
        $this->verificarSession();
        if ($_SESSION['user']['rol'] == 1) {
            $this->view('home/admin/dashboard');
        } elseif ($_SESSION['user']['rol'] == 2) {
            $this->view('home/users/index');
        } else {
            header("Location: " . BASE_URL . "/auth/index");
            exit;
        }
    }
}
