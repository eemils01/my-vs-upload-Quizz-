<?php
require_once __DIR__ . '/../includes/functions.php';
requireLogin();
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($name === '') {
        setFlash('flash_error', 'Temata nosaukums ir obligāts.');
        redirect('topics.php');
    }

    $stmt = db()->prepare('INSERT INTO topics (name, description) VALUES (?, ?)');
    $stmt->execute([$name, $description]);
    setFlash('flash_success', 'Temats pievienots.');
    redirect('topics.php');
}

$topics = getTopics();
require_once __DIR__ . '/../includes/header.php';
?>
<div class="two-col">
    <div class="card">
        <h2>Pievienot tematu</h2>
        <form method="post" class="stack">
            <label>Temata nosaukums
                <input type="text" name="name" required>
            </label>
            <label>Apraksts
                <textarea name="description" rows="4"></textarea>
            </label>
            <button class="btn btn-primary" type="submit">Saglabāt</button>
        </form>
    </div>
    <div class="card">
        <h2>Esošie temati</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>ID</th><th>Nosaukums</th><th>Jautājumi</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($topics as $topic): ?>
                        <tr>
                            <td><?= (int)$topic['id'] ?></td>
                            <td><?= e($topic['name']) ?></td>
                            <td><?= getQuestionCountForTopic((int)$topic['id']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
