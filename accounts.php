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


$userId = $_SESSION['userId'];
$query = $con->query("SELECT ua.*, b.branchName, b.branchNo 
                      FROM userAccounts ua 
                      JOIN branch b ON ua.branch = b.branchId 
                      WHERE ua.id = '$userId'");
$userData = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo BANKNAME; ?> - Account Info</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item active"><a class="nav-link" href="accounts.php">Accounts</a></li>
      <li class="nav-item"><a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item"><a class="nav-link" href="transfer.php">Funds Transfer</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav>

<br><br><br>

<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Your Account Information
    </div>
    <div class="card-body">
      <table class="table table-striped table-dark w-75 mx-auto">
        <tr><td>Account No.</td><th><?php echo $userData['accountNo']; ?></th></tr>
        <tr><td>Branch</td><td><?php echo isset($userData['branchName']) ? $userData['branchName'] : 'Hinjewadi Pune'; ?></td></tr>
        <tr><td>Branch Code</td><td><?php echo isset($userData['branchNo']) ? $userData['branchNo'] : '1300201'; ?></td></tr>
        <tr><td>Account Type</td><td><?php echo $userData['accountType']; ?></td></tr>
        <tr><td>Account Created</td><td><?php echo $userData['date']; ?></td></tr>
      </table>
    </div>
    <div class="card-footer text-muted text-center">
      <?php echo BANKNAME; ?>
    </div>
  </div>
</div>

</body>
</html>
