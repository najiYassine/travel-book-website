<?php
require_once 'includes/init.php';

requireLogin();

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'add') {
    $id = (int) $_POST['destination_id'];
    $qty = (int) $_POST['quantity'];

    $stmt = $pdo->prepare('SELECT * FROM destinations WHERE id = ?');
    $stmt->execute([$id]);
    $dest = $stmt->fetch();

    if ($dest && $qty > 0 && $qty <= $dest['stock']) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['quantity'] + $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $dest['id'],
                'title' => $dest['title'],
                'price' => $dest['price'],
                'quantity' => $qty,
                'image' => $dest['image'],
                'stock' => $dest['stock']
            ];
        }
        $_SESSION['flash_message'] = $dest['title'] . ' ajouté au panier.';
    }

    header('Location: destinations.php');
    exit;
}

if ($action == 'update') {
    $id = (int) $_POST['destination_id'];
    $qty = (int) $_POST['quantity'];

    if (isset($_SESSION['cart'][$id]) && $qty > 0) {
        $_SESSION['cart'][$id]['quantity'] = $qty;
    }

    header('Location: cart.php');
    exit;
}

if ($action == 'remove') {
    $id = (int) $_GET['id'];
    unset($_SESSION['cart'][$id]);
    header('Location: cart.php');
    exit;
}

header('Location: destinations.php');
exit;
