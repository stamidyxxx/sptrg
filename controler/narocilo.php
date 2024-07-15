<?php
include_once  "../model/model.php"; 
class narocilo extends Model 
{
    private $m_id_narocilo;
    private $m_first_name;
    private $m_last_name;
    private $m_email;
    private $m_address;
    private $m_country;
    private $m_zip;
    private $m_cc_name;
    private $m_cc_number;
    private $m_cc_expiration;
    private $m_cc_cvv;
    private $m_id_uporabnik;

    public function __construct($first_name = "", $last_name = "", $email = "", $address = "", $country = "", $zip = -1, $cc_name = "", $cc_number = "", $cc_expiration = "", $cc_cvv = -1, $id_uporabnik = -1, $id_narocilo = -1) 
    {
        parent::__construct();

        if (!($id_narocilo == -1))
            $this->m_id_narocilo = $id_narocilo;
        
        $this->m_id_narocilo = $id_narocilo;
        $this->m_first_name = $first_name;
        $this->m_last_name = $last_name;
        $this->m_email = $email;
        $this->m_address = $address;
        $this->m_country = $country;
        $this->m_zip = $zip;
        $this->m_cc_name = $cc_name;
        $this->m_cc_number = $cc_number;
        $this->m_cc_expiration = $cc_expiration;
        $this->m_cc_cvv = $cc_cvv;
        $this->m_id_uporabnik = $id_uporabnik;
    }
    function add_narocilo()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_narocilo (first_name, last_name, email, address, country, zip, cc_name, cc_number, cc_expiration, cc_cvv, id_uporabnik) 
        VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8, :v9, :v10, :v11)",
            $this->m_first_name, $this->m_last_name, $this->m_email, $this->m_address, $this->m_country, $this->m_zip, $this->m_cc_name, $this->m_cc_number, $this->m_cc_expiration, $this->m_cc_cvv, $this->m_id_uporabnik);
    }

    function get_id()
    {
        return $this->execute_sql_query("SELECT id_narocilo FROM sptrg_narocilo WHERE first_name = :v1 AND last_name = :v2 AND email = :v3 AND address = :v4 AND country = :v5 AND zip = :v6 AND cc_name = :v7 AND cc_number = :v8 AND cc_expiration = :v9 AND cc_cvv = :v10",
            $this->m_first_name, $this->m_last_name, $this->m_email, $this->m_address, $this->m_country, $this->m_zip, $this->m_cc_name, $this->m_cc_number, $this->m_cc_expiration, $this->m_cc_cvv);
    }
}