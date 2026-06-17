<?php
require_once 'includes/init.php';

if (estConnecte()) {
    header('Location: destinations.php');
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $motdepasse = $_POST['password'];

    if ($email == '' || $motdepasse == '') {
        $erreur = 'Veuillez remplir tous les champs.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($motdepasse, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'city' => $user['city'],
                'photo' => $user['photo']
            ];
            header('Location: destinations.php');
            exit;
        } else {
            $erreur = 'Email ou mot de passe incorrect.';
        }
    }
}

$pageTitle = 'Connexion';
$extraCss = ['css/inner-css/login.css'];
$bodyClass = 'page-connexion';
require_once 'includes/header.php';
?>

<main class="milieu">
    <section class="bloc">
        <h1 class="titre">Connexion</h1>
        <p class="texte">Saisissez votre email et votre mot de passe pour continuer.</p>

        <?php if ($erreur != ''): ?>
            <div class="userinfo" style="display:block;">
                <ul><li><?php echo e($erreur); ?></li></ul>
            </div>
        <?php endif; ?>

        <form class="formulaire" method="POST" action="login.php">
            <label class="champ">
                <span class="etiquette">Email</span>
                <input type="email" name="email" class="saisie" value="<?php echo e($_POST['email'] ?? ''); ?>" required>
            </label>
            <label class="champ">
                <span class="etiquette">Mot de passe</span>
                <input type="password" name="password" class="saisie" required>
            </label>
            <button type="submit" class="envoi">Se connecter</button>
        </form>

        <p class="pied">Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
