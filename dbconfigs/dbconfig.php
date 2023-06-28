<?php 
class Database{
    private $databasename = "thuctaptotnghiep";
    private $port = "localhost:3306";
    private $username = "root";
    private $password = "root";
    private $connection;

    public function getConnect()
    {
        try{
            $this->connection = new PDO("mysql:host=".$this->port.";dbname=".
                $this->databasename,$this->username,$this->password);
            return $this->connection;
        } catch(Exception $e){
            echo $e ->getMessage();
        }
    }
}

?>