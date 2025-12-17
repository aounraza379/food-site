<?php include '../includes/header.php'; ?>

<div class="max-w-md mx-auto mt-10 flex flex-col gap-4 ">
  <h2 class="text-2xl font-bold mb-4">Forgot Password</h2>

  <?php if (isset($_GET['success'])): ?>
    <p class="text-green-600">Reset link sent to your email.</p>
  <?php elseif (isset($_GET['error'])): ?>
    <p class="text-red-600">Email not found.</p>
  <?php endif; ?>

  <form action="../process/send-reset-link.php" method="POST">
    <input type="email" name="email" required
      class="w-full border p-2 mb-4"
      placeholder="Enter your email">

    <button class="bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg text-lg font-semibold px-4 py-2 w-full">
      Send Reset Link
    </button>
  </form>

  <p class="mt-4">
    <a href="login.php" class="text-blue-600">Back to Login</a>
  </p>
</div>

<?php include '../includes/footer.php'; ?>