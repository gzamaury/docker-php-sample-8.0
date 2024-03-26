<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;

// Check if the .env file exists befor loading it
if (file_exists(__DIR__ . '/.env')) {
		// The environment variables are loaded from the .env file
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$var_example_name = "ENV_EXAMPLE";

// First, look for the value in the .env file; if doesn't exist, then search for it
// in the system variables. If it is still not found, throw an exception.
$var_example_value = isset($_ENV[$var_example_name]) ? $_ENV[$var_example_name] : getenv($var_example_name);
if (!$var_example_value) {
	throw new ErrorException("The environment variable '$var_example_name' has not been set.");
}

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