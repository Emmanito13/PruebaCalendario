<?php

require "Conection.php";

class Data {
    public $cn ;

    function __construct()
    {
        $this->cn = Conection::conectionDB();
    }

    function listarEventos(){
        $query = "SELECT id, titulo as title, descripcion, inicio as start, fin as end, colortexto as textColor, colorfondo as backgroundColor FROM eventos";
        $result = $this->cn->prepare($query);
        if($result->execute()){
            while($fila = $result->fetch(PDO::FETCH_ASSOC)){
                $datos[] = $fila;
            }
            return $datos;
        }else{
            return $datos = [];
        }
    }

    function listarEventosPredefinidos(){
        $query = "SELECT id, titulo , horainicio, horafin, colortexto,  colorfondo FROM eventospredef";
        $result = $this->cn->prepare($query);
        if($result->execute()){
            while($fila = $result->fetch(PDO::FETCH_ASSOC)){
                $datos[] = $fila;
            }
            return $datos;
        }else{
            return $datos = [];
        }
    }

    function agregarEvento($titulo,$descripcion,$inicio,$fin,$colortexto,$colorfondo){
        $query = "INSERT INTO eventos(titulo,descripcion,inicio,fin,colortexto,colorfondo) VALUES (?,?,?,?,?,?)";
        $result = $this->cn->prepare($query);
        $result->bindParam(1, $titulo);
        $result->bindParam(2, $descripcion);
        $result->bindParam(3, $inicio);
        $result->bindParam(4, $fin);
        $result->bindParam(5, $colortexto);
        $result->bindParam(6, $colorfondo);
        if($result->execute()){
            return true;
        }else{
            return false;
        }
    }

    function editarEvento($id,$titulo,$descripcion,$inicio,$fin,$colortexto,$colorfondo){
        $query = "UPDATE eventos SET titulo = ?,descripcion = ?,inicio = ?,fin = ?,colortexto = ?,colorfondo = ? WHERE id = ?";
        $result = $this->cn->prepare($query);
        $result->bindParam(1, $titulo);
        $result->bindParam(2, $descripcion);
        $result->bindParam(3, $inicio);
        $result->bindParam(4, $fin);
        $result->bindParam(5, $colortexto);
        $result->bindParam(6, $colorfondo);
        $result->bindParam(7, $id);

        if($result->execute()){
            return true;
        }else{
            return false;
        }
    }

    function borrarEvento($id){
        $query = "DELETE FROM eventos WHERE id = ?";
        $result = $this->cn->prepare($query);
        $result->bindParam(1, $id);

        if($result->execute()){
            return true;
        }else{
            return false;
        }
    }
}


?>