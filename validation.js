/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	
	//global vars
	
	oFormObject = document.forms['customForm'];
		
	var form = $("#customForm");
	var name = $("#name");
	var nameInfo = $("#nameInfo");
	var apellido = $("#apellido");
	var apellidoInfo = $("#apellidoInfo");
	var documento = $("#documento");
	var documentoInfo = $("#documentoInfo");
	var telefono = $("#telefono");
	var telefonoInfo = $("#telefonoInfo");
	var codpais = $("#codpais");
	var codpaisInfo = $("#codpaisInfo");
	var codarea = $("#codarea");
	var codareaInfo = $("#codareaInfo");
	var profesion = $("#profesion");
	var profesionInfo = $("#profesionInfo");
	var insteduc = $("#insteduc");
	var insteducInfo = $("#insteducInfo");
	var pais=$("#pais");
	
	var date1 = $("#date1");
	var date1Info = $("#date1Info");

	var date2 = $("#date2");
	var date2Info = $("#date2Info");

	var date3 = $("#date3");
	var date3Info = $("#date3Info");
	var date4 = $("#date4");
	var date4Info = $("#date4Info");
	var date5 = $("#date5");
	var date5Info = $("#date5Info");
	var date6 = $("#date6");
	var date6Info = $("#date6Info");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	
	var emailm = $("#emailm");
	var emailmInfo = $("#emailmInfo");
	
	var medio = $("#medio");
	var medioInfo = $("#medioInfo");

	var ciudad = $("#ciudad");
	var ciudadInfo = $("#ciudadInfo");
	
	
	
	//On blur

	name.blur(validateName);
	apellido.blur(validateApellido);
	documento.blur(validateDocumento);
	telefono.blur(validateTelefono);
	codpais.blur(validateCodpais);
	codarea.blur(validateCodarea);
	profesion.blur(validateProfesion);
	insteduc.blur(validateInsteduc);
	email.blur(validateEmail);
	ciudad.blur(validateCiudad);
	pais.blur(validatePais);
	emailm.blur(validateEmailm);
	medio.blur(validateMedio);

	//On key press
/*
	name.keyup(validateName); 
	apellido.keyup(validateApellido);
	documento.keyup(validateDocumento);
	telefono.keyup(validateTelefono);
	codpais.keyup(validateCodpais);
	codarea.keyup(validateCodarea);
	profesion.keyup(validateProfesion);
	insteduc.keyup(validateInsteduc);
	email.keyup(validateEmail);
	ciudad.keyup(validateCiudad);
	*/
	pais.change(validatePais);

	// On Submitting
	form.submit(function(){
		
	selIdx = document.forms[0].cboCountry.selectedIndex;
	newSel = document.forms[0].cboCountry.options[selIdx].text;	
	if (newSel=="") {
		alert("Se debe elegir un país!");
		return false;
	}
	
	if(validateName() & 
		validateDate1() &
		validateDate2() &
		validateDate3() &
		validateDate4() &
		validateDate5() &
		validateDate6() &
		validateEmail() &
		validateCiudad()
		 
		)
			return true
		else
			return false;
	});
	
	//validation functions
	function validateDate1(){
			if ($("#date1").val()=="") {
				date1.removeClass("error");
				date1Info.text("");
				date1Info.removeClass("error");
				return true;
			}
			
				/* alert (isDate($("#date1").val())); */
			if ((isDate($("#date1").val()))==false) {	
				date1.addClass("error");
				date1Info.text("Error Fecha");
				date1Info.addClass("error");
				return false;
			}
			else {
				date1.removeClass("error");
				date1Info.text("Fecha correcta!");
				date1Info.removeClass("error");
			return true;
		}
	}

function validateDate2(){
				/* alert (isDate($("#date1").val())); */
			if ($("#date2").val()=="") {
				date2.removeClass("error");
				date2Info.text("");
				date2Info.removeClass("error");
				return true;
			}	
				
			if ((isDate($("#date2").val()))==false) {	
				date2.addClass("error");
				date2Info.text("Error Fecha");
				date2Info.addClass("error");
				return false;
			}
			else {
				date2.removeClass("error");
				date2Info.text("Fecha correcta!");
				date2Info.removeClass("error");
			return true;
		}
	}
	
