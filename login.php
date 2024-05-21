<!doctype html>
<html lang="en">
<?php require "navbar.php";?>
<head>
    <title>Title</title>
    <!-- Required meta tags -->


</head>

<body >
    <main>
    <div class="container bg-white">
        <?php
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user"] = "yes";
            header("Location: index.php");
            die();
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}
?>
        <img class="my-5 d-block mx-auto" src="download.jpeg" alt="login" width="300">
        <form action="login.php" method="post">
            <div class="form-group  ">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="role-selection">
                <label><input type="radio" name="role" value="customer"> CUSTOMER</label>
                <label><input type="radio" name="role" value="service-provider"> SERVICE PROVIDER</label>
                <label><input type="radio" name="role" value="admin" checked> ADMIN</label>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
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