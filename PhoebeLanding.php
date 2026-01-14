<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập chưa
$isLoggedIn = isset($_SESSION['id']) && isset($_SESSION['name']);
$userName = $isLoggedIn ? $_SESSION['name'] : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href='img/logofavicon.png' rel='icon'/>
  <title>PhoebeTranCaoVan</title>
  <link rel="stylesheet" href="css/home-style.css">
  <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white">

  <!-- Navbar -->
<nav class="navbar" id="navbar">
  <div class="nav-left">
    <i class="fa-solid fa-bars-staggered"></i>
    <img src="img/logofavicon.png" alt="PhoebeLogo" class="logo">
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
        <div class="relative inline-block text-left" id="userDropdownContainer">
            <div class="flex items-center gap-2 bg-[#328396] hover:bg-[#256675] px-4 py-2 rounded-lg transition-all cursor-pointer border border-white/20" 
                 onclick="toggleDropdown()">
                <i class="fa-solid fa-circle-user text-xl"></i>
                <span class="text-sm font-semibold whitespace-nowrap">
                    Xin chào, <?php echo htmlspecialchars($userName); ?>
                </span>
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </div>

            <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-[1100] border border-gray-200">
                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                    <i class="fa-solid fa-id-card mr-2"></i> Thông tin cá nhân
                </a>
                <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Đăng xuất
                </a>
            </div>
        </div>
    <?php else: ?>
        <button class="btn-primary" onclick="window.location.href='login.php'">
            PHOEBE ID
        </button>
    <?php endif; ?>
</div>
</nav>

        <div style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
        <!-- Background Video -->
        <div class="video-area">
            <div class="video-wrapper">
            <div class="video-container">
                <video autoplay muted loop playsinline class="video-bg" style="pointer-events: none;">
                <source src="img/background.mp4" type="video/mp4">
                Trình duyệt của bạn không hỗ trợ video.
                </video>
            </div>
            </div>
            <div id="white-block" style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
            <div class="gradient-transition"></div>
        </div>
