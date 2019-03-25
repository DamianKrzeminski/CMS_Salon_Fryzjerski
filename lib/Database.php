<?php
require_once ("Config.php");
class Database{
    
    private static $instance;
    private $Database;
    
    private function __construct(){}
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getDb(){
        if(isset($this->Database)){
            return $this->Database;
        }
        $parameters = Config::getInstance()->getConfig();
        $database = new PDO('mysql:
            host='.$parameters->getHost().';
            dbname='.$parameters->getDbname().';
            charset=' . $parameters->getCharset() .'',
            $parameters->getUsername(),
            $parameters->getPassword()
        );
        $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $database;
    }
    
    public function save($table, $object){
        if($object->getId()){
            $set = $this->prepareSet($object);
            $query = $this->getDb()->prepare("UPDATE $table SET $set WHERE id=:id");
        }else{
            $names = $this->prepareNames($object);
            $values = $this->prepareValues($object);
            $query = $this->getDb()->prepare("INSERT INTO $table ($names) VALUES ($values)");
        }
        $query = $this->bindParams($query, $object);
        return $query->execute();
    }
    
    public function prepareSet($object){
        foreach($object->getObjectVars() as $varName => $varValue){
            $set[] = "$varName=:$varName";
        }
        return implode(', ',$set);
    }
    
    public function prepareNames($object){
        foreach($object->getObjectVars() as $varName => $varValue){
            if($varName != 'id'){
               $names[] = $varName; 
            }
        }
        return implode(', ',$names);
    }
    
    public function prepareValues($object){
        foreach($object->getObjectVars() as $varName => $varValue){
            if($varName != 'id'){
                $values[] = ":$varName";
            }
        }
        return implode(', ',$values);
    }
    
    public function bindParams($query, $object){
        foreach($object->getObjectVars() as $varName => &$varValue){
            if(!$object->getId() && $varName == 'id'){
                continue;
            }
            $query->bindParam(":$varName", $varValue);
        }
        return $query;
    }
}
?>