<?php
require_once 'includes/init.php';

$pageTitle = 'À propos';
$extraCss = ['css/about.css'];

require_once 'includes/header.php';
?>

<div class="main">
    <div class="txt">
        <h1>À propos de nous</h1>
        <p>
            Skylane est une plateforme en ligne spécialisée dans la
            réservation de billets d'avion de manière rapide et simple.
            Notre objectif est d'aider les voyageurs à trouver les
            meilleures offres de vols avec une expérience fluide et
            agréable. Nous proposons des réservations sécurisées,
            des prix abordables et l'accès à des destinations partout
            dans le monde. Que vous voyagiez pour affaires ou pour
            des vacances, notre site rend la réservation de vols plus
            rapide et plus facile.
        </p>
    </div>
    <div class="image">
        <img src="images/pictures/airplane.jpg" alt="Avion">
    </div>
</div>
<div class="mission">
    <h2>Notre mission</h2>
    <p>
        Notre mission est de simplifier la planification des voyages
        et de connecter les personnes à des destinations dans le monde
        entier grâce à une expérience de réservation fiable et
        conviviale.
    </p>
</div>

<?php require_once 'includes/footer.php'; ?>
