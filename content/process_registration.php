<?php
require_once 'webFunctions.php';
$conn = getConnection();
if ($conn === false) {
    echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}

//Assigns the form data to a variable and sanitises the data
if($_SERVER['REQUEST_METHOD'] == 'POST') {
$first_name = $_REQUEST['first_name'];
$first_name = mysqli_real_escape_string($conn, $first_name);

$last_name = $_REQUEST['last_name'];
$last_name = mysqli_real_escape_string($conn, $last_name);

$first_line = $_REQUEST['first_line'];
$first_line = mysqli_real_escape_string($conn, $first_line);

$second_line = $_REQUEST['second_line'];
$second_line = mysqli_real_escape_string($conn, $second_line);

$postcode = $_REQUEST['postcode'];
$postcode = mysqli_real_escape_string($conn, $postcode);

$dob = $_REQUEST['dob'];
$dob = mysqli_real_escape_string($conn, $dob);

$username = $_REQUEST['username'];
$username = mysqli_real_escape_string($conn, $username);

$password = $_REQUEST['password'];
$password = mysqli_real_escape_string($conn, $password);

$confirm_password = $_REQUEST['confirmation_password'];
$confirm_password = mysqli_real_escape_string($conn, $confirm_password); 

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


//Checks whether all mandatory sections have been completed
if((strlen($password) == 0) || (strlen($first_name) == 0) || (strlen($last_name) == 0) || (strlen($first_line) == 0) || (strlen($postcode) == 0) || (strlen($username) == 0) || (strlen($confirm_password) == 0)) {
    echo "Mandatory sections not complete, please complete the sections marked with an asterisk (*)
    <br>Redirecting to registration page...";
    header('Refresh: 4; url=../content/register.php');
    die();
}


//Checks whether the desrired username already exists and returns the user to the registration page if it does

$sql_query = "SELECT username FROM customers";
$queryresult = mysqli_query($conn, $sql_query);

while($currentrow = mysqli_fetch_assoc($queryresult)){
    $existing_usernames = $currentrow['username'];
    if($existing_usernames === $username){
        echo "Username already exists, please choose another username. Redirecting back to registration page...";
        header('Refresh: 3; url=../content/register.php');
        die();
    }
}

//Password checking, returns to register.php if false and die() is triggered

//Checks if the password's length is greater than or equal to 8
if(strlen($password) < 8 ) { 
    echo "Password needs to be at least 8 characters, redirecting back to registration page...";
    header('Refresh: 3; url=../content/register.php');
    die();
} 


//Checks that entered password contains at least 1 number, 1 uppercase and 1 lowercase character
$password_num = preg_match('@[0-9]@', $password);
$password_uppercase = preg_match('@[A-Z]@', $password);
$password_lowercase = preg_match('@[a-z]@', $password);


if(strlen($password === !$password_num || !$password_uppercase || !$password_lowercase))
{
    echo "Please try another password.<br>
    Password must contain at least 1 number and 1 uppercase character.<br>
    Redirecting to login page...";
    header('Refresh: 3; url=../content/register.php');
    die();
}


//Checks whether the username and password match
if($username == $password){
    echo "Password and username cannot match, redirecting to login page...";
    header('Refresh: 3; url=../content/register.php');
    die();
}


//Checks if the password and password confirm match
if($password == $confirm_password) {
} else {
    echo "Passwords do not match, redirecting back to registration page...";
    header('Refresh: 3; url=../content/register.php');
    die();
}


//Insert data into Customers table
$sql =  "INSERT INTO customers (username, password_hash, customer_forename, customer_surname, customer_postcode, customer_address1, customer_address2, date_of_birth)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $hashed_password, $first_name, $last_name, $postcode, $first_line, $second_line, $dob);
    $result = mysqli_stmt_execute($stmt);
} 


if(!$result) {
    echo "Registration unsuccessful, please try again. Redirecting to registration page...";
    header('Refresh: 3; url=../content/register.php');
} else {
    echo "Registration complete! Please log in using the password you have just set...";
    header('Refresh: 3; url=../content/index.php');
}

} else {
    echo "Redirecting to homepage...";
    header('Refresh: 3; url=../content/register.php');
}
?>