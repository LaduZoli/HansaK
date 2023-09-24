<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that the necessary POST data is received
    if (isset($_POST['esemenydatumido']) && isset($_POST['vasarlasosszeg']) && isset($_POST['penztargepazonosito'])
         && isset($_POST['partnerid']) && isset($_POST['boltid'])) {
        // Retrieve the data from the POST request
        $esemenydatumido = $_POST['esemenydatumido'];
        $vasarlasosszeg = $_POST['vasarlasosszeg'];
        $penztargepazonosito = $_POST['penztargepazonosito'];
        $partnerid = $_POST['partnerid'];
        $boltid = $_POST['boltid'];

        // Include the database connection script
        include('../include/mysqli_connect.php');

        // Prepare an SQL statement to insert data
        $sql = "INSERT INTO vasarlas (esemenydatumido, vasarlasosszeg, penztargepazonosito,
               partnerid, boltid) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sdiii", $esemenydatumido, $vasarlasosszeg, $penztargepazonosito,
         $partnerid, $boltid);

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
        error_log("Missing POST data in vasarlas_insert.php");
    }
}
?>
