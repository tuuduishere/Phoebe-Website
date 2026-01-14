<?php
session_start();
require_once 'connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($id) || empty($password)) {
        $error = 'Vui lòng nhập đầy đủ thông tin.';
    } else {
        // CẦN SỬA: JOIN với bảng members để lấy ho_ten
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
                // LƯU CẢ ID VÀ TÊN VÀO SESSION
                $_SESSION['id'] = $user['ma_dinh_danh'];
                $_SESSION['name'] = $user['ho_ten']; 
                
                // Chuyển về trang chủ PhoebeLanding.php
                header('Location: PhoebeLanding.php');
                exit;
            } else {
                $error = 'Mật khẩu không chính xác.';
            }
        } else {
            $error = 'Mã thành viên không tồn tại.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập | PhoebeTCV</title>
    <link rel="stylesheet" href="css/login-style.css" />
    <link rel="icon" href="img/logofavicon.png" type="image/x-icon">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <header class="login-header">
                <img src="img/logofavicon.png" alt="Phoebe Logo" class="logo">
                <h2>Đăng nhập thành viên</h2>
            </header>

            <?php if ($error): ?>
                <div class="error-message" style="color: #ff4d4d; background: #ffe6e6; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" autocomplete="off">
                <div class="input-group">
                    <label for="id" style="display: block; margin-bottom: 5px; font-weight: 500;">Mã thành viên</label>
                    <input type="text" id="id" name="id" 
                           placeholder="Nhập 6 chữ số" 
                           pattern="\d{6}" maxlength="6" 
                           value="<?php echo htmlspecialchars($id ?? ''); ?>" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" />
                </div>

                <div class="input-group" style="margin-top: 15px;">
                    <label for="password" style="display: block; margin-bottom: 5px; font-weight: 500;">Mật khẩu</label>
                    <input type="password" id="password" name="password" 
                           placeholder="Nhập mật khẩu" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" />
                </div>

                <button type="submit" class="btn-login" style="width: 100%; margin-top: 20px; padding: 12px; background: #328396; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Đăng nhập</button>
                
                <div style="display: flex; align-items: center; margin: 20px 0; gap: 10px;">
                  <div style="flex: 1; height: 1px; background: #ddd;"></div>
                  <span style="color: #666; font-size: 14px; font-weight: 500;">HOẶC</span>
                  <div style="flex: 1; height: 1px; background: #ddd;"></div>
                </div>
                
                <button type="button" class="btn-nfc" onclick="openNfcPopup()" style="width: 100%; padding: 12px; background: transparent; border: 1px solid #328396; color: #328396; border-radius: 4px; cursor: pointer;">
                    Quét thẻ thành viên
                </button>
            </form>
        </div>
    </div>
</body>
</html>