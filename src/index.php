<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;

$var_example_name = "ENV_EXAMPLE";

// Check if the .env file exists befor loading it
if (file_exists(__DIR__ . '/.env')) {
	// The environment variables are loaded from the .env file
  $dotenv = Dotenv::createMutable(__DIR__);
  $dotenv->load();
}

if (file_exists(__DIR__ . '/.htaccess') && isset($_SERVER[$var_example_name])) {

	$_ENV[$var_example_name] = $_SERVER[$var_example_name];
	
} else if (getenv($var_example_name) != false) {
	
	$_ENV[$var_example_name] = getenv($var_example_name);
}

if (!isset($_ENV[$var_example_name])) {
	throw new ErrorException("The environment variable '$var_example_name' has not been set.");
}

$var_example_value = $_ENV[$var_example_name];

function sayHello($name, $var_example_value) {
	echo "Hello $name! - Your 'ENV_EXAMPLE' value was: $var_example_value";
}

?>

<html>
	<head>
		<title>Visual Studio Code Remote :: PHP</title>
	</head>
	<body>
		<?php 
		
		sayHello('from index.php and phpinfo()', $var_example_value);
			
		phpinfo(); 
			
		?>
	</body>
</html>