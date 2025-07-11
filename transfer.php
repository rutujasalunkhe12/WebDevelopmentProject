<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}

require 'assets/autoloader.php';
require 'assets/db.php';
require 'assets/function.php';

if (!defined('BANKNAME')) {
    define('BANKNAME', 'Smart Bank');
}


$userId = $_SESSION['userId'];
$userDataQuery = $con->query("SELECT * FROM userAccounts WHERE id = '$userId'");
$userData = $userDataQuery->fetch_assoc();

$error = "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Funds Transfer | <?php echo BANKNAME; ?></title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
</head>

<body style="background: #ADD8E6; background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">
    <img src="images/sbi_logo.png" width="30" height="30" class="d-inline-block align-top" alt="SBI Logo">
    <?php echo BANKNAME; ?>
  </a>
</nav>
<br><br><br>

<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">Funds Transfer</div>
    <div class="card-body">

      <!-- Transfer Form -->
      <form method="POST">
        <div class="alert alert-success w-50 mx-auto">
          <h5>New Transfer</h5>
          <input type="text" name="otherNo" class="form-control" placeholder="Enter Receiver Account number" required>
          <button type="submit" name="get" class="btn btn-primary btn-block btn-sm my-1">Get Account Info</button>
        </div>
      </form>

      <?php 
      if (isset($_POST['get'])) {
          $receiverNo = $con->real_escape_string($_POST['otherNo']);
          $array2 = $con->query("SELECT * FROM otheraccounts WHERE accountNo = '$receiverNo'");
          $array3 = $con->query("SELECT * FROM userAccounts WHERE accountNo = '$receiverNo'");

          if ($array2->num_rows > 0) {
              $row2 = $array2->fetch_assoc();
              echo "
              <div class='alert alert-success w-50 mx-auto'>
                <form method='POST'>
                  <input type='hidden' name='sourceNo' value='{$userData['accountNo']}'>
                  Account No.
                  <input type='text' value='{$row2['accountNo']}' name='otherNo' class='form-control' readonly required>
                  Account Holder Name.
                  <input type='text' class='form-control' value='{$row2['holderName']}' readonly required>
                  Account Holder Bank Name.
                  <input type='text' class='form-control' value='{$row2['bankName']}' readonly required>
                  Enter Amount for transfer.
                  <input type='number' name='amount' class='form-control' min='1' max='{$userData['balance']}' required>
                  <button type='submit' name='transfer' class='btn btn-primary btn-block btn-sm my-1'>Transfer</button>
                </form>
              </div>";
          } elseif ($array3->num_rows > 0) {
              $row2 = $array3->fetch_assoc();
              echo "
              <div class='alert alert-success w-50 mx-auto'>
                <form method='POST'>
                  <input type='hidden' name='sourceNo' value='{$userData['accountNo']}'>
                  Account No.
                  <input type='text' value='{$row2['accountNo']}' name='otherNo' class='form-control' readonly required>
                  Account Holder Name.
                  <input type='text' class='form-control' value='{$row2['name']}' readonly required>
                  Account Holder Bank Name.
                  <input type='text' class='form-control' value='" . BANKNAME . "' readonly required>
                  Enter Amount for transfer.
                  <input type='number' name='amount' class='form-control' min='1' max='{$userData['balance']}' required>
                  <button type='submit' name='transferSelf' class='btn btn-primary btn-block btn-sm my-1'>Transfer</button>
                </form>
              </div>";
          } else {
              echo "<div class='alert alert-danger w-50 mx-auto'>Account No. {$_POST['otherNo']} does not exist.</div>";
          }
      }

      
      if (isset($_POST['transferSelf']) || isset($_POST['transfer'])) {
          $amount = (int) $_POST['amount'];
          $receiverNo = $con->real_escape_string($_POST['otherNo']);
          $sourceNo = $con->real_escape_string($_POST['sourceNo']);

          if ($amount > $userData['balance']) {
              echo "<div class='alert alert-danger'>Insufficient balance.</div>";
          } else {
              // Deduct from sender
              setBalance($amount, 'debit', $sourceNo);

              // Credit to receiver
              if (isset($_POST['transferSelf'])) {
                  setBalance($amount, 'credit', $receiverNo);
              } else {
                  setOtherBalance($amount, 'credit', $receiverNo);
              }

              // Log transaction
              makeTransaction('transfer', $amount, $receiverNo);

              echo "<script>alert('Transfer Successful'); window.location.href='transfer.php';</script>";
          }
      }

      
      $array = $con->query("SELECT * FROM transaction WHERE userId = '{$userData['id']}' AND action = 'transfer' ORDER BY date DESC");
      if ($array->num_rows > 0) {
          echo "<hr><h5 class='text-center'>Transfer History</h5>";
          while ($row = $array->fetch_assoc()) {
              echo "<div class='alert alert-warning'>₹{$row['debit']} transferred on {$row['date']} to Account No. {$row['other']}</div>";
          }
      } else {
          echo "<div class='alert alert-info text-center'>You have made no transfers yet.</div>";
      }
      ?>
    </div>

    <div class="card-footer text-muted text-center">
      <?php echo BANKNAME; ?>
    </div>
  </div>
</div>
</body>
</html>
