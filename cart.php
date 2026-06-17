<?php
require_once 'includes/init.php';

requireLogin();

$message = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

$pageTitle = 'Panier';
$extraCss = ['css/cart.css'];

require_once 'includes/header.php';
?>

<main class="panier-page">
    <h1>Mon panier</h1>

    <?php if ($message !== ''): ?>
        <div class="message-succes"><?php echo e($message); ?></div>
    <?php endif; ?>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="panier-vide">
            <p>Votre panier est vide.</p>
            <a href="destinations.php" class="btn-panier btn-panier-primaire">Voir les destinations</a>
        </div>
    <?php else: ?>
        <table class="panier-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Destination</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <?php $sousTotal = $item['price'] * $item['quantity']; ?>
                    <tr>
                        <td><img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" /></td>
                        <td><?php echo e($item['title']); ?></td>
                        <td><?php echo e(number_format($item['price'], 2)); ?> MAD</td>
                        <td>
                            <form method="POST" action="cart_action.php" style="display:inline;">
                                <input type="hidden" name="action" value="update" />
                                <input type="hidden" name="destination_id" value="<?php echo e($item['id']); ?>" />
                                <input type="number" name="quantity" class="quantite-input"
                                    value="<?php echo e($item['quantity']); ?>"
                                    min="1" max="<?php echo e($item['stock']); ?>" required />
                                <button type="submit" class="btn-panier btn-panier-secondaire">OK</button>
                            </form>
                        </td>
                        <td><?php echo e(number_format($sousTotal, 2)); ?> MAD</td>
                        <td>
                            <a href="cart_action.php?action=remove&id=<?php echo e($item['id']); ?>"
                               class="btn-panier btn-panier-danger"
                               onclick="return confirm('Supprimer cet article ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="panier-total">Total : <?php echo e(number_format($total, 2)); ?> MAD</p>

        <div class="panier-actions">
            <a href="destinations.php" class="btn-panier btn-panier-secondaire">Continuer les achats</a>
            <a href="checkout.php" class="btn-panier btn-panier-success">Valider la commande</a>
        </div>
    <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>
