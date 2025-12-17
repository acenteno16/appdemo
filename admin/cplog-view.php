<? 
/*
include('sessions.php');

$query = "select * from cplog order by id desc limit 30";
$result = mysqli_query($con, $query);

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><? echo date('H:i:s')?> | VPN Active</title>
</head>

<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="10%">ID</td>
      <td width="10%">USERID</td>
      <td width="60%">LOCATION</td>
      <td width="20%">DATE/TIME</td>
    </tr>
    <? while($row=mysqli_fetch_array($result)){ ?>
     <tr>
      <td><? echo $row['id']; ?></td>
      <td><? echo $row['userid']; ?></td>
      <td><? echo $row['cfile']; ?></td>
      <td><? echo $row['now']; ?></td>
    </tr>
    <? } ?>
  </tbody>
</table>
</body>
</html>

<script>
setTimeout(function(){
   window.location.reload(1); 
}, 1000); 
</script>
*/ ?>