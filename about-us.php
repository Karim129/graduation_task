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

<body>
	<main class="d-flex flex-column justify-content-center align-items-center">
    <div class="container main-section">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1>About Us</h1>
            <p class="lead">Welcome to SOS! We are dedicated to providing top-notch services for your home and office needs. Our team of experienced professionals is here to help you with repairs, renovations, maintenance, and more. We pride ourselves on our reliability and customer satisfaction.</p>
        </div>
    </div>
    <div class="row team-section">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Team Member 1">
                <div class="card-body">
                    <h5 class="card-title">John Doe</h5>
                    <p class="card-text">CEO & Founder</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Team Member 2">
                <div class="card-body">
                    <h5 class="card-title">Jane Smith</h5>
                    <p class="card-text">Chief Operating Officer</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Team Member 3">
                <div class="card-body">
                    <h5 class="card-title">Emily Johnson</h5>
                    <p class="card-text">Head of Customer Service</p>
                </div>
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
