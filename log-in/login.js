// Modal open trigger
const registerLink = document.getElementById("register-link");
const registerModal = document.getElementById("register-modal");

registerLink.addEventListener("click", (e) => {
  e.preventDefault();
  registerModal.classList.add("active");
  document.body.style.overflow = "hidden";
});

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const errorBox = document.querySelector('.error-message');
        if (errorBox) errorBox.style.display = 'none';
    }, 4000);
});