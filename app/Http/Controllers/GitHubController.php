<?php

namespace App\Http\Controllers;

use App\Services\GitHubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    public function __construct(private GitHubService $gitHubService)
    {
    }

    public function getTopRepositories()
    {
        $repositories = $this->gitHubService->getTopRepositories();
        return response()->view('repositories', ['repositories' => $repositories]);
    }
}
