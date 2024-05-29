<?php
// Include database connection
require_once "database.php";
require "navbar.php";
// Fetch services and providers data from the database
$sql = "SELECT services.service_name, service_providers.full_name, service_providers.email, service_providers.phone, service_providers.address
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
    <style>
        /* Custom CSS styles */
        .filter-form {
            margin-bottom: 20px;
        }
        /* Sticky footer styles */
        html, body {
            height: 100%;
            /* margin-top: 10;

            padding: 0; */
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
    <?php require "navbar.php"; ?>

    <!-- Main Section -->
    <div class="wrapper">
        <main >
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
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php mysqli_free_result($result); ?>
        </main>

        <!-- Footer -->
        <footer class="footer mt-auto py-3">
            <?php include 'footer.php'; ?>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



