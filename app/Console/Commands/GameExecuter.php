<?php

namespace App\Console\Commands;
use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerated;

use Illuminate\Console\Command;

class GameExecuter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';              // Modificamos aca para llamar el comando

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the exectution game';

    // Esta variable mas
    private $time = 10;

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
     * @return int
     */
    public function handle()
    {
        while(true){
            // ... 
            \broadcast(new RemainingTimeChanged($this->time . 's'));
            
            $this->time--;
            \sleep(1);
            
            if ($this->time === 0) {
                $this->time = 'Waiting to start';
                \broadcast(new RemainingTimeChanged($this->time ));
                
                \broadcast(new WinnerNumberGenerated( \mt_rand(2, 4) ));

                \sleep(5);

                $this->time = 10;
            }
        }
        // return 0;
    }
}
