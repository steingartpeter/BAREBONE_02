<?php
//<M> 
//×-
//@-MODULÉV   : BAREBONE_02 - /BAREBONE_02/index.php -@
//@-SZERZŐ    : AX07057-@
//@-LÉTREHOZVA: 2020-06-20 -@
//@-FÜGGŐSÉGEK:
//×-
// @-- /BAREBONE_02/PHP/APP/MAIN_APP.php -@
//-×
//-@
//@-LEÍRÁS    :<br/>
// Basic PHP index site.<br/>
//@-MÓDOSÍTÁSOK :
//×-
// @-- 2099-12-31
// -@
// @-- ... -@
//-×
//-×
//</M>

    include_once($_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/MAIN_APP.php');

    $pgGnrtr = new MAIN_APP();
    $html = "";

    $mTTl = 'INDEX-PHP';
    $jmbH = "BASIC INDEX SITE - Nothing special";
    $jmbT = 'Here we can see that PHP code works!';

    $html = $pgGnrtr->genSTD_HEADER($mTTl,$jmbH,$jmbT);

    $html .= '<div class="container hgh600"><div class="row"><div class="col-md-12">
    <h1>SITE IS UNDER CONSTRUCTION...</h1>
    </div></div></div>';

    echo $html;

?>
<?php 
        echo $pgGnrtr->genSTD_FTR();
?>