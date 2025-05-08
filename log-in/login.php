<?php
session_start();
require_once '../city_management/database/database.php'; // adjust path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (empty($username) || empty($password) || empty($role)) {
        die('Please fill in all fields.');
    }

    $db = new Database();
    $conn = $db->connect();

    try {
        // Find the user by username and role
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND role = :role AND status = 'active' LIMIT 1");
        $stmt->execute([
            'username' => $username,
            'role' => $role
        ]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Login success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admindashboard.html');
            } else if ($user['role'] === 'resident') {
                header('Location: user.html');
            } else if ($user['role'] === 'city_official') {
                // Add a redirect if needed
                header('Location: cityofficial.html');
            } else if ($user['role'] === 'barangay_official') {
                // Add a redirect if needed
                header('Location: barangayofficial.html');
            } else {
                echo "Unknown role.";
            }
            exit;
        } else {
            echo "Invalid credentials or role.";
        }
    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
