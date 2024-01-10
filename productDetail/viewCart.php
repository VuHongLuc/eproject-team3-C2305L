
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    
    <title>Cart</title>
</head>
<body>
    <!-- Navbar -->
    <?php

        include('../db.php');
        include('../home/navbar.php'); 
        // session_start();
    ?>
    <div class="view-cart d-flex justify-content-center py-4">
        <div class="view-cart-details  p-4">
            <h1 class="">Cart</h1>
            <form action="" method="post">
            <table class=" table align-middle ">
                <tr class="">
                    <th scope="col" class="">Product</th>
                    <th scope="col" class="">Price</th>
                    <th scope="col" class="">Quantity</th>
                    <th scope="col" class="">Money</th>
                </tr>
                <?php
                    $totalCart = 0;
                    for ($i = 0; $i <count($_SESSION['cartItem']); $i++) {
                        $productID = $_SESSION['cartItem'][$i]['productID'];
                        $productName = $_SESSION['cartItem'][$i]['productName'];
                        $imageLink = $_SESSION['cartItem'][$i]['imageLink'];
                        $quantity = $_SESSION['cartItem'][$i]['quantity'];
                        $unitPrice = $_SESSION['cartItem'][$i]['unitPrice'];
                        $userID = $_SESSION['cartItem'][$i]['userID'];
                        $totalMoney = $quantity * $unitPrice;
                        // $totalCart+=($quantity*$unitPrice);
                ?>
                <tr>
                    <td class="d-flex align-items-center">
                        <a href="deleteCart.php?productID=<?php echo $productID;?>"><button type="button" class="cart-btn-x m-1 text-center"><i class="fas fa-trash"></i></button></a>
                        <div class="cart-img p-1 m-1">
                            <img src="<?php echo  $imageLink; ?>" alt="Product img">
                        </div>
                        
                        <input type="hidden" name='productID<?php echo  $i ?>' value="<?php echo  $productID; ?>">
                        <input type="hidden" name='imageLink<?php echo  $i ?>' value="<?php echo  $imageLink; ?>">
                        <input type="hidden" name='productName<?php echo  $i ?>' value="<?php echo  $productName; ?>">
                        <input type="hidden" name='unitPrice<?php echo  $i ?>' value="<?php echo  $unitPrice; ?>">
                        <input type="hidden" name='userID<?php echo  $i ?>' value="<?php echo  $userID; ?>">

                        <div class="cart-name-product p-1 m-1 fw-bold"><?php echo $productName; ?></div>
                    </td>
                    <td class="price-product"><?php echo $unitPrice  ; ?></td>
                    <td>
                        <button type="button" class="decrementBtn btn btn-danger align-middle " >-</button>
                        <input type="number" class="quantityInput align-middle text-center " name="quantity<?php echo  $i ?>" value="<?php echo $quantity; ?>" min="1" >
                        <button type="button" class="incrementBtn btn btn-danger align-middle " >+</button>
                    </td>
                    <td class="total-price" class=" mx-2"><?php echo $totalMoney; ?></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan="3" class="fw-bold">Total</td>
                    <td id="totalCart"class="fw-bold"><?php echo "$". $totalCart; ?></td>
                </tr>                  
            </table>
                <a href="" class="checkOut list-group=item"><button type="submit" name="checkout" class="btn btn-danger">Checkout</button></a>
        </form>
        </div>
    </div>
   
 

 
 
    <!-- footer -->
    <?php include('../home/footer.html'); ?>

    <!-- Link -->
    <script src="controller.js"></script>
    
</body>
</html>