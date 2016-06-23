<?php session_start();?>
<!DOCTYPE html>

<html>
    <head>
        <title>T=0 Project Time Log</title>

        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,100,200|Comfortaa:400,300|' rel='stylesheet' type='text/css'>

    </head>


<body>


<?php



/*
		AUTHOR: Michael Ryan 
		DATE: 5-25-2014
		FILE: record.php  
		FILE DESCRIPTION: This file will display all information on which ever file was selected or 
							created on index.php
							The timer will start and the start time will be displayed, as well as all
							of the past logs and times if the file already existed.
 */



date_default_timezone_set('America/Los_Angeles');



/********************* FUNCTIONS ************************************************/


/* Calculates and returns formatted time */

function totalTime($timeInSeconds)
{

	$totalMinutes = $timeInSeconds / 60;

	$roundedHours = $totalMinutes / 60;

		if($roundedHours < 1)
		{
			$roundedHours = 0;
		}

	$remainingMinutes = $totalMinutes % 60;

	$timeTotal = floor($roundedHours)  . " hrs " . $remainingMinutes .  " mins";
	
	return $timeTotal;
}



/* Creates a session cookie with the start time amd displays it in a time format */

function startTheClockForToday()
{

	$_SESSION['timerCounter'] = time();  // starting time for today

			$todayStartTime = date("D. M j Y g:ia");

			echo "<h3>Today's Start Time: $todayStartTime</h3>";

}








/********************** BODY ***************************************************/



if(!empty($_POST['active']) || !empty($_POST['n'])) // confirm that something was selected or created ... fails if both empty
{
	


	if(!empty($_POST['n']) && empty($_POST['active'])) // this is a new client so create a new client file
	{
		

		$newClientInfo = $_POST['n'] . "," . $_POST['p'] . "," . date("D. M j Y") . "," . "nil";
		$newFilePath =  "clientDirectory/" . $_POST['n'] . ".txt";

		if(!file_exists($newFilePath)) // prevent appending duplicates onto existing files
		{
			$newClientFile = @fopen($newFilePath, "a+") or die("No file exists for this client.");

		
				fwrite($newClientFile, $newClientInfo . PHP_EOL);

				fclose($newClientFile);

				
				startTheClockForToday();

				$_SESSION['currentClientWork'] = $_POST['n'];  // for display use in endwork.php and logout.php

				echo "Client: " . $_POST['n'] . "<br>";
				echo "Project: " . $_POST['p'] . "<br>";
				echo "Start Date: " . date("D. M j Y");

				echo "<form method='post' action='endwork.php'>

				<input 
                type='submit' 
                name='startTimer' 
                value='End Timer'> 


		</form>";



			}else{

				echo "A file with this name already exists.<br>";
				echo "<a href='index.php'>Back to Main Page</a>";
				exit;
			}	
	
	
	}else if(!empty($_POST['active']) && empty($_POST['n']))  // recalling existing file and listing it's logged info into a table
	{
		
		startTheClockForToday();

		$_SESSION['currentClientWork'] = $_POST['active'];  	// for display use in endwork.php and logout.php

		$fileInUse =  file("clientDirectory/" . urldecode($_POST['active']) . ".txt");

		echo "<table border = '1'>";

		foreach ($fileInUse as $loggedEntry) {
		
			if($loggedEntry == $fileInUse[0])	// this index position will always be used for general info on client
			{	
				$loggedEntry = trim($loggedEntry);


				$item = preg_split("/,/", $loggedEntry);

				
					echo "Client: " . $item[0] . "<br>";
					echo "Project: " . $item[1] . "<br>";
					echo "Start Date: " . $item[2] . "<br>";

					echo "<tr> 
							<th>Date</th>
							<th>Work Performed</th>
							<th>Total Time Today</th>
							<th>Total Time On Project</th>
						</tr>";
						continue;
			}else{							// every other entry

				$loggedEntry = trim($loggedEntry);
				

				$item = preg_split("/,/", $loggedEntry);

// $item[0] - date
// $item[1]	- log entered into textarea on endwork.php
// $item[2]	- total time for the day
// $item[3] - total time on project to date	
			


				$_SESSION['projectTotalTimeFromLastUpdate'] = $item[3];		// used by logout.php to calculate the overall total time on the project

				$runningTotal = totalTime($item[3]);  // converts to time format for display

				echo "<tr> 
							<td style=white-space: nowrap; >" . $item[0] . "</td>  
							<td>" . $item[1] . "</td>
							<td style=white-space: nowrap;>" . $item[2] . "</td>
							<td style=white-space: nowrap;>" . $runningTotal . "</td>

						</tr>";

				}
			
		}
		
		echo "</table>";

		echo "<form method='post' action='endwork.php'>

				<input 
                type='submit' 
                name='endTimer' 
                value='End Timer'> 


		</form>";
		

	}

}else{ // nothing entered or selected

	echo "No client entered or selected<br>";
	echo "<a href='index.php'>Back to Main Page</a>";
	exit;
}
?>

</body>
</html>
