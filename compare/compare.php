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
                <table class="col-md-1 text-center">
                    <thead  class="tableRowName">
                        <th>
                            CONTENT
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>productID</td>
                        </tr>   
                        <tr class="tableRowName">
                            <td>productName</td>
                        </tr>
                        <tr>
                            <td>unitPrice</td>
                        </tr>
                        <tr>
                            <td>categoryID</td>
                        </tr>
                        <tr>
                            <td>brandID</td>
                        </tr>
                        <tr>
                            <td>memory</td>
                        </tr>
                        <tr>
                            <td>speed</td>
                        </tr>
                        <tr>
                            <td>color</td>
                        </tr>
                        <tr>
                            <td>warranty</td>
                        </tr>
                        <tr>
                            <td>dimension</td>
                        </tr>
                        <tr>
                            <td>State</td>
                        </tr>                           
                    </tbody>
                </table>
                <?php
                    foreach ($_SESSION['compareItems'] as $item){
                        $productID = $item['productID'];
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
                            <th>
                                $productName
                            </th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>$productID</td>
                        </tr>   
                        <tr class='tableRowName'>
                            <td>$productName</td>
                        </tr>
                        <tr>
                            <td>$unitPrice$</td>
                        </tr>
                        <tr>
                            <td>$categoryID</td>
                        </tr>
                        <tr>
                            <td>$brandID</td>
                        </tr>
                        <tr>
                            <td>$memory</td>
                        </tr>
                        <tr>
                            <td>$speed</td>
                        </tr>
                        <tr>
                            <td>$color</td>
                        </tr>
                        <tr>
                            <td>$warranty</td>
                        </tr>
                        <tr>
                            <td>$dimension</td>
                        </tr>
                        <tr>
                            <td><a href='deleteCompare.php?productID=$productID'>Delete product</a></td>
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