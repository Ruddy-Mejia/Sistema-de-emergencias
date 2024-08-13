<?php

namespace App\Http\Controllers\Response;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseControllerNoApi extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();
            $responses = Response::all();
            return view('response.index', compact('responses','patients'));
        } catch (\Exception $e) {
            return redirect('/response')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
