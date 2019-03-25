<?php
interface TemplateInterface{
    public function setAction($action);
    public function getAction();
    public function setElementId($element_id);
    public function getElementId();
    public function setCategoryName($category_name);
    public function getCategoryName();
    public function setModel($model);
    public function getModel($name);
    public function drawTemplate();
    public function getPageLabel();
}
?>