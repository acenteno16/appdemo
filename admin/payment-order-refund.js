function reloadsconcept(nid,i){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadsconcept2(0,i);
}

function reloadsconcept2(nid,i){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2_"+i).innerHTML = data;
	});
	
}

function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'payments.php';
		}
}

function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function commas(unformatedAmmount){
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function clear1(){
	document.getElementById("retention1").value = ""; 
}

function clear2(){
	document.getElementById("retention2").value = "";
}

function deleteRow(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("roc"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function printLetter(){

	var sendprint = 1;
	var clienttype = document.getElementById("clienttype").value;
	var description = document.getElementById("description").value;
	var totalbill = document.getElementById("totalbill").value;
	
	var i = 0;
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}

	
	var strdocuments = "";
	var currenttype = "";
	var currentnumber = "";
	var currenttoday = "";
	var currentamount = "";
	var currentcurrency = "";
	
	var types = "";
	var numbers = "";
	var todays = "";
	var amounts = "";
	var currencys = "";
	
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for(i=0;i<rocnumber.length; i++) { 
		//Reading Values
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		
		//Validation
		if(currenttype == "0"){
			alert('Debe de ingresar el tipo del documento');
			sendprint = 0;
			document.getElementsByName('roctype[]')[i].focus();
			return false;
		}
		if(currentnumber == ""){
			alert('Debe de ingresar el numero del documento');
			sendprint = 0;
			document.getElementsByName('rocnumber[]')[i].focus();
			return false;
		}
		if(currenttoday == ""){
			alert('Debe de ingresar la fecha del documento');
			sendprint = 0;
			document.getElementsByName('roctoday[]')[i].focus();
			return false;
		}
		if(currentamount == ""){
			alert('Debe de ingresar el monto del documento');
			sendprint = 0;
			document.getElementsByName('rocamount[]')[i].focus();
			return false;
		}
		if(currentcurrency == "0"){
			alert('Debe de ingresar la moneda del documento');
			sendprint = 0;
			document.getElementsByName('roccurrency[]')[i].focus();
			return false;
		}
		
		//Making the vars
		types = types+currenttype+"|||";
		numbers = numbers+currentnumber+"|||";
		todays = todays+currenttoday+"|||";
		amounts= amounts+currentamount+"|||";
		currencys= currencys+currentcurrency+"|||";	
	} 
	 
	strdocuments = "&roctype="+encodeURIComponent(types)+"&rocnumber="+encodeURIComponent(numbers)+"&roctoday="+encodeURIComponent(todays)+"&rocamount="+encodeURIComponent(amounts)+"&roccurrency="+encodeURIComponent(currencys); 
	var theroute = document.getElementById("theroute").value;
	if(sendprint == 1){
		if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value; 
		
		window.location = "payment-order-refund-pdf.php?clienttype="+encodeURIComponent(clienttype)+"&ccode="+encodeURIComponent(ccode)+"&cfirst="+encodeURIComponent(cfirst)+"&clast="+encodeURIComponent(clast)+"&caddress="+encodeURIComponent(caddress)+"&cnid="+encodeURIComponent(cnid)+"&ccity="+encodeURIComponent(ccity)+"&cemail="+encodeURIComponent(cemail)+"&cphone="+encodeURIComponent(cphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments; 
	}
		if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		window.location = "payment-order-refund-pdf-enterprise.php?clienttype="+encodeURIComponent(clienttype)+"&ccode2="+encodeURIComponent(ccode2)+"&cname="+encodeURIComponent(cname)+"&cruc="+encodeURIComponent(cruc)+"&cemail2="+encodeURIComponent(cemail2)+"&cphone2="+encodeURIComponent(cphone2)+"&caddress2="+encodeURIComponent(caddress2)+"&ccity2="+encodeURIComponent(ccity2)+"&crfirst="+encodeURIComponent(crfirst)+"&crlast="+encodeURIComponent(crlast)+"&crnid="+encodeURIComponent(crnid)+"&cremail="+encodeURIComponent(cremail)+"&crphone="+encodeURIComponent(crphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments;  
	}
	}

	
	
//End of function printLetter() 
}

function divRetention(){
	if(document.getElementById('retainer').checked == true){
		document.getElementById('retention1').value = 0; 	
		document.getElementById('retention1ammount').value = 0.00;
		document.getElementById('retention1').readOnly = true;
		document.getElementById('retention2').value = 0;
		document.getElementById('retention2ammount').value = 0.00;
		document.getElementById('retention2').readOnly = true;
		var p1 = 0;
		var p2 = 0; 
	}else{
	document.getElementById('retention1').readOnly = false;
	document.getElementById('retention2').readOnly = false;
	
	
	}
}
function benType(type){

if(type == 1){
	var clientcode = document.getElementById('ccode').value; 
}else if(type == 2){
	var clientcode = document.getElementById('ccode2').value; 
}

if(clientcode == ""){
	alert('Usted debe de ingresar un codigo.');
}else{

$.post("payment-order-refund-clients-reload.php", { thetype: type, thecode: clientcode }, function(data){
	//alert(data); 
    document.getElementById('client-stage').innerHTML = data;
   
});

}
	
}

function clientType(ctype){
	
	if(ctype == "load"){
		ctype = document.getElementById('clienttype').value;
	}

	if(ctype == 1){
		document.getElementById('ct_personal').style.display = 'block';
		document.getElementById('ct_business').style.display = 'none'; 
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	}
	if(ctype == 2){
		document.getElementById('ct_business').style.display = 'block';
		document.getElementById('ct_personal').style.display = 'none';
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	
	}
	if(ctype == 0){
		document.getElementById('ct_business').style.display = 'none';
		document.getElementById('ct_personal').style.display = 'none';
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	}
}

function reloadRequirements(rtype){

if(rtype == "load"){
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			rtype = radios_devtype[i].value;
  			break;
 		}
	}

}
//Primas
if(rtype == 1){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Primas)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('fReserva').style.display = "block";
	document.getElementById('credit').value = '1';
	
}

