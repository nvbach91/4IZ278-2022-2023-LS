<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="styles/payment_style.css">
    
</head>
<body>
<?php
session_start();


if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
   
    header('Location: login.html');
    exit();
}
?>
<div class="container">
    <a class="back-button" href="shopping_cart.php">Back</a>
    <h1>Payment</h1>

    <div class="payment-form">
        <form action="confirm_order.php" method="POST">
            <div class="form-field">
                <label for="card_number">Credit Card Number:</label>
                <input type="text" id="card_number" name="card_number" pattern="[0-9]{13,19}" required>
                <div class="error-message">Please enter a valid credit card number.</div>
            </div>
            <div class="form-field">
                <label for="expiry_date">Expiration Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" placeholder="MM/YY" required>
                <div class="error-message">Please enter a valid expiration date (MM/YY).</div>
            </div>
            <div class="form-field">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" pattern="[0-9]{3}" required>
                <div class="error-message">Please enter a valid CVV (3 digits).</div>
            </div>
            <div class="form-field">
                <label for="address">Shipping Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="form-field">
                <input type="submit" value="Buy">
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript validation
    const form = document.querySelector('.payment-form');
    const cardNumberInput = document.getElementById('card_number');
    const expiryDateInput = document.getElementById('expiry_date');
    const cvvInput = document.getElementById('cvv');

    form.addEventListener('submit', (event) => {
        let hasErrors = false;

        
        if (!validateCardNumber(cardNumberInput.value)) {
            hasErrors = true;
            showError(cardNumberInput);
        } else {
            hideError(cardNumberInput);
        }

      
        if (!validateExpiryDate(expiryDateInput.value)) {
            hasErrors = true;
            showError(expiryDateInput);
        } else {
            hideError(expiryDateInput);
        }

       
        if (!validateCVV(cvvInput.value)) {
            hasErrors = true;
            showError(cvvInput);
        } else {
            hideError(cvvInput);
        }

        if (hasErrors) {
            event.preventDefault();
        }
    });

    function showError(input) {
        input.classList.add('error');
        input.nextElementSibling.style.display = 'block';
    }

    function hideError(input) {
        input.classList.remove('error');
        input.nextElementSibling.style.display = 'none';
    }

    function validateCardNumber(cardNumber) {
        const regex = /^[0-9]{13,19}$/;
        return regex.test(cardNumber);
    }

    function validateExpiryDate(expiryDate) {
        const regex = /^(0[1-9]|1[0-2])\/[0-9]{2}$/;
        return regex.test(expiryDate);
    }

    function validateCVV(cvv) {
        const regex = /^[0-9]{3}$/;
        return regex.test(cvv);
    }
</script>
</body>
</html>
