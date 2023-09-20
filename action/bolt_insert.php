<?php 

include('../include/mysqli_connect.php');

$nev = $_POST['nev'];
$partnerid = $_POST['partnerid'];

$query = "INSERT INTO `bolt` (`nev`, `partnerid`) values ('$nev', '$partnerid')";
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
