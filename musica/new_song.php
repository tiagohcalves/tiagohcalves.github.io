<?php

include 'dbdata.php';
	
// array for JSON response
$response = array();

$response["message"] = "";
$response["success"] = 1;
 
// check for required fields
if (isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['verses'])) {
 
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $verses = $_POST['verses'];
    $songId = $_POST['songId'];
	
    // connecting to db
    $db = new mysqli($servername, $username, $password, $dbname);
 
	$sql = "INSERT INTO m_Song (id, title, artist, verses) VALUES($songId, '$title', '$artist', '$verses')";
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
	$response["keys"] = array_keys($_POST);
 
    // echoing JSON response
    echo json_encode($response);
}
?>
