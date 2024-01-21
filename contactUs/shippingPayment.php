<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>DELIVERY AND PAYMENT</title>
    <style>
        .container h1 {
            text-align: center;
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .textDecreption {
            animation: fadeIn 0.8s ease-out;
        }

        .contact-info {
            margin-top: 20px;
        }

        .bank-info {
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .container img {
            width: 20%;
            text-align: center;

        }
    </style>
</head>

<body>
    <?php include '../home/navbar.php'; ?>

    <div class="wrapper container-fluid">
        <div class="container col-inner textDecreption">

            <h1 class="my-3">DELIVERY AND PAYMENT</h1>

            <h3 class="my-3">Delivery information</h3>

            <p><strong>Within Hanoi City:</strong></p>
            <ul>
                <li>We guarantee timely and secure transportation and delivery of goods within Hanoi City.</li>
                <li>Shipping and delivery fees range from $3 to $10, depending on the location.</li>
                <li>Free shipping may be applicable for multiple products.</li>
                <li>Our delivery staff will proactively contact customers in advance to schedule delivery.</li>
                <li>We ensure that goods are delivered safely in their original packaging.</li>
            </ul>

            <p><strong>Shipping to Other Provinces and Cities:</strong></p>
            <ul>
                <li>Upon packaging, customers will receive a bill of lading code for easy tracking.</li>
                <li>Shipping costs vary between $10 and $20, depending on the size of the shipment.</li>
                <li>Our delivery staff will communicate with customers to arrange a convenient delivery schedule.</li>
                <li>We guarantee the safe delivery of goods in their original packaging.</li>
            </ul>
            <p>For any inquiries or further assistance regarding shipping, feel free to reach out to our OceanGate Customer Care Center. Your satisfaction and the safety of your deliveries are our top priorities.</p>
            <h3 class="my-3">Payment Information</h3>

            <p><strong>Payment via bank account:</strong></p>
            <p>If you prefer to make payment first and receive the goods later, kindly transfer the payment to the following bank account:</p>

            <div class="bank-info">
                <p><strong>Bank Account:</strong> 19036828310118 <strong>TECHCOMBANK</strong></p>
            </div>
            <div>
                <p>Or, you can use the provided<strong> QR</strong> Code:</p>
                <img src="../Photos/Logo/QR.jpg" alt="OceanGate Technology" class="col-lg-6 mx-auto d-block my-3 textDecreption">
            </div>

            <p><strong><span style="color: #dc3545; font-style: italic;">Note:</span></strong> Any account not updated above is void for payment.</p>

            <div class="contact-info">
                <p>Please notify us by phone at <strong>1800 1141</strong> after a successful transfer to confirm your payment. Your prompt confirmation allows us to efficiently process your order and ensures a smooth transaction. If you have any questions or require further assistance, feel free to contact the OceanGate Customer Care Center. Thank you for choosing OceanGate!</p>
            </div>
        </div>
    </div>
    <?php include "../home/footer.html" ?>
</body>

</html>
