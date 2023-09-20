<?php

include('../include/mysqli_connect.php');

$partnerctid = $_POST['partnerctid'];
$vasarlasid = $_POST['vasarlasid'];
$mennyiseg = $_POST['mennyiseg'];
$brutto = $_POST['brutto'];
$partnerid = $_POST['partnerid'];
$boltid = $_POST['boltid'];
 
// Attempt insert query execution
$query = "INSERT INTO `vasarlas_tetel` (`partnerctid`, `vasarlasid`, `mennyiseg`, `brutto`, `partnerid`, `boltid`) 
        VALUES ('$partnerctid', '$vasarlasid', '$mennyiseg', '$brutto', '$partnerid', '$boltid')";
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