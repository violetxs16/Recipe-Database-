<!doctype html>
<html lang = "en">
<head>
	<meta charset= "utf-8">
	<title>Database </title>
</head>
<body>
<h1>Enter a username and password</h1>
<!-- Creates a form which prompts user to enter a username
The data is processed in the same php file
-->
<form action = 'Violeta_Solorio_project5_login_in1.php' method = 'POST'>
<p>Username: <input type = 'text' name = 'username' size = '20' required>
<p>Password<input type= 'password' name ='password' size = '20' required>
<input type ='submit' name = 'submit' value= 'Click to submit' required>
</form>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$issue = FALSE;
		$issue2= FALSE;
		if(!empty($_POST['username'])){//Checks if username is not empty
			$username = trim(strip_tags($_POST['username']));//Uses trim & strip_tags to make username more secure
		}else{
			print "Submit a username";//If submition is empty, it prompts user to enter a username
			$issue = TRUE;
		}
		if(!empty($_POST['password'])){//Checks if password is not empty
			$password = trim(strip_tags($_POST['password']));//Uses trim & strip_tags to make password more secure
		}else{
			print "Submit a password";//If submition is empty, it prompts user to enter a username
			$issue = TRUE;
		}
		$dbc = mysqli_connect('localhost','username','','project5_database'); //Connects to database
		if(!$issue){
			$query = 'SELECT username,password FROM data2'; //Defines the query and gets every column from the database
			if($name = mysqli_query($dbc,$query)){//Runs query on the database
				while($row = mysqli_fetch_array($name)){//Loops through array
					if($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']){//Condition if true if username is taken within database
						print "You have succesfully logged in!";//Prints out statement to user
						$issue2=TRUE;
						break;
					}else if($row['username'] == $_POST['username'] && $row['password'] != $_POST['password']){
						print "The username and password do not match or the username is taken";
						$issue2 = TRUE;//Raises an issue
						break;
					}
				}
			}else{
				print "Could not retrieve usernames";
			}
		}
		
		
		if(!$issue2){//If no isses, it adds the username to the database
			
			 $query = "INSERT INTO data2(username,password) VALUES('$username','$password')";//Defines the query with Insert Values
			 if(@mysqli_query($dbc, $query)){//Runs query on database
				 print"Login information has been added";
			 }else{
				 print "Login information could not be added because".mysqli_error($dbc)."query";
			 }
			 mysqli_close($dbc);
		}
	}
?>
</body>
</html>
