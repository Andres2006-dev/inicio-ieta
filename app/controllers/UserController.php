<?php

class UserController extends Controller
{

    private $model;
    function __construct()
    {
        $this->model = $this->model('User');
    }

    public function index()
    {
        $this->view("home/index", [], false);
    }

    
}
