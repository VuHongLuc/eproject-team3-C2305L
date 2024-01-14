
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    
    <title>Check Out</title>
</head>
<body>
  
<?php

include('../db.php');
include('../home/navbar.php');
$userName = $_SESSION["userName"];
$sqlUser = "SELECT * FROM user WHERE userName = '$userName'";
$resultUser = $conn->query($sqlUser);
$userID = null;
if ($resultUser && $resultUser->num_rows > 0) {
    while ($row = $resultUser->fetch_assoc()) {
        $userID = $row['userID'];
        $userName = $row['userName'];
        $userEmail = $row['email']; 
        $userAddress = $row['address'];
        $userPhone = $row['phone'];
        // $cartidOrder = $cartID;
    }
?>

<div class="view-Checkout d-flex justify-content-center py-4">
<div class="view-checkout-details  p-4">
    <h1 class="">Your Order</h1>
    <form action="" method="post">
    <table class=" table align-middle ">
        <tr class="">
            <th scope="col" class="">Product</th>
            <th scope="col" class="">Price</th>
            <th scope="col" class="">Quantity</th>
            <th scope="col" class="">Money</th>
        </tr>
        <?php
            // $totalCart = 0;
            
                foreach ($_SESSION['cartItem'] as $item){
                    $productID = $item['productID'];
                    $productName = $item['productName'];
                    $imageLink = $item['imageLink'];
                    $quantity = $item['quantity'];
                    $unitPrice = $item['unitPrice'];
                    $userID = $item['userID'];
                    $totalMoney = $quantity * $unitPrice;
                // $totalCart+=($quantity*$unitPrice);
        ?>
        <tr>
            <td class="d-flex align-items-center">
                <div class="cart-img p-1 m-1">
                    <img src="<?php echo  $imageLink; ?>" alt="Product img">
                </div>
                <div class="cart-name-product p-1 m-1 fw-bold"><?php echo $productName; ?></div>
            </td>
            <td class="price-product"><?php echo $unitPrice  ; ?></td>
            <td>
                <input type="number" class="quantityInput align-middle text-center " name="quantity" value="<?php echo $quantity; ?>" min="1" >
            </td>
            <td class="total-price" class=" mx-2"><?php echo $totalMoney; ?></td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="3" class="fw-bold">Total</td>
            <td id="totalCart"class="fw-bold text-danger"><?php echo "$". $totalCart; ?></td>
        </tr>              
    </table>
    <div class="infor-user">
        <h3>Customer information</h3>
        <form action="" method="post">
        <div class="d-flex m-2 p-2">
            <label class="p-2 text-lg" for="username">Username:</label>
            <input class="p-2" type="text" id="username" name="username" value="<?php echo $userName ?>" required>
        </div>
        <div class="d-flex m-2 p-2">
            <label class="p-2 text-lg" for="phoneNumber">Phone Number:</label>
            <input class="p-2" type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $userPhone ?>" required>
        </div>
        <div class="d-flex m-2 p-2">
            <label class="p-2 text-lg" for="email">Email:</label>
            <input class="p-2" type="email" id="email" name="email" value="<?php echo $userEmail ?>" required>
        </div>
        <div class="d-flex m-2 p-2 align-items-center">
            <label class="col-lg-6 p-2 text-lg" for="email">Payment Method:</label>
            <div class="col-lg-6">
                <div class="">
                    <input class="p-2 " type="radio" id="cash" name="paymentMethod" value="cash" required>
                    <label for="cash">Cash</label><br>
                </div>
                <div class="">
                    <input class="p-2 " type="radio" id="cash" name="paymentMethod" value="Credit Card" required>
                    <label for="cash">Credit Card</label><br>
                </div>
                <div class="">
                    <input class="p-2 " type="radio" id="cash" name="paymentMethod" value="Online Payment" required>
                    <label for="cash">Online Payment</label><br>
                </div>
            </div>
        </div>
        <div class="d-flex m-2 p-2">
            <label class="p-2 text-lg" for="address">Address:</label>
            <textarea class="p-3" id="address" name="address" value="" placeholder="Please enter your delivery address...." required></textarea>
        </div>
        <input type="hidden" name="userID" value="<?php echo $userID;  ?>">
        <div class="d-flex justify-content-center ">
            <a href="" class="checkOut list-group=item "><button type="submit" name="checkout" class="btn btn-danger" onclick="payment()">Payment</button></a>
        </div>
        </form>
    </div> 
</form>
</div>
</div>


<?php } ?>


                    
 
 
    <!-- footer -->
    <?php include('../home/footer.html'); ?>

    <!-- Link -->
    <script>
        function payment(){
            alert("Payment success");
            setTimeout(function() {
                window.location.href = 'http://localhost/OceanGateGit3/eproject-team3-C2305L/index/';
            }, 300);
        }
    </script>
    <script src="controller.js"></script>
    
</body>
</html>