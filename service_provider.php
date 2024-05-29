<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="form-container">
      <h2 class="form-title">SOS</h2>
      <a href="index.php" class="back-button">BACK</a>
        <form action="register_service_provider.php" method="post" enctype="multipart/form-data">

                <label>Full Name *</label>
                <input type="text" name="fullname" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <label>E-mail *</label>
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <label>Phone Number *</label>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <label>Address *</label>
                <input type="text" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <label>National ID *</label>
                <input type="text" name="national_id" placeholder="National ID" required>
            </div>
            <div class="form-group">
                <label>Services that you will provide *</label>
                <select name="services_id" required>
                    <?php
                    require_once "database.php";
                    $result = mysqli_query($conn, "SELECT id, servicescol FROM services");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['servicescol']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Upload your documents and National ID *</label>
                <input type="file" name="documents[]" multiple required>
            </div>
            <div class="form-btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
