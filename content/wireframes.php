<?php
session_start();

require_once 'webFunctions.php';

if (! is_logged_in()) {
    echo "You must be logged in to view this page, redirecting to homepage...";
    header('Refresh: 2; url=index.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<?= make_head("Wireframes - BFH"); ?>

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

    <main>
    <div class="wireframes-container">
        <img src="../assets/images/wireframes/index.jpg">
        <img src="../assets/images/wireframes/accommodation_details.jpg">
        <img src="../assets/images/wireframes/product_page.jpg">
        <img src="../assets/images/wireframes/login.jpg">
        <img src="../assets/images/wireframes/register.jpg">
        <img src="../assets/images/wireframes/booking_confirmation.jpg">
        <img src="../assets/images/wireframes/account_page.jpg">
    </div>
    </main>

<!-- Footer -->
<?= make_footer() ?>


</body>
</html>