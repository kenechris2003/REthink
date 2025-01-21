document.getElementById("login").addEventListener("submit", function(event) {
    event.preventDefault();

    var form = event.target;
    var formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "userFound"){
            alert("Login successful!");
            window.location.href = "../php/home_logged_in.php";
        } else if(data.status === "invalid_data"){
            alert("Invalid Username or Password");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });

});