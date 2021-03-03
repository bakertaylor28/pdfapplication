<?php
// isue require statements for necessary scripts.
session_start();
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";

//Conect to SQL database using vars passed from connect.php
dbinfo();
$con = mysqli_connect($host, $user, $pass, $dbname);
if ( mysqli_connect_errno()) {
die('Failed to connect to SQL:' . mysqli_connect_error());
}

/* Check if the data from HTML form was submitted, isset function checks for post data.
!isset means "Not Set" in php. */
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
// Perform SQL database lookup from the accounts table.
if ($stmt = $con->prepare('SELECT id, password, priv FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password, $priv);
	$stmt->fetch();
	// Account exists, now we verify the password.
if ($_POST['password'] === $password) {
/* Verification success! User has logged-in! 
Create sessions, so we know the user is logged in, they basically 
act like cookies but remember the data on the server. */
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		$_SESSION['priv'] = $priv;
		// DO Code here upon login.
	    header('Location: /home.php');
	    exit;
	} else {
		// Incorrect password
		echo 'Incorrect username and/or password! Please try again...';
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!...Please Try Again...';
}
//Close the SQL statement and the SQL database connection.
	$stmt->close();
	$con->close();
}
exit;
?>