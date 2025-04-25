<?php
require_once __DIR__ . '/../../database/database.php';

$db = new Database();
$conn = $db->connect();

$sql = "SELECT id, name, username, email, role, status, created_at FROM users";
$stmt = $conn->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($users) {
  foreach ($users as $user) {
    echo "<tr data-role='" . htmlspecialchars($user['role']) . "'>";
    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
    echo "<td>" . htmlspecialchars($user['name']) . "</td>";
    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
    echo "<td>" . htmlspecialchars($user['role']) . "</td>";
    echo "<td>" . htmlspecialchars($user['status']) . "</td>";
    echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
    echo "<td>
                <a href='edit_user.php?id=" . $user['id'] . "' class='btn-edit'>Edit</a>
                <a href='delete_user.php?id=" . $user['id'] . "' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
              </td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='8'>No users found.</td></tr>";
}
