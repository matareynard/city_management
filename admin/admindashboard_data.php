<?php
require_once '../database/Database.php';

$db = new Database();
$conn = $db->connect();

$tables = [
    'city_officials' => 'City Officials',
    'barangay_officials' => 'Barangay Officials',
    'residents' => 'Residents'
];

$stats = [];

foreach ($tables as $table => $label) {
    echo "<strong>Checking table:</strong> $table<br>";

    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM $table");
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC); // safer fetch
    print_r($row); // debug output

    $stats[$label] = $row['count'] ?? 0;
}
