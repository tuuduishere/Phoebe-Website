<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // XỬ LÝ THÊM MỚI
    if ($action === 'add') {
        $ho_ten    = $_POST['ho_ten'] ?? '';
        $gioi_tinh = $_POST['gioi_tinh'] ?? '';
        $ngay_sinh = $_POST['ngay_sinh'] ?? '';
        $nam_sinh  = $_POST['nam_sinh'] ?? '';
        $ban       = $_POST['ban'] ?? '';
        $gmail     = $_POST['gmail'] ?? null;
        $link_fb   = $_POST['link_fb'] ?? null;

        $sql = "INSERT INTO members (ho_ten, gioi_tinh, ngay_sinh, nam_sinh, ban, gmail, link_fb) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $ho_ten, $gioi_tinh, $ngay_sinh, $nam_sinh, $ban, $gmail, $link_fb);
        
        if ($stmt->execute()) {
            // Chuyển hướng về trang admin kèm thông báo thành công
            header("Location: admin.php?status=add_success");
            exit();
        } else {
            header("Location: admin.php?status=error");
            exit();
        }
    }

    // XỬ LÝ XÓA
    if ($action === 'delete') {
        $id = $_POST['ma_dinh_danh'] ?? '';
        $stmt = $conn->prepare("DELETE FROM members WHERE ma_dinh_danh = ?");
        $stmt->bind_param("s", $id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
        exit();
    }
}
?>