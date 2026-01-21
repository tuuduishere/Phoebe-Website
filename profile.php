<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];
$message = '';
$error = '';

// 1. XỬ LÝ CẬP NHẬT THÔNG TIN & ẢNH ĐẠI DIỆN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   // XỬ LÝ ĐỔI MẬT KHẨU CÓ XÁC THỰC
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // 1. Kiểm tra mật khẩu cũ
    $stmt_check = $conn->prepare("SELECT password FROM accounts WHERE ma_dinh_danh = ?");
    $stmt_check->bind_param("s", $id);
    $stmt_check->execute();
    $res = $stmt_check->get_result()->fetch_assoc();

    if ($res['password'] !== $current_pass) {
        $error = "Mật khẩu hiện tại không chính xác!";
    } 
    // 2. Kiểm tra mật khẩu mới và xác nhận
    elseif ($new_pass !== $confirm_pass) {
        $error = "Mật khẩu mới và xác nhận không trùng khớp!";
    } 
    // 3. Kiểm tra mật khẩu mới có trùng mật khẩu cũ không
    elseif ($new_pass === $current_pass) {
        $error = "Mật khẩu mới không được trùng với mật khẩu cũ!";
    }
    // 4. Tiến hành cập nhật
    else {
        $stmt_pass = $conn->prepare("UPDATE accounts SET password = ? WHERE ma_dinh_danh = ?");
        $stmt_pass->bind_param("ss", $new_pass, $id);
        if ($stmt_pass->execute()) {
            $message = "Đã cập nhật mật khẩu mới thành công!";
        } else {
            $error = "Có lỗi xảy ra, vui lòng thử lại.";
        }
    }
}

    // Cập nhật thông tin cá nhân và Ảnh
    if (isset($_POST['update_profile'])) {
        $ho_ten = $_POST['ho_ten'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $ngay_sinh = $_POST['ngay_sinh'];
        $gmail = $_POST['gmail'];
        $link_fb = $_POST['link_fb'];
        $nam_sinh = date('Y', strtotime($ngay_sinh));

        // Xử lý Upload Ảnh (Nếu có)
        $avatar_path = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['avatar']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed)) {
                $new_filename = $id . "_" . time() . "." . $ext;
                $target = "uploads/avatars/" . $new_filename;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
                    $avatar_path = $target;
                    // Cập nhật cột avatar trong DB (Bạn cần thêm cột avatar VARCHAR(255) vào bảng members nếu chưa có)
                    $conn->query("UPDATE members SET avatar = '$avatar_path' WHERE ma_dinh_danh = '$id'");
                }
            }
        }

        $sql_update = "UPDATE members SET ho_ten=?, gioi_tinh=?, ngay_sinh=?, nam_sinh=?, gmail=?, link_fb=? WHERE ma_dinh_danh=?";
        $stmt_up = $conn->prepare($sql_update);
        $stmt_up->bind_param("sssssss", $ho_ten, $gioi_tinh, $ngay_sinh, $nam_sinh, $gmail, $link_fb, $id);
        
        if ($stmt_up->execute()) {
            $message = "Cập nhật thông tin thành công!";
            $_SESSION['name'] = $ho_ten;
        }
    }
}

