<?php

$loader = require_once realpath(__DIR__ . '/vendor/autoload.php');
$loader->addPsr4('Utils\\', 'Utils');

use Utils\EnvVariableReader;

// Read the database connection parameters from environment variables
$db_host = EnvVariableReader::getEnvVariable('DB_HOST');
$db_name = EnvVariableReader::getEnvVariable('DB_NAME');
$db_user = EnvVariableReader::getEnvVariable('DB_USER');

// Read the password file path from an environment variable
$password_file_path = EnvVariableReader::getEnvVariable('PASSWORD_FILE_PATH');

// Read the password from the file
$db_pass = trim(file_get_contents($password_file_path));

// Create a new PDO instance
$db_handle = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

// Create the "messages" table if it doesn't exist
$db_handle->exec("
 CREATE TABLE IF NOT EXISTS messages (
     id INT AUTO_INCREMENT PRIMARY KEY,
     message VARCHAR(255) NOT NULL
 )
");

// Create message
$stmt = $db_handle->query("SELECT COUNT(*) as count FROM messages");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $row['count'];
$db_handle->exec("
 INSERT INTO messages (message)
 SELECT CONCAT('message-', '$count')
 WHERE NOT EXISTS (
  SELECT 1 FROM messages WHERE message = CONCAT('message-', '$count')
 )
");

// Retrieve all records from the "messages" table
$stmt = $db_handle->query("SELECT * FROM messages");

// Print all records
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 echo $row['id'] . " " . $row['message'] . "<br>";
}

// Close the database connection
$db_handle = null;
?>
