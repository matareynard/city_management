// Modal open trigger
const registerLink = document.getElementById("register-link");
const registerModal = document.getElementById("register-modal");

registerLink.addEventListener("click", (e) => {
  e.preventDefault();
  registerModal.classList.add("active");
  document.body.style.overflow = "hidden";
});
