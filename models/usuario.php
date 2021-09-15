<?php 

class Usuario{
  private $id;
  private $nombre;
  private $apellidos;
  private $username;
  private $password;
  private $rol;


  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

	function getId() { 
 		return $this->id; 
	} 

	function setId($id) {  
		$this->id = $id; 
	} 

	function getNombre() { 
 		return $this->nombre; 
	} 

	function setNombre($nombre) {  
		$this->nombre = $this->db->real_escape_string($nombre); 
	} 

	function getApellidos() { 
 		return $this->apellidos; 
	} 

	function setApellidos($apellidos) {  
		$this->apellidos = $this->db->real_escape_string($apellidos); 
	} 

	function getUsername() { 
 		return $this->username; 
	} 

	function setUsername($username) {  
		$this->username = $this->db->real_escape_string($username); 
	} 

	function getPassword() { 
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4] ); 
	} 

	function setPassword($password) {  
		$this->password = $password;
	} 

	function getRol() { 
 		return $this->rol; 
	} 

	function setRol($rol) {  
		$this->rol = $rol; 
	} 

  public function save(){
    $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}',
    '{$this->getApellidos()}',
    '{$this->getUsername()}',
    '{$this->getPassword()}',
    'user')";
    $save = $this->db->query($sql);

    $result = false;
    if($save){
      $result = true;
    }

    return $result;
  }

	public function login(){
		$result = false;
		$username = $this->username;
		$password = $this->password;

		//NOTE: Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE username= '$username'";
		$login = $this->db->query($sql);

		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();

			//NOTE: verificar contraseña
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}

		return $result;
	}
}