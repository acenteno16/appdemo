<script>
function reloadNumbers(){	
 
	loadcurrency2pay(); 
	
	<?php //read globals
	
	$queryglobals = "select * from config where id = 1";
	$resultglobals = mysqli_query($con, $queryglobals);
	$rowglobals = mysqli_fetch_array($resultglobals); 
	
	?>
	
	divRetention()
	
	var gtotal=0;
	var gtotalbill = 0;
	var gretstotal = 0; 
	var tax = 0;
	var exempt = 0;
	var gexempt = 0;
	var gtax = 0;
	var gstotal = 0;
	var billcurrency = 0;
	var gtotalret = 0;
	var gp1ammount = 0;
	var gp2ammount = 0;
	var totalretusd = 0;
	var gtotalbillnio = 0;
	var gtotalretusd = 0;
	var gexempt = 0;
	var gintur2 = 0;

	var currency = document.getElementsByName('currency');
		
	for (var i = 0, length = currency.length; i < length; i++) {
    
	if (currency[i].checked) {
    	var billcurrency = currency[i].value;
	}
	} 
	
	var currency2pay = document.getElementById('currency2pay').value;
	
	
	var giva = <?php echo ($rowglobals['iva']/100); ?>;
	var gintur = <?php echo ($rowglobals['intur']/100); ?>;
	
	var p1 = document.getElementById("retention1").value;
	var p2 = document.getElementById("retention2").value; 

for (var i = 0; i < document.getElementsByName('stotal[]').length; i++) {
   
  
  var billdate = document.getElementsByName('billdate[]')[i].value; 
	if((billcurrency == 2) && (billdate == '')){
		alert('Ingrese una fecha para calcular el tipo de cambio');
		document.getElementsByName('billdate[]')[i].focus(); 
		
	}
	
   //Sub-total (graba iva)
   var stotal = document.getElementsByName('stotal[]')[i].value;
   stotal = numberFormat(stotal);
   //Okay 
	
   //IVA
   var tax = stotal*giva;
   document.getElementsByName('tax[]')[i].value = commas(tax.toFixed(2));
   //Okay 
	
   //Sub-total (exento de iva)
   var stotal2 = document.getElementsByName('stotal2[]')[i].value;
   stotal2 = numberFormat(stotal2);
   //Okay 
	
   //INTUR
   var intur = document.getElementsByName('inturammount[]')[i].value;
   var intur = numberFormat(intur);
   //Okay 
   
   //INTUR ammount
   var inturammount = intur*gintur;
   document.getElementsByName('inturammount2[]')[i].value = commas(inturammount.toFixed(2));
   //Okay   
   
   //total
   var totalbill = 0;
   if(parseFloat(stotal) > 0){
	   totalbill = parseFloat(totalbill)+parseFloat(stotal);
   }
   if(parseFloat(stotal2) > 0){
	   totalbill = parseFloat(totalbill)+parseFloat(stotal2);
   }
   if(parseFloat(tax) > 0){
	   totalbill = parseFloat(totalbill)+parseFloat(tax);
   }
   if(parseFloat(inturammount) > 0){
	   totalbill = parseFloat(totalbill)+parseFloat(inturammount);
   }
   
   justLetters(totalbill,i);
  
   document.getElementsByName('ammount[]')[i].value = commas(totalbill.toFixed(2));
   //Okay 
   
   //Total C$
   var totalbillcs = 0;
   
   //bill retention
   if(billcurrency == 2){
	   
	   var tc = getTc(billdate);
	   var totalbillcs = parseFloat(totalbill)*parseFloat(tc);
   }
   else{
	   var tc = 1;
	   totalbillcs = totalbill;
   }
   var stotalbill = 0;
   if(parseFloat(stotal) > 0){
	   var stotalbill = parseFloat(stotal);
   }
   if(parseFloat(stotal2) > 0){
	   var stotalbill = parseFloat(stotalbill)+parseFloat(stotal2);
   } 
   
   var stotalbillnio = 0;
   var stotalbillnio = parseFloat(stotalbill)*parseFloat(tc);
   //Okay 
   
   //Exempt
   var exempt = document.getElementsByName('exempt[]')[i].value;
   var exempt = numberFormat(exempt);
   
   if(parseFloat(exempt) > 0){
	   gexempt += exempt;
   }
   //Okay
   
   //Sub-total exento
   var stotalexempt = 0;
   var stotalexempt = parseFloat(stotalbillnio); 
   if(parseFloat(exempt)){
	   stotalexempt -= parseFloat(exempt)*parseFloat(tc);
   }
   //Okay
   
   //RETENCIONES
   
   var totalbillnio = 0;
   if(parseFloat(totalbill) > 0){
	   var totalbillnio = parseFloat(totalbill)*parseFloat(tc);
	   gtotalbillnio += parseFloat(totalbillnio);
   }
   
   
   
   
   if(stotalbillnio >= 1001){ 
				
   		if(p1 != ""){
	 		var p1ammount = stotalexempt*(p1/100);
	  		if(p1ammount > 0){
				document.getElementsByName('ret1a[]')[i].value = parseFloat(p1ammount);
		  		gp1ammount += p1ammount;
				
	  		}
					
   		}
		
   		if(p2 != ""){
	   		var p2ammount = stotalexempt*(p2/100);
	   		if(p2ammount > 0){
				document.getElementsByName('ret2a[]')[i].value = parseFloat(p2ammount);
				gp2ammount += p2ammount;
			}
					
		} 
	
   }
   
   var totalret = 0;
   if(parseFloat(p1ammount) > 0){
	   totalret += parseFloat(p1ammount);
	   totalretusd += parseFloat(p1ammount)*parseFloat(tc);
   }
   if(parseFloat(p2ammount) > 0){
	   totalret += parseFloat(p2ammount);
	   totalretusd += parseFloat(p2ammount)*parseFloat(tc);
   }
   
   var niopayment = 0;
   var niopayment = parseFloat(totalbillcs)-parseFloat(totalret);
   var usdpayment = parseFloat(niopayment)/parseFloat(tc); 

   if(parseFloat(stotalbill) > 0){
	   gstotal += parseFloat(stotalbill);
   }
   if(parseFloat(tax) > 0){
	   gtax += parseFloat(tax);
   }
   if(parseFloat(totalbill) > 0){
	   gtotalbill += totalbill;
   }
   
   if(parseFloat(totalret) > 0){
	   gtotalret += totalret;
	   gtotalretusd += parseFloat(totalret)/parseFloat(tc); 
   }
   if(parseFloat(inturammount) > 0){
	   gintur2 += inturammount ; 
   }

} //End for
	
	document.getElementById('stotalbill').value = commas(gstotal.toFixed(2));
	document.getElementById('totaltax').value = commas(gtax.toFixed(2));
	document.getElementById('totalbill').value = commas(gtotalbill.toFixed(2));
	document.getElementById('totalintur').value = commas(gintur2.toFixed(2));
	
	document.getElementById("retention1ammount").value = commas(gp1ammount.toFixed(2));
	document.getElementById("retention2ammount").value = commas(gp2ammount.toFixed(2));
	
	var payment = 0;
	if(billcurrency == 0){
		
		var billcurrency = document.getElementById("billcurrency2").value;
		
	}
	//proveedor cordobas // Pago en cordobas
	if(((currency2pay == 1) && (billcurrency == 1)) || ((currency2pay == 2) && (billcurrency == 1))){ 
		if(parseFloat(gtotalbill) > 0){
			payment += parseFloat(gtotalbill); 
		}
		if(parseFloat(gtotalret) > 0){
			payment -= parseFloat(gtotalret); 
		} 
		document.getElementById('floatpayment').value = payment.toFixed(2);
		document.getElementById('floatcurrency').value = '1';
		document.getElementById('payment').value = commas(payment.toFixed(2))+' Cordobas';
	}
	
	//Proveedor en cordobas // Pago en Dolares // Cancelacion en cordobas
	if((currency2pay == 1) && (billcurrency == 2)){
		
		
		if(parseFloat(gtotalbillnio) > 0){
			payment += parseFloat(gtotalbillnio);  
		}
		if(parseFloat(gtotalret) > 0){
			payment -= parseFloat(gtotalret); 
		} 
	
		document.getElementById('floatpayment').value = payment.toFixed(2);
		document.getElementById('floatcurrency').value = '1';
		document.getElementById('payment').value = commas(payment.toFixed(2))+' Cordobas'; 
		
	}
	
	
	if((currency2pay == 2) && (billcurrency == 2)){
		
		
		if(parseFloat(gtotalbill) > 0){
			payment += parseFloat(gtotalbill);  
		}
		if(parseFloat(gtotalretusd) > 0){
			payment -= parseFloat(gtotalretusd); 
		} 
	
		
		document.getElementById('floatpayment').value = payment.toFixed(2);
		document.getElementById('floatcurrency').value = '2';
		document.getElementById('payment').value = commas(payment.toFixed(2))+' Dolares'; 
		
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