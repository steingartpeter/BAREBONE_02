<?php
//<M> 
//×-
//@-MODULÉV   : BAREBONE_02 - /BAREBONE_02/PHP/SESSION/login.php -@
//@-SZERZŐ    : AX07057-@
//@-LÉTREHOZVA: 2020-06-20 -@
//@-FÜGGŐSÉGEK:
//×-
// @-- BAREBONE_02/PHP/APP/MAIN_APP.php-@
//-×
//-@
//@-LEÍRÁS    :<br/>
// A simple login site.<br/>
//@-MÓDOSÍTÁSOK :
//×-
// @-- 2099-12-31
// -@
// @-- ... -@
//-×
//-×
//</M>

    require_once $_SERVER['DOCUMENT_ROOT'].'/BAREBONE_02/PHP/APP/MAIN_APP.php';

    $pgGnrtr = new MAIN_APP();
    $htmlErr = "";

    if(isset($_POST['userid'])){
        session_start();
        $usr = $_POST['userid'];
        if(!isset($_POST['usrPwd']) || $_POST['usrPwd'] == ""){
            $htmlErr = '<p class="bg-danger">A jelszó hibás, vagy hiányzik!<br>Kérem próbálja újra!</p>';
        }else{
            $pwd = strtoupper(hash("sha512",($_POST['usrPwd'])));
            
            $chckResp = $pgGnrtr->chck_user_pwd($usr,$pwd);

            if($chckResp['FLAG'] != "OK"){
                echo '<p>HIBA:<pre>';
                print_R($chckResp);
                echo '</pre></p>';
                $htmlErr = '<div class="bg-danger sys-msg-err">';
                $htmlErr .= '<h3>AUTENTIKÁCIÓS HIBA!!!</h3>';
                $htmlErr .= 'Sikertelen bejelentkezési kísérlet, kérem próbálja újra!';
                $htmlErr .= '</div>';
            }else{
                $_SESSION['SS_USRID'] = $_POST['userid'];
                $_SESSION['SS_LOGDIN'] = true;
                //<DEBUG>
                // Save app specific data into SESSION.
                //<code>
                // $_SESSION['SS_FSTNAME'] = $chckResp['DATA']['usrVezNev'];
                // $_SESSION['SS_LSTNAME'] = $chckResp['DATA']['usrKerNev'];
                // $_SESSION['SS_USR_ROLE_ID'] = $chckResp['DATA']['usr_role'];
                // $_SESSION['SS_USR_EMAIL'] = $chckResp['DATA']['usr_email'];
                // $_SESSION['SS_WRKR_DB_ID'] = $chckResp['DATA']['usr_id'];
                //</code>
                //</DEBUG>
                
                $_SESSION['LOGIN_TIME'] = time();
                $_SESSION['AKT_YEAR'] = date('Y');
                $_SESSION['AKT_MNTH'] = date('n');

                //$_SESSION['JELIV_FRMR_MNTH_DAT'] = date('Y-m-d',strtotime('first day of last month'));
                //$_SESSION['JELIV_NEXT_MNTH_DAT'] = date('Y-m-d',strtotime('first day of next month'));
                //<DEBUG>
                // A SESSION tömb ellenőrzése
                //<code>
                // echo '<p>A $_SESSION tömb tartalma:<pre>';
                // print_r($_SESSION);
                // echo '</pre></p>';
                // DIE('ENNYI MOST!');
                //</code>
                //</DEBUG>
                
                header("location:/BAREBONE_02/index.php");
            }

            
        }
    }

    

    $mTTl = 'LOGIN';
    $jmbH = "BAREBONE - Belépés";
    $jmbT = 'A program használatához kérem jelentkezzen be!';
    
    

    echo $pgGnrtr->genSTD_HEADER($mTTl,$jmbH,$jmbT);



?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php
                    if($htmlErr != ""){
                        echo $htmlErr;
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="" method="post" id="loginFrm" class="base-form-01">
                <div class="form-group">
                    <h3>Felhasználói adatok megadása</h3>
                    <label for="userid">Felhasználó azonosító:</label>
                    <input type="text" name="userid" id="userid" placeholder="AX?????" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="usrPwd">Felhasználó jelszava:</label>
                    <input type="password" name="usrPwd" id="usrPwd" class="form-control" value="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"> Belépés </button>    
                    <button id="lginCncl" class="btn btn-danger"> Mégsem </button>
                </div>
                <div class="form-group">
                    <p class="text-muted">Nincs még felhasználói profilja => <a href="/WERKFLOW/PHP/PUBLIC/USR_MNGMNT/creatRegReq.php">REGISZTRÁCIÓ</a></p>
                </div>
                </form>
                
            </div>
        </div>
    </div>


    

    
<?php
    echo $pgGnrtr->genSTD_FTR();
?>


?>