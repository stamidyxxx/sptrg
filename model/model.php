<?php

class Model
{
    protected  $db_conn;
    public function __construct() 
    {
        if (!$this->db_conn)
        {
            try 
            {
                include "db/dbconf.php";

                $this->db_conn = new PDO("pgsql:host=$hostname; dbname=$dbname", $user, $pass);
                $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) 
            {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    function __destruct()
    {
        $this->db_conn = null;
    }

    function execute_sql_query($query, ...$params)
    {
        if (empty($query)) {
            return null;
        }
    
        $sttm = $this->db_conn->prepare($query);
    
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $sttm->bindValue($key + 1, $value);
            }
        }
    
        $sttm->execute();
        return $sttm->fetchAll();
    }
}