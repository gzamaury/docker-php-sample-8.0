<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Utils\EnvVariableReader;

$varExampleName = "ENV_EXAMPLE";
$varExampleValue = null;

// Get the value of the environment variable using the new static class
try {
    $varExampleValue = EnvVariableReader::getEnvVariable($varExampleName);
} catch (ErrorException $e) {
    // Handle the exception if the environment variable is not defined
    die($e->getMessage());
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
		
		sayHello('from index.php and phpinfo()', $varExampleValue);
			
		phpinfo(); 
			
		?>
	</body>
</html>