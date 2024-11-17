<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return new UserResource($user);

    }

    public function show(User $user){
        return new UserResource($user);
    }

    public function destroy(User $user){
        $user->campaigns()->delete();
        $user->delete();
        return response()->json(null, 204);
    }


}
