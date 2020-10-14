<?php
class utilisateur {
    private $email_util;
    private $nom_util;
    private $prenom_util;
		private $id_type_util;
		private $statut_util;
		private $matricule_cont;


 //constructeur
    public function __construct(array $row) {
        $this->email_util = $row['email_util'];
        $this->nom_util = $row['nom_util'];
        $this->prenom_util = $row['prenom_util'];
				$this->id_type_util = $row['id_type_util'];
				$this->statut_util = $row['statut_util'];
				$this->matricule_cont = $row['matricule_cont'];
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
		$this->$id_type_util = $id_type_util;
	}
	
		public function get_statut_util()
		{
				return $this->statut_util;
		}

		public function set_statut_util($statut_util)
		{
				$this->statut_util = $statut_util;
		}

	
		public function getMatricule_cont()
		{
				return $this->matricule_cont;
		}
	
		public function setMatricule_cont($matricule_cont)
		{
				$this->matricule_cont = $matricule_cont;
		}
}   