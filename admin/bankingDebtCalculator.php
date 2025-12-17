<? include('sessions.php'); ?>
<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<meta content="" name="description"/>

<meta content="" name="author"/> 

<!-- BEGIN GLOBAL MANDATORY STYLES --> 

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>


<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<link rel="shortcut icon" href="favicon.ico"/>
<style>
	input{
		padding-left: 5px;
	}
</style>
</head>	
<script>
	
	function calculateResult(){
	var amount = document.getElementById('amount').value;
	var interest = document.getElementById('interest').value;
	var term  = document.getElementById('term').value;
	
	if((amount > 0) && (interest > 0) && (term > 0)){
		interest = interest/100;
		var result = amount*interest*(term/360);
		result = result.toFixed(2);
		result = result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		document.getElementById('result').value = result; 
	}else{
		document.getElementById('result').value = '';
	}
	
	/*document.getElementById('data').value = 'amount: '+amount+' | interest: '+interest+' | term: '+term;*/
	
	
}
	
	function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
	
</script>
<body>
<form style="margin-left:30px;">
	<h1>Calculadora</h1>
	
	<label>Monto principal</label><br>
	<input type="text" name="amount" id="amount" onkeypress="return justNumbers(event);" onKeyUp="calculateResult();"><br><br>
	<label>Porcentaje de interés</label><br>
	<input type="text" name="interest" id="interest" onkeypress="return justNumbers(event);" onKeyUp="calculateResult();"> %<br><br>
	<label>Plazo en días</label><br>
	<input type="text" name="term" id="term" onkeypress="return justNumbers(event);" onKeyUp="calculateResult();"><br><br>
	<label>Interes</label><br>
	<input type="text" name="result" id="result" readonly style="background-color:#98C788; color: #28293A;">
	<? /*
	<label>Data</label><br>
	<input type="text" name="data" id="data" readonly>
	*/ ?>
</form>	
</body>	