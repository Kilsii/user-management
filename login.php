<?php
session_start();
require 'autoload.php';
require 'db_connect.php';

use App\Services\DatabaseService;

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbService = new DatabaseService($pdo);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $dbService->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        header('Location: profile.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>