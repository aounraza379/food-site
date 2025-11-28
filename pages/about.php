<!-- Header -->
<?php include __DIR__ . '/../includes/header.php'; ?>

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


<!-- Navbar -->
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- About Section -->
<section class="pt-28 pb-24 px-6 animate-fadeIn">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-semibold text-amber-500 mb-4">About Us</h1>
        <hr class="border-t-2 border-amber-400 w-24 mx-auto mb-8" />
        <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
            Welcome to our restaurant! We are passionate about delivering the best culinary experience. Our team is committed to bringing you delicious food made with the finest ingredients, in a warm and welcoming environment.
        </p>
    </div>
    <div class="mt-16 grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <div class="bg-white shadow-lg rounded-xl p-8 hover:shadow-xl transition">
            <h3 class="text-2xl font-semibold text-gray-800 mb-3">Our Mission</h3>
            <p class="text-gray-600">To offer high-quality food, exceptional service, and a memorable dining experience.</p>
        </div>
        <div class="bg-white shadow-lg rounded-xl p-8 hover:shadow-xl transition">
            <h3 class="text-2xl font-semibold text-gray-800 mb-3">Our Vision</h3>
            <p class="text-gray-600">We aim to become the top choice for food lovers by continually evolving and exceeding expectations.</p>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="px-6 py-16 bg-gray-50 text-center">
    <h3 class="text-4xl font-semibold text-amber-500 mb-6">Find Us</h3>
    <hr class="border-t-2 border-amber-400 w-24 mx-auto mb-10" />
    <div class="flex justify-center">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3400.3636292201913!2d74.29846667540677!3d31.54163377420433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919035b4544e03d%3A0x41d588adbd0d9c91!2sParadise%20Food%20Corner!5e0!3m2!1sen!2s!4v1734530467041!5m2!1sen!2s"
            width="800"
            height="400"
            style="border: 0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full md:w-[800px] rounded-lg shadow-lg"
        ></iframe>
    </div>
</section>

<!-- Customer Reviews -->
<section class="py-20 bg-white text-center animate-fadeIn">
    <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-6">What Our Customers Say</h2>
    <hr class="border-t-2 border-amber-400 w-24 mx-auto mb-10" />
    <div class="flex flex-wrap justify-center gap-8">
        <!-- Review 1 -->
        <div class="bg-gradient-to-br from-white to-amber-200 w-72 p-6 rounded-lg shadow-md hover:scale-105 transition">
            <div class="flex flex-col items-center mb-4">
                <img src="/assets/images/personone.jpeg" alt="Customer 1" class="rounded-full w-16 h-16 object-cover mb-2" />
                <h3 class="font-semibold">John Doe</h3>
                <div class="text-yellow-400">★★★★☆</div>
            </div>
            <p class="text-gray-600">"The avocado toast was absolutely amazing! Will definitely come back."</p>
        </div>

        <!-- Review 2 -->
        <div class="bg-gradient-to-br from-white to-amber-200 w-72 p-6 rounded-lg shadow-md hover:scale-105 transition">
            <div class="flex flex-col items-center mb-4">
                <img src="/assets/images/persontwo.jpeg" alt="Customer 2" class="rounded-full w-16 h-16 object-cover mb-2" />
                <h3 class="font-semibold">Jane Smith</h3>
                <div class="text-yellow-400">★★★★☆</div>
            </div>
            <p class="text-gray-600">"Loved the berry chia pudding! It was the perfect breakfast."</p>
        </div>

        <!-- Review 3 -->
        <div class="bg-gradient-to-br from-white to-amber-200 w-72 p-6 rounded-lg shadow-md hover:scale-105 transition">
            <div class="flex flex-col items-center mb-4">
                <img src="/assets/images/personthree.jpeg" alt="Customer 3" class="rounded-full w-16 h-16 object-cover mb-2" />
                <h3 class="font-semibold">Mark Lee</h3>
                <div class="text-yellow-400">★★★☆☆</div>
            </div>
            <p class="text-gray-600">"The quinoa veggie bowl was healthy and filling, I would recommend it."</p>
        </div>

        <!-- Review 4 -->
        <div class="bg-gradient-to-br from-white to-amber-200 w-72 p-6 rounded-lg shadow-md hover:scale-105 transition">
            <div class="flex flex-col items-center mb-4">
                <img src="/assets/images/personfour.jpeg" alt="Customer 4" class="rounded-full w-16 h-16 object-cover mb-2" />
                <h3 class="font-semibold">Emily Clark</h3>
                <div class="text-yellow-400">★★★★★</div>
            </div>
            <p class="text-gray-600">"A perfect place for fresh and healthy meals. I loved everything I tried!"</p>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Script -->
<script src='/assets/js/main.js'></script>

</body>
</html>
