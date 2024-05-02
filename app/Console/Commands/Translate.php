<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Translate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:page 
        {to : target translation}
        {--source=en : source translateion from }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate content folder and resource lang';

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
        $target = $this->argument('to');

        // time count

        // check apakah $target sudah sudah tertranslate
        // return message "sudah tertranslate"

        // check source apakah ada dan punya


    }
}
