<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$rendu = [];
$sql = "SELECT id,option_choix,premier,deuxieme,troisieme,quatrieme,cinquieme FROM rendu ";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $rendu[$cr]['id'] = $row['id'];
    $rendu[$cr]['option_choix'] = $row['option_choix'];
	$rendu[$cr]['premier'] = $row['premier'];
	$rendu[$cr]['deuxieme'] = $row['deuxieme'];
	$rendu[$cr]['troisieme'] = $row['troisieme'];
	$rendu[$cr]['quatrieme'] = $row['quatrieme'];
	$rendu[$cr]['cinquieme'] = $row['cinquieme'];

    $cr++;
  }
    
  echo json_encode(['data'=>$rendu]);
}
else
{
  http_response_code(404);
}
