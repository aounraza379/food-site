<?php
// includes/navbar.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<nav class="bg-gradient-to-r from-gray-800 to-gray-900 text-white fixed w-full z-50 shadow">
  <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

    <div class="flex items-center">
      <a href="/index.php" class="flex items-center gap-3">
        <svg class="w-8 h-8 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h18v4H3zM3 11h18v10H3z"></path>
        </svg>
        <h1 class="text-2xl font-bold text-amber-400">Foodie's Paradise</h1>
      </a>
    </div>

    <div class="flex items-center gap-6">

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center gap-6">
        <a href="/index.php" class="hover:text-amber-400">Home</a>
        <a href="/pages/menu.php" class="hover:text-amber-400">Menu</a>
        <a href="/pages/about.php" class="hover:text-amber-400">About</a>
        <a href="/pages/contact.php" class="hover:text-amber-400">Contact</a>
      </div>

      <?php
      $cartCount = 0;
      if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $item) {
              $cartCount += $item['quantity'];
          }
      }
      ?>

      <!-- Cart Icon -->
      <a href="/pages/cart.php" class="relative" aria-label="Cart">
        <svg class="w-7 h-7 hover:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6m0 0a1 1 0 001 1h12a1 1 0 001-1l-1.2-6M7 13h10">
          </path>
        </svg>

        <?php if ($cartCount > 0): ?>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
          <?= $cartCount ?>
        </span>
        <?php endif; ?>
      </a>

      <!-- Auth Links / User Dropdown -->
      <?php if (isset($_SESSION['user'])): 
          $u = $_SESSION['user'];
      ?>
        <div class="relative">
          <button id="user-btn" class="flex items-center gap-2 focus:outline-none">
            <!-- small circular avatar -->
            <div class="w-9 h-9 rounded-full bg-amber-400 flex items-center justify-center text-gray-900 font-semibold">
              <?= htmlspecialchars(strtoupper(substr($u['username'] ?? $u['email'],0,1))) ?>
            </div>
            <div class="hidden md:block text-left">
              <div class="text-sm"><?= htmlspecialchars($u['username'] ?? $u['email']) ?></div>
              <div class="text-xs text-gray-300">View account</div>
            </div>
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>

          <!-- Dropdown -->
          <div id="user-menu" class="hidden absolute right-0 mt-3 w-48 bg-white text-gray-800 rounded shadow-lg py-2">
            <a href="/pages/profile.php" class="block px-4 py-2 hover:bg-gray-100">My Profile</a>
            <a href="/pages/my-orders.php" class="block px-4 py-2 hover:bg-gray-100">My Orders</a>
            <?php if (($u['role'] ?? '') === 'admin'): ?>
              <a href="/admin/index.php" class="block px-4 py-2 hover:bg-gray-100">Admin Panel</a>
            <?php endif; ?>
            <a href="/pages/logout.php" class="block px-4 py-2 hover:bg-gray-100 text-red-600">Logout</a>
          </div>
        </div>

      <?php else: ?>
        <div class="hidden md:flex items-center gap-3">
          <a href="/pages/login.php" class="flex items-center gap-2 hover:text-amber-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8 8 0 1118.88 6.196"></path>
            </svg>
            Login
          </a>
          <a href="/pages/register.php" class="bg-amber-400 text-gray-900 px-3 py-1 rounded-lg hover:opacity-90">Register</a>
        </div>

        <!-- Mobile small auth buttons -->
        <div class="md:hidden flex gap-3">
          <a href="/pages/login.php" class="px-2 py-1 border rounded">Login</a>
          <a href="/pages/register.php" class="px-2 py-1 bg-amber-400 text-gray-900 rounded">Register</a>
        </div>
      <?php endif; ?>

      <!-- Mobile Menu Button -->
      <button id="menu-btn" class="md:hidden text-3xl focus:outline-none ml-2">
        &#9776;
      </button>
    </div>

  </div>

  <!-- MOBILE DROPDOWN -->
  <div id="mobile-menu" class="hidden bg-gray-900 text-center py-3 space-y-2 md:hidden">
    <a href="/index.php" class="block py-2 hover:text-amber-400">Home</a>
    <a href="/pages/menu.php" class="block py-2 hover:text-amber-400">Menu</a>
    <a href="/pages/about.php" class="block py-2 hover:text-amber-400">About</a>
    <a href="/pages/contact.php" class="block py-2 hover:text-amber-400">Contact</a>
    <?php if (!isset($_SESSION['user'])): ?>
      <a href="/pages/login.php" class="block py-2 hover:text-amber-400">Login</a>
      <a href="/pages/register.php" class="block py-2 hover:text-amber-400">Register</a>
    <?php else: ?>
      <a href="/pages/my-orders.php" class="block py-2 hover:text-amber-400">My Orders</a>
      <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
        <a href="/admin/index.php" class="block py-2 hover:text-amber-400">Admin Panel</a>
      <?php endif; ?>
      <a href="/pages/logout.php" class="block py-2 text-red-500 hover:text-red-400">Logout</a>
    <?php endif; ?>
  </div>
</nav>

<script>
  // Menu toggle
  document.getElementById('menu-btn')?.addEventListener('click', function() {
    const m = document.getElementById('mobile-menu');
    if (m) m.classList.toggle('hidden');
  });

  // User dropdown
  document.getElementById('user-btn')?.addEventListener('click', function(e) {
    e.stopPropagation();
    const d = document.getElementById('user-menu');
    if (d) d.classList.toggle('hidden');
  });

  // Close dropdown on outside click
  document.addEventListener('click', function() {
    const d = document.getElementById('user-menu');
    if (d && !d.classList.contains('hidden')) d.classList.add('hidden');
  });
</script>