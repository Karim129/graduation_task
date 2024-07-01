<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
// Include database connection
require_once "../database.php";
// Fetch services and providers data from the database
$sql = "SELECT services.service_name, service_providers.id, service_providers.full_name, service_providers.email, service_providers.phone, service_providers.address
        FROM services
        INNER JOIN service_providers ON services.id = service_providers.services_id";

// Check if a filter query is provided
if (isset($_GET['filter']) && !empty($_GET['filter'])) {
    $filter = $_GET['filter'];
    $sql .= " WHERE services.service_name LIKE '%$filter%' OR service_providers.full_name LIKE '%$filter%'";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers - SOS Service Provider</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <style>
        /* Custom CSS styles */
        .filter-form {
            margin-bottom: 20px;
        }
        /* Sticky footer styles */
        html, body {
            height: 100%;
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
<body >
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
                        <a class="nav-link" href="../index.php"><h4>Website</h4> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="serviceprovider.php"><h4>Services Provider</h4><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php"><h4>View Customer Records</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.php"><h4>Manage Services</h4></a>
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
        <main class="center">
            <h1 class="text-center my-4">Service Providers</h1>

            <!-- Filter form -->
            <form action="" method="GET" class="filter-form">
                <div class="form-group">
                    <label for="filterInput">Filter by service or provider:</label>
                    <input type="text" name="filter" id="filterInput" class="form-control" placeholder="Enter search term">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <!-- Display fetched data -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Service</th>
                            <th>Provider Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['service_name']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td>
                                    <form action="delete_provider.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this provider?');">
                                        <input type="hidden" name="provider_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php mysqli_free_result($result); ?>
        </main>

        <!-- Footer -->
        <footer class="footer mt-auto py-3">
            <?php include '../footer.php'; ?>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
