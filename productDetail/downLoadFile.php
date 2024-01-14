<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;

// Kết nối đến cơ sở dữ liệu MySQL
include('../db.php');

// Lấy productID từ tham số URL
$productID = isset($_GET['productID']) ? $_GET['productID'] : null;

// Kiểm tra xem productID có giá trị không
if ($productID) {
    // Thực hiện truy vấn để lấy thông tin sản phẩm của 3 bảng product, categories, brand
    $sql = "SELECT p.*, c.categoryName, b.brandName
                             FROM products p
                             LEFT JOIN category c ON p.categoryID = c.categoryID
                             LEFT JOIN brand b ON p.brandID = b.brandID
                             WHERE p.productID = '$productID'";
    $result = $conn->query($sql);

    // Tạo đối tượng PhpWord
    $phpWord = new PhpWord();

    // Tạo một mục mới
    $section = $phpWord->addSection();

    // Thêm dữ liệu từ cơ sở dữ liệu vào mục
    while ($row = $result->fetch_assoc()) {
        $section->addText('PRODUCT INFORMATION', ['size' => 20, 'bold' => true,'align' => 'center']);
        $section->addImage('../' . $row['imageLink'],array('width' => 300, 'height' => 200, 'align' => 'center'));
        $section->addText('Product name: ' . $row['productName']);
        $section->addText('Unit Price: $' . $row['unitPrice']);
        $section->addText('Quantity: ' . $row['quantity']);
        $section->addText('Category: ' . $row['categoryName']);
        $section->addText('Brand: ' . $row['brandName']);
        $section->addText('Memory: ' . $row['memory']);
        $section->addText('Speed: ' . $row['speed']);
        $section->addText('Color: ' . $row['color']);
        $section->addText('Warranty: ' . $row['warranty']);
        $section->addText('Dimension: ' . $row['dimension']);
        $section->addText('Description: ' . $row['description']);
        $section->addTextBreak();
    }

    // Lưu tệp Word
    $filename = 'productDetails_' . $productID . '.docx';
    $phpWord->save($filename);
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Đọc nội dung tệp tin Word và gửi về cho người dùng
    readfile($filename);

    // Xóa tệp tin Word sau khi đã gửi xong
    unlink($filename);

    echo 'File Word đã được tạo thành công: ' . $filename;
} else {
    echo 'Không có productID được cung cấp.';
}
?>
