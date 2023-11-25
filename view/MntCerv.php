<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FORMULARIO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
.hover-link:hover {
    color: crimson;
}
</style>
<!--Este formulario funcionará tanto para dar de alta una cerveza como para modificar, en caso de la última opción,
se les mostrará los datos que ya tenía esa cerveza-->

<body class=" bg-light w-20">

    <?php
    /**
     * En caso de que el usuario haga una actualización hacemos un llamamiento
     * al controlador InformacionCerv que tiene el método devolverCerveza, que como bien indica su nombre,
     * nos devolverá los datos de esa cerveza
    */
    
  require "../controller/InformacionCerv.php";
  /**
   * Se crea la variable "tipo" que va a contener el tipo que haya elegido el usuario(modificar o alta)
  */
  $tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : '';
/**
 * Se crea una condicion que en caso de que la opcion sea modificar y el id esté definido hará lo siguiente:
 * Se guarda en una variable llamada "id" el id que haya llegado por la URL por el método GET
 * Otra variable que, en este caso, se llamará "registros" y contendrá el método devolverCerveza que nos devolverá
 * una cerveza en específico mediante su ID.
 * La variable "cerveza" contendrá el resultado el campo con los datos de esa cerveza
 */
  if ($tipo == "modificar" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $registros = devolverCerveza($id);
    $cerveza = $registros->fetch();
  }



  ?>
  <!--
    Este h1 se llamará "ACTUALIZACION DE LA CERVEZA" en caso de que se desea modificar y sino será llamado "CREACION DE LA CERVEZA"
  -->
    <h1 class="h1 bg-info  opacity-25 text-white text-center p-3 mb-0">
        <?php
         if ($tipo == "modificar") {
      echo "ACTUALIZACION";
    } else {
      echo "CREACION";
    } ?> DE LA CERVEZA
    </h1>
    <div class=" bg-secondary">
        <ul class="list-inline text-center">
            <li><a href="../index.html" class="hover-link text-decoration-none mw-100">MENU PRINCIPAL</a><br><br></li>
        </ul>

    </div>
    <!--
      Este formulario será enviado al controlador "comprobacionFormulario" en el valor modificar o alta. 
      Si es modificar también se enviará el ID como parámetro para especificar esa cerveza, sino solo tendrá el valor de alta
    -->
    <!--
      Como se puede comprobar, los datos solo se mostrará si el valor es modificar
    -->
    <form action="../controller/comprobacionFormulario.php?<?php if ($tipo == "modificar") {
    echo "id=" . $cerveza[0] . "&";
  } ?> tipo=<?php echo $tipo; ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label>
        <input type="text" name="inombre" pattern="[a-zA-Z\s-]+" max="50" id="nombre" value="<?php if ($tipo == "modificar") {
      echo $cerveza[1];
    } ?>" />
        <br /><br /><br />
        <label for="tipo">Elige el tipo de cerveza</label><br /><br />
        <select name="sTipo" id="iTipo" value="<?php if ($tipo == "modificar") {
      echo $cerveza[2];
    } ?>">
            <option value="tostada">Tostada</option>
            <option value="rubia">Rubia</option>
            <option value="deTrigo">De Trigo</option>
            <option value="negra">Negra</option>
        </select>
        <br /><br /><br />
        <label for="graduacion">Graduacion alcohólica: </label>
        <input type="number" min="1" name="igraduacion" id="graduacion" value="<?php if ($tipo == "modificar") {
      echo $cerveza[3];
    } ?>" />
        <br /><br /><br />
        <label for="pais">Pais de Procedencia de la Cerveza: </label>
        <input type="text" pattern="[a-zA-Z\s-]+" max="50" name="ipais" id="pais" value="<?php if ($tipo == "modificar") {
      echo $cerveza[4];
    } ?>" />
        <br /><br /><br />
        <label for="precio">Precio: </label>
        <input type="number" min="1" name="iprecio" id="precio" value="<?php if ($tipo == "modificar") {
      echo $cerveza[5];
    } ?>" />
        <br /><br /><br />
        <label for="file1">Adjunte un resumen de la cerveza</label>
        <br /><br />
        <input type="file" name="myfile1" id="ifile" />
        <br /><br />
        <label for="file2">Adjunte una imagen de la cerveza</label>
        <br /><br />
        <input type="file" name="myfile2" id="ifile" value="<?php if ($tipo == "modificar") {
      echo $cerveza[6];
    } ?>" />
        <br /><br />
        <!--
          El nombre del botón dependerá si el valor es modificar o alta, el nombre se llamará "update" si es modificar,
          sino "ienviar" en caso de que sea alta
        -->
        <input type="submit" name="<?php if ($tipo == "modificar") {
      echo "update";
    } else {
      echo "ienviar";
    } ?>" value="Enviar"></input>
    </form>
</body>

</html>