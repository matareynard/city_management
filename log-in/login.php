<?php
session_start();
require_once '../database/database.php'; // Adjust path if needed

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';

    if (empty($username) || empty($password) || empty($role)) {
        $error = 'Please fill in all fields.';
    } else {
        $db = new Database();
        $conn = $db->connect();

        try {
            $checkStmt = $conn->query("SELECT COUNT(*) as count FROM users");
            $userCount = $checkStmt->fetch()['count'];

            if ($userCount == 0) {
                $error = "No user accounts are registered in the system.";
                error_log("Login attempt failed: users table is empty.");
            } else {
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND role = :role AND status = 'active' LIMIT 1");
                $stmt->execute([
                    'username' => $username,
                    'role' => $role
                ]);

                $user = $stmt->fetch();

                if (!$user) {
                    error_log("Login failed: No user found for username '{$username}' with role '{$role}'.");
                    $error = 'No account found with the provided username and role.';
                } elseif (!password_verify($password, $user['password_hash'])) {
                    error_log("Login failed: Incorrect password for username '{$username}'.");
                    $error = 'Incorrect password.';
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/city_management';

                    switch ($role) {
                        case 'admin':
                            header("Location: $baseUrl/admin/admindashboard.html");
                            exit;
                        case 'city_official':
                        case 'barangay_official':
                        default:
                            header("Location: $baseUrl/log-in/index.php");
                            exit;
                    }
                }
            }
        } catch (PDOException $e) {
            error_log("Login Error: " . $e->getMessage());
            $error = "An error occurred. Please try again later.";
        }
    }
}
