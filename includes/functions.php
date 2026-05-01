<?php
require_once __DIR__ . '/../db.php';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function isAdmin(): bool
{
    return isLoggedIn() && ($_SESSION['user']['role'] ?? '') === 'admin';
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        $_SESSION['flash_error'] = 'Lūdzu, ielogojies.';
        redirect('index.php');
    }
}

function requireAdmin(): void
{
    if (!isAdmin()) {
        $_SESSION['flash_error'] = 'Nav piekļuves šai sadaļai.';
        redirect('../dashboard.php');
    }
}

function flash(string $key): ?string
{
    if (!isset($_SESSION[$key])) {
        return null;
    }
    $message = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $message;
}

function setFlash(string $key, string $message): void
{
    $_SESSION[$key] = $message;
}

function currentUserId(): ?int
{
    return $_SESSION['user']['id'] ?? null;
}

function getTopics(): array
{
    $stmt = db()->query('SELECT id, name, description FROM topics ORDER BY name');
    return $stmt->fetchAll();
}

function getQuestionCountForTopic(int $topicId): int
{
    $stmt = db()->prepare('SELECT COUNT(*) FROM questions WHERE topic_id = ?');
    $stmt->execute([$topicId]);
    return (int)$stmt->fetchColumn();
}

function fetchRandomQuestions(int $topicId, int $limit = 15): array
{
    $stmt = db()->prepare('SELECT * FROM questions WHERE topic_id = ? ORDER BY RAND() LIMIT ' . (int)$limit);
    $stmt->execute([$topicId]);
    $questions = $stmt->fetchAll();

    foreach ($questions as &$question) {
        $answers = [
            $question['option_a'],
            $question['option_b'],
            $question['option_c'],
            $question['option_d'],
        ];
        shuffle($answers);
        $question['shuffled_answers'] = $answers;
    }

    return $questions;
}

function saveHistory(int $userId, int $topicId, int $score, int $total): void
{
    $stmt = db()->prepare('INSERT INTO quiz_attempts (user_id, topic_id, score, total_questions, played_at) VALUES (?, ?, ?, ?, NOW())');
    $stmt->execute([$userId, $topicId, $score, $total]);
}

function getHistoryForUser(int $userId): array
{
    $stmt = db()->prepare('SELECT qa.*, t.name AS topic_name FROM quiz_attempts qa JOIN topics t ON t.id = qa.topic_id WHERE qa.user_id = ? ORDER BY qa.played_at DESC');
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

function getLeaderboard(): array
{
    $sql = 'SELECT u.username, t.name AS topic_name, MAX(qa.score) AS best_score, MAX(qa.total_questions) AS total_questions
            FROM quiz_attempts qa
            JOIN users u ON u.id = qa.user_id
            JOIN topics t ON t.id = qa.topic_id
            GROUP BY qa.user_id, qa.topic_id
            ORDER BY best_score DESC, username ASC';
    return db()->query($sql)->fetchAll();
}
