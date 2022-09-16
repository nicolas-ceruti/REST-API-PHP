<?php
class Usuario{   
    
    private $table = "dm_usuarios";      
    public $id;
    public $nome;
    public $sobrenome;
    public $email;
    public $telefone; 
    public $idade;
    public $senha;  
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){

		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->table." WHERE id = ?");    //methods/read?id=2
			$stmt->bind_param("i", $this->id);	

		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->table);		  //methods/read
		}		
		$stmt->execute();			
		$resultado = $stmt->get_result();		
		return $resultado;	
	}

	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->table."(nome, sobrenome, email, telefone, idade, senha)
			VALUES(?,?,?,?,?,?)");
		$this->nome = htmlspecialchars(strip_tags($this->nome));
		$this->sobrenome = htmlspecialchars(strip_tags($this->sobrenome));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->idade = htmlspecialchars(strip_tags($this->idade));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
		$stmt->bind_param("ssssis", $this->nome, $this->sobrenome, $this->email, $this->telefone,  $this->idade,  $this->senha);   //bind_param  s=string i=integer
	
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}


    function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->table." 
			WHERE id = ?");
		$this->id = htmlspecialchars(strip_tags($this->id));
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}

    function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->table." 
			SET nome= ?, sobrenome = ?, email = ?, telefone = ?, idade = ?, senha = ? 
			 WHERE id = ?");
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->sobrenome = htmlspecialchars(strip_tags($this->sobrenome));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->telefone = htmlspecialchars(strip_tags($this->telefone));
            $this->idade = htmlspecialchars(strip_tags($this->idade));
            $this->senha = htmlspecialchars(strip_tags($this->senha));
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bind_param("ssssisi", $this->nome, $this->sobrenome, $this->email, $this->telefone,  $this->idade,  $this->senha, $this->id,); 
		
		if($stmt->execute()){
			return true;
		}
		return false;
	}
}
		
