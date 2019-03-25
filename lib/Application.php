<?php
class Application implements ApplicationInterface{
    private $request;
    private $template;
    private $model = array();
    
    public function __construct(){
        $this->setRequest(new Request());
        $this->setTemplate(new Template());
        $this->setModel('clients', new ClientModel());
        $this->setModel('visits', new VisitModel());
        $this->setModel('products', new ProductModel());
        $this->setModel('categories', new CategoryModel());
    }
    
    public function start(){
        $this->handlePost();
        $this->handleGet();
    }
    
    public function handlePost(){
        if($this->request->isPostSet()){
            switch($this->request->getPostModel()){
                case 'clients':
                    $this->model['clients']->save($this->request->getPost());
                    break;
                case 'visits':
                    $this->model['visits']->save($this->request->getPost());
                    break;
                case 'products':
                    $this->model['products']->save($this->request->getPost());
                    break;
                case 'categories':
                    $this->model['categories']->save($this->request->getPost());
                    break;
            }
        }
    }
    
     public function handleGet(){
        switch ($this->request->getAction()){
            case 'delete_client':
                $this->model['clients']->delete($this->request->getId());
            case 'delete_visit':
                $this->model['visits']->delete($this->request->getId());
            case 'delete_product':
                $this->model['products']->delete($this->request->getId());
            case 'delete_category':
                $this->model['categories']->delete($this->request->getId());
            default:
                $this->template->setModel($this->model);
                $this->template->setAction($this->request->getAction());
                $this->template->setElementId($this->request->getId());
                $this->template->setCategoryName($this->request->getCategoryName());
                $this->template->drawTemplate();
                break;
        }
    }
    
    public function setRequest(Request $request){
        if(!isset($this->request)){
            $this->request = $request;
        }
        return $this;
    }
    
    public function getRequest(){
        return $this->request;
    }
    
    public function setModel($name, $model){
        if(!isset($this->model[$name])){
            $this->model[$name] = $model;
        }
        return $this;
    }
    
    public function getModel(){
        return $this->model;
    }
    
    public function setTemplate(Template $template){
        if(!isset($this->template)){
            $this->template = new Template;
        }
        return $this;
    }
    
    public function getTemplate(){
        return $this->template;
    }
}
?>