<?php 

include("verify session.php");
 $id = $_GET['pid'];
 

  if($_SESSION['thewebsite'] == 1){
  
  require('fpdf.php');
  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->SetMargins(0,0,0);
  $pdf->SetAutoPageBreak(false); 
  $pdf->Image('pdf_Pictures/top.png',0,0,210,38,'','http://www.aurorabeachfront.com');
 
   
 
  
  $query = "select * from aproperties where id = '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  
  //PICTURES
  $x=10;
  $y=40;
  $w=40;
  $h=31;
  $space=45;
  
  if ($row[p1]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p1],60,$y, 142, 96);
  
  if ($row[p2]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p2],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p3]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p3],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p4]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p4],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p5]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p5],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p6]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p6],$x,$y, $w, $h);  
  
 //TITLE

  $tnum = strlen($row[1]);
  switch($tnum){
	  case ($tnum > 50):
	  $size = 10;
	  break;
	   case ($tnum > 45):
	  $size = 10;
	  break;
	  case($tnum > 40):
	  $size = 15;
	  break;
	   case ($tnum > 35):
	  $size = 15;
	  break;
	  case($tnum > 30):
	  $size = 20;
	  break;
	   case ($tnum > 25):
	  $size = 25;
	  break;
	  case($tnum > 20):
	  $size =30;
	  break;
	  case($tnum < 20):
	  $size =30;
	  break;
  }
 
  $linea = 133;
  
  $pdf->SetFont('Arial','B',$size);
  $pdf->SetTextColor(0,182,213);
  $pdf->SetXY(58,$linea);
  $pdf->Cell(10,34,$row[1]);
  
  $linea = $linea+30;
  
  $pdf->SetXY(58,$linea);
  $pdf->SetFont('Arial','B',24);
  $pdf->SetTextColor(0,182,213);
  $pdf->Cell(0,0,'Offered at: ', 2, '.',',');
  $pdf->SetXY(104,$linea);
  $pdf->SetFont('Arial','B',33);
  $pdf->SetTextColor(0,0,0);
  $pdf->Cell(0,0,'$'. number_format($row[price], 0, '.',','));
  
 
  //OVERVIEW
 
  if ($row[overview] != ""){
 
  $linea = $linea+10; 
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','B',12);
  $pdf->SetTextColor(0,182,213);
  $pdf->Cell(0,0,'Overview: ', 2, '.',',');
  $linea = $linea+5;
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','',10);
  $pdf->SetTextColor(0,0,0);
  $pdf->MultiCell(140,4 ,$row[overview]);
  
  } 
  
  $osize = strlen($row[overview]);
  $osize = intval($osize);
  $osize = $osize/50;

  $osize = intval($osize);
  $osize = $osize*2;
  $osize = $osize+10;
  $linea = $linea+$osize;
  $linea2 = $linea;
  $plinea2 = $linea2;
   
  $pdf->SetXY(60,$linea);
  $py1=$pdf->Gety();
  
  $sp1 = 50;
  $sp2 = 4;
  $h = 5;
  $h2 = 5;
  $h4 = 10;
  
  $pdf->SetFont('Arial','',8);
  $pdf->SetTextColor(0,0,0);
 
#####################STAR#######################

  if($row[amenities] != ""){
   $amenities = ($row[amenities]);
   
  $aamenities = explode(", ", $amenities);
  $numa = count($aamenities);
  
  
  if($numa<10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(140,$linea2);
  $plinea2 = $plinea2+$h4;
  
  foreach($aamenities as $b) {  
  if ($b != "") {
  $pdf->SetFont('Arial','',8);
  $pdf->SetXY(140,$linea2);
  $plinea2 = $plinea2+$h2;
  }
  }
  }
  if($numa >10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(125,$linea2);
  $plinea2 = $plinea2+$h4;
  
 for($i=1;$i<11;$i++){
 $pdf->SetXY(125,$linea2);
 $pdf->SetFont('Arial','',8);
 $plinea2=$plinea2+$h2;
 
 }
 }
 }

