<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();

if (!isset($_SESSION['quiz'])) {
    setFlash('flash_error', 'Nav pabeigta testa.');
    redirect('dashboard.php');
}

$quiz = $_SESSION['quiz'];
$total = count($quiz['questions']);
$score = (int)$quiz['score'];

if (!isset($_SESSION['quiz_saved'])) {
    saveHistory(currentUserId(), (int)$quiz['topic_id'], $score, $total);
    $_SESSION['quiz_saved'] = true;
}

require_once __DIR__ . '/includes/header.php';
?>
<div class="result-wrap">
    <div class="card result-card">
        <h1>Your Quiz Results</h1>
        <p class="result-score"><?= e($_SESSION['user']['username']) ?>, tu atbildēji pareizi uz <strong><?= $score ?></strong> no <strong><?= $total ?></strong> jautājumiem.</p>
        <div class="result-actions">
            <form method="post" action="start_quiz.php">
                <input type="hidden" name="topic_id" value="<?= (int)$quiz['topic_id'] ?>">
                <button class="btn btn-success" type="submit">Retake Quiz</button>
            </form>
            <a class="btn btn-primary" href="dashboard.php">Choose Another Topic</a>
        </div>
    </div>
</div>
<?php
unset($_SESSION['quiz']);
unset($_SESSION['quiz_saved']);
require_once __DIR__ . '/includes/footer.php';
?>
