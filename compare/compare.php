<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php include '../home/navbar.php'; ?>

    <div class="wrapper container-fluid">
        <div class="container col-inner">
            <h2 class="text-uppercase text-center">COMPARE</h2>
            <div class="row">
                <div class="col-md-1"></div>
                <table class="table-striped col-md-1 text-center">
                    <thead  class="tableRowName">
                        <th class=" thCompare">
                        PRODUCT NAME
                        </th>
                    </thead>
                    <tbody>
                        <tr class=" trCompare tableRowImage">
                            <td class=" tdCompare"><b>IMAGE</b></td>
                        </tr>   
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>PRODUCT ID</b></td>
                        </tr>   
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>UNIT PRICE</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>CATEGORY</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>BRAND</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>MEMORY</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>SPEED</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>COLOR</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>WARRANTY</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>DIMENSION</b></td>
                        </tr>
                        <tr class=" trCompare">
                            <td class=" tdCompare"><b>STATE</b></td>
                        </tr>                           
                    </tbody>
                </table>
                <?php
                    foreach ($_SESSION['compareItems'] as $item){
                        $productID = $item['productID'];
                        $imageLink = $item['imageLink'];
                        $productName = $item['productName'];
                        $unitPrice = $item['unitPrice'];
                        $categoryID = $item['categoryID'];
                        $brandID = $item['brandID'];
                        $memory = $item['memory'];
                        $speed = $item['speed'];
                        $color = $item['color'];
                        $warranty = $item['warranty'];
                        $dimension = $item['dimension'];

                        echo "<table class='col-md-3 text-center'>
                        <thead class='tableRowName'>
                            <th class='thCompare'>
                                $productName
                            </th>
                        </thead>
                        <tbody>
                        <tr class='trCompare'>
                            <td class='tdCompare tableRowImage'><img height='100%' src='../$imageLink'></td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$productID</td>
                        </tr>   
                        <tr class='trCompare'>
                            <td class='tdCompare'>$unitPrice$</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$categoryID</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$brandID</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$memory</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$speed</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$color</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$warranty</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>$dimension</td>
                        </tr>
                        <tr class='trCompare'>
                            <td class='tdCompare'>
                            <a style='text-decoration:none' href='deleteCompare.php?productID=$productID'>Delete Compare</a>
                            
                            </td>
                        </tr>
                    </tbody>
                    </table>";

                    }
                 ?>
            <div class="col-md-1"></div>
            </div>
        </div>
    </div>

    <?php include '../home/footer.html'; ?>

    
</body>
</html>