// 2. LẤY DỮ LIỆU HIỂN THỊ
$stmt = $conn->prepare("SELECT * FROM members WHERE ma_dinh_danh = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$member = $stmt->get_result()->fetch_assoc();

// Mặc định ảnh nếu chưa có
$user_avatar = !empty($member['avatar']) ? $member['avatar'] : 'https://ui-avatars.com/api/?name='.urlencode($member['ho_ten']).'&background=328396&color=fff&size=128';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân | <?php echo htmlspecialchars($member['ho_ten']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face { font-family: "Angas"; src: url("fonts/angas/angas v3 bold.otf"); }
        .font-angas { font-family: "Angas", sans-serif; }
        body { background-color: #050505; color: white; font-family: 'Inter', sans-serif; }
        
        .id-card {
            background: linear-gradient(135deg, #1a4d59 0%, #000000 100%);
            border: 1px solid rgba(255,255,255,0.1);
            position: sticky; top: 2rem;
            transition: all 0.3s ease;
        }
        .id-card:hover { transform: translateY(-5px); border-color: #328396; }
        .glass-panel { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .input-dark { background: #111 !important; border: 1px solid #333 !important; color: white !important; }
        .input-dark:focus { border-color: #328396 !important; ring: 1px #328396; }
    </style>
</head>
<body class="pb-20">

    <div class="max-w-6xl mx-auto px-4 pt-10">
        <div class="flex justify-between items-center mb-8">
            <a href="PhoebeLanding.php" class="text-gray-400 hover:text-[#328396] transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Trang chủ
            </a>
            <div class="text-right">
                <p class="text-xs text-gray-500">ID Thành viên</p>
                <p class="font-mono text-[#328396] font-bold">#<?php echo $id; ?></p>
            </div>
        </div>

        <?php if ($message): ?>
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 text-green-400 rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4">
                <div class="id-card rounded-3xl p-6 shadow-2xl overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-8">
                            <h2 class="font-angas text-2xl tracking-tighter text-[#ffffff]">PHOEBE</h2>
                            <img src="img/logofavicon.png" class="w-8 h-8 opacity-80" alt="Logo">
                        </div>

                        <div class="flex flex-col items-center mb-6">
                            <div class="w-32 h-32 rounded-2xl border-2 border-[#328396] p-1 mb-4 bg-black/50">
                                <img src="<?php echo $user_avatar; ?>" class="w-full h-full object-cover rounded-xl" id="avatar-preview">
                            </div>
                            <h3 class="text-xl font-bold text-center"><?php echo htmlspecialchars($member['ho_ten']); ?></h3>
                            <span class="px-3 py-1 bg-[#328396]/20 text-[#328396] text-[10px] rounded-full font-bold uppercase mt-2">
                                <?php echo $member['ban']; ?>
                            </span>
                        </div>

                        <div class="space-y-3 border-t border-white/10 pt-4">
                            <div class="flex justify-between text-[11px]">
                                <span class="text-gray-500 uppercase tracking-widest">Năm gia nhập</span>
                                <span class="font-bold"><?php echo $member['nam_sinh'] + 15; ?></span>
                            </div>
                            <div class="flex justify-between text-[11px]">
                                <span class="text-gray-500 uppercase tracking-widest">Trạng thái</span>
                                <span class="text-green-400 font-bold">Active Member</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                
                <div class="glass-panel rounded-3xl p-8">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-user-gear text-[#328396]"></i> Thông tin cơ bản
                    </h2>
                    
                    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-full">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Ảnh đại diện mới</label>
                                <input type="file" name="avatar" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#328396] file:text-white hover:file:bg-[#256675]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Họ và Tên</label>
                                <input type="text" name="ho_ten" value="<?php echo htmlspecialchars($member['ho_ten']); ?>" required class="w-full px-4 py-3 rounded-xl input-dark outline-none transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Giới tính</label>
                                <select name="gioi_tinh" class="w-full px-4 py-3 rounded-xl input-dark outline-none transition">
                                    <option value="Nam" <?php echo $member['gioi_tinh'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                                    <option value="Nữ" <?php echo $member['gioi_tinh'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Ngày sinh</label>
                                <input type="date" name="ngay_sinh" value="<?php echo $member['ngay_sinh']; ?>" required class="w-full px-4 py-3 rounded-xl input-dark outline-none transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Gmail</label>
                                <input type="email" name="gmail" value="<?php echo htmlspecialchars($member['gmail']); ?>" class="w-full px-4 py-3 rounded-xl input-dark outline-none transition">
                            </div>

                            <div class="col-span-full">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Facebook Profile Link</label>
                                <input type="url" name="link_fb" value="<?php echo htmlspecialchars($member['link_fb']); ?>" class="w-full px-4 py-3 rounded-xl input-dark outline-none transition">
                            </div>
                        </div>

                        <button type="submit" name="update_profile" class="w-full py-4 bg-[#328396] hover:bg-[#256675] rounded-xl font-bold text-white shadow-lg shadow-[#328396]/20 transition-all uppercase tracking-widest text-xs">
                            Cập nhật hồ sơ
                        </button>
                    </form>
                </div>

                <div class="glass-panel rounded-3xl p-8 mt-6">
    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
        <i class="fa-solid fa-shield-halved text-red-500"></i> Bảo mật tài khoản
    </h2>

    <?php if ($error): ?>
        <div class="mb-4 p-3 bg-red-500/10 border border-red-500/50 text-red-500 rounded-xl text-sm">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-2 ml-1">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" required placeholder="••••••••" 
                   class="w-full px-4 py-3 rounded-xl input-dark outline-none transition border border-gray-800 focus:border-[#328396]">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-2 ml-1">Mật khẩu mới</label>
                <input type="password" name="new_password" required placeholder="Nhập mật khẩu mới" 
                       class="w-full px-4 py-3 rounded-xl input-dark outline-none transition border border-gray-800 focus:border-[#328396]">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-2 ml-1">Xác nhận mật khẩu mới</label>
                <input type="password" name="confirm_password" required placeholder="Nhập lại mật khẩu mới" 
                       class="w-full px-4 py-3 rounded-xl input-dark outline-none transition border border-gray-800 focus:border-[#328396]">
            </div>
        </div>

        <button type="submit" name="change_password" 
                class="w-full py-3 mt-2 border border-red-500/50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl font-bold transition-all text-xs uppercase tracking-widest">
            Xác nhận đổi mật khẩu
        </button>
    </form>
</div>

            </div>
        </div>
    </div>

</body>
</html>