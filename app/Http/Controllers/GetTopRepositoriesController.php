<?php

namespace App\Http\Controllers;

use App\Services\GitHub\GitHubServiceInterface;

class GetTopRepositoriesController extends Controller
{
    public function __construct(private readonly GitHubServiceInterface $gitHubService)
    {
    }

    public function __invoke()
    {
        $repositories = $this->gitHubService->getTopRepositories();
        return response()->view('repositories', ['repositories' => $repositories]);
    }
}
