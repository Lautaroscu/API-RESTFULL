<?php
class ChapterModel
{
    //modelo de datos de la tabla "capitulos"

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;' . 'charset=utf8', 'root', '');
    }
    function getAll(){
        $query = $this->db->prepare("SELECT * FROM capitulos") ;
        $query->execute() ;
       $chapters = $query->fetchAll(PDO::FETCH_OBJ) ;
       return $chapters ;
    }
}