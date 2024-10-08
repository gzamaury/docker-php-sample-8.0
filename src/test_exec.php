<?php

// Probar el uso de exec() para listar el usuario actual y la versión de PHP
$output_user = [];
$output_php_version = [];
$return_var = 0;

// Ejecuta el comando para obtener el usuario actual
exec('whoami', $output_user, $return_var);

// Ejecuta el comando para obtener la versión de PHP
exec('php -v', $output_php_version, $return_var);

// Muestra la salida del comando whoami (usuario)
echo "<h3>Usuario actual:</h3>";
echo "<pre>";
print_r($output_user);
echo "</pre>";

// Muestra la salida del comando php -v (versión de PHP)
echo "<h3>Versión de PHP:</h3>";
echo "<pre>";
print_r($output_php_version);
echo "</pre>";

// Muestra el código de retorno del comando (0 si fue exitoso)
echo "<h3>Código de retorno:</h3>";
echo $return_var;
