<?php
include_once  "../model/model.php"; 
class uporabnik_has_profil extends Model 
{
    private $m_datum;
    private $m_opomba;
    private $m_id_uporabnik;
    private $m_id_profil;


    function add_uporabnik_has_profil()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_uporabnik_has_profil (datum, opomba, id_uporabnik, id_profil) VALUES (:v1, :v2, :v3, :v4)",
                                    $this->m_datum, $this->m_opomba, $this->m_id_uporabnik, $this->m_id_profil);
    }
}