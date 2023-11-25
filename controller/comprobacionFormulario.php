<?php

// Hago un llamamiento a la bases de datos para enviar los datos correctamente

require "../model/bbddCon.php";

/**
 * Se crea las siguientes variables:
 *  - Nombre,tipo,graduacion,pais,precio,rutaImagen que, de momento, no tienen ningún valor
 *  Se crea una variable booleana "validarCampo" para que compruebe que todos los campos cumplan los requisitos requeridos
 */


$nombre = "";
$tipo = "";
$graduacion = 0;
$pais = "";
$precio = "";
$rutaImagen = "";
$validarCampo = true;

/**
 * Esta condición es para comprobar que el nombre que haya llegado por el formulario esté definido y no esté vacío
*/
if (isset($_POST["inombre"]) && !empty($_POST["inombre"])) {
    //La variable nombre, creada de antes, tomará el valor del nombre que llegó por el formulario
    $nombre = $_POST["inombre"];
   //Creo una expresión regular que le indico lo siguiente:
   // Solo contendrá letras tanto mayúsculas como minúsculas, permitido los espacios y los guiones y solo permitido de 1 a 50 caracteres 
    $ER = "/[a-zA-Z\s-]{1,50}/";
    /**
     * Condición para comprobar que en caso de que el resultado sea diferente a lo esperado(no cumple con los requisitos de la ER),
     * el booleano "validarCampo" será false
    */
    if (!preg_match($ER, $nombre)) {

        $validarCampo = false;
    }

}
/**
 * Esta condición es para comprobar que esté definido el tipo que haya llegado por el formulario
 */

if (isset($_POST["sTipo"])) {
    //Creo un array llamado "tipoPermitido" que sólo tendrá los siguientes valores -> tostada,rubia,deTrigo,negra
    $tipoPermitido = ["tostada", "rubia", "deTrigo", "negra"];
    //Se crea la variable "tipo" que guardará el tipo llegado por el formulario 
    $tipo = $_POST["sTipo"];
    /**
     * Esta condicion es para comprobar que si el tipo llegado por el formulario no coincide con uno de los valores de la matriz,
     * el booleano "validarCampo" devolverá false
     */
    if (!in_array($tipo, $tipoPermitido)) {
        $validarCampo = false;
    }
}

//Condicion para comprobar si está definido la graduación y tampoco esté vacío
if (isset($_POST["igraduacion"]) && !empty($_POST["igraduacion"])) {
    //La variable "graduacion" guardará el valor de la graduación que llegó por el formulario
    $graduacion = $_POST["igraduacion"];
    //Si la graduación es menor o igual a 0 entonces el booleano "validarCampo" será false
    if ($graduacion <= 0) {
        $validarCampo = false;
    }
}

//Condición para comprobar que esté definido el país y que tampoco esté vacío
if (isset($_POST["ipais"]) && !empty($_POST["ipais"])) {
    //La variable "pais" guardará el pais llegado por el formulario
    $pais = $_POST["ipais"];
    //Creo una expresión regular que le indico lo siguiente:
   // Solo contendrá letras tanto mayúsculas como minúsculas, permitido los espacios y los guiones y solo permitido de 1 a 60 caracteres 
    $ERPais = "/[a-zA-Z\s-]{1,60}/";/**
    * Condición para comprobar que en caso de que el resultado sea diferente a lo esperado(no cumple con los requisitos de la ER),
    * el booleano "validarCampo" será false
   */
    if (!preg_match($ERPais, $pais)) {

        $validarCampo = false;
    }
}

//Condición para comprobar que esté definido el precio y que tampoco esté vacío
if (isset($_POST["iprecio"]) && !empty($_POST["iprecio"])) {
    //La variable "precio" guardará el valor del precio que llegó por el formulario
    $precio = $_POST["iprecio"];
    //Si el precio es menor o igual a 0 entonces el booleano "validarCampo" será false
    if ($precio <= 0) {
        $validarCampo = false;
    }
}

