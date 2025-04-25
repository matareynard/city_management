<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database/database.php';

    // Collect and sanitize input
    $fullname = trim($_POST["fullname"]);       // goes to 'name'
    $username = trim($_POST["username"]);       // goes to 'username'
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];

    // Basic validation
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "city_management");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check for duplicate username/email
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Username or email already exists.";
        $check->close();
        $conn->close();
        exit;
    }

    $check->close();

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $status = 'active';
    $barangay_id = null; // You can modify this if you're assigning barangay manually

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (name, email, username, password_hash, role, status, barangay_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $fullname, $email, $username, $hashed_password, $role, $status, $barangay_id);

    if ($stmt->execute()) {
        header("Location: ../log-in/login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
