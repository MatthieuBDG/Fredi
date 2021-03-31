
<?php

include_once "../init.php";

function envoi_json($erreur) {
    $json = json_encode($erreur, JSON_PRETTY_PRINT);
    header("Content-type: application/json; charset=utf-8");
    echo $json;
}


if (!isset($_GET['email']) || !isset($_GET['password'])) {
    $json = array(
        "message" => "Message « KO : erreur email et/ou mot de passe non fourni(s)»"
    );
    envoi_json($json);
} elseif (isset($_GET['email']) && isset($_GET['password'])) {

    $DAO = new DAO();

    $email = $_GET['email'];
    $mdp = $_GET['password'];

    //Verification de l'email
    $connexion = "SELECT count(*) FROM utilisateur WHERE email_util = '" . $email . "';";
    $temp_req = $DAO->executer($connexion);
    $r_connexion = $temp_req->fetch();

    //verification si email existant
    If ($r_connexion[0] == 0) {
        $erreur = array("message" => "Message « KO : erreur utilisateur inconnu »");
        envoi_json($erreur);
    } else {

        
        $r_connexion2 = "SELECT email_util, password_util FROM utilisateur WHERE email_util = '" . $email . "';"; //Recuperation de l'utilisateur
        $temp_req = $DAO->executer($r_connexion2);
        $resultat_connexion_2 = $temp_req->fetch();

        //verification du hash
        $mdp_resultat = password_verify($mdp, $resultat_connexion_2[1]);

        //Si le mdp est faux
        if ($mdp_resultat == false) {
            $erreur = array("message" => "Message « KO : erreur utilisateur inconnu »");
            envoi_json($erreur);
        } else {

            //utilisateur ---------------------------------------
            $req_1 = "SELECT email_util,  nom_util, prenom_util, id_type_util FROM utilisateur WHERE email_util = '" . $email . "';";
            $temp_req = $DAO->executer($req_1);
            $info_util = $temp_req->fetch();

            $tableau_util = array(
                "email" => $info_util[0],
                "nom" => $info_util[1],
                "prenom" => $info_util[2],
                "type" => $info_util[3]
            );


            //periode ---------------------------------
            $req_1 = "SELECT annee_per, forfait_km_per FROM periode WHERE statut_per = 1";
            $temp_req = $DAO->executer($req_1);
            $info_periode = $temp_req->fetch();

            $tableau_periode = array(
                "date" => $info_periode[0],
                "forfait" => $info_periode[1],
                "statut" => "activé"
            );


            //lignes ---------------------------------------
            $req_1 = "SELECT id_ldf, date_ldf, lib_trajet_ldf, cout_peage_ldf, cout_repas_ldf, cout_hebergement_ldf, nb_km_ldf, total_km_ldf, total_ldf, lib_mdf  FROM ligne_de_frais, motif_de_frais WHERE email_util = '" . $email . "' AND annee_per = '" . $info_periode[0] . "' AND ligne_de_frais.id_mdf = motif_de_frais.id_mdf";
            $temp_req = $DAO->executer($req_1);
            $info_lignes = $temp_req->fetchAll();


            if (count($info_lignes) == 0) {
                $json = array(
                    "message" => "Message « KO : pas de note »"
                );
                envoi_json($json);
            } else {
                $tableau_lignes = array();
                foreach ($info_lignes as $ligne) {
                    $ligne_array = array(
                        "id" => $ligne[0],
                        "date" => $ligne[1],
                        "libelle" => $ligne[2],
                        "cout_peage" => $ligne[3],
                        "cout_repas" => $ligne[4],
                        "cout_hebergement" => $ligne[5],
                        "nb_km" => $ligne[6],
                        "cout_km" => $ligne[7],
                        "total_ligne" => $ligne[8],
                        "motif" => $ligne[9]
                    );
                    $tableau_lignes[] = $ligne_array;
                }

                $json_final = array(
                    "message" => "Message « OK : note générée »",
                    "utilisateur" => $tableau_util,
                    "periode" => $tableau_periode,
                    "lignes" => $tableau_lignes
                );

                envoi_json($json_final);
            }
        }
    }
}
