<?php
/**
 * Returns the list of rend.
 */
require 'connect.php';
    
$rend = [];
$sql = "SELECT id, num_id, moyenne, dle, aps, arv, ihm, fdt, ars FROM rend order by moyenne desc";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
	$num_id = $row['num_id'];
	$dle = $row['dle'];
	$aps = $row['aps'];
	$arv = $row['arv'];
	$ihm = $row['ihm'];
	$fdt = $row['fdt'];
	$ars = $row['ars'];
	if($dle==1){
	$premier="dle";}
	if($dle==2){
			$deuxieme="dle";}
	if($dle==3){
			$troisieme="dle";}
	if($dle==4){
			$quatrieme="dle";}
	if($dle==5){
			$cinquieme="dle";}
	if($dle==6){
			$sixieme="dle";}
	if($aps==1){
			$premier="aps";}
	if($aps==2){
			$deuxieme="aps";}
	if($aps==3){
			$troisieme="aps";}
	if($aps==4){
			$quatrieme="aps";}
	if($aps==5){
			$cinquieme="aps";}
	if($aps==6){
			$sixieme="aps";}
	if($arv==1){
			$premier="arv";}
	if($arv==2){
			$deuxieme="arv";}
	if($arv==3){
			$troisieme="arv";}
	if($arv==4){
			$quatrieme="arv";}
	if($arv==5){
			$cinquieme="arv";}
	if($arv==6){
			$sixieme="arv";}
	if($ihm==1){
			$premier="ihm";}
	if($ihm==2){
			$deuxieme="ihm";}
	if($ihm==3){
			$troisieme="ihm";}
	if($ihm==4){
			$quatrieme="ihm";}
	if($ihm==5){
			$cinquieme="ihm";}
	if($ihm==6){
			$sixieme="ihm";}
	if($fdt==1){
			$premier="fdt";}
	if($fdt==2){
			$deuxieme="fdt";}
	if($fdt==3){
			$troisieme="fdt";}
	if($fdt==4){
			$quatrieme="fdt";}
	if($fdt==5){
			$cinquieme="fdt";}
	if($fdt==6){
			$sixieme="fdt";}
	if($ars==1){
			$premier="ars";}
	if($ars==2){
			$deuxieme="ars";}
	if($ars==3){
			$troisieme="ars";}
	if($ars==4){
			$quatrieme="ars";}
	if($ars==5){
			$cinquieme="ars";}
	if($ars==6){
			$sixieme="ars";	}
		
    $rend[$cr]['id'] = $row['id'];
	$rend[$cr]['num_id'] = $row['num_id'];
	$rend[$cr]['moyenne'] = $row['moyenne'];
	$rend[$cr]['dle'] = $row['dle'];
	$rend[$cr]['aps'] = $row['aps'];
	$rend[$cr]['arv'] = $row['arv'];
	$rend[$cr]['ihm'] = $row['ihm'];
	$rend[$cr]['fdt'] = $row['fdt'];
	$rend[$cr]['ars'] = $row['ars'];
	
	$sql2 = "SELECT count(premier)+(SELECT count(deuxieme) FROM `rendu` where deuxieme='$num_id')+(SELECT count(troisieme) FROM `rendu` where troisieme='$num_id')+(SELECT count(quatrieme) FROM `rendu` where quatrieme='$num_id')+(SELECT count(cinquieme) FROM `rendu` where cinquieme='$num_id') as nombre FROM `rendu` where premier='$num_id'";
	$res = mysqli_query($con,$sql2);
	while($row = mysqli_fetch_assoc($res))
	{
			$rend[$cr]['nombre'] = $row['nombre'];
	}
	
	if($rend[$cr]['nombre']>2){}
	if($rend[$cr]['nombre']==0){
		$i=3;
		$test=0;
		$j=0;
		while($i>0){
			if($test==1){
				$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where deuxieme=0 limit 1) limit 1";
				$res = mysqli_query($con,$sql3);
				while($row = mysqli_fetch_assoc($res))
				{
					$rend[$cr]['itest'] = $row['cinquieme'];
					$itest = $row['cinquieme'];
					$op_ch = $row['option_choix'];
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$itest' WHERE deuxieme=0 limit 1 ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
								$i=$i-1;
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$test=$test-1;
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where troisieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where troisieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where troisieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where troisieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `troisieme`='$itest' WHERE troisieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where quatrieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$itest' WHERE quatrieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where cinquieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$itest' WHERE cinquieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;

							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
			$j=$j+1;
			}
			if($j==1 && $i>0){
				$test=1;
				$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where deuxieme=0 limit 1) limit 1";
				$res = mysqli_query($con,$sql3);
				while($row = mysqli_fetch_assoc($res))
				{
					$rend[$cr]['itest'] = $row['quatrieme'];
					$itest = $row['quatrieme'];
					$op_ch = $row['option_choix'];
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$itest' WHERE deuxieme=0 limit 1 ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
								$i=$i-1;
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$test=$test-1;
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where troisieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where troisieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where troisieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where troisieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `troisieme`='$itest' WHERE troisieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where quatrieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$itest' WHERE quatrieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where cinquieme=0 limit 1)  limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$itest' WHERE cinquieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;

							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
						
					
			}
			
		$sql3 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$premier' ";
		$res = mysqli_query($con,$sql3);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$premier'  ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$premier'  and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		$sql4 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$deuxieme' ";
		$res = mysqli_query($con,$sql4);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$deuxieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		$sql5 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$troisieme' ";
		$res = mysqli_query($con,$sql5);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$troisieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		if($i!=0){
			$sql6 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$quatrieme' ";
			$res = mysqli_query($con,$sql6);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$quatrieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
			}
		}
		if($i!=0){
			$sql7 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$cinquieme' ";
			$res = mysqli_query($con,$sql7);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$cinquieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				
				else{}
			}
		}
		if($i!=0){
			$sql7 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$sixieme' ";
			$res = mysqli_query($con,$sql7);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$sixieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
			}
		}
		$test=$test+1;
		}
	}
	if($rend[$cr]['nombre']==1){
		$i=2;
		$test=0;
		$j=0;
		while($i>0){
			if($test==1){
				$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where deuxieme=0 limit 1) limit 1";
				$res = mysqli_query($con,$sql3);
				while($row = mysqli_fetch_assoc($res))
				{
					$rend[$cr]['itest'] = $row['cinquieme'];
					$itest = $row['cinquieme'];
					$op_ch = $row['option_choix'];
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$itest' WHERE deuxieme=0 limit 1 ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
								$i=$i-1;
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$test=$test-1;
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where troisieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where troisieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where troisieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where troisieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `troisieme`='$itest' WHERE troisieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where quatrieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$itest' WHERE quatrieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where cinquieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$itest' WHERE cinquieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;

							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
			$j=$j+1;
			}
			if($j==1 && $i>0){
				$test=1;
				$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where deuxieme=0 limit 1) limit 1";
				$res = mysqli_query($con,$sql3);
				while($row = mysqli_fetch_assoc($res))
				{
					$rend[$cr]['itest'] = $row['quatrieme'];
					$itest = $row['quatrieme'];
					$op_ch = $row['option_choix'];
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$itest' WHERE deuxieme=0 limit 1 ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
								$i=$i-1;
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$test=$test-1;
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where troisieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where troisieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where troisieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where troisieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `troisieme`='$itest' WHERE troisieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where quatrieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$itest' WHERE quatrieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where cinquieme=0 limit 1)  limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$itest' WHERE cinquieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;

							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
						
					
			}
			
		$sql3 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$premier' ";
		$res = mysqli_query($con,$sql3);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$premier'  ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$premier'  and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		$sql4 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$deuxieme' ";
		$res = mysqli_query($con,$sql4);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$deuxieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		$sql5 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$troisieme' ";
		$res = mysqli_query($con,$sql5);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$troisieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		if($i!=0){
			$sql6 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$quatrieme' ";
			$res = mysqli_query($con,$sql6);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$quatrieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
			}
		}
		if($i!=0){
			$sql7 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$cinquieme' ";
			$res = mysqli_query($con,$sql7);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$cinquieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				
				else{}
			}
		}
		if($i!=0){
			$sql7 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$sixieme' ";
			$res = mysqli_query($con,$sql7);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$sixieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
			}
		}
		$test=$test+1;
		}
	}
    if($rend[$cr]['nombre']==2){
		$i=1;
		$test=0;
		$j=0;
		while($i>0){
			if($test==1){
				$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where deuxieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where deuxieme=0 limit 1) limit 1";
				$res = mysqli_query($con,$sql3);
				while($row = mysqli_fetch_assoc($res))
				{
					$rend[$cr]['itest'] = $row['cinquieme'];
					$itest = $row['cinquieme'];
					$op_ch = $row['option_choix'];
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$itest' WHERE deuxieme=0 limit 1 ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
								$i=$i-1;
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$test=$test-1;
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where troisieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where troisieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where troisieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where troisieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `troisieme`='$itest' WHERE troisieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where quatrieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where quatrieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$itest' WHERE quatrieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, cinquieme FROM `rendu` where cinquieme!=(select premier from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select deuxieme from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select troisieme from `rendu` where cinquieme=0 limit 1) and cinquieme!=(select quatrieme from `rendu` where cinquieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['cinquieme'];
						$itest = $row['cinquieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$itest' WHERE cinquieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;

							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
			$j=$j+1;
			}
			if($j==1 && $i>0){
				$test=1;
				$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where deuxieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where deuxieme=0 limit 1) limit 1";
				$res = mysqli_query($con,$sql3);
				while($row = mysqli_fetch_assoc($res))
				{
					$rend[$cr]['itest'] = $row['quatrieme'];
					$itest = $row['quatrieme'];
					$op_ch = $row['option_choix'];
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$itest' WHERE deuxieme=0 limit 1 ";
					if(mysqli_query($con, $sql4))
						  {
							http_response_code(204);
								$i=$i-1;
						  }
						  else
						  {
							return http_response_code(422);
						  }
					$test=$test-1;
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where troisieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where troisieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where troisieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where troisieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `troisieme`='$itest' WHERE troisieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where quatrieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where quatrieme=0 limit 1) limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$itest' WHERE quatrieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
				if($test==1){
					$sql3 = "SELECT option_choix, quatrieme FROM `rendu` where quatrieme!=(select premier from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select deuxieme from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select troisieme from `rendu` where cinquieme=0 limit 1) and quatrieme!=(select quatrieme from `rendu` where cinquieme=0 limit 1)  limit 1";
					$res = mysqli_query($con,$sql3);
					while($row = mysqli_fetch_assoc($res))
					{
						$rend[$cr]['itest'] = $row['quatrieme'];
						$itest = $row['quatrieme'];
						$op_ch = $row['option_choix'];
						$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$op_ch' ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
							  }
							  else
							  {
								return http_response_code(422);
							  }
						$sql4 = "UPDATE `rendu` SET  `cinquieme`='$itest' WHERE cinquieme=0 limit 1 ";
						if(mysqli_query($con, $sql4))
							  {
								http_response_code(204);
								$i=$i-1;

							  }
							  else
							  {
								return http_response_code(422);
							  }
						$test=$test-1;
					}
				}
						
					
			}
			
		$sql3 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$premier' ";
		$res = mysqli_query($con,$sql3);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$premier'  ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$premier'  and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$premier' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		$sql4 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$deuxieme' ";
		$res = mysqli_query($con,$sql4);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$deuxieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$deuxieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		$sql5 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$troisieme' ";
		$res = mysqli_query($con,$sql5);
		while($row = mysqli_fetch_assoc($res))
		{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$troisieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$troisieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
		}
		if($i!=0){
			$sql6 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$quatrieme' ";
			$res = mysqli_query($con,$sql6);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$quatrieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$quatrieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
			}
		}
		if($i!=0){
			$sql7 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$cinquieme' ";
			$res = mysqli_query($con,$sql7);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$cinquieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$cinquieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				
				else{}
			}
		}
		if($i!=0){
			$sql7 = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu where option_choix='$sixieme' ";
			$res = mysqli_query($con,$sql7);
			while($row = mysqli_fetch_assoc($res))
			{
				if($row['premier']==0){
					$sql4 = "UPDATE `rendu` SET  `premier`='$num_id' WHERE `option_choix` = '$sixieme' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['deuxieme']==0){
					$sql4 = "UPDATE `rendu` SET  `deuxieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['troisieme']==0){
					$sql4 = "UPDATE `rendu` SET  `troisieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' ";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['quatrieme']==0){
					$sql4 = "UPDATE `rendu` SET  `quatrieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				elseif($row['cinquieme']==0){
					$sql4 = "UPDATE `rendu` SET  `cinquieme`='$num_id' WHERE `option_choix` = '$sixieme' and premier!='$num_id' and deuxieme!='$num_id' and troisieme!='$num_id' and quatrieme!='$num_id'";
					$i=$i-1;
					if(mysqli_query($con, $sql4))
					  {
						http_response_code(204);
					  }
					  else
					  {
						return http_response_code(422);
					  }
				}
				else{}
			}
		}
		$test=$test+1;
		}
	}
	$cr++;
  }
    
  echo json_encode(['data'=>$rend]);
}
else
{
  http_response_code(404);
}
