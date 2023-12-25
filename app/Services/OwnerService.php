<?

namespace App\Services;

use App\Models\Owner;
use App\Services\GitHubService;
use GuzzleHttp\Exception\ClientException;

class OwnerService
{
    public function __construct(private readonly GitHubService $gitHubService)
    {
    }

    public function add(string $name): bool
    {
        if (!$this->gitHubService->checkOwnerExists($name)) {
            return false;
        }
        Owner::firstOrCreate([
            'name' => $name
        ]);
        return true;
    }
}