//Se comprueba si está definido el botón con nombre "ienviar" y que tampoco esté vacío
if (isset($_POST["ienviar"]) && !empty($_POST["ienviar"])) {

    //COMPROBACION FICHERO
    //La variable "fichero" almacena el fichero,en este caso el resumen de la cerveza, que haya llegado por el formulario
    $fichero = $_FILES["myfile1"];

    //Condición que en caso de que el tipo de fichero sea diferente a pdf o docx, el booleano "validarCampo" será false
    if ($fichero["type"] != "application/pdf" && $fichero["type"] != "application/docx") {

        $validarCampo = false;
    } 
    //Si es pdf o docx hará una condición en que si el tamaño es menor a 5MB, el booleano "validarCampo" será false
    else {
        if ($fichero["size"] > 5000000) {

            $validarCampo = false;
        } 
        //Si el tamaño es mayor o igual 5MB, el fichero será enviado al servidor con ruta "../beer-desc/NombreFichero" y todo eso será guardado en la variable "resumenCerveza"
        else {

            //En caso de que el nombre tengas espacios se lo quitamos 
            $nombreSinEspacios = str_replace(' ','',$nombre);
            //Extraemos la extension del fihero
            $extension = pathinfo($fichero["name"], PATHINFO_EXTENSION);
            //La variable "resumenCerveza" moverá al servidor el fichero con el nombre sin espacio y con su extension
            $resumenCerveza = move_uploaded_file($_FILES['myfile1']['tmp_name'], "../beer-desc/" .$nombreSinEspacios.".".$extension);
            //Si cumple el booleano es true
            $validarCampo;
            //Si el envío del fichero al servidor falla, el booleano "validarCampo" será false
            if (!$resumenCerveza) {
                $validarCampo = false;
            }
        }
    }

    //La variable "fichero2" almacenará la imagen llegada por el formulario
    $fichero2 = $_FILES["myfile2"];
    //Condición que comprobará que si el tipo de la imagen es diferente a png,jpg,jpeg el booleano "validarCampo" devuelve false
    if ($fichero2["type"] != "image/png" && $fichero2["type"] != "image/jpg" && $fichero2["type"] != "image/jpeg") {

        $validarCampo = false;

    } 
    //Si es png,jpg,jpeg entonces la imagen será llevada al servidor y almacenado en la variable "imagen"
    else {
        $imagen = move_uploaded_file($_FILES['myfile2']['tmp_name'], "../beer-desc/" . $_FILES['myfile2']['name']);
        //La variable "rutaImagen" almacenará la ruta de la imagen
        $rutaImagen = "../beer-desc/" . $_FILES['myfile2']['name'];

        /**
         * Dos condiciones que comprueban que si la imagen no es llevada al servidor correctamente, el booleano "validarCampo" será false
         */
        if (!$imagen) {
            $validarCampo = false;
        }

        if (!$rutaImagen) {
            $validarCampo = false;
        }
        
    }
    //Si el booleano "validarCampo" es true entonces llamará a la función "subirElementosBBDD" para enviarles por parámetros los siguientes datos:
    //Nombre,Tipo,Graduación,Pais,Precio,RutaImagen y será reedirigido a la pagina principal
    if ($validarCampo == true) {
        subirElementosBBDD($nombre, $tipo, $graduacion, $pais, $precio, $rutaImagen);
       header("Location: ../index.html");
    }
    //En caso de fallo será enviado al formulario de nuevo
    else {
      //  
        header("Location: ../view/MntCerv.php");
    }

}

//PARA LA COMPROBACION DE DATOS ANTES DE SU ACTUALIZACION
//Condición para comprobar si está definido el botón con nombre "update" y que tampoco esté vacío
if (isset($_POST["update"]) && !empty($_POST["update"])) {

    //COMPROBACION FICHERO
    ////La variable "fichero" almacena el fichero,en este caso el resumen de la cerveza, que haya llegado por el formulario
    $fichero = $_FILES["myfile1"];
    
    //Condición para comprobar que si el tipo de fichero es diferente a pdf o docx el booleano devolverá false
    if ($fichero["type"] != "application/pdf" && $fichero["type"] != "application/docx") {

        $validarCampo = false;
    } 
    //Si es pdf o docx entonces habrá otra condición que si el tamaño es menor a 5MB el booleano "validarCampo" será false
    else {
        if ($fichero["size"] > 5000000) {

            $validarCampo = false;
        } 
        //Si el tamaño es mayor o igual a 5MB, el fichero será enviado al servidor y almacenado en la variable "resumenCerveza"
        else {
            //En caso de que el nombre tengas espacios se lo quitamos
            $nombreSinEspacios = str_replace(' ','',$nombre);
            //Extraemos la extension del fichero
            $extension = pathinfo($fichero["name"], PATHINFO_EXTENSION);
            //La variable "resumenCerveza" moverá al servidor el fichero con el nombre sin espacio y con su extension
            $resumenCerveza = move_uploaded_file($_FILES['myfile1']['tmp_name'], "../beer-desc/" .$nombreSinEspacios.".".$extension);
            
            //Si el fichero no se envía correctamente entonces el booleano "resumenCerveza" devolverá false
            if (!$resumenCerveza) {
                $validarCampo = false;
            
        }
    }
    }
    //La variable "fichero2" almacenará la imagen llegada por el formulario
    $fichero2 = $_FILES["myfile2"];
    //Creamos la variable "extension" que almacerá la extensión del fichero
    $extension = pathinfo($fichero2["name"], PATHINFO_EXTENSION);

    //Si la extensión es diferente a png o jpg entonces el booleano "validarCampo" devolverá false
    if ($extension !== "png" && $extension !== "jpg") {
        $validarCampo = false;
    }

    //Si es png o jpg entonces se hace otra condicion que si el tamaño es menor o igual 10MB el booleano "validarCampo" será false
    else{
        if ($fichero2["size"] >= 10000000) {
            
            $validarCampo = false;
        }

        //Si es mayor a 10MB la imagen será enviado al servidor
        //Almacenamos en la variable "rutaImagen" la ruta de la imagen
        else{
            $imagen = move_uploaded_file($_FILES['myfile2']['tmp_name'], "../beer-desc/" . $_FILES['myfile2']['name']);
            $rutaImagen = "../beer-desc/" . $_FILES['myfile2']['name'];

            //Si hay fallos en el envío de la imagen al servidor el booleano "validarCampo" devolverá false 
            if (!$imagen) {
                $validarCampo = false;
            }
            if (!$rutaImagen) {
                $validarCampo = false;
            }
        }
    }

    //Si la variable "validarCampo", una vez comprobado por cada uno de los datos es true se llamará a la funcion "edicionElementos"
    //enviando los siguientes datos -> Nombre,Graduacion,Pais,Precio,RutaImagen y será reedirigido a la pagina principal
    if ($validarCampo == true) {
        edicionElementos($nombre, $tipo, $graduacion, $pais, $precio, $rutaImagen);
        header("Location: ../index.html");
    } 
    //Si el envío se hace de manera incorrecta entonces será reedirigido a la lista generl de las cervezas
    else {
        header("Location: ../view/infoCerveza.php");
    }


}




