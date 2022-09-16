

<?php
class Database{
	
	private $host  = "192.168.0.177";
    private $user  = "root";
    private $password   = "123456";
    private $database  = "atividade_crud"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}