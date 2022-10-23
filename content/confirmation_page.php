<?php
session_start();

require_once 'webFunctions.php';
if (! is_logged_in()) {
    echo "You must be logged in to book a holiday, redirecting to log in page...";
    header('Refresh: 3; url=login.php');
    die();
}

$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}


//Assign form data to a variable

$start_date = $_POST['start_date'];
$start_date = mysqli_real_escape_string($conn, $start_date);
$end_date = $_POST['end_date'];
$end_date = mysqli_real_escape_string($conn, $end_date);
$guests = $_POST['num_guests'];
$guests = mysqli_real_escape_string($conn, $guests);
$accommodation_id = $_POST['accommodation_id'];
$accommodation_id = mysqli_real_escape_string($conn, $accommodation_id);

$booking_notes = $_POST['booking_notes'];
$booking_notes = filter_var($booking_notes, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

if(empty($booking_notes)){
    $booking_notes = null;
} else {
    $booking_notes = $booking_notes;
}


//Queries the database to return the chosen Accommodation's information
$sql_query = "  SELECT * 
                FROM accommodation 
                WHERE accommodationID = ?";


$stmt = mysqli_prepare($conn, $sql_query);
mysqli_stmt_bind_param($stmt, "s", $accommodation_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while($currentrow = mysqli_fetch_assoc($result)){
    $location = $currentrow['location'];
    $country = $currentrow['country'];
    $activity = $currentrow['activity'];
    $price_per_night = $currentrow['price_per_night'];
}

//Calculate date difference and total price
$check_in = date_create($start_date);
$check_out = date_create($end_date);

$days = date_diff($check_in, $check_out);

$total_days = $days -> d;

$total_price = $price_per_night * $total_days * $guests;


//Get the customer ID
$username = $_SESSION['userID'];
$username = mysqli_real_escape_string($conn, $username);


//Insert prepared statement
$sql =  "INSERT INTO booking (accommodationID, customerID, start_date, end_date, num_guests, total_booking_cost, booking_notes)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "sssssss", $accommodation_id, $username, $start_date, $end_date, $guests, $total_price, $booking_notes);
    $result = mysqli_stmt_execute($stmt);
}

if(!$result) {
    die('Query failed' .mysqli_error($conn));
}

$new_end_date = date("d-m-Y", strtotime($end_date));
$new_start_date = date("d-m-Y", strtotime($start_date));

?>


<?=
make_head("Booking confirmed");
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

<main class="confirmation-background">
    <div class="confirmation">
            <h1>
                Thanks!
            </h1>
            <h2>
                Your <?= $activity ?> holiday in <?= $location ?>, <?= $country ?> for <?= $total_days ?> days is confirmed.<br>
            </h2>
            <h3>
                Reservation details
            </h3>
             <p>
                Check-in: <?= $new_start_date ?>
                <br>
                Check-out: <?= $new_end_date ?>
                <br>
                You booked for: <?= $guests ?> guests
                <br>
                Price per night: £<?= $price_per_night ?>        
                <br>
                Total price: £<?= $total_price ?>
        </p>
     </div>


    </main>
    </body>

</html>
