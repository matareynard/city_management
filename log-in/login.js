document.addEventListener('DOMContentLoaded', () => {
    // Hide error after 4 seconds
    setTimeout(() => {
        const errorBox = document.querySelector('.error-message');
        if (errorBox) errorBox.style.display = 'none';
    }, 4000);

    // Modal open trigger
    const registerLink = document.getElementById("register-link");
    const registerModal = document.getElementById("register-modal");

    if (registerLink && registerModal) {
        registerLink.addEventListener("click", (e) => {
            e.preventDefault();
            registerModal.classList.add("active");
            document.body.style.overflow = "hidden";
        });
    }
});