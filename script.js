// Bạn có thể thêm các xử lý JavaScript tại đây (ví dụ hiệu ứng, menu ẩn hiện, v.v.)

const navbar = document.getElementById('navbar');
const whiteBlock = document.getElementById('white-block');

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

observer.observe(whiteBlock);

console.log("Phoebe Landing Page Loaded");