<?php
    class Conection{

        static function conectionDB(){
            try {                
                require "Global.php";

                $conection = new PDO(DNS,USERNAME,PASSWORD);

                return $conection;

            } catch (PDOException $ex) {

                die($ex->getMessage());
                
            }
        }
    }
?>