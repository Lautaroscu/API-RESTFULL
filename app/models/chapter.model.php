<?php
class ChapterModel
{
    //modelo de datos de la tabla "capitulos"

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;' . 'charset=utf8', 'root', '');
    }

    function AllQueryParams($sort = null, $order = null, $offset = null, $limit = null, $filter = null)
    {


        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' ORDER BY $sort $order LIMIT $offset , $limit");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function orderAndFilter($sort = null, $order = null, $filter = null)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' ORDER BY $sort $order");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function orderAndPagination($sort = null, $order = null, $offset = null, $limit = null)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY $sort $order LIMIT $offset , $limit");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function order($sort = null, $order = null)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY $sort $order");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function filter($filter = null)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter'");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }

    function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM capitulos ");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }

    function filterByField($field, $filter)
    {
        if (is_numeric($filter))
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE $field  = $filter");
        else
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE $field LIKE '%$filter%'");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function filterPagesByField($field, $filter, $offset, $limit)
    {
        if (is_numeric($filter))
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE $field = $filter  LIMIT $offset , $limit");
        else
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE $field LIKE '%$filter%' LIMIT $offset , $limit");

        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function filterPages($filter, $offset, $limit)
    {
        var_dump($filter);
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter'LIMIT $offset , $limit");

        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function pagination($limit, $offset)
    {

        $query = $this->db->prepare("SELECT * FROM capitulos  LIMIT $offset , $limit");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function filterChapters($id)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos INNER JOIN temporadas  WHERE capitulos.id_temp_fk = ? AND temporadas.id_temp = ?");
        $query->execute([$id, $id]);
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function get($id)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE id_capitulo = ?");
        $query->execute([$id]);
        $chapter = $query->fetch(PDO::FETCH_OBJ);
        return $chapter;
    }

}
