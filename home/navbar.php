<?php
session_start();
include("../db.php");
        // Khởi tạo 
        if (!isset($_SESSION['cartNumber'])) {
            $_SESSION['cartNumber'] = 0;
            $_SESSION['cartItem'] = [];
        }
       
    //Xử lý adđ to cart được nhấn
    if(isset($_POST['addToCart'])) {

        if (!isset($_SESSION['userName'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
            header("Location: ../login/login.php");
            exit(); 
        }else {
            $_SESSION['cartNumber']++;
            $userName = $_SESSION["userName"];
            $sqlUseerID = "SELECT userID FROM user WHERE userName = '$userName'";
            $resultUserID = $conn ->query($sqlUseerID);

            $userID = null;

                if ($resultUserID && $resultUserID->num_rows > 0) {
                    while ($row = $resultUserID->fetch_assoc()) {
                        
                        $userID = $row['userID'];
                    }

            $productCart = array(
                'productID' => $_POST['productID'],
                'productName' => $_POST['productName'],
                'imageLink' => $_POST['imageLink'],
                'quantity' => $_POST['quantity'],
                'unitPrice' => $_POST['unitPrice'],
                'userID' => $userID
            );

        //Check if the product is already in the cart, then increase the quantity in the cart, not add a new product
            
            $flag =true;
            foreach ($_SESSION['cartItem'] as &$item){
                if ($item['productID'] == $_POST['productID']){
                    $item['quantity'] += $_POST['quantity'];
                    $_SESSION['cartNumber']--;
                    $flag =false;
                }
            }
            if ($flag) {
                $_SESSION['cartItem'][] = $productCart;
                // insert to carts
              
            }
        }
    }
}

    // Khởi tạo biến numberCompare nếu chưa tồn tại
    if (!isset($_SESSION['numberCompare'])) {
        $_SESSION['numberCompare'] = 0;
        $_SESSION['compareItems'] = [];
    }

    // Xử lý khi nút "COMPARE" được nhấn
    if (isset($_POST['compareButton'])) {
        //Nếu số sản phẩm so sánh < 3
        if ($_SESSION['numberCompare'] < 3 ){
            $flag =true;
            //Khi sản phẩm đã có trong COMPARE rồi thì không thêm lại vào compare 1 lần nữa
            foreach ($_SESSION['compareItems'] as $item){
                if ($item['productID']==$_POST['productID']){
                    $flag =false;
                }
            };
            //sau khi thỏa mãn các điều kiện thì tiến hành thêm sản phẩm vào SESSION
            if ($flag){
                $_SESSION['numberCompare']++;

                $productCompare = array(
                    'productID' => $_POST['productID'],
                    'imageLink' => $_POST['imageLink'],
                    'productName' => $_POST['productName'],
                    'unitPrice' => $_POST['unitPrice'],
                    'categoryID' => $_POST['categoryID'],
                    'brandID' => $_POST['brandID'],
                    'memory' => $_POST['memory'],
                    'speed' => $_POST['speed'],
                    'color' => $_POST['color'],
                    'warranty' => $_POST['warranty'],
                    'dimension' => $_POST['dimension']
                );
                $_SESSION['compareItems'][] = $productCompare;
                    
            };
        };
    };
        //Nếu số sản phẩm so sánh >= 3 tiến hành show pop-up thông báo không cho thêm sản phẩm nữa
        echo "<div class='modal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h1 class='modal-title fs-5' id='staticBackdropLabel'>COMPARE</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
              You can only choose up to 3 products to compare!
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
              </div>
            </div>
          </div>
        </div>";
    //Xử lý việc sửa số lượng trong page CART thì sẽ thay đổi số lượng trong page CHECKOUT
        if (!isset($_SESSION['checkoutItems'])) {
            $_SESSION['checkoutItems'] = [];
        }
        
        if (isset($_POST["submitCheckout"])) {
            $_SESSION['checkoutItems'] = [];
            for ($i = 0; $i < count($_SESSION['cartItem']); $i++) {

                $checkoutItem = array(
                    "productID" => $_POST["productID$i"],
                    "productName" => $_POST["productName$i"],
                    "imageLink" => $_POST["imageLink$i"],
                    "quantity" => $_POST["quantity$i"],
                    "unitPrice" => $_POST["unitPrice$i"],
                    "userID" => $_POST["userID$i"]
                );
                // Xử lý việc trùng sản phẩm khi đã thêm vào checkout từ trước
                foreach ($_SESSION['checkoutItems'] as $key => &$item) {
                    if ($checkoutItem["productID"] == $item["productID"]) {
                        unset($_SESSION['checkoutItems'][$key]);
                    }
                }
                //Thêm sp vào SESSION
                $_SESSION['checkoutItems'][] = $checkoutItem;
            }
            header("Location: viewCheckout.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceangate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="fixed-top">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <a class="navbar-brand" href="../index/index.php">
                <img src="../Photos/Logo/logo.png" alt="Logo" width="125" height="75">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav m-auto font-size-25">
                    <li class="nav-item m-3">
                        <a class="nav-link fw-bold" href="../index/index.php">HOME</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link fw-bold" href="../contactUs/company.php">COMPANY</a>
                    </li>

                    <li class="nav-item  m-3 dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORIES
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownCate">
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=1">HDD</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=2">SSD</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=3">USB</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=4">Memory Card</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=5">RAM</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=6">Portable Hard
                                Driver</a>
                        </div>
                    </li>

                    <li class="nav-item  m-3 dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdownBrand"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            BRAND
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../listPage/viewListBrand.php?brand=1">Samsung</a>
                            <a class="dropdown-item" href="../listPage/viewListBrand.php?brand=2">WD</a>
                            <a class="dropdown-item" href="../listPage/viewListBrand.php?brand=3">Seagate</a>
                            <a class="dropdown-item" href="../listPage/viewListBrand.php?brand=4">Sandisk</a>
                            <a class="dropdown-item" href="../listPage/viewListBrand.php?brand=5">Kingston</a>
                            <a class="dropdown-item" href="../listPage/viewListBrand.php?brand=6">Transcend</a>
                        </div>
                    </li>

                    <li class="nav-item  m-3">
                        <a class="nav-link fw-bold" href="../contactUs/privacy.php">PRIVACY</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link fw-bold" href="../contactUs/shippingPayment.php">SHIPPING
                            PAYMENT</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link fw-bold" href="../contactUs/warrantyPolicy.php">WARRANTY</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link fw-bold" href="../news/news.php">NEWS</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link fw-bold" href="../contactUs/contact.php">CONTACT</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">

                        <!-- Search function -->

                        <form id="searchForm" onsubmit="redirectToSearch(); return false;" method="GET" class="d-flex">
                            <input class="form-control" type="text" id="searchInput" placeholder="Search for..."
                                oninput="searchProducts()">
                            <button type="submit" class="search-btn btn btn-outline-danger mx-1 my-0">
                                <i class="fa-solid fa-magnifying-glass" ></i>
                            </button>
                        </form>
                        <div id="searchResults"></div>
                        <!-- cart logo -->
                    </li>
                    <li class="nav-item">
                        <a href="../productDetail/viewCart.php" class="nav-link">
                            <span class="px-2 text-danger" id="logoCart">
                                <i class="fas fa-shopping-cart"></i>
                                <b class="text-center" id="numberCart">
                                    <?php echo $_SESSION['cartNumber']?>
                                </b>
                            </span>
                        </a>
                    </li>
                    <!-- compare logo -->
                    <li class="nav-item">
                        <a href="../compare/compare.php" class="nav-link">
                            <span class="px-2 text-success" id="logoCompare">
                                <i class="fa-solid fa-scale-balanced"></i>
                                <b class="text-center" id="numberCompare">
                                    <?php echo $_SESSION['numberCompare']?>
                                </b>
                            </span>
                        </a>
                    </li>

                </ul>

                <!-- User logo-->
                <ul class="navbar-nav m-lg-3">
                    <li class="nav-item dropdown">
                        <?php if(isset($_SESSION['userName'])){
                            echo "<li class='nav-item  m-3 dropdown'>
                            <a class='nav-link dropdown-toggle text-dark fw-bold' href='#' id='navbarDropdownBrand' role='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".
                            $_SESSION['userName'].
                            "</a>
                            <div class='dropdown-menu' style='left: -75px; width: 50px;' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='../login/logout.php'>Log out</a>
                            </div>
                        </li>";
                        }else{
                            echo "<a class='nav-link text-dark' href='../login/login.php' role='button'>
                            <span class='px-3 py-2 rounded-pill'><i class='far fa-user'></i></span>
                        </a>";
                        }; ?>

                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <script>
        function searchProducts() {
            var searchInput = document.getElementById("searchInput").value;

            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the function to handle the response
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("searchResults").innerHTML = this.responseText;
                }
            };

            xhttp.open("GET", "../search/search-process.php?search=" + searchInput, true);

            // Send the request
            xhttp.send();
        }
        function redirectToSearch() {
            var searchInput = document.getElementById("searchInput").value;
            window.location.href = "../search/productSearch.php?search=" + searchInput;
        };


        //Animation for navbar when click
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Lấy tất cả các thẻ a có class "nav-link"
        //     var navLinks = document.querySelectorAll('.nav-link');

        //     // Lặp qua từng thẻ a và thêm sự kiện click
        //     navLinks.forEach(function (link) {
        //         link.addEventListener('click', function (event) {
        //             // Loại bỏ class 'text-danger' từ tất cả các thẻ a
        //             navLinks.forEach(function (innerLink) {
        //                 innerLink.classList.remove('text-danger');
        //             });

        //             // Thêm class 'text-danger' vào thẻ a được click
        //             this.classList.add('text-danger');

        //             // Lưu trạng thái vào localStorage
        //             localStorage.setItem('selectedNavLink', this.getAttribute('href'));
        //         });
        //     });

        //     // Kiểm tra xem có trạng thái đã lưu hay không
        //     var selectedNavLink = localStorage.getItem('selectedNavLink');
        //     if (selectedNavLink) {
        //         // Thêm class 'text-danger' vào thẻ a tương ứng với trạng thái đã lưu
        //         document.querySelector('a[href="' + selectedNavLink + '"]').classList.add('text-danger');
        //     }
        // });


        document.addEventListener("DOMContentLoaded", function () {
            // Lấy tất cả các thẻ a có class "nav-link"
            var navLinks = document.querySelectorAll('.nav-link');

            // Lặp qua từng thẻ a và thêm sự kiện click
            navLinks.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    // Loại bỏ class 'text-danger' từ tất cả các thẻ a
                    navLinks.forEach(function (innerLink) {
                        innerLink.classList.remove('text-danger');
                    });

                    // Thêm class 'text-danger' vào thẻ a được click
                    this.classList.add('text-danger');

                    // Lưu trạng thái vào localStorage
                    localStorage.setItem('selectedNavLink', this.getAttribute('href'));
                });
            });

            // Kiểm tra xem có trạng thái đã lưu hay không
            var selectedNavLink = localStorage.getItem('selectedNavLink');
            if (selectedNavLink) {
                // Thêm class 'text-danger' vào thẻ a tương ứng với trạng thái đã lưu
                var selectedLink = document.querySelector('a[href="' + selectedNavLink + '"]');
                if (selectedLink) {
                    selectedLink.classList.add('text-danger');
                } else {
                    // Trường hợp đặc biệt: "Home"
                    if (selectedNavLink.includes('index.php')) {
                        document.querySelector('a[href*="index.php"]').classList.add('text-danger');
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>

</body>
</html>