<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Conductor;
use App\Models\Incident;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardControllerNoApi extends Controller
{
    public function index()
    {
        $lm_usr = User::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->count();
        $th_usr = User::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // $avr_usr = (100 * $th_usr)/$lm_usr;
        $lm_usr <= 0 ? $avr_usr = 100 : $avr_usr = (100 * $th_usr) / $lm_usr;


        $lm_drv = Conductor::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->count();
        $th_drv = Conductor::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // $ = (100 * $th_drv)/$lm_drv;
        $lm_drv <= 0 ? $avr_drv = 100 : $avr_drv = (100 * $th_drv) / $lm_drv;

        $lm_ptn = Patient::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->count();
        $th_ptn = Patient::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // $avr_ptn = (100 * $th_ptn)/$lm_ptn;
        $lm_ptn <= 0 ? $avr_ptn = 100 : $avr_ptn = (100 * $th_ptn) / $lm_ptn;

        $lm_amb = Ambulance::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->count();
        $th_amb = Ambulance::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $lm_amb <= 0 ? $avr_amb = 100 : $avr_amb = (100 * $th_amb) / $lm_amb;

        // $fechaHaceUnAnio =Carbon::now()->startOfYear();
        $th_year = Carbon::now()->year;
        $incidents = Incident::selectRaw('MONTH(created_at) as mes, COUNT(*) as cantidad')
            ->where('created_at', '>=', Carbon::now()->startOfYear())
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        $ly_incidents = Incident::selectRaw('MONTH(created_at) as mes, COUNT(*) as cantidad')
            ->whereBetween('created_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $locations = Incident::select('nature', 'latitude', 'longitude')->get();

        $data = [
            'users' => $th_usr,
            'conductors' => $th_drv,
            'patients' => $th_ptn,
            'ambulances' => $th_amb,
            'incidents' => $incidents,
            'avr_usr' => $avr_usr,
            'avr_drv' => $avr_drv,
            'avr_ptn' => $avr_ptn,
            'avr_amb' => $avr_amb,
            'th_year' => $th_year,
            'ly_incidents' => $ly_incidents,
            'locations' => $locations,
            // 'avr_inc' => $avr_inc,
        ];
        return view('index')->with($data);
    }
}
