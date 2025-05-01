<!-- <?php include 'admindashboard_data.php'; ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>City Management Dashboard</title>

  <!-- Style & Icons -->
  <link rel="stylesheet" href="admindashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

  <!-- Leaflet Map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body>

  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="admindashboard.php"><i class="fa fa-chart-line"></i> Dashboard</a>
    <a href="manage users/manageusers.php"><i class="fa fa-users"></i> Manage Users</a>
    <a href="#"><i class="fa fa-map-marker-alt"></i> Barangays</a>
    <a href="#"><i class="fa fa-file-alt"></i> Reports</a>
    <a href="#"><i class="fa fa-cog"></i> Settings</a>
    <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="main">
    <div class="header">
      <h1>Welcome, Admin</h1>
      <button class="btn-new-report">New Report</button>
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

</body>

</html>