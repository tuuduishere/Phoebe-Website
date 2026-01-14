<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];
$message = '';

// 1. XỬ LÝ CẬP NHẬT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $ho_ten = $_POST['ho_ten'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gmail = $_POST['gmail'];
    $link_fb = $_POST['link_fb'];
    $nam_sinh = date('Y', strtotime($ngay_sinh)); // Tự động lấy năm từ ngày sinh

    $sql_update = "UPDATE members SET ho_ten=?, gioi_tinh=?, ngay_sinh=?, nam_sinh=?, gmail=?, link_fb=? WHERE ma_dinh_danh=?";
    $stmt_up = $conn->prepare($sql_update);
    $stmt_up->bind_param("sssssss", $ho_ten, $gioi_tinh, $ngay_sinh, $nam_sinh, $gmail, $link_fb, $id);
    
    if ($stmt_up->execute()) {
        $message = "Cập nhật thành công!";
        $_SESSION['name'] = $ho_ten;
    }
}

// 2. LẤY DỮ LIỆU HIỂN THỊ
$stmt = $conn->prepare("SELECT * FROM members WHERE ma_dinh_danh = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$member = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | <?php echo htmlspecialchars($member['ho_ten']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @font-face { font-family: "Angas"; src: url("fonts/angas/angas v3 bold.otf"); }
        .font-angas { font-family: "Angas", sans-serif; }
        
        /* Hiệu ứng thẻ thành viên */
        .id-card {
            background: linear-gradient(135deg, #328396 0%, #000000 100%);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .id-card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen pb-10">

    <div class="max-w-4xl mx-auto px-4 pt-10">
        <a href="PhoebeLanding.php" class="inline-block mb-6 text-gray-400 hover:text-[#328396] transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại Trang chủ
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            
            <div class="lg:col-span-2">
                <div class="id-card rounded-2xl p-6 shadow-2xl sticky top-10">
                    <div class="flex justify-between items-start mb-10">
                        <div>
                            <h2 class="font-angas text-xl tracking-wider">PHOEBE</h2>
                            <p class="text-[10px] text-gray-300 uppercase tracking-widest">Trần Cao Vân High School</p>
                        </div>
                        <img src="img/logofavicon.png" class="w-10 h-10 object-contain" alt="Logo">
                    </div>

                    <div class="flex gap-4 mb-6">
                        <div class="w-24 h-24 bg-gray-700 rounded-lg border-2 border-[#328396] flex items-center justify-center overflow-hidden">
                            <i class="fa-solid fa-user text-4xl text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] text-gray-400 uppercase">Họ và tên</p>
                            <p class="font-bold text-lg leading-tight mb-2"><?php echo htmlspecialchars($member['ho_ten']); ?></p>
                            <p class="text-[10px] text-gray-400 uppercase">Mã định danh</p>
                            <p class="font-mono text-[#328396] font-bold">#<?php echo $member['ma_dinh_danh']; ?></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-[11px]">
                        <div>
                            <p class="text-gray-400 uppercase">Bộ phận</p>
                            <p class="font-semibold"><?php echo $member['ban']; ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 uppercase">Thành viên từ</p>
                            <p class="font-semibold"><?php echo $member['nam_sinh'] + 15; ?> (Dự kiến)</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-white/10 flex justify-between items-center">
                        <div class="bg-white p-1 rounded">
                            <div class="w-8 h-8 bg-black"></div>
                        </div>
                        <p class="text-[9px] text-gray-500 italic">Official Member Card</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-8">
                    <h1 class="text-2xl font-bold mb-6 flex items-center">
                        <span class="w-2 h-8 bg-[#328396] mr-3 rounded-full"></span>
                        Cài đặt tài khoản
                    </h1>

                    <?php if ($message): ?>
                        <div class="mb-6 p-3 bg-green-500/20 border border-green-500/50 text-green-400 rounded-lg text-sm text-center">
                            <i class="fa-solid fa-check-circle mr-2"></i> <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST" class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Họ và Tên</label>
                                <input type="text" name="ho_ten" value="<?php echo htmlspecialchars($member['ho_ten']); ?>" required
                                       class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 focus:border-[#328396] outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Giới tính</label>
                                <select name="gioi_tinh" class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 focus:border-[#328396] outline-none">
                                    <option value="Nam" <?php echo $member['gioi_tinh'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                                    <option value="Nữ" <?php echo $member['gioi_tinh'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Ngày sinh</label>
                                <input type="date" name="ngay_sinh" value="<?php echo $member['ngay_sinh']; ?>" required
                                       class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 focus:border-[#328396] outline-none">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Gmail liên hệ</label>
                                <input type="email" name="gmail" value="<?php echo htmlspecialchars($member['gmail']); ?>"
                                       class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 focus:border-[#328396] outline-none">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Facebook URL</label>
                                <input type="url" name="link_fb" value="<?php echo htmlspecialchars($member['link_fb']); ?>"
                                       class="w-full bg-black border border-gray-800 rounded-xl px-4 py-3 focus:border-[#328396] outline-none">
                            </div>
                        </div>

                        <div class="pt-4 flex items-center gap-4">
                            <button type="submit" name="update_profile" class="flex-1 bg-[#328396] hover:bg-[#256675] py-3 rounded-xl font-bold transition">
                                Lưu thay đổi
                            </button>
                            <a href="logout.php" class="px-6 py-3 border border-red-500/50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition font-bold">
                                Đăng xuất
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>