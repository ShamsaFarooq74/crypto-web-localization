<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth, Session;
use Illuminate\Http\Request;
use Validator,DB;
use App\Models\Privacy;


class PrivacyController extends Controller
{
    public function privacy_policy(){
        $privacies = Privacy::get();
        return view('admin.privacies.privacy',compact('privacies')); 
    } 
    public function create(){

        return view('admin.privacies.privacy_create'); 
    } 
    function store(Request $request){
       $request->validate([
            'nameEN' => 'required', 'max:255',
            'nameAR' => 'required', 'max:255',
            'descriptionEN' => 'required|string|alpha|max:500',
            'descriptionAR' => 'required|string|alpha|max:500',
        ]);
       Privacy::create([
            'nameEN'   => $request->nameEN,
            'nameAR' => $request->nameAR,
            'descriptionEN'=> $request->descriptionEN, 
            'descriptionAR'  => $request->descriptionAR,    

        ]);
            session()->flash('alert_success', 'privacy Created Successfully');
            return redirect()->route('privacy-policy');
    }

    public function destroy($id) {
         $privacydel = Privacy::where('id', $id)->first();
         $privacydel->delete();

        session()->flash('alert_success', 'Privacy Deleted Successfully');
        return redirect()->back();
        }

     public function edit($id){
        $privacy = Privacy::where('id',$id)->first();
        return view('admin.privacies.privacy_edit', compact('privacy'));
    }

   public  function update($id, Request $request){
        $request->validate([
            'nameEN' => ['required', 'max:255'],
            'nameAR' => ['required', 'max:255'],
            'descriptionEN' => ['required', 'string','alpha', 'max:500'],
            'descriptionAR' => ['required', 'string', 'alpha', 'max:500'],
        ]);
           $privacy = Privacy::where('id', $id)->first();

                  $privacy->nameEN = $request->nameEN;
                  $privacy->nameAR = $request->nameAR;
                  $privacy->descriptionEN = $request->descriptionEN; 
                  $privacy->descriptionAR =$request->descriptionAR;
                  $privacy->save();
       
            session()->flash('alert_success', 'privacy Updated Successfully');
            return redirect()->route('privacy-policy');

    }

    public function status(Request $request)
    {
         $privacy = Privacy::where('id', $request->privacy_id)->first();
        $privacy->status = $request->status;
        $privacy->update();
        return response()->json([
            'success' => true,
            'message' => "privacy status updated"
        ]);
    }
}

