<?php
require $_SERVER['DOCUMENT_ROOT']."/scripts/fpdf/fpdf.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";
logout();
header("Location: /login.php");
exit;
?>