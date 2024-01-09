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
                            <div class="col-md-4 mt-2">
                                <div class="card custom-col">
                                    <a href="" class="list-group-item align-items-center">
                                        <img src="<?php echo "../".$row["imageLink"] ?>" class="p-5 object-fit-contain home-custom-image" alt="Product Image">
                                    </a>
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center mt-2 home-custom-card-title fw-bold text-uppercase">
                                            <a href="" class="list-group-item"><?php echo $row["productName"] ?></a>
                                        </h5>
                                        <p class="card-text text-danger fw-bold"><?php echo $row["unitPrice"] . "$" ?></p>
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
                    </div>
                <?php

                    } else {
                        echo "No products found.";
                    }
                    $conn->close();

                ?>
            </main>
        </div>
    </div>

    <?php include "../home/footer.html" ?>
</body>

</html>
