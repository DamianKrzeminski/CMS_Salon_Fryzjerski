<?php
interface ProductModelInterface{
    public function getAll();
    public function getAllWithExactCategory($category);
    public function getOneById($id);
    public function save($post);
    public function delete($id);
}
?>