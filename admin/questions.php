<?php
require_once __DIR__ . '/../includes/functions.php';
requireLogin();
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topicId = (int)($_POST['topic_id'] ?? 0);
    $question = trim($_POST['question_text'] ?? '');
    $a = trim($_POST['option_a'] ?? '');
    $b = trim($_POST['option_b'] ?? '');
    $c = trim($_POST['option_c'] ?? '');
    $d = trim($_POST['option_d'] ?? '');
    $correct = trim($_POST['correct_answer'] ?? '');

    if ($topicId <= 0 || $question === '' || $a === '' || $b === '' || $c === '' || $d === '' || $correct === '') {
        setFlash('flash_error', 'Aizpildi visus laukus.');
        redirect('questions.php');
    }

    $stmt = db()->prepare('INSERT INTO questions (topic_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$topicId, $question, $a, $b, $c, $d, $correct]);
    setFlash('flash_success', 'Jautājums pievienots.');
    redirect('questions.php');
}

$topics = getTopics();
$recentQuestions = db()->query('SELECT q.id, q.question_text, t.name AS topic_name FROM questions q JOIN topics t ON t.id = q.topic_id ORDER BY q.id DESC LIMIT 20')->fetchAll();
require_once __DIR__ . '/../includes/header.php';
?>
<div class="two-col">
    <div class="card">
        <h2>Pievienot jautājumu</h2>
        <form method="post" class="stack">
            <label>Temats
                <select name="topic_id" required>
                    <option value="">Izvēlies tematu</option>
                    <?php foreach ($topics as $topic): ?>
                        <option value="<?= (int)$topic['id'] ?>"><?= e($topic['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Jautājums
                <textarea name="question_text" rows="3" required></textarea>
            </label>
            <label>Atbilde A
                <input type="text" name="option_a" required>
            </label>
            <label>Atbilde B
                <input type="text" name="option_b" required>
            </label>
            <label>Atbilde C
                <input type="text" name="option_c" required>
            </label>
            <label>Atbilde D
                <input type="text" name="option_d" required>
            </label>
            <label>Pareizā atbilde (ieraksti precīzi kā vienu no atbildēm)
                <input type="text" name="correct_answer" required>
            </label>
            <button class="btn btn-primary" type="submit">Saglabāt</button>
        </form>
    </div>
    <div class="card">
        <h2>Pēdējie jautājumi</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>ID</th><th>Temats</th><th>Jautājums</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($recentQuestions as $row): ?>
                        <tr>
                            <td><?= (int)$row['id'] ?></td>
                            <td><?= e($row['topic_name']) ?></td>
                            <td><?= e($row['question_text']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
