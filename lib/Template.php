<?php
class Template implements TemplateInterface{
    private $action;
    private $elemany_id;
    private $category_name;
    private $model;
    
    public function drawTemplate(){
        $this->includeTemplateByAction($this->action);
    }
    
    public function includeTemplateByAction($action){
        switch($action){
            case (''):
            case('home'):
                include_once('template/home.phtml');
                break;
            case ('client_list'):
            case ('delete_client'):
                include_once('template/client_list.phtml');
                break;
            case ('add_client'):
            case ('edit_client'):
                include_once('template/add_edit_client.phtml');
                break;
            case ('visit_list'):
            case ('delete_visit'):
                include_once('template/visit_list.phtml');
                break;
            case ('add_visit'):
            case ('edit_visit'):
                include_once('template/add_edit_visit.phtml');
                break;
            case ('product_list'):
            case ('delete_product'):
                include_once('template/product_list.phtml');
                break;
            case ('add_product'):
            case ('edit_product'):
                include_once('template/add_edit_product.phtml');
                break;
            case ('category_list'):
            case ('delete_category'):
                include_once('template/category_list.phtml');
                break;
            case ('add_category'):
            case ('edit_category'):
                include_once('template/add_edit_category.phtml');
                break;
            default:
                include_once('');
                break;
        }
    }
    
    public function getPageLabel(){
        switch($this->action){
            case (''):
                $label = 'Home';
                break;
            case ('client_list'):
            case ('delete_client'):
                $label = 'Lista Klientów';
                break;
            case ('add_client'):
                $label = 'Dodaj Klienta';
                break;
            case ('edit_client'):
                $label = 'Edytuj Klienta';
                break;
            case ('visit_list'):
            case ('delete_visit'):
                $label = 'Lista Wizyt';
                break;
            case ('add_visit'):
                $label = 'Dodaj Wizytę';
                break;
            case ('edit_visit'):
                $label = 'Edytuj Wizytę';
                break;
            case ('product_list'):
            case ('delete_product'):
                $label = 'Lista Produktów';
                break;
            case ('add_product'):
                $label = 'Dodaj Produkt';
                break;
            case ('edit_product'):
                $label = 'Edytuj Produkt';
                break;
            case ('category_list'):
            case ('delete_category'):
                $label = 'Lista Kategorii';
                break;
            case ('add_category'):
                $label = 'Dodaj Kategorię';
                break;
            case ('edit_category'):
                $label = 'Edytuj Kategorię';
                break;
            default:
                $label = htmlspecialchars($this->action);
                break;
        }
        return $label;
    }
    
    public function setAction($action){
        $this->action = $action;
        return $this;
    }
    
    public function getAction(){
        return $this->action;
    }
    
    public function setElementId($element_id){
        $this->element_id = $element_id;
        return $this;
    }
    
    public function getElementId(){
        return $this->element_id;
    }
    
    public function setCategoryName($category_name){
        $this->category_name = $category_name;
        return $this;
    }
    
    public function getCategoryName(){
        return $this->category_name;
    }
    
    public function setModel($model){
        $this->model = $model;
        return $this;
    }
    
    public function getModel($name){
        if(!isset($this->model[$name])){
            return false;
        }
        return $this->model[$name];
    }
}
?>