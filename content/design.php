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

    <div class="design-notes">
    <h1>Design notes</h1>
    <p>
        Adventure holiday company <br>
        Target audience: individuals with an interest in adventure, physical activity, culture, and community.
        <br><br>
        The design is characteristic of flat design.
        Flat design is used because it signifies modernity, minimalism and resonates with the target audience who will be predominately young adult to middle aged adults.
        <br><br>
        The main colours are two shades of olive green (#445547 and #546968). Green was chosen because it signals nature and the outdoors. 
        <br><br>
        The logo features the shortened version of the company name with a figure that is designed like an icon-style person hiking. The logo is uppercase and italicised to denote action and excitement. Icons are used throughout the website to again, promote the modern, minimalist design choice. Additionally, rounded edges on the buttons and images also promote these characteristics.
        <br><br>
        A circular font is used for most of the text to promote the minimal design choice and the “relaxed” feel to the website/company. 
        The opening message on the home page, “LETS PLAN YOUR NEXT ADVENTURE” is designed to set a conversational tone with the visitor: inviting them to engage with the site to book their next holiday. The font used for this part is Helvetica Neue or Arial, dependent on OS. This font is decisive and bold, matching the statement in tone.
        <br><br>
        Grid layouts are used often throughout and as a result, all the features on the site are symmetrical. The symmetry further promotes minimalism and modernity, it is especially characteristic of flat design. 
        <br><br>
        At points, an off-white is used to emphasise parts of a page to draw the visitor’s attention. For example, on the individual accommodation pages, the booking form is highlighted because this is where the visitor’s attention should be drawn to book a holiday.
    </p>
</div>


</body>
</html>