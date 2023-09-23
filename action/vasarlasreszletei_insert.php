<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that the necessary POST data is received
    if (isset($_POST['partnerctid']) && isset($_POST['vasarlasid']) && isset($_POST['mennyiseg'])) {
        // Retrieve the data from the POST request
        $partnerctid = $_POST['partnerctid'];
        $vasarlasid = $_POST['vasarlasid'];
        $mennyiseg = $_POST['mennyiseg'];

        // Include the database connection script
        include('../include/mysqli_connect.php');

        // Query to retrieve nettoegysegar
        $nettoar_query = "SELECT DISTINCT nettoegysegar
                         FROM cikkek
                         INNER JOIN vasarlas_tetel 
                         ON cikkek.id = vasarlas_tetel.partnerctid
                         WHERE vasarlas_tetel.vasarlasid = ? AND vasarlas_tetel.partnerctid = ?";
        
        // Prepare the statement and execute it
        $stmt_nettoar = $con->prepare($nettoar_query);
        $stmt_nettoar->bind_param("ss", $vasarlasid, $partnerctid);
        $stmt_nettoar->execute();
        $stmt_nettoar->bind_result($nettoegysegar); // Bind the result to $nettoegysegar
        $stmt_nettoar->fetch();
        
        // Calculate the brutto
        $brutto = round($nettoegysegar * 1.27);

        // Query to retrieve partnerid
        $partnerid_query = "SELECT DISTINCT partnerid FROM vasarlas WHERE id = ?";
        
        // Prepare the statement and execute it
        $stmt_partnerid = $con->prepare($partnerid_query);
        $stmt_partnerid->bind_param("s", $vasarlasid);
        $stmt_partnerid->execute();
        $stmt_partnerid->bind_result($partnerid); // Bind the result to $partnerid
        $stmt_partnerid->fetch();

        // Prepare an SQL statement to insert data
        $sql = "INSERT INTO vasarlas_tetel (partnerctid, vasarlasid, mennyiseg, brutto, partnerid)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssss", $partnerctid, $vasarlasid, $mennyiseg, $brutto, $partnerid);

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
        error_log("Missing POST data in vasarlasreszletei_insert.php");
    }
}
?>
