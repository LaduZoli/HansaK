<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that the necessary POST data is received
    if (isset($_POST['partnerctid']) && isset($_POST['vasarlasid']) && isset($_POST['mennyiseg'])
    && isset($_POST['brutto']) && isset($_POST['partnerid'])) {
        // Retrieve the data from the POST request
        $partnerctid = $_POST['partnerctid'];
        $vasarlasid = $_POST['vasarlasid'];
        $mennyiseg = $_POST['mennyiseg'];
        $brutto = $_POST['brutto'];
        $partnerid = $_POST['partnerid'];

        // Include the database connection script
        include('../include/mysqli_connect.php');

        // Prepare an SQL statement to insert data
        $sql = "INSERT INTO vasarlas_tetel (partnerctid, vasarlasid, mennyiseg, brutto,
                  partnerid) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssss", $partnerctid, $vasarlasid, $mennyiseg, $brutto,
        $partnerid);

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
        error_log("Missing POST data in vasarlas_tetel_insert.php");
    }
}
?>
