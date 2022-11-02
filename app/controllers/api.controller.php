    <?php
    require_once '../API-RESTFULL/app/models/chapter.model.php';
    require_once '../API-RESTFULL/app/views/api.view.php';
    class ApiController
    {
    private $chapter_model;
    private $api_view;
    private $data;
    function __construct()
    {
    $this->chapter_model = new ChapterModel();
    $this->api_view = new ApiView();
    $this->data = file_get_contents("php://input");
    }
    private function getData()
    {
    return json_decode($this->data);
    }
    function getAllChapters($params = null)
    {
    $chapters = $this->chapter_model->getAll();
    if($chapters){
        $this->api_view->response($chapters , 200 , "Mostrando " . count($chapters) .  " capitulos");
    }
    else{
            $this->api_view->response("No se encontro ningun capitulo" , 404);
    }
    }
    function getChapter($params = null)
    {
    $id = $params[':ID'];
    $chapter = $this->chapter_model->get($id);
    if ($chapter)
        $this->api_view->response($chapter) ;
    else
        $this->api_view->response("El capitulo con el id $id no existe!" , 404);
    }
    function deleteChapter($params = null){
    $id = $params[':ID'] ;
    $chapter = $this->chapter_model->get($id) ;
    if($chapter){
        $this->chapter_model->delete($id) ;
        $this->api_view->response($chapter , 200 ,"Se elimino correctamente el capitulo con el id $id")  ;
    }
    else
    $this->api_view->response("El capitulo con el id $id no existe!" , 404) ;
    }
    function insertChapter(){
    $chapter = $this->getData() ;
    if(empty($chapter->titulo_cap) || empty($chapter->descripcion) || empty($chapter->numero_cap) || empty($chapter->id_temp_fk)){
        $this->api_view->response("Complete todos los datos" , 400) ;
    }
    else{
        $id = $this->chapter_model->insert($chapter->titulo_cap , $chapter->descripcion , $chapter->numero_cap , $chapter->id_temp_fk) ;
        $chapter = $this->chapter_model->get($id) ;
        $this->api_view->response($chapter ,"Se agrego correctamente el capitulo con id $id" , 201) ;
    }
    }
    function updateChapter($params = null){
        $id = $params[':ID'] ;
        $body = $this->getData() ;
        $chapter = $this->chapter_model->get($id) ;

        if(empty($body->titulo_cap) || empty($body->descripcion) ){
            $this->api_view->response("Complete todos los datos" , 400) ;
        }
        else{
            $this->chapter_model->update($body->titulo_cap , $body->descripcion , $id);
            $this->api_view->response($chapter , "Se actualizo correctamente el capitulo con id $id", 201) ;
        
        }
          
    }
    function filterChapters($params = null) {
        $id = $params[':ID'] ;
        $chapters = $this->chapter_model->filter($id) ;
        if(!$chapters){
            $this->api_view->response("No hay capitulos pertenecientes a la temporada $id" , 404) ;
        }
        else{
            $this->api_view->response($chapters) ;
        }
    }
    function orderById($params = null) {
        $order = $params[':ORDER'] ;
      $order = $this->chapter_model->orderById($order) ;
      if($order){
              $this->api_view->response($order) ;
      }
    
     
    }
   
    function page($params = null){
        $max = $params[':?'] ;
        $chapters = $this->chapter_model->pagination($max) ;
        if($chapters){
            $this->api_view->response($chapters) ;
        }
        else{
            $this->api_view->response("No hay capitulos") ;

        }
        
    }
    function order($params = null) {
        $field = $params[':FIELD'];
        $order = $params[':ORDERBY'] ;
        $chapters = $this->chapter_model->order($field , $order) ;
        var_dump($field , $order) ;
        if($chapters)
        $this->api_view->response($chapters , 200 , "se ordeno con exito") ;
        else{
            $this->api_view->response("No hay una columna con ese nombre") ;

        }
    }
  
    }

    

    
