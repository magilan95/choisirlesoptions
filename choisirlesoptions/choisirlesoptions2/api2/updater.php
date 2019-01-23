<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	
  // Validate.
  if ((int)$request->data->id < 0 || (int)$request->data->premier < 0 || $request->data->deuxieme < 0 || (int)$request->data->troisieme < 0 || (int)$request->data->quatrieme < 0 ||  (int)$request->data->cinquieme < 0 ) {
    return http_response_code(400);
  }
    
  // Sanitize.
  $option_choix    = mysqli_real_escape_string($con, $request->data->option_choix);
  $premier = mysqli_real_escape_string($con, (int)$request->data->premier);
  $deuxieme = mysqli_real_escape_string($con, (float)$request->data->deuxieme);
  $troisieme = mysqli_real_escape_string($con, (int)$request->data->troisieme);
  $quatrieme = mysqli_real_escape_string($con, (int)$request->data->quatrieme);
  $cinquieme = mysqli_real_escape_string($con, (int)$request->data->cinquieme);

  // Update.
  $sql = "UPDATE `rendu` SET  `premier`='$premier',`deuxieme`='$deuxieme',`troisieme`='$troisieme',`quatrieme`='$quatrieme',`cinquieme`='$cinquieme'  WHERE `option_choix` = '$option_choix' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}
