<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use PHPSocketIO\SocketIO;
use Workerman\Worker;

class SocketServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:serve {action=start}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Socket.io server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $argv[0] = 'socket:serve';
        $argv[1] = $this->argument('action');

        $port = 3000;
        $this->info("Socket.io server running on port {$port}");

        // Listen on port 3000
        $io = new SocketIO($port);

        $io->on('connection', function ($socket) {
            $this->info("New client connected: {$socket->id}");

            // Example: Listen for a 'test-event'
            $socket->on('test-event', function ($data) {
                $this->info("Received test-event: " . json_encode($data));
            });

            $socket->on('disconnect', function () use ($socket) {
                $this->info("Client disconnected: {$socket->id}");
            });
        });

        Worker::runAll();
    }
}
