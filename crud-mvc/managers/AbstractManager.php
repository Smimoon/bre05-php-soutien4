<?php
    abstract class AbstractManager{
        protected PDO $db;
    
        public function __construct()
        {
            $host = "db.3wa.io";
            $port = "3306";
            $dbname = "simonlaroche_soutien_crud_mvc";
            $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    
            $user = "simonlaroche";
            $password = "8d907e25f2f03cd13dc353d2ae9f5891";
    
            $this->db = new PDO(
                $connexionString,
                $user,
                $password
            );
        }
    }
?>