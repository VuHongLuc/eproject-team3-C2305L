

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
<div class="wrapper container-fluid">

<?php  
        include "../db.php";
        $sql1 = "SELECT * FROM category";
        $result1 = $conn->query($sql1);         
        while ($row1 = $result1->fetch_assoc()) {
 
    ?>
    <div class="container col-inner">
        <h2 class="text-uppercase text-center">
            <a href="../listPage/viewListCategory.php?category=<?php echo (int)$row1["categoryID"] ?>" class="list-group-item"><?php echo $row1["categoryName"]?>
            </a>
        </h2>
        <div class="row justify-content-center">
    <?php
        $sql = "SELECT * FROM products where categoryID =". $row1["categoryID"] ." limit 8";
        $result = $conn->query($sql);
        $compareProduct =[];
        while ($row = $result->fetch_assoc()) {
     
    ?>
                <form action="" method="POST" class="d-flex col-xl-3 col-lg-4 col-md-6 mt-2 justify-content-center">
                    <div class="card custom-col ">
                        <!-- Phong sửa đoạn href của thẻ a -->
                        <a href="../productDetail/viewProduct.php?productID=<?php echo $row['productID'];?>" class="list-group-item align-items-center">
                            <img src="<?php echo "../".$row["imageLink"]?>" class="p-5 object-fit-contain home-custom-image" alt="Product 3">
                        </a>
                        
                        <div class="card-body text-center">
                            <h5 class="card-title text-center mt-2 home-custom-card-title fw-bold text-uppercase">
                                <a href="../productDetail/viewProduct.php?productID=<?php echo $row['productID'];?>" class="list-group-item"><?php echo $row["productName"]?></a>
                            </h5>
                            <p class="card-text text-danger fw-bold"><?php echo $row["unitPrice"]."$"?></p>


                            <!-- input hidden for get infomation -->
                            <?php
                                switch ($row['brandID']){
                                case 1:
                                    $brand = "Samsung";
                                    break;
                                case 2:
                                    $brand = "Western Digital (WD)";
                                    break;
                                case 3:
                                    $brand = "Seagate";
                                    break;
                                case 4:
                                    $brand = "SanDisk";
                                    break;
                                case 5:
                                    $brand = "Kingston";
                                    break;
                                case 6:
                                    $brand = "Transcend";
                                    break;
                                default:
                                    $brand ="unknown brand";
                                    break;
                                }


                                switch ($row['categoryID']){
                                    case 1:
                                        $category = "Hard Disk Drive - HDD";
                                        break;
                                    case 2:
                                        $category = "Solid State Drive - SSD";
                                        break;
                                    case 3:
                                        $category = "USB Flash Drive";
                                        break;
                                    case 4:
                                        $category = "Memory Card";
                                        break;
                                    case 5:
                                        $category = "Random Access Memory - RAM";
                                        break;
                                    case 6:
                                        $category = "Portable Hard Drive";
                                        break;
                                    default:
                                        $category ="unknown category";
                                        break;
                                    }


                            ?>
                            <input type="hidden" name="productID" value="<?php echo $row['productID'];?>">
                            <input type="hidden" name="imageLink" value="<?php echo $row['imageLink'];?>">
                            <input type="hidden" name="productName" value="<?php echo $row['productName'];?>">
                            <input type="hidden" name="unitPrice" value="<?php echo $row['unitPrice'];?>">
                            <input type="hidden" name="categoryID" value="<?php echo $category ?>">
                            <input type="hidden" name="brandID" value="<?php echo $brand ?>">
                            <input type="hidden" name="memory" value="<?php echo $row['memory']; ?>">
                            <input type="hidden" name="speed" value="<?php echo $row['speed'];?>">
                            <input type="hidden" name="color" value="<?php echo $row['color'];?>">
                            <input type="hidden" name="warranty" value="<?php echo $row['warranty'];?>">
                            <input type="hidden" name="dimension" value="<?php echo $row['dimension'];?>">


                            <!-- button ADD TO CART & COMPARE -->
                            <div class=" d-flex ">
                                <button type="submit" name="addToCartButton" class="btn btn-outline-danger fw-bold mx-1">ADD TO CART</button>
                                <button type="submit" name="compareButton" class="btn btn-outline-secondary fw-bold compareButton mx-1" data-bs-toggle="modal" data-bs-target="#notifyCompare">COMPARE</button>
                            </div>
                        </div>
                    </div>
                </form>
        <?php
        }
        ?>
        <div class="justify-content-center d-flex">
            <a href="../listPage/viewListCategory.php?category=<?php echo (int)$row1["categoryID"] ?>" class="btn btn-danger home-btn-showmore ">SHOW MORE</a>
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