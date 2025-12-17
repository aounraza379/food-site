<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /pages/login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    header("Location: /pages/menu.php");
    exit();
}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="min-h-screen flex items-start justify-center py-12 px-4 sm:px-6 lg:px-8 mt-24 sm:mt-32">
    <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-8 sm:p-10">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-center mb-8 text-amber-500 tracking-wide">Checkout</h2>

        <form action="/process/place-order.php" method="POST" class="grid grid-cols-1 gap-6 sm:grid-cols-2">

            <!-- FULL NAME -->
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="user_name"
                       value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" required
                       class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-200">
            </div>

            <!-- EMAIL -->
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="user_email"
                       value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required
                       class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-200">
            </div>

            <!-- PHONE -->
            <div class="sm:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                <input type="text" name="user_phone" required
                       class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-200">
            </div>

            <!-- ADDRESS -->
            <div class="sm:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Delivery Address</label>
                <textarea name="user_address" required
                          class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-200 h-24 resize-none"></textarea>
            </div>

            <!-- NOTES -->
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Notes (Optional)</label>
                <textarea name="order_notes"
                          class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-200 h-20 resize-none"></textarea>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="sm:col-span-2">
                <button type="submit"
                        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl text-lg shadow-md transition duration-200 transform hover:scale-105">
                    Place Order
                </button>
            </div>

        </form>
    </div>
</div>

<?php include "../includes/footer.php"; ?>