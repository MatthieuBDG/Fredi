<?php

include 'connexion_dbh.php';
// permet le hashage du mdp des utilisateurs
$sql = 'SELECT password_util,email_util FROM utilisateur';
foreach  ($dbh->query($sql) as $row) {
$passwordhash = password_hash($row['password_util'],PASSWORD_DEFAULT);  
$updatemdp = $dbh->prepare("UPDATE utilisateur SET password_util = ? WHERE email_util = ?");
$updatemdp->execute(array($passwordhash,$row['email_util']));
}
?>