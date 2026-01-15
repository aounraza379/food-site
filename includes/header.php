<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Foodie's Paradise</title>
  <link href="/styles/output.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/styles/output.css">  -->

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="icon" type="image/png" href="../assets/images/favicon.png">
  <link rel="script" href="assets/js/main.js">
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-white to-amber-300 overflow-x-hidden">