<?php
session_start();

// ========================================
// DATABASE CONNECTION - WRAPPED DE TRANH CRASH
// ========================================
$dbConnected = false;
$members = [];
$totalMembers = 0;
$totalEvents = 0;
$totalAchievements = 0;

try {
    if (file_exists('connect.php')) {
        @include_once 'connect.php';
        if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
            $dbConnected = true;

            // Lấy danh sách thành viên
            $result = $conn->query("SELECT * FROM members ORDER BY ma_dinh_danh DESC");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $members[] = $row;
                }
                $totalMembers = count($members);
            }
        }
    }
} catch (Exception $e) {
    $dbConnected = false;
}

    // Thông báo kết nối thất bại
    if (!$dbConnected) {
        echo '<div style="position: fixed; top: 20px; right: 20px; background: #ff4655; color: white; padding: 15px 20px; border-radius: 8px; z-index: 9999;">
                <strong>⚠️ Cảnh báo:</strong> Kết nối cơ sở dữ liệu thất bại. Đang sử dụng dữ liệu mẫu.
              </div>';
    }

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | PhoebeTCV</title>
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/login-style.css" />
    <link rel="icon" href="img/logofavicon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="img/logofavicon.png" alt="Logo" class="sidebar-logo">
            <div class="sidebar-brand">
                <h2>PHOEBE ADMIN</h2>
                <span>Control Panel</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Menu Chính</div>
                <a href="#" class="nav-item active"><i class="fas fa-home"></i><span>Dashboard</span></a>
                <a href="#" class="nav-item"><i class="fas fa-users"></i><span>Thành viên</span><span class="badge"><?php echo $totalMembers; ?></span></a>
                <a href="#" class="nav-item"><i class="fas fa-calendar-alt"></i><span>Sự kiện</span></a>
                <a href="#" class="nav-item"><i class="fas fa-trophy"></i><span>Thành tích</span></a>
            </div>
            <div class="nav-section">
                <div class="nav-section-title">Quản lý</div>
                <a href="#" class="nav-item"><i class="fas fa-newspaper"></i><span>Tin tức</span></a>
                <a href="#" class="nav-item"><i class="fas fa-tags"></i><span>Merchandise</span></a>
                <a href="#" class="nav-item"><i class="fas fa-user-plus"></i><span>Đơn đăng ký</span><span class="badge">3</span></a>
            </div>
            <div class="nav-section">
                <div class="nav-section-title">Hệ thống</div>
                <a href="#" class="nav-item"><i class="fas fa-cog"></i><span>Cài đặt</span></a>
                <a href="#" class="nav-item"><i class="fas fa-chart-bar"></i><span>Thống kê</span></a>
                <a href="PhoebeLanding.php" class="nav-item"><i class="fas fa-globe"></i><span>Xem website</span></a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div class="user-details">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
                <a href="logout.php" style="color: var(--text-muted);"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
                <div>
                    <h1 class="page-title">Dashboard</h1>
                    <div class="breadcrumb"><a href="#">Trang chủ</a><span>/</span><span>Dashboard</span></div>
                </div>
            </div>
            <div class="topbar-right">
                <div class="search-box"><i class="fas fa-search"></i><input type="text" placeholder="Tìm kiếm..."></div>
                <button class="topbar-btn"><i class="fas fa-bell"></i><span class="notification-dot"></span></button>
                <button class="topbar-btn"><i class="fas fa-cog"></i></button>
            </div>
        </header>

        <div class="dashboard-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header"><div class="stat-icon blue"><i class="fas fa-users"></i></div><span class="stat-change up">+12%</span></div>
                    <div class="stat-value"><?php echo $totalMembers; ?></div>
                    <div class="stat-label">Tổng thành viên</div>
                </div>
                <div class="stat-card"><div class="stat-header"><div class="stat-icon green"><i class="fas fa-calendar-check"></i></div><span class="stat-change up">+5</span></div><div class="stat-value">12</div><div class="stat-label">Sự kiện trong năm</div></div>
                <div class="stat-card"><div class="stat-header"><div class="stat-icon yellow"><i class="fas fa-trophy"></i></div><span class="stat-change up">+3</span></div><div class="stat-value">8</div><div class="stat-label">Thành tích đạt được</div></div>
                <div class="stat-card"><div class="stat-header"><div class="stat-icon red"><i class="fas fa-user-clock"></i></div><span class="stat-change down">-2</span></div><div class="stat-value">3</div><div class="stat-label">Đơn chờ duyệt</div></div>
            </div>

            <div class="table-section">
                <div class="table-header">
                    <h2 class="table-title">Danh sách thành viên</h2>
                    <div class="table-actions">
                        <button class="btn btn-outline"><i class="fas fa-download"></i><span>Xuất Excel</span></button>
                        <button class="btn btn-primary" onclick="openModal()"><i class="fas fa-plus"></i><span>Thêm mới</span></button>
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr><th>Mã TV</th><th>Thành viên</th><th>Ban</th><th>Giới tính</th><th>Trạng thái</th><th>Hành động</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($member['ma_dinh_danh']); ?></strong></td>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar"><?php echo strtoupper(substr($member['ho_ten'], 0, 1)); ?></div>
                                    <div>
                                        <div class="member-name"><?php echo htmlspecialchars($member['ho_ten']); ?></div>
                                        <div class="member-email"><?php echo htmlspecialchars($member['gmail'] ?? 'N/A'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php
                                $ban = $member['ban'] ?? 'N/A';
                                $badgeClass = 'badge-blue';
                                if ($ban == 'Ban điều hành') $badgeClass = 'badge-red';
                                elseif ($ban == 'Ban thi đấu') $badgeClass = 'badge-green';
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($ban); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($member['gioi_tinh']); ?></td>
                            <td><span class="badge badge-green">Hoạt động</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Xem chi tiết" onclick="viewMember('<?php echo $member['ma_dinh_danh']; ?>')"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Chỉnh sửa" onclick="editMember('<?php echo $member['ma_dinh_danh']; ?>')"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete" title="Xóa" onclick="deleteMember('<?php echo $member['ma_dinh_danh']; ?>')"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="memberModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Thêm thành viên mới</h3>
                <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form id="memberForm" action="process_member.php" method="POST">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <div class="form-group">
                        <label>Họ và tên <span class="required">*</span></label>
                        <input type="text" class="form-control" name="ho_ten" required placeholder="Nhập họ tên">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Giới tính *</label>
                            <select class="form-control" name="gioi_tinh" required>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ban *</label>
                            <select class="form-control" name="ban" required>
                                <option value="Ban điều hành">Ban điều hành</option>
                                <option value="Ban thi đấu">Ban thi đấu</option>
                                <option value="Ban truyền thông">Ban truyền thông</option>
                                <option value="Ban thiết kế">Ban thiết kế</option>
                                <option value="Cựu học sinh">Cựu học sinh</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Ngày sinh *</label>
                            <input type="date" class="form-control" name="ngay_sinh" required>
                        </div>
                        <div class="form-group">
                            <label>Năm sinh *</label>
                            <input type="number" class="form-control" name="nam_sinh" required placeholder="VD: 2008">
                        </div>
                    </div>
                    <div class="form-group"><label>Email</label><input type="email" class="form-control" name="gmail" placeholder="example@gmail.com"></div>
                    <div class="form-group"><label>Facebook</label><input type="url" class="form-control" name="link_fb" placeholder="https://fb.com/..."></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal()">Hủy bỏ</button>
                <button type="submit" form="memberForm" class="btn btn-primary"><i class="fas fa-save"></i> <span>Lưu lại</span></button>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['status'])): ?>
    <?php 
        $status = $_GET['status'];
        // Mặc định cho trường hợp lỗi
        $msg = "Có lỗi xảy ra, vui lòng thử lại!";
        $color = "#cc8800"; // Vàng đậm đặc
        $icon = "fa-exclamation-triangle";

        if ($status === 'add_success') {
            $msg = "Đã thêm thành viên mới thành công!";
            $color = "#15803d"; // Xanh lá đậm (Green 700)
            $icon = "fa-check-circle";
        } elseif ($status === 'delete_success') {
            $msg = "Đã xóa thành viên khỏi hệ thống!";
            $color = "#b91c1c"; // Đỏ đậm (Red 700)
            $icon = "fa-trash-alt";
        }
    ?>
    
    <div id="toast-notification" style="
        position: fixed; 
        top: 30px; 
        right: 30px; 
        z-index: 99999; 
        min-width: 320px; 
        padding: 20px 25px; 
        border-radius: 12px; 
        color: #ffffff; 
        background-color: <?php echo $color; ?> !important; /* Sử dụng màu đặc hoàn toàn */
        display: flex; 
        align-items: center; 
        gap: 15px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.6); 
        border: 1px solid rgba(255,255,255,0.3);
        font-weight: 600;
        opacity: 1 !important;
        pointer-events: auto;
        animation: slideInLeft 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    ">
        <i class="fas <?php echo $icon; ?>" style="font-size: 1.5rem;"></i>
        <span style="font-size: 1rem; line-height: 1.4;"><?php echo $msg; ?></span>
    </div>

    <style>
        @keyframes slideInLeft {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <script>
        // Tự động ẩn thông báo sau 4 giây để người dùng kịp đọc
        setTimeout(() => {
            const toast = document.getElementById('toast-notification');
            if (toast) {
                toast.style.transform = 'translateX(120%)';
                toast.style.opacity = '0';
                toast.style.transition = 'all 0.5s ease-in';
                // Xóa tham số status trên URL để khi F5 không hiện lại thông báo
                const url = new URL(window.location);
                url.searchParams.delete('status');
                window.history.replaceState({}, '', url);
                
                setTimeout(() => toast.remove(), 500);
            }
        }, 4000);
    </script>
<?php endif; ?>

    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); document.getElementById('sidebarOverlay').classList.toggle('active'); }
        function openModal() { document.getElementById('memberModal').classList.add('active'); document.getElementById('memberForm').reset(); }
        function closeModal() { document.getElementById('memberModal').classList.remove('active'); }
        function deleteMember(id) {
            if (confirm('Bạn có chắc chắn muốn xóa thành viên ' + id + '?')) {
                const fd = new FormData(); fd.append('action', 'delete'); fd.append('ma_dinh_danh', id);
                fetch('process_member.php', { method: 'POST', body: fd }).then(() => location.reload());
            }
        }
        function deleteMember(id) {
    if (confirm('Bạn có chắc chắn muốn xóa thành viên ' + id + '?')) {
        const fd = new FormData(); 
        fd.append('action', 'delete'); 
        fd.append('ma_dinh_danh', id);
        
        fetch('process_member.php', { method: 'POST', body: fd })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === 'success') {
                // Tải lại trang kèm tham số status để hiện thông báo xóa thành công
                window.location.href = 'admin.php?status=delete_success';
            } else {
                alert('Không thể xóa thành viên này.');
            }
        });
    }
}
    </script>
    
</body>
</html>