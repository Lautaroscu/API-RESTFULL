<?php 
require_once '../API-RESTFULL/app/models/comment.model.php' ;
require_once '../API-RESTFULL/app/views/api.view.php' ;
require_once '../API-RESTFULL/helpers/auth.helper.php' ;
class CommentsController {
private $comment_model ;
private $api_view;
private $helper;
private $data;

function __construct()
{
    $this->comment_model = new CommentModel() ;
    $this->api_view = new ApiView() ;
    $this->helper = new AuthHelper() ;
    $this->data = file_get_contents("php://input");

}

    private function getData()
    {
        return json_decode($this->data);
    }
    function insertComment()
    {
        //inserta un unico item por body (getData()) 
        try {
            if (!$this->helper->isLogged()) {
                $this->api_view->response("No estas loggeado", 401);
                return; 
            }
            $comment = $this->getData();
            if(empty($comment->comentario) || empty($comment->valoracion) || empty($comment->id_capitulo_fk)){
                $this->api_view->response("Complete todos los datos" , 400) ;
            }
            else{

                $id = $this->comment_model->insert($comment->comentario , $comment->valoracion , $comment->id_capitulo_fk) ;

                if($id){
                    $this->api_view->response($comment , 201 , "Se agrego con exito el comentario con el id $id");
                }
            }
        } catch (\Throwable) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }

    function updateComment($params = null)
    {
        //actualiza un unico item por body (getData())
        try {
            if (!$this->helper->isLogged()) {
                $this->api_view->response("No estas loggeado", 401);
                return;
            }
            $id = $params[':ID'];
            $body = $this->getData();
            if (empty($body->comentario) || empty($body->valoracion) ) {
                $this->api_view->response("Complete todos los datos", 400);
            } else {
                $this->comment_model->update($body->comentario, $body->valoracion,$id);
                $this->api_view->response($body, 201, "Se actualizo correctamente el comentario con id $id");
            }
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
    function deleteComment($params = null)
    {
        //elimina un unico item por ID
        try {
            if (!$this->helper->isLogged()) {
                $this->api_view->response("No estas loggeado", 401);
                return;
            }
            $id = $params[':ID'];
            $comment = $this->comment_model->get($id);
            if ($comment) {
                $this->comment_model->delete($id);
                $this->api_view->response($comment, 200, "Se elimino correctamente el capitulo con el id $id");
            } else
                $this->api_view->response("El capitulo con el id $id no existe!", 404);
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
    function getComment($params = null)
    { //devuelve un unico item por ID
        try {
            $id = $params[':ID'];
            $comment = $this->comment_model->get($id);
            if ($comment)
                $this->api_view->response($comment);
            else
                $this->api_view->response("El comentario con el id $id no existe!", 404);
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
}