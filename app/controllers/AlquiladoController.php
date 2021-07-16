<?php
class AlquiladoController{
    public function create(int $idPiloto=0){
        //recuperamos la información del condcutor del coche
        $piloto= Piloto::getById($idPiloto);
        
        //si no hay conductor del coche
        if (!$piloto)
            throw new Exception("No se ha encontrado el conductor.");
        
        //recuperamos los nombres de los coches disponibles
        
        $coches= Coche::getNames();
        if (!$coches)
            throw new Exception("No se han podido recuperar los coches.");
       
       $coches=Coche::get();
       if (!$coches)
           throw new Exception("No se han podido recuperar los coches.");
        
       $cochesDisponibles=[];    
       foreach ($coches as $coche) {
           if (!Alquilado::isCocheAlquilado($coche->id))
                $cochesDisponibles[$coche->nombre]=$coche->nombre;
       }
       
       if (empty($cochesDisponibles))
           throw new Exception("No hay coches disponibles para alquilar.");
           
       
        //carga la vista  para crear alquileres
        include Find::view('alquilado/nuevo');
    }
    
    //guarda un alquiler
    public function store(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
   
    //comprueba que llegue el formulario con los datos
    
    if (empty($_POST[T_SAVE]))
        throw new Exception('No se han recibido los datos');
        
        $alquilado= new Alquilado(); //creamos el alquiler
        
        //recupera los datos del formulario que llegan por POST
        $alquilado->idpiloto=intval($_POST['idpiloto']);
        
        $nombre=$_POST['nombre'];
        $coche=Coche::getByName($nombre);
        if (!$coche)
            throw new Exception("No se ha encontrado el coche con nombre $nombre");
        
        if (Alquilado::isCocheAlquilado($coche->id))
            throw new Exception("No se puede alquilar el coche $nombre, porque ya está alquilado...");
        $alquilado->idcoche=$coche->id;
         
        if (!$alquilado->guardar()) //guarda el alquiler  en la BDD
            throw new Exception("No se ha podido guardar el alquiler del coche  $coche->nombre");
            
        //redireccionamos a PilotoController::show($id);
        //para ver de nuevo los detalles del Modelo
        (new PilotoController())->show($alquilado->idpiloto);
                
    }
    
    //ELIMINAR SE HACE EN DOS PASOS
    // (si queremos hacerlo con formulario de confirmación)
    
    //PASO 1: muestra el formulario de confirmación de eliminación
    
    public function delete(int $id=0){
        //comprueba que me llega el identificador
        
        if (!$id)
            throw new Exception("No se indicó el alquiler a borrar.");
            
            //recupera la nave con dicho identificador
            $alquilado=Alquilado::getById($id);
            
            //comprueba que el alquiler existe
            if (!$alquilado)
                throw new Exception("No existe el alquiler  con id  $id.");
            
            //recupera el piloto para poder mostrar información
            $piloto=Piloto::getById($alquilado->idpiloto);
            //comprobación redundante , el modelo debe de existir
            if (!$piloto)
                throw new Exception("No existe el piloto del alquiler $id.");

            //ir al formulario de confirmación
            include Find::view('alquilado/borrar');
            
    }
    
    //PASO 2: elimina el alquiler
    public function destroy(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        //comprueba que llegue el formulario de confirmación
        if (empty($_POST[T_DELETE]))
            throw new Exception("No se recibió confirmación");
            
            $id= intval($_POST['id']); // recupera el id vía POST
            $idpiloto= intval($_POST['idpiloto']); // recupera el idmodelo vía POST
            
            // intenta borrar capitania de la BDD
            
            if (Alquilado::borrar($id)===false)
                throw new Exception("No se puede borrar.");
                
            //redireccionamos a ModeloController::show($id);
            (new PilotoController())->show($idpiloto);
    }
}