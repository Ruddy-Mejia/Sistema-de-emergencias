<?php

namespace App\Http\Controllers\Calls;

use App\Http\Controllers\Controller;
use App\Models\Calls;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CallsControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $calls = Calls::all();
            return view('calls.index', compact('calls'));
        } catch (\Exception $e) {
            return redirect('/calls')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
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
                'full_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:8|min:0',
                'type_of_call' => 'required|string|max:255',
                'description' => 'required|string',
                'institution' => 'nullable|string|max:255',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $calls = new Calls();
            $calls->code = '#' . strtoupper(substr(uniqid(), -5));
            $calls->full_name = $request->input('full_name');
            $calls->address = $request->input('address');
            $calls->phone = $request->input('phone');
            $calls->type_of_call = $request->input('type_of_call');
            $calls->description = $request->input('description');
            $calls->institution = $request->input('institution');
            $calls->save();
            return redirect('/calls')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/calls')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
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
                'full_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:8|min:0',
                'type_of_call' => 'required|string|max:255',
                'description' => 'required|string',
                'institution' => 'nullable|string|max:255',
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $calls = Calls::find($id);
            $calls->full_name = $request->input('full_name');
            $calls->address = $request->input('address');
            $calls->phone = $request->input('phone');
            $calls->type_of_call = $request->input('type_of_call');
            $calls->description = $request->input('description');
            $calls->institution = $request->input('institution');
            $calls->save();
            return redirect('/calls')->with('success', 'Se editó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/calls')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $call = Calls::find($id);
            $call->delete();
            return redirect('/calls')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/calls')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
