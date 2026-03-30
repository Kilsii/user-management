<?php
session_start();
require 'autoload.php';
require 'db_connect.php';

use App\Services\DatabaseService;

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbService = new DatabaseService($pdo);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($dbService->getUserByEmail($email)) {
        $error = "Email already exists!";
    } else {
        $dbService->registerUser($name, $email, $password, 'regular');
        $success = "Registration successful! You can now login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register</h2>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>