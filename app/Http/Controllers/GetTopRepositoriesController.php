<?php

namespace App\Http\Controllers;

use App\Services\GitHub\GitHubServiceInterface;

class GetTopRepositoriesController extends Controller
{
    public function __construct(private GitHubServiceInterface $gitHubService)
    {
    }

    public function __invoke()
    {
        $repositories = $this->gitHubService->getTopRepositories();
        return response()->view('repositories', ['repositories' => $repositories]);
    }
}
