<?php
namespace App\controller;

use App\model\ExoDAO;

class ExoController{
    public function get(){
        $exo = new ExoDAO();
        return $exo->consultar();
    }
    public function post(){
        $exo = new ExoDAO();
        var_dump($_POST);
        return $exo->inserir($_POST);
        
    }
    public function put(){

    }
    public function delete(){

    }
}