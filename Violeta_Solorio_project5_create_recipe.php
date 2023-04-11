<! doctype html>
<html lang = "en">
<head>
	<meta charset = "utf-8">
	<title>Recipe database</title>
</head>
<body>
<h1>Favorite Recipe Database</h1>

<body>

Do you wish to enter a new entry?
<form action = "Violeta_Solorio_project5_create_recipe.php" method = "POST" >

<p> Enter the following information to enter a new recipe</p>
<p>First name <input type='text' name = 'first' size = '20' ></p>
<p>Last Name <input type = 'text' name ='last' size='20' ></p>
<p>Recipe Name     <input type = 'text' name='recipe_name' size='20' ></p>
<p>Total ingredients <input type = 'number' name = 'number' min ='0' size = '20'></p>
<p>Recipe ingredients <input type = 'text' name = 'recipe_ingredients' size = '20'></p>
<p>Submit<input type = 'submit' name = 'submit' value = 'Click to submit form'></p>
</form>

<?php

$database = mysqli_connect('localhost','username','','project5_database');//Connects to the database
mysqli_set_charset($database, 'utf8');//Sets the character set
   
if($_SERVER['REQUEST_METHOD']== 'POST'){

	if(!empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['recipe_name']) && !empty($_POST['number']) && !empty($_POST['recipe_ingredients']) ){//Checks that input is not empty
		
		$first = mysqli_real_escape_string($database, trim(strip_tags($_POST['first'])));
		$last = mysqli_real_escape_string($database, trim(strip_tags($_POST['last'])));
		$recipe_name = mysqli_real_escape_string($database, trim(strip_tags($_POST['recipe_name'])));
		$number = $_POST['number'];
		$recipe_ingredients = mysqli_real_escape_string($database, trim(strip_tags($_POST['recipe_ingredients'])));
		
		$query = "INSERT INTO data(first_name, last_name, recipe_name,number,recipe_ingredients) VALUES('$first','$last','$recipe_name','$number','$recipe_ingredients')";
		if(@mysqli_query($database, $query)){//Runs the query
			print"<p style ='color: green;'>The entry has been added has been added!</p>";
		}else{
			print "The data could not be added because: ". mysqli_error($database);
		}
		mysqli_close($database);
	}else{//Submittion is missing information
		print'<p class = "error">Please enter all the information</p>';
	}
}

?>



