<?php
class VisitModel implements ModelInterface{
    private $db;
    private $visits;
    
    public function __construct(){
        $this->db = Database::getInstance();
    }
    
    public function getAll(){
        if(!isset($this->visits)){
            $this->visits = $this->db->getDb()->query("SELECT * FROM visit")->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->visits;
    }
    
    public function getOneById($id){
        if(!$id){
            return false;
        }
        $query = $this->db->getDb()->prepare("SELECT * FROM visit WHERE id=:id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Visit')[0];
    }
    
    public function save($post){
        if($this->checkIfExactVisitExists($post)){
            return false;
        }
        $visit = $this->prepareVisit($post);
        return $this->db->save('visit', $visit);
    }
    
    public function prepareVisit($post){
        $visit = new Visit();
        foreach($visit->getObjectVars() as $varName=>$varValue){
            $method = 'set' . ucfirst($varName);
            if(method_exists($visit, $method)){
                $visit->$method($post[$varName]);
            }
        }
        return $visit;
    }
    
    public function checkIfExactVisitExists($post){
        $query = $this->db->getDb()->prepare("SELECT id FROM visit WHERE firstname=:firstname AND lastname=:lastname AND phone=:phone AND vdate=:vdate AND vtime=:vtime AND price=:price AND note=:note");
        $query = $this->bindParams($query, $post);
        $query->execute();
        if($query->fetchAll()){
            return true;
        }else{
            return false;
        }
    }
    
    public function bindParams($query, $post){
        $query->bindParam(':firstname', $post['firstname']);
        $query->bindParam(':lastname', $post['lastname']);
        $query->bindParam(':phone', $post['phone']);
        $query->bindParam(':vdate', $post['vdate']);
        $query->bindParam(':vtime', $post['vtime']);
        $query->bindParam(':price', $post['price']);
        $query->bindParam(':note', $post['note']);
        return $query;
    }
    
    public function delete($id){
        $query = $this->db->getDb()->prepare("DELETE FROM visit WHERE id=:id");
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}
?>