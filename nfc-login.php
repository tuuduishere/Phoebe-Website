<?php
session_start();
// Kết nối database clb_manager
$conn = mysqli_connect("localhost", "root", "", "clb_manager");

if (isset($_GET['uid'])) {
    $uid = mysqli_real_escape_string($conn, $_GET['uid']);
    
    // Tìm thành viên trong database
    $sql = "SELECT ma_dinh_danh, ho_ten FROM members WHERE nfc_uid = '$uid' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Thiết lập Session khớp với code HTML của bạn
        $_SESSION['id'] = $row['ma_dinh_danh'];
        $_SESSION['name'] = $row['ho_ten'];
        
        // Chuyển hướng về trang chủ
        header("Location: PhoebeLanding.php");
        exit();
    }
}
?>