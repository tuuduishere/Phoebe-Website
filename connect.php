<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // điền nếu bạn có mật khẩu
$dbname = 'phoebedb';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Kết nối thất bại: ' . $conn->connect_error);
}
?>