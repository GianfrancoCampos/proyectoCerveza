<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFORMACION CERVEZA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .hover-link:hover{
   color: crimson; 
  }
</style>
<body class="bg-warning">
    <h1 class="text-center">DETALLE DE LA CERVEZA</h1>
    <div class="container-fluid p-1">
    <ul class="list-inline text-center">
        <li class="list-inline-item"><a class="text-decoration-none hover-link" href="infoCerveza.php">LISTA GENERAL</a></li>
        <li class="list-inline-item"><a class="text-decoration-none hover-link" href="../index.html">MENU PRINCIPAL</a></li>
    </ul>
    </div>
    <div  class="row d-flex justify-content-center">
    <table class="table table-hover table-dark">
        <?php
        require "../controller/InformacionCerv.php";
        $id = $_GET["id"];
        $registros = devolverCerveza($id);

        foreach ($registros as $cervezas) { ?>
            <tr class="text-center">
                <th>Identificador</th>
                <td>
                    <?php echo $cervezas[0] ?>
                </td>
            </tr>
            <tr class="text-center">
                <th>Nombre</th>
                <td>
                    <?php echo $cervezas[1] ?>
                </td>
            </tr>
            <tr class="text-center">
                <th>Tipo</th>
                <td>
                    <?php echo $cervezas[2] ?>
                </td>
            </tr>
            <tr class="text-center">
                <th>Graduacion Alcoholica</th>
                <td>
                    <?php echo $cervezas[3] ?>
                </td>
            </tr>
            <tr class="text-center">
                <th>Pais</th>
                <td>
                    <?php echo $cervezas[4] ?>
                </td>
            </tr>
            <tr class="text-center">
                <th>Precio</th>
                <td>
                    <?php echo $cervezas[5] ?>
                </td>
            </tr>
            <tr class="text-center">
                <th>Imagen</th>
                <td>
                    <img src="<?php echo $cervezas[6] ?>" width="150" height="150" alt="">
                </td>
            </tr>
            <tr class="text-center">
                <th>Editar Cerveza</th>
                <td><a class="hover-link" href="../view/MntCerv.php?tipo=modificar&id=<?php echo $cervezas[0] ?>">Editar</a>
                    <a class="hover-link" href="../controller/DeleteCerv.php?id=<?php echo $cervezas[0] ?>">Eliminar</a>
                    
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>

</html>