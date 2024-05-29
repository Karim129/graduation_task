<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
require_once "database.php";

// Check if form is submitted
if (isset($_POST['submit'])) {
    // echo "<pre>Form Submitted</pre>";

    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $nationalID = $_POST['national_id'];
    $servicesID = $_POST['services_id'];

    // echo "<pre>";
    // echo "Full Name: $fullName\n";
    // echo "Email: $email\n";
    // echo "Phone: $phone\n";
    // echo "Address: $address\n";
    // echo "National ID: $nationalID\n";
    // echo "Services ID: $servicesID\n";
    // echo "</pre>";

    // Handle file upload
    $uploadedFiles = [];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("<div class='alert alert-danger'>Failed to create upload directory</div>");
        }
    }

    foreach ($_FILES['documents']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['documents']['name'][$key]);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($tmpName, $uploadFile)) {
            $uploadedFiles[] = $uploadFile;
            echo "<pre>File Uploaded: $uploadFile</pre>";
        } else {
            echo "<div class='alert alert-danger'>Failed to upload $fileName</div>";
        }
    }

    // Debugging information
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    // Insert data into the database
    $sql = "INSERT INTO service_providers (full_name, email, phone, address, national_id, services_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("<div class='alert alert-danger'>Prepare failed: " . mysqli_error($conn) . "</div>");
    }

    mysqli_stmt_bind_param($stmt, "sssssi", $fullName, $email, $phone, $address, $nationalID, $servicesID);
    if (mysqli_stmt_execute($stmt)) {
        $serviceProviderID = mysqli_insert_id($conn);

        // Insert uploaded files into documents table
        $sqlDoc = "INSERT INTO documents (link, service_providers_id) VALUES (?, ?)";
        $stmtDoc = mysqli_prepare($conn, $sqlDoc);
        if (!$stmtDoc) {
            die("<div class='alert alert-danger'>Prepare failed for documents: " . mysqli_error($conn) . "</div>");
        }

        foreach ($uploadedFiles as $file) {
            mysqli_stmt_bind_param($stmtDoc, "si", $file, $serviceProviderID);
            if (!mysqli_stmt_execute($stmtDoc)) {
                echo "<div class='alert alert-danger'>Execute failed for document $file: " . mysqli_error($conn) . "</div>";
            }
        }

        echo "<div class='alert alert-success'>Registration successful</div>";
    } else {
        echo "<div class='alert alert-danger'>Execute failed: " . mysqli_error($conn) . "</div>";
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmtDoc);
    mysqli_close($conn);
    header("Location: service.php");
} else {
    echo "<pre>Form Not Submitted</pre>";
}

