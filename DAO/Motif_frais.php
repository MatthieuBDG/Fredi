<?php
class Motif_frais {
    private $id_mdf;
    private $lib_mdf;
    private $statut_per;

    //Constructeur
    public function __construct(array $row) {
        $this->id_mdf = $row['id_mdf'];
        $this->lib_mdf = $row['lib_mdf'];
    }

    //Get id_mdf
    public function get_id_mdf() {
        return $this->id_mdf;
    }

    //Set id_mdf
    public function set_id_mdf($id_mdf) {
        $this->id_mdf = $id_mdf;
    }

    //Get lib_mdf
    public function get_lib_mdf() {
        return $this->lib_mdf;
    }

    //Set lib_mdf
    public function set_lib_mdf($lib_mdf) {
        $this->lib_mdf = $lib_mdf;
    }
}