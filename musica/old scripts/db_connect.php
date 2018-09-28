<?php 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
	$servername = "mysql.hostinger.com.br";
	$username = "u733484397_main";
	$password = "1qa0ok2ws9ij";
	$dbname = "u733484397_main";

 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Selecing database
        $db = new mysqli($servername, $username, $password, $dbname);
		
		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		else{
			echo 'Conectado com sucesso';
		}	
 
        // returing connection cursor
        return $db;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysqli_close();
    }
 
}
 
?>
