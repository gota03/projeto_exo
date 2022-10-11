<?php
namespace App\controller;

use App\model\ExoDAO;

class ExoController{
    public function get($id = null){
        $exo = new ExoDAO();
        if($id){
            return $exo->consultarUnico($id);
        }
        else{
            return $exo->consultar();
        }
        
    }
    public function post(){
        $exo = new ExoDAO();
        return $exo->inserir($_POST);
        
    }
    public function put($id){
        $exo = new ExoDAO();
        $dados = json_decode(file_get_contents('php://input'), true);
        return $exo->atualizar($id, $dados);
    }
    public function delete($id){
        $exo = new ExoDAO();
        return $exo->deletar($id);
    }
}