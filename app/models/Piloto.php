<?php
class Piloto{
    //PROPIEDADES
    public $id=0, $nombre='',$apellidos='',$dni='',
    $nacimiento='',$telefono='',$email='';
    
    //CONSTANTES
    
    
    //método para recuperar un array con todos los pilotos.
    
    public static function get():array{
        return DB::preSelectAll('pilotos',self::class);
    }
    
    //método para recuperar un piloto a partir de su ID (null si no lo encuentra)
    public static function getById(int $id):?Piloto{
        return DB::preSelect('pilotos',"id=$id",self::class);
    }
    
    //método para guardar un nuevo piloto en la BDD
    public function guardar(){
         //guarda el nuevo piloto en la BDD y actualiza el ID con el autonumércio
        //que se le ha asignado en la base de datos

        $this->id=DB::preInsert('pilotos', 
            "nombre,apellidos,dni,nacimiento,telefono,email", 
            "'$this->nombre','$this->apellidos','$this->dni','$this->nacimiento','$this->telefono','$this->email'");
        //retorna el id del nuevo libro(o flase si falló la inserción)
        return $this->id;
    }
    
    //método que actualiza un piloto en la BDD
    public function actualizar(){
        //lanza la consulta y retorna el número de filas afectadas
        //o false si hubo algún problema
        return DB::preUpdate('pilotos', 
            "nombre='$this->nombre',
           apellidos='$this->apellidos',
            dni='$this->dni',
            nacimiento='$this->nacimiento',
            telefono='$this->telefono',
            email='$this->email'
            ", "id=$this->id");
        return DB::update($consulta);
    }
    
    // método que borra un piloto de la base de datos
    public static function borrar(int $id){
        //lanza la consulta y retorna el número de filas afectadas
        //o flase si hubo algún problema 
        return DB::preDelete('pilotos', "id=$id");
    }
    
    //recuperar pilotos con un filtro avanzado
    public static function getFiltered(string $campo='titulo', string $valor='',
        string $orden='id', string $sentido='ASC'):array{
            
            $consulta="SELECT *
                            FROM pilotos
                            WHERE $campo
                            LIKE '%$valor%'
                            ORDER BY $orden $sentido";
            
            return DB::selectAll($consulta,self::class);
    }
    
    //método que me permite recuperar los alquileres de la que es conductor
    public function getAlquilados(){
      
        return DB::preSelectAllBy('alquilados',"idpiloto=$this->id",'Alquilado');
    }
    
    //el método __toString, lo usaremos principalmente en test
    public function __toString():string{
        return "Conductor: $this->nombre $this->apellidos , telefono : $this->telefono";
    }
}
