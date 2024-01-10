<?php
require '../vendor/autoload.php'; 
include('../db/connect_db.php') ;
use PhpOffice\PhpWord\PhpWord;
if(isset($_GET['product_id'])){

$productId = $_GET['product_id'];

$query_product = "SELECT*FROM product where id = '$productId'";
$result = $conn->query($query_product);
$product;
if($result->num_rows >0) {
    $product=$result->fetch_assoc();
  }
$conn->close();
// Lấy thông tin sản phẩm từ yêu cầu


// Tạo tệp tin Word mới
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
// Chèn hình ảnh vào tệp tin Word
$productImage = "../image/product/{$product['thumbnail']}"; // Đường dẫn tới hình ảnh sản phẩm
$section->addText('Hình ảnh sản phẩm:');
$section->addImage($productImage, array('width' => 300, 'height' => 200));
// Lấy thông tin sản phẩm từ cơ sở dữ liệu hoặc nguồn dữ liệu khác

$productTitle = "{$product['title']}";
$productDescription = "{$product['description']}";
// ...



// Thêm thông tin sản phẩm vào tệp tin Word
$section->addText('Thông tin sản phẩm:');
$section->addText('Tên: ' . $productTitle);
$section->addText('Mô tả: ' . $productDescription);


// ...

// Lưu tệp tin Word
$filename = 'product_info.docx';
$phpWord->save($filename);

// Thiết lập tiêu đề và kiểu nội dung để tải xuống
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Đọc nội dung tệp tin Word và gửi về cho người dùng
readfile($filename);

// Xóa tệp tin Word sau khi đã gửi xong
unlink($filename);

}
echo "dowload thanh cong";

?>