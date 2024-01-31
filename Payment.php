<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
}

.payment-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.payment-container h2 {
    text-align: center;
    margin-bottom: 50px;
}

.amount-to-pay {
    text-align: center;
    margin-bottom: 50px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"] {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.card-details {
    display: flex;
    justify-content: space-between;
}

.card-details .expiry-date,
.card-details .cvv {
    flex: 1;
    margin-right: 10px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color:#36454F;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #F5B7B1  ;
}


    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Payment Information</h2>
        <div class="amount-to-pay">
            <p>Total Amount to Pay: $100.00</p>
        </div>
        <form>
            <label for="cardholder">Cardholder Name:</label>
            <input type="text" id="cardholder" name="cardholder" required>

            <label for="cardnumber">Card Number:</label>
            <input type="text" id="cardnumber" name="cardnumber" required>

            <div class="card-details">
                <div class="expiry-date">
                    <label for="expiry">Expiry Date:</label>
                    <input type="text" id="expiry" name="expiry" required placeholder="MM / YY">
                </div>
                <div class="cvv">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                </div>
            </div>

            <input type="submit" value="Pay Now">
        </form>
    </div>
    	
</body>
</html>

