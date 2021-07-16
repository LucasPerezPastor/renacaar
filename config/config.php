<?php
//PARAMETROS DE CONFIGURACION BDD

define('DB_HOST','localhost'); //host
define('DB_USER','u967303591_renacaar');           //usuario
define('DB_PASS','V0yager1978');               //password
define('DB_NAME','u967303591_renacaar'); //base de datos
define('DB_CHARSET','utf8');    //codificación

//OTROS PARÁMETROS

define('DEBUG',true);               //para depuración

//PARA EL AUTOLOAD
$classmap=[__DIR__.'/../app/controllers',__DIR__.'/../app/models',__DIR__.'/../app/libraries',__DIR__.'/../app/templates'];//directorios donde buscar clases
 
 //CONTROLADOR Y METODO POR DEFECTO
 define('DEFAULT_CONTROLLER','Welcome');
 define('DEFAULT_METHOD','index');
 
 //CONSTANTES DE USO DEL PROGRAMA
 define('T_SAVE','guardar');
 define('T_UPDATE','actualizar');
 define('T_DELETE','borrar');
 define('T_SEARCH','buscar');
 define('T_SEND','enviar');
 define('T_IDENTIFY','identificar');
 define('T_GENERATED','generar');
 
 //PARA EL ENVIO DE MAIL DE CONTACO
 define('CONTACT_EMAIL','thelucas_p@hotmail.com');
 
 //TEMPLATE A USAR EN LAS VISTAS
 define('TEMPLATE','TemplateBasico');
 
 //RUTA DE RESOURCES
 define('RESOURCE','resources/views');
 //RUTA DE CSS
 define('STYLE','css');
 //RUTA DE IMAGENES
 define('IMG','images');
 //RUTA CARPETA RAIZ
 define('ROOT_PUBLIC','public');
 //PROFUNDIDAD MÁXIMA DE RUTA
 define('MAX_DEEP_RESOURCE',4);
 //NIVEL DE PRIVILEGIO MINIMO
 define('MIN_PRIVILEGE',500);
 //USUARIO DE MUESTRA
 define('SHOW_USER','userejemplo@miemail.com');
 //CLAVE DE USUARIO DE MUESTRA
 define('SHOW_PASSWORD_USER','userejemplo');