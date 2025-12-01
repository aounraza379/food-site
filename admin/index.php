<?php 
require_once "auth.php"; 
require_once "../config/db.php";

// Count orders
$countQuery = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
$count = $countQuery->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/custom.css">
</head>
<body class="bg-gradient-to-br from-white to-amber-300 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl text-center">

        <h2 class="text-3xl font-semibold text-gray-800 mb-4">
            Welcome, <span class="text-amber-600"><?= $_SESSION['admin_username']; ?></span>
        </h2>

        <p class="text-lg text-gray-700 mb-6">
            Total Orders: 
            <span class="font-bold text-gray-900"><?= $count['total_orders'] ?></span>
        </p>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="orders.php" 
               class="bg-amber-500 text-white px-6 py-3 rounded-md hover:bg-amber-600 transition duration-300">
                View Orders
            </a>

            <a href="logout.php" 
               class="bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-gray-900 transition duration-300">
                Logout
            </a>
        </div>

    </div>

</body>
</html>