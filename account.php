<?php
session_start();

if (!isset($_COOKIE['user']) || empty($_COOKIE['user'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['logout'])) {
    setcookie('user', '', time() - 3600, '/');
    header('Location: index.php');
    exit();
}

$username = htmlspecialchars($_COOKIE['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Exclusive</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="Exclusive-welcome">
        <div class="container">
            <nav class="Exclusive-welcome__navbar">
                <a class="Exclusive-welcome__navbar-inner" href="index.php">
                    <h1>Exclusive</h1>
                </a>
                <div class="navbar-navigation">
                    <a class="navbar-navigation-item" href="index.php">
                        <p>Home</p>
                    </a>
                    <a class="navbar-navigation-item" href="contact.html">
                        <p>Contact</p>
                    </a>
                    <a class="navbar-navigation-item" href="about.html">
                        <p>About</p>
                    </a>
                    <p class="navbar-navigation-item">
                        <a class="navbar-navigation-item-inner" href="account.php">My Account</a>
                    </p>
                </div>
                <div class="navbar-functions">
                    <input type="text" placeholder="What are you looking for?">
                    <img src="images-1/Wishlist.png" class="navbar-functions-img1">
                    <img src="images-1/Cart1 with buy.png" class="navbar-functions-img2">
                </div>
            </nav>
        </div>
    </div>
    <div class="settings">
        <div class="container">
            <div class="settings_wrapper">
                <div>
                    <p>Username: <?php echo $username; ?></p>
                </div>
                <div>
                    <a href="?logout=1">Logout</a>
                </div>
            </div>
        </div>
        <h1>Welcome, <?php echo $username; ?>!</h1>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer-box">
                <div class="footer-item">
                    <h2>Exclusive</h2>
                    <p>Subscribe</p>
                    <p>Get 10% off your first order</p>
                    <input placeholder="Enter your email">
                </div>
                <div class="footer-item">
                    <h2>Support</h2>
                    <p>
                        111 Bijoy sarani, Dhaka, <br>
                        DH 1515, Bangladesh.
                    </p>
                    <p>exclusive@gmail.com</p>
                    <p>+88015-88888-9999</p>
                </div>
                <div class="footer-item">
                    <h2>Account</h2>
                    <p>My Account</p>
                    <p>Login / Register</p>
                    <p>Cart</p>
                    <p>Wishlist</p>
                    <p>Shop</p>
                </div>
                <div class="footer-item">
                    <h2>Quick Link</h2>
                    <p>Privacy Policy</p>
                    <p>Terms Of Use</p>
                    <p>FAQ</p>
                    <p>Contact</p>
                </div>
                <div class="footer-item">
                    <h2>Download App</h2>
                    <p><span>Save $3 with App New User Only</span></p>
                    <div class="footer-img-box">
                        <img src="images-1/Qr Code.png">
                        <div>
                            <img src="images-1/GooglePlay.png">
                            <img src="images-1/AppStore.png">
                        </div>
                    </div>
                    <div class="footer-logo-box">
                        <img src="images-1/Icon-Facebook.png">
                        <img src="images-1/Icon-Twitter.png">
                        <img src="images-1/icon-instagram.png">
                        <img src="images-1/Icon-Linkedin.png">
                    </div>
                </div>
            </div>
        </div>
        <p class="Copyright">Copyright Rimel 2026. All right reserved</p>
    </footer>
</body>
</html>