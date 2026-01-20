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
    <link rel="stylesheet" href="css/common.css" />
    <link rel="icon" href="img/logofavicon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
    <style>
        /* ========================================
           LOGIN PAGE STYLES
           ======================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Kelson Sans', 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
            position: relative;
            overflow-x: hidden;
        }

        /* Background decoration */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 20% 80%, rgba(50, 131, 150, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(50, 131, 150, 0.08) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, -20px) rotate(5deg); }
        }

        /* Left Panel - Branding */
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: linear-gradient(135deg, #328396 0%, #276a7a 100%);
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .brand-content {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.3));
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .brand-title {
            font-family: 'Angas', sans-serif;
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            max-width: 300px;
            line-height: 1.6;
        }

        .features-list {
            margin-top: 40px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .feature-item i {
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        /* Right Panel - Form */
        .right-panel {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            z-index: 1;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-box {
            background: rgba(40, 40, 40, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .mobile-logo {
            display: none;
            width: 60px;
            margin-bottom: 15px;
        }

        .login-header h2 {
            font-family: 'Angas', sans-serif;
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #888;
            font-size: 0.95rem;
        }

        /* Tab Switcher */
        .tab-switcher {
            display: flex;
            background: #1a1a1a;
            border-radius: 12px;
            padding: 5px;
            margin-bottom: 30px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: transparent;
            color: #888;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: #328396;
            color: #ffffff;
        }

        .tab-btn:hover:not(.active) {
            color: #ffffff;
        }

        /* Form Panels */
        .form-panel {
            display: none;
        }

        .form-panel.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Error Message */
        .error-message {
            background: rgba(255, 77, 77, 0.1);
            border: 1px solid rgba(255, 77, 77, 0.3);
            color: #ff6b6b;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-message i {
            font-size: 1.1rem;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #b0b0b0;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #ff6b6b;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 10px;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #328396;
            box-shadow: 0 0 0 3px rgba(50, 131, 150, 0.1);
        }

        .form-group input:focus + i,
        .form-group input:focus ~ i {
            color: #328396;
        }

        .form-group input::placeholder {
            color: #555;
        }

        /* Remember & Forgot */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #888;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #328396;
            cursor: pointer;
        }

        .forgot-link {
            color: #328396;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #45a5ba;
        }

        /* Buttons */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #328396 0%, #276a7a 100%);
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(50, 131, 150, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            gap: 15px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #333;
        }

        .divider span {
            color: #666;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* NFC Button */
        .btn-nfc {
            width: 100%;
            padding: 14px;
            background: transparent;
            border: 2px solid #328396;
            border-radius: 10px;
            color: #328396;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-nfc:hover {
            background: rgba(50, 131, 150, 0.1);
        }

        .btn-nfc i {
            font-size: 1.2rem;
        }

        /* Back to Home */
        .back-home {
            text-align: center;
            margin-top: 25px;
        }

        .back-home a {
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .back-home a:hover {
            color: #328396;
        }

        /* ========================================
           RESPONSIVE
           ======================================== */

        @media (max-width: 992px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                flex: 1;
                padding: 20px;
            }

            .login-header .mobile-logo {
                display: inline-block;
            }
        }

        @media (max-width: 480px) {
            .right-panel {
                padding: 15px;
                align-items: flex-start;
                padding-top: 40px;
            }

            .login-box {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }

            .tab-btn {
                padding: 10px;
                font-size: 0.85rem;
            }

            .form-group input {
                padding: 12px 12px 12px 40px;
            }

            .form-options {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }
    </style>
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

                    <button type="button" class="btn-nfc" onclick="openNfcPopup()">
                        <i class="fas fa-wifi"></i>
                        <span>Quet the thanh vien</span>
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

        // NFC Popup
        function openNfcPopup() {
            if ('NDEFReader' in window) {
                alert('Dang mo cua so quet the NFC...');
            } else {
                alert('Thiet bi khong ho tro NFC hoac trinh duyet chua ho tro Web NFC.\nVui long su dung Chrome tren Android.');
            }
        }

        // Auto-format member ID input
        const idInput = document.getElementById('id');
        if (idInput) {
            idInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });
        }
    </script>
</body>
</html>
