<?php
session_start();
$success_msg = $_SESSION['success'] ?? null;
$error_msg = $_SESSION['error'] ?? null;

// Clear messages after storing them in variables
unset($_SESSION['success'], $_SESSION['error']);
?>

<!-- Header -->
<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Navbar -->
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Contact Section -->
<section class="pt-20 pb-24 px-6 md:px-0">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-lg mt-16">
        
        <h1 class="text-3xl md:text-4xl font-semibold text-center text-gray-800 mb-6 animate-fadeIn">Get In Touch</h1>
        <hr class="border-t-2 border-amber-400 w-24 mx-auto mb-8" />

        <br>
        <?php if($success_msg): ?>
            <div class="mb-4 p-4 text-green-800 bg-green-200 rounded-lg">
                <?= $success_msg; ?>
            </div>
        <?php endif; ?>

        <?php if($error_msg): ?>
            <div class="mb-4 p-4 text-red-800 bg-red-200 rounded-lg">
                <?= $error_msg; ?>
            </div>
        <?php endif; ?>

        <form action="../process/contactprocess.php" method="post" class="space-y-6">
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

            <button type="submit" name="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-medium py-3 rounded-lg transition transform hover:scale-105 cursor-pointer">
                Send Message
            </button>
        </form>

            </div>
        </section>

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Script -->
<script src='../assets/js/main.js'></script>

<!-- Style -->
<link rel="stylesheet" href="../assets/css/custom.css">

</body>
</html>