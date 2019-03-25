<?php
class Visit{
    private $id;
    private $firstname;
    private $lastname;
    private $phone;
    private $vdate;
    private $vtime;
    private $price;
    private $note;
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    
    public function getFirstname(){
        return $this->firstname;
    }
    
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    
    public function getLastname(){
        return $this->lastname;
    }
    
    public function setPhone($phone){
        $this->phone = $phone;
    }
    
    public function getPhone(){
        return $this->phone;
    }
    
    public function setVdate($vdate){
        $this->vdate = $vdate;
    }
    
    public function getVdate(){
        return $this->vdate;
    }
    
    public function setVtime($vtime){
        $this->vtime = $vtime;
    }
    
    public function getVtime(){
        return $this->vtime;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function setNote($note){
        $this->note = $note;
    }
    
    public function getNote(){
        return $this->note;
    }
    
    public function getObjectVars(){
        return get_object_vars($this);
    }
}
?>