<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HospitalControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $hospitals = Hospital::all();
            return view('hospital.index', compact('hospitals'));
        } catch (\Exception $e) {
            return redirect('/hospital')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $hospitals = Hospital::all();
            return view('hospital.create', compact('hospitals'));
        } catch (\Exception $e) {
            return redirect('/hospital')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'level' => 'required|string|max:255',
                'statu' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $hospital = new Hospital();
            $hospital->name = $request->input('name');
            $hospital->level = $request->input('level');
            $hospital->statu = $request->input('statu');
            $hospital->latitude = $request->input('latitude');
            $hospital->longitude = $request->input('longitude');
            $hospital->save();
            return redirect('/hospital')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/hospital')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $hospital = Hospital::find($id);
            return view('hospital.edit', compact('hospital'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el hospital.");
        }
    }
    public function show($id)
    {
        try {
            $hospital = Hospital::find($id);
            return view('hospital.show', compact('hospital'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el hospital.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'level' => 'required|string|max:255',
                'statu' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $hospital = Hospital::find($id);
            $hospital->name = $request->input('name');
            $hospital->level = $request->input('level');
            $hospital->statu = $request->input('statu');
            $hospital->latitude = $request->input('latitude');
            $hospital->longitude = $request->input('longitude');
            $hospital->save();
            return redirect('/hospital')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/hospital')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $hospital = Hospital::find($id);
            $hospital->delete();
            return redirect('/hospital')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/hospital')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
