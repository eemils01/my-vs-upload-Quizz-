<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'quiz_system');
define('DB_USER', 'root');
define('DB_PASS', '');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Europe/Riga');
