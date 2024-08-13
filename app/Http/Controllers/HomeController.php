<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Conductor;
use App\Models\Incident;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
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

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();

        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
