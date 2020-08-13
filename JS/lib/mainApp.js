//<M>
//×-
//@-FILENÉV   : BAREBONE_02 - mainApp.js-@
//@-SZERZŐ    : AX07057-@
//@-LÉTREHOZVA: 2020-06-18.-@
//@-FÜGGŐSÉGEK:
//×-
// @-- RQRD_FILE01.js-@
// @-- RQRD_FILE02.js-@
// @-- RQRD_FILE03.js-@
// @-- RQRD_FILE04.js-@
//-@
//-×
//-@
//@-LEÍRÁS    :
//Ez az javascript file készült arra a feladatra, hogy ...
//@-MÓDOSÍTÁSOK :
//×-
// @-- ... -@
//-×
//-×
//</M>


//<nn>
// A teljes javascrip alkalmazást tartlamazó objektum.<br/>
// Érdemes neki olyan nevet adni ami az aktuális projektet írja le.<br/>
// Ennek az objektumnak az a szerepe, hogy a kódunkat elkülönítse a globális névtértől, 
// így az esetleges névütközéseknek lejét vehetjük.
//</nn>
var mainApp = mainApp || {};

//<nn>
// A document.ready függvényben a jQueryn keresztül meghívhatjuk az inicializációs kódunkat.
//</nn>
$( init);


function init(){
	//<SF>
	// 2020-06-18<br>
	// Az incializációs függvény, ami meghívódik a jQuery miatt a lap ready() fügvényével.<br>
	// PARAMÉTEREK:
	//×-
	// @- nincsenek paraméeterei -@
	//-×
	//MÓDOSÍTÁSOK:
	//×-
	// @-- ... -@
	//-×
	//</SF>	
	
	
	console.log("Inicializítion done ...");
}

mainApp.dismissModal = function(){
	//<SF>
	// LÉTREHOZÁS: 2020-07-05 <br>
	// SZERZŐ: AX07057<br>
	// This function runs when modal windo close button clicked.<br>
	// PARAMÉTEREK:
	//×-
	// @-- @param = no parameters -@
	//-×
	//MÓDOSTÁSOK:
	//×-
	// @-- ... -@
	//-×
	//</SF>
	setTimeout(() => {
		$("#myModal").remove();	
	}, 750);
	
}


//+-----------------------------------------------------------------------------+
//|¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤|
//|                               SEGÉD FÜGGVÉNYEK                              |
//|¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤|
//+-----------------------------------------------------------------------------+


function secondsFromTimeString(tStr){
	//<SF>
	// LÉTREHOZÁS: 2019-02-08$<br>
	// SZERZŐ: AX07057<br>
	// Ez a függvény másodpercekre számítja át,a beérkező óó:pp:mm alakú stringet.<br>
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
	// A beküldött sztringet a ":" karakter mentén szétszabdaljuk értékekre.
	//</nn>
	var ts = tStr.split(":");

	//<nn>
	// A kapott 3 elemű tömbből megcsináljuk a másodperc változót, és kész.
	//</nn>
	var s = 60*60*parseInt(ts[0])+60*parseInt(ts[1])+parseInt(ts[2]);

	//<nn>
	// A kapott másodpercszámot visszaadjuk.
	//</nn>
	return s;
}

function timeStringFromSeconds(sc){
	//<SF>
	//LÉTREHOZVA: 2019-02-04<br/>
	//SZERZÓ: AX07057<br/>
	//LEÍRÁS: Eza  függvény az idősztringet rakja össze a beküldött másodperszámból<br/>
	//</SF>	

	//<nn>
	// Az eredményváltozó.
	//</nn>
	res = '';

	//<nn>
	// Megnézzük, hogy 60-nál kisebb-e a beküldött másodpercérték, ha igen egysuzerűen megjelenítjük.
	// Ha 60, vagy annál több, akkor kalkulálgathatjuka percet is...
	// Órát most nem kódolunk el :)
	//</nn>
	if(sc > 3600){
		res = ('0'+Math.floor(sc/3600)).substr(-2)+':';
		var remn = (sc % 3600);
		//console.log("remn= ",remn);
		res += ('0'+Math.floor(remn/60)).substr(-2)+':'
		res += ('0'+(remn % 60).toString()).substr(-2);
	}else if(sc < 60 ){
		res = '00:00:'+('0'+sc.toString()).substr(-2);
	}else{
		res = '00:'+('0'+Math.floor(sc/60)).substr(-2)+':'+('0'+(sc % 60).toString()).substr(-2);
	}

	//<nn>
	// Az eredménysztringet visszaadjuk.
	//</nn>
	return res;

}

