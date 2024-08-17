<?php


session_start();
$session_account_number = $_SESSION["account_number"];
$session_account_pin = $_SESSION["account_pin"];
$session_user_name = $_SESSION["user_name"];

if (isset($_GET["email"])) {
    $email = $_GET["email"];
    echo "Hello....";

}

?>
<!doctype html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Bnker. - Banking and Loan HTML Templates </title>
    <!-- /Required meta tags -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <!-- /Favicon -->

    <!-- All CSS -->

    <!-- Vendor Css -->
    <link rel="stylesheet" href="css/vendors.css">
    <!-- /Vendor Css -->

    <!-- Plugin Css -->
    <link rel="stylesheet" href="css/plugins.css">
    <!-- Plugin Css -->

    <!-- Icons Css -->
    <link rel="stylesheet" href="css/icons.css">
    <!-- /Icons Css -->

    <!-- Style Css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- /Style Css -->

    <!-- /All CSS -->

</head>

<body>
    <!-- Start Navbar Area -->
    <div class="navbar-area navbar-style-two">
        <div class="acavo-responsive-nav">
            <div class="container">
                <div class="acavo-responsive-menu">
                    <div class="logo">
                        <a href='index.html'>
                            <img src="images/logo.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="acavo-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class='navbar-brand' href='index.html'>
                        <h1>
                            ₹upee
                        </h1>
                    </a>


                </nav>
            </div>
        </div>

        <div class="others-option-for-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="inner">
                        <a href="index.html">
                            Register
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    <!-- End Navbar Area -->

    <!-- Hero -->
    <div class="hero-2">
        <div class="hero-2-item">
            <!-- Container -->
            <div class="container">
                <!-- row -->
                <div class="row align-items-center">
                    <!-- col -->
                    <div class="col-lg-6">
                        <div class="hero-2-content">
                            <div class="d-flex">
                                <div>
                                    <strong class="">₹upee:</strong><strong class="text-danger h1">
                                        <?php echo $session_user_name; ?></strong>
                                </div>

                            </div>
                            <div>
                                <?php
                                echo "Your account number: <strong class='h2 text-danger'>$session_account_number</strong><br>";
                                echo "Your account pin: <strong class='h2 text-danger'>$session_account_pin</strong><br>";
                                ?>
                            </div>

                        </div>
                    </div>
                    <!-- /col -->
                    <!-- col -->

                    <div class="col-lg-6">
                        <div class="hero-2-form">
                            <div class="content">
                                <h3>Login your account</h3>
                            </div>

                            <form action="login_function.php" method="post">
                                <!-- row -->
                                <div class="row">


                                    <!-- /col -->
                                    <!-- col -->
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Mail ID</label>
                                            <input type="text" value="<?php echo $email; ?>" name="email"
                                                class="form-control" placeholder="Mail ID">
                                        </div>
                                    </div>

                                    <!-- col -->
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="pass-1" class="form-control"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <!-- /col -->

                                    <!-- col -->
                                    <div class="col-md-12">
                                        <?php
                                        if (isset($_SESSION['error'])) {
                                            echo "<div class='error-message' style='color: red;'>" . $_SESSION['error'] . "</div>";
                                            unset($_SESSION['error']); // Clear the error message after displaying it
                                        }
                                        ?>
                                        <div class="hero-form-btn">
                                            <button type="submit" class="btn theme-btn-1 width-100">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /col -->
                                </div>
                                <!-- /row -->
                            </form>
                        </div>
                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
            <!-- /Container -->
        </div>
    </div>
    <!-- /Hero -->

    <!-- FAQ -->
    <div class="faq-area pt-100">
        <!-- Container -->
        <!-- Footer -->
        <footer class="footer-style bg-gray-100 ">
            <!-- Container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <a class='navbar-brand' href='index.html'>
                            <h1>
                                ₹upee
                            </h1>
                        </a>
                    </div>
                    <!-- /col -->
                    <!-- col -->
                    <div class="col-xl-9 col-lg-9  col-md-8 mb-30">
                        <div class="footer-top-wrapper">
                            <ul class="footer-top-link text-end">
                                <li>Copyrights-₹upee</li>
                            </ul>
                        </div>
                    </div>
                    <!-- /col -->
                    <!-- col -->
                </div>
                <!-- /row -->

                <!-- /Footer -->

                <!-- Go top -->

                <!-- /Go top -->

                <!-- JS -->

                <!-- Vendor Js -->
                <script src="js/vendors.js"></script>
                <!-- /Vendor js -->

                <!-- Plugins Js -->
                <script src="js/plugins.js"></script>
                <!-- /Plugins Js -->

                <!-- Main JS -->
                <script src="js/main.js"></script>
                <!-- /Main JS -->

                <!-- /JS -->
                <!-- /Container -->
            </div>
            <!-- /FAQ -->

            <!-- Cta -->

            <!-- /Cta -->



</body>


<!-- Mirrored from bnker.netlify.app/ltr/index-2 by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Aug 2024 03:10:39 GMT -->

</html>