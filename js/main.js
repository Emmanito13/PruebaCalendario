init()



function init (){
    $.ajax({        
        url: './config/Controller.php?operador=listarEventos',
        type: 'POST',
        beforeSend: function () { },
        success: function (response) {
           console.log(JSON.parse(response));
        }
    });
}