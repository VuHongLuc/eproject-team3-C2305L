<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Cart</title>
</head>
<body>
    <!-- Navbar -->
    <?php
        include('../../db.php');
        include('../../navbar.html');
   
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $proID = $_POST('product_id');
            $proName = $_POST('product_name');
            $proPrice = $_POST('price');
            $proImg = $_POST('imgLink');
            echo $proID;
            echo $proName;
            echo $proPrice;
            echo $proImg;
        }
    ?>
    <div class="view-cart d-flex justify-content-center py-4">
        <div class="view-cart-details  p-4">
            <h1 class="">Cart</h1>
            <table class="table align-middle ">
                <tr class="">
                    <th class="">Product</th>
                    <th class="">Price</th>
                    <th class="">Quantity</th>
                    <th class="">Money</th>
                </tr>
                <tr  class="">
                    <td class="d-flex flex-wrap ">
                       
                    </td>
                    <td>199</td>
                    <td>
                        <button class=" btn  decrease-btn btn-danger align-middle " id="decrementBtn" >-</button>
                        <input type="number" class="quantity-pro-input align-middle text-center " name="quantity-pro-input" id="quantityInput" value="1" min="1" max="3" >
                        <button class="btn  increase-btn btn-danger align-middle " id="incrementBtn">+</button>
                    </td>
                    <td>199</td>
                </tr>

                <tr class="">
                    <td  >Total:</td>
                    <td id="totalMoney">$10.00</td>
                </tr>
            </table>
        
        </div>
    </div>
 
    <!-- footer -->
    <?php include('../../footer.html'); ?>

    <!-- Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../controller/controller.js"></script>
</body>
</html>