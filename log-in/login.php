<?php
session_start();
require_once '../database/database.php'; // adjust path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';

    if (empty($username) || empty($password) || empty($role)) {
        die('Please fill in all fields.');
    }
    $userFound = false;
    if (!$userFound) {
        $error = 'Invalid username, password, or role.';
    }
    $db = new Database();
    $conn = $db->connect();

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND role = :role AND status = 'active' LIMIT 1");
        $stmt->execute([
            'username' => $username,
            'role' => $role
        ]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Login successful, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($role) {
                case 'admin':
                    $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/city_management';
                    header("Location: $baseUrl/admin/admindashboard.html");
                    exit;
                case 'city_official':

                case 'barangay_official':

                default:
                    $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/city_management';
                    header("Location: $baseUrl/log-in/index.php");
                    exit;
            }
        }
    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
