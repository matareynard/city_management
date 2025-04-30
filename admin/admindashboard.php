<!-- <?php include 'admindashboard_data.php'; ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - City Management System</title>
  <link rel="stylesheet" href="admindashboard.css" />
</head>

<body>
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="admindashboard.php">Dashboard</a>
    <a href="manage users/manageusers.php">Manage Users</a>
    <a href="#">Barangays</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>
    <a href="#">Logout</a>
  </div>

  <div class="main">
    <div class="header">
      <h1>Welcome, Admin</h1>
    </div>

    <div class="cards">
      <div class="card">
        <h3>City Officials</h3>
        <p><?php echo $stats['City Officials']; ?></p>
      </div>
      <div class="card">
        <h3>Barangay Officials</h3>
        <p><?php echo $stats['Barangay Officials']; ?></p>
      </div>
      <div class="card">
        <h3>Residents</h3>
        <p><?php echo $stats['Residents']; ?></p>
      </div>
    </div>
  </div>
</body>

</html>