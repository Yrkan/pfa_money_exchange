<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if  (!(isset($_POST["servername"], $_POST["dbuser"], $_POST["dbpass"], $_POST["adminuser"], $_POST["adminpass"]))) {
    header('Location: ./index.php');
}
$servername = $_POST["servername"];
$dbuser = $_POST["dbuser"];
$dbpass = $_POST["dbpass"];
$adminuser = $_POST["adminuser"];
$adminpass = password_hash($_POST["adminpass"], PASSWORD_DEFAULT);
$dbname = "dbpfa";


// Create connection
$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully please wait ...<br/>";


// Drop database firest
$sql = "DROP DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database dropped successfully<br/>";
} else {
  echo "Error creating database: " . $conn->error;
}

// Create database 
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully<br/>";
} else {
  echo "Error creating database: " . $conn->error;
}

// Create table devise
$sql = "CREATE TABLE `dbpfa`.`devise` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `abbrev` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`name`)) ENGINE = InnoDB; ";
if ($conn->query($sql) === TRUE) {
    echo "Table devise created successfully<br/>";
  } else {
    echo "Error creating Table devise: " . $conn->error;  
}

// default values for table devise
$sql = "INSERT INTO `dbpfa`.`devise` (`id`, `name`, `abbrev`) VALUES (NULL, 'euro', 'EUR'), (NULL, 'US Dollar', 'USD') ";
if ($conn->query($sql) === TRUE) {
    echo "Default devise added successfully<br/>";
  } else {
    echo "Error Adding default devise: " . $conn->error;  
}

// Create table bank
$sql = "CREATE TABLE `dbpfa`.`bank` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`username`), UNIQUE (`name`)) ENGINE = InnoDB; ";
if ($conn->query($sql) === TRUE) {
    echo "Table bank created successfully<br/>";
  } else {
    echo "Error creating Table bank: " . $conn->error;  
}

// Create table admin
$sql = "CREATE TABLE `dbpfa`.`admin` ( `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL ) ENGINE = InnoDB; ";
if ($conn->query($sql) === TRUE) {
    echo "Table admin created successfully<br/>";
  } else {
    echo "Error creating Table admin: " . $conn->error;  
}

// Add default admin
$sql = "INSERT INTO `dbpfa`.`admin` (`username`, `password`) VALUES ('$adminuser', '$adminpass') ";
if ($conn->query($sql) === TRUE) {
    echo "Default admin added successfully<br/>";
  } else {
    echo "Error adding default admin: " . $conn->error;  
}

// Create agency Table
$sql = "CREATE TABLE `dbpfa`.`agency` ( id int NOT NULL, bank_id int NOT NULL, latitude DECIMAL(11,8), longitude DECIMAL(11,8), PRIMARY KEY (id), FOREIGN KEY (bank_id) REFERENCES bank(id) ); ";
if ($conn->query($sql) === TRUE) {
    echo "Table agency created successfully<br/>";
  } else {
    echo "Error creating table agency: " . $conn->error;  
}

// Create offre Table
$sql = "CREATE TABLE `dbpfa`.`offre`( id INT NOT NULL, bank_id INT NOT NULL, devise_id INT NOT NULL, price DECIMAL(10,2), type ENUM('buy', 'sell'), PRIMARY KEY(id), FOREIGN KEY(bank_id) REFERENCES bank(id), FOREIGN KEY(devise_id) REFERENCES devise(id) ); ";
if ($conn->query($sql) === TRUE) {
    echo "Table offer created successfully<br/>";
  } else {
    echo "Error creating table offer: " . $conn->error;  
}

// Create client table
$sql = "CREATE TABLE `dbpfa`.`client` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `type` ENUM('normal','plus') NOT NULL , PRIMARY KEY (`id`), UNIQUE (`username`)) ENGINE = InnoDB; ";
if ($conn->query($sql) === TRUE) {
    echo "Table client created successfully<br/>";
  } else {
    echo "Error creating table offer: " . $conn->error;  
}

// Create transaction table
$sql = "CREATE TABLE `dbpfa`.`transaction` ( `id` INT NOT NULL AUTO_INCREMENT , `type` ENUM('buy','sell') NOT NULL , `devise_id` INT NOT NULL , `client_id` INT NOT NULL , `bank_id` INT NOT NULL , `amount` DECIMAL(10,2) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
if ($conn->query($sql) === TRUE) {
    echo "Table transaction created successfully<br/>";
    $message = "Installed successully, please delete /install folder for security reasons";
  } else {
    echo "Error creating table transaction: " . $conn->error;  
}

?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Installation</title>
  </head>
  <body>
    <!-- Bootstrap Bundle with Popper -->
    <h3><?php echo $message ?></h3>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
