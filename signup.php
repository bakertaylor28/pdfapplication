<?php
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Mon, 22 Jul 2002 11:12:01 GMT" />
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />
<script src="/js/min.js"></script> 
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<center>
<p><b>
<?php 
$ip = getIP();
echo "Your IP address is $ip , and has been logged by the server for security purposes."
?></b>
<br>&nbsp;<br>&nbsp;
<img src="/img/adobe.png">
<h1>PDF Application Signup</h1>
<p>This form signs up for a new account for the PDF application.</p>
<p>Please Remember your login credentials, as they cannot be recovered.</p>
<form action="/inc/signup.php" method="post">
<label for="username">User Name: </label> 
<input type="text" name="username" placeholder="User Name" id="username" required />
<br>&nbsp;<br>&nbsp;&nbsp;
<label for="password">Password: </label>
<input type="text" name="password" placeholder="Password" id="password" required />
<br>&nbsp;<br>&nbsp;
<input type="submit" value="Signup" />
</form>
<br>&nbsp;<br>&nbsp;
<p><b>OR <a href="/login.php">Login</a></b></p>
</center>
</body>
</html>