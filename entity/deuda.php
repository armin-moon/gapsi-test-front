<?php
class Deuda{

    // database connection and table name
    private $conn;
    private $table_name = "p_deuda";

    // object properties
    public $id;
    public $pago;
    public $total;
    public $nombre;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read($id){

      // select all query
      $query = "SELECT d.NOMBRE,(d.TOTAL-SUM(p.IMPORTE)) as REMANENTE,SUM(p.IMPORTE) as ABONO FROM p_deuda d inner join p_pagos p ON p.ID_DEUDA=d.ID WHERE d.id=$id";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
    }
}
