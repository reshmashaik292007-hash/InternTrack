// InternLink JavaScript

document.addEventListener("DOMContentLoaded", function () {
    console.log("InternLink Loaded Successfully!");

    // Highlight active navigation link
    const currentPage = window.location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
        const href = link.getAttribute("href");
        if (href === currentPage) {
            link.classList.add("active");
        }
    });

    // Simple form validation
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            const requiredFields = form.querySelectorAll("input[required], textarea[required]");

            let valid = true;

            requiredFields.forEach(field => {
                if (field.value.trim() === "") {
                    valid = false;
                    field.classList.add("is-invalid");
                } else {
                    field.classList.remove("is-invalid");
                }
            });

            if (!valid) {
                e.preventDefault();
                alert("Please fill all required fields.");
            }
        });
    });

    // Confirm logout
    const logoutLinks = document.querySelectorAll('a[href="login.php"]');

    logoutLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            if (!confirm("Are you sure you want to logout?")) {
                e.preventDefault();
            }
        });
    });
});