<?php
class Config{
    
    private $host = 'localhost';
    private $dbname = 'salon_fryzjerski';
    private $charset = 'utf8';
    private $username = 'root';
    private $password = '';
    private static $instance;
    
    private function __construct(){}
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Config;
        }
        return self::$instance;
    }
    
    public function getConfig(){
        return $this;
    }
    
    public function getHost(){
        return $this->host;
    }
    
    public function getDbname(){
        return $this->dbname;
    }
    
    public function getCharset(){
        return $this->charset;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getPassword(){
        return $this->password;
    }
}
?>