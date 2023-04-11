<! doctype html>
<html lang = "en">
<head>
	<meta charset = "utf-8">
	<title>Recipe Database</title>
</head>
<body>
<h1>Favorite Game Database</h1>

<body>


<h2> Do you wish to delete an entry?</h2>
<form action = "Violeta_Solorio_project5_update_delete.php" method = "POST">
<input type= 'radio' name = 'answer' value = 'Yes'> Yes
<input type = 'radio' name = 'answer' value= 'No' checked = "checked">No
<p>Enter the first name, last name used to create the recipe</p>

<p>First name<input type='text' name = 'del_first' size = '20' ></p>
<p>Last Name <input type = 'text' name ='del_last' size='20' ></p>
<p>Submit<input type = 'submit' name = 'submit' value = 'Click to submit form'></p>
</form>
<h2> Do you wish to update a recipe name?</h2>
<p>Enter the first name, last name of the recipe along with designated new recipe name </p>

<form action = "Violeta_Solorio_project5_update_delete.php" method = "POST">
<input type= 'radio' name = 'answer2' value = 'Yes'> Yes
<input type = 'radio' name = 'answer2' value= 'No'checked="checked" >No
<p>First name<input type = 'text' name = 'update_first' size='20'></p>
<p> Last name<input type = 'text' name = 'update_last' size='20'></p>


<p>New recipe name<input type='text' name='new_recipe' size='20'></p>
<p>Submit<input type = 'submit' name = 'submit' value = 'Click to submit form'></p>
</form>
<?php

if($_SERVER['REQUEST_METHOD']== 'POST'){
	
	$issue2 = false;//Will keep track of issues with deleting from the database
	$issue3= false;//Will keep track of issues with updating the database
	
	//The answers will be used to ensure that no unnecesary messages are displayed to the user

	$delete_answer = $_POST['answer'];
	$update_answer = $_POST['answer2'];
	
	$database =  mysqli_connect('localhost','username','','project5_database');//Connects to database
	
	//Checks validity of answers submitted to delete an entry
	if($delete_answer = "Yes"){//If the user answers yes to delete entry
		if(!empty($_POST['del_first']) && !empty($_POST['del_last']) ){
			$del_first = mysqli_real_escape_string($database, trim(strip_tags($_POST['del_first'])));
			$del_last = mysqli_real_escape_string($database, trim(strip_tags($_POST['del_last'])));

		}else{//There is an issue with deletion submission
			$issue2 = true;
		}
	}
	else{//There is no deletion submission
		print"<p> You did not wish to delete an entry</p>";
		$issue2 = true;
	}
	
	//Checks validity of answers submitted to update an entry
	if($update_answer == "Yes"){//If user answers yes to update age or game
		if(!empty($_POST['update_first']) && !empty($_POST['update_last'])){
			$update_first = mysqli_real_escape_string($database, trim(strip_tags($_POST['update_first'])));
			$update_last = mysqli_real_escape_string($database, trim(strip_tags($_POST['update_last'])));

			if($update_answer == "Yes" && !empty($_POST['new_recipe'])){
				$new_recipe = mysqli_real_escape_string($database, trim(strip_tags($_POST['new_recipe'])));
			}else{//There is an issue with updating submission
				$issue3 = true;
				print"<p>Enter all the information to update the entry</p>";
			}
		}else{
			$issue3 = true;
			print"<p>Enter all the information to update the entry</p>";
		}
	}
	else{//There is no updating submission
		$issue3 = true;
	}
	
	
	if(!$issue2){//If no issue is detected for deletion
		if($database= @mysqli_connect('localhost','username','','project5_database')){//Connects to the database
			if($delete_answer =="Yes"){
				$query = "DELETE FROM data WHERE first_name LIKE '%". $del_first."%' AND last_name LIKE '%".$del_last ."%' LIMIT 1";
				$row = mysqli_query($database,$query);
				if(mysqli_affected_rows($database)== 1){//Checks if entry has been deleted
					print "<p style='color: green;'>The entry has been deleted</p>";
				}else{
					print "Could not delete the entry because:".mysqli_error($database);
				}
			}
		}else{
			print "Could not connect to database due to:". mysqli_connect_error();
		}
	}
	if(!$issue3){//If no issue is detected for updating
		if($database = @mysqli_connect('localhost','username','','project5_database')){//Connects to database
			
			if($update_answer == "Yes"){//If user answers yes to update recipe name entry
				$query = "UPDATE data SET recipe_name = '$new_recipe' WHERE first_name LIKE '%".$update_first. "%' AND last_name LIKE '%". $update_last."%' LIMIT 1";
				$row = mysqli_query($database,$query);
				if(mysqli_affected_rows($database) ==1){//Checks if entry has been updated
					print"<p  style ='color: green;'>The entry has been updated!</p>";
				}else{
					print "Could not update entry because:". mysqli_error($database);
				}
			}
		}else{
			print"Could not connect to database due to:".mysqli_connect_error();
		}
	}

	 mysqli_close($database); // Close the connection
}


?>
</body>
</html>
