<?php
session_start();
require_once 'webFunctions.php';

if (! is_logged_in()) {
    echo "You must be logged in to view this page, redirecting to homepage...";
    header('Refresh: 2; url=index.php');
    die();
}

$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}

$username = $_SESSION['userID'];


//Retrieve account information from the database

$sql_query = "SELECT * FROM customers WHERE customerID = ?";
$stmt_2 = mysqli_prepare($conn, $sql_query);

if($stmt_2 === false){
    echo mysqli_error($conn);
} else {
    mysqli_stmt_bind_param($stmt_2, "s", $username);
    if(mysqli_stmt_execute($stmt_2)) {
        $results = mysqli_stmt_get_result($stmt_2);
        while($row = mysqli_fetch_assoc($results)){
            $forename   =  $row['customer_forename'];
            $address1   =  $row['customer_address1'];
            $address2   =  $row['customer_address2'];
            $postcode   =  $row['customer_postcode'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?=
make_head("Account page");
?>

<body>
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
    <div class="account-container">
        <div class="account-information">
            <div class="account-1">
            <h2>Hello <?=ucfirst($forename)?>!</h2>
            </div>
            <div class="account-2"> 
                <h3>Personal info</h3><br>
                <p id="address"><i class="fa-solid fa-house"></i> <?=$address1 . ", " . $address2 . ", " . $postcode?></p>
            </div>

            <div class="account-2">
                <h3>Your Bookings</h3>
                <p><?php get_bookings($username)?></p>
            </div>


            <div class="account-2">
            <h3>Fancy leaving us a review?</h3>
            <form class="review-form" method="post" action="process_review.php">
                <label for="review"></label><br>
                    <textarea id="review-text" name="review" rows="10" cols="75" maxlengh="255" placeholder="Enter your review here (max 1000 characters)"></textarea><br><br>

                    <input type="radio" name="stars" value="1">
                    <label for="1"><span class="fa fa-star"></span></label><br>
                    <input type="radio" name="stars" value="2">
                    <label for="2"><span class="fa fa-star"></span><span class="fa fa-star"></span></label><br>
                    <input type="radio" name="stars" value="3">
                    <label for="3"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></label><br>
                    <input type="radio" name="stars" value="4">
                    <label for="4"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></label><br>
                    <input type="radio" name="stars" value="5">
                    <label for="5"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></label>
                    <br><br>
                    <button id="review-button">Submit</button>
                    </form>
            </div>
        </div>    
    </div>


<!-- Footer -->

<?= make_footer();?>




</body>
</html>