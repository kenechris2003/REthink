document.addEventListener("DOMContentLoaded", function() {
    const paymentForm = document.getElementById("payment-form");

    paymentForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const cardNumber = document.getElementById("card-number").value;
        const expiryDate = document.getElementById("expiry-date").value;
        const cvv = document.getElementById("cvv").value;

        if (validateCardNumber(cardNumber) && validateExpiryDate(expiryDate) && validateCVV(cvv)) {
            paymentForm.submit();
        } else {
            alert("Please enter valid payment details.");
        }
    });

    function validateCardNumber(cardNumber) {
        const regex = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
        return regex.test(cardNumber);
    }

    function validateExpiryDate(expiryDate) {
        const currentDate = new Date();
        const selectedDate = new Date(expiryDate);
        return selectedDate > currentDate;
    }

    function validateCVV(cvv) {
        const regex = /^\d{3,4}$/;
        return regex.test(cvv);
    }
});