<?php

ini_set('error_log', __DIR__ . '/background_process/bg_process.log');

// Send immediate response to the user
echo "Immediate response to the user...\n";

// Check if the 'pcntl' extension is available
if (extension_loaded('pcntl')) {
    if (function_exists('pcntl_fork')) {
        $pid = pcntl_fork(); // Create a child process

        if ($pid == -1) {
            // Error creating the child process
            error_log("Error while forking.");
            exit(1); // Exit if the child process couldn't be created
        } elseif ($pid) {
            // This is the parent process
            error_log("Parent process. Child created with PID $pid.");
            error_log("Sending response to user and waiting for the child to finish...");

            // Send the response to the user
            flush(); // Ensure the response is sent to the browser immediately

            // Non-blocking loop to wait for the child process to finish
            do {
                $status = null;
                $waitResult = pcntl_waitpid($pid, $status, WNOHANG); // Non-blocking wait

                pcntl_signal_dispatch(); // Process any pending signals

                if ($waitResult == -1) {
                    error_log("Error in 'waitpid' for the child.\n");
                    break; // Error in waiting
                } elseif ($waitResult > 0) {
                    // The child process has finished
                    error_log("Child process with PID $pid has finished.");
                    break;
                }

                // Simulate that the parent can do other tasks while waiting
                sleep(2); // Sleep for 2s (optional, adjustable)
            } while (true);

            error_log("The parent process has finished successfully.");
            error_log("Verify if there isn't a zombie proces with: ps aux | grep php | grep $pid");
        } else {
            $child_pid = getmypid();
            // This is the child process
            error_log("Child process whit PID {$child_pid} is running...");

            // Ensure that the child process is not limited by the execution time
            set_time_limit(0);

            // Execute a long task (simulated with sleep)
            sleep(5); // Simulate a long-running task for 5 seconds

            // Task completed: write to a file
            file_put_contents(
                'background_process/async-task.txt',
                'Async task done by child process.'
            );
            exec("nohup php " . __DIR__ . "/background_process/sigterm_test.php");

            error_log("Child process has completed its task. Then, suicide...");
            exec("kill {$child_pid}");
            // The child process exits successfully
            exit(0);
        }
    } else {
        // If the pcntl_fork function is not available
        error_log("The 'pcntl_fork' function is not available.");
    }
} else {
    // If the PCNTL extension is not available
    echo "The 'pcntl' extension is not enabled.\n";
    exit(0);
}
