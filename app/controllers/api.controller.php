<?php
require_once "../app/models/chapter.model.php";
require_once "../app/views/api.view.php" ;
class ApiController {
    private $chapter_model;
    private $api_view;
    private $data;
    function __construct()
    {
        $this->chapter_model = new ChapterModel() ;
        $this->api_view = new ApiView() ;
        $this->data = file_get_contents("php://input");        
    }
    private function getData(){
        return json_decode($this->data) ;
    }
    function getAllChapters($params = null){
            $chapters = $this->chapter_model->getAll() ;
            $this->api_view->response($chapters) ;
    }
}