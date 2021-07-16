<?php
class Modelo{
    //PROPIEDADES
    public $id=0, $nombre='',$descripcion='',$peso=0,
    $velocidad=0;
    
    //CONSTANTES
    
    
    //método para recuperar un array con todos los modelos.
    
    public static function get():array{
        $consulta="SELECT * FROM modelos";
        return DB::selectAll($consulta,self::class);
    }
    
    //método para recuperar un modelo a partir de su ID (null si no lo encuentra)
    public static function getById(int $id):?Modelo{
        $consulta="SELECT * FROM modelos WHERE id=$id";
        return DB::select($consulta,self::class);
    }
    
    //método para guardar un nuevo modelo en la BDD
    public function guardar(){

        $this->id=DB::preinsert('modelos','nombre,descripcion,peso,velocidad',"'$this->nombre','$this->descripcion',$this->peso,$this->velocidad");
        //retorna el id del nuevo libro(o flase si falló la inserción)
        return $this->id;
    }
    
    //método que actualiza un modelo en la BDD
    public function actualizar(){
       
        //lanza la consulta y retorna el número de filas afectadas
        //o false si hubo algún problema
        
        return DB::preUpdate('modelos', 
                "nombre='$this->nombre',
                descripcion='$this->descripcion',
                peso=$this->peso,
                velocidad=$this->velocidad", 
                "id=$this->id");
    }
    
    // método que borra un modelo de la base de datos
    public static function borrar(int $id){
        //prepara la consulta
        $consulta="DELETE FROM modelos WHERE id=$id";
        
        //lanza la consulta y retorna el número de filas afectadas
        //o flase si hubo algún problema
        
        return DB::delete($consulta);
    }
    
    //recuperar modelos con un filtro avanzado
    public static function getFiltered(string $campo='titulo', string $valor='',
        string $orden='id', string $sentido='ASC'):array{
            
            $consulta="SELECT *
                            FROM modelos
                            WHERE $campo
                            LIKE '%$valor%'
                            ORDER BY $orden $sentido";
            
            return DB::selectAll($consulta,self::class);
    }
    
    //método que me permite recuperar las naves de un modelo de nave
    public function getModelos():array{
        $consulta="SELECT * FROM coches WHERE idmodelo=$this->id";
        
        return DB::selectAll($consulta,'Coche');
    }
    
    //el método __toString, lo usaremos principalmente en test
    public function __toString():string{
        return "Modelo: $this->nombre , tipo: $this->tipo";
    }
}