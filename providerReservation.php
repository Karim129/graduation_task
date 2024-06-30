<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'service_provider') {
    header("Location: login.php");
    exit();
}

require 'database.php'; // Database connection

$provider_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT users.full_name, services.service_name, reservations.reservation_time FROM reservations JOIN users ON reservations.user_id = users.id JOIN services ON reservations.service_id = services.id WHERE reservations.service_provider_id = ?");
$stmt->bind_param('i', $provider_id);
$stmt->execute();
$result = $stmt->get_result();
?>



<?php require "navbar.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Provider Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-secondary">
    <!-- Main Section -->
    <main class="contact-section d-flex justify-content-center align-items-center">
        <div class="container">
            <h2 class="text-center mb-5">My Reservations</h2>
            <div class="row justify-content-center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['reservation_time']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Scripts -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>