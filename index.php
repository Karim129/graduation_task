<!DOCTYPE html>
<html lang="en">

<head>
	<title>Title</title>
	<!-- Required meta tags -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		/* html, body {
			height: 100%;
            background: #e3e0e0; 
		}
		body {
			display: flex;
			flex-direction: column;
		}
		main {
			flex: 1;
		} */
 
        .left-section, .right-section {
            height: 100vh;
            background: #e3e0e0;
        }
        .left-section {
            background-color:  #e3e0e0;;
            display: flex;
            justify-content: center;
            align-items: center;
            /* background: #e3e0e0; */
        }
        .right-section {
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #e3e0e0;
        }
        .main-section {
            text-align: center;
        }
        .main-section img {
            height: 300px;
        }
        .service-icons img {
            width: 90px;
            height: 90px;
        }
        .book-service-btn a {
            color: #fff;
            text-decoration: none;
        }
   

	</style>
</head>
<body>
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
                <li class="nav-item">
                        <a class="nav-link" href="index.php"><h4>Home</h4></a>
                    </li>
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
	<main  >
    <div class="container-fluid">
        <div class="row">
            <!-- Left Section -->
            <div class="col left-section">
                <div class="main-section">
                    <h2>Relax & let SOS handle your home, so you can enjoy life</h2>
                    <p style="font-size: 24px; font-weight: bold;">
                        Welcome to SOS! Where you can find reliable service providers for all your needs.
                        Whether you are looking for repairs, renovations, or maintenance, we have got you covered.
                    </p>
                    <div class="service-icons mt-5">
                        <div class="d-flex justify-content-around">
                            <img src="1.png" alt="Service 1">
                            <img src="2.png" alt="Service 2">
                            <img src="3.png" alt="Service 3">
                            <img src="4.png" alt="Service 4">
                            <img src="5.png" alt="Service 5">
                            <img src="6.png" alt="Service 6">
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <button class="btn btn-warning book-service-btn">
                            <a href="reserve_service.php">BOOK YOUR SERVICE</a>
                        </button>
                    </div>
                </div>
                <div class="right-section">
                <img src="handyman.png" alt="SOS" style="width: 100%;height: 100%;">

                </div>
            </div>
            
        </div>
    </div>
	</main>

	<footer class="footer">
		<?php include 'footer.php'; ?>
	</footer>

	<script src="js/popper.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
</body>

</html>
