<?php
include __DIR__ . "/config.php";
include __DIR__ . "/class/Database.php";
include __DIR__ . "/class/Form.php";

session_start();

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/artikel/index';
$segments = explode('/', trim($path, '/'));

$mod  = $segments[0] ?? 'artikel';
$page = $segments[1] ?? 'index';

$file = __DIR__ . "/module/$mod/$page.php";

include __DIR__ . "/template/header.php";
include __DIR__ . "/template/sidebar.php";

if (file_exists($file)) {
    include $file;
} else {
    echo "<div style='color:red;'> Modul tidak ditemukan → <b>$mod/$page</b></div>";
}

include __DIR__ . "/template/footer.php";
?>
