<?php 

include('../include/mysqli_connect.php');

$cikkszam = $_POST['cikkszam'];
$vonalkod = $_POST['vonalkod'];
$nev = $_POST['nev'];
$mennyisegiegyseg = $_POST['mennyisegiegyseg'];
$nettoegysegar = $_POST['nettoegysegar'];
$verzio = $_POST['verzio'];
$partnerid = $_POST['partnerid'];

$query = "INSERT INTO `cikkek` (`cikkszam`, `vonalkod`, `nev`, `mennyisegiegyseg`, 
    `nettoegysegar`, `verzio`; `partnerid`) values 
    ('$cikkszam', '$vonalkod', '$mennyisegiegyseg', '$nettoegysegar', '$verzio', '$partnerid')";
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
