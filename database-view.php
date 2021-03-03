<?php
//issue require statements for external scripts, start session and check login credentials.
// function logincheck() is passed to this script  from functions.php
require $_SERVER['DOCUMENT_ROOT']."/scripts/fpdf/fpdf.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";
session_start();
logincheck();
bancheck();
getpriv();
$ip = getIP();
//Start HTML document
echo '<!DOCTYPE html>';
echo '<head>';
echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />';
echo '<meta http-equiv="Pragma" content="no-cache" />';
echo '<meta http-equiv="Expires" content="Mon, 22 Jul 2002 11:12:01 GMT" />';
echo '<meta name="robots" content="noindex" />';
echo '<meta name="robots" content="nofollow" />';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<script src="/js/min.js"></script>';
echo '<link rel="stylesheet" href="/css/navbar.css">';
echo '<link rel="stylesheet" href="/css/table.css">';
echo '</head>';
echo '<body>';
echo '<nav class="nav">';
echo '<ul>';
echo '<li><a href="/home.php">Home</a></li>';
echo '<li><a href="/sign.php">Sign</a></li>';
echo '<li><a href="/database-view.php">View Docs</a></li>';
echo '<li><a href="/logout.php">Logout</a></li>';
echo '</ul></nav><br>&nbsp;';
echo "<p><b>Your IP address is $ip, and has been logged by the server for security purposes.</b></p>";
echo'<center>';
echo '<img src="/img/adobe.png">';
echo '<h1>PDF Application Database View</h1>';
echo '<p>The most recent documents appear last on the list.</p>';
echo '<table>';
echo '<tr><th>';
echo 'name</th>';
echo '<th>date</th>';
echo '<th>Link</th></tr>';
//Connect to SQL database. dbinfo gets database connection parameters from connect.php
dbinfo();
$con = mysqli_connect($host, $user, $pass, $dbname);
//check for database connection errors, and kill script if errors occur.
if ( mysqli_connect_errno()) {
die('Failed to connect to SQL:' . mysqli_connect_error());
}
//Code for regular users
if ($priv === '1') {
$username = $_SESSION['name'];
//Prepare and execute SQL statement 
$stmt = $con->prepare('SELECT  name, date, url FROM app WHERE name = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
//Loop through results and write to html table rows.
while ($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row['name'] . "</td><td>" . $row['date'] . '</td><td><a href="' . $row['url'] . '">Link</a></td></tr>';
}
//Close SQL statement.
$stmt->close();    
}

//Code for Administrators
if ($priv === '2') {
//Prepare and execute SQL statement 
$stmt = $con->prepare('SELECT name, date, url FROM app');
$stmt->execute();
$result = $stmt->get_result();
//Loop through results and write to html table rows.
while ($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row['name'] . "</td><td>" . $row['date'] . '</td><td><a href="' . $row['url'] . '">Link</a></td></tr>';
}
//Close SQL statement.
$stmt->close();
}
//close Database Connecton.
$con->close();
//finish up HTML Document and exit this script.
echo '</table>';
echo '</body></html>';
exit;
?>