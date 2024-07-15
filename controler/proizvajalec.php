<?php
include_once  "../model/model.php"; 
class proizvajalec extends Model 
{
    private $m_id_proizvajalec;
    private $m_naziv;
    private $m_naslov;
    private $m_postna_st;
    private $m_kraj;
    private $m_drzava;
    private $m_telefonska_st;

    public function __construct( $id_proizvajalec = -1, $naziv = "", $naslov = "", $postna_st = 0, $kraj = "", $drzava = "", $telefonska_st = "")
    {
        parent::__construct();

        if (!($id_proizvajalec == -1))
            $this->m_id_proizvajalec = $id_proizvajalec;

        $this->m_naziv = $naziv;
        $this->m_naslov = $naslov;
        $this->m_postna_st = $postna_st;
        $this->m_kraj = $kraj;
        $this->m_drzava = $drzava;
        $this->m_telefonska_st = $telefonska_st;
    }

    function add_proizvajalec()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_proizvajalec (naziv, naslov, postna_st, kraj, drzava, telefonska_st) VALUES (:v1, :v2, :v3, :v4, :v5, :v6)",
                                        $this->m_naziv, $this->m_naslov, $this->m_postna_st, $this->m_kraj, $this->m_drzava, $this->m_telefonska_st);
    }

    public function get_proizvajalci() 
    {
        if (!$this->db_conn)
            return;

        $sql = "select * from sptrg_proizvajalec";
        $stmt = $this->db_conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}