<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<!--Pagina que mostrara la lista general de las cervezas-->
<body class="bg-warning">
    <h1 class="text-white text-center">Lista general de Cervezas</h1>
    <div class="row d-flex justify-content-center">
        <table class="table table-hover table-dark">
            <tr class="text-center">
                <th>Identificador</th>
                <th>Nombre</th>

            </tr>
            <?php
            /**
             * Hacemos un llamamiento al controlador "InformacionCerv".
             * Este controlador tiene un metodo "consultasCervezas" que nos devolverá todas las cervezas
             * que tiene la bases de datos, la variable "registros" lo almacena.
             */
            require "../controller/InformacionCerv.php";
        $registros = consultasCervezas();
        //Recorremos cada uno de las cervezas de la bases de datos y lo mostramos mediante una tabla con sus respectivos datos
        foreach ($registros as $cervezas) { ?>
            <tr class="text-center">
                <td>
                    <?php echo $cervezas[0] ?>
                </td>

                <td> <a class="text-decoration-none" href="consultarCerveza.php?&id=<?php echo $cervezas[0] ?>">
                        <?php echo $cervezas[1] ?>
                </td>
            </tr>
            <?php } ?>

        </table><br>
    </div>
    <!--Creamos un enlace en caso de que el usuario desee volver al menu principal-->
    <a href="../index.html" class="menuPrincipal">MENU PRINCIPAL</a>
</body>

</html>