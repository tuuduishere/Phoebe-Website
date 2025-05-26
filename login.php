<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập | PhoebeTCV</title>
  <link rel="stylesheet" href="login-style.css" />
  <link rel="icon" href="img/logolanding.png" type="image/x-icon">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <img src="img/logolanding.png" alt="Phoebe Logo" class="logo">
        <h2>Đăng nhập thành viên</h2>
      </div>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'phoebedb';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Kết nối thất bại: ' . $conn->connect_error);
}
?>
<?php
      $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Truy vấn thành viên role = 2 và có ID đúng
    $stmt = $conn->prepare("SELECT * FROM thanh_vien WHERE id = ? AND role = 2");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: PhoebeLogged.php');
            exit;
        } else {
            $error = 'Mật khẩu không đúng.';
        }
    } else {
        $error = 'Không tìm thấy thành viên phù hợp hoặc không có quyền truy cập.';
    }
}
      ?>
      <?php
      $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = trim($_POST['id'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Truy vấn thành viên role = 1 và có ID đúng
        $stmt = $conn->prepare("SELECT * FROM thanh_vien WHERE id = ? AND role = 1");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: admin.php');
        exit;
        } else {
        $error = 'Mật khẩu không đúng.';
        }
        } else {
        $error = 'Không tìm thấy thành viên phù hợp hoặc không có quyền truy cập.';
        }
    }
      ?>
      <?php if (!empty($error)): ?>
        <div class="error-message" style="color:red; margin-bottom:10px;">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>
      <form action="" method="POST">
  <label for="id">Mã thành viên (6 chữ số)</label>
  <input type="text" id="id" name="id" pattern="\d{6}" maxlength="6" required />

  <label for="password">Mật khẩu</label>
  <input type="password" id="password" name="password" required />

  <button type="submit">Đăng nhập</button>
</form>
    </div>
  </div>
</body>
</html>
