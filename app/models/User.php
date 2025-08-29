<?php 
class User{
    private $bd;
    function __construct()
    {
        $this->bd = new Database();
    }
    public function list_one($sql,$params){
        $r = $this->bd->query($sql,$params)->fetch();
        return $r;
    }
}