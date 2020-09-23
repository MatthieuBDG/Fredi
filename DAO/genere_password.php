<?php
//Génere mot de passe 
function genererChaineAleatoire($longueur = 15){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++){
    $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
    }
    //Utilisation de la fonction
    $newpassword = genererChaineAleatoire(15);
    $passwordhash = password_hash($newpassword,PASSWORD_DEFAULT); 
?>