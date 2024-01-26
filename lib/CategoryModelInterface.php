<?php
interface CategoryModelInterface{
    public function getAllAssoc();
    public function getAllClass();
    public function getOneById($id);
    public function save($post);
    public function delete($id);
}
?>