<?php
include 'connect.php';

// Xử lý thêm thành viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_member'])) {
  $hoten = trim($_POST['hoten']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = trim($_POST['role']);

  if ($hoten && $email && $password && $role) {
    $stmt = $conn->prepare("INSERT INTO thanh_vien (hoten, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $hoten, $email, $password, $role);
    $stmt->execute();
    $stmt->close();
    // Reload lại trang để cập nhật danh sách
    header("Location: admin.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Admin - Quản lý thành viên</title>
  <link rel="stylesheet" href="style.css">
  <style>
  body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
  table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
  th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
  th { background-color: #7454a4; color: #fff; }
  a.delete { color: red; text-decoration: none; }
  form.add-member { margin-bottom: 20px; background: #fff; padding: 16px; box-shadow: 0 0 8px rgba(0,0,0,0.08);}
  form.add-member input, form.add-member select { margin-right: 8px; padding: 6px; }
  form.add-member button { padding: 6px 16px; background: #7454a4; color: #fff; border: none; border-radius: 3px; }
  </style>
</head>
<body>
  <h2>Thêm thành viên mới</h2>
  <form class="add-member" method="post">
  <input type="text" name="hoten" placeholder="Tên coder" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Mật khẩu" required>
  <select name="role" required>
    <option value="">Chọn vai trò</option>
    <option value="admin">Admin</option>
    <option value="member">Member</option>
  </select>
  <button type="submit" name="add_member">Thêm</button>
  </form>

  <h2>Danh sách thành viên CLB</h2>
  <table>
  <tr>
    <th>ID</th>
    <th>Tên Coder</th>
    <th>Email</th>
    <th>Vai trò</th>
    <th>Thao tác</th>
  </tr>
  <?php
  $result = $conn->query("SELECT id, hoten, email, role FROM thanh_vien");
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['id']}</td>
      <td>{$row['hoten']}</td>
      <td>{$row['email']}</td>
      <td>{$row['role']}</td>
      <td><a href='delete.php?id={$row['id']}' class='delete' onclick='return confirm(\"Xóa thành viên này?\")'>Xóa</a></td>
      </tr>";
  }
  ?>
  </table>
</body>
</html>
