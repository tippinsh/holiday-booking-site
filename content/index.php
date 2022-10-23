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

<?= make_head("Be Free Holidays") ?>

<body>
    <main class="container" role="img" aria-label="Woman with a hiking backpack walking towards lush green mountains.">
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



    <!-- Landing page search: this structures the main point of interest on the page. It invites the user to search a destination or activity to start their search. The main purpose of this is to draw the user in. The user will also be able to use a more detailed search further down the page -->

    <div class="search-container">
            <div class="search-1">
                <h1>LETS PLAN YOUR NEXT ADVENTURE</h1>
            </div>
            <br>
            <div class="search-2">
                <div class="search-boxes">
                    <form action="browse.php" method="get" class="search-form">
                        <label for="location"></label>
                        <input type="text" id="location" name="location" placeholder="Enter your destination">
                        <span class="or-span">
                            <span>OR</span>
                        </span>
                        <label for="activity"></label>
                        <input type="text" id="activity" name="activity" placeholder="Enter your activity">
                </div>
                <button id="submit-btn" name="submit" type="submit"><i class="fa-solid fa-magnifying-glass" style="color:white"></i></button>
                </form>
            </div>
        </div>
                    </main>

    

    <!-- Landing page content -->

    <div class="content-container-1">
        <div class="content-img">
            <i class="fa-solid fa-map-pin fa-4x"></i>
            <p class="content-item">Destinations in <br>Europe, America <br>and South Asia</p>
        </div>
        <div class="content-img">
            <i class="fa-solid fa-person-hiking fa-4x"></i>
            <p class="content-item">Dozens of activities<br> to choose from</p>
        </div>
        <div class="content-img">
            <i class="fa-solid fa-face-smile fa-4x"></i>
            <p class="content-item">Flexible, stress-free <br>booking</p>
        </div>
        <div class="content-img">
            <i class="fa-solid fa-circle-check fa-4x"></i>
            <p class="content-item">5* trusted reviews <br> on Trustpilot</p>
        </div>
    </div>

    <div class="featured">
        <h2>FEATURED</h2>
        <p>This month we're featuring all things Mediterrean. Paddleboard the beautiful clear waters of Crete, hike the
            Balkans in Montenegro or cycle the glorious Mediterrean coast in Spain to name a few. Whatever your thing,
            there's something for everyone.
        </p>
    </div>

    <div class="features-container">
        <a href="product_page.php?id=2" accesskey="2">
            <div id="featured-1" role="img" aria-label="Mountains in Crete, Greece. Seen on the edge of the sea coast.">
                <p class="feature-text">Crete</p>
            </div>
        </a>

        <a href="product_page.php?id=3" accesskey="3">
            <div id="featured-2" role="img" aria-label="Lush green scene with two small buildings surrounded by mountains">
                <p class="feature-text">Trekkin the Balkans, <br> Montenegro</p>
            </div>
        </a>

        <a href="product_page.php?id=1" accesskey="1">
            <div id="featured-3" role="img" aria-label="Two women road cycling, looking at each other">
                <p class="feature-text">Nantes, France</p>
            </div>
        </a>

        <a href="product_page.php?id=4" accesskey="4">
            <div id="featured-4" role="img" aria-label="Two sailing yachts moored in a clear blue ocean.">
                <p class="feature-text">Sailing tours, <br>Ionian Sea</p>
            </div>
        </a>

        <a href="product_page.php?id=13" accesskey="a">
            <div id="featured-5" role="img" aria-label="A man scuba diving in the ocean, small fish can be seen in the bottom of the image">
                <p class="feature-text">The Dalmatian Coast, <br> Croatia</p>
            </div>
        </a>

        <a href="product_page.php?id=5" accesskey="5">
            <div id="featured-6"  role="img" aria-label="A person surf boarding on a small wave">
                <p class="feature-text">Island of Sardinia, <br> Italy</p>
            </div>
        </a>

        <a href="product_page.php?id=10" accesskey="0">
            <div id="featured-7" role="img" aria-label="Landscape photograph of mountain in Spain">
                <p class="feature-text">Granada, <br> Spain</p>
            </div>
        </a>
    </div>



    <!-- Quote section -->

    <div class="quote-section">
        <h2 id="quote-text"> "We loved our latest trip to Kos. Be Free took care of everything, all we had to think
            about was
            when we were going to hit the water again.
            Our group leader Sarah did an excellent job and I enjoyed travelling with our international group. It was
            the best holiday we've ever been on, and we've been on a lot!
            Highly recommended."
            <br>
            <br>
            - Alex & Tom, kitesurfing in Kos (July 2021)
        </h2>
        <div id="quote-img" role="img" aria-label="A man about to start kite surfing, running towards the ocean"></div>
    </div>



    <div class="review-section">
        <div class="customer">
            <?=get_review(25)?>
        </div>

        <div class="customer">
            <?=get_review(26)?>
        </div>

        <div class="customer">
            <?=get_review(27)?>
        </div>
    </div>


    <!-- Footer -->

    <?= make_footer();?>

</body>
</html>