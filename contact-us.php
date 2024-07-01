
<?php
require "navbar.php";

// Include database connection
require_once "database.php";

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SOS Service Provider</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .contact-section {
            padding: 50px 0;
        }
        .contact-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body style="background-color:darkorchid">
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
                        <?php if (isset($_SESSION["user_type"])=='service_provider') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="apply.php"><h4>Apply as Service Provider</h4></a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><h4>Log out</h4></a>
                        </li>
                    <?php } else { ?>
                        <?php if (isset($_SESSION["user_type"])=='service_provider') { ?>
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
    <!-- Main Section -->
    <main class="contact-section d-flex justify-content-center align-items-center">
        <div class="row text-left d-flex justify-content-end">
            <div class="col">
                <img src="contace.png" alt="login" width="600" >
            </div>
            
           
        </div>
        <div class="container" >
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row justify-content-center" >
                <div class="col-lg-8">
                    <!-- Form submission -->
                    <form class="contact-form" method="POST" action="" style="background-color: white;color:black">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                    </form>
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