<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phza24:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display the current Phza24 application version.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Phza24 Version '.\App\Models\System::VERSION);
    }
}
