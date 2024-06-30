<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
require_once "database.php";

$errors = array();
$success = false;

// Check if form is submitted
if (isset($_POST['submit'])) {
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $nationalID = $_POST['national_id'];
    $servicesID = $_POST['services_id'];

    // Validate input
    if (empty($fullName) || empty($email) || empty($phone) || empty($address) || empty($nationalID) || empty($servicesID)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Handle file upload
    $uploadedFiles = [];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            $errors[] = "Failed to create upload directory.";
        }
    }

    foreach ($_FILES['documents']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['documents']['name'][$key]);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($tmpName, $uploadFile)) {
            $uploadedFiles[] = $uploadFile;
        } else {
            $errors[] = "Failed to upload $fileName.";
        }
    }

    // If no errors, insert data into the database
    if (empty($errors)) {
        $sql = "INSERT INTO service_providers (full_name, email, phone, address, national_id, services_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            $errors[] = "Prepare failed: " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "sssssi", $fullName, $email, $phone, $address, $nationalID, $servicesID);
            try {
                mysqli_stmt_execute($stmt);
                $serviceProviderID = mysqli_insert_id($conn);

                // Insert uploaded files into documents table
                foreach ($uploadedFiles as $file) {
                    $sqlDoc = "INSERT INTO documents (link, service_providers_id) VALUES (?, ?)";
                    $stmtDoc = mysqli_prepare($conn, $sqlDoc);
                    if (!$stmtDoc) {
                        $errors[] = "Prepare failed for documents: " . mysqli_error($conn);
                    } else {
                        mysqli_stmt_bind_param($stmtDoc, "si", $file, $serviceProviderID);
                        if (!mysqli_stmt_execute($stmtDoc)) {
                            $errors[] = "Execute failed for document $file: " . mysqli_error($conn);
                        }
                        mysqli_stmt_close($stmtDoc);
                    }
                }
                $success = true;
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    $errors[] = "The email address is already registered.";
                } else {
                    $errors[] = "Execute failed: " . $e->getMessage();
                }
            }
            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
    }

    if ($success) {
        header("Location: index.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Service Provider Registration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

<style>
        .yellow-field {
            background-color: yellow;
            color: black;
        }
        .yellow-field::placeholder {
            color: yellowgreen;
            opacity: 1; /* For older browsers */
        }
    </style>
</head>
<body style="background:darkorchid">
    <?php require "navbar.php"; ?>
    <main>
        <div class="container bg-white">
            <h1 class="my-5">Service Provider Registration</h1>
            <form action="apply.php" method="post" enctype="multipart/form-data">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php elseif ($success): ?>
                    <div class="alert alert-success">Registration successful</div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" class="form-control" value="<?php echo isset($fullName) ? htmlspecialchars($fullName) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" class="form-control" value="<?php echo isset($address) ? htmlspecialchars($address) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="national_id">National ID:</label>
                    <input type="text" name="national_id" class="form-control" value="<?php echo isset($nationalID) ? htmlspecialchars($nationalID) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="services_id">Services ID:</label>
                    <select name="services_id" class="form-control" required>
                        <?php
                        require_once "database.php";
                        $result = mysqli_query($conn, "SELECT id, service_name FROM services");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id']}'>{$row['service_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="documents">Upload Documents:</label>
                    <input type="file" name="documents[]" class="form-control-file" multiple required>
                </div>
                <div class="form-btn">
                    <input type="submit" name="submit" value="Register" class="btn yellow-field">
                </div>
            </form>
        </div>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
