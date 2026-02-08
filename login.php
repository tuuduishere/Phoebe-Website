<?php
session_start();

// ========================================
// DATABASE CONNECTION - WRAPPED DE TRANH CRASH
// ========================================
$dbConnected = false;
$error = '';

// Thu ket noi database, neu that bai thi chi hien thi UI
try {
    if (file_exists('connect.php')) {
        @include_once 'connect.php';
        if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
            $dbConnected = true;
        }
    }
} catch (Exception $e) {
    $dbConnected = false;
}

// Xu ly form dang nhap (chi khi co DB)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'login' && $dbConnected) {
        $id = trim($_POST['id'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($id) || empty($password)) {
            $error = 'Vui long nhap day du thong tin.';
        } else {
            try {
                $stmt = $conn->prepare("
                    SELECT a.ma_dinh_danh, a.password, m.ho_ten
                    FROM accounts a
                    JOIN members m ON a.ma_dinh_danh = m.ma_dinh_danh
                    WHERE a.ma_dinh_danh = ?
                ");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($user = $result->fetch_assoc()) {
                    if ($password === $user['password']) {
                        $_SESSION['id'] = $user['ma_dinh_danh'];
                        $_SESSION['name'] = $user['ho_ten'];
                        header('Location: PhoebeLanding.php');
                        exit;
                    } else {
                        $error = 'Mat khau khong chinh xac.';
                    }
                } else {
                    $error = 'Ma thanh vien khong ton tai.';
                }
                $stmt->close();
            } catch (Exception $e) {
                $error = 'Loi he thong. Vui long thu lai sau.';
            }
        }
    }

    // Demo mode - khong co DB
    if (!$dbConnected && $_POST['action'] === 'login') {
        $error = 'He thong dang bao tri. Vui long quay lai sau.';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dang nhap | PhoebeTCV</title>
    <link rel="stylesheet" href="css/common.css"/>
    <link rel="stylesheet" href="css/login-style.css"/>
    <link rel="icon" href="img/logofavicon.png" type="image/x-icon">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <!-- Left Panel - Branding -->
    <div class="left-panel">
        <div class="brand-content">
            <img src="img/logofavicon.png" alt="Phoebe Logo" class="brand-logo">
            <h1 class="brand-title">PHOEBE ID</h1>
            <p class="brand-subtitle">He thong quan ly thanh vien CLB Tin hoc Tran Cao Van</p>

            <div class="features-list">
                <div class="feature-item">
                    <i class="fas fa-id-card"></i>
                    <span>Quan ly thong tin ca nhan</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Theo doi hoat dong CLB</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-trophy"></i>
                    <span>Cap nhat thanh tich</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bell"></i>
                    <span>Nhan thong bao su kien</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel - Form -->
    <div class="right-panel">
        <div class="login-container">
            <div class="login-box">
                <header class="login-header">
                    <img src="img/logofavicon.png" alt="Phoebe Logo" class="mobile-logo">
                    <h2>Chao mung tro lai!</h2>
                    <p>Dang nhap de truy cap he thong</p>
                </header>

                <!-- Tab Switcher -->
                <div class="tab-switcher">
                    <button class="tab-btn active" onclick="switchTab('login')">Dang nhap</button>
                    <button class="tab-btn" onclick="switchTab('register')">Dang ky</button>
                </div>

                <!-- Error Message -->
                <?php if ($error): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <div id="login-panel" class="form-panel active">
                    <form action="" method="POST" autocomplete="off">
                        <input type="hidden" name="action" value="login">

                        <div class="form-group">
                            <label for="id">Ma thanh vien <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="text" id="id" name="id"
                                       placeholder="Nhap 6 chu so"
                                       pattern="\d{6}" maxlength="6"
                                       value="<?php echo htmlspecialchars($_POST['id'] ?? ''); ?>"
                                       required />
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Mat khau <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="password" id="password" name="password"
                                       placeholder="Nhap mat khau" required />
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember">
                                <span>Ghi nho dang nhap</span>
                            </label>
                            <a href="#" class="forgot-link">Quen mat khau?</a>
                        </div>

                        <button type="submit" class="btn-login">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Dang nhap</span>
                        </button>
                    </form>

                    <div class="divider">
                        <span>HOAC</span>
                    </div>

                    <button id="nfc-scan-btn" class="btn-nfc" onclick="handleNFCScan()">
    <i class="fas fa-wifi" id="wifi-icon"></i>
    <span id="scan-text">Quét thẻ thành viên</span>
</button>
                </div>

                <!-- Register Form -->
                <div id="register-panel" class="form-panel">
                    <form action="" method="POST" autocomplete="off">
                        <input type="hidden" name="action" value="register">

                        <div class="form-group">
                            <label for="reg-name">Ho va ten <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="text" id="reg-name" name="fullname"
                                       placeholder="Nhap ho va ten" required />
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg-email">Email <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="email" id="reg-email" name="email"
                                       placeholder="Nhap dia chi email" required />
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg-phone">So dien thoai <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="tel" id="reg-phone" name="phone"
                                       placeholder="Nhap so dien thoai" required />
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg-password">Mat khau <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <input type="password" id="reg-password" name="password"
                                       placeholder="Tao mat khau" required />
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn-login">
                            <i class="fas fa-user-plus"></i>
                            <span>Dang ky thanh vien</span>
                        </button>

                        <p style="text-align: center; margin-top: 20px; color: #888; font-size: 0.85rem;">
                            <i class="fas fa-info-circle"></i>
                            Don dang ky se duoc BDH xem xet va phe duyet
                        </p>
                    </form>
                </div>

                <!-- Back to Home -->
                <div class="back-home">
                    <a href="PhoebeLanding.php">
                        <i class="fas fa-arrow-left"></i>
                        <span>Quay ve trang chu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab Switcher
        function switchTab(tab) {
            // Update buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update panels
            document.querySelectorAll('.form-panel').forEach(panel => {
                panel.classList.remove('active');
            });
            document.getElementById(tab + '-panel').classList.add('active');
        }
    </script>
</body>
</html>