// SUBIR LOS DATOS RELLENADOS A LA BASES DE DATOS
//Se crea la función "subirElementosBBDD" que recibirá los siguientes parametros -> nombre,tipo,graduacion,pais,precio,rutaImagen
function subirElementosBBDD($nombre, $tipo, $graduacion, $pais, $precio, $rutaImagen)
{

    //Se crea un try Catch para ejecutar una serie de operaciones relacionadas con la bases de datos
    try {

        /**
         * Se crea una variable "dbh" que almacenará la conexion con la bases de datos
         * al que le hemos pasado el DNS, el usuario y la contraseña
        */
        $dbh = new PDO(DNS, USERNAME, PASSWORD);
        //Establecemos el modo de manejo de errores para la conexion PDO, 
        //permitiendo que PDO lance excepciones cuando se produzcan errores
        //en las consultas SQL
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /**
         * Creamos la variable "sql"que contiene una consulta de SQL,
         * en este caso de insertar los valores que se haya introducido por
         * el formulario.
         * Preparamos la consulta SQL de insercion.
         * Mediante el "bindParam" asociamos los parametros a la consulta preparada,
         * asi con cada uno de los elementos
         */
        $sql = "INSERT INTO " . CERVEZA . "(Nombre,Tipo,Graduacion,Pais,Precio,RutaImagen)
            VALUES(?,?,?,?,?,?)";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(1, $nombre);
        $statement->bindParam(2, $tipo);
        $statement->bindParam(3, $graduacion);
        $statement->bindParam(4, $pais);
        $statement->bindParam(5, $precio);
        $statement->bindParam(6, $rutaImagen);
        //Se ejecuta la consulta
        $statement->execute();
    } 
    /**
     * En caso de que en el try haya una excepcion ser captura mediante el catch
     * Se muestra por pantalla el fallo de la conexion junto con un mensaje
     * especifico de la excepcion
    */

    catch (Exception $ex) {
        echo "Fallo en la conexion: " . $ex->getMessage();
    }
}
//Se crea la función "edicionElementos" que recibirá los siguientes parametros -> nombre,tipo,graduacion,pais,precio,rutaImagen
function edicionElementos($nombre, $tipo, $graduacion, $pais, $precio, $rutaImagen)
{
    //Condicion para comprobar que el id llegado por la URL esté definido
    if (isset($_GET['id'])) {
        //Si está definido se almacena en una variable "ID
        $id = $_GET['id'];
        /**
         * Se crea una variable "dbh" que almacenará la conexion con la bases de datos
         * al que le hemos pasado el DNS, el usuario y la contraseña
        */
        $dbh = new PDO(DNS, USERNAME, PASSWORD);
        //Establecemos el modo de manejo de errores para la conexion PDO, 
        //permitiendo que PDO lance excepciones cuando se produzcan errores
        //en las consultas SQL
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /**
         * Se crea una variable "sql" que almacena una consulta SQL que 
         * en este caso es de actualizacion y los datos cambiaran segun lo que se haya enviado
         * donde el identificador será igual al ID llegado
         */
        $sql = "UPDATE " . CERVEZA . " SET Nombre = ?, Tipo = ?, Graduacion = ?, Pais = ?, Precio = ?, RutaImagen = ? WHERE Identificador = ?";
        //Preparamos la consulta SQL de actualizacion que se almacena en la variable "sentencia"
        $sentencia = $dbh->prepare($sql);
        /**
         * En la variable "resultado" ejecutamos la sentencia que se le pasa
         * como argumento un array que contiene los valores que se asignaran a los marcadores
         * de posicion en la consulta preparada
         */
        $resultado = $sentencia->execute([$nombre, $tipo, $graduacion, $pais, $precio, $rutaImagen, $id]);

        //Condicion para comprobar que se haya ejecutado correctamente
        if ($resultado === true) {
            echo "CAMBIOS GUARDADOS";
        }
    }
}
/*require "DeleteCerv.php";

eliminacionElementos($fichero,$rutaImagen);*/