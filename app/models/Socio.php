<?php
class Socio
{
    
    const TABLA=self::class.'s';//'Socios';
    const RANGO_SUP=9; 
    //PROPIEDADES
    public $id=0,$nick='',$pass='',$rango=1,$saldo=0;
    
    
    public function __construct(string $nick,string $pass,int $rango,int $saldo)
    {
        $this->nick=$nick;
        $this->pass=$pass;
        $this->rango=$rango;
        $this->saldo=$saldo;
    }
    
    /**
     *
     * Función que devuelve los campos nick y pass de una tabla en un array de objetos de la clase especificada.
     * Si hubiera algún error devolvería un array vacío.
     *
     * @param string $nameClass nombre de la clase en el que queremos devolver los datos si no se especifica sera una clase standar.
     * @return array            devuelve un array con los registros de la clase especificada o vacio si no hay registros.
     */
    function searchAllNickPass(string $nameClass='stdClass'):array
    {        
        return DB::selectColumns(srttolower(self::TABLA), "nick,pass");
        
    }
    
    /**
     *
     * Función que devuelve True si el usuario "$name" y el password "$pass" coincide con alguno de los registros de la BDD.
     *
     * @param string $name          Nombre del usuario a buscar
     * @param string $pass          Password del usuario a buscar
     * @return bool                 True si el usuario y contraseña coinciden con alguno de la BDD
     */
    static public function testUser(string $name,string $pass):bool
    { 
        //Asumimos que solo puede haber un usuario con un nombr eúnico en la base de datos.
        //Si hubiera más de uno sería un error.
        $socio=Socio::findUser($name);
        if ($socio<>NULL)
        {
            if (Security::verifyHash($pass,$socio->pass))
            {
                return true;
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }
    }
    
    public static function isInRange(string $user,int $rango):?string
    {
        $usuario=Socio::findUser($user);
        if ($usuario==NULL)
        {
            return NULL;
        }else
        {
            if ($usuario->rango<$rango)
            {
                return "D";
            }elseif ($usuario->rango==$rango)
                {
                    return "E";
                }elseif ($usuario->rango>$rango)
                    {
                        return "U";
                    }
                }  
    }
    
    static public function existUser(string $name):bool
    {
        
        if (Socio::findUser($name)<>NULL)
        {
            return true;
        }else
        {
            return false;
        }
    }
    
    static public function delete(int $id)
    {
        return DB::deleteBy(self::TABLA,'id','i',$id);   
    }
    static public function findUser(string $name):?Socio
    {
        $usuarios= DB::findByColumn(strtolower(self::TABLA), '*', 'nick','s',$name);
        If ($usuarios<>NULL && sizeOf($usuarios)==1)
        {
            //Asumimos que solo puede haber un usuario con un nombre único en la base de datos.
            //Si hubiera más de uno sería un error.
            
            return new Socio($usuarios[0]->nick,$usuarios[0]->pass,$usuarios[0]->rango,$usuarios[0]->saldo);    
        }else
        {
            return NULL;
        }
    }
    
    static function listado():?array
    {
        return DB::preSelectALL(self::TABLA);
    }
    
    public function guardar(){
        $sql="INSERT INTO socios (nick,pass,rango,saldo) VALUES (?,?,?,?)";
        $expresion = DB::get()->stmt_init();
        $expresion -> prepare($sql);
        $tmpPass=Security::hashDefault($this->pass);
        $expresion->bind_param("ssii" ,$this->nick,$tmpPass,$this->rango,$this->saldo);
        return ($expresion -> execute())?DB::get()->insert_id:false;
    }
    
    public function modifySaldo(int $value)
    {
        if ($this->saldo + $value <=0)
        {
            $this->saldo=0;
            $resultado=DB::preUpdate(self::TABLA, 'saldo='.$this->saldo, "nick='{$this->nick}'");
            throw new Exception('Te has quedado sin saldo, no puedes seguir jugando...');
            /*grabar saldo*/
            /*mensaje de error ya no puedes seguir jugando*/
        }else
        {
            $this->saldo+=$value;
            $resultado=DB::preUpdate(self::TABLA, 'saldo='.$this->saldo, "nick='{$this->nick}'");
         /*grabar saldo*/   
        }       
        return $resultado;
    }
}