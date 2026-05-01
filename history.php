<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();
$history = getHistoryForUser(currentUserId());
$leaderboard = getLeaderboard();
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-head">
    <div>
        <h1>Rezultātu vēsture</h1>
        <p>Tavi iepriekšējie mēģinājumi un labākais rezultāts.</p>
    </div>
</section>
<div class="two-col">
    <div class="card">
        <h2>Mana vēsture</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Temats</th>
                        <th>Punkti</th>
                        <th>Datums</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($history as $row): ?>
                    <tr>
                        <td><?= e($row['topic_name']) ?></td>
                        <td><?= (int)$row['score'] ?>/<?= (int)$row['total_questions'] ?></td>
                        <td><?= e($row['played_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <h2>High-score</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Lietotājs</th>
                        <th>Temats</th>
                        <th>Labākais</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($leaderboard as $row): ?>
                    <tr>
                        <td><?= e($row['username']) ?></td>
                        <td><?= e($row['topic_name']) ?></td>
                        <td><?= (int)$row['best_score'] ?>/<?= (int)$row['total_questions'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
