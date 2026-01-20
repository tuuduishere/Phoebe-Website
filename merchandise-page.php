<?php
session_start();
$isLoggedIn = isset($_SESSION['id']) && isset($_SESSION['name']);
$userName = $isLoggedIn ? $_SESSION['name'] : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Phoebe Merchandise</title>
  <link rel="stylesheet" href="css/merchandise-style.css">
  <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar" id="navbar">
  <div class="nav-left">
    <i class="fa-solid fa-bars-staggered"></i>
    <img src="img/logolanding.png" alt="PhoebeLogo" class="logo">
    <span class="title">PhoebeTranCaoVan</span>
  </div>
  <ul class="nav-menu">
    <li><a href="PhoebeLanding.php">TRANG CHỦ</a></li>
    <li><a href="hoat-dong.php">HOẠT ĐỘNG</a></li>
    <li><a href="thanh-tich.php">THÀNH TÍCH</a></li>
    <li><a href="merchandise-page.php">MERCHANDISE</a></li>
    <li><a href="thanh-vien.php">THÀNH VIÊN</a></li>
    <li><a href="chieu-mo.php">THÔNG BÁO CHIÊU MỘ</a></li>
  </ul>
  <div class="nav-buttons flex items-center gap-4">
    <button class="btn-outline">Hội cựu học sinh CLB</button>
    
    <?php if ($isLoggedIn): ?>
        <div class="flex items-center gap-2 bg-[#328396] px-4 py-2 rounded-lg cursor-pointer" 
             onclick="window.location.href='profile.php'">
            <i class="fa-solid fa-circle-user"></i>
            <span>Xin chào, <?php echo htmlspecialchars($userName); ?></span>
        </div>
    <?php else: ?>
        <button class="btn-primary" onclick="window.location.href='login.php'">PHOEBE ID</button>
    <?php endif; ?>
</div>
</nav>
<div id="white-block" style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
  <h1>MERCHANDISE</h1>
  <!-- Thẻ bài sản phẩm -->
  <div class="product">
    <!-- Thẻ bài 1 -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="img/stuff.jpg" alt="Đồ dùng">
        </div>
        <div class="flip-card-back">
          <div class="product-name">Phoebe Stuff!</div>
          <div class="product-detail">Đồ dùng nhà Phoebe</div>
        </div>
      </div>
    </div>

    <!-- Thẻ bài 2 -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="img/collection.jpg" alt="Bộ sưu tập">
        </div>
        <div class="flip-card-back">
          <div class="product-name">Phoebe Collection!</div>
          <div class="product-detail">Bộ sưu tập nhà Phoebe</div>
        </div>
      </div>
    </div>
  </div>




<script src="script.js"></script>
</body>