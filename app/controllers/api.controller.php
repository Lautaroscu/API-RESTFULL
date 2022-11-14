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
    private $sort;
    private $type;
    private $page;
    private $limit;
    private $filter;

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

        $this->sort = isset($_GET['sort']) ? $this->sort = $_GET['sort'] : null;
        $this->type = isset($_GET['order']) ? $this->type = $_GET['order'] : null;
        $this->page = isset($_GET['page']) ? $this->page = $_GET['page'] : null;
        $this->limit = isset($_GET['limit']) ? $this->limit = $_GET['limit'] : null;
        $this->filter = isset($_GET['filter']) ? $this->filter = $_GET['filter'] : null;
    }

    private function getData()
    {
        return json_decode($this->data);
    }
    private function fieldExist()
    {
        if (in_array($this->sort, $this->columns)) {
            return true;
        } else {
            return false;
        }
    }
    private function orderExist()
    {
        if (in_array($this->type, $this->order)) {
            return true;
        } else {
            return false;
        }
    }

    private function maxLimit()
    {
        $countRows = count($this->chapter_model->getAll());
        $total_pages = ($countRows / $this->limit);
        $offset = (($this->page - 1) * $this->limit);
        if ($offset > $total_pages)
            return true;
        else
            return false;
    }
    private function are_numerics()
    {
        if (is_numeric($this->page) && is_numeric($this->limit))
            return true;
        else
            return false;
    }


    function getAllQueryParams($params = null)
    {
        try {
            $chapters = $this->chapter_model->getAll();
            if ($chapters) {
                //si hay items en la tabla, entonces comenzamos a trabajar
                if (!empty($this->sort) && !empty($this->type) && isset($this->page) &&  !empty($this->limit) && !empty($this->filter)) {

                    //ordena pagina y filtra en caso que el usuario setee todos estos parametros $_GET
                    $this->Allquerys();
                } else if (!empty($this->sort) && !empty($this->type) && !empty($this->filter)) {
                    //ordena y filtra en caso que el usuario setee todos estos parametros
                    $this->orderAndFilter();
                } else if (!empty($this->sort) && !empty($this->type) && isset($this->page) && !empty($this->limit)) {
                    //ordena ASC o DESC y pagina en caso que el usuario setee todos estos parametros
                    $this->orderAndPagination();
                } else if (!empty($this->sort) && !empty($this->type)) {
                    //ordena ASC o DESC en caso que el usuario setee estos parametros
                    $this->order();
                } else if (!empty($this->sort) && !empty($this->filter) && !empty($this->page) && !empty($this->limit)) {
                    //filtra por todos los campos individualmente y pagina
                    $this->filterAndPaginationByField();
                } else if (!empty($this->filter) && !empty($this->page) && !empty($this->limit)) {
                    //filtra por todos los campos y pagina
                    $this->filterAndpagination();
                } else if (!empty($this->filter) && !empty($this->sort)) {
                    //filtra por todos los campos de la tabla individualmente
                    $this->filterByField();
                } else if (!empty($this->page) && !empty($this->limit)) {
                    //pagina una coleccion entera
                    $this->pagination();
                } else if (!empty($this->filter)) {
                    //filtra por todos los campos de la tabla en caso que setee ese parametro
                    $this->filterAll();
                } else {
                    $this->getAll();
                }
            } else {
                $this->api_view->response("No se encontraron capitulos", 404);
            }
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }
    function Allquerys()
    {
        if ($this->fieldExist() && $this->orderExist() && !$this->maxLimit()) {
            $offset = (($this->page - 1) * $this->limit);
            $chapters = $this->chapter_model->AllQueryParams($this->sort, $this->type, $offset, $this->limit, $this->filter);
            $this->api_view->response($chapters, 200, "Se ordenaron, paginaron y filtraron " . count($chapters) . "  capitulos con exito");
        } else {
            $this->api_view->response("No se pudo realizar la consulta", 404);
        }
    }
    function orderAndFilter()
    {
        if ($this->orderExist() && $this->fieldExist()) {
            $chapters = $this->chapter_model->orderAndFilter($this->sort, $this->type, $this->filter);
            $this->api_view->response($chapters, 200, "Se ordenaron y filtraron " . count($chapters) . " capitulos con exito");
        } else {
            $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
        }
    }
    function orderAndPagination()
    {
        if ($this->orderExist() && $this->fieldExist() && $this->are_numerics()) {
            $offset = (($this->page - 1) * $this->limit);
            $chapters = $this->chapter_model->orderAndPagination($this->sort, $this->type, $offset, $this->limit);
            if ($this->maxLimit() || !$chapters) {
                $this->api_view->response("Limite de paginas excedido");
            } else {
                $this->api_view->response($chapters, 200, "Se ordenaron y paginaron " . count($chapters) . " capitulos con exito");
            }
        } else {
            $this->api_view->response("No se pudo ordernar y paginar", 400);
        }
    }
    function order()
    {

        if (($this->orderExist()) && ($this->fieldExist())) {
            $chapters = $this->chapter_model->order($this->sort, $this->type);
            $this->api_view->response($chapters, 200, "se ordenaron " . count($chapters) . " capitulos con exito");
        } else {
            $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
        }
    }
    function filterAndPaginationByField()
    {

        if ($this->are_numerics()) {
            $offset = (($this->page - 1) * $this->limit);
            $chapters = $this->chapter_model->filterPagesByField($this->sort, $this->filter, $offset, $this->limit);
            if (!$chapters || $this->maxLimit()) {
                $this->api_view->response("No se pudo filtrar por el campo " . $this->sort . " y paginar (Limite excedido)", 404);
            } else
                $this->api_view->response($chapters, 200, "Se filtro por el campo " . $this->sort . " y pagino con exito");
        } else
            $this->api_view->response("Page y Limit deben ser numericos", 400);
    }

    function filterAndpagination()
    {
        if ($this->are_numerics()) {
            $offset = (($this->page - 1) * $this->limit);

            $chapters = $this->chapter_model->filterPages($this->filter, $offset, $this->limit);
            if (!$chapters || $this->maxLimit()) {
                $this->api_view->response("No se pudo filtrar y paginar", 404);
            } else
                $this->api_view->response($chapters, 200, "Se filtro por todos los campos y pagino con exito");
        } else
            $this->api_view->response("Page y Limit deben ser numericos", 400);
    }
    function filterByField()
    {
        if ($this->fieldExist()) {
            $chapters = $this->chapter_model->filterByField($this->sort, $this->filter);

            if ($chapters) {
                $this->api_view->response($chapters, 200, "Se filtraron " . count($chapters) . " capitulos de la columna " . $this->sort .  "  con exito");
            } else {
                $this->api_view->response("No se encontraron resultados ", 404);
            }
        } else {
            $this->api_view->response("Columna desconocida u orden distinto de ASC/DESC", 404);
        }
    }
    function pagination()
    {
        $offset = (($this->page - 1) * $this->limit);
        $chapters = $this->chapter_model->pagination($this->limit, $offset);
        if (!$chapters || $this->maxLimit()) {
            $this->api_view->response("No se pudo paginar ningun capitulo", 404);
        } else {
            $this->api_view->response($chapters, 200, "Mostrando " . count($chapters) . " capitulos");
        }
    }
    function filterAll()
    {
        $chapters = $this->chapter_model->filter($this->filter);
        if ($chapters) {
            $this->api_view->response($chapters, 200, "Se filtraron " . count($chapters) . " capitulos con exito");
        } else {
            $this->api_view->response("No se encontraron resultados ", 404);
        }
    }
    function getAll()
    {
        $chapters = $this->chapter_model->getAll();
        $this->api_view->response($chapters, 200, "Mostrando " . count($chapters) . " capitulos");
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
        } catch (\Throwable) {
            $this->api_view->response("Error no encontrado", 500);
        }
    }

    function updateChapter($params = null)
    {
        //actualiza un unico item por body (getData())
        try {
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
        } catch (\Throwable $th) {
            $this->api_view->response("Error no encontrado", 500);
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
