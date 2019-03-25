<?php
interface ApplicationInterface{
    public function start();
    public function handlePost();
    public function handleGet();
    public function setRequest(Request $request);
    public function getRequest();
    public function setModel($name, $model);
    public function getModel();
    public function setTemplate(Template $template);
    public function getTemplate();
}
?>