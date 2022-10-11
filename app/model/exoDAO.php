<?php
namespace App\model;
use App\model\Conexao;
use Exception;

class ExoDAO{
    private $tabela = "exo";
    public function consultar(){
        $sql = "SELECT * FROM {$this->tabela}";

        $preparacao = Conexao::getConexao()->prepare($sql);
        $preparacao->execute();

        if($preparacao->rowCount()>0){
            return $preparacao->fetchALL(\PDO::FETCH_ASSOC);
        }
        else{
            throw new \Exception("Nenhum dado encontrado");
        }
    }
    public function inserir($dados){
        
        $sql = "INSERT INTO {$this->tabela} VALUES(NULL, :titulo, :situacao, :data_inicio, :area)";

        $preparacao = Conexao::getConexao()->prepare($sql);

        $preparacao->bindValue(":titulo", $dados["titulo"]);
        $preparacao->bindValue(":situacao", $dados["status"]);
        $preparacao->bindValue(":data_inicio", $dados["data_inicio"]);
        $preparacao->bindValue(":area", $dados["area"]);

        $preparacao->execute();
        //$preparacao->debugDumpParams();

        if($preparacao->rowCount()>0){
            return "Dados inseridos com sucesso";
        }
        else{
            throw new \Exception("Erro ao cadastrar dados");
        }
        
    }
    public function atualizar($id, $dados){
        $sql = "UPDATE {$this->tabela} SET titulo = :titulo, 'status' = :situacao, data_inicio = :data_inicio, area = :area WHERE cod_projeto = :id";
    }
}