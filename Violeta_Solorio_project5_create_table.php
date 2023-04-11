
<?php
/*
The following Script will create a database if it already doesnt exist, and two data tables
If the tables could not be created a error message will occur
*/
define('Database', 'localhost');
define('username', 'username');
define('password', '');
define('name', 'project5_database');
 
// Connects to the database
$query1 = mysqli_connect(Database, username, password);
 
// Check connection
if($query1 === false){
    die("Could not connect to database. " . mysqli_connect_error());
}
// Create database if it doesnt exist
$query2 = "CREATE DATABASE IF NOT EXISTS data";
if (@mysqli_query($query1,$query2)) {
  print "The database created successfully!";
} else {
  echo "There was an error creating database";
}
	if($database = @mysqli_connect('localhost','username','', 'project5_database')){//Establishes connection to database & assigns it to variable $database
		print "Connected!";
		$query = 'CREATE TABLE IF NOT EXISTS data(id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, first_name TEXT NOT NULL, last_name TEXT NOT NULL, recipe_name TEXT NOT NULL, number INT NOT NULL, recipe_ingredients TEXT NOT NULL )';//Creates table for recipe
		$query2 = 'CREATE TABLE IF NOT EXISTS data2(id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, username TEXT NOT NULL, password TEXT NOT NULL )';//Creates table for usernames
		if(@mysqli_query($database, $query)){//Checks if  table is created
			print "<h3>Table was sucessfully Created</h3>";
			
		}else{//Table was not created
			print "<h3> Could not create table because: ". mysqli_error($database);	
		}
		if(@mysqli_query($database, $query2)){//Checks if  table is created
			print "<h3>Table was sucessfully Created</h3>";
			
		}else{//Table was not created
			print "<h3> Could not create table because: ". mysqli_error($database);	
		}
		mysqli_close($database);//Closes the database
	}	
	
	else{//Could not establish connection to the database
		print"was not able to connect because of". mysqli_connect_error();
	}
$database = mysqli_connect('localhost','username','', 'project5_database');// Connects to database
mysqli_set_charset($database, 'utf8');// Set the character set

