<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function create()
    {
        try {
            $roles = Rol::all();
            return view('users.create', compact('roles'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'motherlast_name' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'rol_id' => 'required',
                'phone' => 'required|numeric|digits:8|min:0',
                'status' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:8',
                'confirm_password' => 'required',
            ], [
                'email.unique' => 'Este correo electrónico ya ha sido registrado.',
                'phone.digit' => 'Por favor introduzca un número de teléfono válido.',
                '*.required' => 'Debe rellenar todos los campos.',
                'password.min' => 'La contraseña debe tener 8 caracteres como mínimo.',
            ]);
            $user = new User();
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->motherlast_name = $request->input('motherlast_name');
            $user->latitude = $request->input('latitude');
            $user->longitude = $request->input('longitude');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->type = $request->input('type');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $user->email = $request->input('email');
            $user->rol_id = $request->input('rol_id');
            $user->status = $request->input('status');
            if ($request->hasFile('avatar')) {
                $user->avatar = $request['avatar']->store('avatar', 'public');
            }
            $user->photo = "campo nuevo!";
            if ($validatedData['password'] === $validatedData['confirm_password']) {
                $user->password = bcrypt($validatedData['password']);
                $user->save();
                return redirect('/users');
            } else {
                return back()->withError("Las contraseñas no coinciden");
            }
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $user = User::find($id);
            $roles = Rol::all();
            return view('users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el usuario.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'motherlast_name' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'rol_id' => 'required',
                'phone' => 'required|numeric|digits:8|min:0',
                'status' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'avatar' => 'required',
            ], [
                'email.unique' => 'Este correo electrónico ya ha sido registrado.',
                'phone.digit' => 'Por favor introduzca un número de teléfono válido.',
                '*.required' => 'Debe rellenar todos los campos.',
                'password.min' => 'La contraseña debe tener 8 caracteres como mínimo.',
            ]);
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->motherlast_name = $request->input('motherlast_name');
            $user->latitude = $request->input('latitude');
            $user->longitude = $request->input('longitude');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->type = $request->input('type');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $user->email = $request->input('email');
            $user->status = $request->input('status');
            $user->rol_id = $request->input('rol_id');
            if ($request->hasFile('avatar')) {
                $user->avatar = $request['avatar']->store('avatar', 'public');
            }
            $user->save();
            return redirect('/users');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }
    public function show($id)
    {
        try {
            $user = User::find($id);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
