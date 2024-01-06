<?php
session_start();
    // Khởi tạo biến numberCompare nếu chưa tồn tại
    if (!isset($_SESSION['numberCompare'])) {
        $_SESSION['numberCompare'] = 0;
        $_SESSION['compareItems'] = [];
    }

    // Xử lý khi nút "COMPARE" được nhấn
    if (isset($_POST['compareButton']) && $_SESSION['numberCompare'] < 3 ) {
        $_SESSION['numberCompare']++;

        $productCompare = array(
            'productID' => $_POST['productID'],
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
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Dropdown</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
       <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div style="position: fixed; z-index: 10; width: 100%; top: 0; left: 0;">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="../index/index.php">
                <img src="https://i.snipboard.io/kQIriT.jpg" alt="Logo" width="125" height="75">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav m-auto font-size-25">
                    <li class="nav-item m-3">
                        <a class="nav-link active fw-bold" aria-current="page" href="../index/index.php" style="color: red;">HOME</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link text-dark fw-bold" href="../contactUs/company.php">COMPANY</a>
                    </li>
                    
                    <li class="nav-item  m-3 dropdown">
                        <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORIES
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownCate">
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=1">HDD</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=2">SSD</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=3">USB</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=4">Memory Card</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=5">RAM</a>
                            <a class="dropdown-item" href="../listPage/viewListCategory.php?category=6">Portal Hard Driver</a>  
                        </div>
                    </li>

                    <li class="nav-item  m-3 dropdown">
                        <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="navbarDropdownBrand" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <a class="nav-link text-dark fw-bold" href="../contactUs/privacy.php">PRIVACY</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link text-dark fw-bold" href="../contactUs/shippingPayment.php">SHIPPING PAYMENT</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link text-dark fw-bold" href="../contactUs/warrantyPolicy.php">WARRANTY</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link text-dark fw-bold" href="../news/news.php">NEWS</a>
                    </li>
                    <li class="nav-item  m-3">
                        <a class="nav-link text-dark fw-bold" href="../contactUs/contact.php">CONTACT</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">

                        <!-- Search function -->

                        <form id="searchForm" onsubmit="redirectToSearch(); return false;" method="GET" class="d-flex">
                            <input class="form-control" type="text" id="searchInput" placeholder="Search for..." oninput="searchProducts()">
                            <button type="submit" class="btn btn-outline-danger"> 
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Search_Icon.svg/1024px-Search_Icon.svg.png" alt="" width="20px" height="20px">
                            </button>
                        </form>
                        <div id="searchResults"></div>
                        <!-- cart logo -->
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link"><span class="px-2 text-danger"><i class="fas fa-shopping-cart"></i></span></a>
                    </li>
                        <!-- compare logo -->
                    <li class="nav-item">
                        <a href="../compare/compare.php" class="nav-link">
                            <span class="px-2 text-success" id="logoCompare">
                                <i class="fa-solid fa-scale-balanced"></i>
                                <b class="text-center" id="numberCompare"><?php echo $_SESSION['numberCompare']?></b>
                            </span>
                        </a>
                    </li>
                    
                </ul>

                        <!-- User logo-->
                <ul class="navbar-nav m-lg-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark" href="../login/login.php" role="button">
                            <span class="px-3 py-2 rounded-pill"><i class="far fa-user"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

      <!-- Bootstrap JS and jQuery -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->
      <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script> -->

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

      <script>
        function searchProducts() {
            var searchInput = document.getElementById("searchInput").value;

            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the function to handle the response
            xhttp.onreadystatechange = function() {
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
            window.location.href = "../search/product-search.php?search=" + searchInput;
        }
        
    </script>
    <script src="../compare/compare.js"></script>
</body>
</html>
