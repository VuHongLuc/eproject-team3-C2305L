<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Add your custom styles if needed -->
</head>

<body>
    <?php include "../home/navbar.php" ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <aside class="col-md-3">
                <!-- Your category list or any other content you want in the aside section -->
                <h2>Product Filter</h2>
                <!-- Example category links, replace with your actual category links -->
                <ul>
                    <li><a href="../listPage/viewListCategory.php?category=1">HDD</a></li>
                    <li><a href="../listPage/viewListCategory.php?category=2">SSD</a></li>
                    <li><a href="../listPage/viewListCategory.php?category=3">USB</a></li>
                    <li><a href="../listPage/viewListCategory.php?category=4">Memory Card</a></li>
                    <li><a href="../listPage/viewListCategory.php?category=5">RAM</a></li>
                    <li><a href="../listPage/viewListCategory.php?category=6">Portal Hard Driver</a></li>
                </ul>
            </aside>

            <main class="col-md-9">
                <div class="row">
                    <?php
                    include('../db.php');

                    // Get the search keyword from the URL
                    $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

                    // Use the search keyword in your SQL query
                    $sql = "SELECT * FROM products WHERE productName LIKE '%$searchKeyword%' LIMIT 24";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <form action="" method="POST" class="col-md-3 mt-2">
                <div class="card custom-col">
                    <!-- phong sửa ở đây -->
                    <a href="../productDetail/viewProduct.php?productID=<?php echo $row['productID'];?>"
                        class="list-group-item align-items-center">
                        <img src="../<?php echo $row["imageLink"]?>" class="p-5 object-fit-contain home-custom-image"
                        alt="Product 3">
                    </a>

                    <div class="card-body text-center">
                        <h5 class="card-title text-center mt-2 home-custom-card-title fw-bold text-uppercase"><a
                                href="../productDetail/viewProduct.php?productID=<?php echo $row['productID'];?>"
                                class="list-group-item">
                                <?php echo $row["productName"]?>
                            </a></h5>
                        <p class="card-text text-danger fw-bold">
                            <?php echo $row["unitPrice"]."$"?>
                        </p>


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
                        <div class="justify-content-between d-flex">
                            <a href="../productDetail/viewProduct.php?productID=<?php echo $row['productID'];?>"
                                class="btn btn-outline-danger fw-bold">ADD TO CART</a>
                            <button type="submit" name="compareButton"
                                class="btn btn-outline-secondary fw-bold compareButton" data-bs-toggle="modal"
                                data-bs-target="#notifyCompare">COMPARE</button>
                        </div>
                    </div>
                </div>
            </form>
                <?php
                    $conn->close();

                ?>
            </main>
        </div>
    </div>

    <?php include "../home/footer.html" ?>
</body>

</html>
