<?php
mb_internal_encoding('UTF-8');

$email = trim($_POST['email'] ?? '');
$pass = $_POST['password'] ?? '';

if (empty($email) || empty($pass)) {
    die("Email and password are required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

$pass = md5($pass);

try {
    $mysql = new mysqli('localhost', 'root', 'root', 'Exclusive');
    
    if ($mysql->connect_error) {
        throw new Exception("Connection failed: " . $mysql->connect_error);
    }
    
    $mysql->set_charset('utf8mb4');
    
    $stmt = $mysql->prepare("SELECT * FROM `users` WHERE `email` = ? AND `pass` = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $mysql->error);
    }
    
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        $stmt->close();
        $mysql->close();
        die("User not found");
    }
    
    $stmt->close();
    
    setcookie('user', $user['name'], [
        'expires' => time() + 3600,
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    $mysql->close();
    
    header('Location: index.php');
    exit();
    
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    die("An error occurred during login. Please try again.");
}
?>