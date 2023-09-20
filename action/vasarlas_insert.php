<?php

include('../include/mysqli_connect.php');

$datum = $_POST['datum'];
$osszeg = $_POST['osszeg'];
$penztargepazonosito = $_POST['penztargepazonosito'];
$partnerid = $_POST['partnerid'];
$boltid = $_POST['boltid'];;
 
$query = "INSERT INTO `vasarlas` (`datum`, `osszeg`, `penztargepazonosito`, `partnerid`, `boltid`) 
        VALUES ('$id', '$datum', '$osszeg', '$penztargepazonosito', '$partnerid', '$boltid')";
$query_run = mysqli_query($con, $query);
$lastId = mysqli_insert_id($con);

if($query_run) 
{
   $data = array(
        'status'=>'true',
   );
   echo json_encode($data);
}
else {
    $data = array(
        'status'=>'false',
   );
   echo json_encode($data);
}
?>