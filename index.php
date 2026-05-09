<?php
session_start();
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/functions.php';

$route = $_GET['route'] ?? 'home';
$allowed = ['home','images','contact','contact_result','crud','mark_create','mark_edit','mark_delete','messages','login','logout'];
if (!in_array($route, $allowed, true)) { $route = 'home'; }

require __DIR__ . '/views/header.php';
$file = __DIR__ . '/views/' . $route . '.php';
if (file_exists($file)) { require $file; } else { echo '<h2>Page not found</h2>'; }
require __DIR__ . '/views/footer.php';
?>
