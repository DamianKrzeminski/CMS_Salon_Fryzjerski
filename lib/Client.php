<?php
class Client{
    private $id;
    private $firstname;
    private $lastname;
    private $phone;
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getFirstname(){
        return $this->firstname;
    }
    
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    
    public function getLastname(){
        return $this->lastname;
    }
    
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    
    public function getPhone(){
        return $this->phone;
    }
    
    public function setPhone($phone){
        $this->phone = $phone;
    }
    
    public function getObjectVars(){
        return get_object_vars($this);
    }
}
?>