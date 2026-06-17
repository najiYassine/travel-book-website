<?php
require_once 'includes/init.php';

$pageTitle = 'Accueil';
$extraCss = ['css/index.css'];

require_once 'includes/header.php';
?>

<main class="page">
    <section class="accueil">
        <div class="texte">
            <h1>Explorez le monde en toute sérénité</h1>
            <p>
                Découvrez des destinations incroyables, préparez votre prochaine
                aventure et profitez d'expériences inoubliables autour du globe.
            </p>
            <div class="boutons">
                <?php if (estConnecte()): ?>
                    <a href="destinations.php">Voir les destinations</a>
                <?php else: ?>
                    <a href="register.php">rejoignez-nous</a>
                <?php endif; ?>
                <a href="about.php" class="bouton-simple">En savoir plus</a>
            </div>
        </div>
        <div class="image">
            <img
                src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1200&auto=format&fit=crop"
                alt="Image de voyage" />
        </div>
    </section>
    <section class="servicessection">
        <div class="services">
            <div class="service">
                <h2>Réservation facile</h2>
                <p>Réservez votre destination rapidement avec un processus clair et simple.</p>
            </div>
            <div class="service">
                <h2>Meilleurs tarifs</h2>
                <p>Trouvez des offres abordables et profitez d'expériences de voyage de qualité.</p>
            </div>
            <div class="service">
                <h2>Support 24/7</h2>
                <p>Notre équipe est toujours prête à vous aider à tout moment.</p>
            </div>
        </div>
    </section>
    <section class="lieux">
        <h1>Meilleurs endroits à visiter</h1>
        <div class="cartes">
            <div class="carte paris">
                <h2>Paris</h2>
            </div>
            <div class="carte tokyo">
                <h2>Tokyo</h2>
            </div>
            <div class="carte dubai">
                <h2>Dubai</h2>
            </div>
            <div class="carte rome">
                <h2>Rome</h2>
            </div>
        </div>
    </section>
    <section class="apropos">
        <div class="image-apropos">
            <img
                src="https://images.unsplash.com/photo-1493558103817-58b2924bce98?q=80&w=1200&auto=format&fit=crop"
                alt="Image à propos" />
        </div>
        <div class="texte-apropos">
            <h2>Pourquoi nous choisir</h2>
            <p>
                Nous mettons l'accent sur des expériences de voyage fluides avec des
                solutions modernes et des services conviviaux.
            </p>
            <p>
                De la réservation à la gestion de votre destination, tout est conçu
                pour rendre votre voyage plus facile.
            </p>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
