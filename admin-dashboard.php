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

            // Lay danh sach thanh vien
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

// Demo data neu khong co DB
if (!$dbConnected || empty($members)) {
    $members = [
        ['ma_dinh_danh' => '250101', 'ho_ten' => 'Nguyen Van A', 'ban' => 'Ban dieu hanh', 'gmail' => 'a@example.com', 'gioi_tinh' => 'Nam'],
        ['ma_dinh_danh' => '250102', 'ho_ten' => 'Tran Thi B', 'ban' => 'Ban truyen thong', 'gmail' => 'b@example.com', 'gioi_tinh' => 'Nu'],
        ['ma_dinh_danh' => '250103', 'ho_ten' => 'Le Van C', 'ban' => 'Ban thi dau', 'gmail' => 'c@example.com', 'gioi_tinh' => 'Nam'],
        ['ma_dinh_danh' => '250104', 'ho_ten' => 'Pham Thi D', 'ban' => 'Ban thiet ke', 'gmail' => 'd@example.com', 'gioi_tinh' => 'Nu'],
        ['ma_dinh_danh' => '240201', 'ho_ten' => 'Hoang Van E', 'ban' => 'Cuu hoc sinh', 'gmail' => 'e@example.com', 'gioi_tinh' => 'Nam'],
    ];
    $totalMembers = count($members);
    $totalEvents = 12;
    $totalAchievements = 8;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | PhoebeTCV</title>
    <link rel="stylesheet" href="css/common.css" />
    <link rel="icon" href="img/logofavicon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/0880e589c1.js" crossorigin="anonymous"></script>
    <style>
        /* ========================================
           ADMIN DASHBOARD STYLES
           ======================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sidebar-width: 260px;
            --topbar-height: 70px;
            --primary: #328396;
            --primary-dark: #276a7a;
            --bg-dark: #1a1a1a;
            --bg-darker: #141414;
            --bg-card: #282828;
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
            --text-muted: #666;
            --border-color: #333;
            --success: #00c853;
            --warning: #ffcc00;
            --danger: #ff4655;
        }

        body {
            font-family: 'Kelson Sans', 'Segoe UI', sans-serif;
            background: var(--bg-darker);
            color: var(--text-white);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ========================================
           SIDEBAR
           ======================================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--bg-dark);
            border-right: 1px solid var(--border-color);
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar-logo {
            width: 45px;
            height: 45px;
        }

        .sidebar-brand {
            flex: 1;
        }

        .sidebar-brand h2 {
            font-family: 'Angas', sans-serif;
            font-size: 1.1rem;
            color: var(--text-white);
        }

        .sidebar-brand span {
            font-size: 0.75rem;
            color: var(--primary);
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-section {
            padding: 0 15px;
            margin-bottom: 25px;
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 1px;
            margin-bottom: 10px;
            padding-left: 15px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 10px;
            color: var(--text-gray);
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .nav-item:hover {
            background: rgba(50, 131, 150, 0.1);
            color: var(--text-white);
        }

        .nav-item.active {
            background: var(--primary);
            color: var(--text-white);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .nav-item span {
            font-size: 0.9rem;
        }

        .nav-item .badge {
            margin-left: auto;
            background: var(--danger);
            color: var(--text-white);
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border-color);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ========================================
           MAIN CONTENT
           ======================================== */

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* ========================================
           TOPBAR
           ======================================== */

        .topbar {
            position: sticky;
            top: 0;
            height: var(--topbar-height);
            background: var(--bg-dark);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 100;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-white);
            font-size: 1.3rem;
            cursor: pointer;
            padding: 8px;
        }

        .page-title {
            font-family: 'Angas', sans-serif;
            font-size: 1.4rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 15px 10px 40px;
            color: var(--text-white);
            font-size: 0.9rem;
            width: 250px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-gray);
            font-size: 1rem;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .topbar-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .topbar-btn .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
        }

        /* ========================================
           DASHBOARD CONTENT
           ======================================== */

        .dashboard-content {
            padding: 30px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-icon.blue { background: rgba(50, 131, 150, 0.2); color: var(--primary); }
        .stat-icon.green { background: rgba(0, 200, 83, 0.2); color: var(--success); }
        .stat-icon.yellow { background: rgba(255, 204, 0, 0.2); color: var(--warning); }
        .stat-icon.red { background: rgba(255, 70, 85, 0.2); color: var(--danger); }

        .stat-change {
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 5px;
        }

        .stat-change.up {
            background: rgba(0, 200, 83, 0.1);
            color: var(--success);
        }

        .stat-change.down {
            background: rgba(255, 70, 85, 0.1);
            color: var(--danger);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Data Table Section */
        .table-section {
            background: var(--bg-card);
            border-radius: 15px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .table-title {
            font-family: 'Angas', sans-serif;
            font-size: 1.2rem;
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--text-white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-gray);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .btn-icon {
            width: 35px;
            height: 35px;
            padding: 0;
            justify-content: center;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table th {
            background: rgba(50, 131, 150, 0.1);
            color: var(--text-gray);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table tbody tr {
            transition: background 0.2s ease;
        }

        .data-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .member-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .member-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .member-name {
            font-weight: 500;
        }

        .member-email {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-blue { background: rgba(50, 131, 150, 0.2); color: var(--primary); }
        .badge-green { background: rgba(0, 200, 83, 0.2); color: var(--success); }
        .badge-yellow { background: rgba(255, 204, 0, 0.2); color: var(--warning); }
        .badge-red { background: rgba(255, 70, 85, 0.2); color: var(--danger); }
        .badge-purple { background: rgba(116, 84, 162, 0.2); color: #a78bfa; }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .action-btn.delete:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        /* Pagination */
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            border-top: 1px solid var(--border-color);
        }

        .pagination-info {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .page-btn {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--text-white);
        }

        /* ========================================
           MODAL
           ======================================== */

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: var(--bg-card);
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            animation: modalSlide 0.3s ease;
        }

        @keyframes modalSlide {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-title {
            font-family: 'Angas', sans-serif;
            font-size: 1.3rem;
        }

        .modal-close {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-gray);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        .modal-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .form-group label .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: var(--bg-dark);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-white);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 20px 25px;
            border-top: 1px solid var(--border-color);
        }

        /* ========================================
           RESPONSIVE
           ======================================== */

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .search-box {
                display: none;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-content {
                padding: 20px 15px;
            }

            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .table-actions {
                width: 100%;
            }

            .table-actions .btn {
                flex: 1;
                justify-content: center;
            }

            .table-footer {
                flex-direction: column;
                gap: 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .modal {
                margin: 15px;
                max-height: calc(100vh - 30px);
            }
        }

        /* Sidebar Overlay (Mobile) */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
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
                <div class="nav-section-title">Main Menu</div>
                <a href="#" class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Thanh vien</span>
                    <span class="badge"><?php echo $totalMembers; ?></span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Su kien</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-trophy"></i>
                    <span>Thanh tich</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Management</div>
                <a href="#" class="nav-item">
                    <i class="fas fa-newspaper"></i>
                    <span>Tin tuc</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-tags"></i>
                    <span>Merchandise</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-user-plus"></i>
                    <span>Don dang ky</span>
                    <span class="badge">3</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">System</div>
                <a href="#" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Cai dat</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Thong ke</span>
                </a>
                <a href="PhoebeLanding.php" class="nav-item">
                    <i class="fas fa-globe"></i>
                    <span>Xem website</span>
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div class="user-details">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrator</div>
                </div>
                <a href="logout.php" style="color: var(--text-muted);">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="page-title">Dashboard</h1>
                    <div class="breadcrumb">
                        <a href="#">Home</a>
                        <span>/</span>
                        <span>Dashboard</span>
                    </div>
                </div>
            </div>
            <div class="topbar-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Tim kiem...">
                </div>
                <button class="topbar-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <button class="topbar-btn">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="stat-change up">+12%</span>
                    </div>
                    <div class="stat-value"><?php echo $totalMembers; ?></div>
                    <div class="stat-label">Tong thanh vien</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <span class="stat-change up">+5</span>
                    </div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Su kien trong nam</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon yellow">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <span class="stat-change up">+3</span>
                    </div>
                    <div class="stat-value">8</div>
                    <div class="stat-label">Thanh tich dat duoc</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon red">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <span class="stat-change down">-2</span>
                    </div>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Don cho duyet</div>
                </div>
            </div>

            <!-- Members Table -->
            <div class="table-section">
                <div class="table-header">
                    <h2 class="table-title">Danh sach thanh vien</h2>
                    <div class="table-actions">
                        <button class="btn btn-outline">
                            <i class="fas fa-download"></i>
                            <span>Xuat Excel</span>
                        </button>
                        <button class="btn btn-primary" onclick="openModal()">
                            <i class="fas fa-plus"></i>
                            <span>Them moi</span>
                        </button>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Ma TV</th>
                            <th>Thanh vien</th>
                            <th>Ban</th>
                            <th>Gioi tinh</th>
                            <th>Trang thai</th>
                            <th>Hanh dong</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($member['ma_dinh_danh']); ?></strong></td>
                            <td>
                                <div class="member-info">
                                    <div class="member-avatar">
                                        <?php echo strtoupper(substr($member['ho_ten'], 0, 1)); ?>
                                    </div>
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
                                if (strpos($ban, 'dieu hanh') !== false) $badgeClass = 'badge-red';
                                elseif (strpos($ban, 'thi dau') !== false) $badgeClass = 'badge-green';
                                elseif (strpos($ban, 'truyen thong') !== false) $badgeClass = 'badge-yellow';
                                elseif (strpos($ban, 'thiet ke') !== false) $badgeClass = 'badge-purple';
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($ban); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($member['gioi_tinh'] ?? 'N/A'); ?></td>
                            <td><span class="badge badge-green">Hoat dong</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Xem chi tiet" onclick="viewMember('<?php echo $member['ma_dinh_danh']; ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Chinh sua" onclick="editMember('<?php echo $member['ma_dinh_danh']; ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Xoa" onclick="deleteMember('<?php echo $member['ma_dinh_danh']; ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="table-footer">
                    <div class="pagination-info">
                        Hien thi 1-<?php echo count($members); ?> trong <?php echo count($members); ?> thanh vien
                    </div>
                    <div class="pagination">
                        <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Member Modal -->
    <div class="modal-overlay" id="memberModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Them thanh vien moi</h3>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="memberForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Ho va ten <span class="required">*</span></label>
                            <input type="text" class="form-control" name="ho_ten" placeholder="Nhap ho va ten" required>
                        </div>
                        <div class="form-group">
                            <label>Gioi tinh <span class="required">*</span></label>
                            <select class="form-control" name="gioi_tinh" required>
                                <option value="">Chon gioi tinh</option>
                                <option value="Nam">Nam</option>
                                <option value="Nu">Nu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Ngay sinh</label>
                            <input type="date" class="form-control" name="ngay_sinh">
                        </div>
                        <div class="form-group">
                            <label>Nam sinh <span class="required">*</span></label>
                            <input type="number" class="form-control" name="nam_sinh" placeholder="VD: 2007" min="2000" max="2010" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ban <span class="required">*</span></label>
                        <select class="form-control" name="ban" required>
                            <option value="">Chon ban</option>
                            <option value="Ban dieu hanh">Ban dieu hanh</option>
                            <option value="Ban thi dau">Ban thi dau</option>
                            <option value="Ban truyen thong">Ban truyen thong</option>
                            <option value="Ban thiet ke">Ban thiet ke</option>
                            <option value="Cuu hoc sinh">Cuu hoc sinh</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="gmail" placeholder="example@gmail.com">
                    </div>

                    <div class="form-group">
                        <label>Link Facebook</label>
                        <input type="url" class="form-control" name="link_fb" placeholder="https://facebook.com/...">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal()">Huy bo</button>
                <button class="btn btn-primary" onclick="saveMember()">
                    <i class="fas fa-save"></i>
                    <span>Luu lai</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        // Modal Functions
        function openModal(editMode = false) {
            document.getElementById('memberModal').classList.add('active');
            document.getElementById('modalTitle').textContent = editMode ? 'Chinh sua thanh vien' : 'Them thanh vien moi';
            if (!editMode) {
                document.getElementById('memberForm').reset();
            }
        }

        function closeModal() {
            document.getElementById('memberModal').classList.remove('active');
        }

        function saveMember() {
            // Placeholder - Backend integration needed
            alert('Chuc nang luu se duoc ket noi voi backend sau.');
            closeModal();
        }

        // Member Actions (Placeholders)
        function viewMember(id) {
            alert('Xem chi tiet thanh vien: ' + id);
        }

        function editMember(id) {
            openModal(true);
            // Load member data here
        }

        function deleteMember(id) {
            if (confirm('Ban co chac chan muon xoa thanh vien ' + id + '?')) {
                alert('Thanh vien ' + id + ' da duoc xoa (demo)');
            }
        }

        // Close modal when clicking outside
        document.getElementById('memberModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
