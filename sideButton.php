<?php
// Ensure $userData is safely set from session
$userData = $_SESSION['user'] ?? null;
?>

<form class="form-inline my-2 my-lg-0">
    <?php if (isset($userData) && isset($userData['balance'])): ?>
        <a href="#" class="btn btn-outline-success" data-toggle="tooltip" title="Your current Account Balance">
            Account Balance : Rs. <?php echo $userData['balance']; ?>
        </a>
    <?php else: ?>
        <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title="Balance not available">
            Account Balance : Rs. 0.00
        </a>
    <?php endif; ?>

    <a href="accounts.php" data-toggle="tooltip" title="Account Summary" class="btn btn-outline-primary mx-1">
        <i class="fa fa-book fa-fw"></i>
    </a> 
    <a href="notice.php" data-toggle="tooltip" title="View Notice" class="btn btn-outline-primary mx-1">
        <i class="fa fa-envelope fa-fw"></i>
    </a> 
    <a href="feedback.php" data-toggle="tooltip" title="Help?" class="btn btn-outline-info mx-1">
        <i class="fa fa-question fa-fw"></i>
    </a> 
    <a href="logout.php" data-toggle="tooltip" title="Logout" class="btn btn-outline-danger mx-1">
        <i class="fa fa-sign-out fa-fw"></i>
    </a>    
</form>