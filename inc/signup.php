<?php
echo 'Signup has been disabled on this Demo Server...';
/*
// issue require statements for necessary scripts.
session_start();
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";

//Conect to SQL database using vars passed from connect.php
dbinfo();
$con = mysqli_connect($host, $user, $pass, $dbname);
if ( mysqli_connect_errno()) {
die('Failed to connect to SQL:' . mysqli_connect_error());
}

//Check if the data from HTML form was submitted, isset function checks for post data.
//!isset means "Not Set" in php. 
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
//Set POST Vars to Vars, set privilege var to default level, and lookup if account with username exists. 
// Note that Username must be UNIQUE in SQL table or SQL will return error.
$username = $_POST['username'];
$password = $_POST['password'];
$priv = '1';
//SQL table lookup
$stmt = $con->prepare('SELECT id, password, priv FROM accounts WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
//If username already in use, close statement and database connection and exit with error msg.
$stmt->close();
$con->close();
exit('Account Name is already in use. Please Try Another'); 
}else {
 //Close the SQL statement so we can prepare a new one.
 $stmt->close();
}
// Insert New Account into SQL Database if username not already in use.
$stmt = $con->prepare('INSERT INTO accounts(username, password, priv) VALUES(?, ?, ?) ');
$stmt->bind_param('sss', $username, $password, $priv);
$stmt->execute();
// Close the SQL statement and SQL Database connection.
$stmt->close();
$con->close();
//Output successful signup to user, give link to login form, then exit this script.
echo '<!DOCTYPE html>';
echo '<head></head>';
echo '<body><h1>Signup Sucessful</h1>';
echo '<p>';
echo 'You have succesfully signed up. You may now <a href="/login.php">Login</a> .</p>';
echo '</body></html>';
*/
exit; 
?>