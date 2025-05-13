<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - City Management System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link el="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="style.css?v=1.2" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
  </style>
</head>

<body>
  <div class="wrapper">
    <?php if (isset($error)): ?>
      <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <h2>ADMIN</h2>
      <input type="hidden" name="role" value="admin">
      <div class="input-field">
        <input type="text" name="username" required />
        <label>Enter your username</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required />
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember" />
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit">Log In</button>
      <div class="register">
        <p>
          Don't have an account?
          <a href="#" id="register-link">Register</a>
        </p>
      </div>
    </form>
  </div>

  <!-- Registration Modal -->
  <div class="modal" id="register-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Create New Account</h3>
        <button class="close-btn" id="close-modal">&times;</button>
      </div>
      <form id="register-form" action="register.php" method="POST">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            required
            oninput="checkPasswordStrength(this.value)" />
          <div class="password-strength">
            <div class="strength-meter" id="strength-meter"></div>
          </div>
          <small class="text-gray-500 text-xs">Password must be at least 8 characters</small>
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirm Password</label>
          <input
            type="password"
            id="confirm-password"
            name="confirm-password"
            required />
        </div>
        <div class="form-group">
          <label>Select Role</label>
          <div class="role-selector">
            <div class="role-option">
              <input
                type="radio"
                id="role-admin"
                name="role"
                value="admin"
                checked />
              <label for="role-admin">
                <i class="fas fa-user-shield mr-2"></i>Admin
              </label>
            </div>
            <div class="role-option">
              <input type="radio" id="role-user" name="role" value="user" />
              <label for="role-user">
                <i class="fas fa-user mr-2"></i>User
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="cancel-btn" id="cancel-register">
            Cancel
          </button>
          <button type="submit" class="register-btn">Register</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../log-in/login.js"></script>
  <script src="../log-in/register.js"></script>
</body>

</html>