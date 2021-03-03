<?php
/* Start the PHP session, and issue required script includes for functions, database connection, 
fpdf Library. This is necessary to enable .htaccess requirements which should be imposed. */
session_start();
require $_SERVER['DOCUMENT_ROOT']."/scripts/fpdf/fpdf.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";
// check if user is logged in, and not banned.
logincheck();
bancheck();
$ip = getIP();
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Mon, 22 Jul 2002 11:12:01 GMT" />
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<br>&nbsp;
<center>
<img src="/img/adobe.png" />
<h1>PDF Application</h1>
</center>
 <center>
 <iframe src="/inc/ipsum.txt" width="80%" height="300" style="border:1px solid black;"> </iframe> 
 </center>
 <p><b>I understand and agree that by clicking "Sign" I am placing my electronic signature on the above document. I further understand that, pursuant to the Electronic Signatures in Global and National Commerce Act, U.S. federal law provides that an electronic signature is just as binding as through I signed this document in ink. I undersstand that I may not sign on behalf of any other person without legal privilege to do so, and that signing another person's electronic signature constitutes forgery, which is a felony. I further agree that today's date and my Internet Protocol (IP) Address will be automatically prepended to the signtature line.</b></p><br>&nbsp;
 <form action="/pdfexample.php" method="post">
 <label for="sig">Signature: </label>
<input type="text" name="sig" placeholder="First, MI, Last Name" id="sig" required />
 <input type="submit" value="sign" />
 <br>&nbsp;<br>&nbsp;
 </form>
</body>
</html>