<?php
class DB {
    //PROPIEDADES
    private static $conexion=null; //Contendrá la conexión de la BDD
    //$conexion es una propiedad estática privada por lo que no se puede ver desde fuera
    //de la clase. Sirve para garantizar una única conexión como máximo
    
    //METODOS
    //Metodo que conecta/recupera la conexión con la BDD
    public static function get():mysqli{
        if (!self::$conexion){//si no estábamos conectados...
            //conecta con la BDD
           
            self::$conexion=@new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            //Utilizamos las constantes del config.php para realizar la conexion
            //con la @ evitamos que salga algún warning en la página
            
            if (self::$conexion->connect_errno) //si se ha producido algún error...
                    throw new Exception('Error al conectar con la base de datos');
            
            self::$conexion->set_charset(DB_CHARSET); //Cargamos el CHARSET del archivo config.php        
        }
        return self::$conexion; //retorna la conexion
    }
    
    //Método para realizar consultas SELECT de una fila
    public static function select(string $consulta, string $class='stdClass'){
        $resultado=self::get()->query($consulta);
        $objeto=$resultado->fetch_object($class);
        $resultado->free();
        return $objeto;
    }
    
    //Método para realizar consultas SELECT de múltiples filas
    public static function selectAll(string $consulta, string $class='stdClass'):array {
        $resultados= self::get()->query($consulta);
        $objetos=[];
        
        while ($r=$resultados->fetch_object($class)) {
            $objetos[]=$r;
        }
        $resultados->free();
        return $objetos;
    }
    
    //Método que usa el método SelectAll pero ya tiene preformulada la consulta
    public static function preSelect(string $tabla,$condicion='',string $class='stdClass'){
        return self::select("SELECT * FROM $tabla WHERE ".$condicion,$class);
    }
    
    //Método que usa el método SelectAll pero ya tiene preformulada la consulta
    public static function preSelectAll(string $tabla,string $class='stdClass'):array{
        return self::selectAll("SELECT * FROM $tabla",$class);
    }
    
    //Método que usa el método SelectAll pero ya tiene preformulada la consulta
    public static function preSelectAllBy(string $tabla,string $condicion='',string $class='stdClass'):array{
        return self::selectAll("SELECT * FROM $tabla WHERE $condicion",$class);
    }
 
    
    
   
    
    //Método que usa el método SelectAll para realizar consultas especificando los campos que queremos que devuelva
    public static function selectColumns(string $tabla,string $columns,string $class='stdClass'):array{
        return self::selectAll("SELECT {$columns} FROM {$tabla}",$class);
    }
    
    //Método para realizar consultas INSERT
    //retorna el valor del ID autonumérico o false en caso de error
    public static function insert($consulta) {
        return self::get()->query($consulta)?self::get()->insert_id:false;
    }
    public static function preInsert($tabla,$campos,$valores){
        return self::insert("INSERT INTO $tabla($campos) VALUES($valores)");
    }
    //Método para realizar consultas UPDATE
    //retorna el número de filas afectadas o false en caso de error
    public static function update($consulta){
        return self::get()->query($consulta)?self::get()->affected_rows:false;
    }
    
    //Método que usa el metodo Update para realizar consultas
    //retorna el número de filas afectadas o false en caso de error
    public static function preUpdate($tabla, $campos,$condicion){
        return self::update("UPDATE $tabla SET $campos WHERE $condicion");
    }
    //Método para realizar consultas DELETE
    //retorna el número de filas afectadas o flase en caso de error
    public static function delete($consulta){
        return self::get()->query($consulta)?self::get()->affected_rows:false;
    }
    
    public static function preDelete($tabla,$condicion){
        return self::delete("DELETE FROM $tabla WHERE $condicion");
    }
    
    public static function sentenciasPreparadas(string $sql,string $mascara,$valor){
        $exec=true;
        $res=false;
        $expresion = self::get()->stmt_init();
        $expresion -> prepare($sql);
        $expresion->bind_param($mascara ,$valor);
        if (!$expresion -> execute())
        {
            $exec=false;
        }
        if ($resultados = $expresion -> get_result())
        {
            $res=true;
        }
        
        
        if ($exec && !$res)
        {
            return self::get()->affected_rows;
        }elseif ($exec && $res)
        {
            return $resultados;
        }else
        {
            return false;
        }
       
        $expresion->close();
    }
    
    
    
    
   
    
    public static function deleteBy(string $tabla,string $column,string $maskColumn,$valueColumn)
    {
        $sql="DELETE FROM $tabla WHERE {$column}=?";
        return self::sentenciasPreparadas($sql, $maskColumn, $valueColumn);     
    }
    
    public static function findByColumn(string $tabla,string $columns,string $nameColumn,string $maskColumn,$valueColumn):?array
    {
        $sql="SELECT {$columns} FROM {$tabla} WHERE {$nameColumn}=?";
        $resultados=self::sentenciasPreparadas($sql, $maskColumn, $valueColumn);
        
        $filas=[];
        if ($resultados->num_rows>0)
        {
            while($fila=$resultados->fetch_object("stdClass"))
            {
                $filas[]=$fila;
            }
            return $filas;
        }else
        {
            return NULL;
        }
    }
}