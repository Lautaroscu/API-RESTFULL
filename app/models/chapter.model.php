<?php
class ChapterModel
{
//modelo de datos de la tabla "capitulos"

private $db;

function __construct()
{
    $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;' . 'charset=utf8', 'root', '');
}
function existeColumna()
{
    try {
        $query = $this->db->prepare("SHOW COLUMS FROM capitulos");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (\Throwable $th) {
        $resultado = [];
    }
    return $resultado;
}



function getAll($sort = null, $order = null, $page = null, $limit = null, $filter = null)
{
    if (isset($sort) &&  isset($order) && isset($page) && isset($limit) && isset($filter)) {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' ORDER BY $sort $order LIMIT $page , $limit");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    } else if (isset($sort) && isset($order) && isset($filter)) {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter' ORDER BY $sort $order");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    } else if (isset($sort) && isset($order) && isset($page) && isset($limit)) {
        $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY $sort $order LIMIT $page , $limit");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    } else if (isset($sort) && isset($order)) {
        $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY $sort $order");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    } else if (isset($filter)) {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE titulo_cap LIKE '%$filter%' OR descripcion LIKE '%$filter%' OR numero_cap LIKE '$filter'");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    } else {
        $query = $this->db->prepare("SELECT * FROM capitulos");
        $query->execute();
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
   
   
}
