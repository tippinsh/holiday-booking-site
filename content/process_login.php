<?php
session_start();
session_regenerate_id();
?>

<?php
require_once 'webFunctions.php';
$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

//Retrieve the user's inputted email and password

$username = array_key_exists('username', $_REQUEST)? $_REQUEST['username']: null;
$username = mysqli_real_escape_string($conn, $username);
$password = array_key_exists('password', $_REQUEST)? $_REQUEST['password']: null;
$password = mysqli_real_escape_string($conn, $password);



//SQL query to the database to SELECT the password_hash if a matching username exists
$sql = "SELECT  password_hash 
        FROM    customers
        WHERE   username = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $username);

mysqli_stmt_execute($stmt);

$queryresult = mysqli_stmt_get_result($stmt);

$userRow = mysqli_fetch_assoc($queryresult);

if($userRow) {
    $passwordHash = $userRow['password_hash'];
    password_verify($password, $passwordHash);
} else {
    echo "Log in failed please try again, redirecting to login page...";
    header('Refresh: 3; url=login.php');
    die();
}

$verify = password_verify($password, $passwordHash);

if($verify) {
    //Assigns the customerID to the variable userID using the inputted username as an argument
    $userID = get_customerID($username);

    //Assigns the logged_in session variable to TRUE
    $_SESSION['logged_in'] = true;

    //Stores the user's ID number in a session variable
    $_SESSION['userID'] = $userID;
    echo "Logging you in...";
    header('Refresh: 2; url=index.php');
    session_regenerate_id(true);
} else {
    echo "Log in failed please try again, redirecting to login page...";
    header('Refresh: 3; url=login.php');
    die();
}
} else {
    echo "Error, redirecting...";
    header('Refresh: 1; url=login.php');
}

?>

<?= make_head("Log in - BFH"); ?>

</body>
</html>