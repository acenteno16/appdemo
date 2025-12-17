<?php include("sessions.php"); 
$id = $_POST['variable'];
$sql = "";
if($id != 0){
	$sql = " where parentcat = '$id'";
}
$query = "select * from categories".$sql;

?>
<div id="dcategories" >
        <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">	<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('cid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script></th>

									<th width="5%">

										 ID</th>

									<th width="28%">

										 Nombre</th>

									<th width="25%">Cuenta</th>

								  </tr>

								</thead>

								<tbody>
                                <?php $result = mysqli_query($con, $query);
								while($row=mysqli_fetch_array($result)){
								if($row['id'] != 1){
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><input name="cid[]" type="checkbox" id="cid[]" value="<?php echo $row['id']; ?>"></td><td><?php echo $row['id']; ?></td><td><?php echo $row['name']; ?></td><td><?php echo $row['account'];  ?></td></tr>
                                <?php } }
								
								?>
                                   </tbody>

								</table>                                                   </div>