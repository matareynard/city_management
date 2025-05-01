<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>City Management Dashboard</title>

  <!-- Styles -->
  <link rel="stylesheet" href="admindashboard.css?v=1.2" />
  <link rel="stylesheet" href="admindashboard.css" />
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <!-- Sidebar -->
  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <!-- <img src="logo.png" alt=""> -->
        </span>
        <div class="text logo-text">
          <span class="name">Admin Panel</span>
          <span class="profession">City Admin</span>
        </div>
      </div>
      <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
      <div class="menu">
        <li class="search-box">
          <i class='bx bx-search icon'></i>
          <input type="text" placeholder="Search...">
        </li>
        <ul class="menu-links">
          <li class="nav-link"><a href="admindashboard.php"><i class='bx bx-home-alt icon'></i><span class="text nav-text">Dashboard</span></a></li>
          <li class="nav-link"><a href="manage users/manageusers.php"><i class='bx bx-user icon'></i><span class="text nav-text">Manage Users</span></a></li>
          <li class="nav-link"><a href="#"><i class='bx bx-map icon'></i><span class="text nav-text">Barangays</span></a></li>
          <li class="nav-link"><a href="#"><i class='bx bx-file icon'></i><span class="text nav-text">Reports</span></a></li>
          <li class="nav-link"><a href="#"><i class='bx bx-cog icon'></i><span class="text nav-text">Settings</span></a></li>
        </ul>
      </div>
      <div class="bottom-content">
        <li><a href="#"><i class='bx bx-log-out icon'></i><span class="text nav-text">Logout</span></a></li>
        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>
          <div class="toggle-switch"><span class="switch"></span></div>
        </li>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <section class="home">
    <div class="text">Welcome, Admin</div>
    <button class="btn-new-report">New Report</button>

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
  </section>
</body>

<!-- Sidebar JS -->
<script src="sidebar.js"></script>

</html>