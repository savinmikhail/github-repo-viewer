<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOwnerRequest;
use App\Models\Owner;
use App\Services\GitHubService;
use App\Services\OwnerService;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct(private OwnerService $ownerService)
    {
    }

    public function index()
    {
        return response()->view('owners', ['owners' => Owner::get()]);
    }

    public function add(AddOwnerRequest $request)
    {
        $dto = $request->validated();
        $success = $this->ownerService->add($dto['name']);
        return redirect()->route('owners')->with([
            'success' => $success,
        ]);
    }

    public function delete(string $name)
    {
        Owner::query()->where('name', $name)->delete();
    }
}
