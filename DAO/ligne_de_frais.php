<?php
class Ligne_de_frais {
    private $id_ldf;
    private $date_ldf;
    private $lib_trajet_ldf;
    private $cout_peage_ldf;
    private $cout_repas_ldf;
    private $cout_hebergement_ldf;
    private $nb_km_ldf;
    private $total_km_ldf;
    private $total_ldf;
    private $id_mdf;
    private $annee_per;
    private $email_util;

    //Constructeur
    public function __construct(array $row) {
        $this->id_ldf = $row['id_ldf'];
        $this->lib_trajet_ldf = $row['lib_trajet_ldf'];
        $this->date_ldf = $row['date_ldf'];
        $this->cout_peage_ldf = $row['cout_peage_ldf'];
        $this->cout_repas_ldf = $row['cout_repas_ldf'];
        $this->cout_hebergement_ldf = $row['cout_hebergement_ldf'];
        $this->nb_km_ldf = $row['nb_km_ldf'];
        $this->total_km_ldf = $row['total_km_ldf'];
        $this->total_ldf = $row['total_ldf'];
        $this->id_mdf = $row['id_mdf'];
        $this->annee_per = $row['annee_per'];
        $this->email_util = $row['email_util'];
    }

    //Get id_ldf
    public function get_id_ldf() {
        return $this->id_ldf;
    }

    //Set id_ldf
    public function set_id_ldf($id_ldf) {
        $this->id_ldf = $id_ldf;
    }

    //Get lib_trajet_ldf
    public function get_lib_trajet_ldf() {
        return $this->lib_trajet_ldf;
    }

    //Set lib_trajet_ldf
    public function set_lib_trajet_ldf($lib_trajet_ldf) {
        $this->lib_trajet_ldf = $lib_trajet_ldf;
    }
        //Get date_ldf
    public function get_date_ldf() {
        return $this->date_ldf;
    }

    //Set date_ldf
    public function set_date_ldf($date_ldf) {
        $this->date_ldf = $date_ldf;
    }
    //Get get_cout_peage_ldf
    public function get_cout_peage_ldf() {
        return $this->cout_peage_ldf;
    }

    //Set get_cout_peage_ldf
    public function set_cout_peage_ldf($cout_peage_ldf) {
        $this->cout_peage_ldf = $cout_peage_ldf;
    }
    //Get cout_repas_ldf
    public function get_cout_repas_ldf() {
        return $this->cout_repas_ldf;
    }

    //Set cout_repas_ldf
    public function set_cout_repas_ldf($cout_repas_ldf) {
        $this->cout_repas_ldf = $cout_repas_ldf;
    }
    //Get cout_hebergement_ldf
    public function get_cout_hebergement_ldf() {
        return $this->cout_hebergement_ldf;
    }

    //Set cout_hebergement_ldf
    public function set_cout_hebergement_ldf($cout_hebergement_ldf) {
        $this->cout_hebergement_ldf = $cout_hebergement_ldf;
    }
    //Get nb_km_ldf
    public function get_nb_km_ldf() {
        return $this->nb_km_ldf;
    }

    //Set total_km_ldf
    public function set_nb_km_ldf($nb_km_ldf) {
        $this->nb_km_ldf = $nb_km_ldf;
    }
    //Get total_km_ldf
    public function get_total_km_ldf() {
        return $this->total_km_ldf;
    }

    //Set nb_km_ldf
    public function set_total_km_ldf($total_km_ldf) {
        $this->total_km_ldf = $total_km_ldf;
    }
    //Get total_ldf
    public function get_total_ldf() {
        return $this->total_ldf;
    }

    //Set total_ldf
    public function set_total_ldf($total_ldf) {
        $this->total_ldf = $total_ldf;
    }
    //Get id_mdf
    public function get_id_mdf() {
        return $this->id_mdf;
    }

    //Set id_mdf
    public function set_id_mdf($id_mdf) {
        $this->id_mdf = $id_mdf;
    }
    //Get annee_per
    public function get_annee_per() {
        return $this->annee_per;
    }

    //Set annee_per
    public function set_annee_per($annee_per) {
        $this->annee_per = $annee_per;
    }
    //Get email_util
    public function get_email_util() {
        return $this->email_util;
    }

    //Set email_util
    public function set_email_util($email_util) {
        $this->email_util = $email_util;
    }
}