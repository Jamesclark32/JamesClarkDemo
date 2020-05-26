<?php

namespace App\Console\Commands\Api;

use App\Importers\PlaceholderComment;
use Illuminate\Console\Command;

class ImportComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import-comments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Comment data from placeholder API';

    /**
     * @var PlaceholderComment $importer
     */
    protected $importer;

    /**
     * ImportComments constructor.
     *
     * @param PlaceholderComment $importer
     */
    public function __construct(PlaceholderComment $importer)
    {
        $this->importer = $importer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importer->import();
    }
}
