<?php
//<M> 
//×-
//@-MODULÉV   : BAREBONE_02 - /BAREBONE_02/PHP/APP/DB_HANDLER.php -@
//@-SZERZŐ    : AX07057-@
//@-LÉTREHOZVA: 2020-06-20 -@
//@-FÜGGŐSÉGEK:
//×-
// @-- /BAREBONE_02/PHP/APP/PHP_CONSTS.php-@
//-×
//-@
//@-LEÍRÁS    :<br/>
// Database handling through its own class.<br/>
//@-MÓDOSÍTÁSOK :
//×-
// @-- 2099-12-31
// -@
// @-- ... -@
//-×
//-×
//</M>

    include_once($_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/PHP_CONSTS.php');

class DB_HANDLER{
    

    private $con_obj;

    public function __construct($hst = DBHOST, $usr = DBUSR,$pwd=DBPASS,$db = DBNAME){
        //<SF>
        //LÉTREHOZVA: 2020-06-20 <br/>
        //SZERZÓ: AX07057 <br/>
        //LEÍRÁS: Basic constructor, to set standard connection. <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @param = ... -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        $this->my = mysqli_connect($hst,$usr,$pwd,$db);
		if(!$this->con_obj){
			$msg = "<p class=\"bg-danger\">";
			$msg .= "Az adatadbázis csatlakozás sikertelen<br>";
			$msg .= "A hiba leírása:<br><code>";
			$msg .= mysqli_error($this->con_obj) . "</code><br></p>";
			return $msg;
		}
    }

    public function get_Conn(){
        //<SF>
        //LÉTREHOZVA: 2020-06-20 <br/>
        //SZERZÓ: AX07057 <br/>
        //LEÍRÁS: Standard getter for the connection object of the class. <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @param = ... -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        return $this->con_obj;
    }

}

?>