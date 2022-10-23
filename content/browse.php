<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once 'webFunctions.php';
$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}
?>


<?=
make_head("Browse - BFH");
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



<?php
if (empty($_GET)): ?>

<main>
<div class="browse-container">
        <div class="browse-item">
        <a href="product_page.php?id=1">
            <img class="browse-image" src="../assets/images/cycling3.jpg" alt="Man dressed in black road cycling in a foggy setting"></a>
            <p><?= get_holiday(1) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=2">
            <img class="browse-image" src="../assets/images/crete.jpg" alt="Crete, Greece, mountains seen on the sea's coast."></a>
            <p><?= get_holiday(2) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=3">
            <img class="browse-image" src="../assets/images/montenegro.jpg" alt="Lush green scene in the Balkan mountains, two small buildings in the centre."></a>
            <p><?= get_holiday(3) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=4">
            <img class="browse-image" src="../assets/images/sailing.jpg" alt="Two moored yacht's in a clear blue ocean"></a>
            <p><?= get_holiday(4) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=5">
            <img class="browse-image" src="../assets/images/sardinia05.jpg" alt="Mountains in Sardina seen on the sea coast."></a>
            <p><?= get_holiday(5) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=6">
            <img class="browse-image" src="../assets/images/ben_nevis.jpg" alt="Man hiking mountain, seen from the back, there is snow on the ground"></a>
            <p><?= get_holiday(6) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=7">
            <img class="browse-image" src="../assets/images/oban.jpg" alt="Choppy waves on the edge of Oban, Scotland"></a>
            <p><?= get_holiday(7) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=8">
            <img class="browse-image" src="../assets/images/alta.jpg" alt="Red house on the sea coast with a mountain in the background."></a>
            <p><?= get_holiday(8) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=9">
            <img class="browse-image" src="../assets/images/morocco.jpg" alt="Woman in a wetsuit runs along the beach with a surfboard under her arm."></a>
            <p><?= get_holiday(9) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=10">
            <img class="browse-image" src="../assets/images/granada.jpg" alt="Landscape photo mountains in Spain."></a>
            <p><?= get_holiday(10) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=11">
            <img class="browse-image" src="../assets/images/kayak_croatia.jpg" alt="Building on the coast surrounded by water with a mountain in the background."></a>
            <p><?= get_holiday(11) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=12">
            <img class="browse-image" src="../assets/images/slovenia.jpg" alt="Large lake with forests on the surrounding land. There is a building on a small island in the middle."></a>
            <p><?= get_holiday(12) ?></p>
        </div>

        <div class="browse-item">
        <a href="product_page.php?id=13">
            <img class="browse-image" src="../assets/images/scuba.jpg" alt="Man scuba diving in clear ocean"></a>
            <p><?= get_holiday(13) ?></p>
        </div>
</div>

<?php endif; ?>

<!-- Location search -->
<?php
if (! empty($_GET)){
    $location = $_GET['location'];
    $location = mysqli_real_escape_string($conn, $location);
    $activity = $_GET['activity'];
    $activity = mysqli_real_escape_string($conn, $activity);
    echo "<h2 class='search-results'> Search results...
    </h2>";
} 
?>

<?php

if (! empty($_GET['location'])): ?>
<div class="browse-container-search">
    <div class="browse-item">
        <?= get_holiday_by_search($location, "country"); ?>
    </div>      
<?php endif; 


if (! empty($_GET['activity'])): ?>
    <div class="browse-item">
        <?= get_holiday_by_search($activity, "activity"); ?>
    </div>    
</div>
<?php endif; ?>

</main>


<!-- Only show footer if on main browse page -->
<?php
if (empty($_GET)): 
echo make_footer()?>
<?php endif; ?>


</body>
</html>