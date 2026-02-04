<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class EasyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeno:easy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive menu to discover and run XenoPHP commands easily.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Welcome to XenoPHP Easy Mode!");

        $commands = Artisan::all();
        $groupedCommands = [];

        foreach ($commands as $name => $command) {
            if ($command->isHidden()) {
                continue;
            }

            $parts = explode(':', $name);
            $namespace = count($parts) > 1 ? $parts[0] : 'Global';

            $groupedCommands[$namespace][$name] = $command->getDescription();
        }

        ksort($groupedCommands);

        while (true) {
            $this->newLine();
            $namespaces = array_keys($groupedCommands);
            $namespaces[] = '<comment>Exit</comment>';

            $namespaceChoice = $this->choice(
                'Select a command category (or type to search)',
                $namespaces
            );

            if ($namespaceChoice === '<comment>Exit</comment>') {
                $this->info('Goodbye!');
                break;
            }

            $this->handleNamespace($groupedCommands[$namespaceChoice], $namespaceChoice);
        }
    }

    protected function handleNamespace(array $commands, string $namespace)
    {
        $commandNames = array_keys($commands);
        $commandOptions = [];
        foreach ($commands as $name => $desc) {
            $commandOptions[] = "$name  <fg=gray>($desc)</>";
        }
        $commandOptions[] = '<comment>Back</comment>';

        $choice = $this->choice(
            "Select a command from [$namespace]",
            $commandOptions
        );

        if ($choice === '<comment>Back</comment>') {
            return;
        }

        // Extract command name from choice (remove description)
        $selectedCommand = explode('  ', $choice)[0];

        $this->info("Running: php xeno $selectedCommand");

        // ask if they want to run it
        if ($this->confirm("Do you want to run '$selectedCommand' now?", true)) {
             $this->executeSelectedCommand($selectedCommand);
        }
    }

    protected function executeSelectedCommand($command)
    {
        // For simple commands without arguments, we can validly run them.
        // For complex ones, we might just show help.

        // We can check definition to see if it has required arguments.
        $cmdInstance = Artisan::all()[$command];
        $def = $cmdInstance->getDefinition();

        if ($def->getArgumentCount() > 0) {
            $this->warn("This command may require arguments.");
            $this->info("Usage: " . $cmdInstance->getSynopsis());
            if ($this->confirm("Run with --help usage info instead?", true)) {
                $this->call($command, ['--help' => true]);
            } else {
                 // Try running it, it might prompt or fail if args missing
                 // But typically call() bubbles up exceptions or asks for input if defined?
                 // Let's just try running it interactively.
                 // Artisan::call doesn't support TTY interactions well in all cases, but let's try.

                 // Better: use passthru to allow full interaction
                 passthru("php xeno $command");
            }
        } else {
            $this->call($command);
        }
    }
}
