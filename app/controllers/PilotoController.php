<?php
//CONTROLADOR PilotoController
class PilotoController{
    
    //propiedades privadas para el filtrado de Modelos
    
    private $valoresCampo=['nombre'=>'Nombre','dni'=>'D.N.I.','email'=>'Email','telefono'=>'Telefono','apellidos'=>'Apellidos','nacimiento'=>'Fecha de nacimiento'];
    private $valoresRadio=['ASC'=>'Ascendente','DESC'=>'Descendente'];
    
    //operacion por defecto
    public function index(){
        $this->list(); //redirige a la lista de pilotos
    }
    
    //operación para listar todos los pilotos
    public function list(){
        //recuperar la lista de pilotos
        
        $pilotos=Piloto::get();
        
        //cargar la vista que muestra el listado
        $campo='';
        $valor='';
        $orden='';
        $sentido='';
        $valoresCampo=$this->valoresCampo;
        $valoresRadio=$this->valoresRadio;
        include Find::view('piloto/lista');

    }
    
    //GUARDAR SE HACE EN DOS PASO
     
    //PASO 1: muestra el formulario de nuevo piloto
    public function create(){
        include Find::view('piloto/nuevo');
    }
    
    //PASO 2: guarda el nuevo piloto
    public function store(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario con los datos
        
        if (empty($_POST[T_SAVE]))
            throw new Exception('No se han recibido los datos');
        
       $piloto= new Piloto(); //creamos el piloto
       
       //recupera los datos del formulario que llegan por POST
       $piloto->nombre=$_POST['nombre'];
       $piloto->apellidos=$_POST['apellidos'];
       $piloto->dni=$_POST['dni'];
       $piloto->email=$_POST['email'];
       $piloto->telefono=$_POST['telefono'];
       $piloto->nacimiento=$_POST['nacimiento'];
       
       if (!$piloto->guardar()) //guarda el piloto en la BDD
                    throw new Exception("No se ha podido guardar al piloto $piloto->nombre");
        
        $mensaje="Gurdado del conductor $piloto->nombre correcto";
        include Find::view('general/exito');//muestra la vista de éxito

        
    }
    
    //método para mostar los detalles de un piloto
    public function show(int $id=0){
        //comprobar que recibimos el id del piloto por parámetro
        if (!$id)
                throw new Exception("No se indicó el piloto.");
        
       //recuperar el piloto con dicho código
       $piloto=Piloto::getById($id);
       
       //comprobar que el piloto se haya recuperado correctamente de la BDD
       if (!$piloto)
           throw new Exception("No se ha encontrado el piloto $id.");
       
       $alquilados=$piloto->getAlquilados();// recuperamos los alquileres
       $cochesAlquilados=[];
       foreach ($alquilados as $alquilado) {
           $coche=Coche::getById($alquilado->idcoche);
           If (!$coche)
               throw new Exception('Error al recuperar los coches alquilados.');
           
           $cochesAlquilados[]=['nombre'=>$coche->nombre,'nserie'=>$coche->nserie,'idalquiler'=>$alquilado->id,'idcoche'=>$alquilado->idcoche];
           
       }
           
       //cargar la vista de detalles
       include Find::view('piloto/detalles');
         
    }
    
    //ACTUALIZAR DE HACE EN DOS PASOS
    
    //PASO 1:  muestra el formulario de edición de un piloto
    public function edit(int $id=0){
        //comprueba que llega el id del piloto a editar
        
        if (!$id)
            throw new Exception("No se indicó el piloto");
        
        //recupera el piloto con dicho identificador
        $piloto=Piloto::getById($id);
        
        //comprueba que el piloto se pudo recuperar de la BDD
        if (!$piloto)
            throw new Exception("No existe el piloto $id.");
        
        //carga la vista del formulario
        include Find::view('piloto/actualizar');
       
    }
    
    //PASO 2: aplica los cambios al piloto
    
    public function update() {
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        //comprueba que llegue el formulario con los datos
        if (empty($_POST[T_UPDATE]))
            throw new Exception('No se recibieron datos');
        
        //podemos crear un nuevo piloto o recuperar el de la BDD,
        // optamoss por crear uno nuevo para ahorrar una consulta.
        
        $piloto= new Piloto(); //piloto nuevo
        
        $piloto->id=intval($_POST['id']); //recuperar el id vía POST
        
        //recuperar el resto de campos
        
        $piloto->nombre=$_POST['nombre'];
        $piloto->apellidos=$_POST['apellidos'];
        $piloto->dni=$_POST['dni'];
        $piloto->email=$_POST['email'];
        $piloto->telefono=$_POST['telefono'];
        $piloto->nacimiento=$_POST['nacimiento'];
        

        
        //intenta realizar la actualización de datos
        if ($piloto->actualizar()===false)
            throw new Exception("No se pudo actualizar $piloto->nombre");
        
        //prepara un mensaje
       //Si la variable global mensaje no existe la crea 
       $GLOBALS['mensaje']="Actualización del piloto $piloto->nombre correcta.";
            
        //repite la operación edit,así mantendrá al usuario en la vista edición
        
       $this->edit($piloto->id);
       
       //NOTA 1: pongo $mensaje como global para no tener que pasarla al método edit
       //NOTA 2: debemos retocar la vista con el formulario para que se muestre el mensaje
     
    }
    
    //ELIMINAR SE HACE EN DOS PASOS
    // (si queremos hacerlo con formulario de confirmación)
    
    //PASO 1: muestra el formulario de confirmación de eliminación
    
    public function delete(int $id=0){
        //comprueba que me llega el identificador
        
        if (!$id)
            throw new Exception("No se indicó el piloto a borrar.");
        
        //recupera el piloto con dicho identificador
        $piloto=Piloto::getById($id);
        
        //comprueba que el libro existe
        if (!$piloto)
            throw new Exception("No existe el piloto $id.");
        
        //ir al formulario de confirmación
        include Find::view('piloto/borrar');
    }
    
    //PASO 2: elimina el piloto
    public function destroy(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        //comprueba que llegue el formulario de confirmación
        if (empty($_POST[T_DELETE]))
            throw new Exception("No se recibió confirmación");
        
        // recupera el identificador vía POST
        
        $id= intval($_POST['id']);
        
        // Miramos si tiene alquileres pendientes
        if(Alquilado::isConductorAlquilado($id))
            throw new Exception("No se puede dar de baja al conductor , porque tiene alquileres pendientes.");
            
        
        // intenta borrar el piloto de la BDD
        
        if (Piloto::borrar($id)===false)
            throw new Exception("No se puede borrar.");
        
        // muestra la vista de éxito
        $mensaje="Borrado del piloto $id correcto.";
        include Find::view('general/exito');//muestra la vista de éxito
    }
    
    
    public function search()
    {
        if (empty($_POST[T_SEARCH])){   //si no llega el formulario
            $this->list();                              //redirige a la lista de modelos
            return;                                     // sale del método (sin dar errores)
        }
        
        //toma los valores que llegan del formulario de búqueda
        $campo=$_POST['campo'];
        $valor=$_POST['valor'];
        $orden=$_POST['orden'];
        $sentido=empty($_POST['sentido'])?'ASC':$_POST['sentido'];
        
        //recupera la lista de modelos con el filtro aplicado
        $pilotos=Piloto::getFiltered($campo,$valor,$orden,$sentido);
        
        //carga la vista del listado de Pilotos
        $valoresCampo=$this->valoresCampo;
        $valoresRadio=$this->valoresRadio;
        include Find::view('piloto/lista');
    }
}