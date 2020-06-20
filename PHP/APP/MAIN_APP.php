<?php
//<M> 
//×-
//@-MODULÉV   : BAREBONE_02 - F:\Apache24\htdocs\BAREBONE_02\PHP\APP\MAIN_APP.php -@
//@-SZERZŐ    : AX07057-@
//@-LÉTREHOZVA: 2020-06-20 -@
//@-FÜGGŐSÉGEK:
//×-
// @-- DEPENDECIES_FILE01.php/.js/.html/.java-@
// @-- DEPENDECIES_FILE02.php/.js/.html/.java-@
// @-- DEPENDECIES_FILE03.php/.js/.html/.java-@
//-×
//-@
//@-LEÍRÁS    :<br/>
// Main class of the application.<br/>
//@-MÓDOSÍTÁSOK :
//×-
// @-- 2099-12-31
// -@
// @-- ... -@
//-×
//-×
//</M>
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/PHP_CONSTS.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/DB_HANDLER.php');

class MAIN_APP{

    private $instncID = "";
    private $DB_HLR;

    public function __construct(){
        //echo 'BASIC CONSTRUCTOR DONE...';
        //$this->DB_HLR = new DB_HANDLER();
    }


    //+------------------------------------------------------------------------------+
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //|¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤        PUBLIC SECTION         ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤|
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //+------------------------------------------------------------------------------+

    public function chck_user_pwd($u, $p){
        //<SF>
        //LÉTREHOZVA: 2020-06-20 <br/>
        //SZERZÓ: AX07057 <br/>
        //Basic logon checker function where is it needed. <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @param = ... -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        //<nn>
        // Dummy code, return OK always.
        //</nn>
        $retArr = array();
        $retArr['FLAG'] = "OK";
        $retArr['MSG'] = "DUMMY ANSWER FOR LOGIN REQ.";
        $retArr['DATA'] = array();

        return $retArr;

    }

    public function genSTD_HEADER($mTTl="", $jmbH="",$jmbT=""){
        //<SF>
        //LÉTREHOZVA: 2020-06-20 <br/>
        //SZERZÓ: AX07057 <br/>
        //LEÍRÁS: Generation of standard site header <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @param = ... -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>
        $html = "";

        $html .= $this->gen_std_header($mTTl);

        $html .= $this->gen_std_body_init($jmbH, $jmbT);

        return $html;
    }

    public function genSTD_FTR($ftrTxt = ""){
        //<SF>
        // LÉTREHOZÁS:2018. okt. 22.<br>
        // SZERZŐ: AX07057<br>
        // Alap site header legenerálása.<br>
        // PARAMÉTEREK:
        //×-
        // @-- $mTTl = a lap címe, a title tag értéke. -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>
        $html = "";

        $html .= $this->gen_std_footer($ftrTxt);

        return $html;
    }

    //+------------------------------------------------------------------------------+
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //|¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤       PRIVATE SECTION         ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤|
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //+------------------------------------------------------------------------------+

    private function gen_std_header($ttl){
        //<SF>
        //LÉTREHOZVA: 2020-06-20 <br/>
        //SZERZÓ: AX07057 <br/>
        //LEÍRÁS: Generation of the HTML code of the app-standard page header <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @param = ... -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        //<nn>
        // An empty varaible for contain the HTML code.
        //</nn>
        $html = "";

        if($ttl == ""){
            $ttl = "Standard Page Title";
        }
        //<nn>
        // Create HTML code:<br>
        // - DOCTYPE+html+meta charset
        // - JS includes
        // - CSS includes
        //</nn>
        $html .= '<!DOCTYPE html>
        <html lang="hu">
        <head>
            <meta charset="utf-8">';
        
        $html .= '<!-- JavaScript includes -->
        <script type="text/javascript" src="/BAREBONE_02/JS/frameworks/jQuery/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="/BAREBONE_02/JS/frameworks/popper/popper.min.js"></script>
        <script type="text/javascript" src="/BAREBONE_02/JS/frameworks/bootstrap/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/BAREBONE_02/JS/frameworks/fontawesome/all.js"></script>
        <script type="text/javascript" src="/BAREBONE_02/JS/lib/mainApp.js"></script>
        
        <!-- CSS includes        -->
        <!--  Az oldal layooutjához -> BOOTSTRAP -->
        <link rel="stylesheet" href="/BAREBONE_02/JS/frameworks/bootstrap/bootstrap-4.5.0-dist/css/bootstrap.css">
        <link rel="stylesheet" href="/BAREBONE_02/CSS/all.css">
        <!-- A továbbiakhoz, és ezek testreszabásához: saját css -->
        <link rel="stylesheet" href="/BAREBONE_02/CSS/baseStyle.css" >
    
        <!-- FAVICON -->
        <link rel="shortcut icon" href="/BAREBONE_02/favicon.ico" type="image/x-icon"/>
    
        <title>Boilerplate lap</title>
        </head/>';

        return $html;
    }

