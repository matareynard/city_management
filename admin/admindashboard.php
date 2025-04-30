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

    <!-- Section: Monthly Reports -->
    <div class="section">
      <h2>Monthly Report Overview</h2>
      <div class="chart-container">
        <canvas id="reportChart"></canvas>
      </div>
    </div>

    <!-- Section: Calendar -->
    <div class="section">
      <h2>City Events Calendar</h2>
      <div id="calendar"></div>
    </div>

    <!-- Section: Barangay Map -->
    <div class="section">
      <h2>Barangay Map Overview</h2>
      <div id="map"></div>
    </div>
  </div>

  <!-- Chart.js Script -->
  <script>
    const ctx = document.getElementById('reportChart').getContext('2d');
    const reportChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Reports',
          data: [22, 34, 18, 45, 60, 35],
          fill: true,
          backgroundColor: 'rgba(26, 188, 156, 0.2)',
          borderColor: '#1abc9c',
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  </script>

  <!-- FullCalendar Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [{
            title: 'Barangay Assembly',
            date: '2025-05-10'
          },
          {
            title: 'Cleanup Drive',
            date: '2025-05-14'
          }
        ]
      });
      calendar.render();
    });
  </script>

  <!-- Leaflet Map Script -->
  <script>
    const map = L.map('map').setView([14.5995, 120.9842], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([14.5995, 120.9842]).addTo(map)
      .bindPopup('City Hall - Admin Center')
      .openPopup();
  </script>

</body>

</html>