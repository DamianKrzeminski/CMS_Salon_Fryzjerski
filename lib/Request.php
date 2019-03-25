<?php
class Request implements RequestInterface{
    private $action;
    private $id;
    private $category_name;
    
    public function __construct(){
        $this->setAction();
        $this->setId();
        $this->setCategoryName();
    }
    
    public function setAction(){
        if(isset($_GET['action']) && !empty($_GET['action'])){
            $this->action = $_GET['action'];
        }
        return $this;
    }
    
    public function getAction(){
        if(!isset($this->action)){
            $this->setAction();
        }
        return $this->action;
    }
    
    public function setId(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $this->id = $_GET['id'];
        }
        return $this;
    }
    
    public function getId(){
        if(!isset($this->id)){
            $this->setId();
        }
        return $this->id;
    }
    
    public function setCategoryName(){
        if(isset($_GET['category_name']) && !empty($_GET['category_name'])){
            $this->category_name = $_GET['category_name'];
        }
        return $this;
    }
    
    public function getCategoryName(){
        if(!isset($this->category_name)){
            $this->setCategoryName();
        }
        return $this->category_name;
    }
    
    public function isPostSet(){
        if(isset($_POST) && !empty($_POST)){
            return true;
        }
        return false;
    }
    
    public function getPostModel(){
        if(!$this->isPostSet()){
            return false;
        }
        if(!isset($_POST)){
            return false;
        }
        if(empty($_POST)){
            return false;
        }
        return $_POST['model'];
    }
    
    public function getPost(){
        if($this->isPostSet()){
            return $_POST;
        }
    }
}
?>