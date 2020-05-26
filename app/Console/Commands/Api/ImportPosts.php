<?php

namespace App\Console\Commands\Api;

use App\Importers\PlaceholderPost;
use Illuminate\Console\Command;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Post data from placeholder API';

    /**
     * @var PlaceholderPost $importer
     */
    protected $importer;

    /**
     * ImportPosts constructor.
     *
     * @param PlaceholderPost $importer
     */
    public function __construct(PlaceholderPost $importer)
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
