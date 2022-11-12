<?php
class ChapterModel
{
    //modelo de datos de la tabla "capitulos"

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;' . 'charset=utf8', 'root', '');
    }



    function getAll($sort = null, $order = null, $page = null, $limit = null, $filter = null,)
    {
        if (isset($sort) &&  isset($order) && isset($page) && isset($limit) && isset($filter)) {
            $offset = (($page - 1) * $limit);

            $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' ORDER BY $sort $order LIMIT $offset , $limit");
            $query->execute();
            $chapters = $query->fetchAll(PDO::FETCH_OBJ);
            return $chapters;
        } else if (isset($sort) && isset($order) && isset($filter)) {
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' ORDER BY $sort $order");
            $query->execute();
            $chapters = $query->fetchAll(PDO::FETCH_OBJ);
            return $chapters;
        } else if (isset($sort) && isset($order) && isset($page) && isset($limit)) {
            $offset = (($page - 1) * $limit);

            $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY $sort $order LIMIT $offset , $limit");
            $query->execute();
            $chapters = $query->fetchAll(PDO::FETCH_OBJ);
            return $chapters;
        } else if (isset($sort) && isset($order)) {
            $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY $sort $order");
            $query->execute();
            $chapters = $query->fetchAll(PDO::FETCH_OBJ);
            return $chapters;
        } else if (isset($filter)) {
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE id_capitulo = $filter OR titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' OR id_temp_fk = $filter");
            $query->execute();
            $chapters = $query->fetchAll(PDO::FETCH_OBJ);
            return $chapters;
        } else {
            $query = $this->db->prepare("SELECT * FROM capitulos");
            $query->execute();
            $chapters = $query->fetchAll(PDO::FETCH_OBJ);
            return $chapters;
        }
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
    function filterPagesByField($field, $filter, $page, $limit)
    {
        $offset = (($page - 1) * $limit);
        if (is_numeric($filter))
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE $field = $filter  LIMIT $offset , $limit");
        else
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE $field LIKE '%$filter%' LIMIT $offset , $limit");

        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function filterPages($filter, $page, $limit)
    {
        $offset = (($page - 1) * $limit);
        if (is_numeric($filter)) 
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE id_capitulo = $filter OR titulo_cap = $filter OR descripcion LIKE '%$filter%' OR numero_cap = $filter OR id_temp_fk = $filter LIMIT $offset , $limit");
         else 
            $query = $this->db->prepare("SELECT * FROM capitulos WHERE id_capitulo LIKE $filter OR titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE $filter OR id_temp_fk LIKE $filter LIMIT $offset , $limit");
        
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
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
    function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM capitulos WHERE id_capitulo = ?");
        $query->execute([$id]);
    }
    function insert($title, $description, $numero_cap, $season)
    {
        $query = $this->db->prepare("INSERT INTO capitulos(titulo_cap , descripcion , numero_cap , id_temp_fk) VALUES (? , ? , ? , ?)");
        $query->execute(array($title, $description, $numero_cap, $season));
        return $this->db->lastInsertId();
    }
    function update($title, $description, $id)
    {
        $query = $this->db->prepare("UPDATE capitulos SET titulo_cap = ? , descripcion = ? WHERE id_capitulo = ? ");
        $query->execute(array($title, $description, $id));
    }
    function pagination($page, $limit)
    {
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $offset = (($page - 1) * $limit);

        $query = $this->db->prepare("SELECT * FROM capitulos  LIMIT $offset , $limit");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
