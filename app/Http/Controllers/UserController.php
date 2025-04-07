<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return Inertia('user/Index', [
            'users' => $users->load('rol'),
        ]);
    }

    public function show(User $user) {
        return Inertia('user/Show', [
            'user' => $user->load('rol'),
        ]);
    }

    public function create() {
        return Inertia('user/Create');
    }

    public function store(StoreUserRequest $request) {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol_id' => $request->rol_id,
            'password' => Hash::make($request->password),
        ]);

        return to_route('users.index');
    }

    public function edit(User $user) {
        return Inertia('user/Edit', [
            'user' => $user->load('rol'),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user) {

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'rol_id' => $request->rol_id,
            'password' => Hash::make($request->password),
        ]);

        return to_route('users.index', $user);
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users');
    }
}
