<?php
session_start();
require 'database.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, full_name, user_type, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $full_name, $user_type, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['user_type'] = $user_type;
            
            if ($user_type == 'admin') {
                header("Location: index.php");
            } elseif ($user_type == 'service_provider') {
                header("Location: providerReservation.php");
            } else {
                header("Location: customerReservation.php");
            }
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!doctype html>
<html lang="en">
<?php require "navbar.php"; ?>
<head>
    <title>Login</title>
</head>

<style>
        .yellow-field {
            background-color: yellow;
            color: black;
        }
        .yellow-field::placeholder {
            color: yellowgreen;
            opacity: 1; /* For older browsers */
        }
    </style>
<body>
<main>
    <div class="container bg-white">
        <img class="my-5 d-block mx-auto" src="download.jpeg" alt="login" width="300">
        
        <form action="login.php" method="post">
            <div class="form-group" >
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn yellow-field">
            </div>
        </form>
        <div>
            <p>Not registered yet <a href="registration.php">Register Here</a></p>
        </div>
    </div>
</main>
<footer>
    <!-- place footer here -->
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
