<?php
$pageTitle = 'Nos Services';
require __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

// Récupération des services depuis la base de données
try {
    $stmt = db()->query('SELECT * FROM services ORDER BY id DESC');
    $services = $stmt->fetchAll();
} catch (PDOException $e) {
    $services = [];
}
?>

<div class="row">
    <div class="col-12 text-center mb-4">
        <h2>Nos Services</h2>
        <p class="text-muted">Découvrez les prestations que nous vous proposons.</p>
    </div>

    <?php if (empty($services)): ?>
        <div class="col-12">
            <div class="alert alert-info text-center">Aucun service disponible pour le moment.</div>
        </div>
    <?php else: ?>
        <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <!-- Adapte 'titre' et 'description' selon les noms de colonnes de ta table services -->
                        <h3 class="card-title h5"><?= e($service['titre'] ?? 'Service') ?></h3>
                        <p class="card-text"><?= nl2br(e($service['description'] ?? '')) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>