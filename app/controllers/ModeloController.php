<?php
//CONTROLADOR ModeloController
class ModeloController{
    
    //propiedades privadas para el filtrado de Modelos
    private $valoresCampo=['nombre'=>'Nombre','descripcion'=>'Descripcion','velocidad'=>'velocidad','tipo'=>'Tipo','peso'=>'Peso'];
    private $valoresRadio=['ASC'=>'Ascendente','DESC'=>'Descendente'];
    
    //operacion por defecto
    public function index(){
        $this->list(); //redirige a la lista de libros
    }
    
    //operación para listar todos los modelos
    public function list(){
        //recuperar la lista de modelos
        
        $modelos=Modelo::get();
        
        //cargar la vista que muestra el listado
        $campo='';
        $valor='';
        $orden='';
        $sentido='';
        $valoresCampo=$this->valoresCampo;
        $valoresRadio=$this->valoresRadio;
        
        include Find::view('modelo/lista'); 
    }
    
    //GUARDAR SE HACE EN DOS PASO
     
    //PASO 1: muestra el formulario de nuevo modelo
    public function create(){
        include Find::view('modelo/nuevo');
    }
    
    //PASO 2: guarda el nuevo modelo
    public function store(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario con los datos
        
        if (empty($_POST[T_SAVE]))
            throw new Exception('No se han recibido los datos');
        
       $modelo= new Modelo(); //creamos el modelo
       
       //recupera los datos del formulario que llegan por POST
       $modelo->nombre=$_POST['nombre'];
       $modelo->descripcion=$_POST['descripcion'];
       $modelo->peso=intval($_POST['peso']);
       $modelo->velocidad=intval($_POST['velocidad']);
       
       
       if (!$modelo->guardar()) //guarda el modelo en la BDD
                    throw new Exception("No se ha podido guardar el modelo de coche $modelo->nombre");
        
        $mensaje="Guardado del modelo de coche $modelo->nombre correcto";
        include Find::view('general/exito');//muestra la vista de éxito
        
    }
    
    //método para mostar los detalles de un modelo
    public function show(int $id=0){
        //comprobar que recibimos el id del modelo por parámetro
        if (!$id)
                throw new Exception("No se indicó el modelo.");
        
       //recuperar el modelo con dicho código
       $modelo=Modelo::getById($id);
       
       //comprobar que el modelo se haya recuperado correctamente de la BDD
       if (!$modelo)
           throw new Exception("No se ha encontrado el modelo $id.");
       
        $coches= $modelo->getModelos();// recuperamos los modelos de coches
       
       //cargar la vista de detalles
        include Find::view('modelo/detalles');
         
    }
    
    //ACTUALIZAR DE HACE EN DOS PASOS
    
    //PASO 1:  muestra el formulario de edición de un modelo
    public function edit(int $id=0){
        //comprueba que llega el id del modelo a editar
        
        if (!$id)
            throw new Exception("No se indicó el modelo de coche.");
        
        //recupera el modelo con dicho identificador
        $modelo=Modelo::getById($id);
        
        //comprueba que el modelo se pudo recuperar de la BDD
        if (!$modelo)
            throw new Exception("No existe el modelo de coche $id.");
        
        //carga la vista del formulario
            include Find::view('modelo/actualizar');
    }
    
    //PASO 2: aplica los cambios al modelo
    
    public function update() {
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario con los datos
        if (empty($_POST[T_UPDATE]))
            throw new Exception('No se recibieron datos');
        
        //podemos crear un nuevo modelo o recuperar el de la BDD,
        // optamoss por crear uno nuevo para ahorrar una consulta.
        
        $modelo= new Modelo(); //modelo nuevo
        
        $modelo->id=intval($_POST['id']); //recuperar el id vía POST
        
        //recuperar el resto de campos
        
        $modelo->nombre=$_POST['nombre'];
        $modelo->peso=intval($_POST['peso']);
        $modelo->velocidad=intval($_POST['velocidad']);
        $modelo->descripcion=$_POST['descripcion'];
        
        //intenta realizar la actualización de datos
        if ($modelo->actualizar()===false)
            throw new Exception("No se pudo actualizar $modelo->nombre");
        
        //prepara un mensaje
       //Si la variable global mensaje no existe la crea 
       $GLOBALS['mensaje']="Actualización del modelo $modelo->nombre correcta.";
            
        //repite la operación edit,así mantendrá al usuario en la vista edición
        
       $this->edit($modelo->id);
       
       //NOTA 1: pongo $mensaje como global para no tener que pasarla al método edit
       //NOTA 2: debemos retocar la vista con el formulario para que se muestre el mensaje
     
    }
    
    //ELIMINAR SE HACE EN DOS PASOS
    // (si queremos hacerlo con formulario de confirmación)
    
    //PASO 1: muestra el formulario de confirmación de eliminación
    
    public function delete(int $id=0){
        //comprueba que me llega el identificador
        
        if (!$id)
            throw new Exception("No se indicó el modelo a borrar.");
        
        //recupera el modelo con dicho identificador
        $modelo=Modelo::getById($id);
        
        //comprueba que el libro existe
        if (!$modelo)
            throw new Exception("No existe el modelo $id.");
        
        //ir al formulario de confirmación
        
            include Find::view('modelo/borrar');
    }
    
    //PASO 2: elimina el modelo
    public function destroy(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario de confirmación
        if (empty($_POST[T_DELETE]))
            throw new Exception("No se recibió confirmación");
        
        // recupera el identificador vía POST
        
        $id= intval($_POST['id']);
        
        //recuperar el modelo con dicho código
        $modelo=Modelo::getById($id); 
        //comprobar que el modelo se haya recuperado correctamente de la BDD
        if (!$modelo)
            throw new Exception("No se ha encontrado el modelo $id.");
        
        // Buscamos los coches de este modelo
        $coches= $modelo->getModelos();// recuperamos coches del modelo
        foreach ($coches as $coche) {
                //Si el coche está alquilado no podemos dar de baja el modelo de coche
                if (Alquilado::isCocheAlquilado($coche->id))
                    throw new Exception('Existen coches de este modelo en alquiler, debes darlos de baja antes de borrar el modelo.');
        }
        
        // intenta borrar el modelo de la BDD
        
        if (Modelo::borrar($id)===false)
            throw new Exception("No se puede borrar.");
        
        // muestra la vista de éxito
        $mensaje="Borrado del modelo $id correcto.";
        include Find::view('general/exito'); //mostrar el éxito de la operación
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
        $modelos=Modelo::getFiltered($campo,$valor,$orden,$sentido);
        
        //carga la vista del listado de Modelos
       $valoresCampo=$this->valoresCampo;
       $valoresRadio=$this->valoresRadio;
       require_once Find::view('modelo/lista');
    }
}