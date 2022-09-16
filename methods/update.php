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

if(!empty($data->id) && !empty($data->nome) && !empty($data->sobrenome) && !empty($data->email) 
&& !empty($data->telefone) && !empty($data->idade) && !empty($data->senha)){    

    $usuario->id = $data->id;
    $usuario->nome = $data->nome;
    $usuario->sobrenome = $data->sobrenome;
    $usuario->email = $data->email;
    $usuario->telefone = $data->telefone;
    $usuario->idade = $data->idade;
    $usuario->senha = $data->senha;	

	if($usuario->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "O usuario foi modificado."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Não foi possível modificar o usuario."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Não foi possível modificar o usuario. Dados incompletos."));
}
