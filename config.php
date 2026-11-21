<?php
// Configuration centrale du site (valeurs locales et fictives pour le TP)
define('DB_HOST', 'host.docker.internal');
define('DB_NAME', 'mini_site');
define('DB_USER', 'php_user');
define('DB_PASS', 'nnn');

define('SITE_NAME', 'TechAgence');
// Adresse de base du site (sans slash final)
define('BASE_URL', '/USLA57_TP_ELJEBLI_Nosayba/TP6');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}