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
		FILE: index.php  
		FILE DESCRIPTION: This is the index for a time clock to keep an acurate record of
                            time and work performed for a client. It will display any client records
                            (if they exist) at the beginning as well form fields - name and project
                            to create a new file. Upon start the timer will begin.
 */




date_default_timezone_set('America/Los_Angeles');




ob_start();




/********************* FUNCTIONS ************************************************/


/* Create radio button if info already exists in directory */

function clientList($activeClient)
{

    if(!empty($activeClient))  
    {
        echo "
        
        <input type='radio'
               name='active'
               value='$activeClient'>
               $activeClient
                <br>  
           ";
        }

}




/* If there are any files existing in the directory then create selection list */

function confirmPreviousClientsList()
{  
        if(count(glob("clientDirectory"."/*")))
        {
            echo "<h4>Current List of Active Projects: </h4>";

            if($handle = opendir('clientDirectory'))
            {
                while (false !== ($entry = readdir($handle)))
                {
                   
                  
                    if($entry != "." && $entry != ".." && $entry != ".DS_Store")
                    {
                        
                            clientList(pathinfo($entry, PATHINFO_FILENAME));
                        
                    }
                

                }closedir($handle);
            }
        }
}




/* Create the form to enter a new client, as well display any active files already present in clientDirectory */


function createForm($name,$project)
{

echo "<hr>";




    echo "
    <section>
        <form method='post' action='display.php'>"; // display record for review or print
                
                confirmPreviousClientsList();
                
                echo "<input 
                type='submit' 
                name='display' 
                value='Display Records'>
                


        </form>";                   // MAIN ISSUE: Two separte forms so if starting more work on existing project, input is not recognsied
    echo "<br><br><br>";

    echo "<form method='post' action='record.php'>"; // start more work
    echo "<h4>Enter New Client Info:</h4>";

     echo "Client:<input style='margin-left:40px' 
                            type='text' 
                            name='n'
                            value='$name'><br>
                        
                            
            Project:<input style='margin-left:29px' 
                            type='text' 
                            name='p'
                            value='$project'><br><br>
                            
                            
            
                             
            <input 
                type='submit' 
                name='startTimer' 
                value='Start Work Timer'> 
    


</form></section>";
}






/********************** BODY ***************************************************/

echo "<h1>Time Equals Nothing Project Timer and Work Log</h1><br>";

createForm('','');

ob_end_flush();

?>

</body>
</html>