<?php require "navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Provider Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #E6E6FA;
      border-radius: 10px;
    }
    .btn-submit {
      background-color: #FFD700;
      color: black;
      font-weight: bold;
    }
    .form-title {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
    <!-- Navigation Bar -->


    <!-- Main Section -->
    <main>
    <div class="container">
    <div class="form-container">
      <h2 class="form-title">SOS</h2>
      <a href="index.php" class="back-button">BACK</a>
      <form action="register_service_provider.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" name="fullname" class="form-control" id="fullName" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
        </div>
        <div class="form-group">
          <label for="phoneNumber">Phone Number</label>
          <input type="tel" name="phone" class="form-control" id="phoneNumber" placeholder="Phone Number" required>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
        </div>
        <div class="form-group">
          <label for="nationalId">National ID</label>
          <input type="text" name="national_id" class="form-control" id="nationalId" placeholder="National ID" required>
        </div>
        <div class="form-group">
          <label for="services">Services that you will provide</label>
          <select name="services_id" class="form-control" id="services" required>
            <?php
            require_once "database.php";
            $result = mysqli_query($conn, "SELECT id, service_name FROM services");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>{$row['service_name']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="documents">Upload your documents and National ID</label>
          <input type="file" name="documents[]" class="form-control-file" id="documents" multiple required>
        </div>
        <button type="submit" name="submit" class="btn btn-submit btn-block">Submit</button>
      </form>
    </div>
  </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
