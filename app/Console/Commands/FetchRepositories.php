<?php

namespace App\Console\Commands;

use App\Services\GitHub\GitHubServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchRepositories extends Command
{
    public function __construct(private readonly GitHubServiceInterface $gitHubService)
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:repositories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Command started");
        $this->gitHubService->saveTopRepositories();
    }
}
