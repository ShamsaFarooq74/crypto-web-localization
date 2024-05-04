<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms = Term::get();
        return view('admin.terms.terms', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titleEN' => 'required', 'max:255',
            'titleAR' => 'required', 'max:255',
            'descriptionEN' => 'required|string|alpha|max:500',
            'descriptionAR' => 'required|string|alpha|max:500',
        ]);
        Term::create([
            'titleEN'   => $request->titleEN,
            'titleAR' => $request->titleAR,
            'descriptionEN'=> $request->descriptionEN, 
            'descriptionAR'  => $request->descriptionAR,    

        ]);
            session()->flash('alert_success', 'Terms Created Successfully');
            return redirect()->route('term.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $term = Term::where('id', $id)->first();
        return view('admin.terms.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titleEN' => ['required', 'max:255'],
            'titleAR' => ['required', 'max:255'],
            'descriptionEN' => ['required', 'string','alpha', 'max:500'],
            'descriptionAR' => ['required', 'string', 'alpha', 'max:500'],
        ]);
        $term = Term::where('id', $id)->first();
        $term->titleEN = $request->titleEN;
        $term->titleAR = $request->titleAR;
        $term->descriptionEN = $request->descriptionEN;
        $term->descriptionAR = $request->descriptionAR;
        $term->save();
        session()->flash('alert_success', 'Term And Condition Updated Successfully');
        return redirect()->route('term.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $term = Term::where('id', $id)->first();
        $term->delete();
        session()->flash('alert_success', 'Term And Condition Deleted Successfully');
        return redirect()->back();
        }
        public function status(Request $request)
        {
            $term = Term::where('id', $request->term_id)->first();
            $term->status = $request->status;
            $term->update();
            return response()->json([
                'success' => true,
                'message' => "term status updated"
            ]);
        }
        
    }

