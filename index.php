<?php
require 'autoload.php';
require 'db_connect.php';

use App\Models\Admin;
use App\Models\RegularUser;
use App\Services\AuthService;
use App\Services\DatabaseService;

// Create DatabaseService
$dbService = new DatabaseService($pdo);

// Register users only if they don't exist yet
if (!$dbService->getUserByEmail("alice@example.com")) {
    $dbService->registerUser("Alice", "alice@example.com", "admin123", "admin");
}
if (!$dbService->getUserByEmail("bob@example.com")) {
    $dbService->registerUser("Bob", "bob@example.com", "user123", "regular");
}

// Fetch and display all users
$users = $dbService->getAllUsers();
echo "<h2>Registered Users:</h2>";
foreach ($users as $user) {
    echo "Name: " . $user['name'] . " | Email: " . $user['email'] . " | Role: " . $user['role'] . "<br>";
}

// Test OOP login
$admin = new Admin("Alice", "alice@example.com", "admin123");
$user = new RegularUser("Bob", "bob@example.com", "user123");
$authService = new AuthService();

echo "<h2>Login Test:</h2>";
echo $authService->authenticate($admin, "alice@example.com", "admin123") . "<br>";
echo $authService->authenticate($user, "bob@example.com", "user123") . "<br>";
echo $admin->logout();
?>
