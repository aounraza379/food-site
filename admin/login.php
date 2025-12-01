<?php
session_start();
require_once "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/custom.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-amber-300 min-h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Admin Login</h2>

        <?php if ($error): ?>
        <p class="text-red-500 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input 
                type="text" 
                name="username" 
                placeholder="Username" 
                required 
                class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:outline-none"
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:outline-none"
            >

            <button 
                type="submit" 
                class="w-full py-3 bg-amber-500 text-white rounded-md hover:bg-amber-600 focus:ring-2 focus:ring-amber-500 transition duration-300"
            >
                Login
            </button>
        </form>
    </div>

</body>
</html>