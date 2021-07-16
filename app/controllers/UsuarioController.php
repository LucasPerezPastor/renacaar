<?php
class UsuarioController{
    //propiedades privadas para el filtrado de Modelos
    private $valoresCampo=['usuario'=>'Usuario','nombre'=>'Nombre','apellido1'=>'Primer Apellido','apellido2'=>'Segundo Apellido','email'=>'Email'];
    private $valoresRadio=['ASC'=>'Ascendente','DESC'=>'Descendente'];
    
    //operacion por defecto
    public function index(){
        $this->list(); //redirige a la lista de usuarios
    }
    
    //operación para listar todos los usuarios
    public function list(){
        //recuperar la lista de usuarios
        
        $usuarios=Usuario::get();
        
        //cargar la vista que muestra el listado
        $campo='';
        $valor='';
        $orden='';
        $sentido='';
        $valoresCampo=$this->valoresCampo;
        $valoresRadio=$this->valoresRadio;
        
        include Find::view('usuario/lista'); 
    
    }
    
    //GUARDAR SE HACE EN DOS PASO
    
    //PASO 1: muestra el formulario de nuevo piloto
    public function create(){
        $admin=Login::isAdmin();
        include Find::view('usuario/nuevo'); 
    }
    
    //PASO 2: guarda el nuevo piloto
    public function store(){
        //Si no es adminitrador da un error.
        Login::checkAdmin();    
        
        //comprueba que llegue el formulario con los datos
        
        if (empty($_POST[T_SAVE]))
            throw new Exception('No se han recibido los datos');
            
            $usuario= new Usuario(); //creamos el piloto
            
            //recupera los datos del formulario que llegan por POST
            $usuario->usuario=$_POST['usuario'];
            $usuario->clave=md5($_POST['clave']);
            $usuario->nombre=$_POST['nombre'];
            $usuario->apellido1=$_POST['apellido1'];
            $usuario->apellido2=$_POST['apellido2'];
            $usuario->email=$_POST['email'];
            $usuario->privilegio=intval($_POST['privilegio']);
            if (Login::isAdmin()){
                $usuario->administrador=isset($_POST['administrador'])?1:0;
            }else{
                $usuario->administrador=0;
            }
            
           
            if (!$usuario->guardar()) //guarda el piloto en la BDD
                throw new Exception("No se ha podido guardar al usuario $usuario->nombre");
                
                $mensaje="Guradado del usuario $usuario->nombre correcto";
                include Find::view('general/exito'); 
                
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
        $usuarios=Usuario::getFiltered($campo,$valor,$orden,$sentido);
        
        //carga la vista del listado de Modelos
        $valoresCampo=$this->valoresCampo;
        $valoresRadio=$this->valoresRadio;
        include Find::view('usuario/lista'); 
    }
    
    //método para mostar los detalles de un usuario
    public function show(int $id=0){
        //comprobar que recibimos el id del modelo por parámetro
        if (!$id)
            throw new Exception("No se indicó el usuario.");
            
            //recuperar el modelo con dicho código
            $usuario=Usuario::getById($id);
            
            //comprobar que el modelo se haya recuperado correctamente de la BDD
            if (!$usuario)
                throw new Exception("No se ha encontrado el usuario $id.");

                //cargar la vista de detalles
                include Find::view('usuario/detalles'); 
                         
    }
    
    //ACTUALIZAR DE HACE EN DOS PASOS
    
    //PASO 1:  muestra el formulario de edición de un usuario
    public function edit(int $id=0){
        //comprueba que llega el id del modelo a editar
        
        if (!$id)
            throw new Exception("No se indicó el usuario.");
            
            //recupera el modelo con dicho identificador
            $usuario=Usuario::getById($id);
            
            //comprueba que el modelo se pudo recuperar de la BDD
            if (!$usuario)
                throw new Exception("No existe el usuario $id.");
                
                //carga la vista del formulario
                include Find::view('usuario/actualizar'); 

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
            
            //$usuario= new Usuario(); //usuario nuevo
            
            //$usuario->id=intval($_POST['id']); //recuperar el id vía POST
            
            //recupera el modelo con dicho identificador
            $usuario=Usuario::getById($_POST['id']);
            
            //comprueba que el modelo se pudo recuperar de la BDD
            if (!$usuario)
                throw new Exception("No existe el usuario $id.");
            
            //recuperar el resto de campos
            
            $usuario->usuario=$_POST['usuario'];
            $usuario->nombre=$_POST['nombre'];
            $usuario->apellido1=$_POST['apellido1'];
            $usuario->apellido2=$_POST['apellido2'];
            $usuario->clave=!empty($_POST['clave'])?md5($_POST['clave']):$usuario->clave;//Si no vienen valores se usa la clave anterior
            $usuario->privilegio=intval($_POST['privilegio']);
            $usuario->email=$_POST['email'];
            $usuario->administrador=isset($_POST['administrador'])?1:0;
            
           
            
            //intenta realizar la actualización de datos
            if ($usuario->actualizar()===false)
                throw new Exception("No se pudo actualizar $usuario->nombre");
                
                //prepara un mensaje
                //Si la variable global mensaje no existe la crea
                $GLOBALS['mensaje']="Actualización del usuario $usuario->nombre correcta.";
                
                //repite la operación edit,así mantendrá al usuario en la vista edición
                
                $this->edit($usuario->id);
                
                //NOTA 1: pongo $mensaje como global para no tener que pasarla al método edit
                //NOTA 2: debemos retocar la vista con el formulario para que se muestre el mensaje
                
    }
    
    //ELIMINAR SE HACE EN DOS PASOS
    // (si queremos hacerlo con formulario de confirmación)
    
    //PASO 1: muestra el formulario de confirmación de eliminación
    
    public function delete(int $id=0){
        //comprueba que me llega el identificador
        
        if (!$id)
            throw new Exception("No se indicó el usuario a borrar.");
            
            //recupera el modelo con dicho identificador
            $usuario=Usuario::getById($id);
            
            //comprueba que el libro existe
            if (!$usuario)
                throw new Exception("No existe el usuario $id.");
                
                //ir al formulario de confirmación
                include Find::view('usuario/borrar'); 
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
            
            // intenta borrar el modelo de la BDD
            
            if (Usuario::borrar($id)===false)
                throw new Exception("No se puede borrar.");
                
                // muestra la vista de éxito
                $mensaje="Borrado del usuario $id correcto.";
                include Find::view('genral/exito'); 
    }
}