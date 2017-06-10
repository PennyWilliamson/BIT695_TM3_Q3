<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Edit board_games </title>
 
</head>
<body>
</body>
</html>
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
 
 $conn=connect_db($host,$uid,$pwd,$database);
 $tempMemberID= $_GET["memberID"];
 //variable declaration to get form data from the database.
 $formMemberID=$_POST["memberID"];
 $formBoardgame=$_POST["boardgame"];
 $formPosition=$_POST["position"];
 $formNotes=$_POST["notes"];
 $formDate=$_POST["date"];
 $formEvent=$_POST["event"];
 if($formMemberID != '')
 { 
$tempMemberID=$formMemberID;
}
 //function to get the data from the database to display on the form.
 function get_data($conn, $tempMemberID){
	 $sql="SELECT * FROM `board_games` WHERE `board_games`.`MemberID`=$tempMemberID";
	 $result= $conn -> query($sql);
	 return $result;
 }
 
function updateBoardgames($conn, $tempMemberID, $formBoardgame, $formPosition, $formNotes, $formDate, $formEvent) {

$sql = "UPDATE `board_games`  SET `Boardgame`='$formBoardgame',
`Position`='$formPosition', `Notes`='$formNotes', 
`Date`='$formDate', `Event`='$formEvent' WHERE `board_games`.`MemberID`=$tempMemberID" ;

      $result = $conn -> query($sql);

      return $result;

 }
 //The if statement to update the database. Checks if the Member ID field still
 //holds the member ID, which is the primary key, first.
 if($formMemberID != ''){
 $result=updateBoardgames($conn, $formMemberID, $formBoardgame, $formPosition, $formNotes, $formDate, $formEvent);
 }
$result=get_data($conn, $tempMemberID);
 ?>
 <form id="board-games" 
	method="post" 
	enctype="application/x-www-form-urlencoded"
	action="editBoard_games.php">
 
 <fieldset>
	<legend> Edit Board_games </legend>
	<ul>
	<?php $row = $result->fetch_assoc() ?> <!--fetchs the data for the form-->
<li>
<label>Membership ID</label>
<input type="int" tabindex="1" name="memberID" value="<?php echo $row["MemberID"];?>">
</li>
<li>
<label>Boardgame:<br> </label>
<input type="text" tabindex="2" name="boardgame" value="<?php echo $row["Boardgame"]; ?>">
</li>
<li>
<label>Position:<br> </label>
<input type="text" tabindex="3" name="position" value="<?php echo $row["Position"];?>">
</li>
<li>
<label>Notes:<br> </label>
<input type="text" tabindex="4" name="notes" value="<?php echo $row["Notes"];?>">
</li>
<li>
<label>Date:<br> </label>
<input type="text" tabindex="5" name="date" value="<?php echo $row["Date"];?>"> 
</li>
<li>
<label>Event:<br> </label>
<input type="text" tabindex="5" name="event" value="<?php echo $row["Event"];?>"> 
</li>
</ul>
<input type="submit" value="Update">
</fieldset>
</form>
 </body>
 </html>