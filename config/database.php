<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'skylane_travel';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("USE $dbname");

    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        city VARCHAR(100) NOT NULL,
        photo VARCHAR(255) DEFAULT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS destinations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        description TEXT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        stock INT NOT NULL DEFAULT 10,
        image VARCHAR(255) NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS reservations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        destination_id INT NOT NULL,
        quantity INT NOT NULL,
        total_price DECIMAL(10, 2) NOT NULL,
        reservation_date DATETIME NOT NULL
    )");

    $nb = $pdo->query("SELECT COUNT(*) FROM destinations")->fetchColumn();
    if ($nb == 0) {
        $pdo->exec("INSERT INTO destinations (title, description, price, stock, image) VALUES
            ('Paris', 'Découvrez la ville lumière.', 3200, 15, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800'),
            ('Tokyo', 'Culture japonaise et quartiers futuristes.', 5400, 12, 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800'),
            ('Dubai', 'Luxe et modernité.', 8600, 10, 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800'),
            ('Rome', 'Histoire et art italien.', 2800, 20, 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=800'),
            ('Marrakech', 'Médina et souks colorés.', 1900, 18, 'https://images.unsplash.com/photo-1597212618440-806262de4f6b?w=800'),
            ('Casablanca', 'Port atlantique et ambiance marocaine.', 1500, 25, 'https://images.unsplash.com/photo-1577147443647-81856d5151af?w=800')
        ");
    }

} catch (PDOException $e) {
    die('Erreur base de données : ' . htmlspecialchars($e->getMessage()));
}
