<?php
class Alquilado{
    public $id=0,$idpiloto=0,$idcoche=0;
    
    //método para guardar un alquiler en la BDD
    public function guardar(){
        //guarda el nuevo alquiler  en la BDD y actualiza el ID con el autonumércio
        //que se le ha asignado en la base de datos
        
        $this->id=DB::preInsert('alquilados','idpiloto,idcoche',"$this->idpiloto,$this->idcoche");
        
        //retorna el id del nuevo alquiler(o false si falló la inserción)
        return $this->id;
    }
    
    
    //método para recuperar un array con todos los alquileres.
    
    public static function get():array{
        return DB::preSelectAll('alquilados',self::class);
    }
    
    //método para recuperar un alquiler partir de su ID (null si no lo encuentra)
    public static function getById(int $id):?Alquilado{
        return DB::preSelect('alquilados',"id=$id",self::class);
    }
    
    // método que borra un alquiler de la base de datos
    public static function borrar(int $id){
        //lanza la consulta y retorna el número de filas afectadas
        //o flase si hubo algún problema
        return DB::preDelete('alquilados',"id=$id");
    }
    
    public static function isCocheAlquilado($idCoche):bool
    {
       $alquilado=DB::preSelect('alquilados',"idcoche=$idCoche",self::class);
       return (!$alquilado)?false:true;
    }
    
    
    public static function isConductorAlquilado($idConductor):bool
    {
        $alquilado=DB::preSelect('alquilados',"idpiloto=$idConductor",self::class);
        return (!$alquilado)?false:true;
    }
    public function __toString():string{
        //Vamos a buscar el nombre del piloto que es el condcutor del coche
        $piloto=Piloto::getById($this->idpiloto);
        //Vamos a buscar el nombre del coche alquilado
        //comprobar que el piloto se haya recuperado correctamente de la BDD
        if (!$piloto)
            throw new Exception("No se ha encontrado el conductor $id.");
        $coche=Coche::getById($this->idcoche);
        //comprobar que la nave se haya recuperado correctamente de la BDD
        if (!$coche)
            throw new Exception("No se ha encontrado el coche $id.");
        
        return "Conductor: $piloto->nombre , del coche $coche->nombre";
    }
}