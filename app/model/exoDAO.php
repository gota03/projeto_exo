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
    public function consultarUnico($id){
        $comando = "SELECT * FROM {$this->tabela} WHERE cod_projeto = :id";

        $preparacao = Conexao::getConexao()->prepare($comando);
        $preparacao->bindValue(":id",$id);
        $preparacao->execute();

        if($preparacao->rowCount() > 0){
            return $preparacao->fetchALL(\PDO::FETCH_ASSOC);
        }
        else{
            throw new \Exception("Nenhum dado encontrado");// Estamos lançando um erro para ser tratado pelo catch
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
        $sql = "UPDATE {$this->tabela} SET titulo = :titulo, situacao = :situacao, data_inicio = :data_inicio, area = :area WHERE cod_projeto = :id";

        $preparacao = Conexao::getConexao()->prepare($sql);

        list($titulo, $situacao, $data_inicio, $area) = array_values($dados);

        

        $preparacao->bindValue(":titulo", $titulo);
        $preparacao->bindValue(":situacao", $situacao);
        $preparacao->bindValue(":data_inicio", $data_inicio);
        $preparacao->bindValue(":area", $area);
        $preparacao->bindValue(":id", $id);

        $preparacao->execute();
        
        if($preparacao->rowCount()> 0){
            return "Dados atualizados com sucesso";
        }
        else{
            throw new \Exception("Erro ao atualizar dados");
        }
    }
    public function deletar($id){
        $sql = "DELETE FROM {$this->tabela} WHERE cod_projeto = :id";

        $preparacao = Conexao::getConexao()->prepare($sql);
        $preparacao->bindValue(":id", $id);
        $preparacao->execute();
        //$preparacao->debugDumpParams();
        if($preparacao->rowCount()>0){
            return "Dados excluidos com sucesso";
        }
        else{
            throw new \Exception("Erro ao tentar excluir os dados");
        }
    }
}