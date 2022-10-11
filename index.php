<?php
header("Content-type:application/json");
header("Content-Control-Allow-Origin");
use App\controller;
require_once("vendor/autoload.php");
$rota = !empty($_GET["url"]) ? $_GET["url"] : "Vazio";
//print_r($rota);

$rota = explode("/", $rota);
if($rota[0] === "api"){
    array_shift($rota);
    if(!file_exists("App\controller\\".ucfirst($rota[0]. "Controller.php"))){
        //echo "<hr>";
        //echo "indisponivel";
        
    }
    else{
        $servico = "App\controller\\".ucfirst($rota[0]."Controller");
        //echo $servico;
        array_shift($rota);
        $HTTP = strtolower($_SERVER["REQUEST_METHOD"]);
        //echo "<hr>";
        //echo $HTTP;
        try{
            $resposta = call_user_func_array(array(new $servico, $HTTP), $rota);
            echo json_encode(array('status'=>'sucesso', 'data'=>$resposta),JSON_UNESCAPED_UNICODE);
        }
        catch(\Exception $erro){
            http_response_code(404);
            echo json_encode((array('status'=>'erro', 'data'=>$erro->getMessage())));
        }
    }
}
else{
    echo "Digite o nome da api";
    

}