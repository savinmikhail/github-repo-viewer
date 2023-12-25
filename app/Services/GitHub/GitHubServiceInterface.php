<?php

namespace App\Services\GitHub;

use Illuminate\Support\Collection;

interface GitHubServiceInterface
{
    public function checkOwnerExists(string $name): bool;
    public function getTopRepositories():Collection;
    public function saveTopRepositories(): void;
    
}