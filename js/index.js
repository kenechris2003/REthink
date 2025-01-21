document.addEventListener("DOMContentLoaded", function() {
    fetch('php/get_items.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                var select = document.getElementById("item");
                data.items.forEach(function(item) {
                    var option = document.createElement("option");
                    option.value = item;
                    option.textContent = item;
                    select.appendChild(option);
                });
            } else {
                console.error("Error fetching items: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
});

document.getElementById("item-request").addEventListener("submit", function(event) {
    event.preventDefault();

    var form = event.target;
    var formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var resultDiv = document.getElementById("price-result");
        var amount = parseInt(document.getElementById("quantity").value);
        if (data.status === "success") {
            resultDiv.innerHTML = "The price of " + (amount) + " "+ (data.item) + "(s) is $" + (amount)*(data.price);
        } else {
            resultDiv.innerHTML = "Error: " + data.message;
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});





