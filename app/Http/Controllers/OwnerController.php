<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOwnerRequest;
use App\Http\Requests\PaginateRequest;
use App\Services\Owner\OwnerServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class OwnerController extends Controller
{
    public function __construct(private OwnerServiceInterface $ownerService)
    {
    }

    public function index(PaginateRequest $request): Response
    {
        $dto = $request->validated();

        $owners = $this->ownerService->getOwners($dto['count'] ?? 10);

        return response()->view('owners', ['owners' => $owners]);
    }

    public function add(AddOwnerRequest $request): RedirectResponse
    {
        $dto = $request->validated();

        $success = $this->ownerService->addOwner($dto['name']);

        return redirect()->route('owners')->with([
            'success' => $success,
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $this->ownerService->deleteOwner($id);

        return response()->json("owner with id $id deleted", 200);
    }
}
