<?php
include_once  "../model/model.php"; 
class profil extends Model 
{
    private $m_id_profil;
    private $m_tip_profila;
    private $m_opis;

    function add_profil()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_profil (id_profil, tip_profila, opis) VALUES (:v1, :v2, :v3)",
                                        $this->m_id_profil,  $this->m_tip_profila, $this->m_opis);
    }
}