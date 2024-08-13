<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
  
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    public function create()
    {
        try {
            $roles = Role::all();
            return response()->json(['roles' => $roles], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'motherlast_name' => 'nullable|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'type' => 'nullable|string|max:50',
                'status' => 'nullable|string|max:50',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|min:8',
            ]);
            $existingUser = User::where('email', $request->input('email'))->first();
            if ($existingUser) {
                return response()->json(['error' => 'El correo electrónico ya está registrado.'], 422);
            }
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('usuario', 'public');
            }
            $nuevoUsuario = User::create([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'motherlast_name' => $request->input('motherlast_name'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'phone' => $request->input('phone'),
                'type' => $request->input('type'),
                'status' => $request->input('status'),
                'photo' => $photoPath,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'avatar' => $request->input('avatar'),
            ]);

            return response()->json($nuevoUsuario, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit()
    {
        try {
            $roles = Role::all();
            return response()->json(['roles' => $roles], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
    
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'motherlast_name' => 'nullable|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'type' => 'nullable|string|max:50',
                'status' => 'nullable|string|max:50',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $user->update([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'motherlast_name' => $request->input('motherlast_name'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'phone' => $request->input('phone'),
                'type' => $request->input('type'),
                'status' => $request->input('status'),
                'photo' => $photoPath,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'avatar' => $request->input('avatar'),
            ]);
    
            if ($request->filled('password')) {
                $user->update(['password' => bcrypt($request->input('password'))]);
            }
    
            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
    
                $photoPath = $request->file('photo')->store('usuario', 'public');
                $user->update(['photo' => $photoPath]);
            }
    
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
    
            // Eliminar la foto del usuario si existe
            if ($user->photo) {
                $photoPath = 'public/usuario/' . basename($user->photo);
                Storage::delete($photoPath);
            }
    
            $user->delete();
    
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
