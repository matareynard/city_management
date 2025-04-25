<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Users</title>
  <link rel="stylesheet" href="manageusers.css" />
</head>

<body>
  <div class="container">
    <h1>Manage Users</h1>

    <div class="filter-section">
      <label for="roleFilter">Filter by Role:</label>
      <select id="roleFilter">
        <option value="all">All</option>
        <option value="admin">Admin</option>
        <option value="city_official">City Official</option>
        <option value="barangay_official">Barangay Official</option>
        <option value="resident">Resident</option>
      </select>

      <a href="add_user.php" class="add-button">+ Add User</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="userTable">
        <?php include '../manage users/fetch_users.php'; ?>
      </tbody>
    </table>
  </div>

  <script>
    const filter = document.getElementById("roleFilter");
    const rows = document.querySelectorAll("#userTable tr");

    filter.addEventListener("change", function() {
      const selected = this.value;
      rows.forEach((row) => {
        const role = row.getAttribute("data-role");
        row.style.display =
          selected === "all" || selected === role ? "" : "none";
      });
    });
  </script>
</body>

</html>