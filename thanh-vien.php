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

    <!-- Thanh điều hướng -->
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
            <li><a href="thanh-vien.php" class="active">THÀNH VIÊN</a></li>
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

    <div style="width:100%;min-height:80px;background:#fff;position:relative;top:-30px;z-index:2;"></div>

    <!-- Tiêu đề trang -->
    <section class="page-header members-header">
        <div class="container">
            <h1 class="page-title">THÀNH VIÊN</h1>
            <p class="page-subtitle">Đội ngũ thành viên CLB Tin học Trần Cao Vân</p>
        </div>
    </section>

    <!-- Nội dung chính -->
    <div class="container">

        <!-- Ban Chủ nhiệm -->
        <section class="members-section">
            <div class="title-row">
                <h2>BAN CHỦ NHIỆM</h2>
            </div>

            <div class="leadership-grid">

                <div class="leader-card">
                    <div class="leader-image">
                        <img src="https://via.placeholder.com/200x200/328396/ffffff?text=CN" alt="Chủ nhiệm CLB">
                        <div class="leader-badge">Chủ nhiệm</div>
                    </div>
                    <div class="leader-info">
                        <h3>Võ Lê Chí Dũng</h3>
                        <p class="leader-role">Founder - Full-Stack Developer</p>
                        <p class="leader-description">Sáng lập và điều hành CLB. Phụ trách định hướng phát triển và các
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
                        <h3>Chưa cập nhật</h3>
                        <p class="leader-role">Quản lý hoạt động</p>
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
                        <div class="leader-badge">Thủ quỹ</div>
                    </div>
                    <div class="leader-info">
                        <h3>Chưa cập nhật</h3>
                        <p class="leader-role">Quản lý tài chính CLB</p>
                        <p class="leader-description">Phụ trách thu chi, quản lý ngân sách và các khoản đóng góp của
                            CLB.</p>
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