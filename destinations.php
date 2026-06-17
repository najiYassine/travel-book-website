<?php
require_once 'includes/init.php';

requireLogin();

$message = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

$stmt = $pdo->query('SELECT * FROM destinations ORDER BY title ASC');
$destinations = $stmt->fetchAll();

$pageTitle = 'Destinations';
$extraCss = ['css/article.css'];

require_once 'includes/header.php';
?>

<?php if ($message !== ''): ?>
    <div class="flash-message" style="background:#d4edda;color:#155724;padding:10px;text-align:center;">
        <?php echo e($message); ?>
    </div>
<?php endif; ?>

<main class="contenu">
    <aside class="aside">
        <h2>Destinations disponibles</h2>
        <p style="padding:10px;color:var(--color-text);">
            Parcourez nos offres et ajoutez vos destinations favorites au panier.
        </p>
    </aside>

    <section class="section">
        <?php if (empty($destinations)): ?>
            <p>Aucune destination disponible pour le moment.</p>
        <?php else: ?>
            <?php foreach ($destinations as $dest): ?>
                <div class="carte-voyage">
                    <img src="<?php echo e($dest['image']); ?>" loading="lazy" alt="<?php echo e($dest['title']); ?>" />
                    <div class="corps">
                        <p class="destination"><?php echo e($dest['title']); ?></p>
                        <p class="description" style="font-size:0.85em;padding:0 10px;color:var(--color-text);">
                            <?php echo e($dest['description']); ?>
                        </p>
                        <p class="prix"><?php echo e(number_format($dest['price'], 2)); ?> MAD</p>
                        <span class="badge-classe">Stock : <?php echo e($dest['stock']); ?></span>

                        <?php if ($dest['stock'] > 0): ?>
                            <form method="POST" action="cart_action.php" style="padding:10px;">
                                <input type="hidden" name="action" value="add" />
                                <input type="hidden" name="destination_id" value="<?php echo e($dest['id']); ?>" />
                                <label style="display:block;margin-bottom:5px;">
                                    Quantité :
                                    <input type="number" name="quantity" value="1" min="1" max="<?php echo e($dest['stock']); ?>" style="width:60px;" required />
                                </label>
                                <button type="submit" class="btn-confirmer">Ajouter au panier</button>
                            </form>
                        <?php else: ?>
                            <p style="color:red;padding:10px;">Rupture de stock</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
