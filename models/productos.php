<?php 

class Productos{
  private $id;
  private $nombre;
  private $precio;


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

	function getPrecio() { 
 		return $this->precio; 
	} 

	function setPrecio($precio) {  
		$this->precio = $this->db->real_escape_string($precio);  
	}

  public function getAll(){
    $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
    return $productos;
  }

	public function getOne(){
    $sql = "SELECT * FROM productos WHERE id='{$this->getId()}'";
    $producto = $this->db->query($sql);
    
    $result = false;
    if($producto){
      $result = true;
    }

    return $producto->fetch_object();
  }

  public function search(){
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$this->getNombre()."%' ORDER BY id DESC LIMIT 3";
    $productos = $this->db->query($sql);

    return $productos;
      
  }

	public function save(){
    $sql = "INSERT INTO productos VALUES(NULL,
		'{$this->getNombre()}',
    {$this->getPrecio()})";
    $save = $this->db->query($sql);

    $result = false;
    if($save){
      $result = true;
    }

    return $result;
  }

	public function delete(){
		$sql = "DELETE FROM productos WHERE id='{$this->getId()}'";
		$delete = $this->db->query($sql);

		if ($delete) {
      echo "success"; //anything on success
    } else {
      die(header("HTTP/1.0 404 Not Found")); //Throw an error on failure
    }
	}

	public function edit(){
    $sql = "UPDATE productos SET 
		nombre='{$this->getNombre()}', 
		precio='{$this->getPrecio()}' WHERE id={$this->getId()};";

    $save = $this->db->query($sql);

    $result = false;
    if($save){
      $result = true;
    }

		//echo mysqli_error($this->db);

    return $result;
  }
}