<?php
// PhoebeLanding.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <link href='img/logolanding.png' rel='icon' style="height: auto; width: auto;"/>
  <title>Rising Star</title>
  <link rel="stylesheet" href="css/logged-style.css">
  <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">

  <!-- Navbar -->
<nav class="navbar" id="navbar">
  <div class="nav-left">
    <i class="fa-solid fa-bars-staggered"></i>
    <img src="img/logolanding.png" alt="PhoebeLogo" class="logo">
    <span class="title">PhoebeTranCaoVan</span>
  </div>
  <ul class="nav-menu">
    <li><a href="PhoebeLanding.php">TRANG CHỦ</a></li>
    <li><a href="hoat-dong.html">HOẠT ĐỘNG</a></li>
    <li><a href="thanh-tich.html">THÀNH TÍCH</a></li>
    <li><a href="merchandise-page.html">MERCHANDISE</a></li>
    <li><a href="thanh-vien.html">THÀNH VIÊN</a></li>
    <li><a href="chieu-mo.html">THÔNG BÁO CHIÊU MỘ</a></li>
  </ul>
  <div class="nav-buttons">
    <button class="btn-outline">PROJECT</button>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'connect.php'; // file này cần kết nối đúng DB phoebedb

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // Truy vấn DB để xác thực lại ID
    $stmt = $conn->prepare("SELECT id FROM thanh_vien WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        echo '<button class="btn-primary" onclick="window.location.href=\'#\'">ID: ' . htmlspecialchars($row['id']) . '</button>';
    } else {
        echo '<button class="btn-primary" onclick="window.location.href=\'#\'">ID: ERROR</button>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo '<button class="btn-primary" onclick="window.location.href=\'login.php\'">TRANG CÁ NHÂN</button>';
}
?>
  </div>
</nav>

<div style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
  <!-- Background Video -->
<!-- index.html -->
<div class="video-area">
  <div class="video-wrapper">
    <div class="video-container">
      <video 
        autoplay 
        muted 
        loop 
        playsinline
        class="video-bg"
      >
        <source src="img/background.mp4" type="video/mp4">
        Trình duyệt của bạn không hỗ trợ video.
      </video>
    </div>
  </div>
  <!-- Vùng màu trắng cố định sau video, đè lên video một chút -->
  <div id="white-block" style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
  <!-- Gradient chuyển mượt sau video -->
  <div class="gradient-transition"></div>
</div>

<!-- Thông tin về website -->
<section class="intro-section">
  <h2>
    <?php
      // Kết nối đến cơ sở dữ liệu
      $conn = new mysqli("localhost", "root", "", "phoebedb");
      if ($conn->connect_error) {
      echo 'Welcome back <span class="highlight">User</span>';
      } else {
      if (isset($_SESSION['id'])) {
        $id = $conn->real_escape_string($_SESSION['id']);
        $sql = "SELECT hoten FROM thanh_vien WHERE id = '$id' LIMIT 1";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
        $hoten = htmlspecialchars($row['hoten']);
        echo "Welcome back <span class=\"highlight\">$hoten</span>";
        } else {
        echo 'Welcome back <span class="highlight">User</span>';
        }
      } else {
        echo 'Welcome back <span class="highlight">User</span>';
      }
      $conn->close();
      }
    ?>
    </h2>
    <!-- Thông tin cá nhân sẽ hiển thị ở đây: Họ tên, Email, Số điện thoại, Ngày sinh, Giới tính -->
    <section class="profile-info">
      <h3>Thông tin cá nhân</h3>
      <ul>
        <li><strong>Họ tên:</strong> ...</li>
        <li><strong>Email:</strong> ...</li>
        <li><strong>Số điện thoại:</strong> ...</li>
        <li><strong>Ngày sinh:</strong> ...</li>
        <li><strong>Giới tính:</strong> ...</li>
      </ul>
    </section>



<!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-brand">
      <img src="img/logolanding.png" alt="Phoebe Logo" class="footer-logo">
      <span class="footer-title">PhoebeTranCaoVan</span>
    </div>
    <div class="footer-info">
      <p>© 2025 PhoebeTCV. All rights reserved.</p>
      <p>Trường THPT Trần Cao Vân, Quảng Nam</p>
    </div>
    <div class="footer-social">
      <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
      <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="#" aria-label="Github"><i class="fab fa-github"></i></a>
    </div>
  </div>
</footer>


  <script src="script.js"></script>
</body>
</html>
