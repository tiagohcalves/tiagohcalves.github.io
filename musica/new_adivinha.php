<?php

include 'dbdata.php';
	
// array for JSON response
$response = array();

$response["message"] = "";
$response["success"] = 1;
 
// check for required fields
if (isset($_POST['verse']) && isset($_POST['artist'])) {
 
    $verse = $_POST['verse'];
    $artist = $_POST['artist'];
    $songId = $_POST['songId'];
	
    // connecting to db
    $db = new mysqli($servername, $username, $password, $dbname);
 
	$sql = "INSERT INTO m_AdivinhaQuem (verse, artist, songId) VALUES('$verse', '$artist', $songId)";
	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
		echo $db->error;
		$response["success"] = 0;
	} 
	// echoing JSON response
	echo json_encode($response);
	
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Ta faltando coisa";
	$response["post"] = $_POST['inicio'] . $_POST['resposta'];
 
    // echoing JSON response
    echo json_encode($response);
}
?>
