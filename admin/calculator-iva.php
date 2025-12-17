<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Calculadora</title>
</head>

<body>
IVA<br>
<input type="text" name="iva" id="iva" onKeyUp="calculate(this.value);">
<br>
Sub-total:<br>
<input type="text" name="stotal" id="stotal" disabled>
</body>
</html>

<script>
function calculate(valor){
	var nvalue = (100*valor)/15; 
	document.getElementById('stotal').value = nvalue.toFixed(2); 
}
</script>