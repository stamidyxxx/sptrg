<?php
include_once  "../model/model.php"; 
class narocilo_has_artikel extends Model 
{
    private $m_id_narocilo;
    private $m_id_artikel;

    public function __construct( $id_narocilo = -1, $id_artikel = -1)
    {
        parent::__construct();

        $this->m_id_narocilo = $id_narocilo;
        $this->m_id_artikel = $id_artikel;
    }
    function add_narocilo_has_artikel()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_narocilo_has_artikel (id_narocilo, id_artikel) VALUES (:v1, :v2)",
                                    $this->m_id_narocilo, $this->m_id_artikel);
    }
}