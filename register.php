<?php
require_once 'includes/init.php';

if (estConnecte()) {
    header('Location: index.php');
    exit;
}

$erreur = '';
$succes = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $city = trim($_POST['city']);
    $photoNom = '';

    if ($firstname == '' || $lastname == '' || $email == '' || $password == '' || $city == '') {
        $erreur = 'Tous les champs sont obligatoires.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = 'Email invalide.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erreur = 'Cet email existe déjà.';
        }
    }

    if ($erreur == '' && isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') {
            $erreur = 'Photo : JPG ou PNG seulement.';
        } elseif ($_FILES['photo']['size'] > 2097152) {
            $erreur = 'Photo : maximum 2 Mo.';
        } else {
            if (!is_dir('uploads/photos')) {
                mkdir('uploads/photos', 0755, true);
            }
            $photoNom = 'user_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/photos/' . $photoNom);
        }
    }

    if ($erreur == '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (firstname, lastname, email, password, city, photo) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$firstname, $lastname, $email, $hash, $city, $photoNom]);
        $succes = true;
    }
}

$pageTitle = 'Inscription';
$extraCss = ['css/inner-css/registre.css'];
$bodyClass = 'page-inscription';
require_once 'includes/header.php';
?>

<main class="milieu">
    <section class="bloc">
        <h1 class="titre">Inscription</h1>
        <p class="texte">Remplissez le formulaire pour créer votre compte Skylane.</p>

        <?php if ($succes): ?>
            <div class="user-verification" style="display:block; color:green;">
                <ul><li>Inscription réussie ! <a href="login.php">Connectez-vous</a></li></ul>
            </div>
        <?php endif; ?>

        <?php if ($erreur != ''): ?>
            <div class="user-verification" style="display:block;">
                <ul><li><?php echo e($erreur); ?></li></ul>
            </div>
        <?php endif; ?>

        <?php if (!$succes): ?>
        <form class="formulaire" method="POST" action="register.php" enctype="multipart/form-data">
            <label class="champ">
                <span class="etiquette">Prénom</span>
                <input type="text" name="firstname" class="saisie" value="<?php echo e($_POST['firstname'] ?? ''); ?>" required>
            </label>
            <label class="champ">
                <span class="etiquette">Nom</span>
                <input type="text" name="lastname" class="saisie" value="<?php echo e($_POST['lastname'] ?? ''); ?>" required>
            </label>
            <label class="champ">
                <span class="etiquette">Email</span>
                <input type="email" name="email" class="saisie" value="<?php echo e($_POST['email'] ?? ''); ?>" required>
            </label>
            <label class="champ">
                <span class="etiquette">Mot de passe</span>
                <input type="password" name="password" class="saisie" required>
            </label>
            <label class="champ">
                <span class="etiquette">Ville</span>
                <input type="text" name="city" class="saisie" value="<?php echo e($_POST['city'] ?? ''); ?>" required>
            </label>
            <label class="champ">
                <span class="etiquette">Photo (JPG, PNG - max 2 Mo)</span>
                <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="saisie">
            </label>
            <button type="submit" class="envoi">Créer mon compte</button>
        </form>
        <?php endif; ?>

        <p class="pied">Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
