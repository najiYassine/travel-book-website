<?php
require_once 'includes/init.php';

requireLogin();

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$erreur = '';
$succes = false;
$fichierTicket = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user']['id'];
    $date = date('Y-m-d H:i:s');
    $totalGeneral = 0;
    $lignesTicket = [];
    $erreur = '';

    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare('SELECT stock, title FROM destinations WHERE id = ?');
        $stmt->execute([$item['id']]);
        $dest = $stmt->fetch();

        if (!$dest || $dest['stock'] < $item['quantity']) {
            $erreur = 'Stock insuffisant pour ' . $item['title'];
            break;
        }
    }

    if ($erreur == '') {
        foreach ($_SESSION['cart'] as $item) {
            $id = $item['id'];
            $qty = $item['quantity'];
            $prix = $item['price'];
            $totalLigne = $prix * $qty;
            $totalGeneral = $totalGeneral + $totalLigne;

            $stmt = $pdo->prepare('SELECT title FROM destinations WHERE id = ?');
            $stmt->execute([$id]);
            $dest = $stmt->fetch();

            $stmt = $pdo->prepare('INSERT INTO reservations (user_id, destination_id, quantity, total_price, reservation_date) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$userId, $id, $qty, $totalLigne, $date]);

            $stmt = $pdo->prepare('UPDATE destinations SET stock = stock - ? WHERE id = ?');
            $stmt->execute([$qty, $id]);

            $lignesTicket[] = [
                'title' => $dest['title'],
                'price' => $prix,
                'quantity' => $qty,
                'total' => $totalLigne
            ];
        }

        if (!is_dir('tickets')) {
            mkdir('tickets', 0755, true);
        }

        $fichierTicket = 'ticket_' . $userId . '_' . time() . '.txt';
        $contenu = "BILLET SKYLANE\n\n";
        $contenu .= "Prénom : " . $_SESSION['user']['firstname'] . "\n";
        $contenu .= "Nom : " . $_SESSION['user']['lastname'] . "\n";
        $contenu .= "Ville : " . $_SESSION['user']['city'] . "\n";
        $contenu .= "Date : " . $date . "\n\n";

        foreach ($lignesTicket as $ligne) {
            $contenu .= "Destination : " . $ligne['title'] . "\n";
            $contenu .= "Prix unitaire : " . $ligne['price'] . " MAD\n";
            $contenu .= "Quantité : " . $ligne['quantity'] . "\n";
            $contenu .= "Total : " . $ligne['total'] . " MAD\n\n";
        }

        $contenu .= "TOTAL : " . $totalGeneral . " MAD\n";
        file_put_contents('tickets/' . $fichierTicket, $contenu);

        $_SESSION['last_ticket'] = $fichierTicket;
        $_SESSION['cart'] = [];
        $succes = true;
    }
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total = $total + ($item['price'] * $item['quantity']);
}

$pageTitle = 'Validation de commande';
$extraCss = ['css/cart.css'];
require_once 'includes/header.php';
?>

<main class="panier-page">
    <h1>Validation de commande</h1>

    <?php if ($succes): ?>
        <div class="message-succes">
            <p>Réservation effectuée avec succès !</p>
            <a href="download_ticket.php?file=<?php echo e($fichierTicket); ?>" class="btn-panier btn-panier-primaire">Télécharger le billet</a>
            <a href="destinations.php" class="btn-panier btn-panier-secondaire">Retour aux destinations</a>
        </div>
    <?php else: ?>

        <?php if ($erreur != ''): ?>
            <div class="message-succes" style="background:#f8d7da;color:#721c24;"><?php echo e($erreur); ?></div>
        <?php endif; ?>

        <table class="panier-table">
            <tr>
                <th>Destination</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
                <td><?php echo e($item['title']); ?></td>
                <td><?php echo e($item['price']); ?> MAD</td>
                <td><?php echo e($item['quantity']); ?></td>
                <td><?php echo e($item['price'] * $item['quantity']); ?> MAD</td>
            </tr>
            <?php endforeach; ?>
        </table>

        <p class="panier-total">Total : <?php echo e($total); ?> MAD</p>

        <form method="POST" action="checkout.php">
            <button type="submit" class="btn-panier btn-panier-success">Confirmer et payer</button>
        </form>
        <a href="cart.php" class="btn-panier btn-panier-secondaire">Retour au panier</a>

    <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>
