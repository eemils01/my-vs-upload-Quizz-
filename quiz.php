<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();

if (!isset($_SESSION['quiz'])) {
    setFlash('flash_error', 'Vispirms sāc testu.');
    redirect('dashboard.php');
}

$quiz = &$_SESSION['quiz'];
//addoju
if (
    !isset($quiz['questions']) ||
    !is_array($quiz['questions']) ||
    count($quiz['questions']) === 0
) {
    setFlash('flash_error', 'Testā nav jautājumu.');
    unset($_SESSION['quiz']);
    redirect('dashboard.php');
}
//addoju


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = trim($_POST['answer'] ?? '');
    $questionIndex = (int)($_POST['question_index'] ?? -1);

    if (!isset($quiz['questions'][$questionIndex])) {
        setFlash('flash_error', 'Nederīgs jautājums.');
        redirect('quiz.php');
    }


    $question = $quiz['questions'][$questionIndex];
    $quiz['answers'][$question['id']] = $selected;
    if ($selected === $question['correct_answer']) {
        $quiz['score']++;
    }

    $quiz['current_index']++;
    if ($quiz['current_index'] >= count($quiz['questions'])) {
        redirect('result.php');
    }

    redirect('quiz.php');
}

$currentIndex = $quiz['current_index'];
$total = count($quiz['questions'] ?? []);

if (!isset($quiz['questions'][$currentIndex])) {
    redirect('result.php');
}

$question = $quiz['questions'][$currentIndex];
$progressPercent = (int)(($currentIndex / $total) * 100);

require_once __DIR__ . '/includes/header.php';
?>
<div class="quiz-wrap">
    <div class="card quiz-card">
        <div class="quiz-top">
            <div>
                <h2><?= e($quiz['topic_name']) ?> Quiz</h2>
                <p>Question <?= $currentIndex + 1 ?> of <?= $total ?></p>
            </div>
            <a class="btn btn-light" href="dashboard.php" onclick="return confirm('Vai tiešām pārtraukt testu?');">Iziet</a>
        </div>

        <div class="progress">
            <div class="progress-bar" style="width: <?= $progressPercent ?>%;"></div>
        </div>

        <h3 class="question-title"><?= e($question['question_text']) ?></h3>

        <form method="post" class="stack">
            <input type="hidden" name="question_index" value="<?= $currentIndex ?>">
            <?php foreach ($question['shuffled_answers'] as $answer): ?>
                <label class="option">
                    <input type="radio" name="answer" value="<?= e($answer) ?>" required>
                    <span><?= e($answer) ?></span>
                </label>
            <?php endforeach; ?>
            <button class="btn btn-primary" type="submit">Submit Answer</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
