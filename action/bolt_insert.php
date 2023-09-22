<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('../include/mysqli_connect.php');

$nev = $_POST['nev'];
$partnerid = $_POST['partnerid'];

$sql = "INSERT INTO bolt (nev, partnerid) VALUES ('$nev', '$partnerid')";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $nev, $partnerid);

if ($stmt->execute()) {
    // Data successfully inserted
    $response = array("status" => "true");
    echo json_encode($response);
} else {
    // Error occurred during insertion
    $response = array("status" => "false", "error" => $stmt->error);
    echo json_encode($response);    
}


?>
