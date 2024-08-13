<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Patient;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class PatientControllerNoApi extends Controller
{
    public function index()
    {
        // $user = User::find(1);
        // for ($i = 50; $i <= 54; $i++) {
        //     $user->role->pages()->attach($i);
        // }
        try {
            $patients = Patient::all();
            return view('patients.index', compact('patients'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            // $roles = Rol::all();
            return view('patients.create');
        } catch (\Exception $e) {
            return redirect('/patient')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'age' => 'required|numeric|min:0',
                'phone' => 'required|numeric|digits:8|min:0',
                'phone_family' => 'required|numeric|digits:8|min:0',
            ], [
                'phone.digit' => 'Por favor introduzca un número de teléfono válido.',
                '*.required' => 'Debe rellenar todos los campos.',
            ]);
            $patient = new Patient();
            $patient->name = $request->input('name');
            $patient->lastname = $request->input('lastname');
            $patient->address = $request->input('address');
            $patient->age = $request->input('age');
            $patient->phone = $request->input('phone');
            $patient->phone_family = $request->input('phone_family');
            $patient->save();

            if ($request->input('nature') != '' && $request->input('details') != '' && $request->input('latitude') != '' && $request->input('longitude') != '' && $request->input('description') != '' && $request->input('type') != '' && $request->hasFile('evidence')) {
                $incident = new Incident();
                $incident->nature = $request->input('nature');
                $incident->latitude = $request->input('latitude');
                $incident->longitude = $request->input('longitude');
                $incident->description = $request->input('description');
                $incident->type = $request->input('type');
                $incident->evidence = $request['evidence']->store('evidence', 'public');
                $incident->details = $request->input('details');
                $incident->patient_id = $patient->id;
                $incident->save();
                return redirect('/patient')->with('success', 'Se registro el incidente y el paciente correctamente');
            } else {
                return redirect('/patient')->with('warning', 'Se creo el paciente');
            }

        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/patient')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $patient = Patient::find($id);
            // $roles = Rol::all();
            return view('patient.edit', compact('patient'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el usuario.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'age' => 'required|numeric|min:0',
                'phone' => 'required|numeric|digits:8|min:0',
                'phone_family' => 'required|numeric|digits:8|min:0',
            ], [
                'phone.digit' => 'Por favor introduzca un número de teléfono válido.',
                '*.required' => 'Debe rellenar todos los campos.',
            ]);
            $patient = Patient::findOrFail($id);
            $patient->name = $request->input('name');
            $patient->lastname = $request->input('lastname');
            $patient->address = $request->input('address');
            $patient->age = $request->input('age');
            $patient->phone = $request->input('phone');
            $patient->phone_family = $request->input('phone_family');
            $patient->save();
            return redirect('/patient')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/patient')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::find($id);
            $patient->delete();
            return redirect('/patient')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/patient')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $patient = User::find($id);
            return view('patient.show', compact('patient'));
        } catch (\Exception $e) {
            return redirect('/patient')->with('error', 'Ha ocurrido un error:' . $e->getMessage());
        }
    }
}
