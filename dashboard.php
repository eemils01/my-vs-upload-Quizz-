<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();
$topics = getTopics();
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-head">
    <div>
        <h1>Sveiks, <?= e($_SESSION['user']['username']) ?>!</h1>
        <p>Izvēlies testa tematu. </p>
    </div>
    <a class="btn btn-secondary" href="history.php">Skatīt vēsturi</a>
</section>
<div class="grid cards-grid">
    <?php foreach ($topics as $topic): ?>
        <div class="card">
            <h3><?= e($topic['name']) ?></h3>
            <p><?= e($topic['description']) ?></p>
            <p><strong>Jautājumi:</strong> <?= getQuestionCountForTopic((int)$topic['id']) ?></p>
            <form method="post" action="start_quiz.php">
                <input type="hidden" name="topic_id" value="<?= (int)$topic['id'] ?>">
                <button class="btn btn-primary" type="submit">Start Quiz</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
