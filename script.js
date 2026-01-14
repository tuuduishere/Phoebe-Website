// Bạn có thể thêm các xử lý JavaScript tại đây (ví dụ hiệu ứng, menu ẩn hiện, v.v.)

const navbar = document.getElementById('navbar');
const whiteBlock = document.getElementById('white-block');

// ========================================
// MOBILE MENU TOGGLE
// ========================================

// Lấy hamburger icon và menu
const hamburgerIcon = document.querySelector('.nav-left i');
const navMenu = document.querySelector('.nav-menu');

// Toggle menu khi click vào hamburger icon
if (hamburgerIcon && navMenu) {
    hamburgerIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        navMenu.classList.toggle('active');
        
        // Thay đổi icon khi menu mở/đóng
        if (navMenu.classList.contains('active')) {
            this.classList.remove('fa-bars-staggered');
            this.classList.add('fa-xmark');
        } else {
            this.classList.remove('fa-xmark');
            this.classList.add('fa-bars-staggered');
        }
    });

    // Đóng menu khi click bên ngoài
    document.addEventListener('click', function(e) {
        if (!navMenu.contains(e.target) && !hamburgerIcon.contains(e.target)) {
            navMenu.classList.remove('active');
            hamburgerIcon.classList.remove('fa-xmark');
            hamburgerIcon.classList.add('fa-bars-staggered');
        }
    });

    // Đóng menu khi click vào một link trong menu
    const menuLinks = navMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            hamburgerIcon.classList.remove('fa-xmark');
            hamburgerIcon.classList.add('fa-bars-staggered');
        });
    });
}

// ========================================
// NAVBAR THEME OBSERVER
// ========================================

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            navbar.classList.add('dark-theme');
        } else {
            navbar.classList.remove('dark-theme');
        }
    });
}, { threshold: 0.8 });
function openNfcPopup() {
    // Kiểm tra xem thiết bị có hỗ trợ NFC không
    if ('NFC' in window) {
    // Mở cửa sổ pop up cho quét thẻ
    alert('Mở cửa sổ quét thẻ NFC...'); // Thay thế bằng mã mở pop up thực tế
    } else {
    alert('Thiết bị không hỗ trợ NFC.');
    }
}

// Chỉ observe nếu whiteBlock tồn tại
if (whiteBlock) {
    observer.observe(whiteBlock);
}

console.log("Phoebe Landing Page Loaded");
function toggleDropdown() {
    const menu = document.getElementById('userDropdownMenu');
    menu.classList.toggle('hidden');
}

// Đóng menu nếu người dùng click ra ngoài khu vực dropdown
window.onclick = function(event) {
    if (!event.target.closest('#userDropdownContainer')) {
        const menu = document.getElementById('userDropdownMenu');
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    }
}