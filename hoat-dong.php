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
    <title>Hoạt Động | PhoebeTranCaoVan</title>
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/pages-style.css">
    <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white">

    <!-- Thanh điều hướng -->
    <nav class="navbar" id="navbar">
        <div class="nav-left">
            <i class="fa-solid fa-bars-staggered"></i>
            <img src="img/logofavicon.png" alt="PhoebeLogo" class="logo">
            <span class="title">PhoebeTranCaoVan</span>
        </div>
        <ul class="nav-menu">
            <li><a href="PhoebeLanding.php">TRANG CHỦ</a></li>
            <li><a href="hoat-dong.php" class="active">HOẠT ĐỘNG</a></li>
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

    <!-- Tiêu đề trang -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">activities</h1>
            <p class="page-subtitle">Các hoạt động trong năm của CLB Tin học Trần Cao Vân</p>
        </div>
    </section>

    <!-- Nội dung chính -->
    <div class="container">

        <!-- Danh sách hoạt động -->
        <section class="activities-section">
            <div class="title-row">
                <h2>HOẠT ĐỘNG NĂM HỌC 2024 - 2025</h2>
            </div>

            <div class="activities-grid">

                <!-- Thẻ hoạt động 1 -->
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="https://via.placeholder.com/400x250/328396/ffffff?text=Phoebe+Workshop"
                            alt="Workshop lập trình">
                        <div class="activity-date">
                            <span class="day">08</span>
                            <span class="month">THG 9</span>
                        </div>
                    </div>
                    <div class="activity-content">
                        <span class="activity-tag">Workshop</span>
                        <h3>Khởi động năm học mới - Giới thiệu CLB</h3>
                        <p>Buổi sinh hoạt đầu năm giới thiệu về CLB, định hướng hoạt động và đón chào các thành viên mới
                            khóa 2024.</p>
                        <div class="activity-meta">
                            <span><i class="fas fa-users"></i> 50 thành viên</span>
                            <span><i class="fas fa-map-marker-alt"></i> Hội trường A</span>
                        </div>
                    </div>
                </div>

                <!-- Thẻ hoạt động 2 -->
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="https://via.placeholder.com/400x250/764ba2/ffffff?text=Code+Battle" alt="Code Battle">
                        <div class="activity-date">
                            <span class="day">15</span>
                            <span class="month">THG 10</span>
                        </div>
                    </div>
                    <div class="activity-content">
                        <span class="activity-tag">Nội bộ</span>
                        <h3>Phoebe Code Battle - Vòng loại</h3>
                        <p>Giải đấu lập trình nội bộ để chọn ra đội tuyển tham gia các kỳ thi cấp tỉnh và quốc gia năm
                            2025.</p>
                        <div class="activity-meta">
                            <span><i class="fas fa-users"></i> 32 thí sinh</span>
                            <span><i class="fas fa-laptop-code"></i> 3 vòng thi</span>
                        </div>
                    </div>
                </div>

                <!-- Thẻ hoạt động 3 -->
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="https://via.placeholder.com/400x250/f093fb/ffffff?text=20-11" alt="Ngày nhà giáo">
                        <div class="activity-date">
                            <span class="day">20</span>
                            <span class="month">THG 11</span>
                        </div>
                    </div>
                    <div class="activity-content">
                        <span class="activity-tag">Sự kiện</span>
                        <h3>Tri ân thầy cô nhân ngày 20/11</h3>
                        <p>CLB tổ chức hoạt động tri ân các thầy cô giáo hướng dẫn CLB nhân ngày Nhà giáo Việt Nam.</p>
                        <div class="activity-meta">
                            <span><i class="fas fa-heart"></i> Toàn CLB</span>
                            <span><i class="fas fa-gift"></i> Quà tặng thầy cô</span>
                        </div>
                    </div>
                </div>

                <!-- Thẻ hoạt động 4 -->
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="https://via.placeholder.com/400x250/667eea/ffffff?text=NSOC+2025" alt="NSOC 2025">
                        <div class="activity-date">
                            <span class="day">11</span>
                            <span class="month">THG 12</span>
                        </div>
                    </div>
                    <div class="activity-content">
                        <span class="activity-tag">Giải đấu</span>
                        <h3>Tham gia NSOC 2025</h3>
                        <p>Đội tuyển Phoebe chính thức tham gia National Student Olympiad in Computing 2025 tại TP.HCM.
                        </p>
                        <div class="activity-meta">
                            <span><i class="fas fa-users"></i> 8 thành viên</span>
                            <span><i class="fas fa-trophy"></i> Cấp quốc gia</span>
                        </div>
                    </div>
                </div>

                <!-- Thẻ hoạt động 5 -->
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="https://via.placeholder.com/400x250/00c7e2/ffffff?text=Year+End" alt="Tổng kết">
                        <div class="activity-date">
                            <span class="day">25</span>
                            <span class="month">THG 12</span>
                        </div>
                    </div>
                    <div class="activity-content">
                        <span class="activity-tag">Sự kiện</span>
                        <h3>Tiệc tổng kết cuối năm 2024</h3>
                        <p>Buổi gặp mặt cuối năm, ôn lại những kỷ niệm đẹp và trao phần thưởng cho các thành viên xuất
                            sắc.</p>
                        <div class="activity-meta">
                            <span><i class="fas fa-users"></i> Toàn CLB</span>
                            <span><i class="fas fa-music"></i> Giao lưu văn nghệ</span>
                        </div>
                    </div>
                </div>

                <!-- Thẻ hoạt động 6 -->
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="https://via.placeholder.com/400x250/ff4655/ffffff?text=Gaming" alt="Gaming Night">
                        <div class="activity-date">
                            <span class="day">--</span>
                            <span class="month">T.Bảy</span>
                        </div>
                    </div>
                    <div class="activity-content">
                        <span class="activity-tag">Hằng tuần</span>
                        <h3>Sinh hoạt CLB định kỳ</h3>
                        <p>Thứ Bảy hằng tuần: Luyện tập coding, ôn thi HSG, giao lưu Esports và chia sẻ kiến thức mới.
                        </p>
                        <div class="activity-meta">
                            <span><i class="fas fa-clock"></i> 14:00 - 17:00</span>
                            <span><i class="fas fa-map-marker-alt"></i> Phòng Tin học</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Sự kiện sắp tới -->
        <section class="upcoming-section">
            <div class="title-row">
                <h2>SẮP DIỄN RA</h2>
            </div>

            <div class="upcoming-list">
                <div class="upcoming-item">
                    <div class="upcoming-date">
                        <span class="day">05</span>
                        <span class="month">THG 1</span>
                    </div>
                    <div class="upcoming-info">
                        <h4>Luyện thi HSG Tin học cấp Tỉnh</h4>
                        <p><i class="fas fa-clock"></i> 08:00 - 11:00 | <i class="fas fa-map-marker-alt"></i> Phòng Tin
                            học</p>
                    </div>
                    <button class="btn view-btn">Chi tiết</button>
                </div>

                <div class="upcoming-item">
                    <div class="upcoming-date">
                        <span class="day">15</span>
                        <span class="month">THG 1</span>
                    </div>
                    <div class="upcoming-info">
                        <h4>Kỳ thi HSG Tin học cấp Tỉnh 2025</h4>
                        <p><i class="fas fa-clock"></i> Cả ngày | <i class="fas fa-map-marker-alt"></i> Sở GD&ĐT Quảng
                            Nam</p>
                    </div>
                    <button class="btn register-btn">Xem đội hình</button>
                </div>

                <div class="upcoming-item">
                    <div class="upcoming-date">
                        <span class="day">22</span>
                        <span class="month">THG 2</span>
                    </div>
                    <div class="upcoming-info">
                        <h4>Khai xuân 2025 - Gặp mặt đầu năm</h4>
                        <p><i class="fas fa-clock"></i> 09:00 - 12:00 | <i class="fas fa-map-marker-alt"></i> Sân trường
                        </p>
                    </div>
                    <button class="btn register-btn">Đăng ký</button>
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