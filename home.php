<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/scripts/fpdf/fpdf.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";
// check if user is logged in and not banned.
logincheck();
bancheck();
//Get Users IP address as defined in functions.php
$ip = getIP();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Mon, 22 Jul 2002 11:12:01 GMT" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />
<script src="/js/min.js"></script> 
<link rel="stylesheet" href="/css/navbar.css"> 
<title>PDF Application</title>
<meta name="Description" content="" />
<meta name="Keywords" content="" />
</head>

<body>
<nav class="nav">
<ul>
<li><a href="/home.php">Home</a></li>
<li><a href="/sign.php">Sign</a></li>
<li><a href="/database-view.php">View Docs</a></li>
<li><a href="/logout.php">Logout</a></li>
</ul>
</nav>
<center>
<p><b>
<?php echo "your IP address is $ip , and has been logged by the server for security purposes."; ?>  
</b></p>
</center>
<center>
<br>&nbsp;
<img src="/img/adobe.png" />
<h1>Welcome to the PDF Application</h1>
<p>This application allows for users to sign documents which are then output in PDF format, and have access to their signed documents.<br>The appicaton further allows users granted administrator privileges by the server's owner to access all signed documents on the server.</p>
<p> Choose an item on the menu bar above to get started. This server is pre-configured with a lorem-ipsum document for demo purposes.</p>
</center>
</body>
</html>