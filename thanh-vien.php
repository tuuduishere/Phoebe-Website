<?php
session_start();
$isLoggedIn = isset($_SESSION['id']) && isset($_SESSION['name']);
$userName = $isLoggedIn ? $_SESSION['name'] : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='img/logofavicon.png' rel='icon' />
    <title>Thành Viên | PhoebeTranCaoVan</title>
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/pages-style.css">
    <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white">
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
    <!-- Thanh điều hướng -->
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
            <li><a href="thanh-vien.php" class="active">THÀNH VIÊN</a></li>
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

    <div style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>

    <!-- Tiêu đề trang -->
    <section class="page-header members-header">
        <div class="container">
            <h1 class="page-title">MEMBERS</h1>
            <p class="page-subtitle">Đội ngũ thành viên CLB Tin học Trần Cao Vân</p>
        </div>
    </section>
<div id="white-block" style="width:100%;min-height:40px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
    <!-- Nội dung chính -->
    <div class="container">

        <!-- Ban Chủ nhiệm -->
        <section class="members-section">
            <div class="title-row">
                <h2>BAN ĐIỀU HÀNH</h2>
            </div>

            <div class="leadership-grid">

                <div class="leader-card">
                    <div class="leader-image">
                        <img src="https://via.placeholder.com/200x200/328396/ffffff?text=CN" alt="Chủ nhiệm CLB">
                        <div class="leader-badge">Chủ nhiệm</div>
                    </div>
                    <div class="leader-info">
                        <h3>Lê Quốc Vinh</h3>
                        <p class="leader-role">Lớp 11 Trần Cao Vân</p>
                        <p class="leader-description">Dẫn dắt và điều hành CLB nhiệm kỳ 25-26. Phụ trách định hướng phát triển và các
                            dự án web của CLB.</p>
                        <div class="leader-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="leader-card">
                    <div class="leader-image">
                        <img src="https://via.placeholder.com/200x200/764ba2/ffffff?text=PCN" alt="Phó Chủ nhiệm">
                        <div class="leader-badge">Phó Chủ nhiệm</div>
                    </div>
                    <div class="leader-info">
                        <h3>Nguyễn Ngọc Lữ Duyên</h3>
                        <p class="leader-role">Lớp 11 Trần Cao Vân</p>
                        <p class="leader-description">Hỗ trợ Chủ nhiệm trong việc điều phối các hoạt động và sự kiện của
                            CLB.</p>
                        <div class="leader-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>

                <div class="leader-card">
                    <div class="leader-image">
                        <img src="https://via.placeholder.com/200x200/f093fb/ffffff?text=TK" alt="Thủ quỹ">
                        <div class="leader-badge">Cố Vấn</div>
                    </div>
                    <div class="leader-info">
                        <h3>Nguyễn Cao Xuân Trung</h3>
                        <p class="leader-role">Cựu học sinh</p>
                        <p class="leader-description">Hỗ trợ giải quyết những vấn đề liên quan đến hoạt động của CLB.</p>
                        <div class="leader-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Các ban chuyên môn -->
        <section class="members-section">
            <div class="title-row">
                <h2>CÁC BAN CHUYÊN MÔN</h2>
            </div>

            <div class="members-grid">

                <div class="member-card">
                    <div class="member-avatar">
                        <img src="https://via.placeholder.com/150x150/667eea/ffffff?text=Code" alt="Ban Chuyên môn">
                    </div>
                    <div class="member-info">
                        <h4>Ban Chuyên môn</h4>
                        <p class="member-role">Luyện thi & Coding</p>
                        <div class="member-skills">
                            <span class="skill-tag">C/C++</span>
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">Algorithm</span>
                        </div>
                    </div>
                </div>

                <div class="member-card">
                    <div class="member-avatar">
                        <img src="https://via.placeholder.com/150x150/00c7e2/ffffff?text=Web" alt="Ban Web">
                    </div>
                    <div class="member-info">
                        <h4>Ban Kỹ thuật Web</h4>
                        <p class="member-role">Phát triển Website</p>
                        <div class="member-skills">
                            <span class="skill-tag">HTML/CSS</span>
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">PHP</span>
                        </div>
                    </div>
                </div>

                <div class="member-card">
                    <div class="member-avatar">
                        <img src="https://via.placeholder.com/150x150/ff4655/ffffff?text=Esports" alt="Ban Esports">
                    </div>
                    <div class="member-info">
                        <h4>Ban Esports</h4>
                        <p class="member-role">Gaming & Giải đấu</p>
                        <div class="member-skills">
                            <span class="skill-tag">Valorant</span>
                            <span class="skill-tag">TFT</span>
                            <span class="skill-tag">LOL</span>
                        </div>
                    </div>
                </div>

                <div class="member-card">
                    <div class="member-avatar">
                        <img src="https://via.placeholder.com/150x150/ffcc00/ffffff?text=IoT" alt="Ban IoT">
                    </div>
                    <div class="member-info">
                        <h4>Ban IoT - Robotics</h4>
                        <p class="member-role">Arduino & Raspberry Pi</p>
                        <div class="member-skills">
                            <span class="skill-tag">Arduino</span>
                            <span class="skill-tag">ESP32</span>
                            <span class="skill-tag">Sensor</span>
                        </div>
                    </div>
                </div>

                <div class="member-card">
                    <div class="member-avatar">
                        <img src="https://via.placeholder.com/150x150/9900ff/ffffff?text=Media" alt="Ban Truyền thông">
                    </div>
                    <div class="member-info">
                        <h4>Ban Truyền thông</h4>
                        <p class="member-role">Thiết kế & Nội dung</p>
                        <div class="member-skills">
                            <span class="skill-tag">Canva</span>
                            <span class="skill-tag">Photoshop</span>
                            <span class="skill-tag">Content</span>
                        </div>
                    </div>
                </div>

                <div class="member-card">
                    <div class="member-avatar">
                        <img src="https://via.placeholder.com/150x150/328396/ffffff?text=Event" alt="Ban Sự kiện">
                    </div>
                    <div class="member-info">
                        <h4>Ban Sự kiện</h4>
                        <p class="member-role">Tổ chức hoạt động</p>
                        <div class="member-skills">
                            <span class="skill-tag">Event</span>
                            <span class="skill-tag">MC</span>
                            <span class="skill-tag">Logistics</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Kêu gọi tham gia -->
        <section class="join-cta">
            <div class="cta-content">
                <h3>Muốn gia nhập CLB?</h3>
                <p>Chúng mình đang tìm kiếm những bạn đam mê Tin học!</p>
                <a href="chieu-mo.html" class="btn register-btn">Xem thông báo chiêu mộ</a>
            </div>
        </section>

    </div>

    <!-- Chân trang -->
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

    <script src="script.js"></script>
</body>

</html>