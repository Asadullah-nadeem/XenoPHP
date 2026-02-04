<?php

namespace App\Console;

class ServeInterceptor
{
    /**
     * Intercept the "serve" command to add interactive Socket.io prompt.
     *
     * @return void
     */
    public static function intercept()
    {
        // Handle custom loop logic for "php xeno serve"
        if (isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] === 'serve') {
            // Check if we are already running via npm (using the flag)
            $internalIndex = array_search('--internal', $_SERVER['argv']);

            if ($internalIndex === false) {
                // We are NOT inside npm run dev yet. Start it.

                // Ask the user if they want the socket server
                echo "Do you need the Socket.io server? (yes/no) [yes]: ";
                $handle = fopen("php://stdin", "r");
                $line = fgets($handle);
                fclose($handle);
                $input = trim(strtolower($line));

                if ($input === 'no' || $input === 'n') {
                    // Run without socket server
                    passthru('php xeno test && php xeno serve --internal', $returnVar);
                } else {
                    // Run with socket server (default)
                    passthru('npm run dev', $returnVar);
                }

                exit($returnVar);
            } else {
                // We ARE inside npm run dev (flag found).
                // Remove the flag so Laravel doesn't complain
                unset($_SERVER['argv'][$internalIndex]);
                // Re-index array just in case
                $_SERVER['argv'] = array_values($_SERVER['argv']);
            }
        }
    }
}
