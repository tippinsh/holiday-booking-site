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

<?= make_head("Credits");
?>

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

<div class="credits">
<h1>Credits</h1>
    <p>
        J, L. (2021) <i>Free Grey Image.</i> Available at: https://unsplash.com/photos/jFz3oTdQN8E (Accessed: 08 September 2022).
    <br>
        Greenvalley Pictures. (2021) <i>Green trees near body of water during daytime photo.</i> Available at: https://unsplash.com/photos/C0YdFxGDc1s (Accessed: 01 September 2022).
    <br>
        Andraczko, D. (2015) <i>Concrete house beside body of water.</i> Available at: https://unsplash.com/photos/WS8UKXSHJaE (Accessed: 01 September 2022).
    <br>
        Segovia, J. (2020) <i>Free España image.</i> Available at: https://unsplash.com/photos/4p4JbLciFF0 (Accessed: 01 September 2022).  
    <br>
        Hansel, L. (2018) <i>Person holding surfboard.</i> Available at: https://unsplash.com/photos/hzw8rhcEEwg (Accessed: 01 September 2022).
    <br>
        Kane, S. (2017) <i>Red and white wooden house in front of a body of water.</i> Available at: https://unsplash.com/photos/XOEAHbE_vO8 (Accessed: 01 September 2022).
    <br>
        Siauciulyte, M. (2020) <i>Man in yellow jacket and brown pants walking on snow covered ground.</i> Available at: https://unsplash.com/photos/E9PDZfwNl8U (Accessed: 01 September 2022).
    <br>
        Parvanova, L. (2020) <i>Brown and green rock formation beside body of water during daytime.</i> Available at: https://unsplash.com/photos/7nlpmVuIMYg (Accessed: 01 September 2022).
    <br>
        Kramer, E. (2020) <i>HD photo.</i> Available at: https://unsplash.com/photos/8M2T2JI-DjM (Accessed: 01 September 2022).
    <br>
        Slash, A. (2018) <i>Seashore aerial view.</i> Available at: https://unsplash.com/photos/QgO_elaWkJE (Accessed: 01 September 2022).
    <br>
        Africa, J. (2021) <i>Green Mountain beside blue sea during daytime.</i> Available at: https://unsplash.com/photos/WG7yn5Wi7ww (Accessed: 01 September 2022).
    <br>
        Gailis, G. (2019) <i>Aerial view of snake road across clouds.</i> Available at: https://unsplash.com/photos/Vi_YsiO0Kd8 (Accessed: 01 September 2022).
    <br>
        Neill, A. (2017) <i>Man surfing on ocean wave during daytime.</i> Available at: https://unsplash.com/photos/uHD0uyp79Dg (Accessed: 20 August 2022).
    <br>
        Weiler, J. (2019) <i>Landscape photography of mountain.</i> Available at: https://unsplash.com/photos/y8xMDyBZ9Hk (Accessed: 20 August 2022).
    <br>
        Arbués, P. (2020) <i>White and blue boat on sea during daytime.</i> Available at: https://unsplash.com/photos/B1gDa1LjMG4 (Accessed: 20 August 2022).
    <br>
        Van de Broek, C. (2018). <i>Man and woman riding road bikes at the road near shore.</i> Available at: https://unsplash.com/photos/OFyh9TpMyM8 (Accessed: 20 August 2022).
    <br>
        Piotrek. (2020). <i>Man in red shirt and black shorts riding on a surfboard on a beach during the daytime.</i> Available at: https://unsplash.com/photos/xRbeD51srZk (Accessed: 20 August 2022).
    <br>
        Nekrashevich, L. (2020). <i>Green grass field and green mountains under white clouds and blue sky.</i> Available at: https://unsplash.com/photos/5FD4qWnP56Q (Accessed: 14 August 2022).
    <br>
        Whelen, P. (2020). <i>Brown rocky mountain blue sea under blue sky during daytime.</i> Available at: https://unsplash.com/photos/yk-m6EYL8jY (Accessed: 14 August 2022).
    <br>
        Delforge, A. (2021). <i>Man in black and white diving suit under water.</i> Available at: https://unsplash.com/photos/yZrhORWUATg (Accessed: 14 August 2022).
    <br>
        Adobe Express Creative Cloud Logo Maker. (2022). <i>Be Free Holidays</i> [Logo]. Available at: https://express.adobe.com/express-apps/logo-maker/ (Accessed: 12 August 2022). 
    <br>
        Font Awesome (2022) <i>Font Awesome Icons.</i> Available at: https://fontawesome.com/icons (Accessed: 12 August 2022).
    <br>
        Meta. (2022) <i>Facebook F </i>[Logo]. Available at: https://www.facebook.com/brand/resources/facebookapp/logo (Accessed: 24 September 2022).
    <br>
         Twitter, Inc. (2022)<i>Twitter bird </i>[Logo]. Available at: https://about.twitter.com/en/who-we-are/brand-toolkit (Accessed: 24 September 2022).
    <br>
         Meta. (2022)<i>Instagram</i>[Logo]. Available at: https://www.facebook.com/brand/resources/instagram/instagram-brand/ (Accessed: 24 September 2022).               
    <br>
        Andersson, R. (2017) <i>Inter</i>[Font]. Available at: https://fonts.google.com/specimen/Inter?query=inter (Accessed: 15 September 2022).
    <br>
        Adams, V. (2016) <i>Nunito</i>[Font]. Available at: https://fonts.google.com/specimen/Nunito?query=nunito (Accessed: 20 September 2022).
    </p>
</div>

</main>



    
</body>
</html>