<!-- REWORK LẠI BODY -->
    <!-- Thông tin về website -->
    <div class="container">

        <header class="header">
            <div class="header-item">
                <div class="icon game-icon"></div>
                <div class="text">
                    <h3>HOẠT ĐỘNG</h3>
                    <p>Các hoạt động của CLB trong năm</p>
                </div>
            </div>
            <div class="header-item">
                <div class="icon cyber-icon"></div>
                <div class="text">
                    <h3>THÀNH TÍCH</h3>
                    <p>Những thành tích mà CLB đã đạt được tại các kì thi</p>
                </div>
            </div>
            <div class="header-item">
                <div class="icon esports-icon active"></div>
                <div class="text">
                    <h3>MERCHANDISE</h3>
                    <p>Những sản phẩm siêu chất của CLB</p>
                </div>
            </div>
            <div class="header-item">
                <div class="icon business-icon"></div>
                <div class="text">
                    <h3>THÀNH VIÊN</h3>
                    <p>Những chiếc thành viên tài năng của CLB</p>
                </div>
            </div>
        </header>

        <section class="featured-tournaments">
            <div class="title-row">
                <h2>THÔNG TIN NỔI BẬT</h2>
                <div class="navigation-arrows">
                    <button class="arrow-btn left-arrow" disabled>&leftarrow;</button>
                    <button class="arrow-btn right-arrow">&rightarrow;</button>
                </div>
            </div>

            <div class="tournament-list">

                <div class="tournament-card finished">
                    <div class="card-image-wrapper">
                        <img src="placeholder-tft.jpg" alt="Teamfight Tactics" class="card-image">
                        <div class="game-logo tft-logo">T</div>
                    </div>
                    <div class="card-content">
                        <h4>NSOC 2025 - Đấu Trường Chân Lý</h4>
                        <div class="info-row">
                            <span class="label">Slots</span>
                            <span class="value">4000/4000</span>
                        </div>
                        <div class="prize">
                            <span class="cup-icon">🏆</span>
                            <span>345,000,000 VND</span>
                        </div>
                        <div class="status finished-status">
                            <span class="dot"></span>
                            <span>Đã kết thúc</span>
                        </div>
                        <div class="schedule">
                            <span class="date">11/09/2025 - 06/12/2025</span>
                            <span class="location">Đấu Trường Chân Lý</span>
                        </div>
                        <button class="btn view-btn">Xem</button>
                    </div>
                </div>

                <div class="tournament-card finished">
                    <div class="card-image-wrapper">
                        <img src="placeholder-valorant.jpg" alt="Valorant" class="card-image">
                        <div class="game-logo valorant-logo">V</div>
                    </div>
                    <div class="card-content">
                        <h4>NSOC 2025 - Valorant</h4>
                        <div class="info-row">
                            <span class="label">Slots</span>
                            <span class="value">200/200</span>
                        </div>
                        <div class="prize">
                            <span class="cup-icon">🏆</span>
                            <span>540,000,000 VND</span>
                        </div>
                        <div class="status finished-status">
                            <span class="dot"></span>
                            <span>Đã kết thúc</span>
                        </div>
                        <div class="schedule">
                            <span class="date">11/09/2025 - 06/12/2025</span>
                            <span class="location">Valorant</span>
                        </div>
                        <button class="btn view-btn">Xem</button>
                    </div>
                </div>

                <div class="tournament-card ongoing">
                    <div class="card-image-wrapper">
                        <img src="placeholder-netnennet.jpg" alt="Nét Nền Net Tournament" class="card-image">
                        <div class="game-logo netnennet-logo">T</div>
                    </div>
                    <div class="card-content">
                        <h4>Nét Nền Net Tournament Mùa 11</h4>
                        <div class="info-row">
                            <span class="label">Slots</span>
                            <span class="value">139/139</span>
                        </div>
                        <div class="prize">
                            <span class="cup-icon">🏆</span>
                            <span>8,000,000 VND</span>
                        </div>
                        <div class="status">
                            <span class="dot"></span>
                            <span>Đã kết thúc</span>
                        </div>
                        <div class="schedule">
                            <span class="date">12/11/2025 - 21/11/2025</span>
                            <span class="location">Đấu Trường Chân Lý</span>
                        </div>
                        <button class="btn view-btn">Xem</button>
                    </div>
                </div>

                <div class="tournament-card upcoming">
                    <div class="card-image-wrapper">
                        <img src="placeholder-giochomo.jpg" alt="Giờ Chợ Mở Mùa 7" class="card-image">
                        <div class="game-logo giochomo-logo">TFF</div>
                    </div>
                    <div class="card-content">
                        <h4>Giờ Chợ Mở Mùa 7</h4>
                        <div class="info-row">
                            <span class="label">Slots</span>
                            <span class="value empty">0/20</span>
                        </div>
                        <div class="prize">
                            <span class="cup-icon">🏆</span>
                            <span>8,200,000 VND</span>
                        </div>
                        <div class="status upcoming-status">
                            <span class="dot"></span>
                            <span>Đợt Kích</span>
                        </div>
                        <div class="schedule">
                            <span class="date">22/09/2025 - 28/09/2025</span>
                            <span class="location">Đợt Kích</span>
                        </div>
                        <button class="btn register-btn">Đăng ký</button>
                    </div>
                </div>

            </div>
        </section>

    </div>
    
 <!-- Footer -->
    <!-- Gradient từ đen sang tím trước footer -->
    <div class="w-full h-12">
        <div style="
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #328396 100%);
      ">
        </div>
    </div>
    <footer class="compact-footer-dark">
        <div class="footer-container-narrow">
            
            <div class="footer-left-content">
                
                <div class="brand-group">
                    <img src="img/logofavicon.png" alt=""> <span class="brand-name">PhoebeTranCaoVan</span>
                </div>
                
                <span class="copyright-text">
                    &copy; 2025. All Rights Reserved.
                </span>
            </div>
            
            <div class="footer-right-content">
                
                <div class="footer-links-inline">
                    <a href="#">Dịch Vụ</a>
                    <a href="#">Sự Kiện</a>
                    <a href="#">Liên Hệ</a>
                    <a href="#">Điều Khoản</a>
                </div>

                <div class="social-icons-compact">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Discord"><i class="fab fa-discord"></i></a>
                    <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>

        </div>
    </footer>

</body>

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