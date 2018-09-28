<?php

include 'dbdata.php';
	
// array for JSON response
$response = array();

$response["message"] = "";
$response["success"] = 1;
 
// check for required fields
if (isset($_POST['title']) && isset($_POST['artist'])) {
 
	$title = $_POST['title'];
	$artist = $_POST['artist'];
	$songId = $_POST['songId'];
	
    // connecting to db
    $db = new mysqli($servername, $username, $password, $dbname);
 
	$sql = "INSERT INTO m_Mimica (title, artist, songId) VALUES('$title', '$artist', $songId)";
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
 
    // echoing JSON response
    echo json_encode($response);
}
?>
