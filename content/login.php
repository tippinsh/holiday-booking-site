<?php
session_start();
require_once 'webFunctions.php';
$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <script src="https://kit.fontawesome.com/5f11377bd7.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - BFH</title>
</head>

<body>
    <main>
    <nav class="navbar">
            <ul class="nav-elements">
                <a class="navigation-logo" href="index.php"></a>
            <div class="container-nav">
                <li class="expand-menu">
                    <button id="menu">
                        <i class="fa-solid fa-bars fa-xl" style="color: white;"></i>
                    </button>
                    <div class="dropdown-links">
                        <a href="../content/features.txt" accesskey="f">Features</a>
                        <a href="../content/credits.php" accesskey="c">Credits</a>
                        <a href="../content/wireframes.php" accesskey="w">Wireframes</a>
                        <a href="../content/design.php" accesskey="d">Design notes</a>
                        <a href="../content/security_report.php" accesskey="s">Security Report</a>
                    </div>
                </li>

                    <a class="nav-buttons" href="browse.php" accesskey="r">Browse</a>

                    <?php if(is_logged_in()): ?>
                    <a class="nav-buttons" href="account_page.php" accesskey="t">Account</a>
                    <a class="nav-buttons" href="logout.php" accesskey="o">Log out</a>
                    <?php else: ?>
                    <a class="nav-buttons" href="login.php" accesskey="i">Log in</a>
                    <?php endif; ?>
            </ul>
            </div>
        </nav>
        
<main>
<div class="login-container">
    <div class="login-items">
        <h2>
            Log in
        </h2>
        <br>

        <form method="post" class="login-form" action="process_login.php">
            <div>
                <label for="username">Username</label>
                <input name="username">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>

            <button>Log in</button>
        </form>

    <br>
    <div>
        <p>Need an account? Register <a href="register.php">here</a></p>
    </div>                
    </div>
</div>



</main>
    
</body>
</html>