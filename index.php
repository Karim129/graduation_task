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
		<div class="main-section text-center">
			<h2>Relax & let SOS handle your home, so you can enjoy life</h2>
			<p>Welcome to SOS! Where you can find reliable service providers for all your needs. Whether you are looking for repairs, renovations, or maintenance, we have got you covered.</p>
			<div class="search-bar mt-4">
				<input type="text" class="form-control" placeholder="TYPE YOUR SERVICE......">
				<div class="d-flex justify-content-center mt-2">
					<button class="btn btn-primary" style="width: 200px; height: 50px;">Search</button>
				</div>
			</div>
			<div class="service-icons mt-5">
				<div class="d-flex justify-content-around">
					<img src="https://via.placeholder.com/50" alt="Service 1">
					<img src="https://via.placeholder.com/50" alt="Service 2">
					<img src="https://via.placeholder.com/50" alt="Service 3">
					<img src="https://via.placeholder.com/50" alt="Service 4">
					<img src="https://via.placeholder.com/50" alt="Service 5">
					<img src="https://via.placeholder.com/50" alt="Service 6">
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
