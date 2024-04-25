<?php

function sayHello($name)
{
    echo "Hello $name!";
}

?>

<html>
    <head>
        <title>Visual Studio Code Remote :: PHP</title>
    </head>
    <body>
        <?php

        sayHello('from phpinfo.php and phpinfo()');

        phpinfo();

        ?>
    </body>
</html>