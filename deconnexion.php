<?php
session_start();
if(isset($_SESSION['email_util'])) {
$_SESSION = array();
session_destroy();
header("location: connexion?code=deconnexion");
}else{
header("location: index");  
}
?>
