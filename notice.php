<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php'); }
define('BANKNAME', 'SBI Bank'); // ✅ Define the constant here
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
</head>

  <body style="background: #ADD8E6; background-size: 100%"></body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    
    <img src="images/sbi_logo.png" width="30" height="30" class="d-inline-block align-top" alt="SBI Logo">

    <?php echo BANKNAME; ?> 
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="index.php">Home</a>
      </li>
      <li class="nav-item">  
        <a class="nav-link" href="accounts.php">Accounts</a>
      </li>
      <li class="nav-item">  
        <a class="nav-link" href="statements.php">Account Statements</a>
      </li>
      <li class="nav-item">  
        <a class="nav-link" href="transfer.php">Funds Transfer</a>
      </li>
    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav>
<br><br><br>
<div class="container">
  <div class="card  w-75 mx-auto">
    <div class="card-header text-center">
      Notification from Bank
    </div>
    <div class="card-body">
      <?php 
        $array = $con->query("SELECT * FROM notice WHERE userId = '$_SESSION[userId]' ORDER BY date DESC");
        if ($array->num_rows > 0) {
          while ($row = $array->fetch_assoc()) {
            echo "<div class='alert alert-success'>{$row['notice']}</div>";
          }
        } else {
          echo "<div class='alert alert-info'>Notice box empty</div>";
        }
      ?>
    </div>
    <div class="card-footer text-muted">
      <?php echo BANKNAME; ?> 
    </div>
  </div>
</div>
</body>
</html>