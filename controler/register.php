<?php
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once 'uporabnik.php';

if(isset($_POST['register']))
{
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword']))
    {
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirmpassword=$_POST['confirmpassword'];

        if ($password == $confirmpassword)
        {
            try 
            {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
                $uporabnik = new uporabnik(-1, "", "", "", 0, "", '1999-01-01', "", $email, $username, $hashed_password);
                $uporabnik->add_uporabnik();

                header("Location: ../index.php");
                exit();

            } catch (PDOException $e) 
            {
                echo "error: " . $e->getMessage();
            }
        }
    }
}