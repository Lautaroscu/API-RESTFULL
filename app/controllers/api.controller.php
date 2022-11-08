    <?php
    require_once '../API-RESTFULL/app/models/chapter.model.php';
    require_once '../API-RESTFULL/app/views/api.view.php';
    require_once '../API-RESTFULL/helpers/auth.helper.php';
    class ApiController
    {
        private $chapter_model;
        private $api_view;
        private $data;
        private $helper;
        function __construct()
        {
            $this->chapter_model = new ChapterModel();
            $this->api_view = new ApiView();
            $this->data = file_get_contents("php://input");
            $this->helper = new AuthHelper() ;
        }
        private function getData()
        {
            return json_decode($this->data);
        }
        function getAllChapters($params = null)
        {
            $chapters = $this->chapter_model->getAll();
            if ($chapters) {
                if (!empty($_GET['sort']) && !empty($_GET['order']) && isset($_GET['page']) &&  !empty($_GET['limit'])) {
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $page = $_GET['page'] ;
                    $limit = $_GET['limit'];
                    $chapters = $this->chapter_model->getAll($sort, $order, $page , $limit);
                    $this->api_view->response($chapters, 200, "se ordeno y pagino con exito");
                } else if (!empty($_GET['sort']) && !empty($_GET['order'])) {
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $chapters = $this->chapter_model->getAll($sort, $order);
                    $this->api_view->response($chapters, 200, "se ordeno con exito");
                } else if (!empty($_GET['filter'])) {

                    $filter = $_GET['filter'] ;
                    var_dump($filter) ;
                    $chapters = $this->chapter_model->getAll(null , null , null , $filter);
                    if ($chapters) {
                        $this->api_view->response($chapters, 200, "filtrado con exito");
                    } else {
                        $this->api_view->response("No se encontraron resultados ", 404);
                    }
                } else {
                    $chapters = $this->chapter_model->getAll();
                    $this->api_view->response($chapters, 200, "Mostrando " . count($chapters) .  " capitulos");
                }
            } else {
                $this->api_view->response("No se encontro ningun capitulo", 404);
            }
        }
        function getChapter($params = null)
        {
            $id = $params[':ID'];
            $chapter = $this->chapter_model->get($id);
            if ($chapter)
                $this->api_view->response($chapter);
            else
                $this->api_view->response("El capitulo con el id $id no existe!", 404);
        }
        function deleteChapter($params = null)
        {
            if(!$this->helper->isLogged()){
                $this->api_view->response("No estas loggeado" , 401);
            }
            $id = $params[':ID'];
            $chapter = $this->chapter_model->get($id);
            if ($chapter) {
                $this->chapter_model->delete($id);
                $this->api_view->response($chapter, 200, "Se elimino correctamente el capitulo con el id $id");
            } else
                $this->api_view->response("El capitulo con el id $id no existe!", 404);
        }
        function insertChapter()
        {
            $chapter = $this->getData();
            if (empty($chapter->titulo_cap) || empty($chapter->descripcion) || empty($chapter->numero_cap) || empty($chapter->id_temp_fk)) {
                $this->api_view->response("Complete todos los datos", 400);
            } else {
                $id = $this->chapter_model->insert($chapter->titulo_cap, $chapter->descripcion, $chapter->numero_cap, $chapter->id_temp_fk);
                $chapter = $this->chapter_model->get($id);
                $this->api_view->response($chapter, 201,"Se agrego correctamente el capitulo con id $id");
            }
        }

        function updateChapter($params = null)
        {
            $id = $params[':ID'];
            $body = $this->getData();
            if (empty($body->titulo_cap) || empty($body->descripcion)) {
                $this->api_view->response("Complete todos los datos", 400);
            } else {
                $this->chapter_model->update($body->titulo_cap, $body->descripcion, $id);
                $this->api_view->response($body, 201, "Se actualizo correctamente el capitulo con id $id");
            }
        }
    }
