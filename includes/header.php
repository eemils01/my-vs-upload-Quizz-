<?php require_once __DIR__ . '/functions.php'; ?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') ? '../' : '') ?>assets/style.css">
</head>
<body>
<nav class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="<?= str_contains($_SERVER['PHP_SELF'], '/admin/') ? '../dashboard.php' : 'dashboard.php' ?>">Quiz</a>
        <div class="nav-links">
            <?php if (isLoggedIn()): ?>
                <a href="<?= str_contains($_SERVER['PHP_SELF'], '/admin/') ? '../dashboard.php' : 'dashboard.php' ?>">Temati</a>
                <a href="<?= str_contains($_SERVER['PHP_SELF'], '/admin/') ? '../history.php' : 'history.php' ?>">Vēsture</a>
                <?php if (isAdmin()): ?>
                    <a href="<?= str_contains($_SERVER['PHP_SELF'], '/admin/') ? 'index.php' : 'admin/index.php' ?>">Admin</a>
                <?php endif; ?>
                <a href="<?= str_contains($_SERVER['PHP_SELF'], '/admin/') ? '../logout.php' : 'logout.php' ?>">Izlogoties</a>
            <?php else: ?>
                <a href="index.php">Ielogoties</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<main class="container">
    <?php if ($msg = flash('flash_success')): ?>
        <div class="alert success"><?= e($msg) ?></div>
    <?php endif; ?>
    <?php if ($msg = flash('flash_error')): ?>
        <div class="alert error"><?= e($msg) ?></div>
    <?php endif; ?>
