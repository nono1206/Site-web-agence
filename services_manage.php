<?php
$pageTitle = 'Gestion des Services';
require __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/db.php';
require_auth();

$erreur = '';

// Ajout d'un service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($titre) || empty($description)) {
        $erreur = 'Tous les champs sont requis.';
    } else {
        $stmt = db()->prepare('INSERT INTO services (titre, description) VALUES (?, ?)');
        $stmt->execute([$titre, $description]);
        set_flash('success', 'Service ajouté avec succès !');
        redirect(BASE_URL . '/admin/services_manage.php');
    }
}

// Suppression d'un service
if (isset($_GET['del'])) {
    $id = (int)$_GET['del'];
    $stmt = db()->prepare('DELETE FROM services WHERE id = ?');
    $stmt->execute([$id]);
    set_flash('success', 'Service supprimé.');
    redirect(BASE_URL . '/admin/services_manage.php');
}

$services = db()->query('SELECT * FROM services ORDER BY id DESC')->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Services</h2>
    <a href="<?= BASE_URL ?>/admin/index.php" class="btn btn-secondary btn-sm">Retour au dashboard</a>
</div>

<?php if ($erreur): ?>
    <div class="alert alert-danger"><?= e($erreur) ?></div>
<?php endif; ?>

<div class="row">
    <!-- Formulaire d'ajout -->
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h4 class="h5 mb-3">Ajouter un service</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Liste des services -->
    <div class="col-md-8">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $s): ?>
                    <tr>
                        <td><?= $s['id'] ?></td>
                        <td><?= e($s['titre']) ?></td>
                        <td><?= e($s['description']) ?></td>
                        <td>
                            <a href="?del=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce service ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>