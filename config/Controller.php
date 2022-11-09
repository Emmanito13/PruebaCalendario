<?php

require "Data.php";

$data = new Data();

switch($_REQUEST['operador']){

    case 'listarEventos':
        echo json_encode($data->listarEventos());
        break;
    
    case 'agregarEvento':
        
        break;

    case 'modificarEvento':
        
        break;

    case 'borrarEvento':
        
            break;
}

?>