<?php
        include('../db.php');
        include('../home/navbar.php');

        

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
                    for ($i =0 ; $i < count($_SESSION['cartItem']) ; $i++) {

                    
                        $productID[$i] = $_SESSION['cartItem'][$i]['productID'];
                        $productName[$i] = $_SESSION['cartItem'][$i]['productName'];
                        $imageLink[$i] = $_SESSION['cartItem'][$i]['imageLink'];
                        $quantity[$i] = $_SESSION['cartItem'][$i]['quantity'];
                        $unitPrice[$i] = $_SESSION['cartItem'][$i]['unitPrice'];
                        $userID[$i] = $_SESSION['cartItem'][$i]['userID'];
                        

                        $totalCart+=($quantity[$i]*$unitPrice[$i]);
                ?>               
                <tr>
                    <td class="d-flex align-items-center">
                        <a href="deleteCart.php?productID=<?php echo $productID[$i];?>"><button type="button" class="cart-btn-x m-1 text-center"><i class="fas fa-trash"></i></button></a>
                        <div class="cart-img p-1 m-1">
                            <img src="<?php echo  $imageLink[$i]; ?>" alt="Product img">
                        </div>
                        <div class="cart-name-product p-1 m-1 fw-bold"><?php echo $productName[$i]; ?></div>
                    </td>
                    <td class="price-product"><?php echo $unitPrice[$i]  ; ?></td>
                    <td>
                        <button type="button" class="decrementBtn btn btn-danger align-middle " >-</button>
                        <input type="number" class="quantityInput align-middle text-center " name="quantity<?php echo $i?>" value="<?php echo $quantity[$i]; ?>" min="1" >
                        <button type="button" class="incrementBtn btn btn-danger align-middle " >+</button>
                    </td>
                    <td class="total-price" class=" mx-2"><?php echo $unitPrice[$i]*$quantity[$i]; ?></td>
                </tr>
                <input type="hidden" name="productID<?php echo $i?>" value="<?php echo $productID[$i];?>">
                <input type="hidden" name="productName<?php echo $i?>" value="<?php echo $productName[$i];?>">
                <input type="hidden" name="imageLink<?php echo $i?>" value="<?php echo $imageLink[$i];?>">
                <input type="hidden" name="unitPrice<?php echo $i?>" value="<?php echo $unitPrice[$i];?>">
                <input type="hidden" name="userID<?php echo $i?>" value="<?php echo $userID[$i];?>">
                <?php }?>
                <tr>
                    <td colspan="3" class="fw-bold">Total</td>
                    <td id="totalCart"class="fw-bold"><?php echo "$". $totalCart; ?></td>
                </tr>                  
            </table>
                <button type="submit" name="submitCheckout" class="btn btn-danger list-group=item">Checkout</button>
        </form>
        </div>
    </div>
 
    <!-- footer -->
    <?php include('../home/footer.html'); ?>

    <!-- Link -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    <script src="controller.js"></script>