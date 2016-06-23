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
		FILE: endwork.php  
		FILE DESCRIPTION: Stops the timer on the work session for the day. Displays total time
						  then gives a textarea field for user to enter a work performed log.
 */





date_default_timezone_set('America/Los_Angeles');




/********************* FUNCTIONS ************************************************/



/* Formats and displays time and creates a session cookie of total time for the day */

function totalTimeToday($timeInSeconds)
{

	$totalMinutes = $timeInSeconds / 60;

	$roundedHours = $totalMinutes / 60;

		if($roundedHours < 1)
		{
			$roundedHours = 0;
		}

	$remainingMinutes = $totalMinutes % 60;

	$timeTotal = floor($roundedHours)  . " hrs " . $remainingMinutes .  " mins";
	echo "<div style=\"color:red;\">" . $timeTotal . "</div>" . "of total time worked today." . "<br><br>";

	$_SESSION['timeToday'] = $timeTotal; //formatted time display
}





/********************** BODY ***************************************************/


	

if(isset($_SESSION['timerCounter'])) // confirm timer was started by checking existance of session 
{
	$timeElapsed = time() - $_SESSION['timerCounter']; // total of time today

	$_SESSION['timeElapsedToday'] = $timeElapsed; // for use in logout.php

	totalTimeToday($timeElapsed);

echo "Work on: <div style=\"color:green; font-size:1.5em;\">" . urldecode($_SESSION['currentClientWork']) . "</div>" . " has been stopped at " . date('g:ia') . "<br>";


echo "<form method='post' action='logout.php'>

			Enter description of work performed and comments:<br>	

			<textarea autofocus rows='12' cols='60' wrap='soft' name='latestUpdate'> 
                      
                       </textarea><br>";

        
    echo       "<input 
                type='submit' 
                name='Logoff' 
                value='Finish'> 
		</form>";


}





?>

</body>
</html>
