<?php
// Localhost test server
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('BASE_URL', 'http://localhost/foodparadise');
} else {
    // Live server - any custom domain
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    define('BASE_URL', $protocol . $_SERVER['HTTP_HOST']);
}
