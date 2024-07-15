<?php
include_once  "../model/model.php"; 
class artikel extends Model 
{
    private $m_id;
    private $m_naziv;
    private $m_cena;
    private $m_poraba;
    private $m_motor;
    private $m_hp;
    private $m_path_slike;
    private $m_zaloga;
    private $m_id_proizvajalec;



    public function __construct($m_id = -1, $naziv = "", $cena = -1, $poraba = "", $motor = "", $hp = -1, $path_slike = "", $zaloga = -1, $id_proizvajalec = -1)
    {
        parent::__construct();

        if (!($m_id == -1))
            $this->m_id = $m_id;

        $this->m_naziv = $naziv;
        $this->m_cena = $cena;
        $this->m_poraba = $poraba;
        $this->m_motor = $motor;
        $this->m_hp = $hp;
        $this->m_zaloga = $zaloga;
        $this->m_id_proizvajalec = $id_proizvajalec;
        $this->m_path_slike = $path_slike;
    }

    function add_artikel()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_artikel (naziv, cena, poraba, motor, hp, path_slika, zaloga, id_proizvajalec) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8)",
                                        $this->m_naziv, $this->m_cena, $this->m_poraba, $this->m_motor, $this->m_hp, $this->m_path_slike, $this->m_zaloga, $this->m_id_proizvajalec);
    }

    function get_all_artikli()
    {
        if (!$this->db_conn)
            return;

        $sql = "select * from sptrg_artikel";
        $stmt = $this->db_conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function delete_artikel($id = -1)
    {
        if ($id > 0 )
            $this->m_id = $id;

        return $this->execute_sql_query("DELETE FROM sptrg_artikel WHERE id_artikel = :v1", $this->m_id);
    }
    function get_artikel($id = -1)
    {
        if ($id > 0 )
            $this->m_id = $id;

        return $this->execute_sql_query("SELECT * FROM sptrg_artikel WHERE id_artikel = :v1", $this->m_id);
    }
}