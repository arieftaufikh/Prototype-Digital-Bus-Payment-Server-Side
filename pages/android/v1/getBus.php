<?php 

require_once('../includes/DbOperation.php');
$respone = array();

$db = new DbOperation();
$result=$db->getBus();

while ($row = $result->fetch_assoc()) {
    $respone[]=$row;
}

echo json_encode($respone);


 ?>