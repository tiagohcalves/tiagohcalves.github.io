<?php

include 'dbdata.php';
	
// array for JSON response
$response = array();

$response["message"] = "";
$response["success"] = 1;
 
echo $_POST['inicio'] . '<br>';
echo $_POST['resposta'];
 
// check for required fields
if (isset($_POST['inicio']) && isset($_POST['resposta'])) {
 
	$inicio = $_POST['inicio'];
	$resposta = $_POST['resposta'];
    	$songId = $_POST['songId'];
	
    // connecting to db
    $db = new mysqli($servername, $username, $password, $dbname);
 
	$sql = "INSERT INTO m_CompleteACancao (inicio, resposta, songId) VALUES('$inicio', '$resposta', $songId)";
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
