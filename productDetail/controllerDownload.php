<?php
require_once 'vendor/autoload.php'; // Đường dẫn đến autoload.php của thư viện PHPWord
// Kết nối cơ sở dữ liệu của bạn
$servername = "localhost";
$username = "root";
$password = "07122001";
$dbname = "eproject";

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn lấy dữ liệu từ bảng products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Sử dụng PHPWord để tạo tập tin Word
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();

// Thêm dữ liệu từ bảng products vào file Word
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $section->addText($row['product_name'] . ' - ' . $row['description']);
        // Bạn có thể thêm các thông tin khác của sản phẩm vào đây
    }
} else {
    $section->addText('Không có sản phẩm nào trong cơ sở dữ liệu.');
}

// Lưu tệp tin Word
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$filename = 'products_list.docx'; // Tên tập tin Word
$objWriter->save($filename);

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();

// Tải tệp tin Word về máy người dùng
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=" . $filename);
header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Length: " . filesize($filename));
readfile($filename);
exit;
?>
