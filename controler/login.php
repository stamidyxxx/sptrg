<?php
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

include_once 'uporabnik.php';

if(isset($_POST['login']))
{
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];

        try 
        {
            $uporabnik = new Uporabnik();
            $data = $uporabnik->login_user($username, $password);
            if (isset($data))
            {
                $_SESSION['user'] = array(
                    'username' => $username,
                    'email' => $data['email'],
                    'id' => $data['id_uporabnik']
                );
                
                $_SESSION['logged_in'] = true;
                if ($username == "admin")
                    $_SESSION['role'] = "admin";
                else
                    $_SESSION['role'] = "user";
            }

            header("Location: ../index.php");
            exit();

        }
        catch (PDOException $e) 
        {
          echo "error: " . $e->getMessage();
        }
    }
}
