<?php
require_once 'includes/init.php';

$pageTitle = 'Contact';
$extraCss = ['css/contact.css'];
$extraJs = ['js/contact.js'];

require_once 'includes/header.php';
?>

<div class="all-content-body">
    <h1>Nous aimerions vous entendre</h1>
    <p>Envoyez-nous vos retours et évaluez notre service</p>
</div>

<div class="container">
    <div class="info">
        <img src="images/pictures/support.png" alt="Support" />
        <h2>Coordonnées de contact</h2>
        <p>📞 Téléphone : +212 600000000</p>
        <p>📧 Email : support@example.com</p>
        <p>📍 Adresse : Temara, Maroc</p>
        <p>Votre avis nous aide à améliorer nos services.</p>
    </div>

    <div class="form-box">
        <h2>Nous contacter</h2>
        <form id="contactForm">
            <div class="inputs_box">
                <label>Nom d'utilisateur</label>
                <input type="text" id="username" required />
            </div>
            <div class="inputs_box">
                <label>Email</label>
                <input type="email" id="email" required />
            </div>
            <div class="inputs_box">
                <label>Évaluez notre service</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5">★</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4">★</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3">★</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2">★</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1">★</label>
                </div>
            </div>
            <div class="inputs_box">
                <label>Message</label>
                <textarea id="message" required></textarea>
            </div>
            <button type="submit">Envoyer le message</button>
            <div class="success" id="successMsg"></div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
