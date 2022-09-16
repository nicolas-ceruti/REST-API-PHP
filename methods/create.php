<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Usuario.php';
 
$database = new Database();
$db = $database->getConnection();
 
$usuario = new Usuario($db);
 
$data = json_decode(file_get_contents("php://input"));
 
if(!empty($data->nome) && !empty($data->sobrenome) && !empty($data->email) 
&& !empty($data->telefone) && !empty($data->idade) && !empty($data->senha)){    

    $usuario->nome = $data->nome;
    $usuario->sobrenome = $data->sobrenome;
    $usuario->email = $data->email;
    $usuario->telefone = $data->telefone;
    $usuario->idade = $data->idade;
    $usuario->senha = $data->senha;		
    
    if($usuario->create()){         
        http_response_code(201);         
        echo json_encode(array("mensagem" => " Usuario Criado."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("mensagem" => "Não foi possível criar o Usuario."));

        echo json_encode(array("erro" => $data));
        
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Nao foi possível criar o Usuario. Dados imcompletos."));
}