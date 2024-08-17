<?php
require "db_connector.php";
session_start();

if(isset($_SESSION["name"])){
    $user_name = $_SESSION["name"];
    $sql_query = "SELECT * FROM `".$user_name."`";
    $result = $conn->prepare($sql_query);
    $result->execute();
    $results = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location:login.php");
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
                <div class="dot-menu">
                    <div class="inner">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->
    <div class="container-md mt-5">          
        <table class="table text-center table-dark table-hover">
            <thead>
                <tr>
                    <th>Transaction</th>
                    <th>Credit/Debit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($results) > 0) {
                    foreach($results as $row) {
                        $account = htmlspecialchars($row['account']);
                        $type = htmlspecialchars($row['type']);

                        echo "
                        <tr>
                            <td>$account</td>
                            <td>$type</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
   
</body>
</html>
