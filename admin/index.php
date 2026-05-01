<?php
require_once __DIR__ . '/../includes/functions.php';
requireLogin();
requireAdmin();
require_once __DIR__ . '/../includes/header.php';
?>
<section class="page-head">
    <div>
        <h1>Admin panelis</h1>
        <p>Pievieno tematus un jautājumus caur web interfeisu.</p>
    </div>
</section>
<div class="grid cards-grid admin-grid">
    <div class="card">
        <h3>Temati</h3>
        <p>Pievieno un pārskati tematus.</p>
        <a class="btn btn-primary" href="topics.php">Atvērt</a>
    </div>
    <div class="card">
        <h3>Jautājumi</h3>
        <p>Pievieno jaunus jautājumus pie jebkura temata.</p>
        <a class="btn btn-primary" href="questions.php">Atvērt</a>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
