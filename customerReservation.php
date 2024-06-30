<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'customer') {
    header("Location: login.php");
    exit();
}

require 'database.php'; // Database connection

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT services.service_name, service_providers.full_name, reservations.reservation_time FROM reservations JOIN services ON reservations.service_id = services.id JOIN service_providers ON reservations.service_provider_id = service_providers.id WHERE reservations.user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php require "navbar.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <?php
    session_start();
    ?>
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
                        <li class="nav-item">
                            <a class="nav-link" href="apply.php"><h4>Apply as Service Provider</h4></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><h4>Log out</h4></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="apply.php"><h4>Apply as Service Provider</h4></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><h4>Log in</h4></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
        <!-- Main Section -->
        <main class="contact-section d-flex justify-content-center align-items-center">
        <div class="container">
            <h2 class="text-center mb-5">My Reservations</h2>
            <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
            <tr>
                <th style="width: 25%;">Service</th>
                <th style="width: 25%;">Provider</th>
                <th style="width: 50%;">Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) {?>
                <tr>
                    <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['reservation_time']); ?></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>
</div>
</div>
</main>

        <!-- Footer -->
        <footer class="footer">
        <?php include 'footer.php';?>
    </footer>

    <!-- Scripts -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>


