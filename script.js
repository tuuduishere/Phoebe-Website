// Bạn có thể thêm các xử lý JavaScript tại đây (ví dụ hiệu ứng, menu ẩn hiện, v.v.)

const navbar = document.getElementById('navbar');
const whiteBlock = document.getElementById('white-block');

// ========================================
// SIDE MENU TOGGLE - CHỐNG DOUBLE CLICK
// ========================================

// Sử dụng Flag để chống lỗi double-click như đã xử lý trước đó
let isMenuProcessing = false;

function toggleMenu() {
    if (isMenuProcessing) return;

    const sidebar = document.getElementById('side-menu');
    const trigger = document.getElementById('menuTrigger');
    const overlay = document.getElementById('menu-overlay');

    const isOpen = sidebar.classList.contains('translate-x-0');
    isMenuProcessing = true;

    if (!isOpen) {
        // MỞ MENU
        sidebar.classList.add('translate-x-0');
        sidebar.classList.remove('-translate-x-full');
        // Kích hoạt sáng, viền đen và kéo giãn
        if (trigger) trigger.classList.add('active-btn'); 
        
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.add('opacity-100'), 10);
    } else {
        // ĐÓNG MENU
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        // Tắt hiệu ứng kéo giãn và viền đen
        if (trigger) trigger.classList.remove('active-btn'); 
        
        overlay.classList.remove('opacity-100');
        setTimeout(() => overlay.classList.add('hidden'), 300);
    }

    setTimeout(() => { isMenuProcessing = false; }, 400); // Khớp với transition CSS
}

// Đóng menu khi click ra ngoài vùng Menu (click vào Overlay)
document.addEventListener('click', function (e) {
    const sidebar = document.getElementById('side-menu');
    const trigger = document.getElementById('menuTrigger');
    
    // Nếu menu đang mở và vị trí click không nằm trong menu hay nút bấm thì mới đóng
    if (sidebar && sidebar.classList.contains('translate-x-0')) {
        if (!sidebar.contains(e.target) && (!trigger || !trigger.contains(e.target))) {
            toggleMenu();
        }
    }
});

// Đóng menu khi click vào một link trong menu
const sidebarLinks = document.querySelectorAll('#side-menu a');
sidebarLinks.forEach(link => {
    link.addEventListener('click', function () {
        const sidebar = document.getElementById('side-menu');
        if (sidebar && sidebar.classList.contains('translate-x-0')) {
            toggleMenu();
        }
    });
});



function handleNavbarTransition() {
    const nav = document.querySelector('.navbar');
    const whiteBlock = document.getElementById('white-block');

    if (!nav || !whiteBlock) return;

    // THAY ĐỔI TẠI ĐÂY: Lấy mép TRÊN của Navbar thay vì mép dưới
    const navTop = nav.getBoundingClientRect().top;
    const blockTop = whiteBlock.getBoundingClientRect().top;

    // Nếu mép TRÊN của Navbar chạm hoặc đi qua mép trên của khối trắng
    if (navTop >= blockTop) {
        if (!nav.classList.contains('dark-theme')) {
            nav.classList.add('dark-theme');
        }
    } else {
        if (nav.classList.contains('dark-theme')) {
            nav.classList.remove('dark-theme');
        }
    }
}

// Giữ nguyên các sự kiện lắng nghe
window.addEventListener('scroll', handleNavbarTransition, { passive: true });
window.addEventListener('DOMContentLoaded', handleNavbarTransition);

// ========================================
// DROPDOWN & UTILS
// ========================================

function toggleDropdown() {
    const menu = document.getElementById('userDropdownMenu');
    if (menu) menu.classList.toggle('hidden');
}

function toggleLangDropdown() {
    const menu = document.getElementById('langDropdownMenu');
    if (menu) menu.classList.toggle('hidden');
}

window.onclick = function (event) {
    if (!event.target.closest('#userDropdownContainer')) {
        const menu = document.getElementById('userDropdownMenu');
        if (menu && !menu.classList.contains('hidden')) menu.classList.add('hidden');
    }
    if (!event.target.closest('#langDropdownContainer')) {
        const langMenu = document.getElementById('langDropdownMenu');
        if (langMenu && !langMenu.classList.contains('hidden')) langMenu.classList.add('hidden');
    }
}

console.log("Phoebe Landing Page Loaded");


//NFC PROCESS
function handleNFCScan() {
    const btn = document.getElementById('nfc-scan-btn');
    const scanStatus = document.getElementById('scan-text');
    
    btn.classList.add('scanning-active'); 
    scanStatus.innerText = "Đang chờ thẻ...";

    let checkInterval = setInterval(() => {
        // Thêm tham số thời gian (?t=...) để trình duyệt không lấy cache cũ
        fetch('check-nfc.php?t=' + Date.now()) 
            .then(response => response.text())
            .then(uid => {
                // Chỉ xử lý nếu UID hợp lệ và không phải chuỗi trống
                if (uid !== "EMPTY" && uid.trim() !== "") {
                    clearInterval(checkInterval);
                    window.location.href = "nfc-login.php?uid=" + uid;
                }
            });
    }, 800);
    
}