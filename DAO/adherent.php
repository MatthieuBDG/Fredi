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
        $this->lic_adh = $row['lic_adh '];
        $this->sexe_adh = $row['sexe_adh'];
        $this->date_naissance_adh = $row['date_naissance_adh'];
        $this->adr1_adh = $row['adr1_adh'];
        $this->adr2_adh = $row['adr2_adh'];
        $this->adr3_adh = $row['adr3_adh'];
        $this->id_club = $row['id_club'];
    }

    public function getemail_util(){
		return $this->email_util;
	}

	public function setemail_util($email_util){
		$this->email_util = $email_util;
	}

	public function getlic_adh(){
		return $this->lic_adh;
	}

	public function setlic_adh($lic_adh){
		$this->lic_adh = $lic_adh;
	}

	public function getsexe_adh(){
		return $this->sexe_adh;
	}

	public function setsexe_adh($sexe_adh){
		$this->sexe_adh = $sexe_adh;
	}

	public function getdate_naissance_adh(){
		return $this->date_naissance_adh;
	}

	public function setdate_naissance_adh($date_naissance_adh){
		$this->date_naissance_adh = $date_naissance_adh;
	}

	public function getadr1_adh(){
		return $this->adr1_adh;
	}

	public function setadr1_adh($adr1_adh){
		$this->adr1_adh = $adr1_adh;
	}

	public function getadr2_adh(){
		return $this->adr2_adh;
	}

	public function setadr2_adh($adr2_adh){
		$this->adr2_adh = $adr2_adh;
	}

	public function getadr3_adh(){
		return $this->adr3_adh;
	}

	public function setadr3_adh($adr3_adh){
		$this->adr3_adh = $adr3_adh;
    }
    
	public function getCode_statut(){
		return $this->code_statut;
	}

	public function setCode_statut($code_statut){
		$this->code_statut = $code_statut;
    }
    
    public function getId_club(){
		return $this->id_club;
	}

	public function setId_club($id_club){
		$this->id_club = $id_club;
	}

}   