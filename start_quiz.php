 <?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();

$topicId = (int)($_POST['topic_id'] ?? 0);
if ($topicId <= 0) {
    setFlash('flash_error', 'Nederīgs temats.');
    redirect('dashboard.php');
}

if (getQuestionCountForTopic($topicId) < 15) {
    setFlash('flash_error', 'Šim tematam nav pietiekami daudz jautājumu.');
    redirect('dashboard.php');
}

$questions = fetchRandomQuestions($topicId, 15);
$topicStmt = db()->prepare('SELECT name FROM topics WHERE id = ?');
$topicStmt->execute([$topicId]);
$topicName = $topicStmt->fetchColumn();

$_SESSION['quiz'] = [
    'topic_id' => $topicId,
    'topic_name' => $topicName,
    'questions' => $questions,
    'current_index' => 0,
    'score' => 0,
    'answers' => [],
    'started_at' => time(),
];

redirect('quiz.php'); 