function validateDate3(){
			if ($("#date3").val()=="") {
				date3.removeClass("error");
				date3Info.text("");
				date3Info.removeClass("error");
				return true;
			}	
			if ((isDate($("#date3").val()))==false) {	
				date3.addClass("error");
				date3Info.text("Error Fecha");
				date3Info.addClass("error");
				return false;
			}
			else {
				date3.removeClass("error");
				date3Info.text("Fecha correcta!");
				date3Info.removeClass("error");
			return true;
		}
	}
	
function validateDate4(){
				if ($("#date4").val()=="") {
				date4.removeClass("error");
				date4Info.text("");
				date4Info.removeClass("error");
				return true;
			}
			if ((isDate($("#date4").val()))==false) {	
				date4.addClass("error");
				date4Info.text("Error Fecha");
				date4Info.addClass("error");
				return false;
			}
			else {
				date4.removeClass("error");
				date4Info.text("Fecha correcta!");
				date4Info.removeClass("error");
			return true;
		}
	}
	
function validateDate5(){
			if ($("#date5").val()=="") {
				date5.removeClass("error");
				date5Info.text("");
				date5Info.removeClass("error");
				return true;
			}
			if ((isDate($("#date5").val()))==false) {	
				date5.addClass("error");
				date5Info.text("Error Fecha");
				date5Info.addClass("error");
				return false;
			}
			else {
				date5.removeClass("error");
				date5Info.text("Fecha correcta!");
				date5Info.removeClass("error");
			return true;
		}
	}
	
