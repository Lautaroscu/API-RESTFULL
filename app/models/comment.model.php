<?php
class CommentModel {
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;' . 'charset=utf8', 'root', '');
    }
    function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario = ?");
        $query->execute([$id]);
    }
    function insert($comentario, $valoracion, $id_fk)
    {

         $query = $this->db->prepare("INSERT INTO comentarios(comentario , valoracion , id_capitulo_fk) VALUES (? , ? , ? )");
        $query->execute(array($comentario, $valoracion, $id_fk));
        return $this->db->lastInsertId();
         
    }
    function update($comentario, $valoracion,$id)
    {
        $query = $this->db->prepare("UPDATE comentarios SET comentario = ? , valoracion = ? WHERE id_comentario = ? ");
        $query->execute(array($comentario, $valoracion, $id));
    }
    function get($id)
    {
        $query = $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario = ?");
        $query->execute([$id]);
        $comment = $query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }

}