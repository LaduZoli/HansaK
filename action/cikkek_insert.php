<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that the necessary POST data is received
    if (isset($_POST['cikkszam']) && isset($_POST['vonalkod']) && isset($_POST['nev'])
    && isset($_POST['mennyisegiegyseg']) && isset($_POST['nettoegysegar']) && isset($_POST['verzio'])
    && isset($_POST['partnerid'])) {
        // Retrieve the data from the POST request
        $cikkszam = $_POST['cikkszam'];
        $vonalkod = $_POST['vonalkod'];
        $nev = $_POST['nev'];
        $mennyisegiegyseg = $_POST['mennyisegiegyseg'];
        $nettoegysegar = $_POST['nettoegysegar'];
        $verzio = $_POST['verzio'];
        $partnerid = $_POST['partnerid'];

        // Include the database connection script
        include('../include/mysqli_connect.php');

        // Prepare an SQL statement to insert data
        $sql = "INSERT INTO cikkek (cikkszam, vonalkod, nev, mennyisegiegyseg, nettoegysegar,
                verzio, partnerid) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssssdii", $cikkszam, $vonalkod, $nev, $mennyisegiegyseg, 
                $nettoegysegar, $verzio, $partnerid);

        // Execute the SQL statement
        try {
            // Your database operations here
            if ($stmt->execute()) {
                // Data successfully inserted
                $response = array("status" => "true");
                echo json_encode($response);
            } else {
                // Handle other cases or provide a detailed error message
                $response = array("status" => "false", "error" => "Database error: " . mysqli_error($con));
                echo json_encode($response);
            }
        } catch (Exception $e) {
            $response = array("status" => "false", "error" => "Exception: " . $e->getMessage());
            echo json_encode($response);
        }
        
    } else {
        // Handle missing POST data
        $response = array("status" => "false", "message" => "Missing POST data");
        echo json_encode($response);
        error_log("Missing POST data in cikkek_insert.php");
    }
}
?>
