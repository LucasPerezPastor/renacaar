<?php
//Fichero autoload.php
//función que usaremos para buscar las clases

function load($clase){
    global $classmap; //indicamos que use la variable global
    
    //para cada directorio de la lista
    foreach ($classmap as $value) {
        $ruta="$value/$clase.php";//calcula la ruta
        //echo '<p>Probando ruta ['.$ruta.'] para la clase '.$clase.'</p>';
        if (is_readable($ruta)){    //si es legible...
            require_once $ruta; //carga la clase
            //echo '<p>Clase cargada con éxito</p>';
            break;                      //ahoraa iteraciones
            
        }
    }
}

spl_autoload_register("load");       //registrar la función autoload