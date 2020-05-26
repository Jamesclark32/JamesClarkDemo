<?php

namespace App\Console\Commands\Api;

use App\Importers\PlaceholderUser;
use Illuminate\Console\Command;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import User data from placeholder API';

    /**
     * @var PlaceholderUser $importer
     */
    protected $importer;

    /**
     * ImportUsers constructor.
     *
     * @param PlaceholderUser $importer
     */
    public function __construct(PlaceholderUser $importer)
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
