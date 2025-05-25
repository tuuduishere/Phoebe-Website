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

  observer.observe(whiteBlock);




console.log("Phoebe Landing Page Loaded");