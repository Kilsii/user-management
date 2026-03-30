<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Profile</title></head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
    <p><strong>Role:</strong> <?php echo $_SESSION['user_role']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
