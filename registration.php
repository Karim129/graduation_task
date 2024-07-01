<?php
require "navbar.php";
session_start();
if (isset($_SESSION["user"])) {
    session_destroy();
}

// Initialize variables
$fullName = '';
$email = '';
$password = '';
$passwordRepeat = '';
$role = 'customer'; // default role
$errors = array();

if (isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    $role = $_POST["role"]; // Capture the role from the form

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($fullName) && empty($email) && empty($password) && empty($passwordRepeat) && empty($role)) {
        array_push($errors, "All fields are required");
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    elseif (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    elseif ($password !== $passwordRepeat) {
        array_push($errors, "Password does not match");
    } elseif (empty($role)) {
        array_push($errors, "Add user role");
    }

    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);
        if ($rowCount > 0) {
            array_push($errors, "Email already exists!");
        }
    } else {
        array_push($errors, "Database error: failed to prepare statement");
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO users (full_name, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $fullName, $email, $passwordHash, $role);
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                $_SESSION["user"] = $fullName;
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                $_SESSION["user_type"] = $role;
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_stmt_error($stmt) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Something went wrong: " . mysqli_error($conn) . "</div>";
        }
    }

    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration</title>
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
</head>

<body>
    <main>
        <div class="container bg-white">
            <img class="my-5 d-block mx-auto" src="registrationImage.jpeg" alt="login" width="300" height="300">
            <form action="registration.php" method="post">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name:" value="<?php echo htmlspecialchars($fullName); ?>">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email:" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
                </div>
                <div class="role-selection">
                    <select name="role" id="role" class="form-control">
                        <option value="customer" <?php echo ($role == 'customer') ? 'selected' : ''; ?>>CUSTOMER</option>
                        <option value="service_provider" <?php echo ($role == 'service_provider') ? 'selected' : ''; ?>>SERVICE PROVIDER</option>
                        <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>ADMIN</option>
                    </select>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn yellow-field" value="Register" name="submit">
                </div>
            </form>
            <div>
                <p>Already Registered <a href="login.php">Login Here</a></p>
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
