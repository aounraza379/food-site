<!-- Header -->
<?php include 'includes/header.php'; ?>

<!-- Navbar -->
<?php include 'includes/navbar.php'; ?>

<!-- Hero Section -->
<header class="pt-28 px-6 md:px-16 max-w-6xl mx-auto animate-fadeIn">
    <h2 class="text-4xl md:text-6xl font-semibold text-gray-800">
        Look like an <span class="text-amber-500 italic">expert</span><br/> right from the start
    </h2>
    <p class="mt-4 text-lg text-gray-600">Head start your stylish food website with a gorgeous template.</p>

    <div class="mt-6 flex gap-4">
        <a 
        href="menu.php" 
        class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-md transform transition hover:scale-105">
        Order Now!
        </a>
        <a 
        href="about.php" 
        class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-md transform transition hover:scale-105">
        Why Us?
        </a>
    </div>

    <div class="relative mt-16 h-[550px] hidden md:block">
        <img src="assets/images/gridone.avif" class="absolute top-0 left-[5%] w-[250px] rounded-lg shadow-lg -rotate-6 hover:scale-110 transition-transform duration-300" alt="">
        <img src="assets/images/gridtwo.avif" class="absolute top-[50px] left-[25%] w-[250px] rounded-lg shadow-lg rotate-3 hover:scale-110 transition-transform duration-300" alt="">
        <img src="assets/images/gridthree.avif" class="absolute top-[100px] left-[45%] w-[250px] rounded-lg shadow-lg -rotate-4 hover:scale-110 transition-transform duration-300" alt="">
        <img src="assets/images/gridfour.avif" class="absolute top-[150px] left-[65%] w-[250px] rounded-lg shadow-lg rotate-6 hover:scale-110 transition-transform duration-300" alt="">
        <img src="assets/images/gridfive.avif" class="absolute top-[200px] left-[85%] w-[250px] rounded-lg shadow-lg -rotate-3 hover:scale-110 transition-transform duration-300" alt="">
    </div>
</header>

<!-- Special Offer Banner -->
<div class="bg-orange-500 text-white text-center py-3 mt-12 animate-fadeIn">
    Special Offer: Get 20% off your first order! Use code: <strong>FOOD20</strong>
</div>

<!-- 3D Slider Section -->
<main class="mt-24 mb-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="relative w-full h-[420px] overflow-hidden perspective">
            <div id="slider" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex justify-center items-center preserve-3d">
                
                <!-- Slider items -->
                <div class="slider-item absolute w-[200px] h-[300px] bg-cover bg-center rounded-lg flex justify-center items-end text-white opacity-95 shadow-lg backface-hidden will-change-transform"
                     style="background-image: url('assets/images/sliderone.avif');">
                    <div class="w-full bg-black/50 p-3 rounded-b-lg text-center">
                        <h3 class="text-lg font-semibold">Avocado Toast</h3>
                        <p class="text-sm">Fresh avocado on whole grain toast</p>
                        <div class="absolute top-2 left-2 bg-red-500 px-3 py-1 text-xs font-bold rounded-md">Light Night Deal</div>
                    </div>
                </div>

                <div class="slider-item absolute w-[200px] h-[300px] bg-cover bg-center rounded-lg flex justify-center items-end text-white opacity-95 shadow-lg backface-hidden will-change-transform"
                     style="background-image: url('assets/images/slidertwo.avif');">
                    <div class="w-full bg-black/50 p-3 rounded-b-lg text-center">
                        <h3 class="text-lg font-semibold">Berry Chia Pudding</h3>
                        <p class="text-sm">Chia seeds, almond milk, topped with mixed berries</p>
                        <div class="absolute top-2 left-2 bg-orange-500 px-3 py-1 text-xs font-bold rounded-md">Meal Deal</div>
                    </div>
                </div>

                <div class="slider-item absolute w-[200px] h-[300px] bg-cover bg-center rounded-lg flex justify-center items-end text-white opacity-95 shadow-lg backface-hidden will-change-transform"
                     style="background-image: url('assets/images/sliderthree.avif');">
                    <div class="w-full bg-black/50 p-3 rounded-b-lg text-center">
                        <h3 class="text-lg font-semibold">Quinoa Veggie Bowl</h3>
                        <p class="text-sm">Quinoa, chickpeas, avocado, roasted veggies</p>
                        <div class="absolute top-2 left-2 bg-red-500 px-3 py-1 text-xs font-bold rounded-md">Light Night Deal</div>
                    </div>
                </div>

                <div class="slider-item absolute w-[200px] h-[300px] bg-cover bg-center rounded-lg flex justify-center items-end text-white opacity-95 shadow-lg backface-hidden will-change-transform"
                     style="background-image: url('assets/images/sliderfour.avif');">
                    <div class="w-full bg-black/50 p-3 rounded-b-lg text-center">
                        <h3 class="text-lg font-semibold">Grilled Chicken Salad</h3>
                        <p class="text-sm">Mixed greens, grilled chicken, lemon vinaigrette</p>
                        <div class="absolute top-2 left-2 bg-orange-500 px-3 py-1 text-xs font-bold rounded-md">Meal Deal</div>
                    </div>
                </div>

                <div class="slider-item absolute w-[200px] h-[300px] bg-cover bg-center rounded-lg flex justify-center items-end text-white opacity-95 shadow-lg backface-hidden will-change-transform"
                     style="background-image: url('assets/images/sliderfive.avif');">
                    <div class="w-full bg-black/50 p-3 rounded-b-lg text-center">
                        <h3 class="text-lg font-semibold">Green Detox Juice</h3>
                        <p class="text-sm">Kale, cucumber, lemon, green apple</p>
                        <div class="absolute top-2 left-2 bg-red-500 px-3 py-1 text-xs font-bold rounded-md">Light Night Deal</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

<script src='/assets/js/main.js'></script>

</body>
</html>