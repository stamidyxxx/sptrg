<?php
include_once  "../model/model.php"; 
class uporabnik extends Model 
{
    private $m_id;
    private $m_ime;
    private $m_priimek;
    private $m_naslov;
    private $m_postna_st;
    private $m_kraj;
    private $m_datum_rojstva;
    private $m_telefonska_st;
    private $m_email;
    private $m_uporabnisko_ime;
    private $m_geslo;

    public function __construct($ime = "", $priimek = "", $naslov = "", $postna_st = 0, $kraj = "", $datum_rojstva = "", $telefonska_st = "", $email = "", $uporabnisko_ime = "", $geslo = "", $id = 10)
    {
        parent::__construct();

        if (!($id == 10))
            $this->m_id = $id;

        $this->m_ime = $ime;
        $this->m_priimek = $priimek;
        $this->m_naslov = $naslov;
        $this->m_postna_st = $postna_st;
        $this->m_kraj = $kraj;
        $this->m_datum_rojstva = $datum_rojstva;
        $this->m_telefonska_st = $telefonska_st;
        $this->m_email = $email;
        $this->m_uporabnisko_ime = $uporabnisko_ime;
        $this->m_geslo = $geslo;
    }

    // temporary
    public function get_database_users() 
    {
        if (!$this->db_conn)
            return;

        $sql = "select * from sptrg_uporabnik";
        $stmt = $this->db_conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function login_user($user, $pass)
    {
        $stmt = $this->db_conn->prepare("select * from sptrg_uporabnik where uporabnisko_ime = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $passwordhash = $row['geslo'];

        if (password_verify($pass, $passwordhash))
            return $row;
        else 
            return null;
    }

    function add_uporabnik()
    {
        if (!$this->db_conn)
            return;

        return $this->execute_sql_query("INSERT INTO sptrg_uporabnik (ime, priimek, naslov, postna_st, kraj, datum_rojstva, telefonska_st, email, uporabnisko_ime, geslo) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8, :v9, :v10)",
                                    $this->m_ime, $this->m_priimek, $this->m_naslov, $this->m_postna_st, $this->m_kraj, $this->m_datum_rojstva, $this->m_telefonska_st, $this->m_email, $this->m_uporabnisko_ime, $this->m_geslo);
    }
}