
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php
$hostName = "localhost:3306";
$userName = "root";
$password = "12345678";
$databaseName = "eproject";

$conn = new mysqli($hostName, $userName, $password, $databaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = $_GET['search'];

// Use LIMIT to restrict the number of results to 4
$sql = "SELECT productName, imageLink FROM products WHERE productName LIKE '%$searchQuery%' LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output results as an HTML list
    while ($row = $result->fetch_assoc()) {
        echo "<table>";
        echo "<tr>";
        echo "<td>";
        echo "<img src='" . $row['imageLink'] . "' alt='Product Image' style='width: 30x; height: 30px;'>";
        echo "<h8 class='card-title fw-bold text-uppercase'>" . $row['productName'] . "</h8>";
        echo "</td>"."</br>";
        echo "</tr>";
        echo "</table>";
    }
} else {
    // No results found
    echo "<li>No products found.</li>";
}


?>
  
  </body>
</html>
