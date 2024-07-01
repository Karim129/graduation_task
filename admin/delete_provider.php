<?php
// Include database connection
require_once "../database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provider_id'])) {
    $provider_id = $_POST['provider_id'];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM service_providers WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $provider_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the service provider list page
        header("Location: serviceprovider.php");
        exit();
    } else {
        die("Error deleting provider: " . mysqli_error($conn));
    }
} else {
    echo "Invalid request";
    // Redirect back if the request method is not POST or provider_id is not set
    header("Location: serviceprovider.php");
    exit();
}
?>
