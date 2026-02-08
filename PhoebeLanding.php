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

<body 

    class="bg-black text-white">
<div id="side-menu" class="fixed inset-y-0 left-0 w-72 bg-[#111] border-r border-gray-800 z-[100] transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-6">
        <div class="flex justify-between items-center mb-10">
            <h2 class="font-angas text-xl text-[#328396]">MENU</h2>
            <button onclick="toggleMenu()" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>
        
        <nav class="space-y-6">
            <a href="PhoebeLanding.php" class="flex items-center gap-4 text-gray-300 hover:text-[#328396] transition font-bold">
                <i class="fa-solid fa-house w-6"></i> Trang chủ
            </a>
            <a href="profile.php" class="flex items-center gap-4 text-[#328396] transition font-bold">
                <i class="fa-solid fa-user w-6"></i> Hồ sơ cá nhân
            </a>
            <a href="#" class="flex items-center gap-4 text-gray-300 hover:text-[#328396] transition font-bold">
                <i class="fa-solid fa-calendar-days w-6"></i> Sự kiện
            </a>
            <a href="logout.php" class="flex items-center gap-4 text-red-500 hover:bg-red-500/10 p-2 -ml-2 rounded-lg transition font-bold">
                <i class="fa-solid fa-right-from-bracket w-6"></i> Đăng xuất
            </a>
        </nav>
    </div>
</div>

<div id="menu-overlay" onclick="toggleMenu()" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[90] hidden opacity-0 transition-opacity duration-300"></div>
  <!-- Navbar -->
   
<nav class="navbar" id="navbar">
  <div class="nav-left">
    
<button id="menuTrigger" onclick="toggleMenu()" class="menu-btn">
    <i class="fa-solid fa-bars-staggered"></i>
</button>
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
    <!-- Language Selector -->
    <div class="relative inline-block" id="langDropdownContainer">
        <button class="flex items-center gap-1 px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-100 transition-all" onclick="toggleLangDropdown()">
            <i class="fa-solid fa-globe"></i>
            <span id="currentLang">VI</span>
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </button>
        <div id="langDropdownMenu" class="hidden absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-[1100] border border-gray-200">
            <a href="?lang=vi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <span class="mr-2">vn</span> Tiếng Việt
            </a>
            <a href="?lang=en" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <span class="mr-2">en</span> English
            </a>
        </div>
    </div>
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
                <a href="cap-lai-the.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                    <i class="fa-solid fa-credit-card mr-2"></i> Cấp lại thẻ thành viên
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

        <div style="width:100%;min-height:120px;background:#fff;position:relative;top:30px;z-index:2;"></div>
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
<div class="container py-8"> 
    <header class="header-nav-centered">
        <div class="nav-item-card group" onclick="window.location.href='hoat-dong.php'">
            <div class="nav-icon"><i class="fa-solid fa-gamepad"></i></div>
            <div class="nav-text">
                <h3>ACTIVITIES</h3>
                <p>Các hoạt động trong năm</p>
            </div>
        </div>

        <div class="nav-item-card group" onclick="window.location.href='thanh-tich.php'">
            <div class="nav-icon"><i class="fa-solid fa-trophy"></i></div>
            <div class="nav-text">
                <h3>ACHIEVEMENTS</h3>
                <p>Giải thưởng tại các kì thi</p>
            </div>
        </div>

        <div class="nav-item-card group" onclick="window.location.href='merchandise-page.php'">
            <div class="nav-icon"><i class="fa-solid fa-shirt"></i></div>
            <div class="nav-text">
                <h3>MERCHANDISE</h3>
                <p>Sản phẩm siêu chất</p>
            </div>
        </div>

        <div class="nav-item-card group" onclick="window.location.href='thanh-vien.php'">
            <div class="nav-icon"><i class="fa-solid fa-users"></i></div>
            <div class="nav-text">
                <h3>MEMBERS</h3>
                <p>Gương mặt tài năng</p>
            </div>
        </div>
    </header>
</div>

<div class="container py-12">
    <div class="about-wrapper animate-fadeIn">
        <div class="about-content">
            <h2 class="year-title">PhoebeTranCaoVan</h2>
            <p class="about-description">Câu lạc bộ Lập Trình trường THPT Trần Cao Vân là nơi hội tụ của những tâm hồn đam mê công nghệ. Chúng mình cùng nhau xây dựng những giá trị sáng tạo thực thụ thông qua các dự án thực tế.</p>
            
            <div class="about-stats-grid">
                <div class="about-stat-box">
                    <span class="stat-num text-gold">50+</span>
                    <span class="stat-label">Thành viên</span>
                </div>
                <div class="about-stat-box border-primary">
                    <span class="stat-num text-primary">10+</span>
                    <span class="stat-label">Dự án công nghệ</span>
                </div>
            </div>
        </div>
        <div class="about-visual">
            <div class="image-frame">
                <img src="img/club-work.jpg" alt="CLB Work">
            </div>
        </div>
    </div>
</div>

<div class="container py-8">
    <div class="flex-between mb-8">
        <h2 class="year-title">BÀI VIẾT MỚI NHẤT</h2>
        <a href="#" class="view-all-link">Xem tất cả bài viết <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <div class="articles-grid">
        <article class="article-block">
            <div class="article-thumb">
                <img src="img/post1.jpg" alt="Post 1">
                <span class="category-tag bg-primary">KIẾN THỨC</span>
            </div>
            <div class="article-body">
                <h3>Lộ trình học Web cho người mới bắt đầu</h3>
                <p>Chia sẻ về các công nghệ HTML, CSS và JS cần nắm vững để bắt đầu hành trình...</p>
                <div class="article-footer">
                    <span class="date"><i class="fa-regular fa-calendar"></i> 02/02/2026</span>
                    <button class="read-more-btn">ĐỌC TIẾP</button>
                </div>
            </div>
        </article>

        <article class="article-block">
            <div class="article-thumb">
                <img src="img/post2.jpg" alt="Post 2">
                <span class="category-tag bg-[#764ba2]">SỰ KIỆN</span>
            </div>
            <div class="article-body">
                <h3>Workshop Arduino tháng 1: Sáng tạo</h3> 
                <p>Buổi trải nghiệm thực tế với các cảm biến thông minh và giải pháp nhà tự động...</p>
                <div class="article-footer">
                    <span class="date"><i class="fa-regular fa-calendar"></i> 25/01/2026</span>
                    <button class="read-more-btn">ĐỌC TIẾP</button>
                </div>
            </div>
        </article>
    </div>
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

    <script src="script.js"></script>
</body>

</html>