<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

unset($_SESSION['admin_id'], $_SESSION['admin_role'], $_SESSION['admin_username']);
session_destroy();

session_start();
set_flash('info', 'Vous avez été déconnecté.');
redirect(BASE_URL . '/admin/login.php');