<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>SEND THE CONTACT</title>
    <style>
        .custom-button {
            background-color: #dc3545; 
            color: #fff; 
        }

        .custom-link {
            color: #007bff !important; 
            text-decoration: none !important; 
        }

        .short-input {
            width: 300px !important; 
            margin-bottom: 0px !important; 
        }
        .form-row {
            margin-bottom: 10px !important;
        }

        .form-row .form-group {
            margin-right: 10px !important;
        }

        /* Thêm đoạn CSS dưới đây để căn chỉnh bố cục */
        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        .contact-section {
            flex: 1;
            margin-right: 20px; /* Khoảng cách giữa SEND THE CONTACT và CONTACT INFO */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include '../home/navbar.html'; ?>
    <div class="container">
        <h2>SEND THE CONTACT</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $fullName = $_POST["fullName"];
            $phoneNumber = $_POST["phoneNumber"];
            $email = $_POST["email"];
            $title = $_POST["title"];
            $note = $_POST["note"];

            echo "<h3>CONTACT INFO</h3>";
            echo "<p><strong>Name:</strong> $fullName</p>";
            echo "<p><strong>Phone Number:</strong> $phoneNumber</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Title:</strong> $title</p>";
            echo "<p><strong>Note:</strong> $note</p>";

            exit;
        }
        ?>

        <div class="flex-container">
            <div class="contact-section">
                <form id="contactForm" method="post" action="index.php">
                    <input type="text" class="form-control short-input" id="fullName" placeholder="Full Name" name="fullName" required><br>
                    <input type="text" class="form-control short-input" id="phoneNumber" placeholder="Phone number" name="phoneNumber" required><br>
                    <input type="email" class="form-control short-input" id="email" placeholder="Email" name="email" required><br>
                    <input type="text" class="form-control short-input" placeholder="Title" name="title"><br>
                    <input type="text" class="form-control short-input" placeholder="Note" name="note"><br>
                    <button type="button" class="btn btn-danger" onclick="onSubmitForm()">SEND</button>
                </form>
            </div>

            <div class="contact-section">
                <h3>CONTACT INFO</h3>
                <p><strong>OCEANGATE GENUINE DISTRIBUTOR IN VIETNAM – VIETNAM IT TECHNOLOGY SERVICES AND TRADING COMPANY LIMITED</strong></p>
                <p><strong>Address:</strong> 3rd floor, 19 Le Thanh Nghi Street, Bach Mai Ward, Hai Ba Trung District, Ha Noi City</p>
                <p><strong>Hotline:</strong> 1800 1141</p>
                <p><strong>Website:</strong> oceangate.com.vn</p>
                <p><strong>Email:</strong> <a href="../index/index.php" class="custom-link bold-link">oceangate.com.vn@gmail.com</a></p>
            </div>
        </div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7402958370076!2d105.84755407564155!3d21.003044988660463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac748cd9d447%3A0xaf1371c17f07550c!2zMTkgUC4gTMOqIFRoYW5oIE5naOG7iywgQuG6oWNoIE1haSwgSGFpIELDoCBUcsawbmcsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1703469850204!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <?php include '../home/footer.html'; ?>
    <script>
    function onSubmitForm() {

        var fullName = document.getElementById('fullName').value;
        var phoneNumber = document.getElementById('phoneNumber').value;
        var email = document.getElementById('email').value;


        if (fullName === '' || phoneNumber === '' || email === '') {
            alert('Please fill in all required fields.');
        } else {
            alert('Information sent successfully!');
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
