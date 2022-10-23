<?php
session_start();
require_once 'webFunctions.php';
if (! is_logged_in()) {
    echo "You must be logged in to view this page, redirecting to homepage...";
    header('Refresh: 2; url=index.php');
    die();
}

echo make_head("Review - BFH");

require_once 'webFunctions.php';
$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}

//Stores the customerID from the session data to a variable
$userID = $_SESSION['userID'];


//Assigns the form data to a variable and sanitises the data
$review = $_POST['review'];
$review = filter_var($review, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$rating = $_POST['stars'];

if((strlen($review) == 0) || (strlen($rating) == 0)) {
    echo "Please complete both sections to leave a review.<br>
    Redirecting to previous page...";
    header('Refresh: 3; url=../content/account_page.php');
    die();
} 

//Gets the customer's forename from the database
$sql_query = "SELECT * FROM customers WHERE customerID = ?";

$stmt_1 = mysqli_prepare($conn, $sql_query);

if($stmt_1 == false) {
    echo mysqli_error($conn);
} else {
    mysqli_stmt_bind_param($stmt_1, "s", $userID);
    if(mysqli_stmt_execute($stmt_1)) {
        $queryresult = mysqli_stmt_get_result($stmt_1);
        while($row = mysqli_fetch_assoc($queryresult)){
            $cust_name = $row['customer_forename'];
        }
    } else {
        echo "error";
        header('Refresh: 2; url=../content/index.php');
        exit();
    }
}

//Inserts the entered review data and the customer's details into the review table
$sql = "INSERT INTO reviews (review, rating, customer_name, customerID)
        VALUE (?, ?, ?, ?)";

if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssss", $review, $rating, $cust_name, $userID);
    $result = mysqli_stmt_execute($stmt);
} 

if(!$result) {
    echo "Error when submitting the review, please try again";
    header('Refresh: 3; url=../content/account_page.php');
    exit();
} else {
    echo "Thank-you!";
    header('Refresh: 2; url=../content/index.php');
}

?>

</html>








