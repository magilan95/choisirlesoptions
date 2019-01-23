<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$cars = [];
$sql = "SELECT id, num_id, moyenne, dle, aps, arv, ihm, fdt, ars FROM cars order by moyenne desc";

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
		
    $cars[$cr]['id'] = $row['id'];
	$cars[$cr]['num_id'] = $row['num_id'];
	$cars[$cr]['moyenne'] = $row['moyenne'];
	$cars[$cr]['dle'] = $row['dle'];
	$cars[$cr]['aps'] = $row['aps'];
	$cars[$cr]['arv'] = $row['arv'];
	$cars[$cr]['ihm'] = $row['ihm'];
	$cars[$cr]['fdt'] = $row['fdt'];
	$cars[$cr]['ars'] = $row['ars'];
	
	$sql2 = "SELECT count(premier)+(SELECT count(deuxieme) FROM `rendu` where deuxieme='$num_id')+(SELECT count(troisieme) FROM `rendu` where troisieme='$num_id')+(SELECT count(quatrieme) FROM `rendu` where quatrieme='$num_id')+(SELECT count(cinquieme) FROM `rendu` where cinquieme='$num_id') as nombre FROM `rendu` where premier='$num_id'";
	$res = mysqli_query($con,$sql2);
	while($row = mysqli_fetch_assoc($res))
	{
			$cars[$cr]['nombre'] = $row['nombre'];
	}

	$cr++;
  }
    
  echo json_encode(['data'=>$cars]);
}
else
{
  http_response_code(404);
}
