<?php
session_start();
if(!isset($_SESSION['userId'])) {
  header('location:login.php');
  exit();
}

// ✅ Define bank name constant
define('BANKNAME', 'Smart Bank'); // Change this to your bank name
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
</head>

  <body style="background: #ADD8E6; background-size: 100%">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    
    <img src="images/sbi_logo.png" width="30" height="30" class="d-inline-block align-top" alt="SBI Logo">

    <?php echo BANKNAME; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="index.php">Home</a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">Accounts</a></li>
      <li class="nav-item active">  <a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav><br><br><br>

<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Transaction made against your account
    </div>
    <div class="card-body">
      <?php 
        $array = $con->query("SELECT * FROM transaction WHERE userId = '$userData[id]' ORDER BY date DESC");
        if ($array->num_rows > 0) {
          while ($row = $array->fetch_assoc()) {
            if ($row['action'] == 'withdraw') {
              echo "<div class='alert alert-secondary'>You withdrew Rs.{$row['debit']} from your account at {$row['date']}</div>";
            } elseif ($row['action'] == 'deposit') {
              echo "<div class='alert alert-success'>You deposited Rs.{$row['credit']} in your account at {$row['date']}</div>";
            } elseif ($row['action'] == 'deduction') {
              echo "<div class='alert alert-danger'>Deduction of Rs.{$row['debit']} from your account at {$row['date']} for {$row['other']}</div>";
            } elseif ($row['action'] == 'transfer') {
              echo "<div class='alert alert-warning'>Transferred Rs.{$row['debit']} from your account at {$row['date']} to account no. {$row['other']}</div>";
            }
          }
        } else {
          echo "<div class='alert alert-info'>No transactions found.</div>";
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