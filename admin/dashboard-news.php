<? include_once('sessions.php'); ?><div class="row">
<div class="col-md-12">

   <ul class="page-breadcrumb breadcrumb" style="background-color:#26afe4;">

						<li>

							<i class="fa fa-rss" style="color:#FFFFFF;"></i>

							<a href="dashboard.php" style="color:#FFFFFF;">Noticias</a>
      

						</li>


					</ul>
        
       
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<a name="news" class="scrollLink"></a>Últimas Noticias

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php
								
								
								
								//Load profiles 
								$querylprofiles_news = "select * from routes where worker = '$_SESSION[userid]' group by type";
								$resultlprofiles_news = mysqli_query($con, $querylprofiles_news);
								$andor_news = " and (";
                                $sql_news = '';
								while($rowlprofiles_news=mysqli_fetch_array($resultlprofiles_news)){
									$sql_news.= $andor_news." (profiles like '%".$rowlprofiles_news['type']."%')";
									$andor_news = " or";  
								}
								$sql_news.= ")";
								
								#last 10 news
                                $strAlert = '';
								$query_news10 = "select * from news where visible = '1' and id >= '20'$sql_news order by id desc limit 10";
								$result_news10 = mysqli_query($con, $query_news10);
								$num_news10 = mysqli_num_rows($result_news10);
								while($row_news10=mysqli_fetch_array($result_news10)){ 
									$makeAlert = 1;
									$query_news_check = "select * from newsread where userid='$_SESSION[userid]' and newsid='$row_news10[id]'";
									$result_news_check = mysqli_query($con, $query_news_check);
									$num_news_check = mysqli_num_rows($result_news_check);
									if($num_news_check == 0){ 
										$query_news_insert = "insert into newsread (userid, newsid) values ('$_SESSION[userid]', '$row_news10[id]')";
										$result_news_insert = mysqli_query($con, $query_news_insert);
									}else{
										$row_news_check = mysqli_fetch_array($result_news_check);
										if($row_news_check['nread'] == 1){
											$makeAlert = 0;
										}
										
									}
									
									if($makeAlert == 1){
										$strAlert.= 'toastr.warning("'.$row_news10['name'].'<br><a href=\'news-view.php?id='.$row_news10['id'].'\'>[Leer]</a>", "Nueva noticia");
										';
									}
								}
								
								
								$query_news = "select * from news where visible = '1' ".$sql_news." order by id desc limit 5";
								$result_news = mysqli_query($con, $query_news);  
								$num_news = mysqli_num_rows($result_news);
								if($num_news > 0){ ?>
                                
                                <style type="text/css">
								@-webkit-keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
@-moz-keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
@-o-keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
@keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
.invalid {
  -webkit-animation: invalid 2s infinite; /* Safari 4+ */
  -moz-animation:    invalid 2s infinite; /* Fx 5+ */
  -o-animation:      invalid 2s infinite; /* Opera 12+ */
  animation:         invalid 2s infinite; /* IE 10+ */
}		
								</style>

								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									
									
                                         <th width="17%">

										 Nombre</th>
                                         <th width="5%">

										 Fecha y hora</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($row_news=mysqli_fetch_array($result_news)){
								$lastday_news = $row_news['today'];
								$lastday_news = strtotime ( '+7 day' , strtotime ( $lastday_news ) ) ;
								$lastday_news = date ( 'Y-m-d' , $lastday_news );
									
								if($lastday_news >= date('Y-m-d')){
										$invalid_news = 'class="invalid"';
								}else{
									$invalid_news = '';
								}
								?>
                                
                                <tr role="row" class="odd"> 
                                <td <? echo $invalid_news; ?>><?php echo $row_news['name']; ?></td>
                                <td <? echo $invalid_news; ?>><?php echo date('d-m-Y',strtotime($row_news['today']))." @". date('h:i:s a', strtotime($row_news['totime'])); ?></td>
                                <td <? echo $invalid_news; ?>><a href="news-view.php?id=<?php echo $row_news['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Leer</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                <? //<p>Ver todas las noticias</p> ?>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay noticias.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div> 

			<!-- END PAGE CONTENT-->

		</div>
     
         
        </div>
        </div>
        <div class="row"></div>