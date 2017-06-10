<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Retrieve Schedule </title>
 
</head>
<body>
<?php

 $uid="root";

 $pwd="root";

 $database="assignment2";

 $host = 'localhost';

 function connect_db($host, $uid, $pwd, $database) 
 {  	$conn=mysqli_connect($host, $uid, $pwd, $database)

 	or die('connection problem:' . mysqli_connect_error());

 	return $conn;

 }



/*The code to retrieve the data. Modified from code supplied
in BIT695 notes, The Open Polytechnic Companion Guide,
Block 2, Part 5:The server side(2), section 5 Querying a database.
Retrieved 10 April 2017.
Also used in BIT695_TM2_3431274 Question 1.
*/
$conn=connect_db($host,$uid,$pwd,$database);

function select_schedule($conn) {

      $sql = "select * from `schedule`";

      $result = $conn -> query($sql);

      return $result;

 }
 

 $result = select_schedule($conn);

 if ($result->num_rows > 0) {

 	echo "<table>";

 	while ($row = $result->fetch_assoc())  {

 		echo '<tr><td>' . $row["Day"];

 		echo '</td><td>' . $row["Boardgame"];

 		echo '</td><td>' . $row["Venue"];
		
		echo '</td><td>' . $row["EventType"];
		

 		echo '</td><td><a href="deleteEvent.php?day=' . $row["Day"] . '">delete event</a>';

 		echo '</td><td><a href="editEvent.php?day=' . $row["Day"] . '">Edit event</a>'; 

 		echo '</td></tr>';

 	}

 	echo '</table>';

 } else  echo '0 results';



//update is found in the
//file named editEvent.php Contains the form for editing events.


//delete is found in the 
//file named deleteEvent.php.
?>
</body>
</html>