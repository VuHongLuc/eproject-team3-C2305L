<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>View List Brand</title>
</head>
<body>
<?php include "../navbar.html" ?>

<div class="wrapper container-fluid">
    <br>
    <?php 
        include "../db.php";
        $sql1 = "SELECT * FROM brand WHERE brandID = ".$_GET['brand'];
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
    ?>
    <div class="container col-inner">
        <h2 style="text-align: center" class="text-uppercase">
            <a href="" class="list-group-item"><?php echo $row1["brandName"]?>
            </a>
    </h2>
        <div class="row">
    <?php

        // Định nghĩa các thông số
        $sql2 = "SELECT COUNT(*) as totalRecords FROM products WHERE brandID =". $_GET['brand'];
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $totalRecords = $row2["totalRecords"];
        } else {
            $totalRecords = 0;
        }
        $recordsPerPage = 8;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Tính toán số trang và vị trí bắt đầu
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $startPosition = ($currentPage - 1) * $recordsPerPage;

        // Truy vấn cơ sở dữ liệu
        $sql = "SELECT * FROM products WHERE brandID =". $_GET['brand'] ." LIMIT $recordsPerPage OFFSET $startPosition";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
    ?>
                <div class="col-md-3 mt-2">
                    <div class="card custom-col">
                        <a href="" class="list-group-item align-items-center">
                            <img src="../<?php echo $row["imageLink"]?>" class="p-5 object-fit-contain home-custom-image" alt="Product 3">
                        </a>
                        
                        <div class="card-body text-center">
                        <h5 class="card-title text-center mt-2 home-custom-card-title fw-bold text-uppercase"><a href="" class="list-group-item"><?php echo $row["productName"]?></a></h5>
                            <p class="card-text text-danger fw-bold"><?php echo $row["unitPrice"]."$"?></p>
                            <div class="justify-content-between d-flex">
                                <a href="#" class="btn btn-outline-danger fw-bold">ADD TO CART</a>
                                <a href="#" class="btn btn-outline-secondary fw-bold">COMPARE</a>
                            </div>
                        </div>
                    </div>
                </div>   
        <?php
        }
        ?>

        <div class="justify-content-center d-flex">
            <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="?brand='.$_GET['brand'].'&page=' . $i . '"class="btn btn-danger list-btn-pagination">' . $i . '</a>';
                }
            ?>
        </div>

        </div>
        </div>
        <br>

</div>
<?php include "../footer.html" ?>
</body>
</html>