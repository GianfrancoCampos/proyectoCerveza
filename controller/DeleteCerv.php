<?php

    //Hacemos un llamamiento al modelo que contiene los datos necesarios para la conexion con la base de datos
    require "../model/bbddCon.php";
    

    
    //Condicion para comprobar que el ID llegado por la URL esté definido
    if (isset($_GET["id"])) {

        //Ese ID ,una vez comprobado, llegado por la URL se almacena en la variable "id"
        $id = $_GET["id"];
        
        /**
         * Se crea una variable "dbh" que almacenará la conexion con la bases de datos
         * al que le hemos pasado el DNS, el usuario y la contraseña
        */
        $dbh = new PDO(DNS, USERNAME,PASSWORD);
        //Establecemos el modo de manejo de errores para la conexion PDO, 
        //permitiendo que PDO lance excepciones cuando se produzcan errores
        //en las consultas SQL
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Esta variable hace una consulta a dos campos especificos
        $ConsultaCampos = "SELECT RutaImagen,Nombre FROM ".CERVEZA." WHERE Identificador = $id";
        
        //Devuelve un conjunto de resultados
        $registros = $dbh->query( $ConsultaCampos);
        
        //Si el resultado no es la esperado
        if (!$registros) {
            //Mediante el die hacemos que se detenga la ejecucion con un mensaje de error añadido
            die("Query Failed");
        }
        else{
            //La variable "sql" almacena la consulta de ELIMINAR en SQL en el que se elimina
        //todos los datos de una cerveza especifica en donde debe coincidir el Identificador con la variable "ID"
            $sql = "DELETE FROM ".CERVEZA." WHERE Identificador = $id";
            //Prepara la consulta
            $sentencia = $dbh->prepare($sql);
            //Ejecuta la consulta
            $resultado = $sentencia->execute();

            //Recorremos esos registros
            foreach ($registros as $campos) {
                //Eliminacion de la imagen alojada en el servidor
                unlink($campos[0]);
                //Si el nombre tiene espacios se los eliminamos
                $eliminacionEspacios = str_replace(' ','',$campos[1]);
                //Condicion para comprobar la eliminacion de los ficheros que estan alojados en el servidor
               if (unlink("../beer-desc/".$eliminacionEspacios.".pdf") ||unlink("../beer-desc/".$eliminacionEspacios.".docx")) {
                continue;
               }
            
            
        }


    }
    //En caso de que sea lo esperado se reedirige a la lista general de las cervezas
    header("Location: ../view/infoCerveza.php");
}