
  // Modal functionality
  const registerLink = document.getElementById("register-link");
  const registerModal = document.getElementById("register-modal");
  const closeModal = document.getElementById("close-modal");
  const cancelRegister = document.getElementById("cancel-register");

  registerLink.addEventListener("click", (e) => {
    e.preventDefault();
    registerModal.classList.add("active");
    document.body.style.overflow = "hidden";
  });

  closeModal.addEventListener("click", () => {
    registerModal.classList.remove("active");
    document.body.style.overflow = "auto";
  });

  cancelRegister.addEventListener("click", () => {
    registerModal.classList.remove("active");
    document.body.style.overflow = "auto";
  });

  // Close modal when clicking outside
  registerModal.addEventListener("click", (e) => {
    if (e.target === registerModal) {
      registerModal.classList.remove("active");
      document.body.style.overflow = "auto";
    }
  });

  // Password strength checker
  function checkPasswordStrength(password) {
    const strengthMeter = document.getElementById("strength-meter");
    let strength = 0;

    if (password.length >= 8) strength += 1;
    if (password.length >= 12) strength += 1;
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
    if (password.match(/([0-9])/)) strength += 1;
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;

    const width = strength * 20;
    let color = "#ff0000"; // red

    if (strength > 1 && strength <= 3) {
      color = "#ffa500"; // orange
    } else if (strength > 3) {
      color = "#00b500"; // green
    }

    strengthMeter.style.width = `${width}%`;
    strengthMeter.style.background = color;
  }

  // Form submission with AJAX
  const registerForm = document.getElementById("register-form");

  registerForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get form values
    const fullname = document.getElementById("fullname").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const username = document.getElementById("username").value.trim();
    const confirmPassword = document.getElementById("confirm-password").value;
    const role = document.querySelector('input[name="role"]:checked').value;

    // Validation
    if (password.length < 8) {
      alert("Password must be at least 8 characters long!");
      return;
    }

    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      return;
    }

    if (!email.includes("@") || !email.includes(".")) {
      alert("Please enter a valid email address!");
      return;
    }

    // Prepare form data
    const formData = new FormData();
    formData.append("fullname", fullname);
    formData.append("email", email);
    formData.append("username", username);
    formData.append("password", password);
    formData.append("role", role);

    // Send data to server
    fetch("register.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(`Registration successful! You have been registered as ${role}.`);
          // Close modal, reset form
          registerModal.classList.remove("active");
          document.body.style.overflow = "auto";
          registerForm.reset();
          document.getElementById("strength-meter").style.width = "0%";
          // Optionally redirect
          window.location.href = "login.html";
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An unexpected error occurred. Please try again.");
      });
  });

