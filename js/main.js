
init()

function init() {
    consultarEventosPredefinidos();
    $('.clockpicker').clockpicker();
}



new FullCalendar.Draggable(document.getElementById('listaEventosPredefinidos'), {
    itemSelector: '.fc-event',
    eventData: function (eventEl) {
        return {
            title: eventEl.innerText.trim()
        }
    }
});

var calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'), {
    droppable: true,
    locale: "es",
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    editable: true,
    events: './config/Controller.php?operador=listarEventos',
    height: '100%',
    dateClick: function (info) {
        limpiarFormulario();

        //Se cambia el titulo del modal "ModalEventos"
        $('#lbl_titulo_modal_eventos').text('Agregar nuevo evento');

        //Se ponen las fechas en el evento que le dio click
        if (info.allDay) {
            $('#fechaInicio').val(info.dateStr);
            $('#fechaFin').val(info.dateStr);
        } else {
            let fechaHora = info.dateStr.split('T');
            $('#fechaInicio').val(fechaHora[0]);
            $('#fechaFin').val(fechaHora[0]);
            $('#horaInicio').val(fechaHora[1].substring(0, 5));
        }

        //Mostramos los botones que queremos mostrar
        $('#btnAgregarEvento').show();
        $('#btnModificarEvento').hide();
        $('#btnBorrarEvento').hide();
        $('#modal_eventos').modal('show');

    },
    eventClick: function (info) {

        //Se cambia el titulo del modal "ModalEventos"
        $('#lbl_titulo_modal_eventos').text('Editar evento');

        //Recuperamos los datos de ese evento en el formulario
        $('#id').val(info.event.id);
        $('#Titulo').val(info.event.title);
        $('#Descripcion').val(info.event.extendedProps.descripcion);
        $('#fechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#fechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
        $('#horaInicio').val(moment(info.event.start).format("HH:mm"));
        $('#horaFin').val(moment(info.event.end).format("HH:mm"));
        $('#ColorFondo').val(info.event.backgroundColor);
        $('#ColorTexto').val(info.event.textColor);


        //Mostramos los botones que queremos mostrar
        $('#btnModificarEvento').show();
        $('#btnBorrarEvento').show();
        $('#btnAgregarEvento').hide();
        $('#modal_eventos').modal('show');
    },
    eventDrop: function (info) {

        //Se vuelve a recuperar todos los datos del evento
        $('#id').val(info.event.id);
        $('#Titulo').val(info.event.title);
        $('#Descripcion').val(info.event.extendedProps.descripcion);
        $('#fechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#fechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
        $('#horaInicio').val(moment(info.event.start).format("HH:mm"));
        $('#horaFin').val(moment(info.event.end).format("HH:mm"));
        $('#ColorFondo').val(info.event.backgroundColor);
        $('#ColorTexto').val(info.event.textColor);        
        modificarEvento();
    },
    drop: function (info) {
        limpiarFormulario();
        //Se obtienen de la base de datos
        $('#ColorFondo').val(info.draggedEl.dataset.colorfondo);
        $('#ColorTexto').val(info.draggedEl.dataset.colortexto);
        $('#Titulo').val(info.draggedEl.dataset.titulo);
        let fechaHora = info.dateStr.split("T");
        $('#fechaInicio').val(fechaHora[0]);
        $('#fechaFin').val(fechaHora[0]);               

        if (info.allDay) {
            $('#horaInicio').val(info.draggedEl.dataset.horainicio);
            $('#horaFin').val(info.draggedEl.dataset.horafin);
        } else {
            $('#horaInicio').val(fechaHora[1].substring(0, 5));
            $('#horaFin').val(moment(fechaHora[1].substring(0, 5)).add(1, 'hours'));
        }        

        let parametros = {
            titulo: $('#Titulo').val(),
            descripcion: $('#Descripcion').val(),
            inicio: $('#fechaInicio').val() + " " + $('#horaInicio').val(),
            fin: $('#fechaFin').val() + " " + $('#horaFin').val(),
            colorTexto: $('#ColorTexto').val(),
            colorFondo: $('#ColorFondo').val()
        }        

        agregarEventoPredefinido(parametros);

    }


});

calendario1.render();



