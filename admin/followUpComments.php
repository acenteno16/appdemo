<? 

include('sessions.php');

$today = date('Y-m-d');
$totime = date('H:i:s');
$id = $_POST['id'];
$comments = $_POST['comments'];
$user = $_SESSION['userid'];
$uid = $_POST['uid'];

$query = "insert into followupComments (today, totime, followup, userid, comments, uid) values ('$today', '$totime', '$id', '$user', '$comments', '$uid')";
$result = mysqli_query($con, $query);

$queryFollowupComments = "select * from followupComments where followup = '$id' order by id desc";
$resultFollowupComments = mysqli_query($con, $queryFollowupComments);
while($rowFollowupComments=mysqli_fetch_array($resultFollowupComments)){ ?>

<li class="in"> <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar1.jpg"/>
  <div class="message"> <span class="arrow"> </span> <a href="#" class="name"> <? echo $rowFollowupComments['userid']; ?> </a> <span class="datetime"> @<? echo $rowFollowupComments['today'].' '.$rowFollowupComments['totime']; ?> </span> 
	  <span class="body"> <? echo $rowFollowupComments['comments']; ?> </span> 
	<? 
	  $queryFiles = "select * from followupFiles where uid = '$rowFollowupComments[uid]'";
	  $resultFiles = mysqli_query($con, $queryFiles);
	  $numFiles = mysqli_num_rows($resultFiles);
	  if($numFiles > 0){
		  echo '<ul class="list-inline blog-images">';
		  while($rowFiles=mysqli_fetch_array($resultFiles)){ 
			  $baseId = base64_encode($id.','.$rowFiles['filename']); 
			#echo "<img src='followUpImage.php?token=$baseId' width='70px' height='70px'> "; ?>
		<li><a class="fancybox" href="followUpImage.php?token=<? echo $baseId; ?>&image=show.png" data-fancybox-group="gallery<? echo $rowFollowupComments['id']; ?>">
			<img width="100" height="100" src="followUpImage.php?token=<? echo $baseId; ?>">
			</a>
	    </li>  
	  <?
		  } 
	      echo '</ul>';
	  ?>
	  
	 <? } ?> 
	</div>
</li>
									
<? } ?>