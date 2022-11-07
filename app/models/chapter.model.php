<?php
class ChapterModel
{
    //modelo de datos de la tabla "capitulos"

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;' . 'charset=utf8', 'root', '');
    }
   
    function filter($id)
    {
        $query = $this->db->prepare("SELECT * FROM capitulos WHERE id_temp_fk = ?");
        $query->execute([$id]);
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
    function orderASC()
    {
        $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY id_capitulo ASC");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function orderDESC()
    {
        $query = $this->db->prepare("SELECT * FROM capitulos ORDER BY id_capitulo DESC");
        $query->execute();
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
    function pagination($id){
        $query = $this->db->prepare("SELECT * FROM capitulos LIMIT 0 , $id") ;
        $query->execute() ;
        return $query->fetchAll(PDO::FETCH_OBJ) ;

    }
    
}
