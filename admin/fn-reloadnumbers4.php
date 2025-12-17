<script>
function reloadNumbers(){ 	

	//validateFirst();  
	loadcurrency2pay(); 
	
	<?php //read globals
	
	$queryglobals = "select * from config where id = 1";
	$resultglobals = mysqli_query($con, $queryglobals);
	$rowglobals = mysqli_fetch_array($resultglobals); 
	
	?>
	
	var cut = <?php echo $rowglobals['cut']; ?>;
	document.getElementById('cut').value = cut; 
	
	divRetention(); 
	
	var tc = 0;
	var stotal = 0;
	var stotal2 = 0;
	var sstotal = 0;
	var tax = 0;
	var intur = 0;
	var intur2 = 0;
	var totalbill = 0;
	var totalbillnio = 0;
	var tc = 0;
	var stotalbill = 0;
	var stotalbillnio = 0;
	var exempt = 0;
	var stotalbillnio2 = 0;
	var ir = 0;
	var imi = 0;
	var ira = 0
	var imia = 0;
	var totalret = 0;
	var totalpaynio = 0;
	var totalpay = 0;
	var nioexempt = 0;
	
	//Globals
	var gtax = 0;
	var gstotalbill = 0;
	var gintur2 = 0;
	var gtotalbill = 0;
	var gexempt = 0;
	var gtotalbill = 0;
	var gp1ammount = 0;
	var gp2ammount = 0;
	var gtotalret = 0;
	var gtotalretusd = 0;
	var gtotalbillnio = 0;
	

	var currency = document.getElementsByName('currency');
		
	for (var i = 0, length = currency.length; i < length; i++) {
    
	if (currency[i].checked) {
    	var billcurrency = currency[i].value;
	}
	} 
	
	//Moneda en que se va a pagar independiente de la moneda de la factura
	var currency2pay = document.getElementById('currency2pay').value;
	
	//Constante de IVA (Desde el modulo de configuracion)
	var giva = <?php echo ($rowglobals['iva']/100); ?>;
	//Constante de INTUR desde el modulo de configuración
	var gintur = <?php echo ($rowglobals['intur']/100); ?>;
	
	//porcentaje de retencion de Alcaldia
	var p1 = document.getElementById("retention1").value;
	//porcentaj ede retencion de IR
	var p2 = document.getElementById("retention2").value; 

//Aca tenemos el cliclo por factura
for (var i = 0; i < document.getElementsByName('stotal[]').length; i++) {
   
  
   var billdate = document.getElementsByName('billdate[]')[i].value; 
   if((billcurrency == 2) && (billdate == '')){
		alert('Ingrese una fecha para calcular el tipo de cambio');
		document.getElementsByName('billdate[]')[i].focus(); 
		
	}
	
  
  
   //Declaramos el subtotal general de la factura a cero
   var stotalbill = 0;
   var totalbill = 0;
  
   //Sub-total (graba iva)  
   var stotal = document.getElementsByName('stotal[]')[i].value;
   stotal = numberFormat(stotal);

   if(stotal > 0){
	   stotalbill+=parseFloat(stotal);
	   gstotalbill+=parseFloat(stotal);
	   totalbill+=parseFloat(stotal);
	   gtotalbill+=parseFloat(stotal);
   }
   //Okay 
	
   //IVA (Calculado por el sistema)
   var tax = stotal*giva;
   document.getElementsByName('tax[]')[i].value = commas(tax.toFixed(2));
   if(tax > 0){
	   gtax+=parseFloat(tax);
	   totalbill+=parseFloat(tax);
	   gtotalbill+=parseFloat(tax);
   }
   //Okay 
	
   //Sub-total (exento de iva)
   var stotal2 = document.getElementsByName('stotal2[]')[i].value;
   stotal2 = numberFormat(stotal2);
   if(stotal2 > 0){
	   stotalbill+=parseFloat(stotal2);
	   gstotalbill+=parseFloat(stotal2);
	   totalbill+=parseFloat(stotal2);
	   gtotalbill+=parseFloat(stotal2);
   }
   //Okay 
   
   //Escribimos el subtotal general de cada factura
 
   document.getElementsByName('bstotal[]')[i].value = commas(stotalbill);
  
	
   //INTUR
   intur = 0;
   var intur = document.getElementsByName('inturammount[]')[i].value;
  
   //INTUR ammount
   intur2 = 0;
   intur2 = intur*gintur;  
   document.getElementsByName('inturammount2[]')[i].value = commas(intur2);
   if(intur2 > 0){
	   gintur2+=intur2;
	   totalbill+=parseFloat(intur2);
	   gtotalbill+=parseFloat(intur2);
   }
   //Okay   
   
   //Exempt
   var exempt = document.getElementsByName('exempt[]')[i].value;
   exempt = parseFloat(exempt);
   if(parseFloat(exempt) > 0){
	   gexempt+=parseFloat(exempt);
   }
   
  
   //Escribimos el monto en letras del total de la factura.
   justLetters(totalbill,i);
   
   //Escribimos el monto del total de la factura
   document.getElementsByName('ammount[]')[i].value = commas(totalbill.toFixed(2));
   
   
   
   if(billcurrency == 2){
	   
	   var tc = getTc(billdate);
	   
	   document.getElementsByName('btc[]')[i].value = (tc);
	   if(tc <= 0){
		   alert('No existe taza de cambio para la fecha '+billdate);
		    
	   }
   }
   else{
	   var tc = 1;
	   document.getElementsByName('btc[]')[i].value = "N/A";
   }
   
   var stotalbillnio = parseFloat(stotalbill)*parseFloat(tc);
   var totalbillnio = parseFloat(totalbill)*parseFloat(tc);
   gtotalbillnio+=parseFloat(totalbill)*parseFloat(tc);
   var nioexempt = parseFloat(exempt)*parseFloat(tc); 


   ///////////////////////
   //
   //RETENCIONES 
   //
   ///////////////////////
   
   if(stotalbillnio >= 1001){ 
   //Retenciones ALCALDIA
   var p2 = document.getElementById('retention1').value;
   if(p1 != ""){
	 		//Calcula el valor por factura de la retencion ALCALDIA
			var p1ammount = stotalbillnio*(p1/100);
		
			if(p1ammount > 0){
				//Escribe el valor de la retencion de alcaldia de la factura
				document.getElementsByName('bimi[]')[i].value = parseFloat(p1ammount.toFixed(2));
				document.getElementsByName('ret1a[]')[i].value = parseFloat(p1ammount);
		  		//Campo para sumar el total de la retencion de alcaldia
				gp1ammount += p1ammount;
				//Campo en el que vamos sumando el total de las retenciones alcaldia y IR
				gtotalret += p1ammount;
				//Campo en el que vamos sumando el total de las retenciones alcaldia y IR (Dolares)
				gtotalretusd += parseFloat(p1ammount)/parseFloat(tc); 
				
	  		}
					
   		}else{
			
			document.getElementsByName('bimi[]')[i].value = "0.00";
			document.getElementsByName('ret1a[]')[i].value = "0.00";
   }
   
   }
   else{
	   
	   document.getElementsByName('bimi[]')[i].value = "0.00";
	   document.getElementsByName('ret1a[]')[i].value = "0.00";
   }
   
   if(parseFloat(exempt) > 0){
   	stotalbillnio-=parseFloat(nioexempt);
   }
   if(stotalbillnio >= 1001){   
   //Retenciones IR
   var p2 = document.getElementById('retention2').value;
   if(p2 != ""){
			//Calcula el valor por factura de la retencion IR
	   		var p2ammount = stotalbillnio*(p2/100);
	   		if(p2ammount > 0){
				//Escribe el valor de la retencion de alcaldia de la factura
				document.getElementsByName('bir[]')[i].value = parseFloat(p2ammount.toFixed(2));
				document.getElementsByName('ret2a[]')[i].value = parseFloat(p2ammount);
				//Campo para sumar el total de la retencion de IR
				gp2ammount += p2ammount;
				//Campo en el que vamos sumando el total de las retenciones alcaldia y IR
				gtotalret += p2ammount;
				//Campo en el que vamos sumando el total de las retenciones alcaldia y IR (Dolares)
				gtotalretusd += parseFloat(p2ammount)/parseFloat(tc);  
			}
					
		}else{
			
			document.getElementsByName('bir[]')[i].value = "0.00";
			document.getElementsByName('ret2a[]')[i].value = "0.00";
   }
   
   }
   else{
	   
	   document.getElementsByName('bir[]')[i].value = "0.00";
	   document.getElementsByName('ret2a[]')[i].value = "0.00";
   }

} 
	//Subtotal facturas 
	document.getElementById('stotalbill').value = commas(gstotalbill.toFixed(2));
	document.getElementById('totaltax').value = commas(gtax.toFixed(2)); 
	document.getElementById('totalbill').value = commas(gtotalbill.toFixed(2));
	document.getElementById('totalintur').value = commas(gintur2.toFixed(2));
	document.getElementById('gexempt').value = commas(gexempt.toFixed(2));
	document.getElementById("retention1ammount").value = commas(gp1ammount.toFixed(2));
	document.getElementById("retention2ammount").value = commas(gp2ammount.toFixed(2));
	
	var payment = 0;
	
	if(!billcurrency){
		
		var billcurrency = document.getElementById("billcurrency2").value;
		
	}
	
	
	//Cancelacion en Cordobas
	
	if(((currency2pay == 1) && (billcurrency == 1)) || ((currency2pay == 2) && (billcurrency == 1)) || (currency2pay == 1) && (billcurrency == 2)){	 
		
		if(parseFloat(gtotalbillnio) > 0){
			totalpaynio += parseFloat(gtotalbillnio);   
		}
		if(parseFloat(gtotalret) > 0){
			totalpaynio -= parseFloat(gtotalret); 
		} 
		if(document.getElementById('retainer2').checked == true){
			totalpaynio += parseFloat(gtotalret);
		
		}
			
		document.getElementById('floatpayment').value = totalpaynio.toFixed(2);
		document.getElementById('floatcurrency').value = '1';
		document.getElementById('payment').value = commas(totalpaynio.toFixed(2))+' Cordobas';
	}
	
	//Cancelacion en Dolares
	if((currency2pay == 2) && (billcurrency == 2)){
		
		var totalpay = 0;
		if(parseFloat(gtotalbill) > 0){
			totalpay += parseFloat(gtotalbill);  
		}
		if(parseFloat(gtotalretusd) > 0){
			totalpay -= parseFloat(gtotalretusd); 
		}
		if(document.getElementById('retainer2').checked == true){
			totalpay += parseFloat(gtotalretusd);
		
		} 
	
		
		document.getElementById('floatpayment').value = totalpay.toFixed(2);
		document.getElementById('floatcurrency').value = '2';
		document.getElementById('payment').value = commas(totalpay.toFixed(2))+' Dolares'; 
		
	}
	
}


function getTc(today) {
    $.ajaxSetup({async:false}); 

    var returnData = null;

    $.post("payment-order-tc.php", { today: today }, function(data) {

        returnData = data; 

    });

    $.ajaxSetup({async:true}); 
	return returnData;

} 
 
function loadcurrency2pay(){
	
	var dspayment2pay = document.getElementById('dspayment').value;
	
	if(dspayment2pay == '1'){
		var id2pay = document.getElementById('provider').value;
		$.post("reload-currency2pay.php", { variable: id2pay }, function(data){
			$("#currency2pay").val(parseInt(data)); 	
});
	}else{
		 
		$("#currency2pay").val(1);  	 
	}
}

function justLetters(cammount,i){
	
   $.post("reload-numberstoletters.php", { variable: cammount }, function(data){
	 
  document.getElementsByName('letters[]')[i].value = data;
   
}); 
} 



</script>