    private function gen_std_body_init($jmbHdr="", $jmbTxt=""){
        //<SF>
        //LÉTREHOZVA: 2020-06-20 <br/>
        //SZERZÓ: AX07057 <br/>
        //LEÍRÁS: Generatioon if standar bod init HTML, top navigation menu, etc. <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @param = ... -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        $html = "";

        if($jmbHdr == ""){
            $jmbHdr = "Az oldal funkciója";
        }

        if($jmbTxt == ""){
            $jmbTxt = "Rövid leírás az oldalról, ha a cím maga nem szolgálna elég magyarázattal.";
        }
       
        $html.='<body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#"><img class="nav-logo" src="/BAREBONE_02/PIX/UI/app_logo.png"></a>
          
            <!-- Links -->
            <ul class="nav navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Link 1</a>
              </li>
              <!-- Dropdown -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Dropdown link
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Link 1-1</a>
                  <a class="dropdown-item" href="#">Link 2-1</a>
                  <a class="dropdown-item" href="#">Link 3-1</a>
                </div>
              </li>
          
              <!-- Dropdown -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Dropdown link
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Link 2-1</a>
                  <a class="dropdown-item" href="#">Link 2-2</a>
                  <a class="dropdown-item" href="#">Link 2-3</a>
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i title="My own user profile" style="color:#99FFFF" class="fas fa-user"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i title="App helper" style="color:#FABE55;" class="fas fa-info"></i>
                </a>
              </li>';
        if(!isset($_SESSION['SS_LOGDIN']) || $_SESSION['SS_LOGDIN'] == false){
            $html.='<li class="nav-item">
            <a class="nav-link" href="/BAREBONE_02/PHP/SESSION/login.php">
                LOGIN <i style="color:#FABE55;" class="fas fa-sign-in-alt"></i>
                </a>
            </li>';
        }else{
            $html.='<li class="nav-item">
            <a class="nav-link" href="/BAREBONE_02/PHP/SESSION/logout.php" style="color:#FF5555;">
                LOGOUT <i style="color:#FF5555;" class="fas fa-sign-out-alt"></i>
                </a>
            </li>';
        }

        $html.=   '</ul>
          </nav>
    
        <div class="container">
            <div class="jumbotron">
                <h1>'.$jmbHdr.'</h1>
                <p>'.$jmbTxt.'</p>
            </div>
        </div>';

        return $html;
    }

    private function gen_std_footer($ftrText = ""){
        //<SF>
        // 2018. okt. 22.<br>
        // A standard lapzáró elemek legenerálása<br>
        // PARAMÉTEREK:
        //×-
        // @-- $ftrText = a footerre kerülő szöveg -@
        // @-- $jmbTxt = a jumbotron szöveg eleme -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        $html = "";

        if($ftrText == ""){
            $ftrText = "Made by AX07057 - 2020 &copy;";
        }

        $html = '<!-- 
            //<nn>
            //Ez a két div eleinte láthatatlan, csak bizonyos események 
            //(javascript fv hívások hívják őket elő.
            //<nn>      
            -->
            <div class="container footer">
            <!-- Copyright -->
                <div class="footer-copyright text-center py-3">'.$ftrText.'</a>
                </div>
            <!-- Copyright -->
            </div>
            <div id="modalWndw" class="modal-base" title="Modális ablak OK?">
                <p>
                    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                    Modális ablak üzenethez.
                </p>
            </div>
            <div id="bsc-toolTip">
                
            </div>
        </body>
        </html>';   

        return $html;
    }

}

?>