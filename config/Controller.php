<?php

require "Data.php";

$data = new Data();

switch($_REQUEST['operador']){

    case 'listarEventos':
        echo json_encode($data->listarEventos());
        break;
    
    case 'listarEventosPredefinidos':
        if(!empty($data->listarEventosPredefinidos())){
            echo json_encode($data->listarEventosPredefinidos());
        }else{
            echo "empty";
        }
        break;
    
    case 'agregarEvento':
        if(
            isset($_POST['titulo'],                  
                  $_POST['inicio'], 
                  $_POST['fin'],
                  $_POST['colorTexto'],           
                  $_POST['colorFondo']
                  
            ) && 
            !empty($_POST['titulo']) &&
            !empty($_POST['inicio']) &&            
            !empty($_POST['fin']) &&
            !empty($_POST['colorTexto']) &&
            !empty($_POST['colorFondo'])
        ){
            if($data->agregarEvento(
                  $_POST['titulo'],
                  $_POST['descripcion'],
                  $_POST['inicio'], 
                  $_POST['fin'],
                  $_POST['colorTexto'],            
                  $_POST['colorFondo'],                  
                )){
                    $response = "success";
            }else{
                $response = "failed";
            }
        }else{
            $response = "requerid";
        }

        echo $response;
        break;

    case 'modificarEvento':
        if(
            isset($_POST['titulo'],
                  $_POST['descripcion'], 
                  $_POST['inicio'], 
                  $_POST['fin'],
                  $_POST['colorTexto'],           
                  $_POST['colorFondo']
                  
            ) && 
            !empty($_POST['titulo']) &&
            !empty($_POST['inicio']) &&            
            !empty($_POST['fin']) &&            
            !empty($_POST['descripcion']) &&
            !empty($_POST['colorTexto']) &&
            !empty($_POST['colorFondo'])
        ){
            if($data->editarEvento(
                  $_POST['id'],
                  $_POST['titulo'],
                  $_POST['descripcion'],
                  $_POST['inicio'], 
                  $_POST['fin'],
                  $_POST['colorTexto'],            
                  $_POST['colorFondo'],                  
                )){
                    $response = "success";
            }else{
                $response = "failed";
            }
        }else{
            $response = "requerid";
        }

        echo $response;
        
        break;

    case 'borrarEvento':
        if(isset($_POST['id']) && !empty($_POST['id'])){
            if($data->borrarEvento($_POST['id'])){
                $response = 'success';
            }else{
                $response = 'failed';
            }
        }else{
            $response = 'error';
        }
        
        echo $response;
        
        break;
}

?>