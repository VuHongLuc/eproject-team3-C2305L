<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Product Details</title>
</head>
<body>
    <?php
    include('../home/navbar.php');
        if (isset($_GET['productID'])) {
            // Lấy giá trị productID từ URL
            $productID = $_GET['productID'];
        
            // Câu truy vấn SQL để lấy thông tin từ cả 3 bảng
            $sqlDetailPro = "SELECT p.*, c.categoryName, b.brandName
                             FROM products p
                             LEFT JOIN category c ON p.categoryID = c.categoryID
                             LEFT JOIN brand b ON p.brandID = b.brandID
                             WHERE p.productID = '$productID'";

        
            $resultDetailPro = mysqli_query($conn, $sqlDetailPro);
        
            if ($resultDetailPro) {
                if (mysqli_num_rows($resultDetailPro) > 0) {
                    $rowProDetail = mysqli_fetch_assoc($resultDetailPro);
                    $productImg = $rowProDetail['imageLink'];
                    $categoryName = $rowProDetail['categoryName'];
                    $brandName = $rowProDetail['brandName'];
                } else {
                    echo "No results found for this product ID.";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }

        
        
    ?>
    <!-- View product -->
    <div class="product-detail-container d-flex flex-wrap justify-content-center">

        <div class="product-details  p-5">
            <form action="" method="POST" class="d-flex flex-wrap justify-content-around">
                                    <input type="hidden" name="productID" value="<?php echo  $rowProDetail['productID'] ; ?>">
                                    <input type="hidden" name="productName" value="<?php echo  $rowProDetail['productName'] ; ?>">
                                    <input type="hidden" name="imageLink" value="<?php echo  "../" . $productImg ?>">
                                    <input type="hidden" name="unitPrice" value="<?php echo  $rowProDetail['unitPrice'] ; ?>">

                <img src="../<?php echo $productImg;  ?>" alt="" class="product-detail-img col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="product-info col-lg-5 col-md-5 col-sm-12 col-12">
                    <h3 class="product-detail-name fw-bold text-start"><?php echo $rowProDetail['productName'] ; ?></h3>
                    <h3 class="product-detail-price p-2 text-red"><?php echo $rowProDetail['unitPrice']."$"; ?></h3>
                    <div class="product-detail-color d-flex my-1 ">
                        <label for="" class="fw-bold p-2 font-size-sm mt-1">Color</label>
                        <p class="product-color mx-2 my-0 p-2"><?php echo $rowProDetail['color']; ?></p>
                    </div>

                    <div class="product-details-quantity my-1">
                        <label for="" class="fw-bold p-2 font-size-sm mt-1">Quantity</label>
                        <button type="button" class="decrementBtn btn btn-danger align-middle " >-</button>
                        <input type="number" class="quantityInput align-middle text-center " name="quantity" value="1" min="1" >
                        <button type="button" class="incrementBtn btn btn-danger align-middle ">+</button>
                    </div>
                   

                    <div class="product-detail-action ">
                        <div class="justify-content-center">
                            <div class="d-flex flex-wrap justify-content-between ">
                                <button type="submit" name="addToCart" class="btn btn-add col-lg-5 col-md-12 col-sm-12 col-12  text-dark fw-bold my-1">
                                    Add to cart
                                </button>
                                <button type="submit" name="buyNow" class="btn btn-buy bg-red col-lg-5 col-md-12 col-sm-12 col-12 text-white fw-bold my-1">Buy now</a></button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-contact text-white fw-bold col-lg-12 col-md-12 col-12 col-sm-12 col-12 my-1"><a href="../contactUs/contact.php" class="list-group-item font-size-sm">Contact for better price</a></button>
                            </div>
                        </div>
                    </div>
                </form>

                    <div class="product-details-benefit d-flex justify-content-center flex-wrap">
                        <div class="col-12 col-lg-6 d-flex p-1 justify-content-between">
                            <img class="col-12 col-lg-4" src="../Photos/IconProductDetails/atm-card.svg" alt="atm-card">
                                <div class="col-12 col-lg-8 d-flex flex-wrap align-items-center mx-1">
                                    <p class="my-0 p-0 col-lg-12  text-uppercase font-size-smsm ">Pay</p>
                                    <p class="my-0 p-0 text-uppercase font-size-smsm  fw-bold">CONVENIENT</p>
                                </div>
                        </div>
                        <div class="col-12 col-lg-6 d-flex p-1 justify-content-between ">
                            <img class="col-12 col-lg-4" src="../Photos/IconProductDetails/check.svg" alt="check">
                                <div class="col-12 col-lg-8 d-flex flex-wrap align-items-center mx-1 ">
                                    <p class="my-0 p-0 col-lg-12  text-uppercase font-size-smsm ">PRODUCT</p>
                                    <p class="my-0 p-0 text-uppercase font-size-smsm  fw-bold">GENUINE</p>
                                </div>
                            </div>
                        <div class="col-12 col-lg-6 d-flex p-1 justify-content-between">
                            <img class="col-12 col-lg-4" src="../Photos/IconProductDetails/comments.svg"  alt="comment">
                                <div class="col-12 col-lg-8 d-flex flex-wrap align-items-center mx-1">
                                    <p class="my-0 p-0 col-lg-12  text-uppercase font-size-smsm ">NATIONWIDE SHIPPING</p>
                                    <p class="my-0 p-0 text-uppercase font-size-smsm  fw-bold">Ship COD</p>
                                </div>
                            </div>
                        <div class="col-12 col-lg-6 d-flex p-1 justify-content-between">
                            <img class="col-12 col-lg-4" src="../Photos/IconProductDetails/delivery-truck.svg" alt="delivery-truck">
                                <div class="col-12 col-lg-8 d-flex flex-wrap align-items-center mx-1">
                                    <p class="my-0 p-0 col-lg-12  text-uppercase font-size-smsm ">24/7 SUPPORT</p>
                                    <p class="my-0 p-0 text-uppercase font-size-smsm fw-bold">PROFESSIONAL</p>
                                </div>
                        </div>
                    </div>
                
                </div>
                <div class="product-decription d-flex flex-wrap col-md-12 justify-content-around m-2">
                        <p class="border-bot-red fw-bold col-12 col-lg-12 text-center p-2">Product Information</p>
                        
                            <table class=" table text-center">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold font-size-sm p-2 ">Brand</td>
                                            <td class=" font-size-sm p-2 "><?php echo  $brandName; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold font-size-sm p-2">Category</td>
                                            <td class=" font-size-sm p-2"><?php echo  $categoryName; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="fw-bold font-size-sm p-2">Memory</td>
                                            <td class=" font-size-sm p-2"><?php echo $rowProDetail['memory']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="fw-bold font-size-sm p-2">Speed</td>
                                            <td class=" font-size-sm p-2"><?php echo $rowProDetail['speed']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold font-size-sm p-2">Color</td>
                                            <td class=" font-size-sm p-2"><?php echo $rowProDetail['color']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold font-size-sm p-2">Warranty</td>
                                            <td class=" font-size-sm p-2"><?php echo $rowProDetail['warranty']; ?></td>
                                        </tr>

                                        <tr>
                                            <td class="fw-bold font-size-sm p-2">Dimension</td>
                                            <td class=" font-size-sm p-2"><?php echo $rowProDetail['dimension']; ?></td>
                                        </tr> 
                                        <tr>
                                            <td  class=" fw-bold font-size-sm p-2 align-middle ">Decription</td>
                                            <td  class="font-size-sm text-justify "><?php echo $rowProDetail['description']; ?></td>
                                        </tr>
                                       <tr>
                                        <td colspan=4><p><a href="downLoadFile.php?productID=<?php echo $productID;  ?>" download>Download File .docx</a></p></td>
                                       </tr>
                                    </tbody>
                            </table>
                        
                </div>

                <!-- Feedback -->
                <div class="product-feeback col-lg-12">
                    <form action="" method="get" class="d-flex flex-wrap ">
                        <label for="" class="fw-bold col-lg-12 p-1 my-2">Customer feedback</label>
                        <textarea  placeholder="Your feedback..." name="message" class="product-text-feedback col-lg-12 p-4 my-2" id="myTextArea"></textarea>
                        <button type="submit" class="btn btn-danger"><a href="#" class="list-group-item">Send</a></button>
                    </form>
                </div>
        </div>
    </div>
    
    
        
 <?php } ?> 

    <!-- Lưu feedback vào database -->

       


    <!-- footer -->
    <?php include('../home/footer.html'); ?>
   
    <!-- Link  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    
    <script src="controller.js"></script>
  
</body>
</html>