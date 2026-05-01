<?php
require_once __DIR__ . '/includes/functions.php';



if (isLoggedIn()) {
    redirect('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        setFlash('flash_error', 'Aizpildi visus laukus.');
        redirect('index.php');
    }

    if ($action === 'register') {
        $stmt = db()->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            setFlash('flash_error', 'Šāds lietotājvārds jau eksistē.');
            redirect('index.php');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = db()->prepare("INSERT INTO users (username, password_hash, role, created_at) VALUES (?, ?, 'user', NOW())");
        $stmt->execute([$username, $hash]);
        setFlash('flash_success', 'Reģistrācija veiksmīga. Tagad vari ielogoties.');
        redirect('index.php');
    }

    if ($action === 'login') {
        $stmt = db()->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            setFlash('flash_error', 'Nepareizs lietotājvārds vai parole.');
            redirect('index.php');
        }

        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
        ];

        setFlash('flash_success', 'Sveiks, ' . $user['username'] . '!');
        redirect('dashboard.php');
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="auth-grid">
    <!-- <div class="card hero-card">
        <h1>Testa “Quiz” sistēma</h1>
        <p>Ielogojies vai reģistrējies, izvēlies tematu kas tuvāks tev.</p>
        <ul class="feature-list">
            <li>5 temati</li>
            <li>Random jautājumi un atbildes</li>
            <li>Progress bar</li>
            <li>Rezultātu vēsture</li>
            <li>Admin panelis</li>
        </ul>
    </div> -->
    <div class="card auth-card">
        <h2>Login / Sign Up</h2>
        <form method="post" class="stack">
            <label>Lietotājvārds
                <input type="text" name="username" required>
            </label>
            <label>Parole
                <input type="password" name="password" required>
            </label>
            
            <div class="button-row">
    <button class="btn btn-success" type="submit" name="action" value="login">Login</button>
    <button class="btn btn-primary" type="submit" name="action" value="register">Sign Up</button>
</div>
        </form>
        <p class="small-note">admin: <strong>admin</strong> / <strong>admin123</strong></p>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
