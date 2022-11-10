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
    private $columns;
    private $order;
    function __construct()
    {
        $this->chapter_model = new ChapterModel();
        $this->api_view = new ApiView();
        $this->data = file_get_contents("php://input");
        $this->helper = new AuthHelper();
        $this->columns  = array(
            "id_capitulo",
            "titulo_cap",
            "descripcion",
            "numero_cap",
            "id_temp_fk",
        );
        $this->order = array(
            "asc",
            "desc"
        );
    }
    private function getData()
    {
        return json_decode($this->data);
    }
    function getAllChapters($params = null)
    {
        try {
            $chapters = $this->chapter_model->getAll();
            if ($chapters) {
                //si hay items en la tabla, entonces comenzamos a trabajar
                if (!empty($_GET['sort']) && !empty($_GET['order']) && isset($_GET['page']) &&  !empty($_GET['limit']) && !empty($_GET['filter'])) {
                    //ordena pagina y filtra en caso que el usuario setee todos estos parametros $_GET
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $page = $_GET['page'];
                    $limit = $_GET['limit'];
                    $filter = $_GET['filter'];
                    //verifica que la columna exista y el orden sea ASC o DESC
                    if (in_array($sort, $this->columns) && in_array($order, $this->order)) {
                        $chapters = $this->chapter_model->getAll($sort, $order, $page, $limit, $filter);
                        $this->api_view->response($chapters, 200, "Se ordenaron, paginaron y filtraron " . count($chapters) . "  capitulos con exito");
                    } else {
                        $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
                    }
                } else if (!empty($_GET['sort']) && !empty($_GET['order']) && !empty($_GET['filter'])) {
                    //ordena y filtra en caso que el usuario setee todos estos parametros
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $filter = $_GET['filter'];

                    //verifica que la columna exista y el orden sea ASC o DESC
                    if (in_array($order, $this->order) && in_array($sort, $this->columns)) {
                        $chapters = $this->chapter_model->getAll($sort, $order, null, null, $filter);
                        $this->api_view->response($chapters, 200, "Se ordenaron y filtraron " . count($chapters) . " capitulos con exito");
                    } else {
                        $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
                    }
                } else if (!empty($_GET['sort']) && !empty($_GET['order']) && isset($_GET['page']) && $_GET['limit']) {
                    //ordena ASC o DESC y pagina en caso que el usuario setee todos estos parametros
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $page = $_GET['page'];
                    $limit = $_GET['limit'];
                    if (in_array($order, $this->order) && in_array($sort, $this->columns)) {
                        $chapters = $this->chapter_model->getAll($sort, $order, $page, $limit);
                        $this->api_view->response($chapters, 200, "Se ordenaron y paginaron " . count($chapters) . " capitulos con exito");
                    } else {
                        $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
                    }
                } else if (!empty($_GET['sort']) && !empty($_GET['order'])) {
                    //ordena ASC o DESC en caso que el usuario setee estos parametros
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    if (in_array($order, $this->order) && in_array($sort, $this->columns)) {
                        $chapters = $this->chapter_model->getAll($sort, $order);
                        $this->api_view->response($chapters, 200, "se ordenaron " . count($chapters) . " capitulos con exito");
                    } else {
                        $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
                    }
                } else if (isset($_GET['filter']) && isset($_GET['field'])) {
                    //filtra por todos los campos de la tabla individualmente
                    $filter = $_GET['filter'];
                    $field = $_GET['field'];
                    if (in_array($field, $this->columns)) {
                        $chapters = $this->chapter_model->filterByField($field, $filter);

                        if ($chapters) {
                            $this->api_view->response($chapters, 200, "Se filtraron " . count($chapters) . " capitulos de la columna " . $field .  "  con exito");
                        } else {
                            $this->api_view->response("No se encontraron resultados ", 404);
                        }
                    } else {
                        $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
                    }
                } else if (isset($_GET['filter'])) {
                    //filtra por todos los campos de la tabla en caso que setee ese parametro

                    $filter = $_GET['filter'];
                    $chapters = $this->chapter_model->getAll(null, null, null, null, $filter, null);
                    if ($chapters) {
                        $this->api_view->response($chapters, 200, "Se filtraron " . count($chapters) . " capitulos con exito");
                    } else {
                        $this->api_view->response("No se encontraron resultados ", 404);
                    }
                } else {
                    $chapters = $this->chapter_model->getAll();
                    $this->api_view->response($chapters, 200, "Mostrando " . count($chapters) . " capitulos");
                }
            } else {
                $this->api_view->response("No se encontraron capitulos", 404);
            }
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }


    function getChapter($params = null)
    { //devuelve un unico item por ID
        try {
            $id = $params[':ID'];
            $chapter = $this->chapter_model->get($id);
            if ($chapter)
                $this->api_view->response($chapter);
            else
                $this->api_view->response("El capitulo con el id $id no existe!", 404);
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
    function deleteChapter($params = null)
    {
        //elimina un unico item por ID
        try {
            if (!$this->helper->isLogged()) {
                $this->api_view->response("No estas loggeado", 401);
                return;
            }
            $id = $params[':ID'];
            $chapter = $this->chapter_model->get($id);
            if ($chapter) {
                $this->chapter_model->delete($id);
                $this->api_view->response($chapter, 200, "Se elimino correctamente el capitulo con el id $id");
            } else
                $this->api_view->response("El capitulo con el id $id no existe!", 404);
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
    function insertChapter()
    {
        //inserta un unico item por body (getData()) 
        try {
        } catch (\Throwable) {
            $this->api_view->response("Error no encontrado", 500);
            if (!$this->helper->isLogged()) {
                $this->api_view->response("No estas loggeado", 401);
                return;
            }
            $chapter = $this->getData();
            if (empty($chapter->titulo_cap) || empty($chapter->descripcion) || empty($chapter->numero_cap) || empty($chapter->id_temp_fk)) {
                $this->api_view->response("Complete todos los datos", 400);
            } else {
                $id = $this->chapter_model->insert($chapter->titulo_cap, $chapter->descripcion, $chapter->numero_cap, $chapter->id_temp_fk);
                $chapter = $this->chapter_model->get($id);
                $this->api_view->response($chapter, 201, "Se agrego correctamente el capitulo con id $id");
            }
        }
    }

    function updateChapter($params = null)
    {
        //actualiza un unico item por body (getData())
        try {
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
            if (!$this->helper->isLogged()) {
                $this->api_view->response("No estas loggeado", 401);
                return;
            }
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
    function filterChapters($params = null)
    {
        //devuelve un arreglo de items dependiendo su temporada (id_fk) 
        try {
            $id_fk = $_GET['season'];

            $chapters = $this->chapter_model->filterChapters($id_fk);
            if ($chapters) {
                $this->api_view->response($chapters, 200, "Mostrando " . count($chapters) . " capitulos de la temporada $id_fk");
            }
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
}