function timeClock(){
	//<SF>
	//LÉTREHOZVA: 2019-02-03<br/>
	//SZERZÓ: AX07057<br/>
	//LEÍRÁS: Csak egy másodpercenkénti frissítés...<br/>
	//</SF>

	//<nn>
	// Egy változóba tesszük a kiírandó stringet.
	//</nn>
	var tmStr = "";

	//<nn>
	// Egy IF szerkezettel megnézzük, hogy nem járt-e még le a session időnk (30) perc.
	// Ha lejárt, átirányítjuk a böngészőt a logout page-re.
	// Ha nem csökkentjük a maradék időt.
	//</nn>
	if(mainApp.scndsLeftLogut > 1){
		mainApp.scndsLeftLogut --;
		tmStr = timeStringFromSeconds(mainApp.scndsLeftLogut);
		//console.log('Time: ' + tmStr);
		$("#kilepAnc").text('Kilépés: ' + tmStr);
	}else{
		console.log("AUTOMATIKUS KILÉPTETÉS");
		window.location.replace("/.../PHP/SESSION/logout.php");
	}
	

}

function chckLoggStatus(){
	//<SF>
	//LÉTREHOZVA: 2019-10-17<br/>
	//SZERZÓ: AX07057<br/>
	//LEÍRÁS: Egy függvény, ami lekérdezi, hogy a van-e belogolt felhasználó.<br/>
	//</SF>

	//<nn>
	// Egy normál data elem az AJAX híváshoz.
	//</nn>
	var data = {"prcId":"is_logged_on"};

	//<nn>
	// Egy AJAX hívással megnézzük, hogy be vagyunk-e logolva, ha igen, akkor incializáljuk a számlálót
	// Ha nem, akkor az ap login flag-jét FALSE ra állítjuk.
	//</nn>
	$.ajax({
		type:"POST",
		url:"/.../PHP/APP/AJAX_HANDLER.php",
		data:data,
		success:function(rsp){
			console.log("rsp: ", rsp);
			var resp = JSON.parse(rsp);
			if(resp.USERID != ''){
				mainApp.loggedIn = true;
				mainApp.usrIPN = resp.USER_IPN;
				mainApp.loginTime = resp.LOGINTM;
				mainApp.scndsLeftLogut = 3600;
				if(resp.USERID == 'ax07051'){
					mainApp.scndsLeftLogut = 36000;
					console.log("secondsLeft átállítva: "+ mainApp.scndsLeftLogut);
				}
				var hndl = window.setInterval(timeClock,1000);
			}else{
				mainApp.loggedIn = false;
			}
		},
		error:function(){
			console.log("AJAX hiba:");
		},
		complete:function(){
			console.log("AJAX COMPLETE!");
		}
	});
}

function gnrtModalHtml(tp, hdr, msg){
	//<SF>
	// LÉTREHOZÁS: 2020-06-24 <br>
	// SZERZŐ: AX07057<br>
	// Generate basic HTMl for a modal window.<br>
	// PARAMÉTEREK:
	//×-
	// @-- @param = ... -@
	//-×
	//MÓDOSTÁSOK:
	//×-
	// @-- ... -@
	//-×
	//</SF>	

	var html = '<div class="modal fade" id="myModal">';

	html += '<div class="modal-dialog">';
	html += '<div class="modal-content ';

	//<nn>
	// Here we can insert the class depending on th type parameter.
	//</nn>
	if(tp==""){
		html += 'modal-base">';
	}else if(tp = "dngr"){
		html += 'modal-base danger-mod">';
	}else if(tp = "wrn"){
		html += 'modal-base warning-mod">';
	}else if(tp = "ok"){
		html += 'modal-base everok-mod">';
	}else if(tp = "info"){
		html += 'modal-base info-mod">';
	}
  
	//<!-- Modal Header -->
	html += '<div class="modal-header">';
	html += '<h4 class="modal-title">'+hdr+'</h4>';
	html += '<button type="button" class="close" data-dismiss="modal" onClick="mainApp.dismissModal()">&times;</button>';
	html += '</div>';
  
	//<!-- Modal body -->
	html += '<div class="modal-body">';
	html += msg;
	html += '</div>';
  
	//<!-- Modal footer -->
	html += '<div class="modal-footer">';
	html += '<button type="button" class="btn btn-danger" data-dismiss="modal" onClick="mainApp.dismissModal()">BEZÁR</button>';
	html += '</div>';
  
	html += '</div></div></div>';

	var b = $("body");
	b.append(html);
	$("#myModal").modal();

}

function ModalTester(){
	//<SF>
	// LÉTREHOZÁS: 2020-08-13 <br>
	// SZERZŐ: AX07057<br>
	// This function just tests the state of BS4 modal generator.<br>
	// PARAMÉTEREK:
	//×-
	// @-- @param = No parameter needed -@
	//-×
	//MÓDOSTÁSOK:
	//×-
	// @-- ... -@
	//-×
	//</SF>

	var tp = "";
	var hdr = "TESZT MODÁLIS ABLAK";
	var msg = "<h4>Modálsi ablak tesztelése</h4><div>Így működik, vag nem működik?</div>";

	gnrtModalHtml(tp,hdr,msg);
}

