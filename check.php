<?php
mb_internal_encoding('UTF-8');

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$pass = $_POST['password'] ?? '';

if (empty($name) || empty($email) || empty($pass)) {
    die("All fields are required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

if (strlen($pass) < 6) {
    die("Password must be at least 6 characters");
}

$pass = md5($pass);

try {
    $mysql = new mysqli('localhost', 'root', 'root', 'Exclusive');
    
    if ($mysql->connect_error) {
        throw new Exception("Connection failed: " . $mysql->connect_error);
    }
    
    $mysql->set_charset('utf8mb4');
    
    $check_stmt = $mysql->prepare("SELECT id FROM `users` WHERE `email` = ?");
    if (!$check_stmt) {
        throw new Exception("Prepare failed: " . $mysql->error);
    }
    
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        $check_stmt->close();
        $mysql->close();
        die("User with this email already exists");
    }
    $check_stmt->close();
    
    $insert_stmt = $mysql->prepare("INSERT INTO `users` (`name`, `email`, `pass`) VALUES (?, ?, ?)");
    if (!$insert_stmt) {
        throw new Exception("Prepare failed: " . $mysql->error);
    }
    
    $insert_stmt->bind_param("sss", $name, $email, $pass);
    
    if ($insert_stmt->execute()) {
        $insert_stmt->close();
        $mysql->close();
        
        setcookie('user', $name, [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => '',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        
        header('Location: index.php');
        exit();
    } else {
        throw new Exception("Registration failed: " . $insert_stmt->error);
    }
    
} catch (Exception $e) {
    error_log("Registration error: " . $e->getMessage());
    die("An error occurred during registration. Please try again.");
}
?>