<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- Header -->
<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Navbar -->
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Privacy Policy Section -->
<section class="pt-28 pb-20 px-6">
  <div class="max-w-5xl mx-auto">
    <h2 class="text-4xl font-bold text-center mb-6 text-gray-800" data-aos="fade-up">Privacy Policy</h2>
    <p class="text-lg text-center text-gray-700 mb-10" data-aos="fade-up" data-aos-delay="100">
      Your privacy is extremely important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you interact with Foodie's Paradise.
    </p>

    <div class="space-y-8">
      <!-- Info We Collect -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-start" data-aos="fade-up">
        <div class="text-orange-500 text-3xl mr-4"><i class="fas fa-user-shield"></i></div>
        <div>
          <h3 class="text-2xl font-semibold mb-2 text-gray-800">Information We Collect</h3>
          <p class="text-gray-700 mb-2">We collect personal and non-personal information to enhance your experience.</p>
          <ul class="list-disc list-inside text-gray-700">
            <li><strong>Personal Information:</strong> Provided when you register or contact us.</li>
            <li><strong>Non-Personal Information:</strong> Collected through cookies and analytics.</li>
          </ul>
        </div>
      </div>

      <!-- Cookies -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-start" data-aos="fade-up">
        <div class="text-orange-500 text-3xl mr-4"><i class="fas fa-cookie-bite"></i></div>
        <div>
          <h3 class="text-2xl font-semibold mb-2 text-gray-800">Cookies</h3>
          <p class="text-gray-700">We use cookies to personalize content, analyze traffic, and improve your experience. You can manage cookie settings in your browser.</p>
        </div>
      </div>

      <!-- Data Security -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-start" data-aos="fade-up">
        <div class="text-orange-500 text-3xl mr-4"><i class="fas fa-lock"></i></div>
        <div>
          <h3 class="text-2xl font-semibold mb-2 text-gray-800">Data Security</h3>
          <p class="text-gray-700">We implement strong security measures to protect your personal data from unauthorized access and misuse.</p>
        </div>
      </div>

      <!-- Third-Party Links -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-start" data-aos="fade-up">
        <div class="text-orange-500 text-3xl mr-4"><i class="fas fa-link"></i></div>
        <div>
          <h3 class="text-2xl font-semibold mb-2 text-gray-800">Third-Party Links</h3>
          <p class="text-gray-700">Our website may contain external links. We are not responsible for their content or privacy practices. Please review their policies before use.</p>
        </div>
      </div>

      <!-- Changes to Policy -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-start" data-aos="fade-up">
        <div class="text-orange-500 text-3xl mr-4"><i class="fas fa-sync-alt"></i></div>
        <div>
          <h3 class="text-2xl font-semibold mb-2 text-gray-800">Changes to This Policy</h3>
          <p class="text-gray-700">We may update our Privacy Policy occasionally. Updates will be posted here with a revised effective date.</p>
        </div>
      </div>

      <!-- Contact Us -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-start" data-aos="fade-up">
        <div class="text-orange-500 text-3xl mr-4"><i class="fas fa-envelope"></i></div>
        <div>
          <h3 class="text-2xl font-semibold mb-2 text-gray-800">Contact Us</h3>
          <p class="text-gray-700">If you have any questions about this policy, please contact us at <strong>support@foodiesparadise.com</strong>.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
</script>
<script src="/assets/js/main.js"></script>

</body>
</html>
