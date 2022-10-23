<?php

//Establishes the connection to the database
function getConnection() {
    $conn = mysqli_connect('localhost', 'root', '', 'PE7045')
            or die ("Cannot connect to database");
    return $conn;
}


//Gets the required holiday information from the accommodation table

function get_content($row)
{
    $conn = getConnection();
    $id = isset($_GET['id']) ? $_GET['id'] : '';

if(is_numeric($id)) {
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT  *
            FROM    accommodation
            WHERE   accommodationID = ?";

$stmt = mysqli_prepare($conn, $sql);

    if($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        if (mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            while($currentrow = mysqli_fetch_assoc($result)){
                return $currentrow[$row];
            }
        }
    }
    } else {
        header("Location: ../content/index.php");
        exit();
    }
}


//Gets and formats the holiday information for the browse section of the site

function get_holiday($row)
{
    $conn = getConnection();
    $sql = "SELECT title, price_per_night, country, accommodation_name
            FROM accommodation
            WHERE accommodationID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    
    if($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $row);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            while($currentrow = mysqli_fetch_assoc($result)) {
                $title = $currentrow['title'];
                $price = $currentrow['price_per_night'];
                $country = $currentrow['country'];
                $type = $currentrow['accommodation_name'];
                return "<h3 id='browse-title'>" . $title . "</h3> ". 
                "<p> Price per night: £" . $price . "</p> <p>Country: " . $country . "</p><p> Type of accommodation: " . $type . "</p>";
            }
        } else {
            echo mysqli_error($conn);
        }
    }
}



//Gets and display the holiday information for the searched country or activity - not finished******

function get_holiday_by_search($row, $criteria) {
    $conn = getConnection();
    $sql = "    SELECT * 
                FROM accommodation 
                WHERE $criteria = ?"; 

    $stmt = mysqli_prepare($conn, $sql);
    
    if($stmt == false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $row);
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            while($currentrow = mysqli_fetch_assoc($result)) {
                $title = $currentrow['title'];
                $price = $currentrow['price_per_night'];
                $country = $currentrow['country'];
                $type = $currentrow['accommodation_name'];
                $image = $currentrow['image_jpg'];
                $id = $currentrow['accommodationID'];
        
                echo "<img class='browse-image-search' src=../assets/images/" . $image . ">" . "<br>";
                echo "<p id='browse-title'>" . $title . "</p>". "Price per night: £" . $price . "<br> Country: " . $country . "<br> Type of accommodation: " . $type . "<br><a href='product_page.php?id=" . $id . "'> Click here to view </a> <br><br>";
            }
        }
    }
}


//Gets the total cost of the booking, returns the total cost

function get_booking_amount($id) {
    $conn = getConnection();

    $sql = "SELECT Accommodation.price_per_night, 
            DATEDIFF(Booking.end_date, Booking.start_date) AS 'total_nights'
            FROM Accommodation
            INNER JOIN Booking ON Accommodation.accommodationID = Booking.accommodationID
            WHERE Accommodation.accommodationID AND Booking.accommodationID = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            while($currentrow = mysqli_fetch_assoc($result)) {
                $price_per_night = $currentrow['price_per_night'];
                $total_nights = $currentrow['total_nights'];
                $total = $price_per_night * $total_nights;
                return $total;
            }
    } else {
        echo mysqli_error($conn);
    }
}
}

// Returns whether a user is logged in or not using the $_SESSION data
function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
}

function make_nav() {
    $nav = <<< NAV

    <nav class="navbar">
        <ul class="nav-elements">
            <a class="navigation-logo" href="index.php"></a>
            <div class="container-nav">
            <li class="expand-menu">
                    <button id="menu">
                        <i class="fa-solid fa-bars fa-xl" style="color: white;"></i>
                    </button>
                    <div class="dropdown-links">
                        <a href="../content/features.txt">Features</a>
                        <a href="../content/credits.php">Credits</a>
                        <a href="../content/wireframes.php">Wireframes</a>
                        <a href="../content/design.php">Design notes</a>
                        <a href="../content/security_report.php">Security Report</a>
                    </div>
                </li>


                <a class="nav-buttons" href="browse.php">Browse</a>

                <?php if(is_logged_in()): ?>
                    <a class="nav-buttons" href="account_page.php">Account</a>
                    <a class="nav-buttons" href="logout.php">Log out</a>
                    <?php else: ?>
                    <a class="nav-buttons" href="login.php">Log in</a>
                    <?php endif; ?>
        </ul>
        </div>
</nav>
NAV;
return $nav;
}




