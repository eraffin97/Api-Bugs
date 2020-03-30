<?php

namespace BugApp;

class Manager 
{

    public function connectDb(){

        require_once('params.php');

        try{

            $pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
    
            $dbh = new \PDO(DSN, LOGIN, MOT_DE_PASSE, $pdo_options);
                        
            } catch (\Exception $e){

                die('Erreur : ' . $e->getMessage());

            }

            return $dbh;
    }  
    

}