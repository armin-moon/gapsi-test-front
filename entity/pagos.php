<?php
class Pagos{

    // database connection and table name
    private $conn;
    private $table_name = "p_pagos";

    // object properties
    public $id;
    public $descripcion;
    public $importe;
    public $fecha;
    public $id_deuda;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read($id_deuda){

      // select all query
      $query = "SELECT ID,DESCRIPCION,FECHA,IMPORTE FROM p_pagos WHERE ID_DEUDA=$id_deuda ORDER BY FECHA DESC";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
    }
}
