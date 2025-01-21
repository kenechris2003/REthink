document.addEventListener("DOMContentLoaded", function() {
    const itemContainer = document.getElementById("item-container");
    const profileIcon = document.getElementById("profile-icon");
    const menuIcon = document.getElementById("menu-icon");
    const nav = document.querySelector("nav");

    // Check if user is logged in
    fetch('php/check_login.php')
        .then(response => response.json())
        .then(data => {
            if (data.logged_in) {
                profileIcon.style.display = 'block';
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });

    // Fetch items from the database
    fetch('php/get_items.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                data.items.forEach(item => {
                    const itemDiv = document.createElement("div");
                    itemDiv.classList.add("item");
                    itemDiv.innerHTML = `
                        <img src="${item.image_url}" alt="${item.name}">
                        <h3>${item.name}</h3>
                        <p>Price: $${item.price}</p>
                    `;
                    itemDiv.addEventListener("click", () => {
                        window.location.href = `php/add_to_cart.php?item=${item.name}&price=${item.price}`;
                    });
                    itemContainer.appendChild(itemDiv);
                });
            } else {
                console.error("Error fetching items: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });

    // Slider functionality
    let scrollAmount = 0;
    const scrollStep = 200;
    const scrollInterval = setInterval(() => {
        itemContainer.scrollBy({ left: scrollStep, behavior: 'smooth' });
        scrollAmount += scrollStep;
        if (scrollAmount >= itemContainer.scrollWidth - itemContainer.clientWidth) {
            scrollAmount = 0;
            itemContainer.scrollTo({ left: 0, behavior: 'smooth' });
        }
    }, 3000);

    // Menu toggle functionality
    menuIcon.addEventListener("click", () => {
        nav.classList.toggle("show");
    });
});