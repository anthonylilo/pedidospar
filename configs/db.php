<?php

class Database{
  public static function connect(){
    $db = new mysqli('localhost', 'root', '', 'micropar_pedidos');
    $db->query("SET NAMES 'utf8'");
    return $db;
  }
}