<?php

namespace App\Http\Controllers\Conductor;

use App\Http\Controllers\Controller;
use App\Models\Conductor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConductorControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $conductors = Conductor::all();
            return view('conductor.index', compact('conductors'));
        } catch (\Exception $e) {
            return redirect('/conductor')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'ci'  => 'required|numeric',
                'licen' => 'required|string',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                '*.required' => 'Debe rellenar todos los campos :attribute',
            ]);
            $conductor = new Conductor();
            $conductor->full_name = $request->input('full_name');
            $conductor->ci = $request->input('ci');
            $conductor->licen = $request->input('licen');
            if ($request->hasFile('photo')) {
                $conductor->photo = $request['photo']->store('conductor_photos', 'public');
            }
            $conductor->save();
            return redirect('/conductor')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/conductor')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'ci'  => 'required|numeric',
                'licen' => 'required|string',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                '*.required' => 'Debe rellenar todos los campos :attribute',
            ]);
            $conductor = conductor::findOrFail($id);
            $conductor->full_name = $request->input('full_name');
            $conductor->ci = $request->input('ci');
            $conductor->licen = $request->input('licen');
            if ($request->hasFile('photo')) {
                $conductor->photo = $request['photo']->store('conductor_photos', 'public');
            }
            $conductor->save();
            return redirect('/conductor')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/conductor')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $conductor = Conductor::find($id);
            $conductor->delete();
            return redirect('/conductor')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/conductor')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
