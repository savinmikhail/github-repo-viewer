<?

namespace App\Services\GitHub;

use App\Models\Owner;
use App\Models\Repo;
use App\Services\GitHub\GitHubServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GitHubService implements GitHubServiceInterface
{
    public function checkOwnerExists(string $name): bool
    {
        try {
            $client = new Client();
            $client->get("https://api.github.com/users/{$name}");
            return true;
        } catch (ClientException) {
            return false;
        }
    }
    
    public function getTopRepositories():Collection 
    {
        return Repo::query()->get();
    }

    public function saveTopRepositories(): void
    {
        $owners = $this->getOwners();
        Log::info("Saving top repositories for owners: {($owners)}");
        $repositories = $this->fetchData($owners);
        Log::info("Fetched top repositories");
        $this->pruneOldRecords($repositories);
        Log::info("Pruned old records");
        $this->storeRecords($repositories);
        Log::info("Saved records");
    }

    private function getOwners(): Collection
    {
        $owners = ['savinmikhail', 'aldardebeev'];
        $owners = Owner::pluck('name');
        return $owners;
    }

    private function fetchData(Collection $owners): Collection
    {
        $repositories = collect($owners)
            ->flatMap(function ($owner) {
                $response = Http::get("https://api.github.com/users/{$owner}/repos");
                return $response->json();
            })
            ->sortByDesc('updated_at')
            ->limit(10);
            
        return $repositories;
    }
    
    private function pruneOldRecords(Collection $repositories)
    {
        // Prune records that no longer exist in the collection
        Repo::whereNotIn('id', $repositories->pluck('id')->toArray())->delete();
    }

    private function storeRecords(Collection $repositories)
    {
        foreach ($repositories as $repo) {
            Repo::updateOrCreate(
                ['id' => $repo['id']],
                [
                    'name' => $repo['name'],
                    'url' => $repo['html_url'],
                ]
            );
        }
    }
}
