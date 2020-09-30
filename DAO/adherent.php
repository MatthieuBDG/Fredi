<?php
class Adherent {
    private $email_util;
    private $lic_adh;
    private $sexe_adh;
    private $date_naissance_adh;
    private $adr1_adh;
    private $adr2_adh;
    private $adr3_adh;
    private $id_club;

 //constructeur
    public function __construct(array $row) {
        $this->email_util = $row['email_util'];
        $this->lic_adh = $row['lic_adh'];
        $this->sexe_adh = $row['sexe_adh'];
        $this->date_naissance_adh = $row['date_naissance_adh'];
        $this->adr1_adh = $row['adr1_adh'];
        $this->adr2_adh = $row['adr2_adh'];
        $this->adr3_adh = $row['adr3_adh'];
        $this->id_club = $row['id_club'];
    }

    public function get_email_util(){
		return $this->email_util;
	}

<<<<<<< HEAD
	public function set_email_util($email_util){
=======
	public function sete_mail_util($email_util){
>>>>>>> 58ea4f352cdd3c87d58c023248b9cd160bb1f79e
		$this->email_util = $email_util;
	}

	public function get_lic_adh(){
		return $this->lic_adh;
	}

	public function set_lic_adh($lic_adh){
		$this->lic_adh = $lic_adh;
	}

	public function get_sexe_adh(){
		return $this->sexe_adh;
	}

	public function set_sexe_adh($sexe_adh){
		$this->sexe_adh = $sexe_adh;
	}

	public function get_date_naissance_adh(){
		return $this->date_naissance_adh;
	}

	public function set_date_naissance_adh($date_naissance_adh){
		$this->date_naissance_adh = $date_naissance_adh;
	}

	public function get_adr1_adh(){
		return $this->adr1_adh;
	}

	public function set_adr1_adh($adr1_adh){
		$this->adr1_adh = $adr1_adh;
	}

	public function get_adr2_adh(){
		return $this->adr2_adh;
	}

	public function set_adr2_adh($adr2_adh){
		$this->adr2_adh = $adr2_adh;
	}

	public function get_adr3_adh(){
		return $this->adr3_adh;
	}

	public function set_adr3_adh($adr3_adh){
		$this->adr3_adh = $adr3_adh;
    }
    
	public function get_Code_statut(){
		return $this->code_statut;
	}

	public function set_Code_statut($code_statut){
		$this->code_statut = $code_statut;
    }
    
<<<<<<< HEAD
    public function get_id_club(){
		return $this->id_club;
	}

	public function set_id_club($id_club){
=======
    public function get_Id_club(){
		return $this->id_club;
	}

	public function set_Id_club($id_club){
>>>>>>> 58ea4f352cdd3c87d58c023248b9cd160bb1f79e
		$this->id_club = $id_club;
	}

}   