<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - City Management System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .wrapper {
      position: relative;
      width: 380px;
      background: white;
      border-radius: 18px;
      padding: 40px 30px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .wrapper::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg,
          transparent,
          rgba(255, 255, 255, 0.2));
      transform: translateX(-100%);
      transition: 0.5s;
    }

    .wrapper:hover::before {
      transform: translateX(100%);
    }

    .wrapper h2 {
      text-align: center;
      color: #333;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 30px;
      position: relative;
    }

    .wrapper h2::after {
      content: "";
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 3px;
    }

    .input-field {
      position: relative;
      margin-bottom: 20px;
    }

    .input-field input {
      width: 100%;
      padding: 15px 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      outline: none;
      transition: 0.3s;
    }

    .input-field input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .input-field label {
      position: absolute;
      top: 15px;
      left: 20px;
      color: #777;
      font-size: 16px;
      pointer-events: none;
      transition: 0.3s;
    }

    .input-field input:focus+label,
    .input-field input:valid+label {
      top: -10px;
      left: 15px;
      font-size: 12px;
      background: white;
      padding: 0 5px;
      color: #667eea;
    }

    .forget {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 15px 0 25px;
      font-size: 14px;
    }

    .forget label {
      display: flex;
      align-items: center;
      color: #555;
      cursor: pointer;
    }

    .forget input {
      margin-right: 8px;
      accent-color: #667eea;
    }

    .forget a {
      color: #667eea;
      text-decoration: none;
      transition: 0.3s;
    }

    .forget a:hover {
      text-decoration: underline;
      color: #764ba2;
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .register {
      text-align: center;
      margin-top: 25px;
      font-size: 14px;
      color: #555;
    }

    .register a {
      color: #667eea;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }

    .register a:hover {
      text-decoration: underline;
      color: #764ba2;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal.active {
      display: flex;
      opacity: 1;
    }

    .modal-content {
      background: white;
      padding: 30px;
      border-radius: 12px;
      width: 450px;
      max-width: 90%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      transform: translateY(-20px);
      transition: transform 0.3s ease;
    }

    .modal.active .modal-content {
      transform: translateY(0);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .modal-header h3 {
      font-size: 22px;
      color: #333;
      font-weight: 600;
    }

    .close-btn {
      background: none;
      border: none;
      font-size: 24px;
      color: #777;
      cursor: pointer;
      transition: 0.3s;
    }

    .close-btn:hover {
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #555;
      font-size: 14px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      transition: 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
      outline: none;
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }

    .modal-footer button {
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      margin-left: 10px;
    }

    .cancel-btn {
      background: #f1f1f1;
      color: #555;
    }

    .cancel-btn:hover {
      background: #e0e0e0;
    }

    .role-selector {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }

    .role-option {
      flex: 1;
      text-align: center;
    }

    .role-option input[type="radio"] {
      display: none;
    }

    .role-option label {
      display: block;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .role-option input[type="radio"]:checked+label {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-color: #667eea;
    }

    .password-strength {
      margin-top: 5px;
      height: 5px;
      background: #f1f1f1;
      border-radius: 3px;
      overflow: hidden;
    }

    .strength-meter {
      height: 100%;
      width: 0%;
      transition: width 0.3s, background 0.3s;
    }

    @media (max-width: 480px) {
      .wrapper {
        width: 90%;
        padding: 30px 20px;
      }

      .modal-content {
        width: 90%;
      }

      .role-selector {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <form action="login.php" method="POST">
      <h2>ADMIN</h2>

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