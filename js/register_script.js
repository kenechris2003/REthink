
document.getElementById("register").addEventListener("submit", function(event) {
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username === "") {
        alert("Username must be filled out");
        return false;
    }

    if (password === "") {
        alert("Password must be filled out");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return false;
    }

    if (!password.match(/^(?=.*[a-zA-Z])(?=.*[0-9])/)) {
        alert("Password must contain at least one number and one letter");
        return false;
    }

    var form = event.target;
    var formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "exists") {
            alert("Username already exists. Please log in.");
            window.location.href = "../php/login_page.php";
        } else if (data.status === "success") {
            alert("Registration successful!");
            window.location.href = "../php/home_logged_in.php";
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});



