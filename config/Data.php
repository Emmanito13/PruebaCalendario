<?php

require "Conection.php";

class Data {
    public $cn ;

    function __construct()
    {
        $this->cn = Conection::conectionDB();
    }

    function listarEventos(){
        $query = "SELECT id, titulo as title, descripcion, inicio as start, fin as end, colortexto as txtColor, colorfondo as backgroundColor FROM eventos";
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
}


?>