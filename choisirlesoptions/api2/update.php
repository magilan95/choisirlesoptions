<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	
  // Validate.
  if ((int)$request->data->id < 1 ||  (int)$request->data->num_id < 1 || $request->data->moyenne < 0 || (int)$request->data->dle < 1 || (int)$request->data->aps < 1 ||  (int)$request->data->arv < 1 ||  (int)$request->data->ihm < 1 ||  (int)$request->data->fdt < 1 ||  (int)$request->data->ars < 1 ) {
    return http_response_code(400);
  }
    
  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->data->id);
  $num_id = mysqli_real_escape_string($con, (int)$request->data->num_id);
  $moyenne = mysqli_real_escape_string($con, (float)$request->data->moyenne);
  $dle = mysqli_real_escape_string($con, (int)$request->data->dle);
  $aps = mysqli_real_escape_string($con, (int)$request->data->aps);
  $arv = mysqli_real_escape_string($con, (int)$request->data->arv);
  $ihm = mysqli_real_escape_string($con, (int)$request->data->ihm);
  $fdt = mysqli_real_escape_string($con, (int)$request->data->fdt);
  $ars = mysqli_real_escape_string($con, (int)$request->data->ars);

  // Update.
  $sql = "UPDATE `cars` SET `num_id`='$num_id',`moyenne`='$moyenne',`dle`='$dle',`aps`='$aps',`arv`='$arv',`ihm`='$ihm',`fdt`='$fdt',`ars`='$ars'  WHERE `id` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}
