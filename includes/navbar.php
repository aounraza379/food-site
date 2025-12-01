<nav class="bg-gradient-to-r from-gray-800 to-gray-900 text-white fixed w-full z-50 shadow">
  <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

    <div class="flex items-center">
      <h1 class="text-2xl font-bold text-amber-400">Foodie's Paradise</h1>
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
<a href="/pages/cart.php" class="relative">
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

      <!-- Mobile Menu Button -->
      <button id="menu-btn" class="md:hidden text-3xl focus:outline-none">
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
  </div>
</nav>