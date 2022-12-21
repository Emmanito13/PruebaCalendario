<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caledanrio de eventos</title>

    <!-- Pluggins -->
    <?php include_once "lib/lib.php" ?>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>

    <div class="container-fluid">
        <section class="content-header">
            <h1>
                Calendario
                <small>Panel de control</small>
            </h1>
        </section>

        <div class="row">

            <div class="col-10">
                <div id="Calendario1"></div>
            </div>

            <div class="col-2">
                <div class="row">
                    <div id="external-events">
                        <h4 class="text-center">Eventos predefinidos</h4>
                        <div id="listaEventosPredefinidos">

                        </div>
                    </div>
                </div>

                <div class="row">
                    
                </div>
                <hr>
                <div id="section-btn-eventos-predefinidos">
                    <button type="button" id="btnEventosPredefinidos" class="btn btn-success">Administrar eventos predefinidos</button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODALS -->
    <?php include_once "./views/ModalEventos.php" ?>


    <!-- JS -->
    <script src="js/main.js"></script>
</body>

</html>