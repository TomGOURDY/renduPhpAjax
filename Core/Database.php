<?php 

namespace Core;

class Database {
    public function __construct()
    {
        try {
            require "../../.gitignore/config.php";

            $this->host = $dbConfig["host"];
            $this->dbname = $dbConfig["dbname"];
            $this->dbuser = $dbConfig["dbuser"];
            $this->dbpass = $dbConfig["dbpass"];
            $this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}