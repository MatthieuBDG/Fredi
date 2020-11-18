<?php
class ligue {
    private $id_ligue;
    private $lib_ligue;
    private $url_ligue;
    private $contact_ligue;
    private $telephone_ligue;
    private $email_util;

    public function __construct(array $row) {
        $this->id_ligue = $row['id_ligue'];
        $this->lib_ligue = $row['lib_ligue'];
        $this->url_ligue = $row['url_ligue'];
		$this->contact_ligue = $row['contact_ligue'];
		$this->telephone_ligue = $row['telephone_ligue'];
		$this->email_util = $row['email_util'];
    }

    public function get_id_ligue()
    {
        return $this->id_ligue;
    }

    
    public function set_id_ligue($id_ligue)
    {
        $this->id_ligue = $id_ligue;

        return $this;
    }


    public function get_lib_ligue()
    {
        return $this->lib_ligue;
    }

 
    public function set_lib_ligue($lib_ligue)
    {
        $this->lib_ligue = $lib_ligue;

        return $this;
    }

    public function get_url_ligue()
    {
        return $this->url_ligue;
    }

 
    public function set_url_ligue($url_ligue)
    {
        $this->url_ligue = $url_ligue;

        return $this;
    }

 
    public function get_contact_ligue()
    {
        return $this->contact_ligue;
    }


    public function set_contact_ligue($contact_ligue)
    {
        $this->contact_ligue = $contact_ligue;

        return $this;
    }

    public function get_telephone_ligue()
    {
        return $this->telephone_ligue;
    }

    public function set_telephone_ligue($telephone_ligue)
    {
        $this->telephone_ligue = $telephone_ligue;

        return $this;
    }


    public function get_email_util()
    {
        return $this->email_util;
    }

    public function set_email_util($email_util)
    {
        $this->email_util = $email_util;

        return $this;
    }
}