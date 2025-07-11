<?php 
// Define constant if needed
if (!defined('bankname')) {
	define('bankname', 'Smart Bank');
}

// All functions now use port 3307 and no password
function setBalance($amount, $process, $accountNo)
{
	$con = new mysqli('localhost', 'root', '', 'mybank', 3307);
	if ($con->connect_error) die("Connection failed: " . $con->connect_error);

	$array = $con->query("SELECT * FROM userAccounts WHERE accountNo='$accountNo'");
	$row = $array->fetch_assoc();

	$balance = ($process == 'credit') ? $row['balance'] + $amount : $row['balance'] - $amount;

	return $con->query("UPDATE userAccounts SET balance = '$balance' WHERE accountNo = '$accountNo'");
}

function setOtherBalance($amount, $process, $accountNo)
{
	$con = new mysqli('localhost', 'root', '', 'mybank', 3307);
	if ($con->connect_error) die("Connection failed: " . $con->connect_error);

	$array = $con->query("SELECT * FROM otheraccounts WHERE accountNo='$accountNo'");
	$row = $array->fetch_assoc();

	$balance = ($process == 'credit') ? $row['balance'] + $amount : $row['balance'] - $amount;

	return $con->query("UPDATE otheraccounts SET balance = '$balance' WHERE accountNo = '$accountNo'");
}

function makeTransaction($action, $amount, $other)
{
	if (!isset($_SESSION)) session_start();
	$con = new mysqli('localhost', 'root', '', 'mybank', 3307);
	if ($con->connect_error) die("Connection failed: " . $con->connect_error);

	$userId = $_SESSION['userId'];

	if ($action == 'transfer' || $action == 'withdraw') {
		return $con->query("INSERT INTO transaction (action, debit, other, userId) VALUES ('$action', '$amount', '$other', '$userId')");
	} elseif ($action == 'deposit') {
		return $con->query("INSERT INTO transaction (action, credit, other, userId) VALUES ('$action', '$amount', '$other', '$userId')");
	}
}

function makeTransactionCashier($action, $amount, $other, $userId)
{
	$con = new mysqli('localhost', 'root', '', 'mybank', 3307);
	if ($con->connect_error) die("Connection failed: " . $con->connect_error);

	if ($action == 'transfer' || $action == 'withdraw') {
		return $con->query("INSERT INTO transaction (action, debit, other, userId) VALUES ('$action', '$amount', '$other', '$userId')");
	} elseif ($action == 'deposit') {
		return $con->query("INSERT INTO transaction (action, credit, other, userId) VALUES ('$action', '$amount', '$other', '$userId')");
	}
}
?>
