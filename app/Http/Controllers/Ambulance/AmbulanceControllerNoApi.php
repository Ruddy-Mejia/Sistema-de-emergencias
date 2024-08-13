<?php

namespace App\Http\Controllers\Ambulance;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AmbulanceControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $conductors = Conductor::all();
            $ambulances = Ambulance::join('conductor', 'ambulance.conductor_id', '=', 'conductor.id')
                ->select('conductor.*' , 'ambulance.*')
                ->get();
            return view('ambulance.index', compact('ambulances','conductors'));
        } catch (\Exception $e) {
            return redirect('/ambulance')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    // public function create()
    // {
    //     try {
    //         $patients = Patient::all();
    //         return view('incidents.create', compact('patients'));
    //     } catch (\Exception $e) {
    //         return redirect('/incidents')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'number_plate' => 'required|string|max:10',
                'color' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'conductor_id' => 'required|numeric',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $ambulance = new Ambulance();
            $ambulance->code = '#' . strtoupper(substr(uniqid(), -5));
            $ambulance->number_plate = $request->input('number_plate');
            $ambulance->color = $request->input('color');
            $ambulance->model = $request->input('model');
            $ambulance->conductor_id = $request->input('conductor_id');
            $ambulance->save();
            return redirect('/ambulance')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/ambulance')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    // public function edit($id)
    // {
    //     try {
    //         $patients = Patient::all();
    //         $incident = Incident::find($id);
    //         return view('incidents.edit', compact('incident', 'patients'));
    //     } catch (\Exception $e) {
    //         return back()->withError("No se encontró el usuario.");
    //     }
    // }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'number_plate' => 'required|string|max:10',
                'color' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'conductor_id' => 'required|numeric',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $ambulance = Ambulance::find($id);
            $ambulance->number_plate = $request->input('number_plate');
            $ambulance->color = $request->input('color');
            $ambulance->model = $request->input('model');
            $ambulance->conductor_id = $request->input('conductor_id');
            $ambulance->save();
            return redirect('/ambulance')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/ambulance')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $ambulance = Ambulance::find($id);
            $ambulance->delete();
            return redirect('/ambulance')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/ambulance')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