function consultarEventosPredefinidos() {
    let divEventosPredefinidos = $('#listaEventosPredefinidos').empty();
    $.ajax({
        type: 'POST',
        url: './config/Controller.php?operador=listarEventosPredefinidos',
        beforeSend: function () { },
        success: function (response) {

            if (response != 'empty') {
                $.each(JSON.parse(response), function (id, name) {
                    divEventosPredefinidos.append(
                        `<div 
                            class="fc-event" 
                            data-titulo="${name.titulo}" 
                            data-horainicio="${name.horainicio}" 
                            data-horafin="${name.horafin}"
                            data-colorfondo="${name.colorfondo}" 
                            data-colortexto="${name.colortexto}"
                            style="border-color:${name.colorfondo};
                                    color:${name.colortexto};
                                    background-color:${name.colorfondo};
                                    margin: 10px;
                                    padding: 3px;
                                    text-align: center;
                                    border-radius: 13px;">
                            ${name.titulo} ${name.horainicio} a ${name.horafin}
                        </div>`
                    );
                });
            } else {
                divEventosPredefinidos.append(
                    `<div>
                        Sin eventos
                    </div>`
                );
            }
        }
    });
}

const limpiarFormulario = () => {
    $('#id').val('');
    $('#Titulo').val('');
    $('#fechaInicio').val('');
    $('#horaInicio').val('');
    $('#fechaFin').val('');
    $('#horaFin').val('');
    $('#Descripcion').val('');
    $('#ColorFondo').val('#3788D8');
    $('#ColorTexto').val('#ffffff');

}

const agregarEvento = () => {

    parametros = {
        titulo: $('#Titulo').val(),
        descripcion: $('#Descripcion').val(),
        inicio: $('#fechaInicio').val() + " " + $('#horaInicio').val(),
        fin: $('#fechaFin').val() + " " + $('#horaFin').val(),
        colorTexto: $('#ColorTexto').val(),
        colorFondo: $('#ColorFondo').val()
    }

    $.ajax({
        data: parametros,
        url: './config/Controller.php?operador=agregarEvento',
        type: 'POST',
        beforeSend: function () { },
        success: function (response) {
            switch (response) {
                case 'success':
                    $('#modal_eventos').modal('hide');
                    calendario1.refetchEvents();
                    limpiarFormulario();
                    break;
                case 'failed':
                    alert('No se pudo ingresar evento');
                    break;
                case 'requerid':
                    alert('Campos vacios');
                    break;
            }
        },
        error: function (error) {
            alert('Error: ' + error);
        }
    });
}

const modificarEvento = () => {
    parametros = {
        id: $('#id').val(),
        titulo: $('#Titulo').val(),
        descripcion: $('#Descripcion').val(),
        inicio: $('#fechaInicio').val() + " " + $('#horaInicio').val(),
        fin: $('#fechaFin').val() + " " + $('#horaFin').val(),
        colorTexto: $('#ColorTexto').val(),
        colorFondo: $('#ColorFondo').val()
    }

    $.ajax({
        data: parametros,
        url: './config/Controller.php?operador=modificarEvento',
        type: 'POST',
        beforeSend: function () { },
        success: function (response) {
            switch (response) {
                case 'success':
                    $('#modal_eventos').modal('hide');
                    calendario1.refetchEvents();
                    limpiarFormulario();
                    break;
                case 'failed':
                    alert('No se pudo editar evento');
                    break;
                case 'requerid':
                    alert('Campos vacios');
                    break;
            }
        },
        error: function (error) {
            alert('Error: ' + error);
        }
    });

}

const borrarEvento = () => {
    parametros = {
        id: $('#id').val()
    }

    $.ajax({
        data: parametros,
        url: './config/Controller.php?operador=borrarEvento',
        type: 'POST',
        beforeSend: function () { },
        success: function (response) {
            switch (response) {
                case 'success':
                    $('#modal_eventos').modal('hide');
                    calendario1.refetchEvents();
                    break;
                case 'failed':
                    alert('No se pudo eliminar evento');
                    break;
                case 'error':
                    alert('No se encontro evento');
                    break;
            }
        },
        error: function (error) {
            alert('Error: ' + error);
        }
    });

}

const agregarEventoPredefinido = (parametros) => {

    $.ajax({
        data: parametros,
        url: './config/Controller.php?operador=agregarEvento',
        type: 'POST',
        beforeSend: function () { },
        success: function (response) {            
            switch (response) {
                case 'success':
                    calendario1.removeAllEvents();
                    calendario1.refetchEvents();
                    break;
                case 'failed':
                    alert('No se pudo crear evento');
                    break;
                // case 'error':
                //     alert('No se encontro evento');
                //     break;
            }
        },
        error: function (error) {
            alert('Error: ' + error);
        }
    });

}