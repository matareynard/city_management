<?php
session_start();
require_once '../database/database.php'; // adjust path

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
        // Find the user by username, role, and active status
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND role = :role AND status = 'active' LIMIT 1");
        $stmt->execute([
            'username' => $username,
            'role' => $role
        ]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Check if admin exists and redirect to the dashboard
            if ($role === 'admin') {
                // Check if there is at least one active admin
                $adminCheckStmt = $conn->prepare("SELECT * FROM users WHERE role = 'admin' AND status = 'active' LIMIT 1");
                $adminCheckStmt->execute();
                $admin = $adminCheckStmt->fetch();

                if ($admin) {
                    // Admin exists, login successful
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    header('Location: admindashboard.html');
                    exit;
                } else {
                    echo "No active admin found.";
                }
            } else {
                // Other role handling
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($role === 'resident') {
                    header('Location: user.html');
                } else if ($role === 'city_official') {
                    header('Location: cityofficial.html');
                } else if ($role === 'barangay_official') {
                    header('Location: barangayofficial.html');
                } else {
                    echo "Unknown role.";
                }
                exit;
            }
        } else {
            echo "Invalid credentials or role.";
        }
    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
