<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $erreur = 'Tous les champs sont requis.';
    } else {
        try {
            $stmt = db()->prepare('SELECT * FROM admins WHERE username = ?');
            $stmt->execute([$username]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe en clair ou haché
            if ($admin && ($password === $admin['password'] || password_verify($password, $admin['password']))) {
                // Initialisation des variables de session requises par functions.php
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'] ?? 'admin';

                header('Location: ' . BASE_URL . '/admin/index.php');
                exit();
            } else {
                $erreur = 'Identifiants incorrects.';
            }
        } catch (PDOException $e) {
            $erreur = 'Erreur BDD : ' . $e->getMessage();
        }
    }
}

$pageTitle = 'Connexion Admin';
require __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-5 mx-auto">
        <h2 class="text-center mb-4">Connexion Admin</h2>

        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger"><?= e($erreur) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required value="admin">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required value="admin123">
            </div>

            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>