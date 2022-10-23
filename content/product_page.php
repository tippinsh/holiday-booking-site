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

<?php  $accommodation_id = $_GET['id'];?>

<?= make_head("View holiday - BFH"); ?>

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

    <div class="acc-container">
        <div class="acc-internal-container">
            <h1>
                <?php
                $title = get_content('title');
                echo $title ?>
            </h1>
            <?php
            $image = get_content('image_jpg');
            echo
            "<img class='acc-img' src=../assets/images/" . $image . ">";
            ?> 
        </div>
<br>
        <div class="text-container">
                <h2><i class="fa-solid fa-location-dot"></i>
                Where will I be staying?</h2> <br>
                <p><?php
                $result = get_content('staying_description');
                echo $result ?>
                </p>
        </div>

        <div class="text-container">
            <h2><i class="fa-solid fa-person-biking"></i>
                What will I be doing?</h2>  <br>
                <p><?php
                $result = get_content('activity_description');
                echo $result ?>
                </p>
        </div>

        <div class="text-container">
            <h2><i class="fa-solid fa-suitcase"></i>
                What about equipment?</h2>  <br>
                <p><?php
                $result = get_content('equipment_description');
                echo $result ?>
                </p>
        </div>

        <br>
    <div class="booking-container">
        <div class="price-container">
            <h3>Sound good? Book here...</h3>
            <p>
            £<?php
            $price = get_content('price_per_night');
            echo $price ?> 
            per night <br>
            Type of accommodation: <?=$type_of = get_content('accommodation_name');?>
            <br>
            Type of activity: <?= $activity = get_content('activity');?>
            </p>
            
        </div>  

        <?php $date = date('Y-m-d', strtotime("+1 days"));
            $end_date = date('Y-m-d', strtotime("+2 days"));?>
        
        <div class="form-wrapper">
            <form action="confirmation_page.php" class="booking-form" method="post">
                <label for="start_date">Check-in</label>
                <input type="date" id="start-date" name="start_date" min="<?php echo $date ?>">
        <br><br>
                <label for="end_date">Check-out</label>
                <input type="date" id="end-date" name="end_date" min="<?php echo $end_date ?>">
        <br><br>
                <label for="num_guests">Number of guests</label>
                <input type="number" name="num_guests" id="num-guests">
        <br><br> 
                <textarea id="review-text" name="booking_notes" rows="5" cols="110" maxlengh="255" placeholder="Please enter any additional notes or requests here"></textarea>
        <br><br>
        <div class="btn-wrapper">
                <input type="hidden" name="accommodation_id" value="<?php echo $accommodation_id;?>"/>
                <button name="submit" id="booking-btn">Book</button>  
        </div>
            </form>
            <p><?php
            if( ! is_logged_in()): ?>
            <p>*Make sure you're <a href='login.php'>logged in</a> or you won't be able to complete the booking!</p>
                <?php endif; ?></p>
        </div>
            </div>    
    </main>


<!-- Footer     -->
<?= make_footer() ?>

</body>
</html>