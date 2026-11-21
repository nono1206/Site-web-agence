<?php
$pageTitle = 'Dashboard Admin';
require __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/db.php';
require_auth();

// Supprimer un message s'il y a une action GET
if (isset($_GET['del_msg'])) {
    $id = (int)$_GET['del_msg'];
    $stmt = db()->prepare('DELETE FROM messages WHERE id = ?');
    $stmt->execute([$id]);
    set_flash('success', 'Message supprimé.');
    redirect(BASE_URL . '/admin/index.php');
}

// Récupérer les données
$servicesCount = (int) db()->query('SELECT COUNT(*) FROM services')->fetchColumn();
$messages = db()->query('SELECT * FROM messages ORDER BY id DESC')->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tableau de Bord</h2>
    <a href="<?= BASE_URL ?>/admin/logout.php" class="btn btn-outline-danger btn-sm">Déconnexion</a>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Services enregistrés</h5>
                <p class="card-text fs-3"><?= $servicesCount ?></p>
                <a href="<?= BASE_URL ?>/admin/services_manage.php" class="btn btn-light btn-sm">Gérer les services</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Messages reçus</h5>
                <p class="card-text fs-3"><?= count($messages) ?></p>
            </div>
        </div>
    </div>
</div>

<h3>Messages reçus</h3>
<?php if (empty($messages)): ?>
    <div class="alert alert-secondary">Aucun message pour le moment.</div>
<?php else: ?>
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $m): ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><?= e($m['nom']) ?></td>
                    <td><?= e($m['email']) ?></td>
                    <td><?= e($m['message']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/admin/index.php?del_msg=<?= $m['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce message ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>