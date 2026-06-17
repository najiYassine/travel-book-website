<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function estConnecte() {
    return isset($_SESSION['user']);
}

function requireLogin() {
    if (!estConnecte()) {
        header('Location: login.php');
        exit;
    }
}

function e($texte) {
    return htmlspecialchars($texte, ENT_QUOTES, 'UTF-8');
}
