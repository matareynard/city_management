<?php
require_once '../database/database.php'; // Adjust path if needed

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $role = trim($_POST['role']);

  if (empty($name) || empty($email) || empty($username) || empty($password) || empty($role)) {
    echo json_encode([
      'success' => false,
      'message' => 'All fields are required.'
    ]);
    exit;
  }

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $db = new Database();
  $conn = $db->connect();

  try {
    // Check if email or username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email OR username = :username LIMIT 1");
    $stmt->execute([
      'email' => $email,
      'username' => $username
    ]);
    if ($stmt->fetch()) {
      echo json_encode([
        'success' => false,
        'message' => 'Email or username already registered.'
      ]);
      exit;
    }

    // Insert new user
    $stmt = $conn->prepare("
            INSERT INTO users (name, email, username, password_hash, role, status, created_at)
            VALUES (:name, :email, :username, :password_hash, :role, 'active', NOW())
        ");
    $stmt->execute([
      'name' => $name,
      'email' => $email,
      'username' => $username,
      'password_hash' => $hashedPassword,
      'role' => $role
    ]);

    echo json_encode([
      'success' => true,
      'message' => 'Registration successful.'
    ]);
  } catch (PDOException $e) {
    error_log("Registration Error: " . $e->getMessage());
    echo json_encode([
      'success' => false,
      'message' => 'An error occurred. Please try again later.'
    ]);
  }
} else {
  // Method not allowed
  http_response_code(405);
  echo json_encode([
    'success' => false,
    'message' => 'Method Not Allowed'
  ]);
}

header("Location: index.php");
exit;
