<?php
//CONTROLADOR CocheController

class CocheController{
    public function create(int $idModelo=0){
        //recuperamos la información del modelo del coche
        $modelo= Modelo::getById($idModelo);
        
        //si no hay modelo del coche...
        if (!$modelo)
            throw new Exception("No se ha encontrado el modelo de coche");
            
            //carga la vista  para crear coches
            include Find::view('coche/nuevo'); 
    }
    
    //guarda un coche
    public function store(){
        //comprueba que llegue el formulario con los datos
        
        if (empty($_POST[T_SAVE]))
            throw new Exception('No se han recibido los datos');
        
       //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
            $coche= new Coche(); //creamos la nave
            
            //recupera los datos del formulario que llegan por POST
            $coche->idmodelo=intval($_POST['idmodelo']);
            $coche->nombre=$_POST['nombre'];
            $coche->nserie=$_POST['nserie'];
            $coche->precio=floatval($_POST['precio']);
            
            
            if (!$coche->guardar()) //guarda la nave en la BDD
                throw new Exception("No se ha podido guardar el coche $nave->nombre");
                
                //redireccionamos a ModeloController::show($id);
                //para ver de nuevo los detalles del Modelo
                (new ModeloController())->show($coche->idmodelo);
                
    }
    
    //ELIMINAR SE HACE EN DOS PASOS
    // (si queremos hacerlo con formulario de confirmación)
    
    //PASO 1: muestra el formulario de confirmación de eliminación
    
    public function delete(int $id=0){
        //comprueba que me llega el identificador
        
        if (!$id)
            throw new Exception("No se indicó el coche a borrar.");
            
            //recupera la nave con dicho identificador
            $coche=Coche::getById($id);
            
            //comprueba que el coche exista
            if (!$coche)
                throw new Exception("No existe el coche $id.");
                
                //recupera el modelo de nace para poder mostrar información
                $modelo=Modelo::getById($coche->idmodelo);
                //comprobación redundante , el modelo debe de existir
                if (!$modelo)
                    throw new Exception("No existe el modelo de coche $id.");
                    
                    //ir al formulario de confirmación
                    include Find::view('coche/borrar'); 
                 
    }
    
    //PASO 2: elimina el coche
    public function destroy(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario de confirmación
        if (empty($_POST[T_DELETE]))
            throw new Exception("No se recibió confirmación");
            
            $id= intval($_POST['id']); // recupera el id vía POST
            $idmodelo= intval($_POST['idmodelo']); // recupera el idmodelo vía POST
            
            //Si el coche está alquilado no podemos darlo de baja
            if (Alquilado::isCocheAlquilado($id))
                throw new Exception('Este coche está en alquiler, debes dar de baja el alquiler antes de borrarlo.');
            
            // intenta borrar el coche de la BDD
            
            if (Coche::borrar($id)===false)
                throw new Exception("No se puede borrar.");
                
                //redireccionamos a ModeloController::show($id);
                (new ModeloController())->show($idmodelo);
    }
    
    //ACTUALIZAR DE HACE EN DOS PASOS
    
    //PASO 1:  muestra el formulario de edición de un modelo
    public function edit(int $id=0){
        //comprueba que llega el id del coche a editar
        
        if (!$id)
            throw new Exception("No se indicó el coche.");
            
            //recupera la nave con dicho identificador
            $coche=Coche::getById($id);
            
            //comprueba que la nave se pudo recuperar de la BDD
            if (!$coche)
                throw new Exception("No existe el coche $id.");
                
                //recupera el modelo de nave para poder mostrar información
                $modelo=Modelo::getById($coche->idmodelo);
                //comprobación redundante , el modelo debe de existir
                if (!$modelo)
                    throw new Exception("No existe el modelo de coche $id.");
                    
                    //carga la vista del formulario
                    include Find::view('coche/actualizar'); 
              
    }
    
    //PASO 2: aplica los cambios al modelo
    
    public function update() {
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario con los datos
        if (empty($_POST[T_UPDATE]))
            throw new Exception('No se recibieron datos');
            
            //podemos crear un nuevo coche o recuperar el de la BDD,
            // optamoss por crear uno nuevo para ahorrar una consulta.
            
            $coche= new Coche(); //coche nuevo
            
            $coche->id=intval($_POST['id']); //recuperar el id vía POST
            
            //recuperar el resto de campos
            $idmodelo=intval($_POST['idmodelo']); //recuperar el idmodelo vía POST
            $coche->idmodelo=$idmodelo;
            $coche->nombre=$_POST['nombre'];
            $coche->nserie=$_POST['nserie'];
            $coche->precio=floatval($_POST['precio']);
            
            //intenta realizar la actualización de datos
            if ($coche->actualizar()===false)
                throw new Exception("No se pudo actualizar $nave->nombre");
                
                //redireccionamos a ModeloController::show($id);
                (new ModeloController())->show($idmodelo);
                
    }
    
    //método para mostar los detalles de un coche
    public function show(int $id=0){
        //comprobar que recibimos el id del nave por parámetro
        if (!$id)
            throw new Exception("No se indicó el coche.");
            
            //recuperar el modelo con dicho código
            $coche=Coche::getById($id);
            
            //comprobar que el coche se haya recuperado correctamente de la BDD
            if (!$coche)
                throw new Exception("No se ha encontrado el coche $id.");
                
                //recupera el modelo de coche para poder mostrar información
                $modelo=Modelo::getById($coche->idmodelo);
                //comprobación redundante , el modelo debe de existir
                if (!$modelo)
                    throw new Exception("No existe el modelo de coche $id.");
                    
                    
                    //cargar la vista de detalles
                    include Find::view('coche/detalles'); 
                 
                    
    }
}