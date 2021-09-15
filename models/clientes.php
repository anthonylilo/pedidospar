<?php

class Clientes{
  private $id;
  private $nombre;
  private $ruc;
  private $direccion;
  private $numero_telefono;
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

	function getId() { 
 		return $this->id; 
	} 

	function setId($id) {  
		$this->id = $this->db->real_escape_string($id); 
	} 

	function getNombre() { 
 		return $this->nombre;
	} 

	function setNombre($nombre) {  
		$this->nombre = $this->db->real_escape_string($nombre); 
	}
  
  function getRuc() { 
    return $this->ruc; 
  } 

  function setRuc($ruc) { 
    $this->ruc = $this->db->real_escape_string($ruc); 
  } 

  function getDireccion() { 
    return $this->direccion; 
  } 

  function setDireccion($direccion) {
    $this->direccion = $this->db->real_escape_string($direccion);  
  } 

  function getNumero_telefono() { 
    return $this->numero_telefono; 
  } 

  function setNumero_telefono($numero_telefono) {  
    $this->numero_telefono = $this->db->real_escape_string($numero_telefono);   
  } 

  public function getAll(){
    $clientes = $this->db->query("SELECT * FROM clientes ORDER BY id DESC");
    return $clientes;
  }

  public function save(){
    $sql = "INSERT INTO clientes VALUES(NULL, '{$this->getNombre()}',
    '{$this->getRuc()}',
    '{$this->getDireccion()}',
    '{$this->getNumero_telefono()}')";
    $save = $this->db->query($sql);

    $result = false;
    if($save){
      $result = true;
    }

    return $result;
  }

  public function verificar(){
    $sql = "SELECT * FROM clientes WHERE id='{$this->getId()}'";
    $clientes = $this->db->query($sql);
    
    $result = false;
    if($clientes){
      $result = true;
    }

    return $clientes->fetch_object();
  }

  public function delete(){
    $sql = "DELETE FROM clientes WHERE id='{$this->getId()}'";
    $save = $this->db->query($sql);

    if ($save) {
      echo "success"; //anything on success
    } else {
      die(header("HTTP/1.0 404 Not Found")); //Throw an error on failure
    }

  }

  public function edit(){
    $sql = "UPDATE clientes SET
    nombre='{$this->getNombre()}',
    ruc='{$this->getRuc()}',
    direccion='{$this->getDireccion()}',
    numero_telefono={$this->getNumero_telefono()}
    WHERE id={$this->id};";
    $save = $this->db->query($sql);

    $result = false;
    if($save){
      $result = true;
    }

    return $result;
  }
}