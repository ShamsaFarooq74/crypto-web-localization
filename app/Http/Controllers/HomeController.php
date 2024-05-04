<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Plan;
use App\Models\Term;
use App\Models\User;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'locale']]);
    }

    public function show()
    {
        $plans = Plan::all();
        $privacies = Privacy::get();
        $terms = Term::get();
        return view('welcome', compact('plans', 'privacies','terms'));
    }

    public function  locale(string $locale)
    {
        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }

        App::setLocale($locale);
        
        $plans = Plan::all();
        $privacies = Privacy::get();
        $terms = Term::get();
        return view('welcome', compact('plans', 'privacies', 'terms'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasrole('admin')) {
            return view('admin.home');
        } elseif (Auth::user()->hasrole('customer')) {
            $terms = Term::all();
            $plans = Plan::all();
            $privacies = Privacy::get();
            return view('welcome', compact('plans', 'privacies','terms'));
        }
    }


    public function logout(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
            Auth::logout();
            return redirect('/login');
        } elseif (Auth::user()->hasRole('customer')) {
            Auth::logout();
            return redirect('/');
        }
    }

    public function lang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }

    public function change(Request $request): RedirectResponse
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }
}