//Reservas
if(rtype == 2){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Reservas)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('fReserva').style.display = "block";
	document.getElementById('credit').value = '1';
	
}

//Excedentes
if(rtype == 3){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Excedentes)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>- Carta Emitida por el Banco<br>- Factura<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('fReserva').style.display = "block";
	document.getElementById('credit').value = '1';
	
}

//Seguros
if(rtype == 4){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Seguros)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>-Fotocopia de Circulacion<br>- Finiquito<br>- CK de la aseguradora<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "none";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "block";
	document.getElementById('assets_6').style.display = "none";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '1';
}

//Productos
if(rtype == 5){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Productos)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "block";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '0';
}

//PMP
if(rtype == 6){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (PMP)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "none";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "block";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '0';
}

//Leasing	
if(rtype == 7){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Leasing)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. de contrato:';
	document.getElementById('fReserva').style.display = "none";
	document.getElementById('credit').value = '0';
}
	
//Autoflex
if(rtype == 8){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Autoflex)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. de contrato:';
	document.getElementById('fReserva').style.display = "none";
	document.getElementById('credit').value = '0';
}
	
//Saldo a favor del cliente
if(rtype == 9){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Saldo a favor del cliente)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>"; 
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "block";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '1'; 
}
    
//FIDEM
if(rtype == 10){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (FIDEM)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. de contrato:';
	document.getElementById('fReserva').style.display = "none";
	document.getElementById('credit').value = '0';
}     

}

function showorhide(val){
	
	var thecdiv = document.getElementById('tctdcta');
	
	if(val == 0){
		thecdiv.style.display = "none";
	}
	else if(val == 1){
		thecdiv.style.display = "none";
	}
	else if(val == 2){
		thecdiv.style.display = "block"
	}
	else if(val == 3){
		thecdiv.style.display = "block"
	}
}

document.addEventListener("DOMContentLoaded", function () {
    const clientTypeElement = document.getElementById("clienttype");
    clientTypeElement.addEventListener("change", function () {
        clientType(this.value); // Call the clientType function when the value changes
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const methodElement = document.getElementById("method");
    methodElement.addEventListener("change", function () {
        showorhide(this.value); // Call the clientType function when the value changes
    });
});