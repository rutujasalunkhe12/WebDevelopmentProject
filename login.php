<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/function.php'; ?>

  <?php
  $con = new mysqli('localhost:3307', 'root', '', 'mybank');
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  define('BANKNAME', 'SBI Bank');
  $error = "";

  if (isset($_POST['userLogin'])) {
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $result = $con->query("SELECT * FROM userAccounts WHERE email='$user' AND password='$pass'");
    if ($result->num_rows > 0) {
      session_start();
      $data = $result->fetch_assoc();
      $_SESSION['userId'] = $data['id'];
      $_SESSION['user'] = $data;
      header('location:index.php');
    } else {
      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong. Try again!</div>";
    }
  }

  if (isset($_POST['cashierLogin'])) {
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $result = $con->query("SELECT * FROM login WHERE email='$user' AND password='$pass'");
    if ($result->num_rows > 0) {
      session_start();
      $data = $result->fetch_assoc();
      $_SESSION['cashId'] = $data['id'];
      header('location:cindex.php');
    } else {
      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong. Try again!</div>";
    }
  }

  if (isset($_POST['managerLogin'])) {
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $result = $con->query("SELECT * FROM login WHERE email='$user' AND password='$pass' AND type='manager'");
    if ($result->num_rows > 0) {
      session_start();
      $data = $result->fetch_assoc();
      $_SESSION['managerId'] = $data['id'];
      header('location:mindex.php');
    } else {
      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong. Try again!</div>";
    }
  }
  ?>

  <style>
    body {
      background: url('images/bg.png') no-repeat left center;
      background-size: cover;
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .header {
      background-color: #c0e4c4;
      padding: 20px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .header .logo-title {
      display: flex;
      align-items: center;
    }

    .header img {
      height: 50px;
      margin-right: 15px;
    }

    .header span.bank-name {
      font-size: 30px;
      font-weight: bold;
      color: #003366;
    }

    .presented-by {
      font-size: 18px;
      font-weight: bold;
      background: #343a40;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
    }

    .login-panel {
      position: absolute;
      top: 50%;
      left: 6%;
      transform: translateY(-50%);
      width: 400px;
    }

    .login-panel h4 {
      color: darkgreen;
      text-align: center;
      font-weight: bold;
      font-size: 28px;
      margin-bottom: 25px;
    }

    .card {
      margin-bottom: 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .card-body input {
      margin-bottom: 15px;
      font-size: 16px;
      padding: 12px;
    }

    .btn-block {
      font-size: 18px;
      padding: 10px;
    }
  </style>
</head>

<body>
  <div class="header">
    <div class="logo-title">
      <img src="images/sbi_logo.png" alt="SBI Logo">
      <span class="bank-name"><?php echo BANKNAME; ?></span>
    </div>
    <span class="presented-by">Presented by: Rutuja Salunkhe</span>
  </div>

  <?php echo $error; ?>

  <div class="login-panel">
    <h4>Select Your Session</h4>

    <!-- User Login -->
    <div class="card rounded-0">
      <div class="card-header">
        <a data-toggle="collapse" href="#userLoginCollapse">
          <button class="btn btn-outline-success btn-block">User Login</button>
        </a>
      </div>
      <div id="userLoginCollapse" class="collapse">
        <div class="card-body">
          <form method="POST">
            <input type="email" name="email" class="form-control" required placeholder="Enter Email">
            <input type="password" name="password" class="form-control" required placeholder="Enter Password">
            <button type="submit" class="btn btn-primary btn-block" name="userLogin">Enter</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Manager Login -->
    <div class="card rounded-0">
      <div class="card-header">
        <a class="collapsed" data-toggle="collapse" href="#managerLoginCollapse">
          <button class="btn btn-outline-success btn-block">Manager Login</button>
        </a>
      </div>
      <div id="managerLoginCollapse" class="collapse">
        <div class="card-body">
          <form method="POST">
            <input type="email" name="email" class="form-control" required placeholder="Enter Email">
            <input type="password" name="password" class="form-control" required placeholder="Enter Password">
            <button type="submit" class="btn btn-primary btn-block" name="managerLogin">Enter</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Cashier Login -->
    <div class="card rounded-0">
      <div class="card-header">
        <a class="collapsed" data-toggle="collapse" href="#cashierLoginCollapse">
          <button class="btn btn-outline-success btn-block">Cashier Login</button>
        </a>
      </div>
      <div id="cashierLoginCollapse" class="collapse">
        <div class="card-body">
          <form method="POST">
            <input type="email" name="email" class="form-control" required placeholder="Enter Email">
            <input type="password" name="password" class="form-control" required placeholder="Enter Password">
            <button type="submit" class="btn btn-primary btn-block" name="cashierLogin">Enter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
