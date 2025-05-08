<?php
require_once '../city_management/database/database.php'; // Adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['fullname']); // updated here
  $email = trim($_POST['email']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $role = trim($_POST['role']);

  if (empty($name) || empty($email) || empty($username) || empty($password) || empty($role)) {
    die('All fields are required.');
  }

  // Hash the password
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
      die('Email or username already registered.');
    }

    // Insert the new user
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

    echo "Registration successful!";
  } catch (PDOException $e) {
    error_log("Registration Error: " . $e->getMessage());
    echo "An error occurred. Please try again later.";
  }
}
