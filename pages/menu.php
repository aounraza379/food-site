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

</head>
<body class="overflow-x-hidden">

    <!-- Header -->
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Navbar -->
    <?php include __DIR__ . '/../includes/navbar.php'; ?>

    <!-- Special Deals -->
    <section class="pt-28 pb-12 fade-in text-center">
        <h2 class="text-4xl font-semibold text-gray-800 mb-8">Today's Special Deals</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition">
                <img src="/assets/images/menuone.avif" class="w-full h-64 object-cover" />
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Beef with Fries</h3>
                    <p class="text-gray-600 text-sm mt-2">Enjoy a healthy combo meal with creamy avocado toast and refreshing green juice.</p>
                    <p class="text-green-600 font-bold mt-3">$12.99</p>
                    <p class="text-orange-500 font-semibold">Save 15%</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition">
                <img src="/assets/images/menutwo.avif" class="w-full h-64 object-cover" />
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Burger and Fries</h3>
                    <p class="text-gray-600 text-sm mt-2">Fuel your day with a protein-packed quinoa veggie bowl and a nutritious smoothie.</p>
                    <p class="text-green-600 font-bold mt-3">$14.49</p>
                    <p class="text-orange-500 font-semibold">Save 10%</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition">
                <img src="/assets/images/menuthree.avif" class="w-full h-64 object-cover" />
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Grilled Chicken with Fries</h3>
                    <p class="text-gray-600 text-sm mt-2">Grilled chicken salad with fresh greens and a refreshing glass of lemonade.</p>
                    <p class="text-green-600 font-bold mt-3">$16.99</p>
                    <p class="text-orange-500 font-semibold">Save 20%</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Food Gallery -->
    <section class="py-16 fade-in">
        <h2 class="text-4xl font-semibold text-center text-gray-800 mb-10">Our Delicious Dishes</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-6xl mx-auto px-4">
            <div class="relative overflow-hidden rounded-lg shadow-lg hover:scale-105 transition cursor-pointer" onclick="openLightbox('images/itemone.avif')">
                <img src="/assets/images/itemone.avif" alt="Classic Cheeseburger" class="w-full h-64 object-cover" />
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center p-3 opacity-0 hover:opacity-100 transition">
                    <h3 class="font-semibold">Classic Cheeseburger</h3>
                    <p>$9.99</p>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-lg shadow-lg hover:scale-105 transition cursor-pointer" onclick="openLightbox('images/itemtwo.avif')">
                <img src="/assets/images/itemtwo.avif" alt="Margherita Pizza" class="w-full h-64 object-cover" />
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center p-3 opacity-0 hover:opacity-100 transition">
                    <h3 class="font-semibold">Margherita Pizza</h3>
                    <p>$12.99</p>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-lg shadow-lg hover:scale-105 transition cursor-pointer" onclick="openLightbox('images/itemthree.avif')">
                <img src="/assets/images/itemthree.avif" alt="Creamy Alfredo Pasta" class="w-full h-64 object-cover" />
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center p-3 opacity-0 hover:opacity-100 transition">
                    <h3 class="font-semibold">Creamy Alfredo Pasta</h3>
                    <p>$11.49</p>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-lg shadow-lg hover:scale-105 transition cursor-pointer" onclick="openLightbox('images/itemfour.avif')">
                <img src="/assets/images/itemfour.avif" alt="Garden Fresh Salad" class="w-full h-64 object-cover" />
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center p-3 opacity-0 hover:opacity-100 transition">
                    <h3 class="font-semibold">Garden Fresh Salad</h3>
                    <p>$7.99</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
        <img id="lightbox-image" class="max-w-[80%] max-h-[80%] rounded-lg object-contain" src="" alt="" />
        <button onclick="closeLightbox()" class="absolute top-5 right-5 bg-black bg-opacity-50 text-white px-4 py-2 rounded hover:bg-opacity-70">Close</button>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Script -->
    <script src='/assets/js/main.js'></script>

</body>
</html>
