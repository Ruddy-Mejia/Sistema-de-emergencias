<?php

namespace App\Http\Controllers\Dispatch;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Dispatch;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DispatchControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $ambulances = Ambulance::all();
            $dispatches = Dispatch::join('ambulance', 'ambulance.id', '=', 'dispatch.ambulance_id')
                ->select('dispatch.*', 'ambulance.id as ambulance_id')
                ->get();
            return view('dispatch.index', compact('dispatches', 'ambulances'));
        } catch (\Exception $e) {
            return redirect('/ambulance')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $ambulances = Ambulance::all();
            return view('dispatch.create', compact('ambulances'));
        } catch (\Exception $e) {
            return redirect('/dispatch')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date|after_or_equal:' . now()->toDateString(),
                'ambulance_id' => 'required|numeric',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $dispatch = new Dispatch();
            $dispatch->code_autizacion = '#' . strtoupper(substr(uniqid(), -8));
            $dispatch->date = $request->input('date');
            $dispatch->ambulance_id = $request->input('ambulance_id');
            $dispatch->latitude = $request->input('latitude');
            $dispatch->longitude = $request->input('longitude');
            $dispatch->save();
            return redirect('/dispatch')->with('success', 'Se creó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/dispatch')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $ambulances = Ambulance::all();
            $dispatch = Dispatch::find($id);
            return view('dispatch.edit', compact('dispatch', 'ambulances'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el usuario.");
        }
    }
    public function show($id)
    {
        try {
            $dispatch = Dispatch::find($id);
            return view('dispatch.show', compact('dispatch'));
        } catch (\Exception $e) {
            return back()->withError("No se encontró el usuario.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'date' => 'required|date|after_or_equal:' . now()->toDateString(),
                'ambulance_id' => 'required|numeric',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ], [
                '*.required' => "Debe rellenar todos los campos (:attribute)",
            ]);
            $dispatch = Dispatch::find($id);
            $dispatch->code_autizacion = '#' . strtoupper(substr(uniqid(), -8));
            $dispatch->date = $request->input('date');
            $dispatch->ambulance_id = $request->input('ambulance_id');
            $dispatch->latitude = $request->input('latitude');
            $dispatch->longitude = $request->input('longitude');
            $dispatch->save();
            return redirect('/dispatch')->with('success', 'Se actualizó correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withErrors($request->all());
        } catch (\Exception $e) {
            return redirect('/dispatch')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $dispatch = Dispatch::find($id);
            $dispatch->delete();
            return redirect('/dispatch')->with('success', 'Se eliminó correctamente');
        } catch (\Exception $e) {
            return redirect('/dispatch')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
