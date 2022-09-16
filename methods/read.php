<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Usuario.php';

$database = new Database();
$db = $database->getConnection();
 
$usuarios = new Usuario($db);

$usuarios->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$resultado = $usuarios->read();

if($resultado->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Usuarios"]=array(); 
	while ($item = $resultado->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "nome" => $nome,
            "sobrenome" => $sobrenome,
			"email" => $email,
            "telefone" => $telefone,	
            "idade" => $idade,
            "senha" => $senha		
        ); 
       array_push($itemRecords["Usuarios"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("mensagem" => "Usuário(os) não encontrados.")
    );
} 