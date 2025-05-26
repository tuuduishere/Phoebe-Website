<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Admin - Quản lý thành viên</title>
  <link rel="stylesheet" href="style.css"> <!-- nếu có -->
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
    th { background-color: #7454a4; color: #fff; }
    a.delete { color: red; text-decoration: none; }
  </style>
</head>
<body>
  <h2>Danh sách thành viên CLB</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Tên</th>
      <th>Email</th>
      <th>Ngày tham gia</th>
      <th>Thao tác</th>
    </tr>
    <?php
    $result = $conn->query("SELECT id, ho_ten, password, email, role, ngay_tham_gia FROM thanh_vien");
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['ho_ten']}</td>
            <td>{$row['email']}</td>
            <td>{$row['ngay_tham_gia']}</td>
            <td><a href='delete.php?id={$row['id']}' class='delete' onclick='return confirm(\"Xóa thành viên này?\")'>Xóa</a></td>
          </tr>";
    }
    ?>
  </table>
</body>
</html>