function validateDate6(){
				
			if ($("#date6").val()=="") {
				date6.removeClass("error");
				date6Info.text("");
				date6Info.removeClass("error");
				return true;
			}	
			if ((isDate($("#date6").val()))==false) {	
				date6.addClass("error");
				date6Info.text("Error Fecha");
				date6Info.addClass("error");
				return false;
			}
			else {
				date6.removeClass("error");
				date6Info.text("Fecha correcta!");
				date6Info.removeClass("error");
			return true;
		}
	}					
	
	
	
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			emailInfo.text("");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Dirección de email inválida");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	function validateEmailm(){
		//testing regular expression
		var a = $("#emailm").val();
		
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			emailm.removeClass("error");
			emailmInfo.text("");
			emailmInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			emailm.addClass("error");
			emailmInfo.text("Dirección de email inválida");
			emailmInfo.addClass("error");
			return false;
		}
	}
	
	function validateName(){
		//if it's NOT valid
		if(name.val().length < 1){
			name.addClass("error");
			nameInfo.text("Error en el nombre");
			nameInfo.addClass("error");
		
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			nameInfo.text("");
			nameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateMedio(){
		//if it's NOT valid
		if(medio.val().length < 1){
			medio.addClass("error");
			medioInfo.text("Error en el medio");
			medioInfo.addClass("error");
		
			return false;
		}
		//if it's valid
		else{
			medio.removeClass("error");
			medioInfo.text("");
			medioInfo.removeClass("error");
			return true;
		}
	}
	
	function validateApellido(){
		//if it's NOT valid
		if(apellido.val().length < 1){
			apellido.addClass("error");
			apellidoInfo.text("Error, no puede estar vacío");
			apellidoInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			apellido.removeClass("error");
			apellidoInfo.text("");
			apellidoInfo.removeClass("error");
			return true;
		}
	}
	
		function validateDocumento(){
		//if it's NOT valid
		if(documento.val().length < 1){
			documento.addClass("error");
			documentoInfo.text("Error, no puede estar vacío");
			documentoInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			documento.removeClass("error");
			documentoInfo.text("");
			documentoInfo.removeClass("error");
			return true;
		}
	}
	
	
	function validateCiudad(){
		//if it's NOT valid
		if(ciudad.val().length < 1){
			ciudad.addClass("error");
			ciudadInfo.text("Error en la Ciudad");
			ciudadInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			ciudad.removeClass("error");
			ciudadInfo.text("");
			ciudadInfo.removeClass("error");
			return true;
		}
	}
	
	function validateProfesion(){
		//if it's NOT valid
		if(profesion.val().length < 1){
			profesion.addClass("error");
			profesionInfo.text("Error en la Profesión");
			profesionInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			profesion.removeClass("error");
			profesionInfo.text("");
			profesionInfo.removeClass("error");
			return true;
		}
	}
	
	function validateInsteduc(){
		//if it's NOT valid
		if(insteduc.val().length < 1){
			insteduc.addClass("error");
			insteducInfo.text("Error en la Institución");
			insteducInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			insteduc.removeClass("error");
			insteducInfo.text("");
			insteducInfo.removeClass("error");
			return true;
		}
	}
	
	
	function validatePais() {
				
		if (oFormObject.elements["pais"].value == 'México') {
			oFormObject.elements["codpais"].value = '52';
			oFormObject.elements["OtroPais"].style.display = "none"; 
			// otroPaisLabel.style.display = "none"; 
		}
		
		else {
			if (oFormObject.elements["pais"].value == 'Argentina') {
			oFormObject.elements["codpais"].value = '54';
			oFormObject.elements["OtroPais"].style.display = "none";
			// otroPaisLabel.style.display = "none"; 
		} else {
			if (oFormObject.elements["pais"].value == 'Otro') {
			oFormObject.elements["codpais"].value = '';
			oFormObject.elements["OtroPais"].style.display = '';
			
			
			
			}
		}
		}
	
	}
	
			
	function validateTelefono(){
		//if it's NOT valid
		if(telefono.val().length < 1) {
			telefono.addClass("error");
			telefonoInfo.text("Error en el teléfono");
			telefonoInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			telefono.removeClass("error");
			if ((codpais.val().length > 0) && (telefono.val().length > 0) && (codarea.val().length > 0)) {
				telefonoInfo.text("");
				telefonoInfo.removeClass("error");
				return true;
			}
			else return false;
		}
	}
	
	function validateCodpais(){
		//if it's NOT valid
		if(codpais.val().length < 1) {
			codpais.addClass("error");
			telefonoInfo.text("Error en el teléfono");
			telefonoInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			codpais.removeClass("error");
			if ((codpais.val().length > 0) && (telefono.val().length > 0) && (codarea.val().length > 0)) {
			
			telefonoInfo.text("");
			telefonoInfo.removeClass("error");
			return true;
			}
			else return false;
		}
	}

function validateCodarea(){
		//if it's NOT valid
		if(codarea.val().length < 1) {
			codarea.addClass("error");
			telefonoInfo.text("Error en el teléfono");
			telefonoInfo.addClass("error");
			return false;
		}
		//if it's valid
		//if it's valid
		else{
			codarea.removeClass("error");
			if ((codpais.val().length > 0) && (telefono.val().length > 0) && (codarea.val().length > 0)) {
			telefonoInfo.text("");
			telefonoInfo.removeClass("error");
			return true;
			}
			else return false;
		}
	}

	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <5){
			pass1.addClass("error");
			pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			pass1.removeClass("error");
			pass1Info.text("At least 5 characters: letters, numbers and '_'");
			pass1Info.removeClass("error");
			validatePass2();
			return true;
		}
	}
	function validatePass2(){
		var a = $("#password1");
		var b = $("#password2");
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			pass2.addClass("error");
			pass2Info.text("Passwords doesn't match!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.text("Confirm password");
			pass2Info.removeClass("error");
			return true;
		}
	}
	function validateMessage(){
		//it's NOT valid
		if(message.val().length < 10){
			message.addClass("error");
			return false;
		}
		//it's valid
		else{			
			message.removeClass("error");
			return true;
		}
	}
	
	
	
	var dtCh= "/";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		return false
	}
return true
}


	
});
