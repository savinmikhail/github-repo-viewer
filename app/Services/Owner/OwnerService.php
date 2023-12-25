<?

namespace App\Services;

use App\Models\Owner;
use App\Services\GitHub\GitHubServiceInterface;
use App\Services\Owner\OwnerServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OwnerService implements OwnerServiceInterface
{
    public function __construct(private readonly GitHubServiceInterface $gitHubService)
    {
    }

    public function getOwners(int $count): LengthAwarePaginator
    {
        return Owner::query()
            ->select(['id', 'name'])
            ->paginate($count);
    }

    public function addOwner(string $name): bool
    {
        if (!$this->gitHubService->checkOwnerExists($name)) {
            return false;
        }
        Owner::firstOrCreate([
            'name' => $name
        ]);
        return true;
    }

    public function deleteOwner(int $id)
    {
        Owner::query()
            ->find($id)
            ->delete();
    }
}
