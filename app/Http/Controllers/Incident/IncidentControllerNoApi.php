<?php

namespace App\Http\Controllers\Incident;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IncidentControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();
            $incidents = Incident::join('patient', 'incidents.patient_id', '=', 'patient.id')
                ->select('patient.*', 'incidents.*')
                ->get();
            return view('incidents.index', compact('incidents', 'patients'));
        } catch (\Exception $e) {
            return redirect('/patient')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $patients = Patient::all();
            return view('incidents.create', compact('patients'));
        } catch (\Exception $e) {
            return redirect('/incidents')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nature' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
                'description' => 'required|string',
                'type' => 'required|string|max:255',
                'patient_id' => 'required',
                'evidence' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'details' => 'required|string|max:255',
            ], [
                '*.required' => 'Debe rellenar todos los campos.',
            ]);
            $incident = new Incident();
            $incident->nature = $request->input('nature');
            $incident->latitude = $request->input('latitude');
            $incident->longitude = $request->input('longitude');
            $incident->description = $request->input('description');
            $incident->type = $request->input('type');
            if ($request->hasFile('evidence')) {
                // $incident->evidence = $request->file('evidence')->store('storage/evidence');
                $incident->evidence = $request['evidence']->store('evidence', 'public');
            }
            $incident->details = $request->input('details');
            $incident->patient_id = $request->input('patient_id');
            $incident->save();
            return redirect('/incident')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/incident')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $patients = Patient::all();
            $incident = Incident::find($id);
            return view('incidents.edit', compact('incident', 'patients'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el usuario.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nature' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
                'description' => 'required|string',
                'type' => 'required|string|max:255',
                'patient_id' => 'required',
                'details' => 'required|string|max:255',
            ], [
                '*.required' => 'Debe rellenar todos los campos.',
            ]);
            $incident = Incident::findOrFail($id);
            $incident->nature = $request->input('nature');
            $incident->latitude = $request->input('latitude');
            $incident->longitude = $request->input('longitude');
            $incident->description = $request->input('description');
            $incident->type = $request->input('type');
            if ($request->hasFile('evidence')) {
                $incident->evidence = $request['evidence']->store('evidence', 'public');
            }
            $incident->details = $request->input('details');
            $incident->patient_id = $request->input('patient_id');
            $incident->save();
            return redirect('/incident')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/incident')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $incident = Incident::find($id);
            $incident->delete();
            return redirect('/incident')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/incident')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $incident = Incident::find($id);
            return view('incidents.show', compact('incident'));
        } catch (\Exception $e) {
            return redirect('/incident')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }
}
