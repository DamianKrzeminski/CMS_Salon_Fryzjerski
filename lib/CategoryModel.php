<?php
class CategoryModel implements CategoryModelInterface{
    private $db;
    private $categories;
    private $categories_class;
    
    public function __construct(){
        $this->db = Database::getInstance();
    }
    
    public function getAllAssoc(){
        if(!isset($this->categories)){
            $this->categories = $this->db->getDb()->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->categories;
    }
    
    public function getAllClass(){
        if(!isset($this->categories_class)){
            $this->categories_class = $this->db->getDb()->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_CLASS, 'Category');
        }
        return $this->categories_class;
    }
    
    public function getOneById($id){
        if(!$id){
            return false;
        }
        $query = $this->db->getDb()->prepare("SELECT * FROM categories WHERE id=:id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Category')[0];
    }
    
    public function save($post){
        if($this->checkIfExactCategoryExist($post)){
            return false;
        }
        $category = $this->prepareCategory($post);
        return $this->db->save('categories', $category);
    }
    
    public function prepareCategory($post){
        $category = new Category();
        foreach($category->getObjectVars() as $varName=>$varValue){
            $method = 'set' . ucfirst($varName);
            if(method_exists($category, $method)){
                $category->$method($post[$varName]);
            }
        }
        return $category;
    }
    
    public function checkIfExactCategoryExist($post){
        $query = $this->db->getDb()->prepare("SELECT id FROM categories WHERE category=:category");
        $query->bindParam(':category', $post['category']);
        $query->execute();
        if($query->fetchAll()){
            return true;
        }else{
            return false;
        }
    }
    
    public function delete($id){
        $query = $this->db->getDb()->prepare("DELETE FROM categories WHERE id=:id");
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}
?>