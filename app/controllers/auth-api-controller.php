<?php
require_once '../API-RESTFULL/app/models/user.model.php';
require_once '../API-RESTFULL/app/views/api.view.php' ;
class AuthApiController{
    private $chapter_model;
    private $api_view;
    private $data;
    private $authHelper;

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    function __construct()
    {
        $this->chapter_model = new ChapterModel() ;
        $this->api_view = new ApiView() ;
        $this->data = file_get_contents("php://input");
        $this->authHelper = new AuthHelper() ;
    }
    private function getData() {
        return json_decode($this->data);
    }
    function getToken($params = null){
        
    }
}