<?php
class Product{
    private $id;
    private $name;
    private $quantity;
    private $category;
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function setCategory($category){
        $this->category = $category;
    }
    
    public function getCategory(){
        return $this->category;
    }
    
    public function getObjectVars(){
        return get_object_vars($this);
    }
}
?>