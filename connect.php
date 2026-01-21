<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "clb_manager"; // Đảm bảo tên này chính xác

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thiết lập tiếng Việt có dấu chuẩn xác
mysqli_set_charset($conn, "utf8mb4");
?>