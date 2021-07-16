<?php
class Coche
{
    public $id=0,$idmodelo=0,$nombre='',$nserie='',$precio=0.0;
    
    //método para guardar una nave en la BDD
    public function guardar(){
        //guarda el nuevo cohce  en la BDD y actualiza el ID con el autonumércio
        //que se le ha asignado en la base de datos
        
        $this->id=DB::preInsert('coches', 'nombre,nserie,idmodelo,precio',"'$this->nombre','$this->nserie',$this->idmodelo,$this->precio");
        
        //retorna el id del nuevo coche(o false si falló la inserción)
        return $this->id;
    }
    
    
    //método para recuperar un array con todos los coches
    
    public static function get():array{
        return DB::preSelectAll('coches',self::class);
    }
    
    public static function getNames():array
    {
        $coches=self::get();
        if (!$coches){
            return NULL;
        }else{
            $out=[];
            foreach ($coches as $coche) {
                $out[$coche->nombre]=$coche->nombre;
            }
            return $out;
        }
    }
    
    //método para recuperar un coche a partir de su ID (null si no lo encuentra)
    public static function getById(int $id):?Coche{
        return DB::preSelect('coches',"id=$id",self::class);
    }
    
    //método para recuperar un coche a partir de su nombre (null si no lo encuentra)
    public static function getByName(string $name):?Coche{
        return DB::preSelect('coches',"nombre='$name'",self::class);
    }
    
    // método que borra el coche de la base de datos
    public static function borrar(int $id){
        //lanza la consulta y retorna el número de filas afectadas
        //o flase si hubo algún problema
        return DB::preDelete('coches', "id=$id");
    }
    
    //método que actualiza un coche en la BDD
    public function actualizar(){
        //lanza la consulta y retorna el número de filas afectadas
        //o false si hubo algún problema
        return DB::preUpdate('coches', 
            " nombre='$this->nombre',
                nserie='$this->nserie',
                precio=$this->precio",
            "id=$this->id");
    }
    
    public function __toString():string{
        return "Coche: $this->nombre , con numero de serie $this->nserie";
    }
}