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
    hamburgerIcon.addEventListener('click', function (e) {
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
    document.addEventListener('click', function (e) {
        if (!navMenu.contains(e.target) && !hamburgerIcon.contains(e.target)) {
            navMenu.classList.remove('active');
            hamburgerIcon.classList.remove('fa-xmark');
            hamburgerIcon.classList.add('fa-bars-staggered');
        }
    });

    // Đóng menu khi click vào một link trong menu
    const menuLinks = navMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            navMenu.classList.remove('active');
            hamburgerIcon.classList.remove('fa-xmark');
            hamburgerIcon.classList.add('fa-bars-staggered');
        });
    });
}

// ========================================
// NAVBAR THEME - SCROLL BASED
// Trang: den khi cuon xuong, trang o dau trang
// ========================================

// Nguong scroll de doi theme (pixels)
const SCROLL_THRESHOLD = 100;

// Ham xu ly scroll cho cac trang KHONG co white-block
function handleScrollTheme() {
    if (!navbar) return;

    if (window.scrollY > SCROLL_THRESHOLD) {
        navbar.classList.add('dark-theme');
    } else {
        navbar.classList.remove('dark-theme');
    }
}

// IntersectionObserver cho Landing page (co white-block)
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            navbar.classList.add('dark-theme');
        } else {
            navbar.classList.remove('dark-theme');
        }
    });
}, { threshold: 0.5 });

function openNfcPopup() {
    // Kiem tra xem thiet bi co ho tro NFC khong
    if ('NFC' in window) {
        // Mo cua so pop up cho quet the
        alert('Mo cua so quet the NFC...'); // Thay the bang ma mo pop up thuc te
    } else {
        alert('Thiet bi khong ho tro NFC.');
    }
}

// Chon phuong thuc dua tren trang
if (whiteBlock) {
    // Landing page: dung IntersectionObserver
    console.log("Navbar Theme: Using IntersectionObserver with white-block");
    observer.observe(whiteBlock);
} else if (navbar) {
    // Cac trang khac: dung scroll event
    console.log("Navbar Theme: white-block not found, using scroll fallback");
    window.addEventListener('scroll', handleScrollTheme, { passive: true });
    // Chay 1 lan khi load de set trang thai ban dau
    handleScrollTheme();
}

console.log("Phoebe Landing Page Loaded");
function toggleDropdown() {
    const menu = document.getElementById('userDropdownMenu');
    menu.classList.toggle('hidden');
}

// Đóng menu nếu người dùng click ra ngoài khu vực dropdown
window.onclick = function (event) {
    if (!event.target.closest('#userDropdownContainer')) {
        const menu = document.getElementById('userDropdownMenu');
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    }
    // Close language dropdown when clicking outside
    if (!event.target.closest('#langDropdownContainer')) {
        const langMenu = document.getElementById('langDropdownMenu');
        if (langMenu && !langMenu.classList.contains('hidden')) {
            langMenu.classList.add('hidden');
        }
    }
}

// Language Dropdown Toggle
function toggleLangDropdown() {
    const menu = document.getElementById('langDropdownMenu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}