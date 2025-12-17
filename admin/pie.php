
	<style type="text/css">
	
	.demo-placeholder {
	width: 100%;
	height: 100%;
	font-size: 14px;
	line-height: 1.2em;
	}
	.demo-container {
		position: relative;
		height: 400px;
	}
	#placeholder {
		width: 550px;
	}
	#description {
		margin: 15px 10px 20px 10px;
	}
	</style>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.flot.pie.js"></script>
	<script type="text/javascript">

	$(function() {

		// Example Data

		//var data = [
		//	{ label: "Series1",  data: 10},
		//	{ label: "Series2",  data: 30},
		//	{ label: "Series3",  data: 90},
		//	{ label: "Series4",  data: 70},
		//	{ label: "Series5",  data: 80},
		//	{ label: "Series6",  data: 110}
		//];

		//var data = [
		//	{ label: "Series1",  data: [[1,10]]},
		//	{ label: "Series2",  data: [[1,30]]},
		//	{ label: "Series3",  data: [[1,90]]},
		//	{ label: "Series4",  data: [[1,70]]},
		//	{ label: "Series5",  data: [[1,80]]},
		//	{ label: "Series6",  data: [[1,0]]}
		//];

		//var data = [
		//	{ label: "Series A",  data: 0.2063},
		//	{ label: "Series B",  data: 38888}
		//];

		// Randomly Generated Data

		var data = [];
			

		
			data[0] = {
				label: "Hola Mundo",
				data: 3,
			}
			data[1] = {
				label: "Hola Mundo",
				data: 1,
			}
		 

		var placeholder = $("#placeholder");

		
			placeholder.unbind();

			$.plot(placeholder, data, {
				series: {
					pie: { 
						show: true
					}
				},
				legend: {
					show: false
				}
			});

			
		
	});

	// A custom label formatter used by several of the plots

	function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}

	//
	</script>



		<div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		
		</div>

 

 