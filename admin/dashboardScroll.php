<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div id="1" style="height: 500px; background-color:aqua; ">1</div>
<div id="2" style="height: 500px; background-color:black;color:white;">2</div>
<div id="3" style="height: 500px; background-color:red;">3</div>
<div id="4" style="height: 500px; background-color:palevioletred;">4</div>
<div id="5" style="height: 500px; background-color:yellowgreen;">5</div>


<script>
$( "#2" ).on( "scroll", function() {
  $( "#1" ).append( "<div>Handler for called.</div>" );
} );
    
</script>
