<?php

namespace App\Http\Controllers\RolesPermisos;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Rol;
use Illuminate\Validation\ValidationException;


class RolePermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = Rol::all();
            return view('roles-permisos.index', compact('roles'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function create()
    {
        try {
            $users = Page::where('page', 'LIKE', 'users%')->get();
            $patients = Page::where('page', 'LIKE', 'patient%')->get();
            $incidents = Page::where('page', 'LIKE', 'incident%')->get();
            $calls = Page::where('page', 'LIKE', 'calls%')->get();
            $conductors = Page::where('page', 'LIKE', 'conductor%')->get();
            $ambulances = Page::where('page', 'LIKE', 'ambulance%')->get();
            $dispatches = Page::where('page', 'LIKE', 'dispatch%')->get();
            $hospitals = Page::where('page', 'LIKE', 'hospital%')->get();
            $pages = Page::where('page', 'LIKE', 'pages%')->get();
            $roles = Page::where('page', 'LIKE', 'roles%')->get();
            $responses = Page::where('page', 'LIKE', 'response%')->get();
            $data = [
                'users' => $users,
                'patients' => $patients,
                'incidents' => $incidents,
                'calls' => $calls,
                'conductors' => $conductors,
                'ambulances' => $ambulances,
                'dispatches' => $dispatches,
                'hospitals' => $hospitals,
                'pages' => $pages,
                'roles' => $roles,
                'responses' => $responses,
            ];
            return view('roles-permisos.create')->with($data);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect('/roles')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
            ]);

            $nuevoRol = Rol::create([
                'name' => $request->input('name'),
                'guard_name' => "web"
            ]);
            $pages = $request->input('pages');
            $nuevoRol->pages()->attach($pages);
            return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
        } catch (\Exception $e) {
            return redirect('/roles')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $role = Rol::find($id);
            $permissions = $role->pages;
            $users = Page::where('page', 'LIKE', 'users%')->get();
            $patients = Page::where('page', 'LIKE', 'patient%')->get();
            $incidents = Page::where('page', 'LIKE', 'incident%')->get();
            $calls = Page::where('page', 'LIKE', 'calls%')->get();
            $conductors = Page::where('page', 'LIKE', 'conductor%')->get();
            $ambulances = Page::where('page', 'LIKE', 'ambulance%')->get();
            $dispatches = Page::where('page', 'LIKE', 'dispatch%')->get();
            $hospitals = Page::where('page', 'LIKE', 'hospital%')->get();
            $pages = Page::where('page', 'LIKE', 'pages%')->get();
            $roles = Page::where('page', 'LIKE', 'roles%')->get();
            $responses = Page::where('page', 'LIKE', 'response%')->get();
            $data = [
                'role' => $role,
                'permissions' => $permissions,
                'users' => $users,
                'patients' => $patients,
                'incidents' => $incidents,
                'calls' => $calls,
                'conductors' => $conductors,
                'ambulances' => $ambulances,
                'dispatches' => $dispatches,
                'hospitals' => $hospitals,
                'pages' => $pages,
                'roles' => $roles,
                'responses' => $responses,
            ];
            return view('roles-permisos.show')->with($data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $role = Rol::find($id);
            $permissions = $role->pages;
            $users = Page::where('page', 'LIKE', 'users%')->get();
            $patients = Page::where('page', 'LIKE', 'patient%')->get();
            $incidents = Page::where('page', 'LIKE', 'incident%')->get();
            $calls = Page::where('page', 'LIKE', 'calls%')->get();
            $conductors = Page::where('page', 'LIKE', 'conductor%')->get();
            $ambulances = Page::where('page', 'LIKE', 'ambulance%')->get();
            $dispatches = Page::where('page', 'LIKE', 'dispatch%')->get();
            $hospitals = Page::where('page', 'LIKE', 'hospital%')->get();
            $pages = Page::where('page', 'LIKE', 'pages%')->get();
            $roles = Page::where('page', 'LIKE', 'roles%')->get();
            $responses = Page::where('page', 'LIKE', 'response%')->get();
            $data = [
                'role' => $role,
                'permissions' => $permissions,
                'users' => $users,
                'patients' => $patients,
                'incidents' => $incidents,
                'calls' => $calls,
                'conductors' => $conductors,
                'ambulances' => $ambulances,
                'dispatches' => $dispatches,
                'hospitals' => $hospitals,
                'pages' => $pages,
                'roles' => $roles,
                'responses' => $responses,
            ];
            return view('roles-permisos.edit')->with($data);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect('/roles')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|unique:roles,name,' . $id,
            ]);

            $rol = Rol::find($id);
            $rol->name = $request->input('name');

            $pages = $request->input('pages');
            $rol->pages()->sync($pages);
            $rol->save();

            return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect('/roles')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        //
    }
}
