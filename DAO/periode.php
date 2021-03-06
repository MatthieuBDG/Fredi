<?php
class Periode {
    private $annee_per;
    private $forfait_km_per;
    private $statut_per;
    private $valeur;
    

    //Constructeur
    public function __construct(array $row) {
        $this->annee_per = $row['annee_per'];
        $this->forfait_km_per = $row['forfait_km_per'];
        $this->statut_per = $row['statut_per'];
    }

    //Get annee_per
    public function get_annee_per() {
        return $this->annee_per;
    }

    //Set annee_per
    public function set_annee_per($annee_per) {
        $this->annee_per = $annee_per;
    }
	public function get_forfait_km_per()
	{
	  return $this->forfait_km_per;
	}
	public function set_forfait_km_per($forfait_km_per)
	{
	  $this->forfait_km_per = $forfait_km_per;
  
	  return $this;
	}
    //Get tarif
    public function get_tarif() {
        return $this->forfait_km_per;
    }

    //Set tarif
    public function set_tarif($forfait_km_per) {
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