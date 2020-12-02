<?php
class Club {
    private $id_club;
    private $lib_club;
    private $adr1_club;
    private $adr2_club;
    private $adr3_club;
    private $id_ligue;
 //constructeur
    public function __construct(array $row) {
        $this->id_club = $row['id_club'];
        $this->lib_club = $row['lib_club'];
        $this->adr1_club = $row['adr1_club'];
        $this->adr2_club = $row['adr2_club'];
        $this->adr3_club = $row['adr3_club'];
        $this->id_ligue = $row['id_ligue'];
    }
    

 
    

    /**
     * Get the value of id_club
     */ 
    public function get_id_club()
    {
        return $this->id_club;
    }

    /**
     * Set the value of id_club
     *
     * @return  self
     */ 
    public function set_id_club($id_club)
    {
        $this->id_club = $id_club;

        return $this;
    }

    /**
     * Get the value of lib_club
     */ 
    public function get_lib_club()
    {
        return $this->lib_club;
    }

    /**
     * Set the value of lib_club
     *
     * @return  self
     */ 
    public function set_lib_club($lib_club)
    {
        $this->lib_club = $lib_club;

        return $this;
    }

    /**
     * Get the value of adr2_club
     */ 
    public function get_adr2_club()
    {
        return $this->adr2_club;
    }

    /**
     * Set the value of adr2_club
     *
     * @return  self
     */ 
    public function set_adr2_club($adr2_club)
    {
        $this->adr2_club = $adr2_club;

        return $this;
    }

    /**
     * Get the value of adr3_club
     */ 
    public function get_adr3_club()
    {
        return $this->adr3_club;
    }

    /**
     * Set the value of adr3_club
     *
     * @return  self
     */ 
    public function set_adr3_club($adr3_club)
    {
        $this->adr3_club = $adr3_club;

        return $this;
    }

    /**
     * Get the value of adr1_club
     */ 
    public function get_adr1_club()
    {
        return $this->adr1_club;
    }

    /**
     * Set the value of adr1_club
     *
     * @return  self
     */ 
    public function set_adr1_club($adr1_club)
    {
        $this->adr1_club = $adr1_club;

        return $this;
    }

    /**
     * Get the value of id_ligue
     */ 
    public function get_id_ligue()
    {
        return $this->id_ligue;
    }

    /**
     * Set the value of id_ligue
     *
     * @return  self
     */ 
    public function set_id_ligue($id_ligue)
    {
        $this->id_ligue = $id_ligue;

        return $this;
    }
    
}