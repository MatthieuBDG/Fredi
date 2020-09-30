<?php
class Periode {
    private $annee_per;
    private $forfait_km_per;
    private $statut_per;

    //Constructeur
    public function __construct(array $row) {
        $this->annee_per = $row['annee_per'];
        $this->forfait_km_per = $row['forfait_km'];
        $this->statut_per = $row['code_statut'];
    }

    //Get annee_per
    public function get_annee_per() {
        return $this->annee_per;
    }

    //Set annee_per
    public function set_annee_per($annee_per) {
        $this->annee_per = $annee_per;
    }

    //Get tarif
    public function get_Tarif() {
        return $this->forfait_km_per;
    }

    //Set tarif
    public function set_Tarif($forfait_km_per) {
        $this->forfait_km_per = $forfait_km_per;
    }

    //Get code statut
    public function get_statut_per() {
        return $this->statut_per;
    }

    //Set code statut
    public function set_statut_per($statut_per) {
        $this->statut_per = $statut_per;
    }
}