<?php

namespace App\Services\Owner;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OwnerServiceInterface
{
    public function getOwners(int $count): LengthAwarePaginator;
    public function addOwner(string $name): bool;
    public function deleteOwner(int $id);
}