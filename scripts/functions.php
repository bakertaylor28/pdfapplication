<?php
function bancheck() {
$priv = $_SESSION['priv'];
 if ($priv === '0') {
 header('Location: /ban.html');
 exit;
     }
}

function getIP() {
     // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $IP = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $IP = $forward;
    }
    else
    {
        $IP = $remote;
    }

                if ( !isset($IP)) {
                    die('Failed To Get IP Address');
                }
                if ( isset($IP)) {
                         return $IP;
                } 
}

function getpriv() {
 global $priv;
$priv = $_SESSION['priv'];
}

function logincheck() {
if (!isset($_SESSION['loggedin'])) {
 header("Location: /login.php");
   }
}

function logout() {
 session_start();
 session_unset();
 session_destroy();
}


?>