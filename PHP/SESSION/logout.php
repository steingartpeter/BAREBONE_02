<?php
//<M> 
//×-
//@-MODULÉV   : BAREBONE_02 - /BAREBONE_02/PHP/SESSION/logout.php -@
//@-SZERZŐ    : AX07057-@
//@-LÉTREHOZVA: 2020-06-20 -@
//@-FÜGGŐSÉGEK:
//×-
// @-- NO DEPENDENCY-@
//-×
//-@
//@-LEÍRÁS    :<br/>
//Description of the whole files functionality ...<br/>
//@-MÓDOSÍTÁSOK :
//×-
// @-- 2099-12-31
// -@
// @-- ... -@
//-×
//-×
//</M>
    //<nn>
    // If there is no session, create one, to avoid stop.
    //</nn>
    session_start();
    
    //<nn>
    // If we had a session, we emptying it.
    //</nn>
    $_SESSION = array();
    
    //<nn>
    // We kill te empty session.
    //</nn>
    session_destroy();
    
    //<nn>
    // We go back to the start point.
    //</nn>
    header("location: login.php");
    exit;

?>