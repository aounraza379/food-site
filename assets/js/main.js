// Mobile menu toggle
const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
menuBtn && menuBtn.addEventListener('click', () => {
  mobileMenu.classList.toggle('hidden');
});

// 3D Slider
(function () {
  const items = Array.from(document.querySelectorAll('#slider .slider-item'));
  if (!items.length) return;

  let angle = 0;
  const total = items.length;

  function getTranslateZ() {
    const w = Math.max(window.innerWidth || 0, document.documentElement.clientWidth || 0);
    if (w >= 1400) return 420;
    if (w >= 1024) return 360;
    if (w >= 768) return 300;
    if (w >= 480) return 220;
    return 160;
  }

  function rotateSlider() {
    const radius = getTranslateZ();
    items.forEach((item, index) => {
      const itemAngle = (360 / total) * index;
      item.style.transform = `rotateY(${itemAngle + angle}deg) translateZ(${radius}px)`;
    });
  }

  function animate() {
    angle += 0.25;
    if (angle >= 360) angle -= 360;
    rotateSlider();
    requestAnimationFrame(animate);
  }

  // Initialize positions
  function initSlider() {
    const radius = getTranslateZ();
    items.forEach((item, i) => {
      const itemAngle = (360 / total) * i;
      item.style.transform = `rotateY(${itemAngle}deg) translateZ(${radius}px)`;
    });
    requestAnimationFrame(animate);
  }

  window.addEventListener('load', initSlider);

  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      rotateSlider();
    }, 120);
  });
})();