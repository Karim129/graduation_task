<?php require "navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Title</title>
	<!-- Required meta tags -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		html, body {
			height: 100%;
		}
		body {
			display: flex;
			flex-direction: column;
		}
		main {
			flex: 1;
		}

	</style>
</head>
<body style="background:darkorchid">
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
	<main class="d-flex flex-column justify-content-center align-items-center" >
		<div class="main-section text-center">
			<h2>Relax & let SOS handle your home, so you can enjoy life</h2>
			<p style="font-size: 24px;font-weight:bold">Welcome to SOS! Where you can find reliable service providers for all your needs. Whether you are looking for repairs, renovations, or maintenance, we have got you covered.</p>
			<div class="search-bar mt-4">
				<input type="text" class="form-control" placeholder="TYPE YOUR SERVICE......">
				<div class="d-flex justify-content-center mt-2">
					<button class="btn btn-primary" style="width: 200px; height: 50px;">Search</button>
				</div>
			</div>
			<div class="service-icons mt-5">
				<div class="d-flex justify-content-around">
					<img src="1.png" alt="Service 1" style="width: 90px;height: 90px;">
					<img src="2.png" alt="Service 2"style="width: 90px;height: 90px;">
					<img src="3.png" alt="Service 3"style="width: 90px;height: 90px;">
					<img src="4.png" alt="Service 4"style="width: 90px;height: 90px;">
					<img src="5.png" alt="Service 5"style="width: 90px;height: 90px;">
					<img src="6.png" alt="Service 6"style="width: 90px;height: 90px;">
				</div>
			</div>
			<div class="text-center mt-5">
				<button class="btn btn-warning book-service-btn">BOOK YOUR SERVICE</button>
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
