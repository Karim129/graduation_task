<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../database.php'; // Database connection

// Fetch all reservations with user names, service names, and service provider names
$query = "
    SELECT 
        reservations.id,
        users.full_name AS user_name, 
        services.service_name,
        service_providers.full_name AS service_provider_name, 
        reservations.reservation_time,
        reservations.address,
        reservations.message
    FROM reservations
    JOIN users ON reservations.user_id = users.id
    JOIN services ON reservations.service_id = services.id
    JOIN service_providers ON reservations.service_provider_id = service_providers.id
";

$reservations = $conn->query($query);
if ($reservations === false) {
    echo "Error: " . $conn->error;
} else {
    $reservations = $reservations->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations - SOS Service Provider</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <style>
        /* Custom CSS styles */
        html, body {
            height: 100%;
            margin-top: 10;
            padding: 0;
            background: #e3e0e0;
        }
        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .footer {
            margin-top: auto;
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand text-warning" href="../index.php"><h4>SOS</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-center">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php"><h4>Website</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="serviceprovider.php"><h4>Services Provider</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php"><h4>View Customer Records</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.php"><h4>Manage Services</h4><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservations.php"><h4>Manage Reservations</h4></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION["user_type"])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php"><h4>Log out</h4></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login.php"><h4>Log in</h4></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Section -->
    <div class="wrapper">
        <main class="mt-5">
            <div class="row text-center">
                <h1>Manage Reservations</h1>
            </div>

            <!-- Reservations table -->
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Service Name</th>
                                <th>Service Provider Name</th>
                                <th>Reservation Time</th>
                                <th>Address</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reservation['id']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['user_name']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['service_name']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['service_provider_name']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['reservation_time']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['address']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['message']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer mt-auto py-3">
            <?php include '../footer.php'; ?>
        </footer>
    </div>

    <!-- Scripts -->
    <script src=".../js/popper.min.js"></script>
    <script src=".../js/jquery-3.5.1.min.js"></script>
    <script src=".../js/bootstrap.min.js"></script>
</body>
</html>
