<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "db_connector.php";

session_start(); // Start the session

$error_message = ''; // Initialize a variable to store the error message

if (isset($_SESSION['name'])) {
    $user_name = htmlspecialchars($_SESSION['name']); // Store the session name in a variable

    $account_balance = 0; // Initialize a variable to store the account balance

    if (isset($_POST['submit'])) {
        $account_number = $_POST["acc_num"];
        $account_pin = $_POST["pin"];

        $sql = "SELECT * FROM register_form WHERE account_number = :account_number";
        $statement = $conn->prepare($sql);
        $statement->execute(['account_number' => $account_number]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($account_pin == $result["account_pin"]) {
                $deposit_amount = (float) $_POST['deposit'];
                if ($deposit_amount > 0) {
                    $deposit = 'deposit';
                    
                    $fetch_past = "SELECT * FROM `$user_name` ORDER BY id DESC LIMIT 1";
                    $statement = $conn->prepare($fetch_past);
                    $statement->execute();
                    $row = $statement->fetch(PDO::FETCH_ASSOC);

                    $past_amount = $row ? (float) htmlspecialchars($row["account"]) : 0;
                    $new_balance = $past_amount + $deposit_amount;

                    $sql_deposit = "INSERT INTO `$user_name` (account, type) VALUES (:new_balance, :deposit)";
                    $statement_deposit = $conn->prepare($sql_deposit);
                    $statement_deposit->execute(['new_balance' => $new_balance, 'deposit' => $deposit]);

                    $account_balance = $new_balance;

                    header("Location: deposit.php");
                    exit;
                } else {
                    $error_message = "Invalid deposit amount.";
                }
            } else {
                $error_message = "Pin did not match.";
            }
        } else {
            $error_message = "No data found for this account number.";
        }
    } else {
        // Fetch the current balance to display if no deposit is made
        $fetch_balance = "SELECT * FROM `$user_name` ORDER BY id DESC LIMIT 1";
        $statement_balance = $conn->prepare($fetch_balance);
        $statement_balance->execute();
        $row_balance = $statement_balance->fetch(PDO::FETCH_ASSOC);

        if ($row_balance) {
            $account_balance = (float) htmlspecialchars($row_balance["account"]);
        }
    }
} else {
    // Redirect to login if session name is not set
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Meta and CSS links -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Banker - Banking and Loan HTML Templates</title>
    <link rel="stylesheet" href="css/vendors.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/style.css">
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
                        <h1>₹upee</h1>
                    </a>
                </nav>
            </div>
        </div>

        <div class="others-option-for-responsive">
            <div class="container">
                <div class="dot-menu d-flex">
                    <div class="inner p-3">
                        <a href="credit.php">Credit</a>
                    </div>
                    <div class="inner">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->

    <div class="hero-2">
        <div class="hero-2-item">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-2-content">
                            <div class="d-flex">
                                <?php
                                // Display the session name
                                echo "<div>Hello <strong class='h1'>" . $user_name . "</strong></div>";
                                ?>
                            </div>
                            <div>
                                <table class="table text-center table-dark table-hover">
                                    <?php
                                    // Display the account balance or message
                                    if ($account_balance > 0) {
                                        echo "<h6 class='mt-3'>Current account balance</h6><a href='transaction_details.php'><h1>" . $account_balance . "</h1></a>To view all transactions, click your current balance.";
                                    } else {
                                        echo "No data found";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-2-form">
                            <div class="content">
                                <h3>Deposit Amount</h3>
                            </div>
                            <form action="" method="post">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="number" name="acc_num" class="form-control"
                                                placeholder="Account Number" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Pin</label>
                                            <input type="number" name="pin" class="form-control" placeholder="Pin" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>deposit</label>
                                            <input type="number" name="deposit" class="form-control"
                                                placeholder="deposit" required>
                                        </div>
                                    </div>

                                    <!-- Display error message before the submit button -->
                                    <?php
                                    if (!empty($error_message)) {
                                        echo "<div class='col-lg-12 col-sm-12'><div class='alert alert-danger'>" . $error_message . "</div></div>";
                                    }
                                    ?>

                                    <div class="col-md-12">
                                        <div class="hero-form-btn">
                                            <button type="submit" name="submit"
                                                class="btn theme-btn-1 width-100">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-50"></div>
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
            

        <!-- JS -->
        <script src="js/vendors.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
</body>

</html>
