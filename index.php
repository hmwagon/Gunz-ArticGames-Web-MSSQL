<?php 
///////////////////////////////////////////////////////////////
////////////////// Diceño web By Phoenix /////////////////////
////////////////// Programada por miguel_23 /////////////////
////////////////////////////////////////////////////////////

/* Todos los derechos de el diceño de esta web es de Phoenix                                                            */
/* Pagina web programada total mente por miguel_23                                                                      */
/* Facebook de miguel: https://www.facebook.com/Gunzmiguel23                                                            */
/* todo aquel que lea esto, solo le pido que no cambie el contenido de los derechos de autor, Disfrute de la pagina web */

// Este es el require_once del archivo de configuracion de direccion detos MSSQL
/*
if (!isset($_SERVER['HTTP']) || $_SERVER['HTTP'] !== 'on') {
    if(!headers_sent()) {
        header("Status: 301 Moved Permanently");
        header(sprintf(
            'Location: http://%s%s',
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI']
        ));
        exit();
    }
}*/


require_once('config.php');
require_once('conf/funciones.php');
include 'conf/sql_check.php';


$file_exists = 'moduls/class_header.php';

if(file_exists($file_exists) ){
    
    require(dirname( __FILE__ ) . '/moduls/class_header.php');

}else{

   include('error_log/400.php');
   
}

?>