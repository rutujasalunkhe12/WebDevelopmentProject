<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:login.php');
    exit;
}
require 'assets/autoloader.php';
require 'assets/db.php';
require 'assets/function.php';

define('BANKNAME', 'SBI Bank');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo BANKNAME; ?></title>
</head>

<body style="background: #ADD8E6; background-size: 100%">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
        <img src="images/sbi_logo.png" width="40" height="40" class="d-inline-block align-top" alt="SBI Logo">
        <strong><?php echo BANKNAME; ?></strong>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
            <li class="nav-item"><a class="nav-link" href="statements.php">Account Statements</a></li>
            <li class="nav-item"><a class="nav-link" href="transfer.php">Funds Transfer</a></li>
        </ul>
        <?php include 'sideButton.php'; ?>
    </div>
</nav>

<br><br><br>


<div class="row w-100">
    <div class="col" style="padding: 22px; padding-top: 0">
        <div class="jumbotron shadowBlack" style="padding: 25px; min-height: 241px; max-height: 241px">
            <h4 class="display-5">Welcome to <?php echo BANKNAME; ?></h4>
            <p class="lead alert alert-warning"><b>Latest Notification:</b>
                <?php 
                $array = $con->query("SELECT * FROM notice WHERE userId = '{$_SESSION['userId']}' ORDER BY date DESC");
                if ($array && $array->num_rows > 0) {
                    $row = $array->fetch_assoc();
                    echo $row['notice'];
                } else {
                    echo "<div class='alert alert-info'>Notice box empty</div>";
                }
                ?>
            </p>
        </div>

        
        <div id="carouselExampleIndicators" class="carousel slide my-2 rounded-1 shadowBlack" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="images/1.png" alt="First slide" style="max-height: 250px">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/2.png" alt="Second slide" style="max-height: 250px">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/3.png" alt="Third slide" style="max-height: 250px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    
    <div class="col">
        <div class="row" style="padding: 22px; padding-top: 0">
            <div class="col">
                <div class="card shadowBlack">
                    <img class="card-img-top" src="images/acount.jpg" style="max-height: 155px; min-height: 155px" alt="Account">
                    <div class="card-body">
                        <a href="accounts.php" class="btn btn-outline-success btn-block">Account Summary</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadowBlack">
                    <img class="card-img-top" src="images/transfer.png" alt="Transfer" style="max-height: 155px; min-height: 155px">
                    <div class="card-body">
                        <a href="transfer.php" class="btn btn-outline-success btn-block">Transfer Money</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 22px">
            <div class="col">
                <div class="card shadowBlack">
                    <img class="card-img-top" src="images/bell.gif" style="max-height: 155px; min-height: 155px" alt="Notice">
                    <div class="card-body">
                        <a href="notice.php" class="btn btn-outline-primary btn-block">Check Notification</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadowBlack">
                    <img class="card-img-top" src="images/contact.us.png" alt="Contact Us" style="max-height: 155px; min-height: 155px">
                    <div class="card-body">
                        <a href="feedback.php" class="btn btn-outline-primary btn-block">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
