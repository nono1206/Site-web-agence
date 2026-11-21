<?php
ob_start();
require_once __DIR__ . '/config.php';

// Echappe une valeur avant affichage HTML
function e($valeur): string
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES, 'UTF-8');
}

// Redirige vers une adresse puis arrete le script
function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

// ----- Alertes (messages flash) -----
function set_flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function show_flash(): void
{
    if (empty($_SESSION['flash'])) {
        return;
    }
    foreach ($_SESSION['flash'] as $f) {
        echo '<div class="alert alert-' . e($f['type']) . '" role="alert">' . e($f['message']) . '</div>';
    }
    unset($_SESSION['flash']);
}

// ----- Authentification -----
function is_logged_in(): bool
{
    return isset($_SESSION['admin_id']);
}

// A appeler en haut de chaque page ou action d'administration
function require_auth(): void
{
    if (!is_logged_in() || ($_SESSION['admin_role'] ?? '') !== 'admin') {
        redirect(BASE_URL . '/admin/login.php');
    }
}

// ----- Protection CSRF -----
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

// Verifie le jeton recu en POST, sinon arrete avec une erreur 403
function csrf_check(): void
{
    $recu = $_POST['csrf'] ?? '';
    if (!hash_equals($_SESSION['csrf'] ?? '', $recu)) {
        http_response_code(403);
        die('Action refusee (jeton de securite invalide).');
    }
}