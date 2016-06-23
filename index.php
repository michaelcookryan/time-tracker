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
		DATE: 5-15-2016
		FILE: index.php  
		FILE DESCRIPTION: This is the index for a time clock to keep an acurate record of
                            time and work performed for a client. It will display two links for user to select.
                            One for viewing the current list of active clients and one to enter in a new client name and project.
 */




date_default_timezone_set('America/Los_Angeles');




ob_start();




/********************* FUNCTIONS ************************************************/


/* Create radio button if info already exists in directory */

// function clientList($activeClient)
// {

//     if(!empty($activeClient))  
//     {
//         echo "
        
//         <input type='radio'
//                name='active'
//                value='$activeClient'>
//                $activeClient
//                 <br>  
//            ";
//         }

// }




/* Create selection list of all files within the directory */

// function previousClientsList()
// {  
//        if(count(glob("clientDirectory"."/*"))){             //do files exist in clientDirectory?
//             echo "<h4>Current List of Active Projects: </h4>";

//             if($handle = opendir('clientDirectory'))        //opens the known directory
//             {
//                 while (false !== ($entry = readdir($handle)))       //loops through client names in direcetory
//                 {
                   
                  
//                     if($entry != "." && $entry != ".." && $entry != ".DS_Store")
//                     {
                        
//                             clientList(pathinfo($entry, PATHINFO_FILENAME));        //isolated client name without file extension and display in selection list 
                        
//                     }
                

//                 }closedir($handle);
//             }
//         }
// }



/* Confirm files existing in the directory */

// function confirmPreviousClientsList()
// {
//     if(count(glob("clientDirectory"."/*")))             //do files exist in clientDirectory?
//         {
//             previousClientsList();                  // show list of existing files
//              echo "<br>";

//              echo "<input 
//                 type='submit' 
//                 name='display' 
//                 value='Display Records'>";
//              echo "<br><br><br>";

//         }//else{
//         //     echo "<h4>The are no current projects.</h4>";
//         // }
// }

// function selectCurrentClientList(){

// echo "
    
//         <form method='post' action='current.php'>  
                
              
//          <input 
//                 type='submit' 
//                 name='showList' 
//                 value='Current Client List'>   
                
//        </form>";    

// }



// function selectNewClientForm(){

// echo "<form method='post' action='newClient.php'>"; // start more work


//      echo "<input 
//                 type='submit' 
//                 name='addClient' 
//                 value='Add New Client & Project'> 
    
//     </form>";

// }

/* Create the form to enter a new client, as well display any active files already present in clientDirectory */


function createForm()
{

echo "<hr>";
    echo "<section>
        <a href='current.php'>Current List of Clients</a>
        <a href='newClient.php'>Add a New Client</a>
    </section>";

    
}






/********************** BODY ***************************************************/

echo "<h1>Time Equals Nothing Project: Timer and Work Log</h1><br>";

createForm();

ob_end_flush();

?>

</body>
</html>
