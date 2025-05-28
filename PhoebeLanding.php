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
  <link rel="stylesheet" href="home-style.css">
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
    <li><a href="#">HOẠT ĐỘNG</a></li>
    <li><a href="#">THÀNH TÍCH</a></li>
    <li><a href="#">MERCHANDISE</a></li>
    <li><a href="Members.html">THÀNH VIÊN</a></li>
    <li><a href="#">THÔNG BÁO CHIÊU MỘ</a></li>
  </ul>
  <div class="nav-buttons">
    <button class="btn-outline">PROJECT</button>
    <button class="btn-primary" onclick="window.location.href='login.php'">PHOEBE ID</button>
  </div>
</nav>

    <div style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
    <!-- Background Video -->
    <!-- index.html -->
    <div class="video-area">
        <div class="video-wrapper">
            <div class="video-container">
                <video autoplay muted loop playsinline class="video-bg">
                    <source src="img/background.mp4" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ video.
                </video>
            </div>
        </div>
        <!-- Vùng màu trắng cố định sau video, đè lên video một chút -->
        <div id="white-block" style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;">
        </div>
        <!-- Gradient chuyển mượt sau video -->
        <div class="gradient-transition"></div>
    </div>

    <!-- Thông tin về website -->
    <section class="intro-section">
        <h2>
            Introducing <span class="highlight">PhoebeTCV</span>
        </h2>
        <p>
            <span style="color: #7454a4; font-family:'Spaceland', sans-serif; font-size: 2rem;">PhoebeTCV</span> là CLB Lập
            trình Trường THPT Trần Cao Vân - tỉnh Quảng Nam. Bao gồm những bạn học sinh năng động, sáng tạo, nơi các thành
            viên cùng nhau phát triển kỹ năng, chia sẻ đam mê, kề vai thi đấu và xây dựng những dự án có ý nghĩa.<br>
            Chúng tớ hướng tới việc tạo ra môi trường thân thiện, chuyên nghiệp và đầy cảm hứng cho mọi người.
        </p>
        <div class="features">
            <div class="feature-item">
                <span class="icon">🏆</span>
                <h3>Achivement</h3>
                <p>Đạt nhiều giải thưởng trong các cuộc thi sáng tạo, lập trình và hoạt động cộng đồng.</p>
            </div>
            <div class="feature-item">
                <span class="icon">👥</span>
                <h3>Members</h3>
                <p>Quy tụ các bạn trẻ tài năng, nhiệt huyết, luôn sẵn sàng học hỏi và hỗ trợ lẫn nhau.</p>
            </div>
            <div class="feature-item">
                <span class="icon">💡</span>
                <h3>Project</h3>
                <p>Thực hiện nhiều dự án sáng tạo, mang lại giá trị thiết thực cho cộng đồng và xã hội.</p>
            </div>
        </div>
    </section>

    <section class="why-choose-section">
        <div class="why-container">
            <h2 class="why-title">Why choose us - <span class="highlight">PhoebeTCV</span> ?</h2>
            <ul class="why-list">
                <li>Môi trường học tập thân thiện, sáng tạo và chuyên nghiệp.</li>
                <li>Được hướng dẫn bởi các thành viên giàu kinh nghiệm, hỗ trợ tận tình.</li>
                <li>Cơ hội tham gia các cuộc thi, dự án thực tế và hoạt động ngoại khóa bổ ích.</li>
                <li>Kết nối, giao lưu với cộng đồng lập trình viên trẻ trên toàn quốc.</li>
            </ul>
            <div class="why-features">
                <div class="why-feature-box">
                    <span class="icon">🚀</span>
                    <h4>No Pain No Gain</h4>
                    <p>Slogan của Phoebe K01</p>
                </div>
                <div class="why-feature-box">
                    <span class="icon">🤝</span>
                    <h4>We Gotta Win 'One More'</h4>
                    <p>Slogan của Phoebe K02.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gradient từ đen sang tím trước footer -->
    <div class="w-full h-12">
        <div style="
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #7454a4 100%);
      ">
        </div>
    </div>
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

    <!-- Hero Section 
    <section class="hero">
        <div class="hero-content">
            <p class="hero-text">
                Vikings với sự đầu tư bài bản, kĩ lưỡng và kinh nghiệm hàng chục năm trong ngành đã, đang và sẽ luôn là môi trường sinh hoạt, luyện tập lý tưởng tạo nên những nhà vô địch Esports - Champions Begin
            </p>
            <button class="hero-button">CHI NHÁNH</button>
        </div>
    </section>
-->

    <script src="script.js"></script>
</body>

</html>