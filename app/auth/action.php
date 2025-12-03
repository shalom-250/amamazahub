<?php
// filepath: app/auth/action.php
header('Content-Type: application/json');
session_start();

require_once '../system/cogs/db.php'; // Adjust path as needed
require_once '../../sendmail.php'; // Adjust path as needed

function jsonResponse($success, $message, $redirect = null) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'redirect' => $redirect
    ]);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

if ($action === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        jsonResponse(false, 'Username and password are required.');
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = [$user['username'], $user['email'], $user['status'], $user['created_at'], $user['updated_at']];
        $_SESSION['token'] = bin2hex(random_bytes(16));
        $_SESSION['project_id'] = '965766';
        jsonResponse(true, 'Login successful.', '@home');
    } else {
        jsonResponse(false, 'Invalid username or password.');
    }
}

if ($action === 'register') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $email === '' || $password === '') {
        jsonResponse(false, 'All fields are required.');
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        jsonResponse(false, 'Username or email already exists.');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hashedPassword])) {
        $id = $pdo->lastInsertId();
        $add = $pdo->prepare("INSERT INTO `user_profile`(`user_id`, `first_name`, `last_name`, `username`, `email`, `phone`, `avatar_url`, `bio`, `gender`, `date_of_birth`, `country`, `city`, `state`, `zip_code`, `social_links`, `created_at`, `updated_at`) VALUES 
            (?, ?, '', ?, ?, '', '', '', '', '', '', '', '', '', NULL, CURRENT_TIMESTAMP, NULL)");
        $add->execute([$id, $username, $username, $email]);

        jsonResponse(true, 'Registration successful.', '@home');
    } else {
        jsonResponse(false, 'Registration failed.');
    }
}

if ($action === 'forgot') {
    $email = trim($_POST['email'] ?? '');
    if ($email === '') {
        jsonResponse(false, 'Email is required.');
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $stmt = $pdo->prepare("UPDATE users SET verification_code = ?, verification_code_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = ?");
        $stmt->execute([$token, $user['id']]);

        sendingEmail([
            'email' => $email,
            'subject' => "Password Reset",
            'message' => "Reset link: http://localhost/amamazahub/@reset?token=$token"
        ]);

        jsonResponse(true, 'Reset link sent to your email.');
    } else {
        jsonResponse(false, 'Email not found.');
    }
}

/* -------------------------------
   NEW API: verify_token
--------------------------------- */
if ($action === 'verify_token') {
    $token = trim($_GET['token'] ?? $_POST['token'] ?? '');
    if ($token === '') {
        jsonResponse(false, 'Token is required.');
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE verification_code = ? AND verification_code_expires > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        jsonResponse(true, 'Token is valid.');
    } else {
        jsonResponse(false, 'Invalid or expired token.');
    }
}

/* -------------------------------
   NEW API: reset_password
--------------------------------- */
if ($action === 'reset_password') {
    $token = trim($_POST['token'] ?? '');
    $password1 = trim($_POST['password1'] ?? '');
    $password2 = trim($_POST['password2'] ?? '');

    if ($token === '' || $password1 === '' || $password2 === '') {
        jsonResponse(false, 'All fields are required.');
    }

    if ($password1 !== $password2) {
        jsonResponse(false, 'Passwords do not match.');
    }

    // Check if token is valid
    $stmt = $pdo->prepare("SELECT id FROM users WHERE verification_code = ? AND verification_code_expires > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if (!$user) {
        jsonResponse(false, 'Invalid or expired token.');
    }

    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = ?, verification_code = NULL, verification_code_expires = NULL WHERE id = ?");
    $stmt->execute([$hashedPassword, $user['id']]);

    jsonResponse(true, 'Password has been reset successfully.', '@login');
}

jsonResponse(false, 'Invalid action.');
?>
