<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'customer') {
    header("Location: login.php");
    exit();
}
require_once "database.php";

$errors = array();
$success = false;

// Fetch available services
$sqlServices = "SELECT id, service_name, price FROM services WHERE available = 1";
$resultServices = mysqli_query($conn, $sqlServices);
$services = mysqli_fetch_all($resultServices, MYSQLI_ASSOC);

// Handle form submission
if (isset($_POST['submit'])) {
    $userId = $_SESSION['user_id'];  // Assuming user ID is stored in session after login
    $serviceId = $_POST['service_id'];
    $reservationTime = $_POST['reservation_time'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    // Validate input
    if (empty($serviceId) || empty($reservationTime) || empty($address) || empty($message)) {
        $errors[] = "All fields are required.";
    } else {
        // Check if service is available
        $sqlCheck = "SELECT available FROM services WHERE id = ? AND available = 1";
        $stmtCheck = mysqli_prepare($conn, $sqlCheck);
        mysqli_stmt_bind_param($stmtCheck, "i", $serviceId);
        mysqli_stmt_execute($stmtCheck);
        mysqli_stmt_store_result($stmtCheck);

        if (mysqli_stmt_num_rows($stmtCheck) == 0) {
            $errors[] = "Selected service is not available.";
        } else {
            // Fetch a service provider for the selected service
            $sqlProvider = "SELECT id FROM service_providers WHERE services_id = ? LIMIT 1";
            $stmtProvider = mysqli_prepare($conn, $sqlProvider);
            mysqli_stmt_bind_param($stmtProvider, "i", $serviceId);
            mysqli_stmt_execute($stmtProvider);
            mysqli_stmt_bind_result($stmtProvider, $serviceProviderId);
            mysqli_stmt_fetch($stmtProvider);
            mysqli_stmt_close($stmtProvider);

            if (empty($serviceProviderId)) {
                $errors[] = "No service provider available for the selected service.";
            } else {
                // If no errors, insert data into the database
                $sql = "INSERT INTO reservations (user_id, service_id, reservation_time, service_provider_id, address, message) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                if (!$stmt) {
                    $errors[] = "Prepare failed: " . mysqli_error($conn);
                } else {
                    mysqli_stmt_bind_param($stmt, "iisiss", $userId, $serviceId, $reservationTime, $serviceProviderId, $address, $message);
                    try {
                        mysqli_stmt_execute($stmt);
                        $success = true;
                    } catch (mysqli_sql_exception $e) {
                        $errors[] = "Execute failed: " . $e->getMessage();
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }

        mysqli_stmt_close($stmtCheck);
    }

    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Reserve Service</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
</head>

<body style="background:darkorchid">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand text-warning" href="index.php"><h4>SOS</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-center">
                <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] != "admin") { ?>
                    <li class="nav-item">
                            <a class="nav-link" href="reserve_service.php"><h4>Services</h4></a>
                        </li>
                        
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="about-us.php"><h4>About Us</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.php"><h4>Contact Us</h4></a>
                    </li>

                    <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "customer") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="customerReservation.php"><h4>My reservations</h4></a>
                        </li>
                        
                    <?php } ?>

                    <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "service_provider") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="providerReservation.php"><h4>My reservations</h4></a>
                        </li>
                        
                    <?php } ?>

                    <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/serviceprovider.php"><h4>Admin Dashboard</h4></a>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION["user_type"])) { ?>
                        <?php if ($_SESSION["user_type"] == 'service_provider') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="apply.php"><h4>Apply as Service Provider</h4></a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><h4>Log out</h4></a>
                        </li>
                    <?php } else { ?>
                        <?php if ($_SESSION["user_type"] == 'service_provider') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="apply.php"><h4>Apply as Service Provider</h4></a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><h4>Log in</h4></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container bg-white">
            <img src="download-2.png" alt="Logo" class="d-block mx-auto my-5" />
            <h1 class="my-5">Reserve Service</h1>
            <form action="reserve_service.php" method="post">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php elseif ($success): ?>
                    <div class="alert alert-success">Reservation successful</div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="service_id">Select Service:</label>
                    <select name="service_id" class="form-control" required>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['id']; ?>" data-price="<?php echo $service['price']; ?>">
                                <?php echo $service['service_name'] . " - $" . $service['price']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reservation_time">Reservation Time:</label>
                    <input type="datetime-local" name="reservation_time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-btn">
                    <input type="submit" name="submit" value="Reserve" class="btn btn-primary">
                </div>
            </form>
        </div>
    </main>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
