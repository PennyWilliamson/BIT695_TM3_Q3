<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>board_games position List </title>
 
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

function selectBoard_games($conn) {

      $sql = "select * from `board_games`";

      $result = $conn -> query($sql);

      return $result;

 }
 

 $result = selectBoard_games($conn);

 if ($result->num_rows > 0) {

 	echo "<table>";

 	while ($row = $result->fetch_assoc())  {

 		echo '<tr><td>' . $row["MemberID"];

 		echo '</td><td>' . $row["Boardgame"];

 		echo '</td><td>' . $row["Position"];
		
		echo '</td><td>' . $row["Notes"];
		
		echo '</td><td>' . $row["Date"];
		
		echo '</td><td>' . $row["Event"];

 		echo '</td><td><a href="deleteBoard_games.php?memberID=' . $row["MemberID"] . '">delete Board_game</a>';

 		echo '</td><td><a href="editBoard_games.php?memberID=' . $row["MemberID"] . '">Edit Board_game</a>'; 

 		echo '</td></tr>';

 	}

 	echo '</table>';

 } else  echo '0 results';



//update is found in the
//file named editplayer.php Contains the form for editing players.


//delete is found in the 
//file named deleteplayer.php.
?>
</body>
</html>