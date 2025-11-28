<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Contact - Foodie's Paradise</title>
<!-- <script src="https://cdn.tailwindcss.com"></script> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
<style>
    body {
        font-family: "Poppins", sans-serif;
    }
    @layer utilities {
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeIn {
            animation: fadeIn 0.9s ease-in-out forwards;
        }
    }
</style>
</head>
<body class="bg-gradient-to-br from-white to-amber-300 overflow-x-hidden">

<!-- Header -->
<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Navbar -->
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Contact Section -->
<section class="pt-28 pb-24 px-6 md:px-0 animate-fadeIn">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-lg mt-16">
        <h1 class="text-3xl md:text-4xl font-semibold text-center text-gray-800 mb-6">Get In Touch</h1>
        <hr class="border-t-2 border-amber-400 w-24 mx-auto mb-8" />
        <form action="#" method="post" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Your Full Name" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-amber-400 transition" />
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Your Email Address" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-amber-400 transition" />
            </div>

            <div>
                <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="5"
                    required
                    placeholder="Your Message"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-amber-400 transition resize-y"
                ></textarea>
            </div>

            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-medium py-3 rounded-lg transition transform hover:scale-105">
                Send Message
            </button>
        </form>
    </div>
</section>

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Script -->
<script src='/assets/js/main.js'></script>

</body>
</html>