//Makes the footer

function make_footer() {
    $nav_footer = <<< FOOTER

    <footer class="footer">
    <div>
        <h2>BE FREE HOLIDAYS</h2>
        <p>Copyright &#169; 2022 Be Free Holdiays, Inc.</p><br>
        <p>Contact us | FAQs | About us</p>
        <div class="footer-icons">
            <div><i class="fa-brands fa-facebook fa-2x"></i></div>
            <div><i class="fa-brands fa-instagram fa-2x"></i></div>
            <div><i class="fa-brands fa-twitter fa-2x"></i></div>
        </div>
    </div>
</footer>

FOOTER;
return $nav_footer;
}

//Makes the head

function make_head($title) {
    $head = <<< HEAD

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
    <title>$title</title>
</head>

HEAD;
return $head;
}


//Gets the review data to display

function get_review($review) {
$conn = getConnection();

$sql = "SELECT * FROM reviews WHERE reviewID = ?";

$stmt = mysqli_prepare($conn, $sql);

if($stmt === false) {
    echo mysqli_error($conn);
} else {
    mysqli_stmt_bind_param($stmt, "s", $review);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while($currentrow = mysqli_fetch_assoc($result)) {
            $review = $currentrow['review'];
            $rating = $currentrow['rating'];
            $cust_name = $currentrow['customer_name'];
        }
} else {
    echo mysqli_error($conn);
}
}

$int = intval($rating);

echo "<h3>" . $cust_name . "</h3>
<p>" . $review . "</p> <br>";
for($i = 0; $i < $int; $i++) {
    $stars = "<span class='fa fa-star'></span>";
    echo $stars;
}
}


//Returns the customer's customerID from the username inputted in the log in form

function get_customerID($username) {
    $conn = getConnection();

    $sql = "SELECT  customerID
            FROM    customers
            WHERE   username = ?";

$stmt = mysqli_prepare($conn, $sql);

if($stmt === false) {
    echo mysqli_error($conn);
} else {
    mysqli_stmt_bind_param($stmt, "s", $username);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while($currentrow = mysqli_fetch_assoc($result)) {
            $customerID = $currentrow['customerID'];
            return $customerID;
        }
} else {
    echo mysqli_error($conn);
}
}
}


//Gets the upcoming bookings to display on the account page

function get_bookings($username) {
$conn = getConnection();
$sql = "SELECT * 
        FROM ((customers 
        INNER JOIN booking ON customers.customerID = booking.customerID)
        INNER JOIN accommodation ON booking.accommodationID = accommodation.accommodationID)
        WHERE customers.customerID = ?";


$stmt = mysqli_prepare($conn, $sql);

if($stmt === false){
    echo mysqli_error($conn);
} else {
    mysqli_stmt_bind_param($stmt, "s", $username);
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while($currentrow = mysqli_fetch_assoc($result)){
            $bookingID = $currentrow['bookingID'];  
            $location  = $currentrow['location'];
            $check_in = $currentrow['start_date'];
            $total_cost = $currentrow['total_booking_cost'];
            $num_guests = $currentrow['num_guests'];
            $check_out = $currentrow['end_date'];

            $new_end_date = date("d-m-Y", strtotime($check_out));
            $new_start_date = date("d-m-Y", strtotime($check_in));

            echo "Your trip to " . $location . " is coming up on " . $new_start_date. ". <br> Total cost: £" . $total_cost . "<br> Number of guests " . $num_guests . "<br> Check-out date: " . $new_end_date . "<br><br>";
            } 
            }
        }
    }
?>