######################END######################

  $px = 60-1;
  $py = $py1;
  $pw = 140;
  $ph = $plinea2+$h2;
  $ph = $ph-$py;
  if ($numa<11){
  switch($numa){
  case 0:
  if ($row[beds] != 0) { 
	$ph = $ph+($h2*1);
	}
	if ($row[baths] != 0.0) { 
	$ph = $ph+($h2*1);
	}
	if ($row[address] != "") { 
	$ph = $ph+($h2*1);
	}
	if ($row[lsfeet] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[lsmeters] != 0.0) { 
	$ph = $ph+($h2*1);
	}
	if ($row[lsvaras] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[lsacres] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[bsfeet] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[beaches] != "") { 
	$nbeach = strlen($row[beaches]);
	$nlines = $nbeach/30;
	$nlines = intval($nlines);
	$ph = $ph+($h2*$nlines);
	}
	$ph = $ph+($h2*3 );
	break;
  case 1:
  $ph = $ph+($h2*1)+4;
  break;
    case 2:
  $ph = $ph+($h2*2)+4;
  break;
    case 3:
  $ph = $ph+($h2*3)+4;
  break;
    case 4:
  $ph = $ph+($h2*4)+4;
  break;
    case 5:
  $ph = $ph+($h2*5)+4;
  break;
    case 6:
  $ph = $ph+($h2*6)+4;
  break;
    case 7:
  $ph = $ph+($h2*7)+4;
  break;
      case 8:
  $ph = $ph+($h2*8)+4;
  break;
      case 9:
  $ph = $ph+($h2*9)+4;
  break;
      case 10:
  $ph = $ph+($h2*10)+4;
  break;
  
  }
  }
  

 
  $ph = $ph+($h2*1)+2; 
  $py = $linea-3;
  $pdf->Image('../box.jpg',$px,$py,$pw,$ph); 
  
   if($row[amenities] != ""){
   $amenities = ($row[amenities]);
   
  $aamenities = explode(", ", $amenities);
  $numa = count($aamenities);
  if($numa<10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(140,$linea2);
  $pdf->MultiCell($sp1,$sp2, "Amenities: ");
  $linea2 = $linea2+$h4;
  
  foreach($aamenities as $b) {  
  if ($b != "") {
  $pdf->SetFont('Arial','',8);
  $pdf->SetXY(140,$linea2);
  $pdf->MultiCell($sp1,$sp2, $b);
  $linea2 = $linea2+$h2;
  }
  }
  }
  if($numa >10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(125,$linea2);
  $pdf->MultiCell($sp1,$sp2, "Amenities: ");
  $linea2 = $linea2+$h2;
  $linea2 = $linea2+$h2;
  $linea4 = $linea2;
  
  
 for($i=1;$i<11;$i++){
 $pdf->SetXY(125,$linea2);
 $pdf->SetFont('Arial','',8);
 $pdf->MultiCell($sp1,$sp2, $aamenities[$i]);
 $linea2=$linea2+$h2;
 
  }
 for($i=11;$i<30;$i++){
 $pdf->SetXY(160,$linea4);
 $pdf->SetFont('Arial','',8);
 $pdf->MultiCell($sp1,$sp2, $aamenities[$i]);
 $linea4=$linea4+$h2;
 
 }
 }
 }
  
 
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Property Details:");
	$linea = $linea+$h;
	$linea = $linea+$h;
	$pdf->SetFont('Arial','',8);
   
   if ($row[beds] != 0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Bedrooms: ".$row[beds]);
	$linea = $linea+$h;
	}
	if ($row[baths] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$baths = "Bathrooms: ".str_replace(".0","",$row[baths]);
	$pdf->MultiCell($sp1, $sp2, $baths); 
	$linea = $linea+$h;
	}
	if ($row[address] != "") { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Address: ".$row['address']);
	$linea = $linea+$h;
	}
	if ($row[lsfeet] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Lot Size (sq. Feet): ".$row['lsfeet']); 
	$linea = $linea+$h;
	} 
	if ($row[lsmeters] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1,$sp2, "Lot Size (sq Meters): ".$row['lsmeters']);
	$linea = $linea+$h;
	}
	if ($row[lsvaras] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1,$sp2 ,"Lot Size (sq Varas): ".$row['lsvaras']);
	$linea = $linea+$h;
	} 
	if ($row[lsacres] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2 ,"Lot Size (sq Acres): ".$row['lsacres']); 
	$linea = $linea+$h;
	} 
	if ($row[bsfeet] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Building Size (sq Feet): ".$row['bsfeet']); 
	$linea = $linea+$h;
	} 
	if ($row[beaches] != "") { 
	
	$nbeach = strlen($row[beaches]); 
	
	$pdf->SetXY(60,$linea);
	$beaches1 = "Beaches near the property:  ".substr($row[beaches], 0,($nbeach - 2)).".";
	$pdf->MultiCell($sp1, $sp2, $beaches1); 
	$linea = $linea+$h;
	}
	


  $pdf->SetXY(40,-20);
  $pdf->SetFont('Arial','B',7);
  $pdf->SetTextColor(0,182,213);
  $pdf->Write(3,'AURORA BEACHFRONT REALTY ');
  $pdf->SetXY(80,-20);
  $pdf->SetFont('Arial','',7);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,'Del Timon 1/2 cuadra al este, San Juan del Sur, Nicaragua. Call Our US Line!!');
  $pdf->SetXY(55,-17);
  $pdf->SetFont('Arial','B',7);
  $pdf->Write(3,'(323) 908-6730');
  $pdf->SetXY(73,-17);
  $pdf->SetFont('Arial','',7);
  $pdf->Write(3,'Office');
  $pdf->SetXY(80,-17);
  $pdf->SetFont('Arial','B',7);
  $pdf->Write(3,'011 (505) 884-7141');
  $pdf->SetXY(103,-17);
  $pdf->SetFont('Arial','',7);
  $pdf->Write(3,'Email: ');
  $pdf->Write(3,'info@aurorabeachfront.com','mailto:info@aurorabeachfront.com');
  $pdf->SetXY(85,-14);
  $pdf->SetFont('Arial','',10);
  $pdf->Write(3,'www.aurorabeachfront.com','a href = http://www.aurorabeachfront.com');
  
  
  $pdf->SetDrawColor(240, 240, 240);

 

  $directory =  '../nicaraguarealestate/property/files/'.$row[1];
  if (!file_exists($directory)){


mkdir('../nicaraguarealestate/property/files/'.$row[1].'');

}
  $newfilename='../nicaraguarealestate/property/files/'.$row[1].'/'.$row[1].'.pdf';
  $pdf->Output($newfilename);
  }
 if($_SESSION['thewebsite'] == 2){
	 
	
	  //Leon
	  
	  #########################################################################################
	  #                                                                                       #
	  #                                                      #  #     #                       #
	  #                     #      ####  #####  #   #       #    # #   #                      #
	  #                     #      #     #   #  ##  #       #    #    #                       #
	  #                     #      ####  #   #  # # #        #      #                         #
	  #                     #      #     #   #  #  ##         #   #                           #
	  #                     #####  ####  #####  #   #           #                             #
	  #                                                                                       #
	  #                                                                                       #
	  #                                                                                       #
	  #########################################################################################

	  
  require('fpdf.php');
  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->SetMargins(0,0,0);
  $pdf->SetAutoPageBreak(false);
  $pdf->Image('pdf_Pictures/top-leon.png',0,0,210,38,'','http://www.nicaraguarealestateleon.com');
   
  $id = $_GET['pid'];
  
  $query = "select * from aproperties where id = '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  
  //PICTURES
  $x=10;
  $y=40;
  $w=40;
  $h=31;
  $space=45;
  
  if ($row[p1]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p1],60,$y, 142, 96);
  
  if ($row[p2]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p2],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p3]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p3],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p4]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p4],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p5]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p5],$x,$y, $w, $h);
  $y=$y+$space;
  
  if ($row[p6]!='') $pdf->Image('../nicaraguarealestate/property/images/'.$row[lname].'/'.$row[p6],$x,$y, $w, $h);  
  
 //TITLE

  $tnum = strlen($row[1]);
  switch($tnum){
	  case ($tnum > 50):
	  $size = 10;
	  break;
	   case ($tnum > 45):
	  $size = 10;
	  break;
	  case($tnum > 40):
	  $size = 15;
	  break;
	   case ($tnum > 35):
	  $size = 15;
	  break;
	  case($tnum > 30):
	  $size = 20;
	  break;
	   case ($tnum > 25):
	  $size = 25;
	  break;
	  case($tnum > 20):
	  $size =30;
	  break;
	  case($tnum < 20):
	  $size =30;
	  break;
  }
 
  $linea = 133;
  
  $pdf->SetFont('Arial','B',$size);
  $pdf->SetTextColor(175,0,35);
  $pdf->SetXY(60,$linea);
  $pdf->Cell(10,34,$row[1]);
  $linea = $linea+30;
  
  if($row[price] != 0){
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','B',24);
  $pdf->SetTextColor(0,51,88);
  $pdf->Cell(0,0,'Offered at: ', 2, '.',',');
  $pdf->SetXY(104,$linea);
  $pdf->SetFont('Arial','B',33);
  $pdf->SetTextColor(0,0,0);
  $pdf->Cell(0,0,'$'. number_format($row[price], 0, '.',','));
  $linea = $linea+10;
  }
  $rental = 0;
  if ($row[price2] != 0){
	  $rental = 1;
  }
  if ($row[price3] != 0){
	  $rental = 1;
  }
  if ($rental == 1){
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','B',12);
  $pdf->SetTextColor(0,51,88);
  $pdf->Cell(0,0,'Rental Information:', 2, '.',',');
  $linea = $linea+5;
  } 
  if ($row[price2] != 0){
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','',10);
  $pdf->SetTextColor(37,37,37);
  $pdf->Cell(0,0,'Longterm: $'.number_format($row['price2'], 0, '.',','), 2, '.',',');
  
  }
  if ($row[price3] != 0){
  $linea = $linea+5;
  $pdf->SetXY(60,$linea);
  $pdf->Cell(0,0,'Weekly: $'.number_format($row['price3'], 0, '.',','), 2, '.',',');
  }
  
 
  //OVERVIEW
 
  if ($row['overview'] != ""){
  $linea = $linea+10; 
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','B',12);
  $pdf->SetTextColor(0,51,88);
  $pdf->Cell(0,0,'Overview: ', 2, '.',',');
  $linea = $linea+3;
  $pdf->SetXY(60,$linea);
  $pdf->SetFont('Arial','',10);
  $pdf->SetTextColor(0,0,0);
  $pdf->MultiCell(140,4 ,$row['overview']);
  
  } 
  
  $osize = strlen($row['overview']);
  $osize = intval($osize);
  $osize = $osize/50;

  $osize = intval($osize);
  $osize = $osize*2;
  $osize = $osize+10;
  $linea = $linea+$osize;
  $linea2 = $linea;
  $plinea2 = $linea2;
   
  $pdf->SetXY(60,$linea);
  $py1=$pdf->Gety();
  
  $sp1 = 50;
  $sp2 = 4;
  $h = 3;
  $h2 = 5;
  $h4 = 10;
  
  $pdf->SetFont('Arial','',8);
  $pdf->SetTextColor(0,0,0);
 
