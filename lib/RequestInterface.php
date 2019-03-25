<?php
interface RequestInterface{
    public function setAction();
    public function getAction();
    public function setId();
    public function getId();
    public function setCategoryName();
    public function getCategoryName();
    public function isPostSet();
    public function getPostModel();
    public function getPost();
}
?>