<?php
require __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$nom = '';
$email = '';
$message = '';
$succes = false;
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($nom) || empty($email) || empty($message)) {
        $erreur = 'Veuillez remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = 'Adresse email invalide.';
    } else {
        try {
            $stmt = db()->prepare('INSERT INTO messages (nom, email, message,sujet) VALUES (?, ?, ?, ?)');
            $stmt->execute([$nom, $email, $message, 'Message du formulaire de contact']);
            set_flash('success', 'Votre message a bien été envoyé !');
            redirect(BASE_URL . '/contact.php');
        } catch (PDOException $e) {
            $erreur = 'Erreur lors de l\'envoi du message : ' . $e->getMessage();
        }
    }
}
$pageTitle = 'Contact';
require __DIR__ . '/includes/header.php';
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center mb-4">Contactez-nous</h2>

        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger"><?= e($erreur) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= e($nom) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= e($email) ?>" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required><?= e($message) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Envoyer le message</button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>