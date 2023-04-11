<?php
/*This script will add the recipe*/

//Include header:

include('Violeta_Solorio_project5_header.html');

print '<h2> Add a recipe</h2>';

$database = mysqli_connect('localhost','username','','project5_database');//Connects to the database
mysqli_set_charset($database, 'utf8');//Sets the character set
   

$query = 'SELECT id, first_name,recipe_name,number,recipe_ingredients FROM data';
if($result = mysqli_query($database,$query)){//Runs the query
	while($row = mysqli_fetch_array($result)){//Prints the quotes
		print"<h3>{$row['recipe_name']}</h3>
		<p>List of ingredients{$row['recipe_ingredients']}</p>
		<p>Number of ingredients{$row['number']}</p>
		<p style ='color: green;'>{$row['first_name']}'s recipe</p>";
		
		print "<p><b>Recipe Admin:</b><a href = \"update_delete.php?id={$row['id']}\">Edit</a>
		<->
		<a href = \"update_delete.php? id ={$row['id']}\">Delete</a></p><\n>";
	
	}
	
}else{//The query didn't run
	print '<p clas = "error"> The data could not be retrived because'.mysqli_error($database).'</p>';
	
}
mysqli_close($database);//Closes the database connection


?>