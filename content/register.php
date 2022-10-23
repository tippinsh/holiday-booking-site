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

<?= make_head("View holiday - BFH"); ?>

<body>

<header>
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
</header>

<div class="register-container">
    <div class="register-items">

    <h2>
        Create an account
    </h2>
    <br>
        <form method="post" class="register-form" action="process_registration.php">

            <div>
                <label for="first_name">*Your first name</label>
                <input name="first_name" id="first-name">
            </div>    

            <div>
                <label for="last_name">*Your last name</label>
                <input name="last_name" id="last-name">
            </div>   
<br><br>
            <div>
                <label for="first_line">*First line of your address</label>
                <input name="first_line" id="first-line">
            </div>

            <div>
                <label for="second_line">Second line of your address (optional)</label>
                <input name="second_line" id="second-line">
            </div>
            
            <div>
                <label for="postcode">*Your Postcode</label>
                <input name="postcode" id="postcode">
            </div>

            <div>
                <label for="dob">*Date of birth</label>
                <input type="date"  name="dob" id="dob">
            </div>
<br><br>
            <div>
                <label for="username">*Enter a username</label>
                <input name="username" id="username">
            </div>

            <div>
                <label for="password">*Enter a password</label>
                <input type="password" name="password" id="password">
            </div>     
            
            <div>
                <label for="confirmation_password">*Confirm password</label>
                <input type="password" name="confirmation_password" id="confirmation_password">
            </div>   
<br>
            <button>Register</button>
        </form>
    <br>
    <div>
        <p>Already have an account? Log in <a href="login.php">here</a></p>
    </div>                
    </div>
</div>
</body>
</html>