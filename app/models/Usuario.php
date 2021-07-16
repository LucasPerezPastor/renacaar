<?php
//Clase Usuario del modelo
class Usuario{
    //PROPIEDADES
    public $id=0,$usuario='',$clave='',$nombre='',$apellido1='',
                $apellido2='',$privilegio=0,$administrador=0,$email='',
                $created='',$updated='';
    
    //Método que usaremos para comprobar el login.
    //Permitiremos la identificación por email o usuario.
    //Si la identificación es correcta retorna el usuario, en caso contrario NULL.
    
    public static function identificar(string $u='',string $p=''):?Usuario{
        return DB::preSelect('usuarios',"(usuario='$u' OR email='$u') AND  clave='$p'",self::class);
    }
    
    //METODOS DEL CRUD
    
    //registrar un nuevo usuario
    public function guardar(){
        return DB::preInsert('usuarios',"usuario,clave,nombre,apellido1,apellido2,
                                        privilegio,administrador,email","'$this->usuario','$this->clave','$this->nombre',
                                '$this->apellido1','$this->apellido2',
                                $this->privilegio,$this->administrador,'$this->email'"); //conectar y ejecutar
    }
     
    //método para recuperar un array con todos los usuarios.
    
    public static function get():array{
        return DB::preSelectAll('usuarios',self::class);
    }
    
    //método para recuperar un usuario a partir de su ID (null si no lo encuentra)
    public static function getById(int $id):?Usuario{
        return DB::preSelect('usuarios',"id=$id",self::class);
    }
    
    //recuperar modelos con un filtro avanzado
    public static function getFiltered(string $campo='user', string $valor='',
        string $orden='id', string $sentido='ASC'):array{
            
            $consulta="SELECT *
                            FROM usuarios
                            WHERE $campo
                            LIKE '%$valor%'
                            ORDER BY $orden $sentido";
            
            return DB::selectAll($consulta,self::class);
    }
    
    //método que actualiza un usuario en la BDD
    public function actualizar(){
        //lanza la consulta y retorna el número de filas afectadas
        //o false si hubo algún problema
        
        return DB::preUpdate('usuarios',"clave='$this->clave',
                            nombre='$this->nombre',
                            apellido1='$this->apellido1',
                            apellido2='$this->apellido2',
                            privilegio=$this->privilegio,
                            administrador=$this->administrador,
                            email='$this->email'","id=$this->id");
    }
    
    // método que borra un usuario de la base de datos
    public static function borrar(int $id){
        //lanza la consulta y retorna el número de filas afectadas
        //o flase si hubo algún problema
        return DB::preDelete('usuarios',"id=$id");
    }
    
    //recupera un usuario a partir de usuario+email
    //se usará para el proceso de "olvidé mi clave"
    public static function getByUserMail(string $u,string $e):?Usuario{
       return DB::preSelect('usuarios',"usuario='$u' AND email='$e'",self::class);
    }
    
    //__toString
    public function __toString():string{
        return "$this->id: $this->usuario ($this->email) $this->nombre $this->apellido1,$this->apellido2";
    }
}