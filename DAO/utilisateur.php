<?php
class utilisateur {
    private $email_util;
    private $nom_util;
    private $prenom_util;
		private $id_type_util;

 //constructeur
    public function __construct(array $row) {
        $this->email_util = $row['email_util'];
        $this->nom_util = $row['nom_util'];
        $this->prenom_util = $row['prenom_util'];
        $this->nom_util = $row['id_type_util'];
    }

    public function get_email_util(){
		return $this->email_util;
	}

	public function set_email_util($email_util){
		$this->email_util = $email_util;
	}

	public function get_nom_util(){
		return $this->nom_util;
	}

	public function set_nom_util($nom_util){
		$this->nom_util = $nom_util;
	}

	public function get_prenom_util(){
		return $this->prenom_util;
	}

	public function set_prenom_util($prenom_util){
		$this->prenom_util = $prenom_util;
	}

	public function get_id_type_util(){
		return $this->id_type_util;
	}

	public function set_id_type_util($id_type_util){
		$this->date_naissance_adh = $date_naissance_adh;
	}
	
  public function lib_type_util($id_type_util){
    if($id_type_util = 1) {
      return 'administrateur';
    } else if ($id_type_util = 2) {
      return 'controleur';
    } else {
      return 'adhérent';
    }
  }

}   