#####################STAR#######################

  if($row[amenities] != ""){
  $amenities = ($row[amenities]);
   
  $aamenities = explode(", ", $amenities);
  $numa = count($aamenities);
  
  
  if($numa<10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(140,$linea2);
  $plinea2 = $plinea2+3;
  
  foreach($aamenities as $b) {  
  if ($b != "") {
  $pdf->SetFont('Arial','',8);
  $pdf->SetXY(140,$plinea2);
  $plinea2 = $plinea2+3;
  }
  }
  }
  if($numa >10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(125,$plinea2);
  $plinea2 = $plinea2+3;
  
 for($i=1;$i<11;$i++){
 $pdf->SetXY(125,$plinea2);
 $pdf->SetFont('Arial','',8);
 $plinea2=$plinea2+3;
 
 }
 }
 }

######################END######################

  $px = 60-1;
  $py = $py1;
  $pw = 140;
  $ph = $plinea2+$h2;
  $ph = $ph-$py;
  if ($numa<11){
  switch($numa){
  case 0:
  if ($row[beds] != 0) { 
	$ph = $ph+($h2*1);
	}
	if ($row[baths] != 0.0) { 
	$ph = $ph+($h2*1);
	}
	if ($row[address] != "") { 
	$ph = $ph+($h2*1);
	}
	if ($row[lsfeet] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[lsmeters] != 0.0) { 
	$ph = $ph+($h2*1);
	}
	if ($row[lsvaras] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[lsacres] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[bsfeet] != 0.0) { 
	$ph = $ph+($h2*1);
	} 
	if ($row[beaches] != "") { 
	$nbeach = strlen($row[beaches]);
	$nlines = $nbeach/30;
	$nlines = intval($nlines);
	$ph = $ph+($h2*$nlines);
	}
	
	
	$ph = $ph+($h2*3 );
	break;
  case 1:
  $ph = $ph+($h2*1)+4;
  break;
    case 2:
  $ph = $ph+($h2*2)+4;
  break;
    case 3:
  $ph = $ph+($h2*3)+4;
  break;
    case 4:
  $ph = $ph+($h2*4)+4;
  break;
    case 5:
  $ph = $ph+($h2*5)+4;
  break;
    case 6:
  $ph = $ph+($h2*6)+4;
  break;
    case 7:
  $ph = $ph+($h2*7)+4;
  break;
      case 8:
  $ph = $ph+($h2*8)+4;
  break;
      case 9:
  $ph = $ph+($h2*9)+4;
  break;
      case 10:
  $ph = $ph+($h2*10)+4;
  break;
  
  }
  }
  

  $ph = $ph+($h2*1)+2; 
  $py = $linea-3;
  //$pdf->Image('../box.jpg',$px,$py,$pw,$ph); 
 
   if($row[amenities] != ""){
   $amenities = ($row[amenities]);
   
  $aamenities = explode(", ", $amenities);
  $numa = count($aamenities);
  if($numa<10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(140,$linea2);
  $pdf->MultiCell($sp1,$sp2, "Amenities: ");
  $linea2 = $linea2+3;
  
  foreach($aamenities as $b) {  
  if ($b != "") {
  $pdf->SetFont('Arial','',8);
  $pdf->SetXY(140,$linea2);
  $pdf->MultiCell($sp1,$sp2, $b);
  $linea2 = $linea2+3;
  }
  }
  }
  if($numa >10){
  $pdf->SetFont('Arial','B',8);
  $pdf->SetTextColor(0,0,0); 
  $pdf->SetXY(125,$linea2);
  $pdf->MultiCell($sp1,$sp2, "Amenities: ");
  $linea2 = $linea2+5;
  $pdf->SetXY(125,$linea2);

  
 
 $linea4 = $linea2;
 
  
 for($i=1;$i<11;$i++){
 $pdf->SetXY(125,$linea2);
 $pdf->SetFont('Arial','',8);
 $pdf->MultiCell($sp1,$sp2, $aamenities[$i]);
 $linea2=$linea2+3;
 
  }
 for($i=11;$i<30;$i++){
 $pdf->SetXY(165,$linea4);
 $pdf->SetFont('Arial','',8);
 $pdf->MultiCell($sp1,$sp2, $aamenities[$i]);
 $linea4=$linea4+3;
 
 }
 }
 }
  
 
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Property Details:");
	$linea = $linea+$h;
	$linea = $linea+$h;
	$pdf->SetFont('Arial','',8);
   
   if ($row[beds] != 0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Bedrooms: ".$row[beds]);
	$linea = $linea+$h;
	}
	if ($row[baths] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$baths = "Bathrooms: ".str_replace(".0","",$row[baths]);
	$pdf->MultiCell($sp1, $sp2, $baths); 
	$linea = $linea+$h;
	}
	if ($row[address] != "") { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Address: ".$row['address']);
	$linea = $linea+$h;
	}
	if ($row[lsfeet] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Lot Size (sq. Feet): ".$row['lsfeet']); 
	$linea = $linea+$h;
	} 
	if ($row[lsmeters] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1,$sp2, "Lot Size (sq Meters): ".$row['lsmeters']);
	$linea = $linea+$h;
	}
	if ($row[lsvaras] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1,$sp2 ,"Lot Size (sq Varas): ".$row['lsvaras']);
	$linea = $linea+$h;
	} 
	if ($row[lsacres] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2 ,"Lot Size (sq Acres): ".$row['lsacres']); 
	$linea = $linea+$h;
	} 
	if ($row[bsfeet] != 0.0) { 
	
	$pdf->SetXY(60,$linea);
	$pdf->MultiCell($sp1, $sp2, "Building Size (sq Feet): ".$row['bsfeet']); 
	$linea = $linea+$h;
	} 
	if ($row[beaches] != "") { 
	
	$nbeach = strlen($row[beaches]); 
	
	$pdf->SetXY(60,$linea);
	$beaches1 = "Beaches near the property:  ".substr($row[beaches], 0,($nbeach - 2)).".";
	$pdf->MultiCell($sp1, $sp2, $beaches1); 
	$linea = $linea+$h;
	}
	

  $footerx = 10;
  $footery = -30;
  $pdf->SetXY($footerx,$footery);
  $pdf->SetFont('Arial','B',10);
  $pdf->SetTextColor(37,37,37);
  $pdf->Write(3,'AURORA COASTAL & COLONIAL REALTY');
  $footery = $footery+3;
  $pdf->SetFont('Arial','',8);
  $pdf->SetXY($footerx,$footery);
  $pdf->Write(3,'Address: Park of the Poets 1 block and 20 meters north.');
  $footery = $footery+3;
  $pdf->SetXY($footerx,$footery);
  $pdf->Write(3,'Leon, Nicaragua. Central America');
  $footery = $footery+3;
  $pdf->SetXY($footerx,$footery);
  $pdf->Write(3,'USA Phone: (415) 839-6690');
  $footery = $footery+3;
  $pdf->SetXY($footerx,$footery);
  $pdf->Write(3,'Nica Phone: (505) 8672-3566');
  $footery = $footery+3;
  $pdf->SetXY($footerx,$footery);
  $pdf->Write(3,'info@nicaraguarealestateleon.com','mailto:info@nicaraguarealestateleon.com');
  $footery = $footery+3;
  $pdf->SetXY($footerx,$footery);
  $pdf->Write(3,'www.nicaraguarealestateleon.com','a href = http://www.nicaraguarealestateleon.com');
  $pdf->SetXY(160,$footery);
  $pdf->Write(3,'Developed By: MultiTech Labs','a href = http://www.multitechlabs.com');


  

  
  
  
  /*
  $pdf->SetXY(80,-17);
  $pdf->SetFont('Arial','B',7);
  $pdf->Write(3,'011 (505) 8672-3566');
  $pdf->SetXY(103,-17);
  $pdf->SetFont('Arial','',7);
  $pdf->Write(3,'Email: ');
  $pdf->Write(3,'info@nicaraguarealestateleon.com','mailto:info@nicaraguarealestateleon.com');
  $pdf->SetXY(85,-14);
  $pdf->SetFont('Arial','',10);
  $pdf->Write(3,'www.nicaraguarealestateleon.com','a href = http://www.nicaraguarealestateleon.com');
  */
  
  $pdf->SetDrawColor(240, 240, 240);

 

  $directory =  '../nicaraguarealestate/property/files/'.$row[1];
  if (!file_exists($directory)){


mkdir('../nicaraguarealestate/property/files/'.$row[1].'');

}
  $newfilename='../nicaraguarealestate/property/files/'.$row[1].'/'.$row[1].'.pdf';
  $pdf->Output($newfilename);
  
  
  //End Leon
	  
  }

 header("location: editlisting.php?id=".$_GET['pid']);
 
?>