<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? SITE_NAME;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> - <?= e(SITE_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/style1.css" rel="stylesheet">
</head>
<body>
<header class="bg-dark text-white text-center py-3">
    <h1><?= e(SITE_NAME) ?></h1>
    <nav>
        <a class="text-white mx-2" href="<?= BASE_URL ?>/index.php">Accueil</a>
        <a class="text-white mx-2" href="<?= BASE_URL ?>/about.php">À propos</a>
        <a class="text-white mx-2" href="<?= BASE_URL ?>/contact.php">Contact</a>
        <a class="text-white mx-2" href="<?= BASE_URL ?>/services.php">Services</a>
        <?php if (is_logged_in()): ?>
            <a class="text-white mx-2" href="<?= BASE_URL ?>/admin/index.php">Administration</a>
        <?php endif; ?>
    </nav>
    <button id="themeToggle" class="btn btn-outline-light btn-sm mt-3">Thème sombre</button>
</header>
<main class="container my-5">
<?php show_flash(); ?>