<?php

// Ensure the script is executed from the CLI
if (php_sapi_name() !== 'cli') {
    die("This script can only be executed from the CLI.");
}

ini_set('error_log', __DIR__ . '/bg_process.log');

if (extension_loaded('pcntl')) {
    declare(ticks=1);

    pcntl_signal(SIGTERM, function () {
        echo "Received a SIGTERM signal. Terminating the script...\n";
        error_log("The process was terminated by SIGTERM.");

        exit(0);
    });

    error_log("Signal handler registered.");
} else {
    error_log("The 'pcntl' extension is not enabled. Signals will not be handled.");
}

$pid = getmypid();

error_log("The process has started.");
error_log("Waiting for a kill signal...");
error_log("Use: kill {$pid}");

while (true) {
    if (extension_loaded('pcntl')) {
        pcntl_signal_dispatch();
    }

    // You can call your function here
    sleep(1);
}
