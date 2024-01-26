<?php
class ClientModel implements ModelInterface{
    private $db;
    private $clients;
    
    public function __construct(){
        $this->db = Database::getInstance();
    }
     
    public function getAll() {
        if(!isset($this->clients)){
            $this->clients = $this->db->getDb()->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->clients;
    }
    
    public function getOneById($id){
        if(!$id){
            return false;
        }
        $query = $this->db->getDb()->prepare("SELECT * FROM clients WHERE id=:id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Client')[0];
    }
    
    public function save($post){
        if($this->checkIfExactClientExists($post)){
            return false;
        }
        
        $client = $this->prepareClient($post);
        return $this->db->save('clients', $client);
    }
    
    public function prepareClient($post){
        $client = new Client();
        foreach($client->getObjectVars() as $varName => $varValue){
            $method = "set" . ucfirst($varName);
            if(method_exists($client, $method)){
                $client->$method($post[$varName]);
            }
        }
        return $client;
    }
    
    public function checkIfExactClientExists($post){
        $query = $this->db->getDb()->prepare("SELECT id FROM clients WHERE firstname=:firstname AND lastname=:lastname AND phone=:phone");
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
        return $query;
    }
    
    public function delete($id){
        $query = $this->db->getDb()->prepare("DELETE FROM clients WHERE id=:id");
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}
?>