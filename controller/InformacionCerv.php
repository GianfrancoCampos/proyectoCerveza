<?php
require "../model/bbddCon.php";


        

//Se crea una funcion llamada "consultasCervezas" 
function consultasCervezas(){
      //Se crea una variable "dbh" que almacenará la conexion de la bases de datos al que le pasamos el DNS,USERNAME,PASSWORD
      $dbh = new PDO(DNS, USERNAME,PASSWORD);
      //Establecemos el modo de manejo de errores para la conexion PDO, 
        //permitiendo que PDO lance excepciones cuando se produzcan errores
        //en las consultas SQL
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Se crea una variable "sql" que almacena una consulta SQL al que le pedimos que seleccione todos los registros del campo "cervezas_arts"
        $sql = "SELECT * FROM cervezas_atrs";
        /**
         * La variable "registros" almacenará el conjunto de resultados llegados de la consulta SQL
         */
         $registros = $dbh->query($sql);
         //Se retorna los registros
         return $registros;
         
}



//Se crea una funcion llamada "devolverCerveza" que recibirá por parametro el ID 
function devolverCerveza($id){
  //Se crea una variable "dbh" que almacenará la conexion de la bases de datos al que le pasamos el DNS,USERNAME,PASSWORD
        $dbh = new PDO(DNS, USERNAME,PASSWORD);
        //Establecemos el modo de manejo de errores para la conexion PDO, 
        //permitiendo que PDO lance excepciones cuando se produzcan errores
        //en las consultas SQL
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /**
         * Se crea una sentencia que devolverá los registros de una cerveza en concreto a partir de su ID
         */
        $sql = "SELECT * FROM cervezas_atrs WHERE Identificador = $id";
        //La variable "registros" almacenará el conjunto de resultados llegados de la consulta SQL
         $registros = $dbh->query($sql);
         //Se retorna los registros
         return $registros; 
}