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



if(!empty($data->id)) {

	$usuario->id = $data->id;

	if($usuario->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "O usuario foi deletado."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Não foi possível deletar o usuario."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "UNão foi possível deletar o usuario. Dados incompletos."));
}
