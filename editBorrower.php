<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Edit Borrower </title>
 
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
 $formFName=$_POST["firstName"];
 $formBorrowed=$_POST["borrowed"];

 if($formMemberID != '')
 { 
$tempMemberID=$formMemberID;
}
 //function to get the data from the database to display on the form.
 function get_data($conn, $tempMemberID){
	 $sql="SELECT * FROM `library_borrowers` WHERE `library_borrowers`.`MemberID`=$tempMemberID";
	 $result= $conn -> query($sql);
	 return $result;
 }
 
 function updateGame($conn, $tempMemberID, $formFName, $formBorrowed) 
 {

$sql = "UPDATE `library_borrowers`  SET `FirstName`='$formFName',
`Borrowed`='$formBorrowed' WHERE `library_borrowers`.`MemberID`=$tempMemberID";

      $result = $conn -> query($sql);

      return $result;

 }
 //The if statement to update the database. Checks if the Member ID field still
 //holds the member ID, which is the primary key, first.
 if($formMemberID != ''){
 $result=updateGame($conn, $formMemberID, $formFName, $formBorrowed);
 }
 $result=get_data($conn, $tempMemberID);
 ?>
 <form id="Membership" 
	method="post" 
	enctype="application/x-www-form-urlencoded"
	action="editBorrower.php">
 
 <fieldset>
	<legend> Edit Borrower </legend>
	<ul>
	<?php $row = $result->fetch_assoc() ?> <!--fetchs the data for the form-->
<li>
<label>Membership ID</label>
<input type="int" tabindex="1" name="memberID" value="<?php echo $row["MemberID"];?>">
</li>
<li>
<label>First name:<br> </label>
<input type="text" tabindex="2" name="firstName" value="<?php echo $row["FirstName"]; ?>">
</li>
<li>
<label>Boardgame borrowed:<br> </label>
<input type="text" tabindex="3" name="borrowed" value="<?php echo $row["Borrowed"];?>">
</li>
<li>

</ul>
<input type="submit" value="Update">
</fieldset>
</form>
 </body>
 </html>