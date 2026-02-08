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
    <title>Chiêu Mộ | PhoebeTranCaoVan</title>
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
            <li><a href="thanh-vien.php">THÀNH VIÊN</a></li>
            <li><a href="chieu-mo.php" class="active">THÔNG BÁO CHIÊU MỘ</a></li>
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
    <section class="page-header recruitment-header">
        <div class="container">
            <h1 class="page-title">recruitment</h1>
            <p class="page-subtitle">Tuyển thành viên CLB Tin học Trần Cao Vân năm học 2024 - 2025</p>
        </div>
    </section>
<div id="white-block" style="width:100%;min-height:40px;background:#fff;position:relative;top:-30px;z-index:2;"></div>
    <!-- Nội dung chính -->
    <div class="container">

        <!-- Banner tuyển dụng -->
        <section class="recruitment-banner">
            <div class="banner-content">
                <div class="banner-text">
                    <span class="banner-badge">ĐANG MỞ ĐƠN</span>
                    <h2>Tuyển Thành Viên Khóa 2025</h2>
                    <p>CLB Tin học PhoebeTranCaoVan đang tìm kiếm những bạn học sinh yêu thích công nghệ, lập trình và
                        muốn trải nghiệm những hoạt động bổ ích tại trường THPT Trần Cao Vân.</p>
                    <div class="banner-deadline">
                        <i class="fas fa-clock"></i>
                        <span>Hạn nộp đơn: <strong>Theo thông báo của CLB</strong></span>
                    </div>
                </div>
                <div class="banner-stats">
                    <div class="stat-item">
                        <span class="stat-num">15</span>
                        <span class="stat-text">Suất tuyển</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num">6</span>
                        <span class="stat-text">Ban hoạt động</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Các vị trí tuyển dụng -->
        <section class="positions-section">
            <div class="title-row">
                <h2>CÁC VỊ TRÍ TUYỂN DỤNG</h2>
            </div>

            <div class="positions-grid">

                <div class="position-card">
                    <div class="position-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="position-content">
                        <h3>Thành viên Ban Chuyên môn</h3>
                        <p>Luyện thi HSG, giải bài tập thuật toán, chuẩn bị cho các kỳ thi Tin học.</p>
                        <div class="position-requirements">
                            <h5>Yêu cầu:</h5>
                            <ul>
                                <li>Yêu thích lập trình C/C++ hoặc Python</li>
                                <li>Có tinh thần học hỏi, chịu khó luyện tập</li>
                                <li>Ưu tiên: Đã từng tham gia thi HSG</li>
                            </ul>
                        </div>
                        <div class="position-slots">
                            <span><i class="fas fa-users"></i> 3 vị trí</span>
                        </div>
                    </div>
                </div>

                <div class="position-card">
                    <div class="position-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <div class="position-content">
                        <h3>Thành viên Ban Kỹ thuật Web</h3>
                        <p>Xây dựng và bảo trì website CLB, làm các dự án web thực tế.</p>
                        <div class="position-requirements">
                            <h5>Yêu cầu:</h5>
                            <ul>
                                <li>Biết cơ bản HTML, CSS (hoặc sẵn sàng học)</li>
                                <li>Có khả năng làm việc nhóm</li>
                                <li>Ưu tiên: Biết JavaScript hoặc PHP</li>
                            </ul>
                        </div>
                        <div class="position-slots">
                            <span><i class="fas fa-users"></i> 3 vị trí</span>
                        </div>
                    </div>
                </div>

                <div class="position-card">
                    <div class="position-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="position-content">
                        <h3>Thành viên Ban Esports</h3>
                        <p>Tham gia đội tuyển Esports CLB, thi đấu các giải NSOC và giải nội bộ.</p>
                        <div class="position-requirements">
                            <h5>Yêu cầu:</h5>
                            <ul>
                                <li>Chơi tốt ít nhất 1 game: Valorant, TFT, LOL</li>
                                <li>Có thể tham gia luyện tập vào cuối tuần</li>
                                <li>Tinh thần đồng đội, không toxic</li>
                            </ul>
                        </div>
                        <div class="position-slots">
                            <span><i class="fas fa-users"></i> 5 vị trí</span>
                        </div>
                    </div>
                </div>

                <div class="position-card">
                    <div class="position-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <div class="position-content">
                        <h3>Thành viên Ban IoT - Robotics</h3>
                        <p>Làm các dự án Arduino, ESP32, tham gia cuộc thi Sáng tạo KHKT.</p>
                        <div class="position-requirements">
                            <h5>Yêu cầu:</h5>
                            <ul>
                                <li>Yêu thích điện tử, vi điều khiển</li>
                                <li>Chịu khó mày mò, thử nghiệm</li>
                                <li>Ưu tiên: Có kinh nghiệm Arduino</li>
                            </ul>
                        </div>
                        <div class="position-slots">
                            <span><i class="fas fa-users"></i> 2 vị trí</span>
                        </div>
                    </div>
                </div>

                <div class="position-card">
                    <div class="position-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="position-content">
                        <h3>Thành viên Ban Truyền thông</h3>
                        <p>Quản lý fanpage, thiết kế poster, viết bài cho các sự kiện CLB.</p>
                        <div class="position-requirements">
                            <h5>Yêu cầu:</h5>
                            <ul>
                                <li>Biết sử dụng Canva hoặc Photoshop</li>
                                <li>Có khả năng viết content</li>
                                <li>Ưu tiên: Có kinh nghiệm làm truyền thông</li>
                            </ul>
                        </div>
                        <div class="position-slots">
                            <span><i class="fas fa-users"></i> 2 vị trí</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Quyền lợi -->
        <section class="benefits-section">
            <div class="title-row">
                <h2>QUYỀN LỢI KHI THAM GIA CLB</h2>
            </div>

            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h4>Được hướng dẫn bởi anh chị khóa trên</h4>
                    <p>Học hỏi kinh nghiệm từ các thành viên đi trước qua các buổi sinh hoạt</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-project-diagram"></i></div>
                    <h4>Tham gia dự án thực tế</h4>
                    <p>Cơ hội làm website, app, robot... cho CLB và các cuộc thi</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-trophy"></i></div>
                    <h4>Thi đấu các giải lớn</h4>
                    <p>Đại diện CLB tham gia HSG Tin học, KHKT, NSOC...</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-users"></i></div>
                    <h4>Kết bạn với người cùng sở thích</h4>
                    <p>Môi trường thân thiện, gặp gỡ bạn bè yêu công nghệ</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-certificate"></i></div>
                    <h4>Giấy chứng nhận hoạt động</h4>
                    <p>Được cấp giấy xác nhận hoạt động ngoại khóa</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-tshirt"></i></div>
                    <h4>Đồng phục & quà CLB</h4>
                    <p>Nhận áo, sticker và merchandise độc quyền Phoebe</p>
                </div>
            </div>
        </section>

        <!-- Form đăng ký -->
        <section class="apply-section">
            <div class="title-row">
                <h2>ĐĂNG KÝ THAM GIA</h2>
            </div>

            <div class="apply-form-container">
                <form class="apply-form" action="#" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullname">Họ và Tên <span class="required">*</span></label>
                            <input type="text" id="fullname" name="fullname" placeholder="VD: Nguyễn Văn A" required>
                        </div>
                        <div class="form-group">
                            <label for="class">Lớp <span class="required">*</span></label>
                            <input type="text" id="class" name="class" placeholder="VD: 10A1" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Số điện thoại <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" placeholder="Số điện thoại liên hệ" required>
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook (link hoặc tên)</label>
                            <input type="text" id="facebook" name="facebook" placeholder="Để CLB liên hệ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="position">Ban muốn tham gia <span class="required">*</span></label>
                        <select id="position" name="position" required>
                            <option value="">-- Chọn ban --</option>
                            <option value="chuyen-mon">Ban Chuyên môn (Luyện thi)</option>
                            <option value="web">Ban Kỹ thuật Web</option>
                            <option value="esports">Ban Esports</option>
                            <option value="iot">Ban IoT - Robotics</option>
                            <option value="truyen-thong">Ban Truyền thông</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="reason">Tại sao bạn muốn vào CLB? <span class="required">*</span></label>
                        <textarea id="reason" name="reason" rows="3"
                            placeholder="Chia sẻ ngắn gọn về bản thân và lý do muốn tham gia CLB..."
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="skills">Kỹ năng / Kinh nghiệm (nếu có)</label>
                        <textarea id="skills" name="skills" rows="2"
                            placeholder="VD: Biết lập trình Pascal, từng tham gia thi HSG cấp trường..."></textarea>
                    </div>

                    <button type="submit" class="btn submit-btn">
                        <i class="fas fa-paper-plane"></i> Gửi đơn đăng ký
                    </button>
                </form>
            </div>
        </section>

        <!-- Thông tin liên hệ -->
        <section class="contact-section">
            <div class="contact-content">
                <h3>Có thắc mắc? Liên hệ ngay!</h3>
                <p>Inbox trực tiếp cho CLB qua các kênh sau:</p>
                <div class="contact-links">
                    <a href="#" class="contact-link">
                        <i class="fab fa-facebook-f"></i>
                        <span>Fanpage CLB</span>
                    </a>
                    <a href="#" class="contact-link">
                        <i class="fab fa-facebook-messenger"></i>
                        <span>Nhắn tin trực tiếp</span>
                    </a>
                    <a href="#" class="contact-link">
                        <i class="fas fa-user"></i>
                        <span>Gặp trực tiếp BCN</span>
                    </a>
                </div>
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