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
		DATE: 8-29-2015
		FILE: record.php  
		FILE DESCRIPTION: This file will display all information of the selected pre-existing file. 
							As well give option to print the record, return to main list page, or 
							start time on current selection.
							
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
	if(!empty($_POST['active']) && is_null($_POST['n']))  // recalling existing file and listing it's logged info into a table
	{
		$startThisFileAgain = urlencode($_POST['active']); //used to pass into input field below when calling record.php
		//startTheClockForToday();

		$_SESSION['currentClientWork'] = urlencode($_POST['active']);  	// for display use in endwork.php and logout.php
		

		$fileInUse =  file("clientDirectory/" . $_POST['active'] . ".txt");

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
			


				

				$runningTotal = totalTime($item[3]);  // converts to time format for display

				echo "<tr> 
							<td style=white-space: nowrap; >" . $item[0] . "</td>  
							<td>" . $item[1] . "</td>
							<td style=white-space: nowrap;>" . $item[2] . "</td>
							<td style=white-space: nowrap;>" . $runningTotal . "</td>

						</tr>";
				}
			
		}
		
		echo "</table>
			<a href='javascript:window.print()'>Print This Page</a>";
		echo "<br><br>";
		echo "<a href='current.php'>Back to Client List Page</a>";
		echo "<form method='post' action='record.php'>

				<input 
				type='hidden'
				name='active'
				value=$startThisFileAgain>

				<input 
				type='hidden'
				name='n'
				value=0>


				<input 
                type='submit' 
                name='startTimer' 
                value='Start Work Timer'> 


		</form>";
		

	}

}else{ // nothing entered or selected

	echo "No client entered or selected<br>";
	echo "<a href='index.php'>Back to Client List Page</a>";
	exit;
}
?>

</body>
</html>
