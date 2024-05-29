<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="css/bootstrap.css" rel="stylesheet" />

    <link href="css/style.css" rel="stylesheet" />

</head>

<body class="bg-secondary">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand text-warning" href="index.php"><h4>SOS</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav justify-content-center">
                    <li class="nav-item active">
                        <a class="nav-link" href="service.php"><h4>Services</h4> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about-us.php"><h4>About Us</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="contact-us.php"><h4>Contact Us</h4></a>
                    </li>
                
                    </ul>
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <?php             session_start();
                    if(isset($_SESSION["user"])){?>
                        <a class="nav-link " href="apply.php"><h4>Apply as Service Provider Us</h4></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="logout.php"><h4>Log out</h4></a>
                    </li>
                    <?php }else{ ?>
                        <li class="nav-item">
                        <a class="nav-link " href="apply.php"><h4>Apply as Service Provider Us</h4></a>
                    </li>
                    <li class="nav-item "></li>
                        <a class="nav-link " href="login.php"><h4>Log in</h4></a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>
    </header>


    <!-- Bootstrap JavaScript Libraries -->

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>