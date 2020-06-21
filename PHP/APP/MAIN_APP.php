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

error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();


include_once($_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/PHP_CONSTS.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/DB_HANDLER.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/BAREBONE_02/PHP/MAILER/PHPMailer/src/PHPMailer.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/BAREBONE_02/PHP/MAILER/PHPMailer/src/Exception.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/BAREBONE_02/PHP/tc_pdf/tcpdf.php');

use PHPMailer\PHPMailer\PHPMailer;

class MAIN_APP{

    private $instncID = "";
    private $DB_HLR;
    private $mailer;

    public function __construct(){
        //echo 'BASIC CONSTRUCTOR DONE...';
        //$this->DB_HLR = new DB_HANDLER();
        $this->genrt_AppID();
        $this->mailer = $this->mail_setup();
    }


    //+------------------------------------------------------------------------------+
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //|¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤        PUBLIC SECTION         ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤|
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //+------------------------------------------------------------------------------+

    public function getAppId(){
      //<SF>
      //LÉTREHOZVA: 2020-06-21 <br/>
      //SZERZÓ: AX07057 <br/>
      // There is no special function, this only shows that constructor runs without a glitch. <br/>
      // PARAMÉTEREK:
      //×-
      // @-- @param = ... -@
      //-×
      //MÓDOSTÁSOK:
      //×-
      // @-- ... -@
      //-×
      //</SF>

      return $this->instncID;
    }

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
    //|¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤    GENERAL HELPER SECTION     ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤|
    //|××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××××|
    //+------------------------------------------------------------------------------+

    public function getCode128String($rawString){
      //<SF>
      // LÉTREHOZÁS: 2020-03-16 <br>
      // SZERZŐ: AX07057<br>
      // A függvény egy bemenő stringre egy váalszstringet generál, ami rendelkezik a
      // CODE128B vonalkód ellenőrzőkarakterével!.<br>
      // PARAMÉTEREK:
      //×-
      // @-- @rawString = a nyers szöveg -@
      //-×
      //MÓDOSTÁSOK:
      //×-
      // @-- ... -@
      //-×
      //</SF>

  
      //<nn>
      //A kezdő és zárókarakterek speciálisak. Ezek nélkül is lehet vonalkódot geenrálni, 
      //de azt nem ismeri fel a mi vonalkódolvasónk.
      //</nn>
      $begChr = "Ì";
      $endChr = "Î";
      $chkDig = 104;

      //<nn>
      //Egy for ciklussal végiglépkedve a karakreteken számolgatjuk az ellenőrzőösszeget
      //mert ebből számolódik az utolsó előtti karakter.
      //</nn>
      for($i=0;$i<strlen($rawString);$i++){
        $kar = substr($rawString,$i, 1);
        $karVal = ord($kar)-32;
        $chkDig += ($i+1) * $karVal;
      }
      
      //<nn>
      //Ha megvan az ellenőrzőösszeg kiszámítjuk vele a karaktert, és beletesszük az
      //eredménystringbe.
      //</nn>
      $chkDig = $chkDig % 103;
      $kar = chr($chkDig+32);
      return $begChr . $rawString . $kar . $endChr;
    }

    public function get_hungr_dayname($dn){
      //<SF>
      // LÉTREHOZÁS: 2019-10-17<br>
      // SZERZŐ: AX07057<br>
      // Egy egyszerű kis függvény, ami a beküldött angol napnévre visszaadja a magyar megfeleleőt.<br>
      // PARAMÉTEREK:
      //×-
      // @-- @param = ... -@
      //-×
      //MÓDOSTÁSOK:
      //×-
      // @-- ... -@
      //-×
      //</SF>
      
      $resp = 'Ismeretlen nap';

      switch (strtoupper($dn)) {
          case 'MONDAY':
              $resp = 'Hétfő';
              break;
          case 'TUESDAY':
              $resp = 'Kedd';
              break;
          case 'WEDNESDAY':
              $resp = 'Szerda';
              break;
          case 'THURSDAY':
              $resp = 'Csütrötök';
              break;
          case 'FRIDAY':
              $resp = 'Péntek';
              break;
          case 'SATURDAY':
              $resp = 'Szombat';
              break;
          case 'SUNDAY':
              $resp = 'Vasárnap';
              break;
          default:
              # code...
              break;
      }

      return $resp;
    }

    public function cnvrt_secndsNr_to_time($sec){
        //<SF>
        // LÉTREHOZÁS: 2019-02-13<br>
        // SZERZŐ: AX07057<br>
        // Másodperc érték konvertálása óra:perc:másodperc sztringgé.<br>
        // PARAMÉTEREK:
        //×-
        // @-- $sec = a másodpercek -> egy szám -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- 2019-02-14:<br>
        // Úgy tűnik a negatív időre nem gondoltam ...:(
        // -@
        //-×
        //</SF>

        $res = "";
        $negFlag = $sec < 0;
        $sec = abs($sec);
        //<nn>
        // Egynként kizámoljuk az összetevőket a számból:
        // - az órákat
        // - a perceket
        // - a másodperceket
        //</nn>
        $hrs = floor($sec / 3600);
        $mins = floor(($sec - ($hrs*3600))/60);
        $secs = $sec - ($mins*60) - ($hrs*3600);
        
        //<nn>
        // Hogy a formátumot biztosítsuk, megcsináljuk a 0-val való fektöltést, ahol kell.
        //</nn>
        if($hrs < 10){
            $hrs = '0'.$hrs;
        }
        if($mins < 10){
            $mins = '0'.$mins;
        }
        if($secs < 10){
            $secs = '0'.$secs;
        }

        //<nn>
        // Az elemekből összerakjuk az eeredménystringet.
        //</nn>
        if($negFlag){
            $res = '-'.$hrs.":".$mins.":".$secs;
        }else{
            $res = $hrs.":".$mins.":".$secs;
        }
        

        //<nn>
        // Visszaadjuk az eredményt.
        //</nn>
        return $res;
    }

    public function cnvrt_timeStr_toSeconds($t){
        //<SF>
        // LÉTREHOZÁS: 2019-02-13<br>
        // SZERZŐ: AX07057<br>
        // Egy time string átváltása másodpercekre.<br>
        // PARAMÉTEREK:
        //×-
        // @-- $t = az időt reprezentáló sztring -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        //<nn>
        // Deklaráljuk az eredményváltozót.
        //</nn>
        $res = -1;

        //<nn>
        //A beküldött paramétert (00:00, vagy 00:00:00 formátumú lehet) egy tömbbe tesszük.
        //</nn>
        $tmb = explode(":",$t);

        if(sizeof($tmb) == 2){
            $res = $tmb[0] * 3600;
            $res += $tmb[1] * 60;
        }elseif(sizeof($tmb) == 3){
            $res = $tmb[0] * 3600;
            $res += $tmb[1] * 60;
            $res += $tmb[2];
        }else{
            echo '<p>======================================<br> GOND VAN:<pre>';
            print_r($tmb);
            echo '</pre>================================================<br></p>';
            echo '<p class="ERRMsg"> Ez a függvény csak óó:pp, vagy óó:pp:mm formátumú adatot tud kezelni!</p>';
        }

        return $res;

    }

    public function cnvrt_number_to_currency($nr, $crncy="", $decSep="",$thsndSep="", $nrOfDcmls=""){
        //<SF>
        //LÉTREHOZVA: 2020-01-16 <br/>
        //SZERZÓ: AX07057 <br/>
        //LEÍRÁS: Egy szám->szöveg átalakító, hogy ne szívjunk mindig az értékek átalakításával. <br/>
        // PARAMÉTEREK:
        //×-
        // @-- @nr = Amiből a szöveget csináljuk -@
        //-×
        //MÓDOSTÁSOK:
        //×-
        // @-- ... -@
        //-×
        //</SF>

        $resp = "";
        $orgNr = $nr;

        //<nn>
        // Alapértelmezett értékek beállítása
        //</nn>
        if($crncy == ""){
            $crncy = 'Ft';
        }
        if($decSep == ""){
            $decSep = '.';
        }
        if($thsndSep == ""){
            $thsndSep = ' ';
        }
        if($nrOfDcmls == ""){
            $nrOfDcmls = 0;
        }

        //<nn>
        // Milliárdok, ha vannak:
        //</nn>
        $mrds = floor($nr/1000000000);
        if($mrds > 0){
            $resp .= $mrds . $thsndSep;
            $nr -= ($mrds * 1000000000); 
        }
        
        //<nn>
        // Milliók, ha vannak:
        //</nn>
        $mlns = floor($nr/1000000);
        if($mlns > 0){
            if($resp != ''){
                $resp .= str_pad($mlns,3,"0",STR_PAD_LEFT) . $thsndSep;
            }else{
                $resp .= $mlns . $thsndSep;
            }
            $nr -= ($mlns * 1000000);
        }

        //<nn>
        // Ezresek, ha vannak:
        //</nn>
        $thsnds = floor($nr/1000);
        if($thsnds > 0){
            if($resp != ''){
                $resp .= str_pad($thsnds,3,"0",STR_PAD_LEFT) . $thsndSep;
            }else{
                $resp .= $thsnds . $thsndSep;
            }
            $nr -= ($thsnds * 1000);
        }
        
        //<nn>
        // Egyesek:
        //</nn>
        $nr = $nr%1000;
        if($resp != ''){
            $resp .= str_pad($nr,3,"0",STR_PAD_LEFT);
        }else{
            $resp = $nr;
        }

        //<nn>
        // A tizedes jegyek:
        //</nn>
        if($nrOfDcmls > 0){
            $dcmls = $orgNr - floor($orgNr);
            //echo "<p>\$orgNr - floor(\$orgNr) => " . $dcmls .'</p>';
            $resp .= $decSep;
            $dcmls *= pow(10,$nrOfDcmls);
            $dcmls = floor($dcmls);
            //echo "<p>\$dcmls *= floor(pow(10,\$nrOfDcmls)) => " . $dcmls .'</p>';
            $resp .= str_pad($dcmls,$nrOfDcmls,"0",STR_PAD_LEFT);
        }
        

        return $resp . ' ' . $crncy;
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

    private function mail_setup(){
      //<SF>
      //LÉTREHOZVA: 2020-06-21 <br/>
      //SZERZÓ: AX07057 <br/>
      //LEÍRÁS: Set up the app mailer, to be ready for mail sending.<br/>
      // PARAMÉTEREK:
      //×-
      // @-- @param = ... -@
      //-×
      //MÓDOSTÁSOK:
      //×-
      // @-- ... -@
      //-×
      //</SF>

      $this->mailer = new PHPMailer();
      $this->mailer->isHTML(true);
		  $this->mailer->CharSet='UTF-8';
      $this->mailer->setFrom('WRKFLWPostaMester@sajatszerver.com','HAL Kft WORKFLOW PostaMester');

    }

    private function genrt_AppID(){
      //<SF>
      //LÉTREHOZVA: 2020-06-21 <br/>
      //SZERZÓ: AX07057 <br/>
      //LEÍRÁS: Egy random APP ID sztring generálása csak teszteléshez. <br/>
      // PARAMÉTEREK:
      //×-
      // @-- @param = ... -@
      //-×
      //MÓDOSTÁSOK:
      //×-
      // @-- ... -@
      //-×
      //</SF>

      $appId = '';
      $appId = 'BAREBONE_02_'.date('Y_m_d');
      $chars = '0123456789abcdefghikklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXYZ';
      for($ix1=0;$ix1<24;$ix1++){
        $appId .= $chars[rand(0,strlen($chars)-1)];
      }

      $this->instncID = substr(strtoupper(hash('sha3-512',$appId)),0,16);

    }


}

?>