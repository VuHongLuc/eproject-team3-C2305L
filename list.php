<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Menu</title>
</head>
<body>
<div class="wrapper container-fluid">
    <br>
    <?php 
        include "db.php";
        $sql1 = "SELECT * FROM category";
        $result1 = $conn->query($sql1);         
        while ($row1 = $result1->fetch_assoc()) {

       
    ?>
    <div class="container col-inner">
        <h2 style="text-align: center" class="text-uppercase">
            <a href="listPage/viewListCategory.php?category=<?php echo (int)$row1["categoryID"] ?>" class="list-group-item"><?php echo $row1["categoryName"]?>
            </a>
    </h2>
        <div class="row">
    <?php
        $sql = "SELECT * FROM products where categoryID =". $row1["categoryID"] ." limit 8";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
    ?>
                <div class="col-md-3 mt-2">
                    <div class="card custom-col">
                        <!-- Phong sửa đoạn href của thẻ a -->
                        <a href="productDetail/view/viewProduct.php?productID=<?php echo $row['productID'];?>" class="list-group-item align-items-center">
                            <img src="<?php echo $row["imageLink"]?>" class="p-5 object-fit-contain home-custom-image" alt="Product 3">
                        </a>
                        
                        <div class="card-body text-center">
                        <h5 class="card-title text-center mt-2 home-custom-card-title fw-bold text-uppercase"><a href="productDetail/view/viewProduct.php?productID=<?php echo $row['productID'];?>" class="list-group-item"><?php echo $row["productName"]?></a></h5>
                            <p class="card-text text-danger fw-bold"><?php echo $row["unitPrice"]."$"?></p>
                            <div class="justify-content-between d-flex">
                                <a href="productDetail/view/viewProduct.php?productID=<?php echo $row['productID'];?>" class="btn btn-outline-danger fw-bold">ADD TO CART</a>
                                <a href="#" class="btn btn-outline-secondary fw-bold">COMPARE</a>
                            </div>
                        </div>
                    </div>
                </div>   
        <?php
        }
        ?>
        <div class="justify-content-center d-flex">
        <a href="listPage/viewListCategory.php?category=<?php echo (int)$row1["categoryID"] ?>" class="btn btn-danger home-btn-showmore ">SHOW MORE</a>
        </div>
        </div>
        </div>
        <br>
    <?php
    }
    ?>
</div>

</body>
</html>