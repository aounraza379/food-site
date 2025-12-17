<?php
session_start();
include __DIR__ . '/../config/db.php';
?>

<!-- Header -->
<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Navbar -->
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Our Menu Intro -->
<section class="pt-28 pb-6 text-center fade-in">
    <h1 class="text-4xl font-semibold text-gray-800">Our Menu</h1>
    <p class="mt-2 text-gray-600">Taste the best food in town!</p>
</section>

<!-- Today's Specials -->
<section class="px-6 md:px-0 max-w-6xl mx-auto mb-12 fade-in">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">🔥 Today's Specials</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php
        $specials = mysqli_query($conn, "SELECT * FROM food_items WHERE is_special=1 ORDER BY id ASC");
        if(mysqli_num_rows($specials) > 0):
            while($item = mysqli_fetch_assoc($specials)):
        ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition p-4">
            <img src="/assets/images/<?= htmlspecialchars($item['image']) ?>" class="w-full h-64 object-cover rounded-lg mb-3" />
            <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($item['name']) ?></h3>
            <p class="text-gray-600 text-sm mt-1"><?= htmlspecialchars($item['description']) ?></p>
            <p class="text-green-600 font-bold mt-2">$<?= htmlspecialchars($item['price']) ?></p>

            <form action="/process/add-to-cart.php" method="post" class="mt-3 flex gap-2 items-center">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($item['name']) ?>">
                <input type="hidden" name="price" value="<?= $item['price'] ?>">
                <input type="number" name="quantity" value="1" min="1" class="w-16 border-2 border-gray-200 rounded px-2 py-1 focus:outline-none focus:border-amber-400">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded transition transform hover:scale-105">Add to Cart</button>
            </form>
        </div>
        <?php
            endwhile;
        else:
        ?>
            <p class="text-gray-600">No special items found.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Delicious Items -->
<section class="px-6 md:px-0 max-w-6xl mx-auto mb-12 fade-in">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">🍽️ Our Delicious Items</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <?php
        $regular = mysqli_query($conn, "SELECT * FROM food_items WHERE is_special=0 ORDER BY id ASC");
        if(mysqli_num_rows($regular) > 0):
            while($item = mysqli_fetch_assoc($regular)):
        ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition p-4">
            <img src="/assets/images/<?= htmlspecialchars($item['image']) ?>" class="w-full h-64 object-cover rounded-lg mb-3" />
            <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($item['name']) ?></h3>
            <p class="text-gray-600 text-sm mt-1"><?= htmlspecialchars($item['description']) ?></p>
            <p class="text-green-600 font-bold mt-2">$<?= htmlspecialchars($item['price']) ?></p>

            <form action="/process/add-to-cart.php" method="post" class="mt-3 flex gap-2 items-center">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($item['name']) ?>">
                <input type="hidden" name="price" value="<?= $item['price'] ?>">
                <input type="number" name="quantity" value="1" min="1" class="w-16 border-2 border-gray-200 rounded px-2 py-1 focus:outline-none focus:border-amber-400">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded transition transform hover:scale-105">Add to Cart</button>
            </form>
        </div>
        <?php
            endwhile;
        else:
        ?>
            <p class="text-gray-600">No items found.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Style -->
<style>
    body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to bottom right, #ffffff, #ffb74d);
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .fade-in {
        animation: fadeInUp 1s ease-in-out forwards;
    }
</style>

<!-- Script -->
<script src='/assets/js/main.js'></script>

</body>
</html>