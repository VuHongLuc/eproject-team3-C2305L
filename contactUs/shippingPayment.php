<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>SHIPPING AND PAYMENT</title>
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

            <h1 class="my-5">SHIPPING AND PAYMENT</h1>

            <h3 class="my-3">Shipping</h3>

            <p><strong>Shipping with in Hanoi City:</strong></p>
            <ul>
                <li>We transport and deliver goods exactly on time, with absolute safety.</li>
                <li>Shipping and delivery fees range from 3$-10$, depending on location.</li>
                <li>Free shipping may be applicable for multiple products.</li>
                <li>Delivery staff will contact customers in advance to schedule delivery.</li>
                <li>We ensure that goods are delivered safely in their original packaging.</li>
            </ul>

            <p><strong>Shipping to other provinces and cities:</strong></p>
            <ul>
                <li>After packaging, we provide customers with a bill of lading code for tracking.</li>
                <li>Shipping costs range from 10$-20$, depending on size.</li>
                <li>Delivery staff will contact customers to schedule delivery.</li>
                <li>We ensure safe delivery in the original packaging.</li>
            </ul>

            <h3 class="my-3">Payment</h3>

            <p><strong>Payment via bank account:</strong></p>
            <p>In case the customer wants to pay first and receive the goods later, please transfer to the following bank account:</p>

            <div class="bank-info">
                <p><strong>Bank Account:</strong> 19036828310118 <strong>TECHCOMBANK</strong></p>
            </div>
            <div>
                <p>Or<strong> QR</strong> Code:</p>
                <img src="../Photos/Logo/QR.jpg" alt="OceanGate Technology" class="col-lg-6 mx-auto d-block my-3 textDecreption">
            </div>

            <p><strong><span style="color: #dc3545; font-style: italic;">Note:</span></strong> Any account not updated above is void for payment.</p>

            <div class="contact-info">
                <p>Please notify us by phone at <strong>1800 1141</strong> after a successful transfer to confirm.</p>
            </div>
        </div>
    </div>
    <?php include "../home/footer.html" ?>
</body>

</html>