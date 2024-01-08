<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    
    <title>Cart</title>
</head>
<body>
    <!-- Navbar -->
    <?php

        include('../db.php');
        include('../home/navbar.php');
        
       
    ?>
    <div class="view-cart d-flex justify-content-center py-4">
        <div class="view-cart-details  p-4">
            <h1 class="">Cart</h1>
            <table class=" table align-middle ">
                <tr class="">
                    <th scope="col" class="">Product</th>
                    <th scope="col" class="">Price</th>
                    <th scope="col" class="">Quantity</th>
                    <th scope="col" class="">Money</th>
                </tr>
                <?php
                    foreach ($_SESSION['cartItem'] as $item){
                        $productID = $item['productID'];
                        $productName = $item['productName'];
                        $imageLink = $item['imageLink'];
                        $quantity = $item['quantity'];
                        $unitPrice = $item['unitPrice'];

                 ?>
               
                <tr  class="">
                    <td class="d-flex align-items-center">
                        <a href="deleteCart.php?productID=<?php echo $productID;?>"><button type="button" class="cart-btn-x m-1 text-center"><i class="fas fa-trash"></i></button></a>
                        <div class="cart-img p-1 m-1">
                            <img src="<?php echo  $imageLink; ?>" alt="Product img">
                        </div>
                        <div class="cart-name-product p-1 m-1 fw-bold"><?php echo $productName;  ?></div>
                    </td>
                    <td id="price-product"><?php echo $unitPrice  ; ?></td>
                    <td>
                        <button class=" btn  decrease-btn btn-danger align-middle " id="decrementBtn" >-</button>
                        <input type="number" class="quantity-pro-input align-middle text-center " name="quantity" id="quantityInput" value="<?php echo $quantity; ?>" min="1" >
                        <button class="btn  increase-btn btn-danger align-middle " id="incrementBtn">+</button>
                    </td>
                    <td id="total-price" class=" mx-2"><?php echo $unitPrice*$quantity; ?></td>
                </tr>
                <?php }?>
                <!-- <tr class="">
                    <td  >Total:</td>
                    <td id="totalMoney">$10.00</td>
                </tr> -->
                  
            </table>
        
        </div>
    </div>
 

 
 
    <!-- footer -->
    <?php include('../home/footer.html'); ?>

    <!-- Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="controller.js"></script>
    
</body>
</html>