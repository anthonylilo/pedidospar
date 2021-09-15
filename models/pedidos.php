<?php 

require_once 'productos.php';

class Pedidos{
  private $id;
  private $usuario_id;
  private $cliente_id;
  private $total;
  private $fecha;
  private $hora;
  private $status;

  private $pedido_id;
  private $producto_id;
  private $unidades;

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

  function getUsuario_id() { 
    return $this->usuario_id; 
 } 

  function setUsuario_id($usuario_id) {  
    $this->usuario_id = $this->db->real_escape_string($usuario_id); 
  } 

  function getCliente_id() { 
    return $this->cliente_id; 
  } 

  function setCliente_id($cliente_id) {  
    $this->cliente_id = $this->db->real_escape_string($cliente_id); 
  } 

  function getTotal() { 
    return $this->total; 
  } 

  function setTotal($total) {  
    $this->total = $this->db->real_escape_string($total); 
  }

  function getFecha() {
    return $this->fecha; 
  } 

  function setFecha($fecha) {  
    $this->fecha = $this->db->real_escape_string($fecha); 
  } 

  function getHora() { 
      return $this->hora; 
  } 

  function setHora($hora) {  
    $this->hora = $this->db->real_escape_string($hora); 
  }

  function getStatus() { 
    return $this->status; 
  } 

  function setStatus($status) {  
    $this->status = $status; 
  } 

  public function getClientes(){
    $clientes = $this->db->query("SELECT * FROM clientes ORDER BY id DESC");
    return $clientes;
  }

  public function getAll(){
    $sql = "SELECT p.*, cl.nombre, uss.nombre as 'ussname' FROM pedidos p "
    . "INNER JOIN clientes cl ON cl.id = p.cliente_id " 
    . "INNER JOIN usuarios uss ON uss.id = p.usuario_id " 
    . "ORDER BY p.id DESC";

    $producto = $this->db->query($sql);
    return $producto;
  }

  public function getOneByUser(){
    $sql = "SELECT p.id, p.total FROM pedidos p "
    //. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id " 
    . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";

    $pedido = $this->db->query($sql);

    return $pedido->fetch_object();
  }

  public function getAllByUser(){
    $sql = "SELECT p.*, cl.nombre, uss.nombre AS 'vendedor' FROM pedidos p "
    . "INNER JOIN clientes cl ON cl.id = p.cliente_id "
    . "INNER JOIN usuarios uss ON uss.id = p.usuario_id "
    . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY p.id DESC";

    $pedido = $this->db->query($sql);

    return $pedido;
  }

  public function getProductosByPedido($id){
    $sql = "SELECT pr.*, lp.unidades FROM productos pr "
    . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
    . "WHERE lp.pedido_id = {$id}";

    $productos = $this->db->query($sql);

    return $productos;
  }

  public function savePedido(){
    $sql = "INSERT INTO pedidos VALUES(NULL, 
    '{$this->getUsuario_id()}',
    '{$this->getCliente_id()}',
    {$this->getTotal()},
    CURDATE(),
    CURTIME(),
    'Pendiente de revisión')";
    $save = $this->db->query($sql);

		//echo mysqli_error($this->db);

    $result = false;
    if($save){
      $result = true;
    }

    return $result;
  }

  function getPedidoid() { 
    return $this->pedidoid; 
  } 

  function setPedidoid($pedidoid) {  
   $this->pedidoid = $pedidoid; 
  } 

  function getProductoid() { 
    return $this->productoid; 
  } 

  function setProductoid($productoid) {  
   $this->productoid = $productoid; 
  } 

 function getUnidades() { 
    return $this->unidades; 
  } 

  function setUnidades($unidades) {  
   $this->unidades = $unidades;
  } 

  public function save_linea(){

    $sql = "SELECT LAST_INSERT_ID() as 'pedidos';";
    $query = $this->db->query($sql);
    $pedido_id = $query->fetch_object()->pedidos;

    foreach($this->getProductoid() as $nombre => $value){

      $producto_id = $this->getProductoid()[$nombre];
      $unidades = $this->getUnidades()[$nombre];

      $insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id}, {$producto_id}, {$unidades} )";
      $save = $this->db->query($insert);

		  //echo mysqli_error($this->db);
    }

    $result = false;
    if($save){
      $result = true;
    }

    return $result;
  }
	
}