<?php
function h($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function is_logged_in() { return isset($_SESSION['user']); }
function current_user() { return $_SESSION['user'] ?? null; }
function redirect_to($route) { header('Location: index.php?route=' . $route); exit; }
function require_login() { if (!is_logged_in()) redirect_to('login'); }
function flash($key, $message=null) {
    if ($message !== null) { $_SESSION['flash'][$key] = $message; return; }
    if (isset($_SESSION['flash'][$key])) { $m = $_SESSION['flash'][$key]; unset($_SESSION['flash'][$key]); return $m; }
    return null;
}
?>
