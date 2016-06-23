<?php session_start();

/*
		AUTHOR: Michael Ryan 
		DATE: 5-25-2014
		FILE: logout.php  
		FILE DESCRIPTION: Appends user entered work log to file and includes times.
						  Destroys session cookies.
 */


ob_start();

	
	$totalProjectTime = $_SESSION['projectTotalTimeFromLastUpdate'] + $_SESSION['timeElapsedToday'];	// total time on project

	$updates = str_replace("\n", "<br>", trim($_POST["latestUpdate"]));	// user entered log from endwork.php
	//$updates = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $updates); // will not save anything contained withing script tags


	
/* Update all new info to the file that  was worked on */


		$workLogFromToday = trim(date("D. M j Y")) . "," . trim($updates) . "," . trim($_SESSION['timeToday'])  . "," . $totalProjectTime;
                       
             $updatedFilePath =  "clientDirectory/" . urldecode($_SESSION['currentClientWork']) . ".txt";

             $updatesToFile = @fopen($updatedFilePath, "a+") or die("No file exists for this client.");

                       fwrite($updatesToFile, $workLogFromToday . PHP_EOL);

					   fclose($updatesToFile);



	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}	
	session_destroy();
        
        header('Location: index.php');
 		ob_end_flush();       
?>
<!DOCTYPE html>

<html>
    <head>
        <title>T=0 Project Time Log</title>

        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,100,200|Comfortaa:400,300|' rel='stylesheet' type='text/css'>

    </head>


<body>

</body>
</html>
