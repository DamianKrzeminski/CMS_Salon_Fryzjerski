<?php
class ProductModel implements ProductModelInterface{
    private $db;
    private $products;
    private $cat_products;
    
    public function __construct(){
        $this->db = Database::getInstance();
    }
    
    public function getAll(){
        if(!isset($this->products)){
            $this->products = $this->db->getDb()->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->products;
    }
    
    public function getAllWithExactCategory($category){
        if(empty($category) || $category == 'all'){
            return false;
        }
        $query = $this->db->getDb()->prepare("SELECT * FROM products WHERE category=:category");
        $query->bindParam(':category', $category);
        $query->execute();
        if(!isset($this->cat_products)){
            $this->cat_products = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->cat_products;
    }
    
    public function getOneById($id){
        if(!$id){
            return false;
        }
        $query = $this->db->getDb()->prepare("SELECT * FROM products WHERE id=:id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Product')[0];
    }
    
    public function save($post){
        if($this->checkIfExactProductExist($post)){
            return false;
        }
        $product = $this->prepareProduct($post);
        return $this->db->save('products', $product);
    }
    
    public function prepareProduct($post){
        $product = new Product();
        foreach($product->getObjectVars() as $varName=>$varValue){
            $method = 'set' . ucfirst($varName);
            if(method_exists($product, $method)){
                $product->$method($post[$varName]);
            }
        }
        return $product;
    }
    
    public function checkIfExactProductExist($post){
        $query = $this->db->getDb()->prepare("SELECT id FROM products WHERE name=:name AND quantity=:quantity AND category=:category");
        $query = $this->bindParams($post, $query);
        $query->execute();
        if($query->fetchAll()){
            return true;
        }else{
            return false;
        }
    }
    
    public function bindParams($post, $query){
        $query->bindParam(':name', $post['name']);
        $query->bindParam(':quantity', $post['quantity']);
        $query->bindParam(':category', $post['category']);
        return $query;
    }
    
    public function delete($id){
        $query = $this->db->getDb()->prepare("DELETE FROM products WHERE id=:id");
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}
?>