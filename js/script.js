document.addEventListener("DOMContentLoaded", function() {
    const menuIcon = document.getElementById("menu-icon");
    const navLinks = document.getElementById("nav-links");
    const buyButton = document.getElementById("buy-button");
    const profileLink = document.getElementById("profile-link");

    // Menu toggle functionality
    menuIcon.addEventListener("click", () => {
        navLinks.classList.toggle("show");
    });

    // Check if user is logged in
    fetch('php/check_login.php')
        .then(response => response.json())
        .then(data => {
            if (data.logged_in) {
                profileLink.style.display = 'block';
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });

    // Buy button functionality
    buyButton.addEventListener("click", () => {
        fetch('php/check_login.php')
            .then(response => response.json())
            .then(data => {
                if (data.logged_in) {
                    window.location.href = 'checkout.php';
                } else {
                    window.location.href = 'login.html';
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");

    menuToggle.addEventListener("click", function() {
        navLinks.classList.toggle("show");
    });
});