<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../config/database.php';
include_once '../entity/pagos.php';

// instantiate database and product object

$database = new Database();
$db = $database->getConnection();

// initialize object
$pagos = new Pagos($db);

$id_deuda = isset($_GET['iddeuda']) ? $_GET['iddeuda'] : die();

// query pagos
$stmt = $pagos->read($id_deuda);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

   // products array
   $products_arr=array();
   $products_arr["pagos"]=array();

   // retrieve our table contents
   // fetch() is faster than fetchAll()
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       // extract row
       // this will make $row['name'] to
       // just $name only
       extract($row);

       $product_item=array(
           "id" => $ID,
           "descripcion" => $DESCRIPCION,
           "fecha" => $FECHA,
           "importe" => $IMPORTE
       );

       array_push($products_arr["pagos"], $product_item);
   }

   // set response code - 200 OK
   http_response_code(200);

   // show products data in json format
   echo json_encode($products_arr);
}

// no products found will be here
